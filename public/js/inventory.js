document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("overlay");
  const menuBtn = document.getElementById("menuBtn");
  const closeBtn = document.getElementById("closeBtn");

  // Sidebar toggle
  menuBtn.addEventListener("click", () => {
    sidebar.classList.add("open");
    overlay.classList.add("show");
  });
  closeBtn.addEventListener("click", () => {
    sidebar.classList.remove("open");
    overlay.classList.remove("show");
  });
  overlay.addEventListener("click", () => {
    sidebar.classList.remove("open");
    overlay.classList.remove("show");
  });

  // Inventory Search & Filter
  const searchInput = document.querySelector(".search-filter input");
  const filterSelect = document.querySelector(".search-filter select");
  const items = document.querySelectorAll(".item");

  searchInput.addEventListener("input", () => {
    const query = searchInput.value.toLowerCase();
    items.forEach(item => {
      const text = item.innerText.toLowerCase();
      item.style.display = text.includes(query) ? "flex" : "none";
    });
  });

  filterSelect.addEventListener("change", () => {
    const filter = filterSelect.value;
    items.forEach(item => {
      const hasRepair = item.querySelector(".repair") !== null;
      const hasEstate = item.querySelector(".estate") !== null;

      if (filter === "All") item.style.display = "flex";
      else if (filter === "On Repair" && hasRepair) item.style.display = "flex";
      else if (filter === "Estate Name" && hasEstate) item.style.display = "flex";
      else item.style.display = "none";
    });
  });
});

