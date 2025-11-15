<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLink-Class-Academic Details</title>
    <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/class_details.css">
    <link href="<?php  echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
    
</head>
<body>

<?php include __DIR__.'/Component/nav.view.php'; ?>
    <div class="dashboard">
        <aside class="sidebar">
        <div class="sidebar-header">
            <span class="menu-icon">&#9776;</span>
            <span>Dashboard</span>
        </div>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="#" data-target="student-details">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span>Student Details</span>
                </a>
            </li>
            <li class="nav-item active">
                <a href="#" data-target="academic-details">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10.5V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h12.5"></path><path d="M16 2v4"></path><path d="M8 2v4"></path><path d="M3 10h19"></path><path d="m21.5 17-1.4-1.4a2 2 0 0 0-2.8 0L14 19a2 2 0 0 0 0 2.8l1.4 1.4a2 2 0 0 0 2.8 0L21.5 20a2 2 0 0 0 0-2.8z"></path></svg>
                    <span>Academic Details</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" data-target="profit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    <span>Profit</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" data-target="performance">
                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
                    <span>Performance</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <h1 id="main-header" class="content-header">Academic Details</h1>
        <p id="main-subheader" class="content-subheader">Class information, schedules and marking panel.</p>

        <!-- Student Details Panel -->
        <div id="student-details" class="content-panel">
            <!-- Content for this panel will be created later -->
        </div>

        <!-- Academic Details Panel -->
        <div id="academic-details" class="content-panel active">
           
            <!-- Class Incharge Teacher -->
            <div class="details-card">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="10" cy="7" r="4"></circle></svg>
                    <span>Class Incharge Teacher</span>
                </div>
                <div class="teacher-details">
                    <div class="name">Mr. H.W.M.S. Jhon</div>
                    <div class="qualification">Bsc in Computer science</div>
                </div>
                <div class="contact-info">
                    <div>
                        <div class="label">Email</div>
                        <div>jhon@gmail.com</div>
                    </div>
                    <div>
                        <div class="label">Phone</div>
                        <div>+94 77 66778899</div>
                    </div>
                </div>
            </div>

            <!-- Class Schedule -->
            <div class="details-card">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <span>Class Schedule</span>
                </div>
                <div class="schedule-item">
                    <div>
                        <div class="schedule-day">Monday</div>
                        <div class="schedule-time">3:00 PM - 5:00 PM</div>
                    </div>
                    <div class="schedule-location">
                        <span>Room 201</span>
                        <span>Online Class</span>
                    </div>
                </div>
                <div class="schedule-item">
                    <div>
                        <div class="schedule-day">Saturday</div>
                        <div class="schedule-time">3:00 PM - 5:00 PM</div>
                    </div>
                    <div class="schedule-location">
                        <span>Room 201</span>
                        <span>Online Class</span>
                    </div>
                </div>
            </div>
            
            <!-- Paper Marking Panel -->
            <div class="details-card">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span>Paper Marking Panel</span>
                </div>
                <div class="marker-item">
                    <span class="marker-name">W.S.A. William</span>
                    <span>william@gmail.com</span>
                    <span>+94 76 55566788</span>
                </div>
                 <div class="marker-item">
                    <span class="marker-name">H.M.M. Emily</span>
                    <span>emily@gmail.com</span>
                    <span>+94 76 55577788</span>
                </div>
            </div>

        </div>

        <!-- Profit Panel -->
        <div id="profit" class="content-panel">
            <!-- Content for this panel will be created later -->
        </div>

        <!-- Performance Panel -->
<div id="performance" class="content-panel">
            <!-- Teacher Progress Card -->
            <div class="details-card">
                <div class="card-title">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v15H6.5A2.5 2.5 0 0 1 4 14.5v-10A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    <span>Teacher Progress - Mr H.W.M.S. Jhon</span>
                </div>
                <div class="progress-item">
                    <div class="progress-label">
                        <span class="title">Units completed</span>
                        <span class="value">6 out of 12 units</span>
                        <span class="percentage">50%</span>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-bar progress-bar-secondary" style="width: 50%;"></div>
                    </div>
                </div>
                <div class="progress-item">
                    <div class="progress-label">
                        <span class="title">Papers Conducted</span>
                        <span class="value">4 out of 16 papers</span>
                        <span class="percentage">25%</span>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-bar progress-bar-secondary" style="width: 25%;"></div>
                    </div>
                </div>
            </div>

            <!-- Marking Panel Progress -->
            <div class="details-card">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                    <span>Marking Panel Progress</span>
                </div>
                <div class="progress-item">
                    <div class="progress-label">
                        <span class="title">W.S.A. William</span>
                        <span class="value">1 out of 2 papers</span>
                        <span class="percentage">50%</span>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-bar progress-bar-primary" style="width: 50%;"></div>
                    </div>
                </div>
                <div class="progress-item">
                    <div class="progress-label">
                        <span class="title">W.S.A. William</span>
                        <span class="value">0 out of 2 papers</span>
                        <span class="percentage">0%</span>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-bar progress-bar-primary" style="width: 0%;"></div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="summary-card-row">
                <div class="summary-card">
                    <div class="summary-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <div>
                        <div class="summary-card-value">9</div>
                        <div class="summary-card-label">Units Completed</div>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    </div>
                    <div>
                        <div class="summary-card-value">4</div>
                        <div class="summary-card-label">Papers Conducted</div>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><polyline points="9 15 11 17 15 13"></polyline></svg>
                    </div>
                    <div>
                        <div class="summary-card-value">1</div>
                        <div class="summary-card-label">Papers Corrected</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
    <script src="<?php  echo ROOT ?>/assets/js/component/class_details.js"></script>

</body>
</html>