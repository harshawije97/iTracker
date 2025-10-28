<?php
include_once __DIR__ . '/../services/auth.php';

$session_user = getSessionUser();
$username = $session_user['username'];

?>


<dialog id="dialog">
    <div class="dialog-header">
        <h2 class="dialog-title">
            <?= htmlspecialchars($username) ?>
        </h2>
        <button class="dialog-close" onclick="document.getElementById('dialog').close()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
            </svg>
        </button>
    </div>

    <div class="dialog-content">
        <div class="command-overlay">
            <div class="command-modal">
                <div class="command-search">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" placeholder="Type a command or search..." class="search-input" id="searchInput">
                </div>

                <div class="command-content">
                    <div class="command-section">
                        <div class="section-label">Actions</div>
                        <div class="command-item" data-action="calendar">
                            <svg class="item-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span>Calendar</span>
                        </div>
                    </div>

                    <div class="command-section">
                        <div class="section-label">Settings</div>
                        <!-- New includes here -->
                        <?php include_once './components/profile.php'; ?>
                        <?php include_once './components/logoutComponent.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="dialog-footer">
        <button class="btn-secondary" onclick="document.getElementById('dialog').close()">
            Cancel
        </button>
        <button class="btn-primary" onclick="document.getElementById('dialog').close()">
            Confirm
        </button>
    </div> -->
</dialog>