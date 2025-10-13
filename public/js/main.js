// const overlay = document.getElementById("commandOverlay");
// const modal = document.getElementById("commandModal");
// const openButton = document.getElementById("openCommand");
// const searchInput = document.getElementById("searchInput");
// const commandItems = document.querySelectorAll(".command-item");

// function openModal() {
//   overlay.classList.add("active");
//   searchInput.focus();
// }

// function closeModal() {
//   overlay.classList.remove("active");
//   searchInput.value = "";
// }

// openButton.addEventListener("click", openModal);

// overlay.addEventListener("click", (e) => {
//   if (e.target === overlay) {
//     closeModal();
//   }
// });

// modal.addEventListener("click", (e) => {
//   e.stopPropagation();
// });

// document.addEventListener("keydown", (e) => {
//   if ((e.metaKey || e.ctrlKey) && e.key === "k") {
//     e.preventDefault();
//     openModal();
//   }

//   if (e.key === "Escape") {
//     closeModal();
//   }
// });

// commandItems.forEach((item) => {
//   item.addEventListener("click", () => {
//     const action = item.getAttribute("data-action");
//     console.log(`Action triggered: ${action}`);
//     closeModal();
//   });
// });

// Navigation back to main screens
function navigateBack() {
  window.history.back();
}

const settingsClicked = () => {
  alert("Settings clicked!");
};
