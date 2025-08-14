<?php include __DIR__ . '/component/nav.view.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Institute Registration</title>
  <link rel="stylesheet" href="../../Public/assets/css/institute_register.css">
  <link rel="stylesheet" href="../../Public/assets/css/nav.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

  <main class="container">
    <section class="form-section">
      <h2>Institute Account Setup</h2>
      <form>
        <input type="text" placeholder="Institute Name" required>
        <input type="text" placeholder="Institute Address" required>
        <input type="text" placeholder="Owner's Name" required>
        <input type="tel" placeholder="Owner's Phone Number" required>

        <div class="upload-box">
          <div class="upload-icon"><i class="fa-solid fa-arrow-up-from-bracket"></i></div>
          <p class="upload-text">Drag and Drop file<br><span>or</span></p>
          <button type="button" class="browse-btn">Browse</button>
        </div>

        <button type="submit" class="submit-btn">Submit</button>
      </form>
    </section>

    <section class="requirements-section">
      <div class="img-placeholder"></div>

      <div class="checklist">
        <div class="checklist-item">
          <div>
            <p>Copy of Business Registration Certificate</p>
            <small>Upload a certified copy of your institute’s legal registration or license.</small>
          </div>
          <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
        </div>

        <div class="checklist-item">
          <div>
            <p>Copy of Authorized Person's NIC</p>
            <small>National Identity Card of the representative signing up.</small>
          </div>
          <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
        </div>

        <div class="checklist-item">
          <div>
            <p>Proof of Institute Address</p>
            <small>Utility bill or rental agreement with institute’s name and address.</small>
          </div>
          <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
        </div>

        <div class="checklist-item">
          <div>
            <p>Copy of Tax Identification Number</p>
            <small>Provide official tax registration documents.</small>
          </div>
          <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
        </div>
      </div>
    </section>
  </main>

</body>
</html>
