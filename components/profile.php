<?php include_once './database/connection.php'; ?>

<?php
$sessionUser = getSessionUser();
?>


<div class="command-item" data-action="userEdit" onclick="navigateProfile()">
    <svg class="item-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
    </svg>
    <span>Profile</span>
</div>

<script>
    function navigateProfile() {
        window.location.href = './userEdit.php?id=<?= $sessionUser['user_id'] ?>';
    }
</script>