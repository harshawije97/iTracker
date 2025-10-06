//  form validation
document.getElementById("loginForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();

  if (username === "" || password === "") {
    alert("Please fill out both fields.");
    return;
  }

  // You can add your real authentication logic here
  alert(`Welcome, ${username}!`);
});


 // -----------dasboard js -------
 // Sidebar toggle
document.addEventListener("DOMContentLoaded", () => {
  const menuToggle = document.getElementById("menuToggle");
  const sidebar = document.getElementById("sidebar");
  const closeSidebar = document.getElementById("closeSidebar");

  if (menuToggle && sidebar && closeSidebar) {
    menuToggle.addEventListener("click", () => {
      sidebar.classList.add("active");
    });

    closeSidebar.addEventListener("click", () => {
      sidebar.classList.remove("active");
    });
  }
});

