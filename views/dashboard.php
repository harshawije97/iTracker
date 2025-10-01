<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTracker - Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0 auto;
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background-color: #fff;
        }

        .menu-icon,
        .user-icon {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .menu-icon svg,
        .user-icon svg {
            width: 100%;
            height: 100%;
        }

        .logo {
            font-size: 20px;
            font-weight: 600;
            color: #000;
        }

        /* Main Content */
        .main-content {
            padding: 24px 20px;
        }

        .page-title {
            margin-bottom: 24px;
        }

        .breadcrumb {
            font-size: 14px;
            color: #888;
            margin-bottom: 4px;
        }

        .page-heading {
            font-size: 28px;
            font-weight: 700;
            color: #000;
        }

        /* Ticket Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 32px;
        }

        .ticket-card {
            border-radius: 20px;
            padding: 32px 20px;
            text-align: center;
            border: 2px dashed;
            min-height: 160px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .ticket-card.all-tickets {
            background-color: #d4f5f5;
            border-color: #5dd9d9;
        }

        .ticket-card.opened {
            background-color: #f5f5f5;
            border-color: #d0d0d0;
        }

        .ticket-card.processing {
            background-color: #fff9d4;
            border-color: #ffd966;
        }

        .ticket-card.completed {
            background-color: #d4f5e5;
            border-color: #5dd99d;
        }

        .card-label {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .ticket-card.all-tickets .card-label {
            color: #00b8b8;
        }

        .ticket-card.opened .card-label {
            color: #888;
        }

        .ticket-card.processing .card-label {
            color: #f5a623;
        }

        .ticket-card.completed .card-label {
            color: #00c853;
        }

        .card-number {
            font-size: 48px;
            font-weight: 700;
        }

        .ticket-card.all-tickets .card-number {
            color: #00d4d4;
        }

        .ticket-card.opened .card-number {
            color: #b0b0b0;
        }

        .ticket-card.processing .card-number {
            color: #ffc107;
        }

        .ticket-card.completed .card-number {
            color: #00e676;
        }

        /* Summary Section */
        .summary-section {
            border-top: 1px solid #ddd;
            padding-top: 24px;
        }

        .summary-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .summary-title {
            font-size: 22px;
            font-weight: 700;
            color: #000;
        }

        .date-select {
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            font-size: 14px;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 8px center;
            padding-right: 32px;
        }

        /* Chart */
        .chart-container {
            background-color: #fff;
            border-radius: 16px;
            padding: 24px 16px;
            border: 1px solid #e0e0e0;
        }

        .chart {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            height: 180px;
            margin-bottom: 16px;
            gap: 8px;
        }

        .chart-bar {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .bar-group {
            display: flex;
            gap: 2px;
            align-items: flex-end;
            width: 100%;
            justify-content: center;
        }

        .bar {
            width: 8px;
            border-radius: 4px 4px 0 0;
        }

        .bar.in-store {
            background-color: #00c853;
        }

        .bar.online {
            background-color: #b2dfb2;
        }

        .chart-label {
            font-size: 11px;
            color: #888;
            margin-top: 8px;
        }

        /* Legend */
        .chart-legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            font-size: 12px;
            color: #666;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 2px;
        }

        .legend-color.in-store {
            background-color: #00c853;
        }

        .legend-color.online {
            background-color: #b2dfb2;
        }
    </style>
</head>

<body>
    <header class="header sm:hidden">
        <div class="menu-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </div>
        <div class="logo">iTracker</div>
        <div class="user-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"></path>
            </svg>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
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

        Summary Section
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

            Chart
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
    </main>
</body>

</html>