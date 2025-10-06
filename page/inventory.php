<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="../public/style.css">
</head>

<body>
    <section class="base">
        <?php include_once './components/header.php'; ?>
        <main class="main-content">
            <div class="page-header">
                <p class="breadcrumb">Inventory</p>
                <h2 class="page-title">All Inventory Items</h2>
            </div>
            <div class="search-filter-container">
                <div class="search-box">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" placeholder="Search items" class="search-input">
                </div>
                <button class="filter-btn">
                    Filter
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </div>
            <div class="incidents-list">
                <div class="incident-item">
                    <div class="incident-content">
                        <div class="incident-header">
                            <h3 class="incident-title">Item Name</h3>
                            <span class="incident-date">Date & Time</span>
                        </div>
                        <p class="incident-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi viverra ultricies augue,
                        </p>
                        <span class="status-badge">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                            </svg>
                            On Repair
                        </span>
                    </div>
                </div>
                <div class="incident-item">
                    <div class="incident-content">
                        <div class="incident-header">
                            <h3 class="incident-title">Item Name</h3>
                            <span class="incident-date">Date & Time</span>
                        </div>
                        <p class="incident-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi viverra ultricies augue,
                        </p>
                        <span class="status-badge">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                            </svg>
                            On Repair
                        </span>
                    </div>
                </div>
                <div class="incident-item">
                    <div class="incident-content">
                        <div class="incident-header">
                            <h3 class="incident-title">Item Name</h3>
                            <span class="incident-date">Date & Time</span>
                        </div>
                        <p class="incident-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi viverra ultricies augue,
                        </p>
                        <span class="status-badge">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                            </svg>
                            On Repair
                        </span>
                    </div>
                </div>
            </div>
            <a href="./newItem.php">
                <button type="button" class="fab">Add Item</button>
            </a>
        </main>
    </section>
</body>

</html>