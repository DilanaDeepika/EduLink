<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EduLink - Teacher Dashboard</title>
        <link href="<?php  echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
            <link
      href="<?php  echo ROOT ?>/assets/css/component/footer-styles.css"
      rel="stylesheet"/>
        <link
      rel="stylesheet"
      href="<?php  echo ROOT ?>/assets/css/component/calander.css"
    />
    <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/profile.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
  </head>

  <body>
        <header>
        <?php include __DIR__.'/Component/nav.view.php'; ?>
    </header>
    <div class="dashboard-layout">
      <aside class="sidebar">
        <nav class="sidebar-nav">
          <!-- Navigation links for the teacher profile -->
          <a class="sidebar-item active" data-target="settings">
            <i class="fa-solid fa-gear"></i>
            <span>Settings</span>
          </a>
          <a class="sidebar-item" data-target="edit-profile">
            <i class="fa-regular fa-user"></i>
            <span>Edit Profile</span>
          </a>
          <a class="sidebar-item" data-target="profit">
            <i class="fa-solid fa-chart-line"></i>
            <span>Profit</span>
          </a>
          <a class="sidebar-item" data-target="my-classes">
            <i class="fa-solid fa-chalkboard-user"></i>
            <span>My Classes</span>
          </a>
          <a class="sidebar-item" data-target="community">
            <i class="fa-solid fa-users"></i>
            <span>Community</span>
        </a>
          <a class="sidebar-item" data-target="my-calendar">
            <i class="fa-regular fa-calendar"></i>
            <span>My Calendar</span>
          </a>
        </nav>
      </aside>

      <!-- Main Content Area -->
      <main class="main-content">
        <!-- ======================================== -->
        <!-- 1. Settings / Main Dashboard Section     -->
        <!-- ======================================== -->
        <section id="settings" class="content-section active">
          <div class="profile-card">
            <div class="profile-avatar">
              <?php if (!empty($avatarImage)): ?>
                  <img src="<?=  $avatarImage ?>" class="profile-setting">
              <?php else: ?>
                  <?=  $avatar ?>
              <?php endif; ?>
            </div>
            <div class="profile-info">
              <h2><?=  htmlspecialchars($teacherName) ?></h2>
              <button class="btn btn-secondary">Edit Profile</button>
            </div>
          </div>

          <div class="stats-grid">
            <div class="stat-card">
              <p>Total Classes</p>
              <span>
                <?=  $totalClasses ?>
              </span>
              <i class="fa-solid fa-chalkboard-user icon-blue"></i>
            </div>
            <div class="stat-card">
              <p>Total Students</p>
              <span>
                <?= $totalStudents ?>
              </span>
              <i class="fa-solid fa-users icon-yellow"></i>
            </div>
            <div class="stat-card">
              <p>Monthly Revenue</p>
              <span>Rs <?= $monthlyRevenue ?></span>
              <i class="fa-solid fa-dollar-sign icon-blue"></i>
            </div>
          </div>
        </section>

        <!-- ======================================== -->
        <!-- 2. Edit Profile Section                  -->
        <!-- ======================================== -->
        <section id="edit-profile" class="content-section">
          <div class="content-header">
            <h1><i class="fa-regular fa-user"></i> Edit Profile</h1>
          </div>

          <div class="edit-profile-layout">
            <!-- Avatar Section -->
            <div class="avatar-section">
              <h3>Profile Picture</h3>
              <div class="avatar-display">
                <?php if (!empty($avatarImage)): ?>
                  <img src="<?=  $avatarImage ?>" class="profile-img">
                <?php else: ?>
                  <?=  $avatar ?>
                <?php endif; ?>
              </div>
              </form>
              <form class="upload-form" action="<?= ROOT ?>/TeacherProfile/uploadPhoto"  method="POST" enctype="multipart/form-data"  data-upload-form>
                <input type="file" class="upload-input" name="profile_photo" accept="image/*" hidden data-upload-input />
                <button type="button" class="btn btn-secondary" data-upload-btn>
                  <i class="fa-solid fa-upload"></i> Upload Photo
                </button>
              </form>
              
              <p>Image size should be at least 300×300px</p>
            </div>

            <!-- Form Section -->
            <div class="form-container">
              <form method="POST" action="<?= ROOT ?>/TeacherProfile/updateProfile" class="profile-form">
                <h3>Personal Information</h3>
                <div class="form-row">
                  <div class="form-group">
                    <label for="t_first_name">First Name</label>
                    <input type="text" id="t_first_name" name="first_name" value="<?= $teacher->first_name ?>" />
                  </div>
                  <div class="form-group">
                    <label for="t_last_name">Last Name</label>
                    <input type="text" id="t_last_name" name="last_name" value="<?= $teacher->last_name ?>" />
                  </div>
                </div>

                <h3>Contact Information</h3>
                <div class="form-group">
                  <label for="t_email">Email</label>
                  <input
                    type="email"
                    id="t_email"
                    name="email" 
                    value="<?=  $teacher->email ?>"
                  />
                </div>
                <div class="form-group">
                  <label for="t_phone_no">Phone Number</label>
                  <input type="text" id="t_phone_no" name="phone" value="<?= $teacher->phone ?>" />
                </div>

                <button type="submit" class="btn btn-primary">
                  Save Changes
                </button>
              </form>
            </div>
          </div>
        </section>

        <!-- ======================================== -->
        <!-- 3. Profit Section (Placeholder)          -->
        <!-- ======================================== -->
        <section id="profit" class="content-section">
          <div class="content-header">
            <h1><i class="fa-solid fa-chart-line"></i> Profit</h1>
            <p>Track your earnings, view payment history, and manage your finances.</p>
          </div>

            <!-- Stats Cards Row -->
         <div class="profit-stats-grid">
            <div class="profit-stat-card">
              <div class="stat-icon yellow">
                <i class="fa-solid fa-dollar-sign"></i>
              </div>
              <div class="stat-details">
                <p class="stat-label">Total Earnings</p>
                <h2 class="stat-value">LKR 54,800</h2>
                <span class="stat-subtext">All time</span>
                <span class="stat-change positive">
                  <i class="fa-solid fa-arrow-up"></i> 16.8% vs last month
                </span>
              </div>
            </div>

            <div class="profit-stat-card">
              <div class="stat-icon teal">
                <i class="fa-solid fa-wallet"></i>
              </div>
              <div class="stat-details">
                <p class="stat-label">Available Balance</p>
                <h2 class="stat-value">LKR 8,450</h2>
                <span class="stat-subtext">Ready to withdraw</span>
                <button class="withdraw-btn">
                  <i class="fa-solid fa-arrow-right"></i> Withdraw Funds
                </button>
              </div>
            </div>

            <div class="profit-stat-card">
              <div class="stat-icon blue">
                <i class="fa-solid fa-clock"></i>
              </div>
              <div class="stat-details">
                <p class="stat-label">Ongoing Classes</p>
                <h2 class="stat-value">10</h2>
                <span class="stat-subtext">Processing</span>
                <span class="stat-change">
                  <i class="fa-solid fa-hourglass-half"></i> 2-5 days approx
                </span>
              </div>
            </div>

            <div class="profit-stat-card">
              <div class="stat-icon purple">
                <i class="fa-solid fa-users"></i>
              </div>
              <div class="stat-details">
                <p class="stat-label">Active Students</p>
                <h2 class="stat-value">77</h2>
                <span class="stat-subtext">Across 4 subjects</span>
                <span class="stat-change positive">
                  <i class="fa-solid fa-arrow-up"></i> 8.5% vs last month
                </span>
              </div>
            </div>
          </div>

          <!-- Charts Row -->
          <div class="profit-charts-row">
            <!-- Earnings Overview Chart -->
            <div class="chart-card earnings-chart">
              <div class="chart-header">
                <div>
                  <h3>Earnings Overview</h3>
                  <p class="chart-subtitle">Your revenue trend over time</p>
                </div>
                <div class="chart-controls">
                  <button class="chart-btn">Month</button>
                  <button class="chart-btn active">Year</button>
                </div>
                </div>
                <div class="chart-content">
                <!-- Placeholder for chart - you can integrate Chart.js or similar -->
                <svg class="earnings-line-chart" viewBox="0 0 400 150">
                  <defs>
                    <linearGradient id="chartGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" style="stop-color:#4f46e5;stop-opacity:0.3" />
                    <stop offset="100%" style="stop-color:#4f46e5;stop-opacity:0" />
                    </linearGradient>
                  </defs>
                  <path d="M 0 120 L 40 110 L 80 100 L 120 95 L 160 85 L 200 90 L 240 75 L 280 70 L 320 55 L 360 45 L 400 40" 
                    stroke="#4f46e5" stroke-width="2" fill="none"/>
                  <path d="M 0 120 L 40 110 L 80 100 L 120 95 L 160 85 L 200 90 L 240 75 L 280 70 L 320 55 L 360 45 L 400 40 L 400 150 L 0 150 Z" 
                    fill="url(#chartGradient)"/>
                </svg>
                <div class="chart-x-axis">
                  <span>Feb</span>
                  <span>Mar</span>
                  <span>Apr</span>
                  <span>May</span>
                  <span>Jun</span>
                  <span>Jul</span>
                  <span>Aug</span>
                  <span>Sep</span>
                  <span>Oct</span>
                  <span>Nov</span>
                  <span>Dec</span>
                </div>
              </div>
            </div>
            
            <!-- Class Earnings Breakdown -->
            <div class="chart-card class-earnings">
              <div class="chart-header">
                <div>
                  <h3>Class Earnings</h3>
                  <p class="chart-subtitle">By class breakdown</p>
                </div>
                <a href="#" class="view-all-link">View All <i class="fa-solid fa-arrow-right"></i></a>
              </div>
              <div class="class-earnings-list">
                <div class="class-earning-item">
                  <div class="class-earning-info">
                    <span class="class-dot" style="background: #10b981;"></span>
                    <div>
                      <p class="class-earning-name">Advanced Mathematics</p>
                      <span class="class-earning-meta">Gr. 12 • 25 students • Completed</span>
                    </div>
                  </div>
                  <div class="class-earning-amount">
                    <strong>$3,800</strong>
                    <span class="earning-trend positive">+15%</span>
                  </div>
                  <div class="class-earning-bar">
                    <div class="bar-fill" style="width: 85%; background: #10b981;"></div>
                  </div>
                </div>

                <div class="class-earning-item">
                  <div class="class-earning-info">
                    <span class="class-dot" style="background: #3b82f6;"></span>
                    <div>
                      <p class="class-earning-name">Physics Fundamentals</p>
                      <span class="class-earning-meta">Gr. 11 • 18 students • Ongoing</span>
                    </div>
                  </div>
                  <div class="class-earning-amount">
                    <strong>$2,160</strong>
                    <span class="earning-trend negative">-8%</span>
                  </div>
                  <div class="class-earning-bar">
                    <div class="bar-fill" style="width: 65%; background: #3b82f6;"></div>
                  </div>
                </div>

                <div class="class-earning-item">
                  <div class="class-earning-info">
                    <span class="class-dot" style="background: #f59e0b;"></span>
                    <div>
                      <p class="class-earning-name">Chemistry Lab</p>
                      <span class="class-earning-meta">Gr. 10 • 15 students • Ongoing</span>
                    </div>
                  </div>
                  <div class="class-earning-amount">
                    <strong>$1,440</strong>
                    <span class="earning-trend positive">+22%</span>
                  </div>
                  <div class="class-earning-bar">
                    <div class="bar-fill" style="width: 48%; background: #f59e0b;"></div>
                  </div>
                </div>

                <div class="class-earning-item">
                  <div class="class-earning-info">
                    <span class="class-dot" style="background: #8b5cf6;"></span>
                    <div>
                      <p class="class-earning-name">Biology Basics</p>
                      <span class="class-earning-meta">Gr. 9 • 12 students • Completed</span>
                    </div>
                  </div>
                  <div class="class-earning-amount">
                    <strong>$1,800</strong>
                    <span class="earning-trend positive">+5%</span>
                  </div>
                  <div class="class-earning-bar">
                    <div class="bar-fill" style="width: 55%; background: #8b5cf6;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
   
          <!-- Recent Transactions -->
          <div class="transactions-card">
            <div class="transactions-header">
              <div>
                <h3>Recent Transactions</h3>
                <p class="chart-subtitle">Your latest payment activities</p>
              </div>
              <div class="transactions-actions">
                <button class="filter-btn">
                  <i class="fa-solid fa-filter"></i> Filter
                </button>
                <button class="export-btn">
                  <i class="fa-solid fa-download"></i> Export
                </button>
              </div>
            </div>
            <div class="transactions-table">
              <table>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>DATE</th>
                    <th>DESCRIPTION</th>
                    <th>AMOUNT</th>
                    <th>STATUS</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>TXN001</td>
                    <td>Dec 20, 2024</td>
                    <td>Advanced Mathematics - December</td>
                    <td class="amount-positive"><i class="fa-solid fa-arrow-up"></i> +$3,600</td>
                    <td><span class="status-badge completed">Completed</span></td>
                  </tr>
                  <tr>
                    <td>TXN002</td>
                    <td>Dec 18, 2024</td>
                    <td>Withdrawal to Bank Account</td>
                    <td class="amount-negative"><i class="fa-solid fa-arrow-down"></i> -$2,500</td>
                    <td><span class="status-badge completed">Completed</span></td>
                  </tr>
                  <tr>
                    <td>TXN003</td>
                    <td>Dec 15, 2024</td>
                    <td>Physics Fundamentals - December</td>
                    <td class="amount-positive"><i class="fa-solid fa-arrow-up"></i> +$2,160</td>
                    <td><span class="status-badge completed">Completed</span></td>
                  </tr>
                  <tr>
                    <td>TXN004</td>
                    <td>Dec 12, 2024</td>
                    <td>Chemistry Lab - December</td>
                    <td class="amount-positive"><i class="fa-solid fa-arrow-up"></i> +$1,440</td>
                    <td><span class="status-badge pending">Pending</span></td>
                  </tr>
                  <tr>
                    <td>TXN005</td>
                    <td>Dec 10, 2024</td>
                    <td>Bonus - Top Teacher Award</td>
                    <td class="amount-positive"><i class="fa-solid fa-arrow-up"></i> +$500</td>
                    <td><span class="status-badge completed">Completed</span></td>
                  </tr>
                </tbody>
              </table>
              <div class="table-footer">
                <span>Showing 5 of 54 transactions</span>
                <div class="pagination">
                  <button>Previous</button>
                  <button class="active">Next</button>
                </div>
              </div>
            </div> 
          </div>
        </section>
          
        <!-- ======================================== -->
        <!-- 4. My Classes Section (UPDATED)          -->
        <!-- ======================================== -->
        <?php
        $gradeMap = [
          'yr_25' => '2025 A/L',
          'yr_26' => '2026 A/L',
          'yr_27' => '2027 A/L',
          'yr_28' => '2028 A/L'
        ];
        ?>
        <section id="my-classes" class="content-section">
          <div class="content-header">
            <h1><i class="fa-solid fa-chalkboard-user"></i> My Classes</h1>
            <p>Manage your ongoing and upcoming classes.</p>
          </div>

          <div class="classes-list">
            <?php if (!empty($teacherClasses)): ?>
              <?php foreach ($teacherClasses as $class): ?>
                <div class="class-card">
                    <div class="class-info">
                      <h3>
                        <?=  htmlspecialchars($class->class_name) ?> - 
                        <?= $gradeMap[$class->grade_level_name] ?? $class->grade_level_name ?>
                      </h3>
                      <div class="class-meta">
                          <span class="class-type-badge <?= strtolower($class->class_type) ?>">
                              <?php if ($class->class_type === 'institute'): ?>
                                <i class="fa-solid fa-building"></i> Institute Class
                              <?php else: ?>
                                <i class="fa-solid fa-user"></i> Individual Class
                              <?php endif; ?>
                          </span>
                          <span><i class="fa-solid fa-location-dot"></i> Colombo</span>
                          <span>
                            <i class="fa-regular fa-clock"></i> 
                            <?= ucfirst(substr($class->day, 0, 3)) ?> 
                            <?= date("g", strtotime($class->start_time)) ?>-
                            <?= date("g A", strtotime($class->end_time)) ?>
                          </span>
                          <span>
                            <i class="fa-solid fa-users"></i>
                            <?=  htmlspecialchars($class->max_students) ?> Students
                          </span>
                          <span>
                            <i class="fa-solid fa-dollar-sign"></i>
                            Rs <?= number_format($class->revenue, 2) ?>
                          </span>
                      </div>
                    </div>
                    <button class="btn btn-secondary">Manage Class</button>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p>No Classes added yet.</p>
            <?php endif; ?>
          </div>
        </section>
        <!-- ======================================== -->
        <!-- 5. My Community Section     -->
        <!-- ======================================== -->
        <section id="community" class="content-section">
          <div class="content-header">
            <h1><i class="fa-solid fa-users"></i> My Communities</h1>
            <button id="open-modal-btn" class="open-modal-btn btn btn-primary">
              <i class="fa-solid fa-plus"></i> Create New Community
            </button>

            <div id="communityModal" class="community-modal">
              <div class="modal-content">
                <div class="modal-header">
                  <h2>Create New Community</h2>
                  <span class="close">&times;</span>
                </div>

                <form action="<?= ROOT ?>/TeacherProfile/createCommunity" method="POST" enctype="multipart/form-data">
                  <label>Community Name</label>
                  <input type="text" name="community_name" placeholder="Enter community name..." required />

                  <label>Description</label>
                  <textarea name="description" placeholder="Describe your community..." required></textarea>

                  <label>Community Image</label>
                  <div class="upload-box">
                    <input type="file" name="image" accept="image/*" required />
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                    <p>Click to upload or drag and drop<br><span>PNG, JPG, JPEG up to 5MB</span></p>
                  </div>

                  <div class="buttons">
                    <button type="button" class="cancel-btn">Cancel</button>
                    <button type="submit" class="create-btn">Create Community</button>
                  </div>

                </form>
              </div>
            </div>
            
          </div>

          <form method="GET" action="<?= ROOT ?>/TeacherProfile">
            <input type="hidden" name="section" value="community" /> 
            <div class="community-search-bar">
              <i class="fa-solid fa-search"></i>
              <input type="search" name="search" placeholder="Search your communities by name..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" />
            </div>
          </form>
         
          <div class="community-list">
            <?php if (!empty($communities)): ?>
              <?php foreach ($communities as $community): ?>
                <div class="community-card">
                  <div class="community-info">
                    <h3><?= htmlspecialchars($community->community_name) ?></h3>
                    
                    <div class="community-meta">
                      <span>
                        <i class="fa-solid fa-users"></i>
                        125 Members
                      </span>
                    </div>
                  </div>
                  <button class="btn btn-secondary">Manage</button>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p>No communities found.</p>
            <?php endif; ?>
          </div>

        </section> 
        <!-- Create Community Modal -->
        <!-- Modal Background -->
        

       
        <!-- ======================================== -->
        <!-- 5. My Calendar Section (Placeholder)     -->
        <!-- ======================================== -->
        <section id="my-calendar" class="content-section">
          <div class="content-header">
            <h1><i class="fa-regular fa-calendar"></i> My Calendar</h1>
            <?php include __DIR__.'/Component/calander.php'; ?>
          </div>
        </section>
      </main>
    </div>
    <?php include __DIR__.'/Component/footer.view.php'; ?>
      <script src="<?php  echo ROOT ?>/assets/js/calander.js"></script>
  <script src="<?php  echo ROOT ?>/assets/js/event.js"></script>
    <script src="<?php  echo ROOT ?>/assets/js/teacher_profile.js"></script>
  </body>
</html>
