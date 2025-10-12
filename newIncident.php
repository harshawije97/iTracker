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
    <title>New Incident</title>
    <link rel="stylesheet" href="./public/style.css ">
</head>

<body>
    <div class="base">
        <?php include_once './components/secondaryHeader.php'; ?>
        <div class="container">
            <div class="px-16 w-full">
                <section class="main-content">
                    <div class="title-section">
                        <div class="add-new">Add New</div>
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <h1 class="main-title">Incident</h1>
                            <span class="auto-id-badge">Incident Auto ID</span>
                        </div>
                    </div>
                    <form method="POST">
                        <div class="form-group">
                            <input type="text" class="input-field" name="title" placeholder="Title">
                        </div>

                        <div class="form-group">
                            <select class="select-field">
                                <option>Select Inventory Item</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea class="textarea-field input-field" placeholder="Short Description (Optional)"></textarea>
                        </div>

                        <div class="upload-section">
                            <label class="upload-label">Upload reference images</label>
                            <button type="button" class="upload-button">
                                <svg class="upload-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12" />
                                </svg>
                                Upload Images
                            </button>
                            <p class="helper-text">Upload incident events are not mandatory. But a better usage for future endevours</p>
                        </div>

                        <div class="form-group">
                            <select class="priority-dropdown">
                                <option>Priority</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="select-field">
                                <option>Assign Manager</option>
                            </select>
                        </div>

                        <button type="submit" class="btn-primary">Save Incident</button>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <script>
        function navigateBack() {
            window.history.back();
        }

        function settingsClicked() {
            alert("Settings clicked!");
        }
    </script>
</body>

</html>