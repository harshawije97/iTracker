<?php include_once './services/auth.php'; ?>

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
    <link rel="stylesheet" href="./public/style.css">
    <script src="./public/js/main.js" defer></script>
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
                        <div class="card-number">10</div>
                    </div>
                    <div class="ticket-card opened">
                        <div class="card-label">Opened</div>
                        <div class="card-number">10</div>
                    </div>
                    <div class="ticket-card processing">
                        <div class="card-label">Processing</div>
                        <div class="card-number">10</div>
                    </div>
                    <div class="ticket-card completed">
                        <div class="card-label">Completed</div>
                        <div class="card-number">10</div>
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
                    <div class="chart-container">
                        <div class="chart">
                            <div class="chart-bar">
                                <div class="bar-group">
                                    <div class="bar in-store" style="height: 80px;"></div>
                                    <div class="bar online" style="height: 60px;"></div>
                                </div>
                                <div class="chart-label">Jan</div>
                            </div>
                            <div class="chart-bar">
                                <div class="bar-group">
                                    <div class="bar in-store" style="height: 100px;"></div>
                                    <div class="bar online" style="height: 70px;"></div>
                                </div>
                                <div class="chart-label">Mar</div>
                            </div>
                            <div class="chart-bar">
                                <div class="bar-group">
                                    <div class="bar in-store" style="height: 120px;"></div>
                                    <div class="bar online" style="height: 85px;"></div>
                                </div>
                                <div class="chart-label">Apr</div>
                            </div>
                            <div class="chart-bar">
                                <div class="bar-group">
                                    <div class="bar in-store" style="height: 65px;"></div>
                                    <div class="bar online" style="height: 50px;"></div>
                                </div>
                                <div class="chart-label">May</div>
                            </div>
                            <div class="chart-bar">
                                <div class="bar-group">
                                    <div class="bar in-store" style="height: 95px;"></div>
                                    <div class="bar online" style="height: 75px;"></div>
                                </div>
                                <div class="chart-label">Jun</div>
                            </div>
                            <div class="chart-bar">
                                <div class="bar-group">
                                    <div class="bar in-store" style="height: 110px;"></div>
                                    <div class="bar online" style="height: 80px;"></div>
                                </div>
                                <div class="chart-label">Aug</div>
                            </div>
                            <div class="chart-bar">
                                <div class="bar-group">
                                    <div class="bar in-store" style="height: 55px;"></div>
                                    <div class="bar online" style="height: 40px;"></div>
                                </div>
                                <div class="chart-label">Sep</div>
                            </div>
                            <div class="chart-bar">
                                <div class="bar-group">
                                    <div class="bar in-store" style="height: 75px;"></div>
                                    <div class="bar online" style="height: 130px;"></div>
                                </div>
                                <div class="chart-label">Sep</div>
                            </div>
                            <div class="chart-bar">
                                <div class="bar-group">
                                    <div class="bar in-store" style="height: 90px;"></div>
                                    <div class="bar online" style="height: 65px;"></div>
                                </div>
                                <div class="chart-label">Oct</div>
                            </div>
                            <div class="chart-bar">
                                <div class="bar-group">
                                    <div class="bar in-store" style="height: 85px;"></div>
                                    <div class="bar online" style="height: 60px;"></div>
                                </div>
                                <div class="chart-label">Nov</div>
                            </div>
                        </div>

                        Legend
                        <div class="chart-legend">
                            <div class="legend-item">
                                <div class="legend-color in-store"></div>
                                <span>In-store</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color online"></div>
                                <span>Online</span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </section>
</body>

</html>