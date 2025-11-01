<?php
include_once './database/connection.php';
include_once './services/incidentService.php';
include_once './services/auth.php';
include_once './services/constants/enums.php';
include_once __DIR__ . '/../services/constants/enums.php';
?>

<?php
$sessionUser = getSessionUser();
$isManager = str_ends_with($sessionUser['role'], 'manager');

if ($isManager) {
    $response = $sessionUser['estate_code'] === null
        ? getAllIncidents($conn, $sessionUser['username'])
        : getIncidentsByEstateCode($conn, $sessionUser['estate_code']);
} else {
    $response = getIncidentsByUserId($conn, $sessionUser['user_id']);
}

?>

<div class="incidents-list">
    <?php if ($response['success'] && !empty($response['data'])) { ?>
        <?php foreach ($response['data'] as $incident) { ?>
            <div class="incident-item">
                <div class="incident-content">
                    <div class="incident-header">
                        <a href="./incident.php?id=<?= $incident['id'] ?>&incident_code=<?= $incident['incident_code'] ?>" class="hover-underline">
                            <h3 class="incident-title-sm">
                                <?= htmlspecialchars($incident['title']) ?>
                                <?php
                                $status = getIncidentStatusByIncidentId($conn, $incident['id']);
                                $latestStatus = $status['data'][0]['status'];

                                if ($latestStatus == IncidentStatus::RESOLVED->value) { ?>
                                    <span class="svg-green ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-badge-check-icon lucide-badge-check">
                                            <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                                            <path d="m9 12 2 2 4-4" />
                                        </svg>
                                    </span>
                                <?php } else { ?>
                                    <span class="status ml-2">
                                        <?= htmlspecialchars($latestStatus) ?>
                                    </span>
                                <?php }
                                ?>
                            </h3>
                        </a>

                        <span class="incident-date">
                            <?= htmlspecialchars(date('Y-m-d', strtotime($incident['created_at']))) ?>
                        </span>
                    </div>
                    <?php
                    if ($isManager) { ?>
                        <p class="incident-description">
                            Created By: <?= htmlspecialchars($incident['user_first_name'] . ' ' . $incident['user_last_name']) ?>
                        </p>
                    <?php } else { ?>
                        <p class="incident-description">
                            <?= htmlspecialchars($incident['description']) ?>
                        </p>
                    <?php }
                    ?>
                    <div class="incident-footer">
                        <?php
                        if ($incident['priority'] == IncidentPriority::LOW->value) { ?>
                            <span class="status-badge">
                                <?= htmlspecialchars($incident['priority']) ?>
                            </span>
                        <?php } ?>
                        <?php
                        if ($incident['priority'] == IncidentPriority::MODERATE->value) { ?>
                            <span class="status-badge badge-moderate">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-column-increasing-icon lucide-chart-no-axes-column-increasing">
                                    <path d="M5 21v-6" />
                                    <path d="M12 21V9" />
                                    <path d="M19 21V3" />
                                </svg>
                                <?= htmlspecialchars($incident['priority']) ?>
                            </span>
                        <?php } ?>

                        <?php
                        if ($incident['priority'] == IncidentPriority::HIGH->value) { ?>
                            <span class="status-badge badge-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert-icon lucide-triangle-alert">
                                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3" />
                                    <path d="M12 9v4" />
                                    <path d="M12 17h.01" />
                                </svg>
                                <?= htmlspecialchars($incident['priority']) ?>
                            </span>
                        <?php } ?>
                        <?php
                        if ($isManager) { ?>
                            <div class="status-badge-green">
                                Estate Code
                                <?= htmlspecialchars($incident['estate_code']); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class='empty-items-container'>
            <p class='color-gray'>Incidents are empty</p>
        </div>
    <?php } ?>
</div>