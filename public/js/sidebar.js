function toggleSideBar() {
  const sidebar = document.getElementById("sidebar");
  sidebar.classList.add("open");
  overlay.classList.add("show");
}

document.addEventListener("DOMContentLoaded", () => {
  const overlay = document.getElementById("overlay");
  const menuBtn = document.getElementById("menuBtn");

  const closeButton = document.getElementById("closeBtn");
  if (closeButton) {
    sidebar.classList.remove("open");
    overlay.classList.remove("show");
  }
});
