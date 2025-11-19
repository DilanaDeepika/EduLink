<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher Registration</title>
    <link
      href="<?php  echo ROOT ?>/assets/css/teacher_register.css"
      rel="stylesheet"
    />
    <link
      href="<?php  echo ROOT ?>/assets/css/component/nav.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
      integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <?php include __DIR__.'/Component/nav.view.php'; ?>
    <main class="teach-reg-container">
      <section class="teach-reg-left-content">
        <h2>Teacher Account Setup</h2>
        
        <form method="POST" action="<?php echo ROOT ?>/signup/save_teacher_details" enctype="multipart/form-data">
          
          <div class="teach-reg-name-row">
            <input
              type="text"
              name="first_name"
              placeholder="First Name"
              class="input-half"
              required
            />
            <input
              type="text"
              name="last_name"
              placeholder="Last Name"
              class="input-half"
              required
            />
          </div>
          <input type="tel" name="phone" placeholder="Phone Number" required />
          <select name="subject" required>
            <option value="" disabled selected>Select Subject</option>
            <option>Physics</option>
            <option>Chemistry</option>
            <option>Combined Mathematics</option>
            <option>Biology</option>
            <option>ICT</option>
            <option>Accounting</option>
            <option>Economics</option>
            <option>Business Studies</option>
            <option>Media</option>
            <option>Political Science</option>
          </select>

          <div class="upload-instructions">
            <p>For quick verification, please ensure your filenames contain a keyword that matches the document type.</p>
            <ul>
              <li><strong>Degree:</strong> "my_degree_scan.pdf"</li>
              <li><strong>Appointment:</strong> "teacher_appointment.jpg"</li>
            </ul>
          </div>

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

      <section class="teach-reg-right-content">
        <div class="right-content-wrapper">
          <div class="img-placeholder">
            <img src="<?php  echo ROOT ?>/assets/images/teacher_signup.png" alt="teacher_signup" />
          </div>
          <div class="teach-reg-checklist" id="checklist">
            <div class="checklist-item" data-keyword="degree">
              <div>
                <p>Copy of degree certificate</p>
                <small>Upload a certified copy of your highest academic qualification.</small>
              </div>
              <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
            </div>
            <div class="checklist-item" data-keyword="appointment">
              <div>
                <p>Copy of appointment letter</p>
                <small>Provide your current or most recent appointment letter.</small>
              </div>
              <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
            </div>
            <div class="checklist-item" data-keyword="slip">
              <div>
                <p>Copy of last month pay slip</p>
                <small>Submit a recent payslip as proof of employment.</small>
              </div>
              <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
            </div>
            <div class="checklist-item" data-keyword="nic">
              <div>
                <p>Copy of NIC</p>
                <small>Upload a clear copy of your NIC (front and back).</small>
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