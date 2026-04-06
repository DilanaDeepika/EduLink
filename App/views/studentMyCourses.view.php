<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - EduLink</title>
    <link rel="stylesheet" href="../../Public/assets/css/studentMyCourses.css?v=1.1">
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
        <a href="../views/studentEditProfile.view.php" class="sidebar-item">
          <i class="fa-regular fa-user"></i>
          <span>Edit Profile</span>
        </a>
        <a href="../views/studentMyCourses.view.php" class="sidebar-item active">
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
        <div class="page-header">
            <h1><i class="fa-solid fa-book-open"></i> My Courses</h1>
            <p>Track your learning progress and continue where you left off</p>
        </div>

        <!-- Courses Box -->
        <div class="courses-box">
            <!-- Course Card 1 -->
            <div class="course-card">
                <div id="class_thumbnail" class="course-thumbnail blue">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none">
                        <path d="M18 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V4C20 2.9 19.1 2 18 2ZM9 4H11V9L10 8.25L9 9V4Z" fill="white"/>
                    </svg>
                </div>
                <div class="course-info">
                    <div class="course-header">
                        <h3 id="class_name">Combined Mathematics</h3>
                        <span id="class_status" class="status-badge in-progress">In Progress</span>
                    </div>
                    <p id="teacher_name" class="instructor">Janaka Abeywardhana</p>
                    
                    <div class="progress-section">
                        <div class="progress-header">
                            <span>Progress</span>
                            <span id="class_progress" class="progress-percent">75%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 75%"></div>
                        </div>
                    </div>

                    <div class="course-meta">
                        <div class="meta-item">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5" fill="none"/>
                                <path d="M8 4V8L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <span>18/24 lessons</span>
                        </div>
                        <div class="meta-item">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M8 2C4.7 2 2 4.7 2 8C2 11.3 4.7 14 8 14C11.3 14 14 11.3 14 8C14 4.7 11.3 2 8 2Z" stroke="currentColor" stroke-width="1.5" fill="none"/>
                                <path d="M8 5V8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <span>8 weeks</span>
                        </div>
                    </div>

                    <button id="btn-continue" class="btn-continue">Continue Learning</button>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="course-card">
                <div id="class_thumbnail" class="course-thumbnail gradient-1">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none">
                        <path d="M18 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V4C20 2.9 19.1 2 18 2ZM9 4H11V9L10 8.25L9 9V4Z" fill="white"/>
                    </svg>
                </div>
                <div class="course-info">
                    <div class="course-header">
                        <h3 id="class_name">Chemistry</h3>
                        <span class="status-badge in-progress">In Progress</span>
                    </div>
                    <p id="teacher_name" class="instructor">Sriyani Dias</p>
                    
                    <div class="progress-section">
                        <div class="progress-header">
                            <span id="class_status">Progress</span>
                            <span id="class_progress" class="progress-percent">60%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 60%"></div>
                        </div>
                    </div>

                    <div class="course-meta">
                        <div class="meta-item">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5" fill="none"/>
                                <path d="M8 4V8L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <span>10/32 lessons</span>
                        </div>
                        <div class="meta-item">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M8 2C4.7 2 2 4.7 2 8C2 11.3 4.7 14 8 14C11.3 14 14 11.3 14 8C14 4.7 11.3 2 8 2Z" stroke="currentColor" stroke-width="1.5" fill="none"/>
                                <path d="M8 5V8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <span>10 weeks</span>
                        </div>
                    </div>

                    <button id="btn-continue" class="btn-continue">Continue Learning</button>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="course-card">
                <div id="class_thumbnail" class="course-thumbnail pink">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none">
                        <path d="M18 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V4C20 2.9 19.1 2 18 2ZM9 4H11V9L10 8.25L9 9V4Z" fill="white"/>
                    </svg>
                </div>
                <div class="course-info">
                    <div class="course-header">
                        <h3 id="class_name">ICT</h3>
                        <span id="class_status" class="status-badge completed">Completed</span>
                    </div>
                    <p id="teacher_name" class="instructor">Mihin Gamage</p>
                    
                    <div class="progress-section">
                        <div class="progress-header">
                            <span>Progress</span>
                            <span id="class_progress" class="progress-percent">100%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill completed" style="width: 100%"></div>
                        </div>
                    </div>

                    <div class="course-meta">
                        <div class="meta-item">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5" fill="none"/>
                                <path d="M8 4V8L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <span>20/20 lessons</span>
                        </div>
                        <div class="meta-item">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M8 2C4.7 2 2 4.7 2 8C2 11.3 4.7 14 8 14C11.3 14 14 11.3 14 8C14 4.7 11.3 2 8 2Z" stroke="currentColor" stroke-width="1.5" fill="none"/>
                                <path d="M8 5V8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <span>6 weeks</span>
                        </div>
                    </div>

                    <button id="btn-review" class="btn-review">Review Course</button>
                </div>
            </div>
        </div>
     
    </main>
   </div>
    <script src="../../Public/assets/js/studentMyCourses.view.js"></script>
</body>
</html>