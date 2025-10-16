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
    <title>iTracker - Incidents</title>
    <?php include_once './shared/links.php' ?>
</head>

<body>
    <section class="base">
        <?php include_once './components/header.php'; ?>
        <main class="main-content">
            <div class="container">
                <div class="px-16 w-full">
                    <div class="page-header">
                        <p class="breadcrumb">Incidents</p>
                        <h2 class="page-title">All Incidents</h2>
                    </div>
                    <div class="search-filter-container">
                        <div class="search-box">
                            <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                            <input type="text" placeholder="Search items" class="search-input">
                        </div>
                        <select class="filter-btn">
                            Filter
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </select>
                    </div>
                    <?php include_once './components/incidentList.php'; ?>
                    <a href="./newIncident.php">
                        <button type="button" class="fab">Add Incident</button>
                    </a>
                </div>
            </div>
        </main>
    </section>
</body>

</html>