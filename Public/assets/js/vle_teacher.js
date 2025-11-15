document.addEventListener("DOMContentLoaded", function () {
  // --- PART 1: Handles switching the main panels (Schedule, Content, etc.) ---
  // (This is your original code - no changes)
  const tabs = document.querySelectorAll(".vle-tab");
  const panels = document.querySelectorAll(".vle-panel");

  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      const targetPanelId = tab.getAttribute("data-panel");
      const targetPanel = document.getElementById(targetPanelId);

      tabs.forEach((t) => t.classList.remove("active"));
      panels.forEach((p) => p.classList.remove("active"));

      tab.classList.add("active");
      if (targetPanel) {
        targetPanel.classList.add("active");
      }
    });
  });

  // --- PART 2: Handles all the popups for content generation ---
  // (Modified to use global 'window' functions)

  const mainPopup = document.getElementById("popupWindow");
  const documentPopup = document.getElementById("documentPopup");
  const uploadCreatePopup = document.getElementById("UploadPopup");
  const quizCreatePopup = document.getElementById("quizPopup");
  const addContentBtn = document.querySelector(".add-content-btn");

  // Made global so HTML onclick can find it
  window.openMainPopup = function () {
    if (mainPopup) mainPopup.style.display = "flex";
  };

  // Made global so HTML onclick can find it
  window.closeAllPopups = function () {
    if (mainPopup) mainPopup.style.display = "none";
    if (documentPopup) documentPopup.style.display = "none";
    if (uploadCreatePopup) uploadCreatePopup.style.display = "none";
    if (quizCreatePopup) quizCreatePopup.style.display = "none";
  };

  // Made global so HTML onclick can find it
  window.openCreatePopup = function (popupId) {
    closeAllPopups();
    const popupToOpen = document.getElementById(popupId);
    if (popupToOpen) {
      popupToOpen.style.display = "flex";
    }
  };

  if (addContentBtn) {
    addContentBtn.addEventListener("click", window.openMainPopup);
  }

  // Close buttons in all popups
  const closeButtons = document.querySelectorAll(".popup .close");
  closeButtons.forEach((button) => {
    button.addEventListener("click", window.closeAllPopups);
  });

  // Cancel buttons in forms
  const cancelButtons = document.querySelectorAll(
    '.popup-buttons button[type="button"]'
  );
  cancelButtons.forEach((button) => {
    button.addEventListener("click", window.closeAllPopups);
  });

  // Note: Your old 'contentChoiceButtons' listener is removed.
  // The 'onclick' attributes in the HTML now call the global functions
  // (e.g., window.openCreateForm) directly, which is more reliable.

  // --- PART 3: Handles collapsible content sections ---
  // (This is your original code - no changes)
  const sectionHeaders = document.querySelectorAll(".section-header-button");

  sectionHeaders.forEach((header) => {
    header.addEventListener("click", () => {
      const sectionBody = header
        .closest(".content-section")
        .querySelector(".section-body");

      if (sectionBody) {
        sectionBody.classList.toggle("hidden");
      }
      header.classList.toggle("open");
    });
  });

  // --- NEW: PART 4: UPDATE AND DELETE LOGIC ---
  // We attach these to 'window' so the inline 'onclick'
  // attributes in your HTML (e.g., onclick="openUpdateForm(this)") can find them.

  /**
   * Prepares the document popup for CREATING a new item.
   */
  window.openCreateForm = function () {
    // 1. Get form elements using the IDs from content_gen.view.php
    const form = document.getElementById("classContentForm");
    const title = document.querySelector("#documentPopup .popup-content h2");
    const submitBtn = document.querySelector(
      "#classContentForm button[type='submit']"
    );
    const fileInput = document.getElementById("docUpload");
    const contentIdInput = document.getElementById("content_id_input");
    const documentPopup = document.getElementById("documentPopup");

    if (
      !form ||
      !title ||
      !submitBtn ||
      !fileInput ||
      !contentIdInput ||
      !documentPopup
    ) {
      console.error(
        "Missing required elements for documentPopup! Check your HTML IDs."
      );
      return;
    }

    // 2. Change form action to the 'upload' function
    form.action = ROOT_URL + "/TeacherVle/uploadDocument";

    // 3. Reset title and button text
    title.innerText = "Create Document";
    submitBtn.innerText = "Upload";

    // 4. Clear all form fields
    form.reset();
    contentIdInput.value = ""; // Ensure content_id is empty
    fileInput.required = true; // Make file REQUIRED for new uploads

    // 5. Open the popup
    window.closeAllPopups(); // Close main popup
    documentPopup.style.display = "flex"; // Open doc popup
  };

  window.openUpdateForm = function (button) {
    const id = button.dataset.id;
    const title = button.dataset.title;
    const desc = button.dataset.desc;
    const type = button.dataset.type;

    const form = document.getElementById("classContentForm");
    const fileInput = document.getElementById("docUpload");
    const contentIdInput = document.getElementById("content_id_input");
    const popupTitleElement = document.querySelector(
      "#documentPopup .popup-content h2"
    );
    const submitButtonElement = form.querySelector('button[type="submit"]');

    if (
      !form ||
      !popupTitleElement ||
      !submitButtonElement ||
      !fileInput ||
      !contentIdInput
    ) {
      console.error(
        "Missing required elements inside documentPopup for update!"
      );
      return;
    }

    form.action = ROOT_URL + "/TeacherVle/updateDocument";

    popupTitleElement.innerText = "Update Document";
    submitButtonElement.innerText = "Update";

    contentIdInput.value = id;
    document.getElementById("docName").value = title;
    document.getElementById("docDescription").value = desc;
    document.getElementById("docContentType").value = type;
    fileInput.value = null;
    fileInput.required = false;

    window.closeAllPopups();
    const documentPopup = document.getElementById("documentPopup");
    if (documentPopup) documentPopup.style.display = "flex";
  };

  window.handleDelete = function (content_id, class_id) {
    if (!confirm("Are you sure you want to delete this item?")) {
      return;
    }
    console.log("Class ID:", class_id);
    // 1. Create a new, hidden form
    const form = document.createElement("form");
    form.method = "POST";
    form.action = ROOT_URL + "/TeacherVle/deleteDocument";
    form.style.display = "none"; // Hide it

    // 2. Add data as hidden inputs
    const idInput = document.createElement("input");
    idInput.type = "hidden";
    idInput.name = "content_id";
    idInput.value = content_id;
    form.appendChild(idInput);

    const classInput = document.createElement("input");
    classInput.type = "hidden";
    classInput.name = "class_id";
    classInput.value = class_id;
    form.appendChild(classInput);
    console.log("Submitting delete form to:", form.action);
    console.log("Submitting content_id:", content_id);
    console.log("Submitting class_id:", class_id);
    // 3. Add form to page and submit it
    document.body.appendChild(form);
    form.submit();
  };
});
