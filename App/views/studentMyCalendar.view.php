<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/assets/css/studentMyCalendar.css?v=1.1">
    <link rel="stylesheet" href="../../Public/assets/css/component/StudentProfileHeader.css?v=1.1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Header -->

    <?php include __DIR__ . '/Component/studentProfileHeader.view.php';?>

    <div class="layout">
    <!-- Sidebar -->
    <aside class="sidebar">

      <nav class="sidebar-nav">
        <a href="../views/studentProfileMain.view.php" class="sidebar-item">
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
        <a href="../views/studentMyCalendar.view.php" class="sidebar-item active">
          <i class="fa-regular fa-calendar"></i>
          <span>My Calendar</span>
        </a>
      </nav>
    </aside>


    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title"><i class="fa-regular fa-calendar"></i> My Calendar</h1>
                <p class="page-subtitle">Stay organized with your upcoming classes and events</p>
            </div>
        </div>
    </main>
</body>
</html>