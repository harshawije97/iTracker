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

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // This code is improved and optimized by ChatGPT
        $_SESSION = array_merge($_SESSION, [
            'user_id'      => $user['user_id'],
            'first_name'   => $user['first_name'],
            'last_name'    => $user['last_name'],
            'username'     => $user['username'],
            'role'         => $user['role'],
            'estate_code'  => $user['estate_code'] ?? null,
            'is_registered' => $user['is_registered'],
            'logged_in'    => true
        ]);

        return [
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'username' => $user['username']
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

// Get the session user
function getSessionUser()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        return null;
    }

    return [
        'user_id'       => $_SESSION['user_id'] ?? null,
        'username'      => $_SESSION['username'] ?? null,
        'first_name'    => $_SESSION['first_name'] ?? null,
        'last_name'     => $_SESSION['last_name'] ?? null,
        'role'          => $_SESSION['role'] ?? null,
        'estate_code'   => $_SESSION['estate_code'] ?? null,
        'is_registered' => $_SESSION['is_registered'] ?? null
    ];
}

function logout()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    session_unset();
    session_destroy();

    header('Location: ./index.php');
    exit;
}


function createAuthUser(PDO $conn, $values)
{
    $hashedPassword = hash('sha256', $values['password']);

    try {
        $sql = "INSERT INTO auth (user_id, username, password)
                VALUES (:user_id, :username, :password)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $values['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':username', $values['username'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Auth user created successfully'
            ]; // return new auth ID
        } else {
            return false;
        }
    } catch (PDOException $error) {
        error_log("Error creating auth user: " . $error->getMessage());
        return false;
    }
}
