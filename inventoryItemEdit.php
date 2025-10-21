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
</body>

</html>