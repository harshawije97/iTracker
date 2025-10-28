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
    $data = $response['data'];
    // var_dump($data);

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
        <div class="activity-list">
            <!-- Activity Item 1 -->
            <div class="activity-item">
                <div class="timeline-dot"></div>
                <div class="activity-content">
                    <div class="activity-title">
                        <span>📋</span>
                        Created "Preline in React" task
                    </div>
                    <div class="activity-description">Find more detailed insctructions here.</div>
                    <div class="activity-user">
                        <div class="user-avatar">JC</div>
                        <span class="user-name">James Collins</span>
                    </div>
                </div>
            </div>

            <!-- Activity Item 2 -->
            <div class="activity-item">
                <div class="timeline-dot"></div>
                <div class="activity-content">
                    <div class="activity-title">
                        Release v5.2.0 quick bug fix <span class="activity-icon">🐛</span>
                    </div>
                    <div class="activity-user">
                        <div class="user-avatar" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">AG</div>
                        <span class="user-name">Alex Gregorov</span>
                    </div>
                </div>
            </div>

            <!-- Activity Item 3 -->
            <div class="activity-item">
                <div class="timeline-dot"></div>
                <div class="activity-content">
                    <div class="activity-title">
                        Marked "Install Charts" completed
                    </div>
                    <div class="activity-description">Finally! You can check it out here.</div>
                    <div class="activity-user">
                        <div class="user-avatar">JC</div>
                        <span class="user-name">James Collins</span>
                    </div>
                </div>
            </div>

            <!-- Activity Item 4 -->
            <div class="activity-item">
                <div class="timeline-dot"></div>
                <div class="activity-content">
                    <div class="activity-title">
                        Take a break <span class="activity-icon">🌴</span>
                    </div>
                    <div class="activity-description">Just chill for now... 😊</div>
                </div>
            </div>
        </div>
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