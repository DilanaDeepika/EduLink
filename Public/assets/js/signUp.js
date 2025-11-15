document.addEventListener("DOMContentLoaded", function () {
  const actorSelect = document.getElementById("actor-select");
  const signupForm = document.getElementById("signup-form");


  actorSelect.addEventListener("change", function () {
    const selectedActor = this.value;
    console.log(selectedActor);
    if (actionUrls[selectedActor]) {
      signupForm.action = actionUrls[selectedActor];
    }
  });
});
