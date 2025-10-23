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
    <title>Users</title>
    <?php include_once './shared/links.php' ?>
    <?php include_once './shared/functions.php' ?>
</head>

<body>
    <section class="base">
        <?php include_once './components/header.php'; ?>
        <main class="main-content">
            <div class="container">
                <div class="px-16 w-full">
                    <div class="page-header">
                        <p class="breadcrumb">Users</p>
                        <h2 class="page-title">All Users Registered on iTracker</h2>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 40px;"><input type="checkbox"></th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th style="width: 60px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $user) { ?>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <div class="name-cell">
                                                <div class="avatar" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">CB</div>
                                                <div class="name-info">
                                                    <strong>
                                                        <?= htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']) ?>
                                                    </strong>
                                                    <span class="email">
                                                        <?= htmlspecialchars($user['email']) ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="position-cell">
                                                <strong><?= htmlspecialchars($user['role']) ?></strong>
                                                <span class="department">Human resources</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="status-badge status-active">
                                                <?php
                                                if ($user['is_registered']) { ?>
                                                    <span class="status-icon">✓</span>
                                                    Active
                                                <?php } ?>
                                            </span>

                                        </td>
                                        <td class="date-cell">
                                            <?php echo date('d M Y', strtotime($user['created_at'])) ?>
                                        </td>
                                        <td>
                                            <?php if (!$user['is_registered']) { ?>
                                                <a href="./userEdit.php?view=admin&action=approval&id=<?= $user['id'] ?>"
                                                    class="edit-link">Edit</a>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </section>
</body>

</html>