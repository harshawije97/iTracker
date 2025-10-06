// Image upload preview
document.getElementById("imageUpload").addEventListener("change", function () {
  const preview = document.getElementById("preview");
  preview.innerHTML = "";
  [...this.files].forEach(file => {
    const reader = new FileReader();
    reader.onload = e => {
      const img = document.createElement("img");
      img.src = e.target.result;
      preview.appendChild(img);
    };
    reader.readAsDataURL(file);
  });
});

// Form submission + notification
document.getElementById("incidentForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const notification = document.getElementById("notification");
  notification.textContent = "✅ Incident saved successfully!";
  notification.classList.add("show");

  setTimeout(() => {
    notification.classList.remove("show");
  }, 3000);

  this.reset();
  document.getElementById("preview").innerHTML = "";
});
