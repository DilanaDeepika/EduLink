<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EduLink - Student Dashboard</title>
  <link rel="stylesheet" href="../../Public/assets/css/studentProfileMain.css?v=1.1" />
  <link rel="stylesheet" href="../../Public/assets/css/component/StudentProfileHeader.css?v=1.1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <?php include __DIR__ . '/Component/studentProfileHeader.view.php';?>

  <div class="layout">
    <!-- Sidebar -->
    <aside class="sidebar">

      <nav class="sidebar-nav">
        <a href="../views/studentProfileMain.view.php" class="sidebar-item active">
          <i class="fa-solid fa-gear"></i>
          <span>Settings</span>
        </a>
        <a href="../views/studentEditProfile.view.php" class="sidebar-item">
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
      <!-- Profile Section -->
      <section class="profile-card">
        <div class="profile-avatar" id="StudentprofileAvatar">KG</div>
        <div class="profile-info">
          <h2>Kevin Gilbert</h2>
          <button id="btn_edit" class="btn-edit">Edit Profile</button>
        </div>
      </section>

      <!-- Stats Cards -->
      <div class="stats-box">
        <div class="stat-card">
          <div class="stat-content">
            <div>
              <div class="stat-label">Enrolled Courses</div>
              <div class="stat-value">8</div>
            </div>
            <div class="stat-icon blue">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect x="3" y="6" width="18" height="13" rx="2" stroke="currentColor" stroke-width="2" fill="none"/>
                <path d="M3 10h18" stroke="currentColor" stroke-width="2"/>
              </svg>
            </div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-content">
            <div>
              <div class="stat-label">Completed</div>
              <div class="stat-value">5</div>
            </div>
            <div class="stat-icon orange">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="currentColor" stroke-width="2" fill="none"/>
              </svg>
            </div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-content">
            <div>
              <div class="stat-label">Upcoming Classes</div>
              <div class="stat-value">12</div>
            </div>
            <div class="stat-icon blue">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect x="4" y="5" width="16" height="16" rx="2" stroke="currentColor" stroke-width="2" fill="none"/>
                <path d="M4 10h16M9 2v4M15 2v4" stroke="currentColor" stroke-width="2"/>
              </svg>
            </div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-content">
            <div>
              <div class="stat-label">Total Spent</div>
              <div class="stat-value">$2,450</div>
            </div>
            <div class="stat-icon orange">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect x="2" y="6" width="20" height="12" rx="2" stroke="currentColor" stroke-width="2" fill="none"/>
                <path d="M2 10h20" stroke="currentColor" stroke-width="2"/>
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- Action Cards -->
      <div class="action-cards">
        <div class="action-card">
          <div class="action-header">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
              <rect x="2" y="4" width="16" height="12" rx="1" stroke="currentColor" stroke-width="1.5" fill="none"/>
              <path d="M2 8h16" stroke="currentColor" stroke-width="1.5"/>
            </svg>
            <h3>My Courses</h3>
          </div>
          <p class="action-description">Manage your enrolled courses and track your progress.</p>
          <button class="btn-action">View Courses</button>
        </div>

        <div class="action-card">
          <div class="action-header">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
              <rect x="3" y="5" width="14" height="10" rx="1" stroke="currentColor" stroke-width="1.5" fill="none"/>
              <path d="M6 5V4a1 1 0 011-1h6a1 1 0 011 1v1" stroke="currentColor" stroke-width="1.5"/>
            </svg>
            <h3>Payments</h3>
          </div>
          <p class="action-description">Check your payment history and your upcoming invoices.</p>
          <button class="btn-action">View Payments</button>
        </div>

        <div class="action-card">
          <div class="action-header">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
              <rect x="3" y="4" width="14" height="13" rx="1" stroke="currentColor" stroke-width="1.5" fill="none"/>
              <path d="M3 8h14M7 2v3M13 2v3" stroke="currentColor" stroke-width="1.5"/>
            </svg>
            <h3>Calendar</h3>
          </div>
          <p class="action-description">Stay organized with your class schedule and deadlines.</p>
          <button class="btn-action">View Calendar</button>
        </div>
      </div>
    </main>
  </div>

  <script src="../../Public/assets/js/studentProfileMain.view.js"></script>
</body>
</html>
