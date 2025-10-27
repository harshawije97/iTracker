<div class="search-box">
    <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="11" cy="11" r="8"></circle>
        <path d="m21 21-4.35-4.35"></path>
    </svg>
    <input type="search" placeholder="Search items" class="search-input" name="search" id="searchInput" onkeyup="onSearch(this)">
</div>
<!-- filter the inventory items -->
<select name="inventoryItems" id="inventoryItems" class="filter-btn">
    <option>Filter</option>
    <option value="resent">Recently Added</option>
    <option value="in-stock">In Stock</option>
    <option value="on-repair">On Repair</option>
</select>

<script>
    let searchTimeout = null;

    function onSearch(e) {
        const value = e.value.trim();
        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }

        if (value.length >= 3) {
            searchTimeout = setTimeout(() => {
                searchItems(value);
            }, 300);
        }
    }

    function searchItems(search) {
        const formData = new FormData();
        formData.append('search', search);

        fetch('./api/getInventory.php', {
            method: 'POST',
            body: formData
        }).then(response => response.json()).then(data => {
            if (data.success) {
                const items = data.data;
                renderInventoryItems(items);
            } else {
                console.log(data.message);
            }
        }).catch(error => {
            console.log(error);
        });
    }

    // Rendering in js to DOM
    function renderInventoryItems(items) {
        let html = '';
        const container = document.getElementById('inventoryList');
        const searchItems = JSON.parse(items);

        if (searchItems.length === 0) {
            container.innerHTML = `
            <div class='empty-items-container'>
                <p class='color-gray'>No items found</p>
            </div>
        `;
            html = container.innerHTML;
            return;
        }

        searchItems.forEach(item => {
            const statusBadge = getStatusBadge(item.item_status);
            const formattedDate = formatDate(item.created_at);

            html += `
                <div class="incident-item">
                    <div class="incident-content">
                        <div class="incident-header">
                            <a href="./inventoryItem.php?id=${item.id}&serial_number=${escapeHtml(item.serial_number)}" class="hover-underline">
                                <h3 class="incident-title" data-item-id="${item.id}">
                                    ${escapeHtml(item.name || 'Unknown Item')}
                                </h3>
                            </a>
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
                                    <a href="./inventoryItemEdit.php?id=${item.id}&serial_number=${escapeHtml(item.serial_number)}" class="popover-link">Update Item</a>
                                    <span class="popover-link" onclick="alert('Product Archived')">Archive Item</span>
                                </span>
                            </span>
                        </div>
                        <p class="incident-description">
                            ${escapeHtml(item.description || 'No description')}
                        </p>
                        <div class="footer-wrapper">
                            ${statusBadge}
                            <span class="incident-date">
                                ${formattedDate}
                            </span>
                        </div>
                    </div>
                </div>
            `;
        });

        container.innerHTML = html;
    }
</script>