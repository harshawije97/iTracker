<?php ?>

<?php
$sessionUser = getSessionUser();
if (!$sessionUser) {
    header('Location: index.php');
    exit;
}

$isManager = str_ends_with($sessionUser['role'], 'manager');

// get search parameters
$id = $_GET['id'] ?? null;
$serial_number = $_GET['serial_number'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Incident</title>
    <?php include_once './shared/links.php' ?>
</head>

<body>
    <section class="base">
        <?= include_once './components/secondaryHeader.php'; ?>
        <div class="main-content">
            <div class="container">
                <div class="px-16 w-full">
                    <div class="title-section">
                        <div class="browse-text">Update</div>
                        <div class="title-row">
                            <span class="badge">Incident No: E12345</span>
                        </div>
                        <div class="profile-section">
                            <div class="created-by">
                                <div class="avatar">
                                    IE
                                </div>
                            </div>
                            <div class="profile-info">
                                <span class="first-name">First Name</span>
                                <span class="badge badge-priority">⚡ Priority</span>
                                <span class="badge badge-estate">Estate Name</span>
                            </div>
                        </div>
                    </div>

                    <section class="title-wrapper">
                        <h1 class="page-title mb-0">Title</h1>
                    </section>

                    <div class="description-section">
                        <h2 class="description-title">Description</h2>
                        <p class="description-text">
                            <?= htmlspecialchars($inventoryItem['description']) ?>
                        </p>
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
                </div>
                <?php
                if ($isManager && $sessionUser['estate_code'] === null) {
                    include_once './views/partial/incidentEdit.php';
                }
                ?>
            </div>
        </div>

    </section>
</body>

</html>