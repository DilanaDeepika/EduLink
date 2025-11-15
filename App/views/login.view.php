<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>

  <!-- CSS Links -->
  <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/login.css" />
  <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/component/nav.css" />
  <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/component/footer-styles.css" />
</head>
<body>
  <header>
    <?php include __DIR__ . '/Component/nav.view.php'; ?>
  </header>

  <div class="login-page">
    <div class="login-container">

      <!-- Left Section (Illustration) -->
      <div class="login-illustration">
        <img src="<?php echo ROOT ?>/assets/images/login.png" alt="Learning Illustration" />
      </div>

      <!-- Right Section (Form) -->
      <div class="login-form-section">
        <h2>Log in to continue your learning journey</h2>

        <form action="<?php echo ROOT ?>/login" method="post">
          <div class="form-group">
            <label for="email">Email</label>
            <input 
              type="email" 
              id="email" 
              name="email" 
              placeholder="Enter your email" 
              required 
            />
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input 
              type="password" 
              id="password" 
              name="password" 
              placeholder="Enter your password" 
              required 
            />
          </div>

          <button type="submit" class="login-btn">Continue</button>
        </form>


      </div>
    </div>
  </div>

  <footer>
    <?php include __DIR__ . '/Component/footer.view.php'; ?>
  </footer>
</body>
</html>
