<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Institute Registration</title>
    <link
      rel="stylesheet"
      href="<?php  echo ROOT ?>/assets/css/institute_register.css"
    />
    <link
      href="<?php  echo ROOT ?>/assets/css/component/nav.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
  </head>
  <body>
    <?php include __DIR__.'/Component/nav.view.php'; ?>
    <main class="inst-reg-container">
      <section class="inst-reg-form-section">
        <h2>Institute Account Setup</h2>
        
        <form method="POST" action="<?php echo ROOT ?>/signup/save_institute_details" enctype="multipart/form-data">
          
          <input type="text" name="institute_name" placeholder="Institute Name" required />
          <input type="text" name="address" placeholder="Institute Address" required />
          <input type="tel" name="phone" placeholder="Phone number" required />

          <input type="file" name="files[]" id="file-upload-input" multiple hidden />

          <label for="file-upload-input" class="upload-box" id="upload-box">
            <div class="upload-icon">
              <i class="fa-solid fa-arrow-up-from-bracket"></i>
            </div>
            <div id="upload-info" class="upload-info">
              <p>Drag and Drop files<br /><span>or</span></p>
            </div>
            <button type="button" class="browse-btn" id="browse-btn">Browse</button>
          </label>

          <button type="submit" class="submit-btn">Submit</button>
        </form>
      </section>

      <section class="inst-reg-requirements-section">
        <div class="right-content-wrapper">
            <div class="img-placeholder">
              <img
                src="<?php  echo ROOT ?>/assets/images/institute_signup.png"
                alt="institute_signup"
              />
            </div>
    
            <div class="inst-reg-checklist" id="checklist">
              <div class="checklist-item" data-keyword="registration">
                <div>
                  <p>Copy of Business Registration Certificate</p>
                  <small>Upload a certified copy of your institute’s legal registration.</small>
                </div>
                <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
              </div>
    
              <div class="checklist-item" data-keyword="nic">
                <div>
                  <p>Copy of Authorized Person's NIC</p>
                  <small>National Identity Card of the representative signing up.</small>
                </div>
                <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
              </div>
    
              <div class="checklist-item" data-keyword="address">
                <div>
                  <p>Proof of Institute Address</p>
                  <small>Utility bill or rental agreement with institute’s name and address.</small>
                </div>
                <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
              </div>
    
              <div class="checklist-item" data-keyword="tax">
                <div>
                  <p>Copy of Tax Identification Number</p>
                  <small>Provide official tax registration documents.</small>
                </div>
                <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
              </div>
            </div>
        </div>
      </section>
    </main>

    <script src="<?php echo ROOT ?>/assets/js/signUpDetails.js"></script>
  </body>
</html>