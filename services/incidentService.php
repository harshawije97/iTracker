<?php include_once './services/incidentService.php'; ?>

<?php

// get all incidents by user id
function getIncidentsByUserId($conn, $user_id)
{
    $stmt = $conn->prepare("SELECT * FROM incidents WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
