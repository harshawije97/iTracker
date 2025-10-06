// ----------------------
// Sidebar code 
// ----------------------
document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("overlay");
  const menuBtn = document.getElementById("menuBtn");
  const closeBtn = document.getElementById("closeBtn");

  // Open sidebar
  menuBtn.addEventListener("click", () => {
    sidebar.classList.add("open");
    overlay.classList.add("show");
  });

  // Close sidebar
  closeBtn.addEventListener("click", () => {
    sidebar.classList.remove("open");
    overlay.classList.remove("show");
  });

  // Close sidebar when clicking overlay
  overlay.addEventListener("click", () => {
    sidebar.classList.remove("open");
    overlay.classList.remove("show");
  });

  // Search & Filter
  const searchInput = document.getElementById("searchInput");
  const filterSelect = document.getElementById("filterSelect");
  const incidentList = document.getElementById("incidentList");
  const items = incidentList.querySelectorAll(".item");

  function filterItems() {
    const searchText = searchInput.value.toLowerCase();
    const filterValue = filterSelect.value;

    items.forEach(item => {
      const textMatch = item.querySelector(".details h4").textContent.toLowerCase().includes(searchText) ||
                        item.querySelector(".details p").textContent.toLowerCase().includes(searchText);
      const statusMatch = filterValue === "all" || item.dataset.status === filterValue;

      if (textMatch && statusMatch) {
        item.style.display = "flex";
      } else {
        item.style.display = "none";
      }
    });
  }

  searchInput.addEventListener("input", filterItems);
  filterSelect.addEventListener("change", filterItems);
});


