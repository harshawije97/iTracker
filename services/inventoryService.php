<?php

require_once './database/connection.php';

function getInventoryItemsByUserId(PDO $conn, int $userId)
{
    $stmt = $conn->prepare("SELECT * FROM inventory WHERE user_id = :userId");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
