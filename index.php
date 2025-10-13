<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTracker - Sign In</title>
    <?php include_once './shared/links.php' ?>
</head>

<body>
    <?php
    include_once './services/auth.php'; ?>

    <?php
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $result = login($username, $password);

        if ($result['success']) {
            // Redirect after successful login
            echo "<script>
                    window.location.href = './dashboard.php';
                  </script>";
            exit;
        } else {
            $message = $result['message'];
        }
    }
    ?>
    <section class="base flex-container">
        <div class="login-container">
            <div class="app-name">iTracker</div>
            <h1 class="heading">Sign In</h1>
            <div class="error-message-container">
                <?php if (!empty($message)): ?>
                    <p class="error-message">
                        <?= htmlspecialchars($message) ?>
                    </p>
                <?php endif; ?>
            </div>
            <form method="POST">
                <div class="form-group">
                    <input
                        type="email"
                        class="input-field"
                        name="username"
                        id="username"
                        placeholder="Username"
                        required>
                </div>

                <div class="form-group">
                    <input
                        type="password"
                        class="input-field"
                        name="password"
                        id="password"
                        placeholder="Password"
                        required>
                </div>

                <button type="submit" class="continue-btn">Continue</button>
            </form>

            <div class="footer-text">
                Don't have an account? <a href="#">Request Access</a>
            </div>
        </div>
    </section>
</body>

</html>