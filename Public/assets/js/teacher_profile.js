document.addEventListener("DOMContentLoaded", function () {
  const sidebarItems = document.querySelectorAll(".sidebar-item");
  const contentSections = document.querySelectorAll(".content-section");

 
  function activateSection(targetId) {
   
    contentSections.forEach(section => section.classList.remove("active"));

    const targetSection = document.getElementById(targetId);
    if (!targetSection) return;

    targetSection.classList.add("active");

    sidebarItems.forEach(item => item.classList.remove("active"));

    const sidebarLink = document.querySelector(`.sidebar-item[data-target="${targetId}"]`);
    if (sidebarLink) sidebarLink.classList.add("active");

    targetSection.scrollIntoView({ behavior: "smooth" });

    const baseUrl = window.location.pathname;
    history.replaceState(null, "", baseUrl + "?section=" + targetId);

  }

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
        targetSection.scrollIntoView({behaviour: "smooth"});
        
      }
      history.replaceState(null, "", "?section=" + targetId);
    });
  });

  const profileEditBtn = document.querySelector(".profile-info .btn-secondary");
  if(profileEditBtn){
    profileEditBtn.addEventListener("click", () => {
        activateSection('edit-profile');
    });
  }

  /* Upload Photo Button Handler
const uploadBtn = document.getElementById("uploadBtn");
const photoInput = document.getElementById("photoInput");
const photoForm = document.getElementById("photoForm");

if (uploadBtn && photoInput && photoForm) {
  uploadBtn.addEventListener("click", () => {
    photoInput.click();  // open file dialog
  });

  photoInput.addEventListener("change", () => {
    photoForm.submit();  // auto-upload
  });
}
*/
const params = new URLSearchParams(window.location.search);
    const section = params.get("section");

    if (section) {
        activateSection(section);
    }

// Create Community Modal - POPUP
const modal = document.getElementById("communityModal");
const openModalBtn = document.querySelector(".open-modal-btn");
const closeModalBtn = document.querySelector(".close");
const cancelBtn = document.querySelector(".cancel-btn");

if (modal && openModalBtn && closeModalBtn) {
openModalBtn.onclick = () => {
  modal.style.display = "flex";
};

closeModalBtn.onclick = () => {
  modal.style.display = "none";
};

window.onclick = (e) => {
  if (e.target === modal) {
    modal.style.display = "none";
  }
};
}



document.querySelectorAll("[data-upload-form]").forEach(form => {
  const input = form.querySelector("[data-upload-input]");
  const button = form.querySelector("[data-upload-btn]");

  if(!input || !button) return;

  button.addEventListener("click", () => {
    input.click();
  });

  input.addEventListener("change", () => {
    form.submit();
  });
});

});






