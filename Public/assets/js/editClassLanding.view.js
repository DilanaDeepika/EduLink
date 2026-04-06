//Handle Find Teacher button click
const btnFindTeacher = document.getElementById('btn-edit-teacher');
if (btnFindTeacher) {
    btnFindTeacher.addEventListener('click', function(event) {
    event.preventDefault(); // stop form submission
    window.location.href = "editClassFindTeacher.view.php";//move find teacher page
    })   ;
}
       
//Handle Plan Class button click
const btnPlanClass = document.getElementById('btn-edit-class');
if (btnPlanClass) {
    btnPlanClass.addEventListener('click', function(event) {
    event.preventDefault(); // stop form submission
    window.location.href ="editClassMain-institute.view.php"; // move to Plan Class Page
    });
}