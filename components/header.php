<?php
$sessionUser = getSessionUser();
$username = $sessionUser['username'];

?>


<?php include_once __DIR__ . '/sidebar.php'; ?>
<header class="header">
    <div class="menu-icon" onclick="toggleSideBar()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </div>
    <div class="logo">iTracker</div>
    <div class="user-profile">
        <button class="trigger-button user-icon" onclick="document.getElementById('dialog').showModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"></path>
            </svg>
        </button>
        <span class="username">
            <?= htmlspecialchars($username) ?>
        </span>
    </div>
    <?php include_once './components/dialog.php'; ?>
</header>