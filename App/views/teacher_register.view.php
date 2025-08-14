<?php include __DIR__ . '/component/nav.view.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Registration</title>
    <link rel="stylesheet" href="../../Public/assets/css/techer_register.css">
    <link rel="stylesheet" href="../../Public/assets/css/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <nav class="navbar">
        <div class="logo"></div>
        <div class="search-bar-nav-links">
            <input type="text" placeholder="Search here..." class="search-bar">
            <div class="nav-links">
                <a href="#" class="nav-btn">Log in</a>
                <a href="#" class="nav-btn">Sign up</a>
            </div>
        </div>
    </nav>

    <main class="container">
        <section class="left-content">
            <h2>Teacher Account Setup</h2>
            <form>
                <div class="name-row">
                    <input type="text" placeholder="First Name" class="input-half" required>
                    <input type="text" placeholder="Last Name" class="input-half" required>
                </div>
                <input type="text" placeholder="Address" required>
                <input type="text" placeholder="Phone Number" required>
                <select required>
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
                <div class="upload-box">
                      <div class="upload-icon"><i class="fa-solid fa-arrow-up-from-bracket"></i></div>
                      <p class="upload-text">Drag and Drop file<br><span>or</span></p>
                      <button type="button" class="browse-btn">Browse</button>
                </div>
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </section>

        <section class="right-content">
            <div class="img-placeholder"></div>
            <div class="checklist">
                <div class="checklist-item">
                    <div>
                        <p>Copy of degree certificate</p>
                        <small>Upload a certified copy of your highest academic qualification.</small>
                    </div>
                    <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
                </div>
                <div class="checklist-item">
                    <div>
                        <p>Copy of appointment letter</p>
                        <small>Provide your current or most recent appointment letter.</small>
                    </div>
                    <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
                </div>
                <div class="checklist-item">
                    <div>
                        <p>Copy of last month pay slip</p>
                        <small>Submit a recent payslip as proof of employment.</small>
                    </div>
                    <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
                </div>
                <div class="checklist-item">
                    <div>
                        <p>Copy of NIC</p>
                        <small>Upload a clear copy of your NIC (front and back).</small>
                    </div>
                    <span class="check-icon"><i class="fa-regular fa-circle-check"></i></span>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer"></footer>
</body>
</html>
