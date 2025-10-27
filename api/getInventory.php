<?php
include_once __DIR__ . '/../database/connection.php';
include_once __DIR__ . '/../services/inventoryService.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
        $keyword = trim($_POST['search']);
        $response = searchItemsByKeywords($conn, $keyword);
        echo json_encode($response);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
    }
} catch (Throwable $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
exit;
