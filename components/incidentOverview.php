<?php
include_once __DIR__ . '/../services/auth.php';
include_once __DIR__ . '/../database/connection.php';
include_once __DIR__ . '/../services/incidentService.php'; ?>

<?php

$sessionUser = getSessionUser();

$isManager = str_ends_with($sessionUser['role'], 'manager');
$isEstate = $sessionUser['estate_code'] !== null;

?>

<!-- Page Title -->
<div class="flex-between">
    <div class="page-title">
        <div class="breadcrumb">Dashboard</div>
        <h1 class="page-heading">All Incidents</h1>
    </div>
    <select class="date-select" id="incidentFilter">
        <option value="">Filter</option>
        <option value="all">All</option>
        <option value="<?= htmlspecialchars($sessionUser['username']) ?>">Assigned to me</option>
        <!-- <option>Last 3 Months</option>
                    <option>Last Year</option> -->
    </select>
</div>

<!-- Ticket Cards -->
<div class="cards-grid">
    <div class="ticket-card all-tickets">
        <div class="card-label">All Tickets</div>
        <div class="card-number">
            0
        </div>
    </div>
    <div class="ticket-card opened">
        <div class="card-label">Opened</div>
        <div class="card-number">
            0
        </div>
    </div>
    <div class="ticket-card processing">
        <div class="card-label">Processing</div>
        <div class="card-number">
            0
        </div>
    </div>
    <div class="ticket-card completed">
        <div class="card-label">Completed</div>
        <div class="card-number">0</div>
    </div>
</div>