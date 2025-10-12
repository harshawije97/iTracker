<?php

require_once './services/auth.php';
require_once './services/constants/enums.php';

function getInventoryItemsByUserId(PDO $conn, int $userId)
{
    $stmt = $conn->prepare("SELECT * FROM inventory WHERE user_id = :userId");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function saveInventoryItem(PDO $conn, $values)
{
    // CSRF Protection --> to protect against cross-site request forgery
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('Invalid CSRF token');
        }
    }

    // get session user
    $sessionUser = getSessionUser();
    $values['user_id'] = $sessionUser['user_id'];

    $imageData = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
    }

    try {
        $query = "INSERT INTO inventory
            (serial_number, name, category, description, image, estate_code, user_id, item_status)
            VALUES (:serial_number, :name, :category, :description, :image, :estate_code, :user_id, :item_status)";

        $stmt = $conn->prepare($query);

        $stmt->bindValue(':serial_number', $values['serial_number'], PDO::PARAM_STR);
        $stmt->bindValue(':name', $values['name'], PDO::PARAM_STR);
        $stmt->bindValue(':category', $values['category'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $values['description'], PDO::PARAM_STR);
        $stmt->bindValue(':image', $imageData, PDO::PARAM_LOB);
        $stmt->bindValue(':estate_code', $values['estate_code'], PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $values['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':item_status', ItemStatus::IN_STOCK->value, PDO::PARAM_STR);

        $stmt->execute();

        return [
            'success' => true,
            'message' => 'Inventory item saved successfully'
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Error saving inventory item: ' . $error->getMessage()
        ];
    }
}

function getInventoryItemById(PDO $conn, int $id)
{
    $stmt = $conn->prepare("SELECT * FROM inventory WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
