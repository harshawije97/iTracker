<?php
include_once './services/auth.php';
include_once './services/inventoryService.php';
include_once './services/userService.php';
include_once './services/utils/generateID.php';
include_once './services/incidentService.php';
include_once './database/connection.php';
?>

<?php

$sessionUser = getSessionUser();
if (!$sessionUser) {
    header('Location: index.php');
    exit;
}

// Get all inventory items by estate code
$inventoryItems = getInventoryItemsByEstateCode($conn, $sessionUser['estate_code']);

// Get all managers
$headOfficeManagers = getAllManagers($conn, true, ['first_name', 'last_name', 'email']);
$key = generateUniqueKey(5);

?>

<?php

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = [
        'incident_code' => $_POST['incident_code'],
        'title' => $_POST['title'],
        'inventory_id' => $_POST['inventory_id'],
        'description' => $_POST['description'] ?? null,
        'image' => $_FILES['image'] ?? null,
        'priority' => $_POST['priority'],
        'manager_email' => $_POST['manager_email'],
        'is_archived' => false,
        'user_id' => $sessionUser['user_id'],
        'estate_code' => $sessionUser['estate_code']
    ];

    // Save the incident
    $response = saveIncident($conn, $values);

    if ($response['success']) {
        $_SESSION['success_message'] = $response['message'];
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $_SESSION['error_message'] = $response['message'];
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Incident</title>
    <?php include_once './shared/links.php' ?>
</head>

<body>
    <?php include_once './components/sweetAlert.php'; ?>
    <div class="base">
        <?php include_once './components/secondaryHeader.php'; ?>
        <div class="container">
            <div class="px-16 w-full">
                <section class="main-content">
                    <div class="title-section">
                        <div class="add-new">Add New</div>
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <h1 class="main-title">Incident</h1>
                            <span class="auto-id-badge">
                                Incident ID:
                                <?= htmlspecialchars($key) ?>
                            </span>
                        </div>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="incident_code" value="<?= $key ?>">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
                        <div class="form-group">
                            <input type="text" class="input-field" name="title" placeholder="Title" required>
                        </div>

                        <div class="form-group">
                            <select class="select-field" name="inventory_id" required>
                                <option disabled selected>Select Inventory Item</option>
                                <?php foreach ($inventoryItems as $item) {
                                ?>
                                    <option value="<?= $item['id'] ?>">
                                        <?= htmlspecialchars($item['serial_number']) ?>
                                        <?= htmlspecialchars($item['name']) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea
                                class="textarea-field input-field"
                                name="description"
                                placeholder="Short Description (Optional)"
                                maxlength="225"></textarea>
                        </div>

                        <div class="upload-section">
                            <label class="upload-label">Upload reference images</label>
                            <input
                                type="file"
                                id="fileInput"
                                name="image"
                                class="upload-button"
                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                placeholder="Upload Images">
                            <p class="helper-text">Upload incident events are not mandatory. But a better usage for future endevours</p>
                        </div>

                        <div class="form-group">
                            <select class="priority-dropdown" name="priority" required>
                                <option disabled selected>Select Priority</option>
                                <option value="low">Low</option>
                                <option value="moderate">Moderate</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="select-field" name="manager_email">
                                <option disabled selected>Assign to manager</option>
                                <?php foreach ($headOfficeManagers as $manager) { ?>
                                    <option value="<?= htmlspecialchars($manager['email']) ?>">
                                        <?= htmlspecialchars($manager['first_name']) . ' ' . htmlspecialchars($manager['last_name']) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <button type="submit" class="btn-primary">Save Incident</button>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <script>
        function navigateBack() {
            window.history.back();
        }

        function settingsClicked() {
            alert("Settings clicked!");
        }
    </script>
</body>

</html>