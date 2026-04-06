document.addEventListener("DOMContentLoaded", function () {
  const sidebarItems = document.querySelectorAll(".sidebar-item");
  const contentSections = document.querySelectorAll(".content-section");

  // Sidebar navigation
  sidebarItems.forEach((item) => {
    item.addEventListener("click", function (event) {
      event.preventDefault();

      const targetId = this.getAttribute("data-target");

      sidebarItems.forEach((link) => link.classList.remove("active"));
      this.classList.add("active");

      contentSections.forEach((section) => section.classList.remove("active"));
      const targetSection = document.getElementById(targetId);
      if (targetSection) {
        targetSection.classList.add("active");
      }
    });
  });

  // Profile card "Edit Profile" button
  const editProfileBtn = document.querySelector(".edit-profile-btn");
  if (editProfileBtn) {
    editProfileBtn.addEventListener("click", function () {
      // Hide all sections
      contentSections.forEach((section) => section.classList.remove("active"));

      // Show the edit-profile section
      const editSection = document.getElementById("edit-profile");
      if (editSection) editSection.classList.add("active");

      // Update sidebar active state
      sidebarItems.forEach((i) => i.classList.remove("active"));
      const sidebarEdit = document.querySelector(
        '.sidebar-item[data-target="edit-profile"]',
      );
      if (sidebarEdit) sidebarEdit.classList.add("active");

      // Scroll to top smoothly
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  /* =========================================
     1. Sidebar & Navigation Logic
     ========================================= */
  const sidebarItems = document.querySelectorAll(".sidebar-item");
  const contentSections = document.querySelectorAll(".content-section");

  sidebarItems.forEach((item) => {
    item.addEventListener("click", function (event) {
      event.preventDefault();

      const targetId = this.getAttribute("data-target");

      sidebarItems.forEach((link) => link.classList.remove("active"));
      this.classList.add("active");

      contentSections.forEach((section) => section.classList.remove("active"));
      const targetSection = document.getElementById(targetId);
      if (targetSection) {
        targetSection.classList.add("active");
      }
    });
  });

  /* =========================================
     2. Edit Profile Button Logic
     ========================================= */
  const editProfileBtn = document.querySelector(".edit-profile-btn");
  if (editProfileBtn) {
    editProfileBtn.addEventListener("click", function () {
      contentSections.forEach((section) => section.classList.remove("active"));

      const editSection = document.getElementById("edit-profile");
      if (editSection) editSection.classList.add("active");

      sidebarItems.forEach((i) => i.classList.remove("active"));
      const sidebarEdit = document.querySelector(
        '.sidebar-item[data-target="edit-profile"]',
      );
      if (sidebarEdit) sidebarEdit.classList.add("active");

      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  /* =========================================
     3. Avatar Upload Logic (SAFE MODE)
     ========================================= */
  // We check if the element exists BEFORE trying to use it to prevent crashes
  const avatarPreview = document.querySelector("#avatar-preview");
  const uploadBtn = document.getElementById("upload-btn");
  const avatarInput = document.getElementById("profile_picture");

  if (avatarPreview && uploadBtn && avatarInput) {
    const initials = avatarPreview.textContent.trim();

    uploadBtn.addEventListener("click", (e) => {
      e.preventDefault();
      avatarInput.click();
    });

    avatarInput.addEventListener("change", function () {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          const img = document.createElement("img");
          img.src = e.target.result;
          img.alt = "Profile Picture";
          img.style.width = "100%";
          img.style.height = "100%";
          img.style.objectFit = "cover";
          img.style.borderRadius = "50%";
          avatarPreview.innerHTML = "";
          avatarPreview.appendChild(img);
        };
        reader.readAsDataURL(file);
      } else {
        avatarPreview.innerHTML = initials;
      }
    });
  }

  /* =========================================
     4. Community Modal Logic
     ========================================= */
  const communityModal = document.getElementById("CreateCommunityModal");
  const openModalBtn = document.getElementById("openCreateCommunityModal");

  // Only run if both elements exist
  if (communityModal && openModalBtn) {
    const closeBtn = communityModal.querySelector(".close-button");
    const cancelBtn = communityModal.querySelector(".btn-cancel");

    // Open
    openModalBtn.addEventListener("click", function (e) {
      e.preventDefault();
      communityModal.style.display = "flex";
    });

    // Close Function
    function closeCommunityModal() {
      communityModal.style.display = "none";
    }

    // Attach Close Events
    if (closeBtn) {
      closeBtn.addEventListener("click", closeCommunityModal);
    }
    if (cancelBtn) {
      cancelBtn.addEventListener("click", closeCommunityModal);
    }

    // Click Outside to Close
    window.addEventListener("click", function (event) {
      if (event.target === communityModal) {
        closeCommunityModal();
      }
    });
  }

  window.commDelete = (communityId, rootUrl) => {
    if (
      confirm(
        "Are you sure you want to delete this community? This action cannot be undone.",
      )
    ) {
      window.location.href =
        rootUrl + "/InstituteProfile/deleteCommunity?id=" + communityId;
    }
  };
});
