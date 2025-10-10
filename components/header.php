<header class="header sm:hidden">
    <div class="menu-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </div>
    <div class="logo">iTracker</div>
    <button class="trigger-button user-icon" id="openCommand">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="8" r="4"></circle>
            <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"></path>
        </svg>
    </button>
    <div class="command-overlay" id="commandOverlay">
        <div class="command-modal" id="commandModal">
            <div class="command-search">
                <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <input type="text" placeholder="Type a command or search..." class="search-input" id="searchInput">
            </div>

            <div class="command-content">
                <div class="command-section">
                    <div class="section-label">Suggestions</div>
                    <div class="command-item" data-action="calendar">
                        <svg class="item-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>Calendar</span>
                    </div>
                    <div class="command-item" data-action="emoji">
                        <svg class="item-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                            <line x1="9" y1="9" x2="9.01" y2="9"></line>
                            <line x1="15" y1="9" x2="15.01" y2="9"></line>
                        </svg>
                        <span>Search Emoji</span>
                    </div>
                    <div class="command-item" data-action="calculator">
                        <svg class="item-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="4" y="2" width="16" height="20" rx="2"></rect>
                            <line x1="8" y1="6" x2="16" y2="6"></line>
                            <line x1="16" y1="14" x2="16" y2="18"></line>
                            <line x1="8" y1="14" x2="8" y2="14.01"></line>
                            <line x1="12" y1="14" x2="12" y2="14.01"></line>
                            <line x1="8" y1="18" x2="8" y2="18.01"></line>
                            <line x1="12" y1="18" x2="12" y2="18.01"></line>
                        </svg>
                        <span>Calculator</span>
                    </div>
                </div>

                <div class="command-section">
                    <div class="section-label">Settings</div>
                    <div class="command-item" data-action="profile">
                        <svg class="item-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>Profile</span>
                        <span class="shortcut">⌘P</span>
                    </div>
                    <div class="command-item" data-action="billing">
                        <svg class="item-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg>
                        <span>Billing</span>
                        <span class="shortcut">⌘B</span>
                    </div>
                    <div class="command-item" data-action="settings">
                        <svg class="item-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M12 1v6m0 6v6m5.2-13.2l-4.2 4.2m-2 2l-4.2 4.2M23 12h-6m-6 0H1m18.2 5.2l-4.2-4.2m-2-2l-4.2-4.2"></path>
                        </svg>
                        <span>Settings</span>
                        <span class="shortcut">⌘S</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>