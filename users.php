<?php include_once './services/auth.php'; ?>
<?php include_once './services/userService.php'; ?>
<?php include_once './database/connection.php'; ?>

<?php

$sessionUser = getSessionUser();
if (!$sessionUser) {
    header('Location: index.php');
    exit;
}

// Get all users
$users = getAllUsers($conn, $sessionUser['user_id']);
$data = $users['data'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTracker - All Users</title>
    <?php include_once './shared/links.php' ?>
    <?php include_once './shared/functions.php' ?>
</head>

<body>
    <section class="base">
        <?php include_once './components/header.php'; ?>
        <div class="main-content">
            <div class="container">
                <div class="w-full">
                    <div class="page-header">
                        <p class="breadcrumb">Users</p>
                        <h2 class="page-title">All Users</h2>
                    </div>
                    <div class="search-filter-container">
                        <div class="search-box">
                            <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                            <input type="text" placeholder="Search items" class="search-input">
                        </div>
                    </div>
                    <!-- Registred Users -->
                    <section class="container-wrapper">
                        <h2 class="section-title" style="font-size: 1.25rem; margin-top: 2rem; margin-bottom: 1.5rem;">Registered</h2>
                        <?php
                        if (count($data) > 0) { ?>
                            <?php foreach ($data as $key => $value) { ?>
                                <?php
                                if ($value['is_registered']) { ?>
                                    <div class="user-card">
                                        <div class="card-header">
                                            <div class="user-info">
                                                <div class="avatar">FN</div>
                                                <div class="user-details">
                                                    <a href="./userEdit.php?id=<?= $value['id'] ?>">
                                                        <h3>
                                                            <?= htmlspecialchars($value['first_name'] . ' ' . $value['last_name']) ?>
                                                        </h3>
                                                    </a>
                                                    <p class="user-email">
                                                        <?= htmlspecialchars($value['email']) ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="date-time">
                                                <?= htmlspecialchars(date('Y-m-d', strtotime($value['created_at']))) ?>
                                            </div>
                                        </div>
                                        <div class="card-badges">
                                            <span class="badge badge-yellow">
                                                <?= htmlspecialchars($value['role']) ?>
                                            </span>
                                            <?php if ($value['estate_code']) { ?>
                                                <span class="badge badge-green">
                                                    <?= htmlspecialchars($value['estate_code']) ?>
                                                </span>
                                            <?php } else { ?>
                                                <span class="badge badge-secondary">
                                                    Head Office Management
                                                </span>
                                            <?php } ?>

                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </section>
                    <!-- Request Access -->
                    <section class="container-wrapper">
                        <div class="request-access-header">
                            <h2 class="request-access-title">Request Access</h2>

                        </div>

                        <?php
                        if (count($data) > 0) { ?>
                            <?php foreach ($data as $key => $value) { ?>
                                <?php
                                if (!$value['is_registered']) { ?>
                                    <div class="simple-card mt-6">
                                        <div class="simple-card-left">
                                            <a href="./user.php?id=<?= $value['id'] ?>">
                                                <h4>
                                                    <?= htmlspecialchars($value['first_name'] . ' ' . $value['last_name']) ?>
                                                </h4>
                                            </a>
                                            <p class="simple-card-email">
                                                <?= htmlspecialchars($value['email']) ?>
                                            </p>
                                        </div>
                                        <div class="simple-card-right">
                                            <div class="simple-card-date">
                                                <?= htmlspecialchars(date('Y-m-d', strtotime($value['created_at']))) ?>
                                            </div>
                                            <span class="simple-badge">
                                                <?= htmlspecialchars($value['role']) ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </section>
                </div>
            </div>
        </div>
    </section>
</body>

</html>