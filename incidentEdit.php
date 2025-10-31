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

// get search parameters
$id = $_GET['id'] ?? null;
$incident_code = $_GET['incident_code'] ?? null;

// Get incident by ID
$response = getIncidentStatus($conn, $id);
$incident_status = $response['data'];


if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = [
        'incident_id' => $id,
        'status' => $_POST['status'],
        'description' => $_POST['description'] ?? null,
        'image' => $_FILES['image'] ?? null,
        'user_id' => $sessionUser['user_id']
    ];

    // Update the incident
    $response = updateIncident($conn, $values);

    if ($response['success']) {
        $_SESSION['success_message'] = $response['message'];
    } else {
        $_SESSION['error_message'] = $response['message'];
    }
}

?>

<?php include_once './components/sweetAlert.php'; ?>

<div class="incident-edit-wrapper mt-20">
    <div class="container">
        <h1 class="title">Update Process</h1>

        <form method="POST" enctype="multipart/form-data" id="incidentUpdateForm">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <div class="form-group mt-20">
                <?php if ($incident_status) { ?>
                    <select class="priority-dropdown" name="status" required>
                        <option value="">Select Status</option>
                        <?php
                        $statuses = ['Opened', 'In Progress', 'Resolved'];
                        foreach ($statuses as $status) {
                            $selected = ($incident_status == $status) ? 'selected' : '';
                            echo "<option value='$status' $selected>$status</option>";
                        }
                        ?>
                    </select>
                <?php } else { ?>
                    <select class="priority-dropdown" name="status" required>
                        <option value="">Select Status</option>
                        <option value="Opened">Opened</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Resolved">Resolved</option>
                    </select>
                <?php } ?>
            </div>

            <div class="divider"></div>

            <div class="comments-header">
                <h2 class="comments-title mb-3">Comments</h2>
                <?php
                if ($incident_status) { ?>
                    <div class="comments-actions">
                        <button type="button" class="btn btn-secondary" onclick="openSheet()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-gantt-icon lucide-chart-no-axes-gantt">
                                <path d="M6 5h12" />
                                <path d="M4 12h10" />
                                <path d="M12 19h8" />
                            </svg>
                            View Activity
                        </button>
                    </div>
                <?php } ?>
            </div>

            <div class="form-group">
                <textarea
                    class="textarea-field input-field"
                    name="description"
                    placeholder="Add your comments here..."
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
                <p class="helper-text">Upload evidences are not mandatory. But a better usage for future endevours</p>
            </div>
            <button type="submit" class="btn-primary">Update & Continue</button>
        </form>
    </div>

</div>