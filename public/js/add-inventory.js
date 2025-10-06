
// Back button functionality
function goBack() {
  window.location.href = "inventory.html"; 
}

// Handle image preview
document.getElementById("file-upload").addEventListener("change", function (event) {
  const preview = document.getElementById("preview");
  preview.innerHTML = ""; // Clear old images
  const files = event.target.files;

  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    const reader = new FileReader();

    reader.onload = function (e) {
      const img = document.createElement("img");
      img.src = e.target.result;
      preview.appendChild(img);
    };

    reader.readAsDataURL(file);
  }
});

// Save button action
function saveItem() {
  const title = document.getElementById("title").value;
  const category = document.getElementById("category").value;
  const description = document.getElementById("description").value;
  const estate = document.getElementById("estate").value;

  if (!title || !category) {
    alert("Please fill in at least Title and Category");
    return;
  }

  alert("Item saved:\n" +
        "Title: " + title + "\n" +
        "Category: " + category + "\n" +
        "Description: " + description + "\n" +
        "Estate: " + estate);
}
