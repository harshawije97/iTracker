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
                console.log(items);
            } else {
                console.log(data.message);
            }
        }).catch(error => {
            console.log(error);
        });
    }
</script>