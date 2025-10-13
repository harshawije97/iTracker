<?php include_once './services/auth.php'; ?>
<?php include_once './services/inventoryService.php'; ?>

<?php

$sessionUser = getSessionUser();
if (!$sessionUser) {
    header('Location: index.php');
    exit;
}

// Create CSRF token if not exit happens
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = [
        'serial_number' => $_POST['serial_number'],
        'name' => $_POST['name'],
        'category' => $_POST['category'],
        'description' => $_POST['description'] ?? null,
        // 'image' => $_FILES['image'] ?? null,
        'estate_code' => $_POST['estate_code']
    ];

    $response = saveInventoryItem($conn, $values);
    if ($response['success']) {
        $_SESSION['success_message'] = $result['message'];
        header('Location: ' . $_SERVER['PHP_SELF']); // Prevent the resubmission of the form
        exit;
    } else {
        $_SESSION['error_message'] = $response['message'];
        header('Location: ' . $_SERVER['PHP_SELF']); // Prevent the resubmission of the form
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Inventory Item</title>
    <?php include_once './shared/links.php' ?>
</head>

<body>
    <?php include_once './components/sweetAlert.php'; ?>
    <section class="base">
        <?php include_once './components/secondaryHeader.php'; ?>
        <div class="container">
            <div class="px-16 w-full">
                <div class="main-content">
                    <div class="title-section">
                        <div class="add-new">Add New</div>
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
                                placeholder="Serial Number (PC-1A23B4)"
                                required>
                        </div>

                        <div class="form-group">
                            <input
                                type="text"
                                name="name"
                                class="input-field"
                                placeholder="Name"
                                required>
                        </div>

                        <div class="form-group">
                            <select name="category" class="select-field" required>
                                <option disabled selected>Select Category</option>
                                <option value="laptop">Laptop</option>
                                <option value="desktop">Desktop PC</option>
                                <option value="printer">Printer</option>
                                <option value="scanner">Scanner</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea
                                name="description"
                                class="textarea-field input-field"
                                placeholder="Short Description (Optional)"
                                maxlength="255"></textarea>
                        </div>

                        <div class="upload-section">
                            <label class="upload-label">Upload Item images</label>
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
                        <button type="submit" class="btn-primary">Save Item</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.26.1/dist/sweetalert2.all.min.js
    "></script>
</body>

</html>