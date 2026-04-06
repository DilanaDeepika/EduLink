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
          <a href="#" class="sidebar-item" data-target="community">
            <i class="fa-solid fa-users"></i>
            <span>Community</span>
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
            <div class="profile-avatar" id="main-avatar">
    <?php if (!empty($student->profile_picture)): ?>
        <img src="<?= ROOT ?>/uploads/<?= htmlspecialchars($student->profile_picture) ?>" alt="Profile Picture">
    <?php else: ?>
        <?= strtoupper(substr($student->first_name,0,1).substr($student->last_name ?? '',0,1)) ?>
    <?php endif; ?>
</div>



            <div class="profile-info">
    <h2>
        <?php if (!empty($student)): ?>
            <?= htmlspecialchars($student->first_name . ' ' . $student->last_name) ?>
        <?php else: ?>
            Student
        <?php endif; ?>
    </h2>
    <button class="btn btn-secondary edit-profile-btn">Edit Profile</button>
</div>

          </div>

          <div class="stats-grid">
            <div class="stat-card">
    <p>Enrolled Courses</p>
    <span><?= $enrolledCount ?? 0 ?></span>
    <i class="fa-solid fa-book-open icon-blue"></i>
</div>

<div class="stat-card">
    <p>Completed</p>
    <span><?= $completedCount ?? 0 ?></span>
    <i class="fa-solid fa-star icon-yellow"></i>
</div>

            <div class="stat-card">
              <p>Upcoming Classes</p>
              <span>12</span>
              <i class="fa-solid fa-calendar-days icon-blue"></i>
            </div>
            <div class="stat-card">
              <p>Total Spent</p>
              <span>Rs2,450</span>
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
      <div class="avatar-display" id="avatar-preview">
    <?php if (!empty($student->profile_picture)): ?>
        <img src="<?= ROOT ?>/uploads/<?= htmlspecialchars($student->profile_picture) ?>" alt="Profile Picture">
    <?php else: ?>
        <?= strtoupper(substr($student->first_name,0,1).substr($student->last_name ?? '',0,1)) ?>
    <?php endif; ?>
</div>

<button class="btn btn-secondary" id="upload-btn">
    <i class="fa-solid fa-upload"></i> Upload Photo
</button>
        <p>Image size should be at least 300×300px</p>
    </div>


            <div class="form-container">
              <form class="profile-form" id="edit-profile-form" method="POST" action="<?= ROOT ?>/StudentProfile/update" enctype="multipart/form-data">
  <h3>Personal Information</h3>
  <div class="form-row">
    <div class="form-group">
      <label for="st_first_name">First Name</label>
      <input type="text" id="st_first_name" name="first_name" value="<?= htmlspecialchars($student->first_name ?? '') ?>" />
    </div>
    <div class="form-group">
      <label for="st_last_name">Last Name</label>
      <input type="text" id="st_last_name" name="last_name" value="<?= htmlspecialchars($student->last_name ?? '') ?>" />
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label for="st_nic">NIC Number</label>
      <input type="text" id="st_nic" name="nic" value="<?= htmlspecialchars($student->nic ?? '') ?>" placeholder="e.g., 200112345678" />
    </div>
    <div class="form-group">
      <label for="st_age">Age</label>
      <input type="number" id="st_age" name="age" value="<?= htmlspecialchars($student->age ?? '') ?>" placeholder="e.g., 18" />
    </div>
  </div>

  <div class="form-group">
    <label for="st_school">School Name</label>
    <input type="text" id="st_school" name="school_name" value="<?= htmlspecialchars($student->school_name ?? '') ?>" placeholder="Enter your school name" />
  </div>

  <h3>Contact Information</h3>
  <div class="form-group">
    <label for="st_email">Email</label>
    <input type="email" id="st_email" name="email" value="<?= htmlspecialchars($student->email ?? '') ?>" />
  </div>

  <div class="form-group">
    <label for="st_phone_no">Phone Number</label>
    <input type="text" id="st_phone_no" name="phone_number" value="<?= htmlspecialchars($student->phone_number ?? '') ?>" />
  </div>

  <div class="form-group">
    <label for="st_address">Address</label>
    <input type="text" id="st_address" name="address" value="<?= htmlspecialchars($student->address ?? '') ?>" />
  </div>

  <h3>Parent/Guardian Information</h3>
  <div class="form-group">
    <label for="parent_name">Parent's Name</label>
    <input type="text" id="parent_name" name="parent_name" value="<?= htmlspecialchars($student->parent_name ?? '') ?>" placeholder="Enter parent's full name" />
  </div>
  <div class="form-group">
    <label for="parent_phone">Parent's Phone Number</label>
    <input type="text" id="parent_phone" name="parent_phone_number" value="<?= htmlspecialchars($student->parent_phone_number ?? '') ?>" placeholder="e.g., 0712345678" />
  </div>
<input type="file" id="profile_picture" name="profile_picture" accept="image/*" style="display:none;">
  <button type="submit" class="btn btn-primary">Save Changes</button>
</form>

            </div>
          </div>
        </section>
<section id="my-courses" class="content-section">
    <div class="content-header">
        <h1><i class="fa-solid fa-book-open"></i> My Courses</h1>
        <p>Track your learning progress and continue where you left off</p>
    </div>

    <?php if(!empty($classes)): ?>
        <?php foreach($classes as $class): ?>
            <div class="course-card">
                <div class="course-info">
                    <h3><?= htmlspecialchars($class->class_name) ?></h3>
                    <p class="instructor"><?= htmlspecialchars($class->teacher_name) ?></p>
<div class="progress-fill" style="width: <?= $class->progress ?>%"></div>
<span class="progress-percent"><?= $class->progress ?>%</span>

                </div>
              <?php
$continueUrl = ROOT . "/ClassPage?id=" . $class->class_id;

if (!empty($class->can_access_vle) && $class->can_access_vle === true) {
    $continueUrl = ROOT . "/StudentVLE/index?id=" . $class->class_id;
}
?>

<button class="btn btn-secondary" onclick="location.href='<?= $continueUrl ?>'">
    Continue
</button>





            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You are not enrolled in any courses yet.</p>
    <?php endif; ?>
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
<?php if (!empty($payments)): ?>
    <?php foreach ($payments as $payment): ?>
        <tr>
            <td><?= htmlspecialchars($payment->invoice_number) ?></td>
            <td><?= htmlspecialchars($payment->class_name) ?></td>
            <td><?= $payment->paid_at ? date('M d, Y', strtotime($payment->paid_at)) : '-' ?></td>
            <td>Rs.<?= number_format($payment->amount, 2) ?></td>
            <td>
                <?php
                    $statusClass = match($payment->payment_status) {
                        'paid' => 'status-completed',
                        'pending' => 'status-pending',
                        'failed' => 'status-failed',
                        'refunded' => 'status-refunded',
                        default => 'status-pending'
                    };
                ?>
                <span class="status-badge <?= $statusClass ?>"><?= ucfirst($payment->payment_status) ?></span>
            </td>
            <td>
    <form method="GET" action="<?= ROOT ?>/Payments/invoice" target="_blank">
    <input type="hidden" name="payment_id" value="<?= $payment->payment_id ?>">
    <button type="submit" class="btn btn-secondary">
        <i class="fa-solid fa-download"></i> Invoice
    </button>
</form>

    </form>
</td>

        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="6">No payments found.</td>
    </tr>
<?php endif; ?>
</tbody>

            </table>
          </div>
        </section>
        <section id="community" class="content-section">
          <div class="content-header">
            <h1><i class="fa-solid fa-users"></i> Community Hub</h1>
          </div>

          <div class="community-finder">
            <h3>Find a New Community</h3>
            <p>Search for study groups and communities to join.</p>
            <div class="community-search-bar">
              <input type="search" placeholder="Search by name or subject..." />
              <button class="btn btn-secondary">Search</button>
            </div>
          </div>

          <div class="my-communities-section">
            <h3>My Communities</h3>
            <div class="community-list">
              <div class="community-card">
                <div class="community-info">
                  <h3>Physics A-Level Study Group</h3>
                  <p class="community-admin">Admin: Janaka Abeywardhana</p>
                  <div class="community-meta">
                    <span><i class="fa-solid fa-users"></i> 125 Members</span>
                  </div>
                </div>
                <button class="btn btn-primary-light">View Community</button>
              </div>

              <div class="community-card">
                <div class="community-info">
                  <h3>Chemistry Help Desk</h3>
                  <p class="community-admin">Admin: EduLink Institute</p>
                  <div class="community-meta">
                    <span><i class="fa-solid fa-users"></i> 210 Members</span>
                  </div>
                </div>
                <button class="btn btn-primary-light">View Community</button>
              </div>
            </div>
          </div>
        </section>
        <section id="my-calendar" class="content-section">
          <div class="content-header">
            <h1><i class="fa-regular fa-calendar"></i> My Calendar</h1>
            <p>Stay organized with your upcoming classes and events</p>
          </div>
          <div class="calendar-placeholder">
            <?php include __DIR__.'/Component/calander.php'; ?>
          </div>
        </section>

<script>
let studentEvents = <?= json_encode($events ?? []) ?>;
const appRoot = "<?= ROOT ?>";
</script>




      </main>
    </div>
     <?php include __DIR__.'/Component/footer.view.php'; ?>
          <script src="<?php  echo ROOT ?>/assets/js/calander.js"></script>
    <script src="<?php  echo ROOT ?>/assets/js/profile.js"></script>
  </body>
</html>
