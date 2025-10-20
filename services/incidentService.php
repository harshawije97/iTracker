<?php include_once './services/incidentService.php'; ?>

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
        // Get all incidents and filter by username if there are any
        $stmt = $conn->prepare("SELECT * FROM incidents WHERE (manager_email = :username OR manager_email IS NULL OR manager_email = '') ORDER BY created_at DESC");
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
        $query = "INSERT INTO incidents (incident_code, title, inventory_id, description, image, priority, manager_email, is_archived, user_id, estate_code)
            VALUES (:incident_code, :title, :inventory_id, :description, :image, :priority, :manager_email, :is_archived, :user_id, :estate_code)";

        $stmt = $conn->prepare($query);

        $stmt->bindValue(':incident_code', $values['incident_code'], PDO::PARAM_STR);
        $stmt->bindValue(':title', $values['title'], PDO::PARAM_STR);
        $stmt->bindValue(':inventory_id', $values['inventory_id'], PDO::PARAM_INT);
        $stmt->bindValue(':description', $values['description'], PDO::PARAM_STR);
        $stmt->bindValue(':image', $imageData, PDO::PARAM_LOB);
        $stmt->bindValue(':priority', $values['priority'], PDO::PARAM_STR);
        $stmt->bindValue(':manager_email', $values['manager_email'], PDO::PARAM_STR);
        $stmt->bindValue(':is_archived', $values['is_archived'], PDO::PARAM_BOOL);
        $stmt->bindValue(':user_id', $values['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':estate_code', $values['estate_code'], PDO::PARAM_STR);

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
