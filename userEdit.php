<?php
include_once './services/auth.php';
include_once './services/userService.php';
include_once './database/connection.php';
?>

<?php

$sessionUser = getSessionUser();
if (!$sessionUser) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'] ?? null;

$response = getUserById($conn, $id);
$userInformation = $response['data'];

?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'user_id' => $userInformation['id']
    ];

    // Save the auth user
    $response = createAuthUser($conn, $values);

    if ($response['success']) {
        $_SESSION['success_message'] = $response['message'];
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $_SESSION['error_message'] = $response['message'];
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Action</title>
    <?php include_once './shared/links.php' ?>
    <?php include_once './shared/functions.php' ?>
</head>

<body>
    <?php include_once './components/sweetAlert.php'; ?>
    <section class="base">
        <?php include_once './components/secondaryHeader.php'; ?>
        <main class="main-content">
            <div class="container">
                <div class="px-16 w-full">
                    <div class="page-header">
                        <p class="breadcrumb">Request Access</p>
                        <h2 class="page-title">User Information</h2>
                    </div>
                    <section class="heading-wrapper">
                        <div class="page-header">
                            <p class="breadcrumb">Profile Information</p>
                        </div>
                        <div class="form-wrapper">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <div class="form-value">
                                    <?= htmlspecialchars($userInformation['first_name']) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <div class="form-value">
                                    <?= htmlspecialchars($userInformation['last_name']) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <div class="form-value">
                                    <?= htmlspecialchars($userInformation['email']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="subsection-label">Plantation specific information</div>
                        <!-- Estate Name -->
                        <div class="form-group">
                            <div class="form-value accent">
                                <?= htmlspecialchars($userInformation['estate_code']) ?>
                            </div>
                        </div>

                        <!-- User Role -->
                        <div class="form-group">
                            <div class="form-value">
                                <?= htmlspecialchars($userInformation['role']) ?>
                            </div>
                        </div>
                        <div class="button-group">
                            <button
                                type="button"
                                class="btn btn-accept"
                                onclick="acceptUser()">Accept</button>
                            <button class="btn btn-reject">Reject</button>
                        </div>
                    </section>

                    <div class="divider"></div>

                    <div class="password-section" id="password-section">
                        <h2 class="password-title">Create Password</h2>
                        <p class="password-description">Once the user logged in he/she have to change the Password to a new one</p>

                        <form method="POST">
                            <!-- Password Input -->
                            <input type="hidden" name="username" value="<?= $userInformation['email'] ?>">
                            <input type="hidden" name="userId" value="<?= $userInformation['id'] ?>">
                            <input type="text" class="form-input" name="password" placeholder="One time password">

                            <!-- Send Invitation Button -->

                            <button type="submit" class="continue-btn">Send Invitation</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </section>
</body>

</html>