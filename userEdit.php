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
    <title>User - Action</title>
    <?php include_once './shared/links.php' ?>
    <?php include_once './shared/functions.php' ?>
</head>

<body>
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
                                <div class="form-value">First Name</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <div class="form-value">Last Name</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <div class="form-value">Email Address</div>
                            </div>
                        </div>
                        <div class="subsection-label">Plantation specific information</div>
                        <!-- Estate Name -->
                        <div class="form-group">
                            <div class="form-value accent">Estate Name</div>
                        </div>

                        <!-- User Role -->
                        <div class="form-group">
                            <div class="form-value">User Role</div>
                        </div>
                        <div class="button-group">
                            <button
                                type="button"
                                class="btn btn-accept"
                                onclick="()=>console.log('Working')">Accept</button>
                            <button class="btn btn-reject">Reject</button>
                        </div>
                    </section>

                    <div class="divider"></div>

                    <div class="password-section" id="password-section">
                        <h2 class="password-title">Create Password</h2>
                        <p class="password-description">Once the user logged in he/she have to change the Password to a new one</p>

                        <!-- Password Input -->
                        <input type="text" class="form-input" placeholder="One time password">

                        <!-- Send Invitation Button -->
                        <button class="btn-full">Send Invitation</button>
                    </div>
                </div>
            </div>
        </main>
    </section>
</body>

</html>