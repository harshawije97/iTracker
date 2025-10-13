<?php include_once './services/auth.php'; ?>

<?php

$message = $_SESSION['success_message'];

?>


<div class="toast-position toast-visible">
    <div class="toast" role="status" aria-live="polite">
        <div class="toast-content">
            <div class="toast-title"><?= htmlspecialchars($message); ?></div>
            <div class="toast-description">Sunday, December 03, 2023 at 9:00 AM</div>
        </div>
        <div class="toast-action">
            <button class="undo-button" type="button" onclick="closeToast()">Close</button>
        </div>
    </div>
</div>