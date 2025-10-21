<div class="incidents-list">
    <?php
    include_once './database/connection.php';
    include_once './services/inventoryService.php';
    include_once './services/auth.php';

    $sessionUser = getSessionUser();

    $inventory = getInventoryItemsByUserId($conn, $sessionUser['user_id']);

    if (!empty($inventory)) {
        foreach ($inventory as $item) {
    ?>
            <!-- Incident items get rendered here -->
            <div class="incident-item">
                <div class="incident-content">
                    <div class="incident-header">
                        <a href="./inventoryItem.php?id=<?= $item['id'] ?>&serial_number=<?= $item['serial_number'] ?>" class="hover-underline">
                            <h3 class="incident-title" data-item-id="<?= $item['id'] ?>">
                                <?= htmlspecialchars($item['name'] ?? 'Unknown Item') ?>
                            </h3>
                        </a>
                        <!-- popover button for options -->
                        <span class="popover-container">
                            <button type="button" class="incident-options popover-trigger" onclick="toggleSidePopover(this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ellipsis-vertical-icon lucide-ellipsis-vertical">
                                    <circle cx="12" cy="12" r="1" />
                                    <circle cx="12" cy="5" r="1" />
                                    <circle cx="12" cy="19" r="1" />
                                </svg>
                            </button>
                            <section class="popover-backdrop" onclick="closePopover(this)"></section>
                            <span class="popover-content">
                                <a href="./inventoryItemEdit.php?id=<?= $item['id'] ?>&serial_number=<?= $item['serial_number'] ?>" class="popover-link">Update Item</a>
                                <span class="popover-link" onclick="alert('Product Archived')">Archive Item</span>
                            </span>
                        </span>
                    </div>
                    <p class="incident-description">
                        <?= htmlspecialchars($item['description'] ?? 'No description') ?>
                    </p>
                    <div class="footer-wrapper">
                        <?php if ($item['item_status'] == 'in stock') {
                        ?>
                            <span class="status-badge-green">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-icon lucide-circle-check">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m9 12 2 2 4-4" />
                                </svg>
                                <?= htmlspecialchars($item['item_status'] ?? 'Status Unknown') ?>
                            </span>

                        <?php
                        }
                        ?>
                        <?php if ($item['item_status'] == 'on repair') {
                        ?>
                            <span class="status-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                                </svg>
                                <?= htmlspecialchars($item['item_status'] ?? 'Status Unknown') ?>
                            </span>
                        <?php
                        }
                        ?>
                        <span class="incident-date">
                            <?= htmlspecialchars(date('Y-m-d', strtotime($item['created_at']))) ?>
                        </span>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo "<div class='empty-items-container'>
        <p class='color-gray'>No Items found</p>
    </div>";
    }
    ?>


</div>