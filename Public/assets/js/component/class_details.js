document.addEventListener("DOMContentLoaded", function () {
  const navItems = document.querySelectorAll(".nav-item");
  const contentPanels = document.querySelectorAll(".content-panel");
  const mainHeader = document.getElementById("main-header");
  const mainSubheader = document.getElementById("main-subheader");

  // Subheader text for each panel
  const subheaders = {
    "student-details": "View and manage student information.",
    "academic-details": "Class information, schedules and marking panels.",
    "profit": "Track income, expenses, and profitability.",
    "performance": "Analyze overall performance metrics.",
  };

  navItems.forEach((item) => {
    item.addEventListener("click", function (event) {
      event.preventDefault();

      // Remove active class from all nav items
      navItems.forEach((nav) => nav.classList.remove("active"));

      // Add active class to the clicked item
      this.classList.add("active");

      // Get the target panel ID from the data attribute
      const targetId = this.querySelector("a").getAttribute("data-target");
      const targetPanel = document.getElementById(targetId);

      // Update header text
      mainHeader.textContent = this.querySelector("a").textContent;
      mainSubheader.textContent = subheaders[targetId] || "";

      // Hide all content panels
      contentPanels.forEach((panel) => panel.classList.remove("active"));

      // Show the target panel
      if (targetPanel) {
        targetPanel.classList.add("active");
      }
    });
  });

  // Teacher card click functionality - UNCHANGED
  const teacherCards = document.querySelectorAll(".teacher-card");
  const emptyState = document.querySelector(".empty-state");
  const teacherDetailsContent = document.querySelector(".teacher-details-content");

  teacherCards.forEach((card) => {
    card.addEventListener("click", function () {
      const teacherId = this.dataset.teacherId;
      if (!teacherId) return;

      const urlParams = new URLSearchParams(window.location.search);
      const subject = urlParams.get("subject");
      const search  = urlParams.get("search");

      let url = `?teacher_id=${teacherId}`;
      if (subject) url += `&subject=${encodeURIComponent(subject)}`;
      if (search)  url += `&search=${encodeURIComponent(search)}`;

      window.location.href = url;
    });
  });

  // Payment filter - UNCHANGED
  document.getElementById('payment-filter').addEventListener('change', function(){
    const filter = this.value;
    const rows = document.querySelectorAll('.table-row');
    let count = 0;

    rows.forEach(row => {
      const badge = row.querySelector('.payment-badge');
      if(!badge) return;

      const status = badge.textContent.trim().toLowerCase();

      if(filter === 'all' || status === filter){
        row.style.display = '';
        count++;
      } else {
        row.style.display = 'none';
      }
    });

    document.querySelector('.student-count').innerHTML = 
      `<span class="count-dot"></span> ${count} Students Listed`;
  });

});

// STUDENT PROFILE MODAL - UNCHANGED
let modalOverlay;

document.addEventListener("DOMContentLoaded", function () {

  modalOverlay = document.querySelector(".modal-overlay");

  document.querySelectorAll(".view-profile-link").forEach(link => {
    link.addEventListener("click", function(e){
      e.preventDefault();

      const studentId = this.dataset.studentId;
      console.log("Fetch URL:", `${appRoot}/ClassMgt/getStudent/${studentId}`);
      if(!studentId) return;

      fetch(`${appRoot}/ClassMgt/getStudent/${studentId}`)
        .then(res => res.json())
        .then(student => {
          if(student.error){
            alert(student.error);
            return;
          }

          document.querySelector(".student-name-popup").textContent =
            student.first_name + " " + student.last_name;

          document.getElementById("popup-student-id").textContent =
            "#" + String(student.student_id).padStart(3,'0') + " • " + student.stream + " Stream";

          document.getElementById("popup-phone").textContent = student.phone_number ?? "-";
          document.getElementById("popup-email").textContent = student.email ?? "-";
          document.getElementById("popup-enrollment-date").textContent = "Enrolled: " + student.enrollment_date;
          document.getElementById("popup-address").textContent = student.address ?? "-";
          document.getElementById("popup-nic").textContent = student.nic ?? "-";
          document.getElementById("popup-school").textContent = student.school_name ?? "-";
          document.getElementById("popup-guardian-name").textContent = student.guardian_name ?? "-";
          document.getElementById("popup-guardian-contact").textContent = student.guardian_contact ?? "-";

          // Profile picture or initials
          const avatarEl = document.getElementById('popup-avatar');
          if (student.profile_picture) {
              avatarEl.innerHTML = `<img src="${appRoot}/uploads/students/${student.profile_picture}" alt="Profile" class="profile-image">`;
          } else {
              const initials = student.first_name.charAt(0).toUpperCase() + student.last_name.charAt(0).toUpperCase();
              avatarEl.innerHTML = `<div class="profile-initials">${initials}</div>`;
          }


          modalOverlay.style.display = "flex";
        })
        .catch(err => {
          console.error(err);
          alert("Failed to fetch student data.");
        });
    });
  });

});

// Close modal - UNCHANGED
function closeModal(){
  modalOverlay.style.display = "none";
}

window.addEventListener("click", function(e){
  if(e.target === modalOverlay){
    modalOverlay.style.display = "none";
  }
});
