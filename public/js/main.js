function escapeHtml(text) {
  if (text === null || text === undefined) return "";
  const div = document.createElement("div");
  div.textContent = String(text);
  return div.innerHTML;
}

// Helper functions to generate HTML
function getStatusBadge(status) {
  if (status === "in stock") {
    return `
            <span class="status-badge-green">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-icon lucide-circle-check">
                    <circle cx="12" cy="12" r="10" />
                    <path d="m9 12 2 2 4-4" />
                </svg>
                ${escapeHtml(status)}
            </span>
        `;
  } else if (status === "on repair") {
    return `
            <span class="status-badge">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                </svg>
                ${escapeHtml(status)}
            </span>
        `;
  }
  return `<span class="status-badge">${escapeHtml(
    status || "Status Unknown"
  )}</span>`;
}

// Helper function to format date
function formatDate(dateString) {
  const date = new Date(dateString);
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, "0");
  const day = String(date.getDate()).padStart(2, "0");
  return `${year}-${month}-${day}`;
}

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
