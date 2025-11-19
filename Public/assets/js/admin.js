document.addEventListener("DOMContentLoaded", function () {
  // --- 1. VIEW SWITCHING LOGIC ---
  const navLinks = document.querySelectorAll(".sidebar .nav-item a");
  const contentSections = document.querySelectorAll(".content-section");
  const navItems = document.querySelectorAll(".sidebar .nav-item");

  console.log(contentSections);
  navLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      const targetId = this.getAttribute("data-target");
      if (!targetId) return;

      navItems.forEach((item) => item.classList.remove("active"));
      this.parentElement.classList.add("active");

      contentSections.forEach((section) => {
        section.classList.toggle("active", section.id === targetId);
      });
    });
  });

  // --- 2. TAB SWITCHING LOGIC ---
  const tabLinks = document.querySelectorAll(".tab-link");
  const tabContents = document.querySelectorAll(".tab-content");

  tabLinks.forEach((link) => {
    link.addEventListener("click", function () {
      const targetTab = this.getAttribute("data-tab");
      tabLinks.forEach((item) => item.classList.remove("active"));
      this.classList.add("active");
      tabContents.forEach((content) => {
        content.classList.toggle("active", content.id === targetTab);
      });
    });
  });

  // --- 3. MODAL FUNCTION HELPER ---
  function setupModal(modalId, openButtonsSelector) {
    const modal = document.getElementById(modalId);
    const openButtons = document.querySelectorAll(openButtonsSelector);
    const closeButton = modal.querySelector(".close-button");
    const cancelButton = modal.querySelector(".btn-cancel");

    openButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        modal.style.display = "flex";
      });
    });

    if (closeButton)
      closeButton.addEventListener(
        "click",
        () => (modal.style.display = "none")
      );
    if (cancelButton)
      cancelButton.addEventListener(
        "click",
        () => (modal.style.display = "none")
      );

    // Close modal by clicking outside
    window.addEventListener("click", (e) => {
      if (e.target === modal) modal.style.display = "none";
    });

    return modal;
  }

  // --- 4. SETUP EXISTING MODALS ---
  const reviewModal = setupModal(
    "reviewModal",
    ".btn-review:not(.btn-review-ad)"
  );
  const adModal = setupModal("adReviewModal", ".btn-review-ad");
  const adminCreateModal = setupModal(
    "adminCreateCommunityModal",
    ".btn-open-admin-create"
  );

  // --- 5. OPEN AD MODAL WITH DATA ---
  window.openAdModal = function (adRequest, communities) {
    document.getElementById("advertiserName").textContent =
      adRequest.advertiser_name;
    document.getElementById("accountType").textContent = adRequest.account_type;
    document.getElementById("paymentAmount").textContent =
      adRequest.payment_amount;
    document.getElementById("placementOption").textContent =
      adRequest.placement_option_label;

    const docList = document.getElementById("documentList");
    docList.innerHTML = "";
    adRequest.documents.forEach((doc) => {
      const li = document.createElement("li");
      li.innerHTML = `<a href="${doc.path}" download>${doc.name} &darr;</a>`;
      docList.appendChild(li);
    });

    const communityWrapper = document.getElementById("communitySelectWrapper");
    if (adRequest.placement_option === "community_poster") {
      communityWrapper.style.display = "block";
      const communitySelect = document.getElementById("community-select");
      communitySelect.innerHTML = "";
      communities.forEach((c) => {
        const option = document.createElement("option");
        option.value = c.id;
        option.textContent = c.name;
        communitySelect.appendChild(option);
      });
    } else {
      communityWrapper.style.display = "none";
    }

    adModal.style.display = "flex";
  };
});
