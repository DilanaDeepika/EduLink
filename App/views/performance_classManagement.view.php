<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLink-Class-Academic Details</title>
      <link rel="stylesheet" href="../../Public/assets/css/performance_classManagement.css">
    <link rel="stylesheet" href="../../Public/assets/css/component/sidebar_classManagement.css">
    <link rel="stylesheet" href="../../Public/assets/css/component/header_classManagement.css">
</head>
<body>
    <div class="container">
        
<?php include 'Component/header_classManagement.php'; ?>
<?php include 'Component/sidebar_classManagement.php'; ?>


            <!-- Content Area -->
            <div class="content-wrapper">
                <div class="content-header">
                    <h2 class="content-title">Performance Tracking</h2>
                    <p class="content-subtitle">Monitoring teaching progress and marking panel statistics</p>
                </div>
   <div class="content">
            <!-- Teacher Progress Section -->
            <section class="card">
                <div class="card-header">
                    <svg class="header-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                    <h2 class="card-title">Teacher Progress - Mr H.W.M.S. Jhon</h2>
                </div>

                <div class="card-body">
                    <!-- Units Completed -->
                    <div class="progress-item">
                        <div class="progress-header">
                            <span class="progress-label">Units completed</span>
                            <span class="progress-percentage">50%</span>
                        </div>
                        <div class="progress-info">8 out of 12 units</div>
                        <div class="progress-bar">
                            <div class="progress-fill yellow" style="width: 50%"></div>
                        </div>
                    </div>

                    <!-- Papers Conducted -->
                    <div class="progress-item">
                        <div class="progress-header">
                            <span class="progress-label">Papers Conducted</span>
                            <span class="progress-percentage">25%</span>
                        </div>
                        <div class="progress-info">4 out of 16 papers</div>
                        <div class="progress-bar">
                            <div class="progress-fill yellow" style="width: 25%"></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Marking Panel Progress Section -->
            <section class="card">
                <div class="card-header">
                    <svg class="header-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    <h2 class="card-title">Marking Panel Progress</h2>
                </div>

                <div class="card-body">
                    <!-- First Panel Member -->
                    <div class="panel-progress">
                        <div class="panel-name">W.S.A. William</div>
                        <div class="progress-header">
                            <div class="progress-info">7 out of 2 papers</div>
                            <span class="progress-percentage">50%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill blue" style="width: 50%"></div>
                        </div>
                    </div>

                    <!-- Second Panel Member -->
                    <div class="panel-progress">
                        <div class="panel-name">W.S.A. William</div>
                        <div class="progress-header">
                            <div class="progress-info">0 out of 0 papers</div>
                            <span class="progress-percentage">0%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill blue" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon-wrapper">
                        <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <div class="stat-number">9</div>
                    <div class="stat-label">Join Composed</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon-wrapper">
                        <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 11l3 3L22 4"></path>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                    </div>
                    <div class="stat-number">4</div>
                    <div class="stat-label">Papers Conducted</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon-wrapper">
                        <svg class="stat-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <div class="stat-number">1</div>
                    <div class="stat-label">Papers Compiled</div>
                </div>
            </div>
        </div>
    </div>
     <script src="../../Public/assets/js/component/sidebar_classManagement.js"></script>
</body>
</html>