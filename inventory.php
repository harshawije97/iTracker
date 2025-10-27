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
    <title>Inventory</title>
    <?php include_once './shared/links.php' ?>
</head>

<body>
    <section class="base">
        <?php include_once './components/header.php'; ?>
        <div class="container">
            <div class="px-16 w-full">
                <main class="main-content">
                    <div class="page-header">
                        <p class="breadcrumb">Inventory</p>
                        <h2 class="page-title">All Inventory Items</h2>
                    </div>
                    <div class="search-filter-container">
                        <?php include_once "./components/inventoryFind.php"; ?>
                    </div>
                    <?php include_once './components/inventoryList.php'; ?>
                    <a href="./newItem.php">
                        <button type="button" class="fab">Add Item</button>
                    </a>
                </main>
            </div>
        </div>
    </section>
    <!-- <script src="./public/js/main.js"></script> -->
    <script>
        let activePopover = null;

        // Triggered by each popover button
        function toggleSidePopover(button) {
            const container = button.closest('.popover-container');
            const content = container.querySelector('.popover-content');
            const backdrop = container.querySelector('.popover-backdrop');
            const isOpen = content.classList.contains('active');

            // Close any open popover before opening a new one
            if (activePopover && activePopover !== container) {
                closeActivePopover();
            }

            if (isOpen) {
                closePopover(backdrop);
            } else {
                openPopover(container, content, backdrop);
            }
        }

        function openPopover(container, content, backdrop) {
            content.classList.add('active');
            backdrop.classList.add('active');
            container.querySelector('.incident-options').setAttribute('aria-expanded', 'true');
            activePopover = container;
        }

        function closePopover(backdrop) {
            const container = backdrop.closest('.popover-container');
            const content = container.querySelector('.popover-content');
            content.classList.remove('active');
            backdrop.classList.remove('active');
            container.querySelector('.incident-options').setAttribute('aria-expanded', 'false');

            if (activePopover === container) {
                activePopover = null;
            }
        }

        function closeActivePopover() {
            if (activePopover) {
                const backdrop = activePopover.querySelector('.popover-backdrop');
                closePopover(backdrop);
            }
        }

        // Close on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeActivePopover();
            }
        });

        // Prevent clicks inside popover from closing it
        document.addEventListener('click', (e) => {
            if (activePopover) {
                const content = activePopover.querySelector('.popover-content');
                const isClickInside = content.contains(e.target) ||
                    activePopover.querySelector('.incident-options').contains(e.target);
                if (!isClickInside) {
                    closeActivePopover();
                }
            }
        });
    </script>

</body>

</html>