<?php

require_once './database/connection.php';

function login($username, $password)
{
    global $conn;

    try {

        $stmt = $conn->prepare("
            SELECT a.id, a.user_id, a.username, a.password, 
                    u.first_name, u.last_name, u.email, u.estate_code, u.role, u.is_registered
                FROM auth a
                INNER JOIN users u ON a.user_id = u.id
                WHERE a.username = :username
        ");

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute(); // Execute the prepared statement

        // If the user exists, fetch the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ];
        }

        // Hash the password
        $hashedPassword = hash('sha256', $password);

        if ($user['password'] !== $hashedPassword) {
            return [
                'success' => false,
                'message' => 'Incorrect username or password',
                'data' => null
            ];
        }

        // Only then start the session
        session_start();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['estate_code'] = $user['estate_code'] ?? null;
        $_SESSION['is_registered'] = $user['is_registered'];
        $_SESSION['logged_in'] = true;


        return [
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                $_SESSION['first_name'] = $user['first_name'],
                $_SESSION['last_name'] = $user['last_name'],
                $_SESSION['username'] = $user['username']
            ]
        ];
    } catch (PDOException $e) {
        return [
            'success' => false,
            'message' => 'An error occurred during login',
            'data' => null
        ];
    }
}

function isLoggedIn()
{
    // check if the session is up and running
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

// Get the session user
function getSessionUser()
{
    if (!isLoggedIn()) {
        return null;
    }

    return [
        'user_id' => $_SESSION['user_id'],
        'username' => $_SESSION['username'],
        'first_name' => $_SESSION['first_name'],
        'last_name' => $_SESSION['last_name'],
        'role' => $_SESSION['role'],
        'estate_code' => $_SESSION['estate_code'] ?? null
    ];
}

function logout()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    session_unset();
    session_destroy();
    return [
        'success' => true,
        'message' => 'Logout successful',
        'data' => null
    ];
}
