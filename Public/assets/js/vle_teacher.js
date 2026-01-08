/* =========================================
   GLOBAL FUNCTIONS (Accessible everywhere)
   ========================================= */

// 1. Toggle Place Field (Online vs Physical)
function togglePlaceField() {
  const typeSelect = document.getElementById("class-type");
  const placeGroup = document.getElementById("place-group");
  const placeInput = document.getElementById("place");

  if (!typeSelect || !placeGroup || !placeInput) return;

  if (typeSelect.value === "Online") {
    placeGroup.style.display = "none";
    placeInput.required = false;
    placeInput.value = "";
  } else {
    placeGroup.style.display = "block";
    placeInput.required = true;
  }
}

// 2. Open Popup for CREATING (Reset Form)
function openSchedulePopup() {
  const popup = document.getElementById("schedulePopup");
  const form = document.getElementById("schedule-form");
  const title = document.getElementById("popup-title");
  const btn = document.getElementById("submit-btn");

  if (!popup || !form) return;

  // Reset Form & UI
  form.reset();
  document.getElementById("edit_session_id").value = "";
  title.innerText = "Create Class Schedule";
  btn.innerText = "Add Schedule";

  // Reset Action URL to Create
  if (form.action.includes("updateSession")) {
    form.action = form.action.replace("updateSession", "scheduleLiveSession");
  }

  // Reset Dropdown Logic
  document.getElementById("place-group").style.display = "block";

  popup.style.display = "block";
}

// 3. Open Popup for EDITING (Fill Data)
function openEditPopup(session) {
  const popup = document.getElementById("schedulePopup");
  const form = document.getElementById("schedule-form");
  const title = document.getElementById("popup-title");
  const btn = document.getElementById("submit-btn");

  // Fill Fields
  document.getElementById("edit_session_id").value = session.session_id;
  document.getElementById("topic").value = session.title;

  // Parse Date/Time
  const startDate = session.start_time.split(" ")[0];
  document.getElementById("date").value = startDate;
  document.getElementById("start_time").value = session.start_time
    .split(" ")[1]
    .substring(0, 5);
  document.getElementById("end_time").value = session.end_time
    .split(" ")[1]
    .substring(0, 5);

  // Set Class Type
  const typeSelect = document.getElementById("class-type");
  typeSelect.value = session.session_type || "Physical";
  document.getElementById("place").value = session.place;

  // Set UI for Edit
  title.innerText = "Edit Schedule";
  btn.innerText = "Update Schedule";

  // Change Action URL to Update
  if (form.action.includes("scheduleLiveSession")) {
    form.action = form.action.replace("scheduleLiveSession", "updateSession");
  }

  // Trigger toggle logic manually (Now this works because function is global)
  togglePlaceField();

  popup.style.display = "block";
}

// 4. Close Schedule Popup
function closeSchedulePopup() {
  document.getElementById("schedulePopup").style.display = "none";
}

// 5. Close All Popups
window.closeAllPopups = function () {
  const popups = document.querySelectorAll(".popup");
  popups.forEach((p) => (p.style.display = "none"));
};

/* =========================================
   DOM LOADED LISTENERS (Run on Page Load)
   ========================================= */
document.addEventListener("DOMContentLoaded", function () {
  // --- 1. TAB SWITCHING ---
  const tabs = document.querySelectorAll(".vle-tab");
  const panels = document.querySelectorAll(".vle-panel");

  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      const targetPanelId = tab.getAttribute("data-panel");
      const targetPanel = document.getElementById(targetPanelId);

      tabs.forEach((t) => t.classList.remove("active"));
      panels.forEach((p) => p.classList.remove("active"));

      tab.classList.add("active");
      if (targetPanel) targetPanel.classList.add("active");
    });
  });

  // --- 2. DROPDOWN LISTENER ---
  const typeSelect = document.getElementById("class-type");
  if (typeSelect) {
    // Attach the global function here
    typeSelect.addEventListener("change", togglePlaceField);
    // Run once on load
    togglePlaceField();
  }

  // --- 3. OTHER POPUP FUNCTIONS ---

  window.openMainPopup = function () {
    const main = document.getElementById("popupWindow");
    if (main) main.style.display = "flex";
  };

  window.chooseContent = function (popupId) {
    window.closeAllPopups();
    const popup = document.getElementById(popupId);

    if (popup) {
      const form = popup.querySelector("form");
      if (form) {
        form.reset();

        if (popupId === "UploadPopup") {
          form.action = ROOT_URL + "/TeacherVle/uploadLink";
          const title = popup.querySelector("h2");
          const btn = form.querySelector('button[type="submit"]');
          if (title) title.innerText = "Create Student Submission Link";
          if (btn) btn.innerText = "Create Assignment";
          const typeInput = form.querySelector('input[name="linkType"]');
          if (typeInput) typeInput.value = "assignment";
        } else if (popupId === "quizPopup") {
          form.action = ROOT_URL + "/TeacherVle/createQuiz";
        } else {
          form.action = ROOT_URL + "/TeacherVle/uploadDocument";
        }

        const idInput = form.querySelector('input[name="content_id"]');
        if (idInput) idInput.value = "";
      }
      popup.style.display = "flex";
    }
  };

  // Wrapper for legacy calls
  window.openCreateForm = function () {
    window.chooseContent("documentPopup");
  };

  // Update Form Logic
  window.openUpdateForm = function (button) {
    window.closeAllPopups();
    const id = button.dataset.id;
    const title = button.dataset.title;
    const desc = button.dataset.desc;
    const type = button.dataset.type;

    let targetPopupId = "documentPopup";
    if (type === "external_link" || type === "assignment") {
      targetPopupId = "UploadPopup";
    } else if (type === "quiz") {
      targetPopupId = "quizPopup";
    }

    const popup = document.getElementById(targetPopupId);
    if (!popup) return;

    // Populate Fields
    if (targetPopupId === "documentPopup") {
      if (document.getElementById("docName"))
        document.getElementById("docName").value = title;
      if (document.getElementById("docDescription"))
        document.getElementById("docDescription").value = desc;
      if (document.getElementById("docContentType"))
        document.getElementById("docContentType").value = type;
    } else if (targetPopupId === "UploadPopup") {
      if (document.getElementById("assignName"))
        document.getElementById("assignName").value = title;
      if (document.getElementById("assignDescription"))
        document.getElementById("assignDescription").value = desc;
    } else if (targetPopupId === "quizPopup") {
      if (document.getElementById("quizName"))
        document.getElementById("quizName").value = title;
      if (document.getElementById("quizDescription"))
        document.getElementById("quizDescription").value = desc;
    }

    // Set Update Action
    const form = popup.querySelector("form");
    form.action = ROOT_URL + "/TeacherVle/updateDocument";
    const idInput = form.querySelector('input[name="content_id"]');
    if (idInput) idInput.value = id;

    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) submitBtn.innerText = "Update";

    const headerTitle = popup.querySelector("h2");
    if (headerTitle) headerTitle.innerText = "Edit Content";

    popup.style.display = "flex";
  };

  // Delete Logic
  window.handleDelete = function (content_id, class_id) {
    if (!confirm("Are you sure you want to delete this item?")) return;
    const form = document.createElement("form");
    form.method = "POST";
    form.action = ROOT_URL + "/TeacherVle/deleteDocument";
    form.style.display = "none";

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

    document.body.appendChild(form);
    form.submit();
  };

  // Event Listeners for UI
  const addContentBtn = document.querySelector(".add-content-btn");
  if (addContentBtn) {
    addContentBtn.addEventListener("click", window.openMainPopup);
  }

  const sectionHeaders = document.querySelectorAll(".section-header-button");
  sectionHeaders.forEach((header) => {
    header.addEventListener("click", () => {
      const sectionBody = header
        .closest(".content-section")
        .querySelector(".section-body");
      if (sectionBody) sectionBody.classList.toggle("hidden");
      header.classList.toggle("open");
    });
  });

  // Close Popups on Outside Click
  window.onclick = function (event) {
    if (event.target.classList.contains("popup")) {
      event.target.style.display = "none";
    }
    // Specific ID checks
    const addPaperPopup = document.getElementById("addPaperPopup");
    const importMarksPopup = document.getElementById("importMarksPopup");
    if (event.target == addPaperPopup) addPaperPopup.style.display = "none";
    if (event.target == importMarksPopup)
      importMarksPopup.style.display = "none";
  };

  // Import/Paper Popup Logic
  window.openImportPopup = function (paperId, paperTitle) {
    const popup = document.getElementById("importMarksPopup");
    document.getElementById("popupPaperTitle").innerText =
      "Paper: " + paperTitle;
    document.getElementById("popupPaperId").value = paperId;
    const classIdInput = document.querySelector('input[name="class_id"]');
    const classId = classIdInput ? classIdInput.value : "";
    const downloadUrl = `${ROOT_URL}/TeacherVle/downloadGradeTemplate/${classId}/${paperId}`;
    document.getElementById("templateDownloadLink").href = downloadUrl;
    if (popup) popup.style.display = "flex";
  };

  window.closeImportPopup = () => {
    const popup = document.getElementById("importMarksPopup");
    if (popup) popup.style.display = "none";
  };

  window.openAddPaperPopup = () => {
    const popup = document.getElementById("addPaperPopup");
    if (popup) popup.style.display = "block";
  };

  window.closeAddPaperPopup = () => {
    const popup = document.getElementById("addPaperPopup");
    if (popup) popup.style.display = "none";
  };
});
