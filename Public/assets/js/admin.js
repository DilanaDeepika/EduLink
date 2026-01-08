function calculateHours(startStr, endStr) {
  const startDate = new Date(startStr);
  const endDate = new Date(endStr);

  const diffInMs = endDate - startDate;

  const diffInHours = diffInMs / (1000 * 60 * 60);

  return diffInHours;
}

document.addEventListener("DOMContentLoaded", function () {
  // --- 1. VIEW SWITCHING LOGIC ---
  const navLinks = document.querySelectorAll(".sidebar .nav-item a");
  const contentSections = document.querySelectorAll(".content-section");
  const navItems = document.querySelectorAll(".sidebar .nav-item");

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

  // 1. Select the radio buttons and the message box container
  const statusRadios = document.querySelectorAll('input[name="status"]');
  const messageBox = document.getElementById("message_container");

  statusRadios.forEach((radio) => {
    radio.addEventListener("change", (event) => {
      if (event.target.value === "rejected") {
        messageBox.style.display = "block";

        document
          .getElementById("admin_message")
          .setAttribute("required", "true");
      } else {
        messageBox.style.display = "none";

        document.getElementById("admin_message").removeAttribute("required");
      }
    });
  });

  // --- 2. TAB SWITCHING LOGIC ---
  const tabLinks = document.querySelectorAll(".tab-link");

  // Define which tab opposes which (The "Pairs")
  const tabPairs = {
    "teachers-content": "institutes-content",
    "institutes-content": "teachers-content",
    "homepage-content": "community-content",
    "community-content": "homepage-content",
  };

  tabLinks.forEach((link) => {
    link.addEventListener("click", function () {
      const targetTab = this.getAttribute("data-tab");
      const opponentTab = tabPairs[targetTab]; // Get the ID to remove

      // 1. Activate the Clicked Link & Content
      this.classList.add("active");
      const activeContent = document.getElementById(targetTab);
      if (activeContent) activeContent.classList.add("active");

      // 2. Deactivate ONLY the Opponent Link & Content
      if (opponentTab) {
        // Remove active from the specific opponent Button
        const opponentLink = document.querySelector(
          `.tab-link[data-tab="${opponentTab}"]`
        );
        if (opponentLink) opponentLink.classList.remove("active");

        // Remove active from the specific opponent Content Div
        const opponentContent = document.getElementById(opponentTab);
        if (opponentContent) opponentContent.classList.remove("active");
      }
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
  const reviewModal = setupModal("reviewModal", ".btn-review");
  const adModal = setupModal("adReviewModal", ".btn-review-ad");
  const adminCreateModal = setupModal(
    "adminCreateCommunityModal",
    ".btn-open-admin-create"
  );
  // ---- OPEN USER ACCEPT MODEL WITH DATA ---
  window.openAcceptModel = (pendingRequest) => {
    console.log("Reviewing:", pendingRequest);

    const nameEl = document.getElementById("applicantName");
    const emailEl = document.getElementById("applicantEmail");

    document.getElementById("message_container").style.display = "none";

    const userIdInput = document.getElementById("user_id");
    const userEmailInput = document.getElementById("user_email");
    if (userIdInput) {
      userIdInput.value = pendingRequest.account_id ?? "";
    } else {
      console.error("Error: <input id='user_id'> not found in HTML");
    }

    if (userEmailInput) {
      userEmailInput.value = pendingRequest.account_info?.email ?? "";
    } else {
      console.error("Error: <input id='user_email'> not found in HTML");
    }

    if (pendingRequest.hasOwnProperty("institute_name")) {
      nameEl.textContent = pendingRequest.institute_name;
    } else {
      nameEl.textContent =
        pendingRequest.first_name + " " + pendingRequest.last_nam;
    }

    if (pendingRequest.account_info) {
      emailEl.textContent = pendingRequest.account_info.email || "No Email";
    } else {
      emailEl.textContent = "No Account Linked";
    }

    const downloadContainer = document.getElementById(
      "acceptModalDownloadContainer"
    );
    console.log("Container Found?", downloadContainer);
    console.log("Poster Path:", pendingRequest.approval_document_path);

    if (downloadContainer) {
      if (pendingRequest.approval_document_path) {
        const rawString = pendingRequest.approval_document_path;

        const filePaths = rawString
          .replace("Poster Path: ", "")
          .split(",")
          .map((path) => path.trim());

        let allButtonsHtml = "";

        filePaths.forEach((path, index) => {
          const cleanPath = path.replace(/^\//, "");

          const webUrl = "/EDULINK/public/" + cleanPath;

          allButtonsHtml += `
                <a href="${webUrl}" download ">
                    <button type="button" class="btn-download">
                        Download Document ${index + 1}
                    </button>
                </a>
            `;
        });

        // 4. Update the container ONCE with all buttons
        downloadContainer.innerHTML = allButtonsHtml;
      } else {
        downloadContainer.innerHTML = "<span>No document attached</span>";
      }
    }
    const modal = document.getElementById("reviewModal");
    if (modal) modal.style.display = "flex";
  };

  // --- 5. OPEN AD MODAL WITH DATA ---
  window.openAdModal = (adRequest, communities = null) => {
    console.log(communities);

    document.getElementById("adRequestId").value = adRequest.id;

    // 1. Fill Text Data
    document.getElementById("modalAdvertiserName").textContent =
      adRequest.advertiser_name || "N/A";

    const start = adRequest.start_datetime;
    const end = adRequest.end_datetime;

    const hours = calculateHours(start, end);
    document.getElementById("modalAdDate").textContent = hours + " hours";

    // 2. Generate Download Link Logic
    const downloadContainer = document.getElementById("modalDownloadContainer");

    console.log("Container Found?", downloadContainer);
    console.log("Poster Path:", adRequest.poster_path);

    if (downloadContainer) {
      if (adRequest.poster_path) {
        const cleanPath = adRequest.poster_path.replace(/^\//, "");
        const webUrl = "/EDULINK/public/" + cleanPath;

        downloadContainer.innerHTML = `
            <a href="${webUrl}" download>
                <button type="button" class="btn-download">Download Poster</button>
            </a>
        `;
      } else {
        downloadContainer.innerHTML = "<span>No document attached</span>";
      }
    }

    const rateInput = document.getElementById("hourlyRate");
    const totalInput = document.getElementById("totalCost");

    rateInput.value = "";
    totalInput.value = "0.00";

    const newRateInput = rateInput.cloneNode(true);
    rateInput.parentNode.replaceChild(newRateInput, rateInput);

    newRateInput.addEventListener("input", function () {
      const rate = parseFloat(this.value) || 0;
      const total = rate * hours;
      totalInput.value = total.toFixed(2);
    });

    // 3. Handle Community Dropdown
    const communityWrapper = document.getElementById("communitySelectWrapper");
    console.log("community drop down hidden" + communityWrapper);
    let selecteCom;
    if (adRequest.placement_option === "community_poster") {
      communityWrapper.classList.remove("hidden"); // Show using class
      const communitySelect = document.getElementById("community-select");
      communities.forEach((element) => {
        if (element.id == adRequest.community_id) {
          selecteCom = element.name;
        } else {
          selecteCom = "Not Found!";
        }
      });
      communitySelect.innerHTML = selecteCom;
    } else {
      communityWrapper.classList.add("hidden"); // Hide using class
    }

    // 4. Show the Modal
    document.getElementById("adReviewModal").style.display = "flex";
  };
});
