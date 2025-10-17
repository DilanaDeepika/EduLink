<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EduLink - Institute Dashboard</title>
    <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/profile.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
  </head>
  <body>
    <div class="dashboard-layout">
      <aside class="sidebar">
        <nav class="sidebar-nav">
          <!-- Navigation links for the institute profile -->
          <a href="#" class="sidebar-item active" data-target="settings">
            <i class="fa-solid fa-gear"></i>
            <span>Settings</span>
          </a>
          <a href="#" class="sidebar-item" data-target="edit-profile">
            <i class="fa-regular fa-building"></i>
            <span>Edit Profile</span>
          </a>
          <a href="#" class="sidebar-item" data-target="classes">
            <i class="fa-solid fa-chalkboard-user"></i>
            <span>Classes</span>
          </a>
          <a href="#" class="sidebar-item" data-target="profit">
            <i class="fa-solid fa-chart-line"></i>
            <span>Profit</span>
          </a>
          <a href="#" class="sidebar-item" data-target="calendar">
            <i class="fa-regular fa-calendar"></i>
            <span>Calendar</span>
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
              <i class="fa-solid fa-school"></i>
            </div>
            <div class="profile-info">
              <h2>EduLink Institute</h2>
              <button class="btn btn-secondary">Edit Profile</button>
            </div>
          </div>

          <div class="stats-grid">
            <div class="stat-card">
              <p>Total Classes</p>
              <span>25</span>
              <i class="fa-solid fa-chalkboard-user icon-blue"></i>
            </div>
            <div class="stat-card">
              <p>Registered Teachers</p>
              <span>15</span>
              <i class="fa-solid fa-user-tie icon-yellow"></i>
            </div>
            <div class="stat-card">
              <p>Active Students</p>
              <span>450</span>
              <i class="fa-solid fa-users icon-blue"></i>
            </div>
            <div class="stat-card">
              <p>Monthly Revenue</p>
              <span>$12,500</span>
              <i class="fa-solid fa-dollar-sign icon-yellow"></i>
            </div>
          </div>
        </section>

        <!-- ======================================== -->
        <!-- 2. Edit Profile Section                  -->
        <!-- ======================================== -->
        <section id="edit-profile" class="content-section">
          <div class="content-header">
            <h1>
              <i class="fa-regular fa-building"></i> Edit Institute Profile
            </h1>
          </div>

          <div class="edit-profile-layout">
            <!-- Logo Section -->
            <div class="avatar-section">
              <h3>Institute Logo</h3>
              <div class="logo-display">
                <i class="fa-solid fa-school"></i>
              </div>
              <button class="btn btn-secondary">
                <i class="fa-solid fa-upload"></i> Upload Logo
              </button>
              <p>Recommended size: 400×400px</p>
            </div>

            <!-- Form Section -->
            <div class="form-container">
              <form class="profile-form">
                <h3>Institute Details</h3>
                <div class="form-group">
                  <label for="inst_name">Institute Name</label>
                  <input type="text" id="inst_name" value="EduLink Institute" />
                </div>
                <div class="form-group">
                  <label for="inst_location">Location</label>
                  <input
                    type="text"
                    id="inst_location"
                    value="123 Main Street, Colombo"
                  />
                </div>
                <div class="form-row">
                  <div class="form-group">
                    <label for="inst_phone">Phone Number</label>
                    <input type="text" id="inst_phone" value="011-2345678" />
                  </div>
                  <div class="form-group">
                    <label for="inst_time">Open Time</label>
                    <input
                      type="text"
                      id="inst_time"
                      value="8:00 AM - 6:00 PM"
                    />
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">
                  Save Changes
                </button>
              </form>
            </div>
          </div>
        </section>

        <!-- ======================================== -->
        <!-- 3. Classes Section (UPDATED)             -->
        <!-- ======================================== -->
        <section id="classes" class="content-section">
          <div class="content-header">
            <h1>
              <i class="fa-solid fa-chalkboard-user"></i> All Institute Classes
            </h1>
            <p>An overview of all classes conducted at the institute.</p>
          </div>

          <div class="classes-list">
            <!-- Class Card 1 -->
            <div class="class-card">
              <div class="class-info">
                <h3>Combined Mathematics</h3>
                <p class="teacher-name">by Janaka Abeywardhana</p>
                <div class="class-meta">
                  <span><i class="fa-solid fa-location-dot"></i> Colombo</span>
                  <span><i class="fa-regular fa-clock"></i> Sat 4-6 PM</span>
                  <span><i class="fa-solid fa-users"></i> 45 Students</span>
                  <span
                    ><i class="fa-solid fa-dollar-sign"></i> $800 Profit</span
                  >
                </div>
              </div>
              <button class="btn btn-secondary">View Details</button>
            </div>

            <!-- Class Card 2 -->
            <div class="class-card">
              <div class="class-info">
                <h3>Chemistry</h3>
                <p class="teacher-name">by Sriyani Dias</p>
                <div class="class-meta">
                  <span><i class="fa-solid fa-location-dot"></i> Kandy</span>
                  <span><i class="fa-regular fa-clock"></i> Fri 3-5 PM</span>
                  <span><i class="fa-solid fa-users"></i> 32 Students</span>
                  <span
                    ><i class="fa-solid fa-dollar-sign"></i> $650 Profit</span
                  >
                </div>
              </div>
              <button class="btn btn-secondary">View Details</button>
            </div>
          </div>
        </section>

        <!-- ======================================== -->
        <!-- 4. Profit Section (Placeholder)          -->
        <!-- ======================================== -->
        <section id="profit" class="content-section">
          <div class="content-header">
            <h1><i class="fa-solid fa-chart-line"></i> Profit Analysis</h1>
            <p>This section is under construction.</p>
          </div>
        </section>

        <!-- ======================================== -->
        <!-- 5. Calendar Section (Placeholder)        -->
        <!-- ======================================== -->
        <section id="calendar" class="content-section">
          <div class="content-header">
            <h1><i class="fa-regular fa-calendar"></i> Institute Calendar</h1>
            <p>This section is under construction.</p>
          </div>
        </section>
      </main>
    </div>
    <?php include __DIR__.'/Component/footer.view.php'; ?>
    <script src="../../Public/assets/js/profile.js"></script>
  </body>
</html>
