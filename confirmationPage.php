<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Request has been submitted</title>
    <?php include_once './shared/links.php'; ?>
    <?php include_once './shared/functions.php'; ?>
</head>

<body>
    <section class="base">
        <main class="main-content flex-box">
            <div class="mobile-container">
                <div class="px-16 w-full">
                    <div>
                        <div class="card">
                            <p class="app-name">iTracker</p>
                            <h1 class="heading">Your Request has been Sent</h1>
                            <p class="description">If you are willing to use this system. You have to request your access to system admin for a profile creation</p>
                            <div class="button-wrapper">
                                <button type="button" class="btn btn-primary" onclick="navigateParent('index.php')">Back to homepage</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
</body>

</html>