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
    <main>
      <div class="std-reg-form-container">
        <form class="std-reg-form-left" method="POST" action="<?php echo ROOT ?>/signup/save_student_details">
          <h2>Student Account Setup</h2>

          <div class="input-row">
            <input type="text" name="first_name" placeholder="First Name" required />
            <input type="text" name="last_name" placeholder="Last Name" required />
          </div>

          <input type="text" name="school" placeholder="School" />
          <input type="text" name="address" placeholder="Address" />

          <div class="dropdown-group">
            <select name="stream" required>
              <option value="" disabled selected>Stream</option>
              <option value="Science">Science</option>
              <option value="Commerce">Commerce</option>
              <option value="Arts">Arts</option>
            </select>
          </div>

          <button type="submit" class="submit-btn">Submit</button>
        </form> <div class="std-reg-form-right">
          <div class="image-placeholder">
            <img src="<?php  echo ROOT ?>/assets/images/student_signup.png" alt="student_signup" />
          </div>
        </div>
      </div>
    </main>
  </body>
</html>