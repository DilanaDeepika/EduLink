//Handle Next button click
const btnNextCore = document.getElementById('btn-next-core');
if (btnNextCore) {
    btnNextCore.addEventListener('click', function(event) {
    event.preventDefault(); // stop form submission
    show('view-advance'); // move to Basic Information section
    });
}