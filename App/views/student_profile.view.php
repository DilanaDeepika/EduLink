<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EduLink - Student Dashboard</title>
        <link href="<?php  echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/profile.css" />
            <link
      rel="stylesheet"
      href="<?php  echo ROOT ?>/assets/css/component/calander.css"
    />
    <link
      rel="stylesheet"
      href="<?php  echo ROOT ?>/assets/css/component/event.css"
    />
                <link
      href="<?php  echo ROOT ?>/assets/css/component/footer-styles.css"
      rel="stylesheet"
    />
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
          <a href="#" class="sidebar-item active" data-target="settings">
            <i class="fa-solid fa-gear"></i>
            <span>Settings</span>
          </a>
          <a href="#" class="sidebar-item" data-target="edit-profile">
            <i class="fa-regular fa-user"></i>
            <span>Edit Profile</span>
          </a>
          <a href="#" class="sidebar-item" data-target="my-courses">
            <i class="fa-solid fa-book-open"></i>
            <span>My Courses</span>
          </a>
          <a href="#" class="sidebar-item" data-target="my-payments">
            <i class="fa-solid fa-credit-card"></i>
            <span>My Payments</span>
          </a>
          <a href="#" class="sidebar-item" data-target="my-calendar">
            <i class="fa-regular fa-calendar"></i>
            <span>My Calendar</span>
          </a>
        </nav>
      </aside>

      <main class="main-content">
        <section id="settings" class="content-section active">
          <div class="profile-card">
            <div class="profile-avatar">KG</div>
            <div class="profile-info">
              <h2>Kevin Gilbert</h2>
              <button class="btn btn-secondary">Edit Profile</button>
            </div>
          </div>

          <div class="stats-grid">
            <div class="stat-card">
              <p>Enrolled Courses</p>
              <span>8</span>
              <i class="fa-solid fa-book-open icon-blue"></i>
            </div>
            <div class="stat-card">
              <p>Completed</p>
              <span>5</span>
              <i class="fa-solid fa-star icon-yellow"></i>
            </div>
            <div class="stat-card">
              <p>Upcoming Classes</p>
              <span>12</span>
              <i class="fa-solid fa-calendar-days icon-blue"></i>
            </div>
            <div class="stat-card">
              <p>Total Spent</p>
              <span>$2,450</span>
              <i class="fa-solid fa-dollar-sign icon-yellow"></i>
            </div>
          </div>

          <div class="action-cards-grid">
            <div class="action-card">
              <i class="fa-solid fa-book"></i>
              <h3>My Courses</h3>
              <p>Manage your enrolled courses and track your progress.</p>
              <button class="btn btn-primary-light">View Courses</button>
            </div>
            <div class="action-card">
              <i class="fa-solid fa-credit-card"></i>
              <h3>Payments</h3>
              <p>Check your payment history and upcoming invoices.</p>
              <button class="btn btn-primary-light">View Payments</button>
            </div>
            <div class="action-card">
              <i class="fa-solid fa-calendar-alt"></i>
              <h3>Calendar</h3>
              <p>Stay organized with your class schedule and deadlines.</p>
              <button class="btn btn-primary-light">View Calendar</button>
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
              <div class="avatar-display">KG</div>
              <button class="btn btn-secondary">
                <i class="fa-solid fa-upload"></i> Upload Photo
              </button>
              <p>Image size should be at least 300×300px</p>
            </div>

            <div class="form-container">
              <form class="profile-form">
                <h3>Personal Information</h3>
                <div class="form-row">
                  <div class="form-group">
                    <label for="st_first_name">First Name</label>
                    <input type="text" id="st_first_name" value="Kevin" />
                  </div>
                  <div class="form-group">
                    <label for="st_last_name">Last Name</label>
                    <input type="text" id="st_last_name" value="Gomas" />
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group">
                    <label for="st_nic">NIC Number</label>
                    <input
                      type="text"
                      id="st_nic"
                      placeholder="e.g., 200112345678"
                    />
                  </div>
                  <div class="form-group">
                    <label for="st_age">Age</label>
                    <input type="number" id="st_age" placeholder="e.g., 18" />
                  </div>
                </div>

                <div class="form-group">
                  <label for="st_school">School Name</label>
                  <input
                    type="text"
                    id="st_school"
                    placeholder="Enter your school name"
                  />
                </div>

                <h3>Contact Information</h3>
                <div class="form-group">
                  <label for="st_email">Email</label>
                  <input
                    type="email"
                    id="st_email"
                    value="kevin.gomas@example.com"
                  />
                </div>

                <div class="form-group">
                  <label for="st_phone_no">Phone Number</label>
                  <input type="text" id="st_phone_no" value="0755645895" />
                </div>

                <div class="form-group">
                  <label for="st_address">Address</label>
                  <input
                    type="text"
                    id="st_address"
                    value="No 45, St.Mary's Road, Colombo 02"
                  />
                </div>

                <h3>Parent/Guardian Information</h3>
                <div class="form-group">
                  <label for="parent_name">Parent's Name</label>
                  <input
                    type="text"
                    id="parent_name"
                    placeholder="Enter parent's full name"
                  />
                </div>
                <div class="form-group">
                  <label for="parent_phone">Parent's Phone Number</label>
                  <input
                    type="text"
                    id="parent_phone"
                    placeholder="e.g., 0712345678"
                  />
                </div>

                <button type="submit" class="btn btn-primary">
                  Save Changes
                </button>
              </form>
            </div>
          </div>
        </section>

        <section id="my-courses" class="content-section">
          <div class="content-header">
            <h1><i class="fa-solid fa-book-open"></i> My Courses</h1>
            <p>Track your learning progress and continue where you left off</p>
          </div>
          <div class="course-card">
            <div class="course-info">
              <h3>Combined Mathematics</h3>
              <p class="instructor">Janaka Abeywardhana</p>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 75%"></div>
              </div>
              <span class="progress-percent">75%</span>
            </div>
            <button class="btn btn-secondary">Continue</button>
          </div>
          <div class="course-card">
            <div class="course-info">
              <h3>Chemistry</h3>
              <p class="instructor">Sriyani Dias</p>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 60%"></div>
              </div>
              <span class="progress-percent">60%</span>
            </div>
            <button class="btn btn-secondary">Continue</button>
          </div>
        </section>

        <section id="my-payments" class="content-section">
          <div class="content-header">
            <h1><i class="fa-solid fa-credit-card"></i> My Payments</h1>
            <p>View your payment history and download invoices</p>
          </div>
          <div class="table-container">
            <table class="payment-table">
              <thead>
                <tr>
                  <th>Invoice ID</th>
                  <th>Class</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>INV-2024-001</td>
                  <td>Physics</td>
                  <td>Jan 15, 2025</td>
                  <td>Rs.2500</td>
                  <td>
                    <span class="status-badge status-completed">Completed</span>
                  </td>
                  <td>
                    <button class="btn btn-secondary">
                      <i class="fa-solid fa-download"></i> Invoice
                    </button>
                  </td>
                </tr>
                <tr>
                  <td>INV-2024-005</td>
                  <td>Economics</td>
                  <td>Feb 28, 2025</td>
                  <td>Rs.1500</td>
                  <td>
                    <span class="status-badge status-pending">Pending</span>
                  </td>
                  <td>
                    <button class="btn btn-secondary">
                      <i class="fa-solid fa-download"></i> Invoice
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>

        <section id="my-calendar" class="content-section">
          <div class="content-header">
            <h1><i class="fa-regular fa-calendar"></i> My Calendar</h1>
            <p>Stay organized with your upcoming classes and events</p>
          </div>
          <div class="calendar-placeholder">
            <p>Your calendar will be displayed here.</p>
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
