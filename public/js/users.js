// ===============================
// Sidebar Toggle Script
// ===============================
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

  // Close when clicking overlay
  overlay.addEventListener("click", () => {
    sidebar.classList.remove("open");
    overlay.classList.remove("show");
  });
});
// ===============================
// Users Page Script
// ===============================
document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("userSearch");
  const userCards = document.querySelectorAll(".registered .user-card");

  // Search filter for Registered users
  function filterUsers() {
    const searchValue = searchInput.value.toLowerCase();
    userCards.forEach(card => {
      const text = card.innerText.toLowerCase();
      card.style.display = text.includes(searchValue) ? "flex" : "none";
    });
  }
  searchInput.addEventListener("keyup", filterUsers);

  // Filter dropdown in Request Access
  const filterSelect = document.getElementById("requestFilter");
  const requestCards = document.querySelectorAll(".request-access .user-card");

  filterSelect.addEventListener("change", () => {
    const value = filterSelect.value;
    requestCards.forEach(card => {
      const status = card.getAttribute("data-status");
      if (value === "all" || status === value) {
        card.style.display = "flex";
      } else {
        card.style.display = "none";
      }
    });
  });

  // Resend button
  document.querySelectorAll(".resend-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      alert("Resend invitation email sent successfully!");
    });
  });
});
