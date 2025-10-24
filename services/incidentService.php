<?php

// get all incidents by user id
function getIncidentsByUserId(PDO $conn, $user_id)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM incidents WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        return [
            'success' => true,
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get incidents: ' . $error->getMessage()
        ];
    }
}

// get all incidents by estate code
function getIncidentsByEstateCode(PDO $conn, $estateCode)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM incidents WHERE estate_code = :estateCode");
        $stmt->bindParam(':estateCode', $estateCode);
        $stmt->execute();
        return [
            'success' => true,
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get incidents: ' . $error->getMessage()
        ];
    }
}

function getAllIncidents(PDO $conn, $username)
{
    try {
        $stmt = $conn->prepare("
            SELECT 
                i.*,
                inv.name AS inventory_name,
                u.first_name AS user_first_name,
                u.last_name AS user_last_name
            FROM incidents i
            INNER JOIN inventory inv ON i.inventory_id = inv.id
            INNER JOIN users u ON i.user_id = u.id
            WHERE (i.manager_email = :username OR i.manager_email IS NULL OR i.manager_email = '')
            ORDER BY i.created_at DESC
        ");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return [
            'success' => true,
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get incidents: ' . $error->getMessage()
        ];
    }
}

function getIncidents(PDO $conn)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM incidents ORDER BY created_at DESC");
        $stmt->execute();
        return [
            'success' => true,
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => true,
            'message' => 'Failed to get incidents: ' . $error->getMessage()
        ];
    }
}

function getAllIncidentsByUsername(PDO $conn, $user_id)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM incidents WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return [
            'success' => true,
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get incidents: ' . $error->getMessage()
        ];
    }
}

function countAllIncidentsByUsername(PDO $conn, $user_id)
{
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM incidents WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return [
            'success' => true,
            'data' => $stmt->fetch(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get incidents: ' . $error->getMessage()
        ];
    }
}


function saveIncident(PDO $conn, $values)
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
        $query = "INSERT INTO incidents (incident_code, title, inventory_id, description, image, priority, manager_email, user_id, estate_code)
            VALUES (:incident_code, :title, :inventory_id, :description, :image, :priority, :manager_email, :user_id, :estate_code)";

        $stmt = $conn->prepare($query);

        $stmt->bindValue(':incident_code', $values['incident_code'], PDO::PARAM_STR);
        $stmt->bindValue(':title', $values['title'], PDO::PARAM_STR);
        $stmt->bindValue(':inventory_id', $values['inventory_id'], PDO::PARAM_INT);
        $stmt->bindValue(':description', $values['description'], PDO::PARAM_STR);
        $stmt->bindValue(':image', $imageData, PDO::PARAM_LOB);
        $stmt->bindValue(':priority', $values['priority'], PDO::PARAM_STR);
        $stmt->bindValue(':manager_email', $values['manager_email'], PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $values['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':estate_code', $values['estate_code'], PDO::PARAM_STR);

        $stmt->execute();

        // This action needs to move into a new functional context
        $query = "UPDATE inventory SET item_status = :item_status WHERE id = :inventory_id";
        $stmt = $conn->prepare($query);

        $stmt->bindValue(':item_status', ItemStatus::ON_REPAIR->value, PDO::PARAM_STR);
        $stmt->bindValue(':inventory_id', $values['inventory_id'], PDO::PARAM_INT);

        $stmt->execute();

        return [
            'success' => true,
            'message' => 'Incident created successfully'
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to create incident: ' . $error->getMessage()
        ];
    }
}

// Update incident
function updateIncident(PDO $conn, $values)
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

// Get incident by incidentCode
function getIncidentByCode(PDO $conn, $incidentCode)
{
    try {
        $stmt = $conn->prepare("SELECT * FROM incidents WHERE incident_code = :incident_code");
        $stmt->bindParam(':incident_code', $incidentCode);
        $stmt->execute();
        return [
            'success' => true,
            'data' => $stmt->fetch(PDO::FETCH_ASSOC)
        ];
    } catch (PDOException $error) {
        return [
            'success' => false,
            'message' => 'Failed to get incident: ' . $error->getMessage()
        ];
    }
}
