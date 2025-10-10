<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="./public/style.css">
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
                        <div class="search-box">
                            <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                            <input type="text" placeholder="Search items" class="search-input">
                        </div>
                        <!-- filter the inventory items -->
                        <select name="cars" id="cars" class="filter-btn">
                            <option>Filter</option>
                            <option value="resent">Recently Added</option>
                            <option value="in-stock">In Stock</option>
                            <option value="on-repair">On Repair</option>
                        </select>
                    </div>
                    <?php include_once './components/incidentList.php'; ?>
                    <a href="./newItem.php">
                        <button type="button" class="fab">Add Item</button>
                    </a>
                </main>
            </div>
        </div>
    </section>
</body>

</html>