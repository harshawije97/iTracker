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

// sidebar
function toggleSideBar() {
  const sidebar = document.getElementById("sidebar");
  sidebar.classList.add("open");
  overlay.classList.add("show");

  document.addEventListener("DOMContentLoaded", () => {
    const overlay = document.getElementById("overlay");
    const menuBtn = document.getElementById("menuBtn");

    const closeButton = document.getElementById("closeBtn");
    if (closeButton) {
      sidebar.classList.remove("open");
      overlay.classList.remove("show");
    }
  });
}
