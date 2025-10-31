<?php
include_once './services/auth.php';
include_once './database/connection.php';
include_once './services/incidentService.php'; ?>

<?php

$sessionUser = getSessionUser();
if (!$sessionUser) {
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTracker - Dashboard</title>
    <?php include_once './shared/links.php'; ?>
    <?php include_once './shared/functions.php'; ?>
</head>

<body>
    <section class="base">
        <?php include_once './components/header.php'; ?>

        <!-- Main Content -->
        <main class="container">
            <div class="px-16 w-full">
                <?php include_once __DIR__ . '/components/incidentOverview.php' ?>
                <section class="summary-section">
                    <div class="summary-header">
                        <h2 class="summary-title">Summary</h2>
                        <select class="date-select">
                            <option>Select Date</option>
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                            <option>Last 3 Months</option>
                            <option>Last Year</option>
                        </select>
                    </div>
                    <?php include_once './components/chartDashboard.php'; ?>
                </section>
            </div>
        </main>
    </section>
</body>

</html>