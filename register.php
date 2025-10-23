<?php
include_once './services/estateService.php';
include_once './database/connection.php';
include_once './services/auth.php';
?>

<?php
$response = getAllEstatesByParameters($conn, ['estate_code', 'estate_name']);
$estates = $response['data'];
?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'estate_code' => $_POST['estate_code'],
        'role' => $_POST['role'],
        'is_registered' => $_POST['is_registered'],
    ];

    // Register new user as a request accessed user
    $response = registerNewUser($conn, $values);

    if ($response['success']) {
        $_SESSION['success_message'] = $response['message'];
        echo "<script>
                window.location.href = './confirmationPage.php';
              </script>";
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
    <title>Register New User</title>
    <?php include_once './shared/links.php' ?>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #e8e8e8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: white;
            border-radius: 24px;
            padding: 48px 40px;
            max-width: 440px;
            width: 100%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .brand {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 16px;
            font-weight: 500;
        }

        .title {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            color: #000;
            margin-bottom: 16px;
        }

        .description {
            text-align: center;
            color: #374151;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 40px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .select-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: '';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #000;
            pointer-events: none;
        }

        .form-select {
            cursor: pointer;
            padding-right: 45px;
        }

        .helper-text {
            font-size: 13px;
            color: #6b7280;
            margin-top: 8px;
            margin-left: 4px;
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background-color: #10b981;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 16px;
        }

        .submit-btn:hover {
            background-color: #059669;
        }

        .footer-text {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #374151;
        }

        .footer-text a {
            color: #10b981;
            text-decoration: none;
            font-weight: 500;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .container {
                padding: 32px 24px;
            }

            .title {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <?php include_once './components/sweetAlert.php'; ?>
    <section class="base flex-container">
        <div class="login-container">
            <div class="brand">iTracker</div>
            <h1 class="title">Request Access</h1>
            <p class="description">
                If you are willing to use this system. You have to request your access to system admin for a profile creation
            </p>

            <form method="POST">
                <input type="hidden" name="is_registered" value="0">
                <div class="form-group">
                    <input type="text" name="first_name" class="form-input" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <input type="text" name="last_name" class="form-input" placeholder="Last Name" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" class="form-input" placeholder="Email" required>
                    <div class="helper-text">Your email is your username for login to the system</div>
                </div>

                <div class="form-group">
                    <div class="select-wrapper">
                        <select name="estate_code" class="form-select" required>
                            <option selected disabled>Select Estate</option>
                            <?php foreach ($estates as $estate) { ?>
                                <option value="<?= $estate['estate_code'] ?>"><?= $estate['estate_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="select-wrapper">
                        <select name="role" class="form-select" required>
                            <option selected disabled>Select User Role</option>
                            <option value="chief-clerk">Chief Clerk</option>
                            <option value="estate-manager">Estate Manager</option>
                            <option value="it-manager">IT Manager</option>
                            <option value="assistant-it-manager">Assistant IT Manager</option>
                            <option value="it-admin">IT Admin</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Continue</button>
            </form>

            <div class="footer-text">
                Already have an account ? <a href="./index.php">Sign In here</a>
            </div>
        </div>
    </section>
</body>

</html>