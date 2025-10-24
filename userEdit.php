<!-- Session user -->
<!-- Get estate by estate code -->
<?php
include_once './database/connection.php';
include_once './services/auth.php';
include_once './services/userService.php';
include_once './services/estateService.php';
?>

<?php

$sessionUser = getSessionUser();
if (!$sessionUser) {
    header('Location: index.php');
    exit;
}

// get search parameters
$id = $_GET['id'] ?? null;
$response = getUserById($conn, $id);
$user = $response['data'];

// Get estate name by estate code
$estateResponse = getEstateByCode($conn, $user['estate_code']);
if ($estateResponse['success']) {
    $estate = $estateResponse['data'];
}

?>


<!-- Update user session -->
<?php
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'estate_code' => $_SESSION['estate_code'],
        'role' => $_SESSION['role'],
        'is_registered' => $_SESSION['is_registered']
    ];

    // Save the incident
    $response = updateRegisteredUserByUserID($conn, $id, $values);

    if ($response['success']) {
        $_SESSION['success_message'] = $response['message'];
        $successAndRedirect = true;
    } else {
        $_SESSION['error_message'] = $response['message'];
        $successAndRedirect = false;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
                        <p class="breadcrumb">User Profile</p>
                        <h2 class="page-title">Edit User Information</h2>
                    </div>

                    <form method="POST">
                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
                        <div class="form-group">
                            <input
                                type="text"
                                name="first_name"
                                class="form-input"
                                value="<?= htmlspecialchars($user['first_name']); ?>"
                                placeholder="First Name"
                                required>
                        </div>
                        <div class="form-group">
                            <input
                                type="text"
                                name="last_name"
                                class="form-input"
                                value="<?= htmlspecialchars($user['last_name']); ?>"
                                placeholder="Last Name"
                                required>
                        </div>

                        <div class="form-group">
                            <input
                                type="email"
                                name="email"
                                class="form-input"
                                value="<?= htmlspecialchars($user['email']); ?>"
                                placeholder="Email"
                                required>
                            <div class="helper-text">Email is a unique identifier</div>
                        </div>

                        <div class="form-group">
                            <input
                                type="text"
                                name="estate"
                                class="form-input"
                                placeholder="estate"
                                value="<?= $estate['estate_name'] ?>"
                                disabled readonly>
                        </div>

                        <div class="form-group">
                            <input
                                type="text"
                                name="userRole"
                                class="form-input"
                                placeholder="userRole"
                                value="<?= $_SESSION['role'] ?>"
                                disabled readonly>
                        </div>

                        <button type="submit" class="continue-btn">Update</button>
                    </form>
                </div>
            </div>
        </main>
    </section>
</body>

</html>