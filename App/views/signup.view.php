<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - EduLink</title>
        <link
      href="<?php  echo ROOT ?>/assets/css/signup.css"
      rel="stylesheet"
    />
        <link
      href="<?php  echo ROOT ?>/assets/css/component/nav.css"
      rel="stylesheet"
    />
    <link
      href="<?php  echo ROOT ?>/assets/css/component/footer-styles.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
      .signup-errors {
        width: 100%;
        background-color: #ffebee; /* Light red */
        color: #c62828; /* Dark red */
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #c62828;
        margin-bottom: 20px;
        box-sizing: border-box; /* Ensures padding doesn't break layout */
      }
      .signup-errors p {
        margin: 5px 0;
        font-weight: 500;
      }
    </style>
</head>
<body>
    <?php include __DIR__.'/Component/nav.view.php'; ?>
    <main class="signup-main_content">
        <div class="signup-left_content">
                <img src="<?php  echo ROOT ?>/assets/images/signup.png" alt="signup" />
          </div>
        </div>
        <div class="signup-form_content">
            
            <?php if (!empty($data['errors'])): ?>
                <div class="signup-errors">
                    <?php foreach ($data['errors'] as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <h2>Sign Up With Your Email</h2>
            
            <form id="signup-form" method="POST" action= "<?php echo ROOT ?>/StudentRegister">
                
                <input type="email" name="email" placeholder="Email" required/>
                
                <input type="password" name="password" placeholder="Password" required/>
                
                <div class="custom-select-wrapper">
                  <select class="custom-select" name="role" id="actor-select">
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                    <option value="institute">Institute</option>
                  </select>
                </div>
                <button type="submit" class="continue">
                    <i class="fa-regular fa-envelope"></i>
                    <span class="iconmsg">Continue with email</span>
                </button>
                <p class="terms">By signing up, you agree to our <a href="#">Terms</a> and <a href="#">Privacy Policy</a></p>
                
                <p class="login-link">Already have an account? <a href="<?php echo ROOT ?>/login"> Login in</a></p>
            </form>
            
        </div>
    </main>
        <?php include __DIR__.'/Component/footer.view.php'; ?>
        <script>
          const actionUrls = {
            'student': '<?php echo ROOT ?>/StudentRegister',
            'teacher': '<?php echo ROOT ?>/TeacherRegister',
            'institute': '<?php echo ROOT ?>/InstituteRegister'
          };
      </script>
        <script src="<?php  echo ROOT ?>/assets/js/signUp.js"></script>
</body>
</html>