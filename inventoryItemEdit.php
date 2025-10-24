<?php
include_once './database/connection.php';
include_once './services/auth.php';
include_once './services/inventoryService.php';
include_once './services/userService.php';
?>

<?php
$sessionUser = getSessionUser();
if (!$sessionUser) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'] ?? null;
$incident_code = $_GET['serial_number'] ?? null;

// Get inventory item by inventory id
$response = getInventoryItemById($conn, $id);
$inventoryItem = $response['data'];

if (!$inventoryItem) {
    header('Location: inventory.php');
    exit;
}

// Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = [
        'serial_number' => $_POST['serial_number'],
        'name' => $_POST['name'],
        'category' => $_POST['category'],
        'description' => $_POST['description'] ?? null,
        // 'image' => $_FILES['image'] ?? null,
        'estate_code' => $_POST['estate_code']
    ];

    $response = updateInventoryItem($conn, $id, $values);
    if ($response['success']) {
        $_SESSION['success_message'] = $response['message'];
        
        $successAndRedirect = true;
    }
    if (!$response['success']) {
        $_SESSION['error_message'] = $response['message'];
        
        $successAndRedirect = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Item - Edit</title>
    <?php include_once './shared/links.php' ?>
    <?php include_once './shared/functions.php' ?>
</head>

<body>
    <?php include_once './components/sweetAlert.php'; ?>
    <section class="base">
        <?php include_once './components/secondaryHeader.php'; ?>
        <div class="container">
            <div class="px-16 w-full">
                <div class="main-content">
                    <div class="title-section">
                        <div class="add-new">Update</div>
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <h1 class="main-title">Inventory Item</h1>
                        </div>
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
                        <div class="form-group">
                            <input
                                type="text"
                                name="serial_number"
                                class="input-field size-sm"
                                value="<?= htmlspecialchars($inventoryItem['serial_number']) ?>"
                                placeholder="Serial Number (PC-1A23B4)"
                                required>
                        </div>

                        <div class="form-group">
                            <input
                                type="text"
                                name="name"
                                class="input-field"
                                value="<?= htmlspecialchars($inventoryItem['name']) ?>"
                                placeholder="Name"
                                required>
                        </div>

                        <div class="form-group">
                            <select name="category" class="select-field" required>
                                <option disabled <?= empty($inventoryItem['category']) ? 'selected' : '' ?>>Select Category</option>
                                <option value="laptop" <?= ($inventoryItem['category'] ?? '') === 'Laptop' ? 'selected' : '' ?>>Laptop</option>
                                <option value="printer" <?= ($inventoryItem['category'] ?? '') === 'Printer' ? 'selected' : '' ?>>Printer</option>
                                <option value="scanner" <?= ($inventoryItem['category'] ?? '') === 'Scanner' ? 'selected' : '' ?>>Scanner</option>
                                <option value="desktop" <?= ($inventoryItem['category'] ?? '') === 'Desktop' ? 'selected' : '' ?>>Desktop PC</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea
                                name="description"
                                class="textarea-field input-field"
                                placeholder="Short Description (Optional)"
                                maxlength="255"><?= htmlspecialchars(trim($inventoryItem['description'] ?? 'No description')) ?></textarea>
                        </div>

                        <div class="upload-section">
                            <label class="upload-label">Update Item images</label>
                            <?php if (!empty($inventoryItem['image'])): ?>
                                <?php
                                $imgData = base64_encode($inventoryItem['image']); // encode binary to base64
                                $mimeType = 'image/jpeg'; // adjust depending on your image type
                                ?>
                                <img src="data:<?= $mimeType ?>;base64,<?= $imgData ?>" alt="Item Image" width="150">
                            <?php endif; ?>
                            <input
                                type="file"
                                id="fileInput"
                                name="image"
                                class="upload-button"
                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                placeholder="Upload Images">
                            <p class="helper-text">Upload inventory item images are not mandatory. But a better information</p>
                        </div>
                        <div class="form-group">
                            <input type="text"
                                name="estate_code"
                                class="input-field"
                                value="<?php echo htmlspecialchars($sessionUser['estate_code'] ?? ''); ?>"
                                readonly>
                        </div>
                        <button type="submit" class="btn-primary">Update Item</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>