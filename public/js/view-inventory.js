// Notification function
function showNotification(message) {
  const notif = document.getElementById("notification");
  notif.textContent = message;
  notif.classList.add("show");

  setTimeout(() => {
    notif.classList.remove("show");
  }, 3000);
}

// Back button click
document.querySelector(".back-btn").addEventListener("click", () => {
  showNotification("Going back...");
});

// Settings click
document.querySelector(".settings").addEventListener("click", () => {
  showNotification("Settings clicked!");
});

// Category button click
document.getElementById("categoryBtn").addEventListener("click", () => {
  showNotification("Category selected!");
});
