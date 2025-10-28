<?php
include_once './database/connection.php';
include_once './services/incidentService.php';
include_once './services/inventoryService.php';
include_once './services/auth.php';
include_once __DIR__ . '/services/userService.php';
?>

<?php
$sessionUser = getSessionUser();
if (!$sessionUser) {
    header('Location: index.php');
    exit;
}

$isManager = str_ends_with($sessionUser['role'], 'manager');

// get search parameters
$id = $_GET['id'] ?? null;
$incident_code = $_GET['incident_code'] ?? null;



// Get incident by ID
$response = getIncidentByCode($conn, $incident_code);
if (!$response['success']) {
    header('Location: incidents.php');
    exit;
}

$incident = $response['data'];
if ($isManager) {
    $response = getUserById($conn, $incident['user_id']);
    $incidentUser = $response['data'];

    $userInitials = substr($incidentUser['first_name'], 0, 1) . substr($incidentUser['last_name'], 0, 1);
} else {
    $userInitials = substr($sessionUser['first_name'], 0, 1) . substr($sessionUser['last_name'], 0, 1);
}

// Get inventory item by inventory id
$response = getInventoryItemById($conn, $incident['inventory_id']);
$inventoryItemName = $response['data']['name'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Incident</title>
    <?php include_once './shared/links.php' ?>
    <?php include_once './shared/functions.php' ?>
</head>

<body>
    <section class="base">
        <?= include_once './components/secondaryHeader.php'; ?>
        <div class="main-content">
            <div class="container">
                <div class="px-16 w-full">
                    <div class="title-section-wrapper">
                        <div class="profile-section">
                            <div class="created-by">
                                <div class="avatar">
                                    <?= htmlspecialchars($userInitials) ?>
                                </div>
                                <?php if ($isManager) { ?>
                                    <span class="first-name">
                                        <?= htmlspecialchars($incidentUser['first_name']) ?>
                                    </span>
                                    <span class="first-name">
                                        <?= htmlspecialchars($incidentUser['last_name']) ?>
                                    </span>
                                <?php } ?>
                            </div>
                            <div class="profile-information-tab">
                                <?php if (!$isManager) { ?>
                                    <span class="first-name">
                                        <?= htmlspecialchars($sessionUser['first_name']) ?>
                                    </span>
                                    <span class="first-name">
                                        <?= htmlspecialchars($sessionUser['last_name']) ?>
                                    </span>
                                <?php } ?>

                                <div class="profile-info-wrapper">
                                    <span class="badge badge-priority">
                                        <?= htmlspecialchars($incident['priority']) ?>
                                    </span>
                                    <span class="badge badge-estate">
                                        <?= htmlspecialchars($incident['estate_code']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="title-row">
                            <span class="badge">Incident No: <?= htmlspecialchars($incident_code) ?></span>
                        </div>
                    </div>

                    <section class="title-wrapper">
                        <h1 class="page-title mb-0">
                            <?= htmlspecialchars($incident['title']) ?>
                        </h1>
                        <div class="badge-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hard-drive-icon lucide-hard-drive">
                                <line x1="22" x2="2" y1="12" y2="12" />
                                <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z" />
                                <line x1="6" x2="6.01" y1="16" y2="16" />
                                <line x1="10" x2="10.01" y1="16" y2="16" />
                            </svg>
                            <p class="text-sm"><?= htmlspecialchars($inventoryItemName) ?></p>
                        </div>
                    </section>

                    <?php
                    if ($incident['description'] !== null) { ?>
                        <div class="description-section mt-2">
                            <h2 class="description-title title-sm">Description</h2>
                            <p class="description-text">
                                <?= htmlspecialchars($incident['description']) ?>
                            </p>
                        </div>
                    <?php } ?>

                    <?php if (!$incident['image']) { ?>
                        <div class="image-placeholder">
                            <span class="image-placeholder-text">No image</span>
                        </div>
                    <?php } ?>

                    <?php if ($incident['image']) { ?>
                        <div class="image-placeholder-visible">
                            <img
                                src="data:image/jpeg;base64,<?php echo base64_encode($incident['image']); ?>"
                                alt="Inventory Item Image"
                                class="image-placeholder-image">
                        <?php } ?>
                        </div>
                        <div class="more-information activity-section">
                            <section>
                                <p>Assigned to:</p>
                                <h3><?= htmlspecialchars($incident['manager_email']) ?></h3>
                            </section>
                            <section>
                                <?php
                                if ($isManager && $sessionUser['estate_code'] === null) { ?>

                                <?php } else { ?>
                                    <button type="button" class="btn btn-success" onclick="openSheet()">
                                        View Activity
                                    </button>
                                <?php }
                                ?>
                            </section>
                            <?php include_once './components/drawer.php'; ?>
                        </div>
                </div>
                <?php
                if ($isManager && $sessionUser['estate_code'] === null) {
                    include_once './incidentEdit.php';
                }
                ?>
            </div>
        </div>

    </section>
</body>

</html>