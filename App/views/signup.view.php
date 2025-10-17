<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login_page</title>
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
</head>
<body>
    <?php include __DIR__.'/Component/nav.view.php'; ?>
    <main class="signup-main_content">
        <div class="signup-left_content">
                <img src="<?php  echo ROOT ?>/assets/images/signup.png" alt="signup" />
          </div>
        </div>
        <div class="signup-form_content">
            
                <h2>Sign Up With Your Email</h2>
                <form>
                    <input type="email" placeholder="Email" required/>
                    <input type="password" placeholder="Password" required/>
                    <select>
                        <option>Student</option>
                        <option>Admin</option>
                        <option>Teacher</option>
                        <option>Institute</option>
                        <option>Marking Panel</option>
                    </select>
                    <button type="submit" class="continue">
                        <i class="fa-regular fa-envelope"></i>
                        <span class="iconmsg">Continue with email</span>
                    </button>
                    <p class="terms">By signing up, you agree to our <a href="#">Terms</a> and <a href="#">Privacy Policy</a></p>
                    <button type="submit" class="login-link"><span>Already have an account? <a href="#"> Login in</a></span></button>
                </form>
            
        </div>
    </main>
        <?php include __DIR__.'/Component/footer.view.php'; ?>
</body>
</html>