document.addEventListener("DOMContentLoaded", function () {
  var modal = document.getElementById("adRequestModal");

  if (!modal) {
    return;
  }
  modal.style.display = "none";

  var adForm = document.getElementById("adRequestForm");
  var modalTitle = modal.querySelector("h2");
  var adIdInput = document.getElementById("ad_id");
  var submitButton = adForm.querySelector(".adv-submit-button");
  var fileNameSpan = document.getElementById("advFileName");
  var fileInput = document.getElementById("ad_poster");

  var createBtn = document.getElementById("openAdModalBtn");
  var allEditButtons = document.querySelectorAll(".open-ad-modal");
  var closeBtn = modal.querySelector(".adv-close-button");

  if (createBtn) {
    createBtn.onclick = function () {
      adForm.reset();
      modalTitle.textContent = "Submit Advertisement Request";
      adIdInput.value = "";
      submitButton.textContent = "Send Request";
      fileNameSpan.textContent = "No file selected.";

      adForm.action = `${appRoot}/ClassManager/save_advertisement_request`;

      modal.style.display = "block";
    };
  }

  allEditButtons.forEach(function (button) {
    button.onclick = function (e) {
      e.preventDefault();
      var adId = this.dataset.adId;

      fetch(`${appRoot}/ClassManager/get_ad_details/${adId}`)
        .then(function (response) {
          return response.text();
        })
        .then(function (text) {
          console.log("SERVER RESPONSE:", text);

          try {
            const data = JSON.parse(text);

            if (data.success) {
              adForm.reset();
              modalTitle.textContent = "Edit Advertisement Request";
              adIdInput.value = data.ad.id;
              submitButton.textContent = "Update Request";
              fileNameSpan.textContent =
                "Upload new file to replace current (optional)";
              adForm.action = `${appRoot}/ClassManager/update_advertisement_request/${adId}`;

              var placementRadio = adForm.querySelector(
                `input[name="placement"][value="${data.ad.placement_option}"]`
              );
              if (placementRadio) {
                placementRadio.checked = true;
              }

              adForm.querySelector("#start_time").value = data.ad.start_time;
              adForm.querySelector("#end_time").value = data.ad.end_time;

              modal.style.display = "block";
            } else {
              alert(
                "Error: Could not fetch ad details. Server message: " +
                  data.message
              );
            }
          } catch (e) {
            console.error("JSON Parse Failed:", e);
            alert(
              "Server returned an invalid response. Check the console (F12) to see the PHP error."
            );
          }
        })
        .catch(function (err) {
          console.error("Fetch Error:", err);
          alert("An error occurred. Check the console (F12).");
        });
    };
  });

  if (closeBtn) {
    closeBtn.onclick = function () {
      modal.style.display = "none";
    };
  }

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };

  if (fileInput) {
    fileInput.onchange = function () {
      if (fileInput.files.length > 0) {
        fileNameSpan.textContent = fileInput.files[0].name;
      } else {
        fileNameSpan.textContent = "No file selected.";
      }
    };
  }
});
