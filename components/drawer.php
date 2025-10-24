<?php
include_once './services/auth.php';
include_once './services/incidentProcessService.php';
?>

<?php
// get search parameters
$id = $_GET['id'] ?? null;
$incident_code = $_GET['incident_code'] ?? null;
$serial_number = $_GET['serial_number'] ?? null;

if ($incident_code) {
    $response = getIncidentHistoryById($conn, $id);

    if ($response['success']) {
        $incidentHistory = $response['data'];
    }
}
?>


<div class="sheet-overlay" id="sheetOverlay" onclick="closeSheet()"></div>

<div class="sheet" id="sheet">
    <!-- Sheet Header -->
    <div class="sheet-header">
        <div>
            <?php
            if ($incident_code) { ?>
                <h2 class="sheet-title">Incident History</h2>
                <p class="sheet-description">Browse Incident History</p>
            <?php }
            ?>
        </div>
        <button class="sheet-close" onclick="closeSheet()" aria-label="Close sheet">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <!-- Sheet Content -->
    <div class="sheet-content">
        <?php if (count($incidentHistory) > 0) { ?>
            <div class="incident-history">
                <ul>
                    <?php
                    foreach ($incidentHistory as $incident) {
                        echo '<li>';
                        echo '<a href="./incident.php?id=' . $incident['id'] . '&incident_code=' . $incident['incident_code'] . '" class="hover-underline">';
                        echo '<h3 class="incident-title-sm">' . htmlspecialchars($incident['title']) . '</h3>';
                        echo '<span class="incident-date">' . htmlspecialchars(date('Y-m-d', strtotime($incident['created_at']))) . '</span>';
                        echo '</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
        <?php } else { ?>
            <div class='empty-items-container'>
                <p class='color-gray'>
                    No Incident History
                </p>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    function openSheet() {
        const sheet = document.getElementById('sheet');
        const overlay = document.getElementById('sheetOverlay');
        sheet.classList.add('open');
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeSheet() {
        const sheet = document.getElementById('sheet');
        const overlay = document.getElementById('sheetOverlay');
        sheet.classList.remove('open');
        overlay.classList.remove('open');
        document.body.style.overflow = 'auto';
    }

    function saveChanges() {
        alert('Changes saved!');
        closeSheet();
    }
</script>