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
    <style>
        .header-title {
            font-size: 1.5rem;
            font-weight: 600;
            flex: 1;
            text-align: center;
        }

        /* Main Container */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        /* Section Header */
        .section-label {
            font-size: 0.875rem;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        /* Search Bar */
        .search-container {
            position: relative;
            margin-bottom: 2.5rem;
        }

        .search-bar {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.75rem;
            border: none;
            border-radius: 50px;
            background-color: #e8e8e8;
            font-size: 1rem;
            color: #666;
        }

        .search-bar::placeholder {
            color: #999;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 1.25rem;
        }

        /* Registered Section */
        .registered-section {
            margin-bottom: 3rem;
        }

        .user-card {
            border: 2px solid #333;
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            background-color: white;
            position: relative;
        }

        .card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .user-info {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            flex: 1;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #1a7d5c;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .user-details h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .user-email {
            font-size: 0.875rem;
            color: #999;
        }

        .date-time {
            font-size: 0.75rem;
            color: #666;
            font-weight: 500;
        }

        .card-badges {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .badge {
            padding: 0.375rem 0.875rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-yellow {
            background-color: #ffd966;
            color: #333;
        }

        .badge-green {
            background-color: #a8d5ba;
            color: #333;
        }
    </style>
</head>

<body>
    <section class="base">
        <?php include_once './components/header.php'; ?>
        <div class="container">
            <div class="px-16 w-full">
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
                                        <span class="badge badge-green">
                                            <?= htmlspecialchars($value['estate_code']) ?>
                                        </span>
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
    </section>
</body>

</html>