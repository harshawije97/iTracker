function navigateBack() {
  window.history.back();
}

function navigateParent(url) {
  window.location.href = url;
}

const settingsClicked = () => {
  alert("Settings clicked!");
};

// Form reset
function resetForm() {
  event.preventDefault();

  var form = document.getElementById("incidentUpdateForm");
  form.reset();

  const fileInput = document.getElementById("fileInput");
  if (fileInput) fileInput.value = "";

  const textarea = form.querySelector("textarea[name='description']");
  if (textarea) textarea.value = "";

  alert("Form has been reset successfully!");
}

const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("overlay");
const closeButton = document.getElementById("closeBtn");
const menuBtn = document.getElementById("menuBtn");

// Open sidebar
function openSidebar() {
  sidebar.classList.add("open");
  overlay.classList.add("show");
}

// Close sidebar
function closeSidebar() {
  sidebar.classList.remove("open");
  overlay.classList.remove("show");
}

// Toggle sidebar (optional if you need this)
function toggleSideBar() {
  if (sidebar.classList.contains("open")) {
    closeSidebar();
  } else {
    openSidebar();
  }
}

// Button click events
if (menuBtn) menuBtn.addEventListener("click", openSidebar);
if (closeButton) closeButton.addEventListener("click", closeSidebar);
if (overlay) overlay.addEventListener("click", closeSidebar);

// sidebar
document.addEventListener("DOMContentLoaded", () => {
  // Keyboard: close on Escape key
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && sidebar.classList.contains("open")) {
      closeSidebar();
    }
  });
});
