<?php
require_once __DIR__ . '/constants/enums.php';
require_once __DIR__ . '/../database/connection.php';

// Get all inventory items by user id
function getInventoryItemsByUserId(PDO $conn, int $userId)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM inventory WHERE user_id = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return [
            'success' => true,
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get inventory items: ' . $error->getMessage()
        ];
    }
}

// Get all inventory items by estate code
function getInventoryOnStoreItemsByEstateCode(PDO $conn, string $estateCode)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM inventory WHERE estate_code = :estateCode AND item_status != :itemStatus");

        $itemStatus = ItemStatus::ON_REPAIR->value;

        $stmt->bindParam(':estateCode', $estateCode, PDO::PARAM_STR);
        $stmt->bindParam(':itemStatus', $itemStatus, PDO::PARAM_STR);

        $stmt->execute();
        return [
            'success' => true,
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get inventory items: ' . $error->getMessage()
        ];
    }
}

function getAllItemsByEstateCode(PDO $conn, string $estateCode)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM inventory WHERE estate_code = :estateCode");
        $stmt->bindParam(':estateCode', $estateCode, PDO::PARAM_STR);
        $stmt->execute();
        return [
            'success' => true,
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get items: ' . $error->getMessage()
        ];
    }
}

function searchItemsByKeywords(PDO $conn, string $keyword)
{
    try {
        $stmt = $conn->prepare("SELECT id, serial_number, name, description, 
            estate_code, user_id, item_status, created_at 
            FROM inventory 
            WHERE MATCH(name) AGAINST(:keyword IN BOOLEAN MODE)
            LIMIT 50");
        $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($rows);

        return [
            'success' => true,
            'data' => $json
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get items: ' . $error->getMessage()
        ];
    }
}

function getAllItemsByHeadOffice(PDO $conn)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM inventory WHERE estate_code IS NULL");
        $stmt->execute();
        return [
            'success' => true,
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get items: ' . $error->getMessage()
        ];
    }
}


// Save inventory item
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

// Update inventory item
function updateInventoryItem(PDO $conn, int $itemId, $values)
{
    $imageData = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
    }

    try {
        $query = "UPDATE inventory SET serial_number = :serial_number, name = :name, category = :category, description = :description, image = :image, estate_code = :estate_code 
        WHERE id = :itemId";

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':serial_number', $values['serial_number'], PDO::PARAM_STR);
        $stmt->bindValue(':name', $values['name'], PDO::PARAM_STR);
        $stmt->bindValue(':category', $values['category'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $values['description'], PDO::PARAM_STR);
        $stmt->bindValue(':image', $imageData, PDO::PARAM_LOB);
        $stmt->bindValue(':estate_code', $values['estate_code'], PDO::PARAM_STR);
        $stmt->bindValue(':itemId', $itemId, PDO::PARAM_INT);

        $stmt->execute();

        return [
            'success' => true,
            'message' => 'Inventory item updated successfully'
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Error updating inventory item: ' . $error->getMessage()
        ];
    }
}


// Get inventory item by id
function getInventoryItemById(PDO $conn, int $id)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM inventory WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return [
            'success' => true,
            'data' => $stmt->fetch(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get inventory item: ' . $error->getMessage()
        ];
    }
}

// Archive item
function archiveItem(PDO $conn, int $itemId)
{
    $stmt = $conn->prepare("UPDATE inventory SET is_archived = :is_archived WHERE id = :itemId");
    $stmt->bindParam(':itemStatus', ItemStatus::ARCHIVED->value, PDO::PARAM_STR);
    $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);
    $stmt->execute();
}
