<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLink - Edit Profile</title>
    <link rel="stylesheet" href="../../Public/assets/css/studentEditProfile.css?v=1.1">
    <link rel="stylesheet" href="../../Public/assets/css/component/StudentProfileHeader.css?v=1.1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>
    <?php include __DIR__ . '/Component/studentProfileHeader.view.php';?>
    
    <div class="layout">
    <!-- Sidebar -->
    <aside class="sidebar">

      <nav class="sidebar-nav">
        <a href="../views/studentProfileMain.view.php" class="sidebar-item">
          <i class="fa-solid fa-gear"></i>
          <span>Settings</span>
        </a>
        <a href="../views/studentEditProfile.view.php" class="sidebar-item active">
          <i class="fa-regular fa-user"></i>
          <span>Edit Profile</span>
        </a>
        <a href="../views/studentMyCourses.view.php" class="sidebar-item">
          <i class="fa-solid fa-book-open"></i>
          <span>My Courses</span>
        </a>
        <a href="../views/studentMyPayments.view.php" class="sidebar-item">
          <i class="fa-solid fa-credit-card"></i>
          <span>My Payments</span>
        </a>
        <a href="../views/studentMyCalendar.view.php" class="sidebar-item">
          <i class="fa-regular fa-calendar"></i>
          <span>My Calendar</span>
        </a>
      </nav>
    </aside>


    <!-- Main Content -->
    <main class="main-content">
        <!-- Account Settings Section -->
        <section class="account-settings">
            <h2>Account Settings</h2>
            
            <div class="settings-container">
                <div class="avatar-section">
                    <div class="avatar">KG</div>
                    <button id="upload-btn" class="upload-btn">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M8 2L11 5H9V10H7V5H5L8 2Z" fill="currentColor"/>
                            <path d="M14 10V14H2V10H0V14C0 15.1 0.9 16 2 16H14C15.1 16 16 15.1 16 14V10H14Z" fill="currentColor"/>
                        </svg>
                        Upload Photo
                    </button>
                    <p class="image-note">Image size should be at least 300×300px</p>
                </div>

                <form class="profile-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" id="st_first_name" value="Kevin">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" id="st_last_name" value="Gomas">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="st_username" value="kevingomas">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="st_email" value="kevin.gomas@example.com">
                    </div>

                    <div class="form-group">
                        <label>Phone number</label>
                        <input type="text" id="st_phone_no" value="0755645895">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" id="st_address" value="No 45, St.Mary's Road, Colombo 02">
                    </div>

                    <button type="submit" class="btn-save">Save Changes</button>
                </form>
            </div>
        </section>

        <!-- Change Password Section -->
        <section class="change-password">
            <h2>Change Password</h2>
            
            <form class="password-form">
                <div class="form-group">
                    <label>Current Password</label>
                    <div class="password-input">
                        <input type="password" placeholder="Enter current password">
                        <button type="button" class="toggle-password">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M10 4C5 4 1.73 7.11 0 10C1.73 12.89 5 16 10 16C15 16 18.27 12.89 20 10C18.27 7.11 15 4 10 4ZM10 14C7.79 14 6 12.21 6 10C6 7.79 7.79 6 10 6C12.21 6 14 7.79 14 10C14 12.21 12.21 14 10 14ZM10 8C8.9 8 8 8.9 8 10C8 11.1 8.9 12 10 12C11.1 12 12 11.1 12 10C12 8.9 11.1 8 10 8Z" fill="#666"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <div class="password-input">
                        <input type="password" placeholder="Enter new password">
                        <button type="button" class="toggle-password">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M10 4C5 4 1.73 7.11 0 10C1.73 12.89 5 16 10 16C15 16 18.27 12.89 20 10C18.27 7.11 15 4 10 4ZM10 14C7.79 14 6 12.21 6 10C6 7.79 7.79 6 10 6C12.21 6 14 7.79 14 10C14 12.21 12.21 14 10 14ZM10 8C8.9 8 8 8.9 8 10C8 11.1 8.9 12 10 12C11.1 12 12 11.1 12 10C12 8.9 11.1 8 10 8Z" fill="#666"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="password-input">
                        <input type="password" placeholder="Confirm new password">
                        <button type="button" class="toggle-password">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M10 4C5 4 1.73 7.11 0 10C1.73 12.89 5 16 10 16C15 16 18.27 12.89 20 10C18.27 7.11 15 4 10 4ZM10 14C7.79 14 6 12.21 6 10C6 7.79 7.79 6 10 6C12.21 6 14 7.79 14 10C14 12.21 12.21 14 10 14ZM10 8C8.9 8 8 8.9 8 10C8 11.1 8.9 12 10 12C11.1 12 12 11.1 12 10C12 8.9 11.1 8 10 8Z" fill="#666"/>
                        </button>
                    </div>
                </div>
            
                <button type="submit" class="btn-change-password">Change Password</button>
            </form>
        </section>
    </main>
    </div>
    <script src="../../Public/assets/js/studentEditProfile.view.js"></script>
</body>
</html>
