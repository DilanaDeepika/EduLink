//Handle Find Teacher button click
const btnFindTeacher = document.getElementById("btn-find-teacher");
if (btnFindTeacher) {
  btnFindTeacher.addEventListener("click", function (event) {
    event.preventDefault(); // stop form submission
    window.location.href = "createClassFindTeacher.view.php"; //move find teacher page
  });
}

//Handle Plan Class button click
const btnPlanClass = document.getElementById("btn-plan-class");
if (btnPlanClass) {
  btnPlanClass.addEventListener("click", function (event) {
    event.preventDefault(); // stop form submission
    window.location.href = "CreateClass"; // move to Plan Class Page
  });
}
