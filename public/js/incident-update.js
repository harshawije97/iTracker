// Notification function
function showNotification(message) {
  const note = document.getElementById("notification");
  note.innerText = message;
  note.classList.add("show");

  setTimeout(() => {
    note.classList.remove("show");
  }, 3000);
}

// Handle Update Button
document.getElementById("updateBtn").addEventListener("click", () => {
  const status = document.getElementById("status").value;
  if (!status) {
    showNotification("⚠ Please select a status before updating.");
  } else {
    showNotification("✅ Incident updated successfully!");
  }
});

// Handle Comments
document.getElementById("addComment").addEventListener("click", () => {
  const title = document.getElementById("commentTitle").value;
  const text = document.getElementById("commentText").value;
  const list = document.getElementById("commentList");

  if (title && text) {
    const newComment = document.createElement("p");
    newComment.textContent = `💬 ${title}: ${text}`;
    list.appendChild(newComment);

    document.getElementById("commentTitle").value = "";
    document.getElementById("commentText").value = "";
    showNotification("💬 Comment added!");
  } else {
    showNotification("⚠ Please fill in title and comment text.");
  }
});

// Handle Image Upload
document.getElementById("imageUpload").addEventListener("change", (e) => {
  const preview = document.getElementById("preview");
  preview.innerHTML = "";
  Array.from(e.target.files).forEach(file => {
    const reader = new FileReader();
    reader.onload = () => {
      const img = document.createElement("img");
      img.src = reader.result;
      preview.appendChild(img);
    };
    reader.readAsDataURL(file);
  });
});
