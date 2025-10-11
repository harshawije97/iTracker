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
    <link rel="stylesheet" href="../public/style.css">
</head>

<body>
    <nav class="header">
        <button type="button" class="icon-button" onclick="history.back()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left">
                <path d="m12 19-7-7 7-7" />
                <path d="M19 12H5" />
            </svg>
        </button>
        <button class="icon-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings-icon lucide-settings">
                <path d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915" />
                <circle cx="12" cy="12" r="3" />
            </svg>
        </button>
    </nav>
    <section class="main-content">
        <div class="title-section">
            <div class="add-new">Add New</div>
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <h1 class="main-title">Incident</h1>
                <span class="auto-id-badge">Incident Auto ID</span>
            </div>
        </div>
        <form>
            <div class="form-group">
                <input type="text" class="input-field" placeholder="Title">
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
</body>

</html>