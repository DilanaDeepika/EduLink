const fileInput = document.getElementById("file-upload-input");
const uploadBox = document.getElementById("upload-box");
const checklistItems = document.querySelectorAll(".checklist-item");
const browseBtn = document.getElementById("browse-btn");

browseBtn.addEventListener("click", (event) => {
  event.preventDefault();
  fileInput.click();
});

// This is the main function that checks file names and updates the UI
function processFiles(files) {
  const uploadInfo = document.getElementById("upload-info");

  uploadInfo.innerHTML = "";
  const fileList = document.createElement("ul");

  // Loop through each file that was uploaded
  for (const file of files) {
    const fileName = file.name.toLowerCase();

    const listItem = document.createElement("li");
    listItem.textContent = file.name;
    fileList.appendChild(listItem);

    checklistItems.forEach((item) => {
      const keyword = item.dataset.keyword;

      if (fileName.includes(keyword)) {
        item.classList.add("uploaded");
      }
    });
  }

  // Add the list of file names to the page
  uploadInfo.appendChild(fileList);
}

fileInput.addEventListener("change", (event) => {
  processFiles(event.target.files);
});

// Drag and Drop functionality
uploadBox.addEventListener("dragover", (event) => {
  event.preventDefault();
  uploadBox.style.backgroundColor = "#f0f0f0";
});

uploadBox.addEventListener("dragleave", () => {
  uploadBox.style.backgroundColor = "transparent";
});

uploadBox.addEventListener("drop", (event) => {
  event.preventDefault();
  uploadBox.style.backgroundColor = "transparent";
  const files = event.dataTransfer.files;
  processFiles(files);
});
