<?php include_once './database/connection.php'; ?>
<?php include_once './services/auth.php'; ?>
<?php include_once './services//inventoryService.php'; ?>

<?php

$sessionUser = getSessionUser();
if (!$sessionUser) {
    header('Location: index.php');
    exit;
}

// get search parameters
$id = $_GET['id'] ?? null;
$serial_number = $_GET['serial_number'] ?? null;

// get inventory item by inventory id
$response = getInventoryItemById($conn, $id);
if (!$response) {
    header('Location: inventory.php');
    exit;
}
$inventoryItem = $response['data'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Item</title>
    <?php include_once './shared/links.php' ?>
</head>

<body>
    <section class="base">
        <?php include_once './components/secondaryHeader.php'; ?>
        <main class="container">
            <div class="px-16 w-full">
                <div class="title-section">
                    <div class="browse-text">Browse</div>
                    <div class="title-row">
                        <section class="title-wrapper">
                            <h1 class="page-title mb-0"><?= htmlspecialchars($inventoryItem['name']) ?></h1>
                            <span class="badge-yellow">Category: <?= htmlspecialchars($inventoryItem['category']) ?></span>
                        </section>
                        <span class="badge"><?= htmlspecialchars($serial_number) ?></span>
                    </div>
                </div>

                <?php if (!$inventoryItem['image']) { ?>
                    <div class="image-placeholder">
                        <span class="image-placeholder-text">No image</span>
                    </div>
                <?php } ?>

                <?php if ($inventoryItem['image']) { ?>
                    <div class="image-placeholder-visible">
                        <img
                            src="data:image/jpeg;base64,<?php echo base64_encode($inventoryItem['image']); ?>"
                            alt="Inventory Item Image"
                            class="image-placeholder-image">
                    <?php } ?>
                    </div>

                    <div class="metadata">
                        <div class="metadata-item">
                            <span class="metadata-label">Estate: <?= htmlspecialchars($inventoryItem['estate_code']) ?></span>
                        </div>
                        <div class="metadata-item">
                            <span class="metadata-label black"><?= htmlspecialchars($inventoryItem['item_status']) ?></span>
                        </div>
                        <div class="created-by">
                            <div class="avatar">
                                IE
                            </div>
                            <span class="created-by-text">Created By</span>
                        </div>
                    </div>

                    <div class="description-section">
                        <h2 class="description-title">Description</h2>
                        <p class="description-text">
                            <?= htmlspecialchars($inventoryItem['description']) ?>
                        </p>
                    </div>
            </div>
        </main>
    </section>
</body>

</html>