<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EduLink - Teacher Dashboard</title>
    <link href="<?= ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
    <link href="<?= ROOT ?>/assets/css/component/footer-styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/component/calander.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/profile.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
  </head>

  <body>
    <header>
        <?php include __DIR__.'/Component/nav.view.php'; ?>
    </header>
    <div class="dashboard-layout">
      <aside class="sidebar">
        <nav class="sidebar-nav">
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

      <main class="main-content">
        <section id="settings" class="content-section active">
          <div class="profile-card">
            <div class="profile-avatar">
                <?php if (!empty($avatarImage)): ?>
                    <img src="<?= $avatarImage ?>" class="profile-setting" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                <?php else: ?>
                    <?= $avatar ?>
                <?php endif; ?>
            </div>
            <div class="profile-info">
              <h2><?= htmlspecialchars($teacherName) ?></h2>
              <button class="btn btn-secondary" onclick="document.querySelector('[data-target=\'edit-profile\']').click()">Edit Profile</button>
            </div>
          </div>

          <div class="stats-grid">
            <div class="stat-card">
              <p>Total Classes</p>
              <span><?= $totalClasses ?></span>
              <i class="fa-solid fa-chalkboard-user icon-blue"></i>
            </div>
            <div class="stat-card">
              <p>Total Students</p>
              <span><?= $totalStudents ?></span>
              <i class="fa-solid fa-users icon-yellow"></i>
            </div>
            <div class="stat-card">
              <p>Monthly Revenue</p>
              <span>Rs <?= empty($totalRevenue) ? '0.00' : number_format($totalRevenue, 2) ?></span>
              <i class="fa-solid fa-dollar-sign icon-blue"></i>
            </div>
          </div>
        </section>

        <section id="edit-profile" class="content-section">
          <div class="content-header">
            <h1><i class="fa-regular fa-user"></i> Edit Profile</h1>
          </div>

          <div class="edit-profile-layout">
            <div class="avatar-section">
              <h3>Profile Picture</h3>
              <div class="avatar-display">
                <?php if (!empty($avatarImage)): ?>
                    <img src="<?= $avatarImage ?>" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
                <?php else: ?>
                    <?= $avatar ?>
                <?php endif; ?>
              </div>
              
              <form class="upload-form" action="<?= ROOT ?>/TeacherProfile/uploadPhoto" method="POST" enctype="multipart/form-data">
                  <input type="file" name="profile_photo" accept="image/*" id="file-upload" style="display:none;" onchange="this.form.submit()" />
                  <button type="button" class="btn btn-secondary" onclick="document.getElementById('file-upload').click();">
                    <i class="fa-solid fa-upload"></i> Upload Photo
                  </button>
              </form>
              <p>Image size should be at least 300×300px</p>
            </div>

            <div class="form-container">
              <form class="profile-form" method="POST" action="<?= ROOT ?>/TeacherProfile/updateProfile">
                <h3>Personal Information</h3>
                <div class="form-row">
                  <div class="form-group">
                    <label for="t_first_name">First Name</label>
                    <input type="text" id="t_first_name" name="first_name" value="<?= htmlspecialchars($teacher->first_name) ?>" />
                  </div>
                  <div class="form-group">
                    <label for="t_last_name">Last Name</label>
                    <input type="text" id="t_last_name" name="last_name" value="<?= htmlspecialchars($teacher->last_name) ?>" />
                  </div>
                </div>

                <h3>Contact Information</h3>
                <div class="form-group">
                  <label for="t_email">Email</label>
                  <input type="email" id="t_email" name="email" value="<?= htmlspecialchars($teacher->email ?? '') ?>" readonly/>
                </div>
                <div class="form-group">
                  <label for="t_phone_no">Phone Number</label>
                  <input type="text" id="t_phone_no" name="phone" value="<?= htmlspecialchars($teacher->phone) ?>" />
                </div>

                <button type="submit" class="btn btn-primary">
                  Save Changes
                </button>
              </form>
            </div>
          </div>
        </section>

        <section id="profit" class="content-section">
          <div class="content-header">
            <h1><i class="fa-solid fa-chart-line"></i> Profit</h1>
            <p>This section is under construction.</p>
          </div>

          <div class="stats-grid">
            <div class="stat-card">
              <p>Institute Student</p>
              <span><?= $totalClasses ?></span>
              <i class="fa-solid fa-chalkboard-user icon-blue"></i>
            </div>
            <div class="stat-card">
              <p>Individual Student</p>
              <span><?= $totalStudents ?></span>
              <i class="fa-solid fa-users icon-yellow"></i>
            </div>
            <div class="stat-card">
              <p>Monthly Revenue</p>
              <span>Rs <?= empty($totalRevenue) ? '0.00' : number_format($totalRevenue, 2) ?></span>
              <i class="fa-solid fa-dollar-sign icon-blue"></i>
            </div>
          </div>
          <?php
            $hasIndividualRevenue = ((float)($individualRevenue ?? 0)) > 0;
            $hasInstituteRevenue  = ((float)($instituteRevenue ?? 0)) > 0;
          ?>

          <div class="profit-filter">
          <form method="GET" class="month-form">
            <input type="hidden" name="section" value="profit">

            <label for="month" class="month-label">Select Month</label>

            <input
              type="month"
              id="month"
              name="month"
              value="<?= htmlspecialchars($selectedMonth ?? date('Y-m')) ?>"
              class="month-input"
            />

            <button type="submit" class="month-btn">Apply</button>
          </form>
        </div>


          <div class="revenue-bar-wrap">
            <div><h3>Summary Bar</h3></div>
            
            <canvas id="progress"></canvas>
          </div>

          <div class="donut-row">
            <div class="donut-card">
              <h3>Individual Classes</h3>

              <?php if ($hasIndividualRevenue): ?>
                <div class="donut-wrap">
                  <canvas id="donutIndividual"></canvas>
                </div>
              <?php else: ?>
                <div class="donut-empty">
                  No individual revenue for <?= htmlspecialchars($selectedMonth ?? date('Y-m')) ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="donut-card">
              <h3>Institute Classes</h3>

              <?php if ($hasInstituteRevenue): ?>
                <div class="donut-wrap">
                  <canvas id="donutInstitute"></canvas>
                </div>
              <?php else: ?>
                <div class="donut-empty">
                  No institute revenue for <?= htmlspecialchars($selectedMonth ?? date('Y-m')) ?>
                </div>
              <?php endif; ?>
            </div>
          </div>


          <div class="unpaid-flex">

            <!-- LEFT: Individual -->
            <div class="unpaid-card unpaid-half">
              <h3>Unpaid Students (Individual Classes)</h3>

              <?php if (!empty($individualUnpaidStd)): ?>
                <table class="unpaid-table">
                  <thead>
                    <tr>
                      <th>Student</th>
                      <th>Class</th>
                      <th>Last Paid Until</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($individualUnpaidStd as $row): ?>
                      <tr>
                        <td><?= htmlspecialchars($row->std_name) ?></td>
                        <td><?= htmlspecialchars($row->class_name) ?></td>
                        <td><?= htmlspecialchars($row->last_paid_until ?? 'Never') ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              <?php else: ?>
                <p class="unpaid-empty">All students have paid for this month</p>
              <?php endif; ?>
            </div>

            <!-- RIGHT: Institute -->
            <div class="unpaid-card unpaid-half">
              <h3>Unpaid Students (Institute Classes)</h3>

              <?php if (!empty($instituteUnpaidStd)): ?>
                <table class="unpaid-table">
                  <thead>
                    <tr>
                      <th>Student</th>
                      <th>Class</th>
                      <th>Last Paid Until</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($instituteUnpaidStd as $row): ?>
                      <tr>
                        <td><?= htmlspecialchars($row->std_name) ?></td>
                        <td><?= htmlspecialchars($row->class_name) ?></td>
                        <td><?= htmlspecialchars($row->last_paid_until ?? 'Never') ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              <?php else: ?>
                <p class="unpaid-empty">All students have paid for this month</p>
              <?php endif; ?>
            </div>

          </div>


        </section>

        <section id="my-classes" class="content-section">
          <div class="content-header">
            <h1><i class="fa-solid fa-chalkboard-user"></i> My Classes</h1>
            <p>Manage your ongoing and upcoming classes.</p>
          </div>

          <div class="classes-list">
            <?php if (is_iterable($teacherClasses) && !empty($teacherClasses)): ?>
                <?php foreach ($teacherClasses as $class): ?>
                    <div class="class-card">
                      <div class="class-info">
                        <h3><?= htmlspecialchars($class->class_name ?? 'Class Name') ?></h3>
                        <div class="class-meta">
                          <span class="class-type-badge <?= strtolower($class->class_type ?? 'individual') ?>">
                            <?php if (($class->class_type ?? '') === 'institute'): ?>
                                <i class="fa-solid fa-building"></i> Institute Class
                            <?php else: ?>
                                <i class="fa-solid fa-user"></i> Individual Class
                            <?php endif; ?>
                          </span>
                          <span><i class="fa-solid fa-location-dot"></i> Colombo</span>
                          <span>
                            <i class="fa-regular fa-clock"></i> 
                            <?php
                            $dayText = !empty($class->day) ? ucfirst(substr($class->day, 0, 3)) : '-';
                            $startText = !empty($class->start_time) ? date("g A", strtotime($class->start_time)) : '-';
                            $endText   = !empty($class->end_time) ? date("g A", strtotime($class->end_time)) : '-';
                            ?>
                            <?= $dayText ?> <?= $startText ?> - <?= $endText ?>
                          </span>
                          <span><i class="fa-solid fa-users"></i><?= (int)($class->studentCount ?? 0) ?> Students</span>
                        </div>
                      </div>
                      <button class="btn btn-secondary">Manage Class</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="color: #666;">No classes found. (Note: Ensure backend sends an array, not a count)</p>
            <?php endif; ?>
          </div>
        </section>
        
        <section id="community" class="content-section">
          <div class="content-header">
            <h1><i class="fa-solid fa-users"></i> My Communities</h1>
            <button id="openCreateCommunityModal" class="btn btn-primary">
              <i class="fa-solid fa-plus"></i> Create New Community
            </button>
          </div>

          <div class="community-search-bar">
            <i class="fa-solid fa-search"></i>
            <input type="search" placeholder="Search your communities by name..." />
          </div>

          <div class="community-list">
            <?php if (!empty($community_details)): ?>
                <?php foreach ($community_details as $community): ?>
                    <div class="community-card">
                      <div class="community-info">
                        <h3><?= htmlspecialchars($community->name) ?></h3>
                        <div class="community-meta">
                          <span><i class="fa-solid fa-users"></i> <?= $community->member_count ?? 0 ?> Members</span>
                        </div>
                      </div>
                        <div class="action-buttons">
                          <a class="btn btn-secondary" href="<?= ROOT ?>/community?community_id=<?= htmlspecialchars($community->id) ?>" 
                            class="btn btn-secondary" 
                            style="text-decoration: none; display: inline-block; line-height: normal;">
                            Manage
                          </a>

                          <button class="btn btn-danger" 
                                  onclick="commDelete('<?= $community->community_id ?? $community->id ?>', '<?= ROOT ?>')">
                              <i class="fa-solid fa-trash"></i> Delete
                          </button>
                      </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No communities found.</p>
            <?php endif; ?>
          </div>
        </section>
        
        
        <div id="CreateCommunityModal" class="modal-overlay">
        <div class="modal-content">
          <div class="modal-header">
            <h3>Create Class Community</h3>
            <span class="close-button">&times;</span>
          </div>
          <div class="modal-body">
            <form id="adminCreateCommunityForm" method="POST" action="<?php echo ROOT ?>/TeacherProfile/communityCreate" enctype="multipart/form-data">
              <div class="form-group">
                <label for="communityName">Community Name</label>
                <input type="text" id="communityName" name="communityName" placeholder="Enter community name" required>
              </div>

              <div class="form-group">
                <label for="communityDesc">Description</label>
                <textarea id="communityDesc" name="communityDesc" placeholder="Enter a description..." required></textarea>
              </div>

              <div class="form-group">
                <label for="class_id">Select Class</label>
                <select id="class_id" name="class_id" required>
                  <option value="">-- Select Class --</option>

                  <?php foreach ($teacherClasses as $class): ?>
                    <option value="<?= $class->class_id ?>">
                      <?= htmlspecialchars($class->class_name) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>



              <div class="modal-footer">
                <button type="button" class="btn btn-cancel">Cancel</button>
                <button type="submit" class="btn btn-create">Create Community</button>
              </div>
            </form>
          </div>
        </div>
      </div>
        
        <section id="my-calendar" class="content-section">
          <div class="content-header">
            <h1><i class="fa-regular fa-calendar"></i> My Calendar</h1>
            <?php include __DIR__.'/Component/calander.php'; ?>
          </div>
        </section>
      </main>
    </div>
    
    <?php include __DIR__.'/Component/footer.view.php'; ?>
    <script>const appRoot = "<?= ROOT ?>"; </script>
    <script>
      const maxRevenue = <?= json_encode((float)$maxRevenue) ?>;
      const individualRevenue = <?= json_encode((float)$individualRevenue) ?>;
      const instituteRevenue = <?= json_encode((float)$instituteRevenue) ?>;

      const individualClassRevenues = <?= json_encode($individualClassRevenues) ?>;
      const instituteClassRevenues  = <?= json_encode($instituteClassRevenues) ?>;

      const individualUnpaidStd = <?= json_encode($individualUnpaidStd) ?>;
      const instituteUnpaidStd  = <?= json_encode($instituteUnpaidStd) ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= ROOT ?>/assets/js/calander.js"></script>
    <script src="<?= ROOT ?>/assets/js/profile.js"></script>
    <script src="<?= ROOT ?>/assets/js/profitChart.js"></script>
  </body>
</html>