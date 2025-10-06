 // -----------dasboard js -------
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

  overlay.addEventListener("click", () => {
    sidebar.classList.remove("open");
    overlay.classList.remove("show");
  });

  // Chart.js
  const ctx = document.getElementById("summaryChart").getContext("2d");
  new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov"],
      datasets: [
        {
          label: "In-store",
          data: [12, 19, 13, 15, 20, 23, 12, 7, 14, 10],
          backgroundColor: "rgba(0,200,83,0.7)"
        },
        {
          label: "Online",
          data: [10, 14, 15, 8, 18, 17, 5, 9, 11, 13],
          backgroundColor: "rgba(160,160,160,0.7)"
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: { y: { beginAtZero: true } }
    }
  });
});


