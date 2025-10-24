<?php

// Create incident process
function createIncidentProcess(PDO $conn, $values)
{
    // CSRF Protection --> to protect against cross-site request forgery
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('Invalid CSRF token');
        }
    }

    $imageData = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
    }

    try {
        $stmt = $conn->prepare("INSERT INTO incident_updates (incident_id, status, description, image, user_id)
            VALUES (:incident_id, :status, :description, :image, :user_id)");

        $stmt->bindValue(':incident_id', $values['incident_id'], PDO::PARAM_INT);
        $stmt->bindValue(':status', $values['status'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $values['description'], PDO::PARAM_STR);
        $stmt->bindValue(':image', $imageData, PDO::PARAM_LOB);
        $stmt->bindValue(':user_id', $values['user_id'], PDO::PARAM_INT);

        $stmt->execute();

        return [
            'success' => true,
            'message' => 'Incident updated successfully'
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to update incident: ' . $error->getMessage()
        ];
    }
}

// Get history by ID
function getIncidentHistoryById(PDO $conn, $id)
{
    try {
        $stmt = $conn->prepare("
            SELECT 
                i.id,
                i.incident_code,
                i.title,
                i.inventory_id,
                i.description AS incident_description,
                i.priority,
                i.manager_email,
                i.is_archived,
                i.user_id AS incident_creator_id,
                i.estate_code,
                i.created_at AS incident_created_at,
                iu.id AS update_id,
                iu.status,
                iu.description AS update_description,
                iu.user_id AS update_user_id,
                iu.created_at AS update_created_at,
                iu.updated_on
            FROM incidents i
            LEFT JOIN incident_updates iu ON i.id = iu.incident_id
            WHERE i.id = :incident_id
            ORDER BY iu.created_at DESC
        ");

        $stmt->bindParam(':incident_id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return [
            'success' => true,
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'data' => 'Failed to get incident history: ' . $error->getMessage()
        ];
    }
}
