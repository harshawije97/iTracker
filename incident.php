<?php
include_once './database/connection.php';
include_once './services/incidentService.php';
include_once './services/auth.php'
?>

<?php
$sessionUser = getSessionUser();
if (!$sessionUser) {
    header('Location: index.php');
    exit;
}

$isManager = str_ends_with($sessionUser['role'], 'manager');
// var_dump($sessionUser['role']);

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
// var_dump($incident);
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
                            <span class="badge">Incident No: <?= htmlspecialchars($incident_code) ?></span>
                        </div>
                        <div class="profile-section">
                            <div class="created-by">
                                <div class="avatar">
                                    IE
                                </div>
                            </div>
                            <div class="profile-info">
                                <span class="first-name">First Name</span>
                                <span class="badge badge-priority">
                                    <?= htmlspecialchars($incident['priority']) ?>
                                </span>
                                <span class="badge badge-estate">
                                    <?= htmlspecialchars($incident['estate_code']) ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <section class="title-wrapper">
                        <h1 class="page-title mb-0">
                            <?= htmlspecialchars($incident['title']) ?>
                        </h1>
                    </section>

                    <div class="description-section">
                        <h2 class="description-title">Description</h2>
                        <p class="description-text">
                            <?= htmlspecialchars($incident['description']) ?>
                        </p>
                    </div>

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
                                <button type="button" class="btn btn-success">
                                    View Activity
                                </button>
                            </section>
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