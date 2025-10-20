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
                        <p class="breadcrumb">User</p>
                        <h2 class="page-title">User Info</h2>
                    </div>
                    <section class="heading-wrapper">
                        <div class="page-header">
                            <p class="breadcrumb">Profile Information</p>
                        </div>
                        <div class="form-wrapper">
                            <form>
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input
                                        type="text"
                                        name="first_name"
                                        class="form-input"
                                        value="">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input
                                        type="text"
                                        name="last_name"
                                        class="form-input"
                                        value=""
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-input" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <input type="text" name="role" class="form-input" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="estate_code">Estate</label>
                                    <input type="text"
                                        name="estate_code"
                                        class="form-input"
                                        value="">
                                </div>
                            </form>
                        </div>
                    </section>
                    <section>
                        <div class="page-header">
                            <p class="breadcrumb">Profile Approval</p>
                        </div>
                        <form action="POST">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" name="role" class="form-input" value="" disabled>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </main>
    </section>
</body>

</html>