<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLink-Class-Academic Details</title>
    <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/academic_details_classManagement.css">
    <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/component/sidebar_classManagement.css">
    <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/component/header_classManagement.css">

</head>
<body>
    <div class="container">
        
<?php include 'Component/header_classManagement.php'; ?>
<?php include 'Component/sidebar_classManagement.php'; ?>



            <!-- Content Area -->
            <div class="content-wrapper">
                <div class="content-header">
                    <h2 class="content-title">Academic Details</h2>
                    <p class="content-subtitle">Class information, schedules and marking panel</p>
                </div>

                <!-- Class Incharge Teacher Section -->
                <section class="info-section">
                    <div class="section-header">
                        <svg class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <h3>Class Incharge Teacher</h3>
                    </div>

                    <div class="teacher-info">
                        <div class="teacher-name">Mr. H.W.M.S. Jhon</div>
                        <div class="teacher-degree">Bsc in Computer science</div>
                                <div class="divider"></div>
                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-label">Email</div>
                                <div class="contact-value">jhon@gmail.com</div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-label">Phone</div>
                                <div class="contact-value">+94 77 66778899</div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Class Schedule Section -->
                <section class="info-section">
                    <div class="section-header">
                        <svg class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <h3>Class Schedule</h3>
                    </div>

                    <div class="schedule-list">
                        <div class="schedule-item">
                            <div class="schedule-left">
                                <div class="schedule-day">Monday</div>
                                <div class="schedule-time">3:00 PM - 5:00 PM</div>
                            </div>
                            <div class="schedule-right">
                                <div class="schedule-room">Room 201</div>
                                <div class="schedule-type">Online Class</div>
                            </div>
                        </div>

                        <div class="schedule-item">
                            <div class="schedule-left">
                                <div class="schedule-day">Saturday</div>
                                <div class="schedule-time">3:00 PM - 5:00 PM</div>
                            </div>
                            <div class="schedule-right">
                                <div class="schedule-room">Room 201</div>
                                <div class="schedule-type">Online Class</div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Paper Marking Panel Section -->
                <section class="info-section">
                    <div class="section-header">
                        <svg class="section-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <h3>Paper Marking Panel</h3>
                    </div>

                    <div class="panel-list">
                        <div class="panel-item">
                            <div class="panel-name">W.S.A. William</div>
                            <div class="panel-email">william@gmail.com</div>
                            <div class="panel-phone">+34 76 55568788</div>
                        </div>

                        <div class="panel-item">
                            <div class="panel-name">H.M.M. Emily</div>
                            <div class="panel-email">emily@gmail.com</div>
                            <div class="panel-phone">+94 76 55577788</div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
    <script src="../../Public/assets/js/component/sidebar_classManagement.js"></script>

</body>
</html>