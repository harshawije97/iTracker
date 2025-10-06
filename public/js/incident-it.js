document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchInput");
  const filterSelect = document.getElementById("filterSelect");
  const incidentList = document.getElementById("incidentList");
  const items = incidentList.getElementsByClassName("item");

  // Search Function
  searchInput.addEventListener("keyup", () => {
    const query = searchInput.value.toLowerCase();
    Array.from(items).forEach(item => {
      const text = item.innerText.toLowerCase();
      item.style.display = text.includes(query) ? "flex" : "none";
    });
  });

  // Filter Function
  filterSelect.addEventListener("change", () => {
    const filter = filterSelect.value;
    Array.from(items).forEach(item => {
      const status = item.getAttribute("data-status");
      if (filter === "all" || filter === status) {
        item.style.display = "flex";
      } else {
        item.style.display = "none";
      }
    });

    // Show alert when filter changes
    alert(`Filter applied: ${filter}`);
  });
});
