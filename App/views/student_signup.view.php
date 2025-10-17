<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Account Setup</title>
    <link
      href="<?php  echo ROOT ?>/assets/css/student_signup.css"
      rel="stylesheet"
    />
    <link
      href="<?php  echo ROOT ?>/assets/css/component/nav.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <?php include __DIR__.'/Component/nav.view.php'; ?>
    <!-- Main Form Section -->
    <main>
      <div class="std-reg-form-container">
        <div class="std-reg-form-left">
          <h2>Student Account Setup</h2>

          <div class="input-row">
            <input type="text" placeholder="First Name" />
            <input type="text" placeholder="Last Name" />
          </div>

          <input type="text" placeholder="School" />
          <input type="text" placeholder="Address" />

          <div class="dropdown-group">
            <select>
              <option>Stream</option>
              <option>Science</option>
              <option>Commerce</option>
              <option>Arts</option>
            </select>
          </div>

          <button class="submit-btn">Submit</button>
        </div>

        <div class="std-reg-form-right">
          <div class="image-placeholder">
            <img src="<?php  echo ROOT ?>/assets/images/student_signup.png" alt="student_signup" />
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
