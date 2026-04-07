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
            
            <li class="nav-item active">
                <a href="#" data-target="academic-details">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10.5V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h12.5"></path><path d="M16 2v4"></path><path d="M8 2v4"></path><path d="M3 10h19"></path><path d="m21.5 17-1.4-1.4a2 2 0 0 0-2.8 0L14 19a2 2 0 0 0 0 2.8l1.4 1.4a2 2 0 0 0 2.8 0L21.5 20a2 2 0 0 0 0-2.8z"></path></svg>
                    <span>Academic Details</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" data-target="student-details">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span>Student Details</span>
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
            <?php
            $gradeMap = [
                'yr_25' => '2025 A/L',
                'yr_26' => '2026 A/L',
                'yr_27' => '2027 A/L',
                'yr_28' => '2028 A/L'
            ];
            ?>
            <!-- Class Details Section -->
            <div class="class-header">
                <div class="class-header-left">
                    <div class="class-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 22V12H15V22" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="class-info">
                        <div class="class-title-row">
                            <h2 class="class-title">
                                <?= htmlspecialchars($class->class_name) ?>
                            </h2>
                            <span class="batch-badge"><?= $gradeMap[$class->grade_level_name] ?? $class->grade_level_name ?> BATCH</span>
                        </div>
                        <div class="class-schedule">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <circle cx="8" cy="8" r="7" stroke="#6B7280" stroke-width="1.5"/>
                                <path d="M8 4V8L11 11" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <span>
                                <?php if (!empty($schedules)): 
                                    $classSchedule = $schedules[0]; // take first schedule
                                ?>
                                    <?= htmlspecialchars($classSchedule->day_of_week) ?>
                                    <?= date("g:i A", strtotime($classSchedule->start_time)) ?>
                                    -
                                    <?= date("g:i A", strtotime($classSchedule->end_time)) ?>
                                   • <?= htmlspecialchars($classSchedule->location ?? 'Hall A') ?>
                                <?php else: ?>
                                    No schedule available
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                </div>    
                <a href="<?= ROOT ?>/classmgt/export/<?= $class->class_id ?>" class="export-btn">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M14 10V12.6667C14 13.0203 13.8595 13.3594 13.6095 13.6095C13.3594 13.8595 13.0203 14 12.6667 14H3.33333C2.97971 14 2.64057 13.8595 2.39052 13.6095C2.14048 13.3594 2 13.0203 2 12.6667V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.66669 6.66667L8.00002 10L11.3334 6.66667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 10V2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>    
                    Export List
                </a>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Enrolled Students</div>
                    <div class="stat-value">
                        <?= htmlspecialchars($enrolledStudents) ?>
                    </div>
                    <div class="stat-subtitle">Total registered</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Today's Attendance</div>
                    <div class="stat-value">92%</div>
                    <div class="stat-subtitle">24 / 26 present</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Payments Completed</div>
                    <div class="stat-value">
                        <?= htmlspecialchars($paymentsCompleted) ?>
                    </div>
                    <div class="stat-subtitle">Monthly clearance</div>
                </div>

                <div class="stat-card">
                    <div class="stat-label">Pending Payments</div>
                    <div class="stat-value">
                        <?= htmlspecialchars($paymentsPending) ?>
                    </div>
                    <div class="stat-subtitle">Action required</div>
                </div>
            </div>

            <!-- Filters and Student List Header -->
            <div class="filters-section">
                <div class="filter-controls">
                    <span class="filter-label">Filter By:</span>
                        <select class="filter-select" id="payment-filter">
                            <option value="all">All Payments</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="rejected">Rejected</option>
                        </select>
                </div>
                <div class="student-count">
                    <span class="count-dot"></span>
                    7 Students Listed
                </div>
            </div>

            <!-- Student Table -->
            <div class="student-table">
                <!-- Table Header -->
                <div class="table-header">
                    <div class="th th-id">ID</div>
                    <div class="th th-student">STUDENT INFO</div>
                    <div class="th th-school">SCHOOL</div>
                    <div class="th th-attendance">ATTENDANCE</div>
                    <div class="th th-payment">PAYMENT</div>
                    <div class="th th-action">ACTION</div>
                </div>

                <!-- Table Rows -->
                <?php if(!empty($studentsTableData)) :?>
                    <?php $count = 1; ?>
                    <?php foreach($studentsTableData as $student) : ?>

                        <div class="table-row">
                            <div class="td td-id">#<?= str_pad($student->student_id, 3, '0', STR_PAD_LEFT); ?></div>
                            <div class="td td-student">
                                <div class="student-avatar">
                                    <?php if (!empty($student->profile_picture)): ?>
                                        <img src="<?= ROOT ?>/uploads/students/<?= htmlspecialchars($student->profile_picture) ?>" 
                                            alt="Profile" 
                                            style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                                    <?php else: ?>
                                        <?= strtoupper(substr($student->first_name,0,1) . substr($student->last_name,0,1)); ?>
                                    <?php endif; ?>
                                </div>

                                <div class="student-details">
                                    <div class="student-name">
                                        <?= htmlspecialchars($student->first_name . ' ' . $student->last_name); ?>
                                    </div>
                                    <div class="student-phone">
                                        <?= htmlspecialchars($student->phone_number); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="td td-school">
                                <div class="school-name">
                                    <?= htmlspecialchars($student->school_name); ?>
                                </div>
                                <div class="school-stream">
                                    <?= htmlspecialchars($student->stream); ?>
                                </div>
                            </div>
                            <div class="td td-attendance">
                                <div class="attendance-wrapper">
                                    <div class="attendance-bar">
                                        <div class="attendance-fill" style="width:88%;"></div>
                                    </div>
                                    <span class="attendance-percent">88%</span>
                                </div>
                            </div>
                            <div class="td td-payment">
                                <span class="payment-badge <?= strtolower($student->payment_status) ?>">
                                    <?= strtoupper($student->payment_status) ?>
                                </span>
                            </div>
                            <div class="td td-action">
                               <a href="#" class="view-profile-link" data-student-id="<?= $student->student_id ?>">VIEW PROFILE</a>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="table-row">
                        <div class="td td-id">--</div>
                        <div class="td td-student">No students enrolled yet.</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Academic Details Panel -->
        <div id="academic-details" class="content-panel active">


           <?php if(!(empty($class))): ?>
           
                <!-- Class Incharge Teacher -->
                <div class="details-card">
                    <div class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="10" cy="7" r="4"></circle></svg>
                        <span>Class Incharge Teacher</span>
                    </div>
                    <div class="teacher-details">
                        <div class="name">
                            <?= htmlspecialchars($teacher->first_name . ' ' . $teacher->last_name) ?>
                        </div>
                        <div class="qualification"><?= htmlspecialchars($teacher->subjects_taught) ?></div>
                    </div>
                    <div class="contact-info">
                        <div>
                            <div class="label">Email</div>
                            <div><?= htmlspecialchars($teacher->email) ?></div>
                        </div>
                        <div>
                            <div class="label">Phone</div>
                            <div><?= htmlspecialchars($teacher->phone) ?></div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p>No incharge teacher assigned for this class.</p>
            <?php endif; ?>


            <!-- Class Schedule -->
            <div class="details-card">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <span>Class Schedule</span>
                </div>
                <?php if(!empty($schedules)): ?>
                    <?php foreach($schedules as $schedule): ?>
                        <div class="schedule-item">
                            <div>
                                <div class="schedule-day">
                                    <?= htmlspecialchars($schedule->day_of_week) ?>
                                </div>
                                <div class="schedule-time">
                                    <?= date("g:i A", strtotime($schedule->start_time)) ?>
                                    -
                                    <?= date("g:i A", strtotime($schedule->end_time)) ?>
                                </div>
                            </div>
                            <div class="schedule-location">
                                <span>Room 201</span>
                                <span>Online Class</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No schedule available for this class.</p>
                <?php endif; ?>
            </div>
            
            <!-- Paper Marking Panel -->
            <div class="details-card">
                <div class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span>Paper Marking Panel</span>
                </div>
                
                <?php if(!empty($panelMembers)): ?>
                    <?php foreach($panelMembers as $markers): ?>
                        <div class="marker-item">
                            <span class="marker-name">
                                <?= htmlspecialchars($markers->first_name . ' ' . $markers->last_name ?? 'Unknown') ?>
                            </span>
                            <span>
                                <?= htmlspecialchars($markers->email ?? '-') ?>
                            </span>
                            <span>
                                <?= htmlspecialchars($markers->phone_number ?? '-') ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No marking panel members for this class.</p>
                <?php endif; ?>
            </div>

        </div>

        <!-- Profit Panel -->
        <div id="profit" class="content-panel">
            <!-- Content for this panel will be created later -->
        </div>

        <!-- Performance Panel -->
        <div id="performance" class="content-panel">

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
                        <div class="summary-card-value">
                            <?= htmlspecialchars($papersConducted) ?>
                        </div>
                        <div class="summary-card-label">Papers Conducted</div>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><polyline points="9 15 11 17 15 13"></polyline></svg>
                    </div>
                    <div>
                        <div class="summary-card-value">
                            <?= htmlspecialchars($papersCorrected) ?>
                        </div>
                        <div class="summary-card-label">Papers Corrected</div>
                    </div>
                </div>
            </div>
            <!-- Teacher Progress Card -->
            <div class="details-card">
                <div class="card-title">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v15H6.5A2.5 2.5 0 0 1 4 14.5v-10A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    <span>Teacher Progress - <?= htmlspecialchars($teacher->first_name . ' ' . $teacher->last_name) ?> </span>
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
                        <span class="value">
                            <?= htmlspecialchars($papersConducted) ?> out of <?= htmlspecialchars($totalPapers) ?> papers</span>
                        <span class="percentage"><?= $percentage ?>%</span>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-bar progress-bar-secondary" style="width: <?= $percentage ?>%;"></div>
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

            
        </div>
    </main>
    </div>
    <script src="<?php  echo ROOT ?>/assets/js/component/class_details.js"></script>


    <!-- Modal Overlay -->
    <div class="modal-overlay">
        <!-- Modal Container -->
        <div class="modal-container">
            <!-- Left Side - Profile Card -->
            <div class="profile-left">
                <!-- Profile Image with Verified Badge -->
                <div class="profile-image-wrapper">
                    <div id="popup-avatar"></div>
                    <div class="verified-badge">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="12" fill="#10B981"/>
                            <path d="M7 12L10.5 15.5L17 9" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>

                <!-- Student Name and ID -->
                <h2 class="student-name-popup"></h2>
                <p id="popup-student-id" class="student-id">#001 • ART Stream</p>

                <!-- Contact Information Box -->
                <div class="contact-box">
                    <div class="contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FF8A5B" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        <span id="popup-phone"></span>
                    </div>

                    <div class="contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FF8A5B" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        <span id="popup-email"></span>
                    </div>

                    <div class="contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FF8A5B" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <span id="popup-enrollment-date"></span>
                    </div>
                </div>

                
            </div>

            <!-- Right Side - Details -->
            <div class="profile-right">
                <!-- Close Button -->
                <button class="close-btn" onclick="closeModal()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>

                <!-- Personal Information Section -->
                <div class="section">
                    <div class="section-header">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        <h3>Personal Information</h3>
                    </div>

                    <div class="info-card">
                        <div class="info-row">
                            <div class="info-column">
                                <label>DATE OF BIRTH</label>
                                <p>2007-05-14</p>
                            </div>
                            <div class="info-column">
                                <label>GENDER</label>
                                <p>Female</p>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-column">
                                <label>RESIDENTIAL ADDRESS</label>
                                <p class="address-text" id="popup-address">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                        <circle cx="12" cy="10" r="3"/>
                                    </svg>
                            
                                </p>
                            </div>
                            <div class="info-column">
                                <label>NIC</label>
                                <p id="popup-nic"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Academic & School Section -->
                <div class="section">
                    <div class="section-header">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                        </svg>
                        <h3>Academic & School</h3>
                    </div>

                    <div class="info-card">
                        <div class="info-row">
                            <div class="info-column">
                                <label>CURRENT SCHOOL</label>
                                <p id="popup-school"></p>
                            </div>
                            <div class="info-column">
                                <label>ATTENDANCE RATE</label>
                                <div class="attendance-wrapper">
                                    <div class="attendance-bar-container">
                                        <div class="attendance-bar" style="width: 88%"></div>
                                    </div>
                                    <span class="attendance-percent">88%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guardian Details Section -->
                <div class="section">
                    <div class="section-header">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/>
                            <path d="M12 2a10 10 0 1 0 0 20a10 10 0 0 0 0 -20z"/>
                        </svg>
                        <h3>Guardian Details</h3>
                    </div>

                    <div class="info-card">
                        <div class="info-row">
                            <div class="info-column">
                                <label>GUARDIAN NAME</label>
                                <p id="popup-guardian-name"></p>
                            </div>
                            <div class="info-column">
                                <label>GUARDIAN CONTACT</label>
                                <p id="popup-guardian-contact"></p>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
    <script src="<?php  echo ROOT ?>/assets/js/component/class_details.js"></script>
    <script>
       const appRoot = "<?= ROOT ?>";
    </script>
    <script>
       let studentsData = <?= json_encode($studentsTableData) ?? [] , JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ?>;
    </script>
</body>
</html>