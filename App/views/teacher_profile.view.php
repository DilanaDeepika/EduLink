<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EduLink - Teacher Dashboard</title>
        <link href="<?php  echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
            <link
      href="<?php  echo ROOT ?>/assets/css/component/footer-styles.css"
      rel="stylesheet"
    />
        <link
      rel="stylesheet"
      href="<?php  echo ROOT ?>/assets/css/component/calander.css"
    />
    <link
      rel="stylesheet"
      href="<?php  echo ROOT ?>/assets/css/component/event.css"
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
          <a href="#" class="sidebar-item active" data-target="settings">
            <i class="fa-solid fa-gear"></i>
            <span>Settings</span>
          </a>
          <a href="#" class="sidebar-item" data-target="edit-profile">
            <i class="fa-regular fa-user"></i>
            <span>Edit Profile</span>
          </a>
          <a href="#" class="sidebar-item" data-target="profit">
            <i class="fa-solid fa-chart-line"></i>
            <span>Profit</span>
          </a>
          <a href="#" class="sidebar-item" data-target="my-classes">
            <i class="fa-solid fa-chalkboard-user"></i>
            <span>My Classes</span>
          </a>
          <a href="#" class="sidebar-item" data-target="my-calendar">
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
            <div class="profile-avatar">JA</div>
            <div class="profile-info">
              <h2>Janaka Abeywardhana</h2>
              <button class="btn btn-secondary">Edit Profile</button>
            </div>
          </div>

          <div class="stats-grid">
            <div class="stat-card">
              <p>Total Classes</p>
              <span>4</span>
              <i class="fa-solid fa-chalkboard-user icon-blue"></i>
            </div>
            <div class="stat-card">
              <p>Total Students</p>
              <span>128</span>
              <i class="fa-solid fa-users icon-yellow"></i>
            </div>
            <div class="stat-card">
              <p>Monthly Revenue</p>
              <span>$3,200</span>
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
              <div class="avatar-display">JA</div>
              <button class="btn btn-secondary">
                <i class="fa-solid fa-upload"></i> Upload Photo
              </button>
              <p>Image size should be at least 300×300px</p>
            </div>

            <!-- Form Section -->
            <div class="form-container">
              <form class="profile-form">
                <h3>Personal Information</h3>
                <div class="form-row">
                  <div class="form-group">
                    <label for="t_first_name">First Name</label>
                    <input type="text" id="t_first_name" value="Janaka" />
                  </div>
                  <div class="form-group">
                    <label for="t_last_name">Last Name</label>
                    <input type="text" id="t_last_name" value="Abeywardhana" />
                  </div>
                </div>

                <h3>Contact Information</h3>
                <div class="form-group">
                  <label for="t_email">Email</label>
                  <input
                    type="email"
                    id="t_email"
                    value="janaka.a@example.com"
                  />
                </div>
                <div class="form-group">
                  <label for="t_phone_no">Phone Number</label>
                  <input type="text" id="t_phone_no" value="0712345678" />
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
            <p>This section is under construction.</p>
          </div>
        </section>

        <!-- ======================================== -->
        <!-- 4. My Classes Section (UPDATED)          -->
        <!-- ======================================== -->
        <section id="my-classes" class="content-section">
          <div class="content-header">
            <h1><i class="fa-solid fa-chalkboard-user"></i> My Classes</h1>
            <p>Manage your ongoing and upcoming classes.</p>
          </div>

          <div class="classes-list">
            <!-- Class Card 1 -->
            <div class="class-card">
              <div class="class-info">
                <h3>Combined Mathematics</h3>
                <div class="class-meta">
                  <span class="class-type-badge institute">
                    <i class="fa-solid fa-building"></i> Institute Class
                  </span>
                  <span><i class="fa-solid fa-location-dot"></i> Colombo</span>
                  <span><i class="fa-regular fa-clock"></i> Sat 4-6 PM</span>
                  <span><i class="fa-solid fa-users"></i> 45 Students</span>
                  <span
                    ><i class="fa-solid fa-dollar-sign"></i> $800 Profit</span
                  >
                </div>
              </div>
              <button class="btn btn-secondary">Manage Class</button>
            </div>

            <!-- Class Card 2 -->
            <div class="class-card">
              <div class="class-info">
                <h3>Advanced Physics</h3>
                <div class="class-meta">
                  <span class="class-type-badge individual">
                    <i class="fa-solid fa-user"></i> Individual Class
                  </span>
                  <span><i class="fa-solid fa-location-dot"></i> Online</span>
                  <span><i class="fa-regular fa-clock"></i> Sun 2-4 PM</span>
                  <span><i class="fa-solid fa-users"></i> 20 Students</span>
                  <span
                    ><i class="fa-solid fa-dollar-sign"></i> $550 Profit</span
                  >
                </div>
              </div>
              <button class="btn btn-secondary">Manage Class</button>
            </div>
          </div>
        </section>

        <!-- ======================================== -->
        <!-- 5. My Calendar Section (Placeholder)     -->
        <!-- ======================================== -->
        <section id="my-calendar" class="content-section">
          <div class="content-header">
            <h1><i class="fa-regular fa-calendar"></i> My Calendar</h1>
            <p>This section is under construction.</p>
            <?php include __DIR__.'/Component/calander.php'; ?>
          </div>
        </section>
      </main>
    </div>
    <?php include __DIR__.'/Component/footer.view.php'; ?>
      <script src="<?php  echo ROOT ?>/assets/js/calander.js"></script>
  <script src="<?php  echo ROOT ?>/assets/js/event.js"></script>
    <script src="<?php  echo ROOT ?>/assets/js/profile.js"></script>
  </body>
</html>
