<?php

require_once './services/constants/enums.php';


// get all users

// get all head office managers (email & name)
function getAllManagers(PDO $conn, bool $isHeadOfficeManager = false, array $filter = [])
{
    if (empty($filter)) {
        $columns = "*";
    } else {
        $allowedColumns = ['id', 'first_name', 'last_name', 'email', 'estate_code', 'role', 'is_registered'];

        // remove invalid columns
        $validColumns = array_intersect($filter, $allowedColumns);

        // if all are invalid fallback to all columns
        if (empty($validColumns)) {
            $columns = "*";
        } else {
            $columns = implode(', ', $validColumns);
        }
    }

    if ($isHeadOfficeManager) {
        $query = $conn->prepare("SELECT $columns FROM users WHERE role NOT IN ('chief-clerk', 'estate-manager')");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    $query = $conn->prepare("SELECT * FROM users WHERE role NOT IN ('chief-clerk')");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


function getAllUsers(PDO $conn, int $userId)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE id != :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return [
            'success' => true,
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get users: ' . $error->getMessage()
        ];
    }
}

function getUserById(PDO $conn, int $id)
{
    try {
        $query = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return [
            'success' => true,
            'data' => $query->fetch(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get user: ' . $error->getMessage()
        ];
    }
}

// Register new user
function registerNewUser(PDO $conn, $values)
{

    try {
        $query = "INSERT INTO users (first_name, last_name, email, estate_code, role, is_registered)
                VALUES (:first_name, :last_name, :email, :estate_code, :role, :is_registered)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':first_name', $values['first_name'], PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $values['last_name'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $values['email'], PDO::PARAM_STR);
        $stmt->bindParam(':estate_code', $values['estate_code'], PDO::PARAM_STR);
        $stmt->bindParam(':role', $values['role'], PDO::PARAM_STR);
        $stmt->bindParam(':is_registered', $values['is_registered'], PDO::PARAM_BOOL);

        $stmt->execute();

        return [
            'success' => true,
            'message' => 'User registered successfully'
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to register user: ' . $error->getMessage()
        ];
    }
}

// Update existing registered user
function updateRegisteredUserByUserID(PDO $conn, int $id, $values)
{
    // CSRF Protection --> to protect against cross-site request forgery
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('Invalid CSRF token');
        }
    }
    
    try {
        $query = "UPDATE users SET 
        first_name = :first_name, last_name = :last_name, email = :email, estate_code = :estate_code, role = :role, is_registered = :is_registered WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':first_name', $values['first_name'], PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $values['last_name'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $values['email'], PDO::PARAM_STR);
        $stmt->bindParam(':estate_code', $values['estate_code'], PDO::PARAM_STR);
        $stmt->bindParam(':role', $values['role'], PDO::PARAM_STR);
        $stmt->bindParam(':is_registered', $values['is_registered'], PDO::PARAM_BOOL);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return [
            'success' => true,
            'message' => 'User updated successfully'
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to update user: ' . $error->getMessage()
        ];
    }
}

function updateRegistrationStatusByUserID(PDO $conn, int $id, bool $isRegistered)
{
    try {
        $query = "UPDATE users SET is_registered = :isRegistered WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':isRegistered', $isRegistered, PDO::PARAM_BOOL);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return [
            'success' => true,
            'message' => 'Registration status updated successfully'
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to update registration status: ' . $error->getMessage()
        ];
    }
}