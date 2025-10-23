<?php include_once './services/auth.php'; ?>

<?php

$sessionUser = getSessionUser();
if (!$sessionUser) {
    header('Location: index.php');
    exit;
}

// Get all tickets

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
                <!-- Page Title -->
                <div class="page-title">
                    <div class="breadcrumb">Dashboard</div>
                    <h1 class="page-heading">All Tickets</h1>
                </div>

                <!-- Ticket Cards -->
                <div class="cards-grid">
                    <div class="ticket-card all-tickets">
                        <div class="card-label">All Tickets</div>
                        <div class="card-number">0</div>
                    </div>
                    <div class="ticket-card opened">
                        <div class="card-label">Opened</div>
                        <div class="card-number">0</div>
                    </div>
                    <div class="ticket-card processing">
                        <div class="card-label">Processing</div>
                        <div class="card-number">0</div>
                    </div>
                    <div class="ticket-card completed">
                        <div class="card-label">Completed</div>
                        <div class="card-number">0</div>
                    </div>
                </div>
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