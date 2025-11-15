<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Class Dashboard</title>
    <link
      href="<?php  echo ROOT ?>/assets/css/teacher_class_dashboard.css"
      rel="stylesheet"
    />
    <link href="<?php  echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
    <link
      href="<?php  echo ROOT ?>/assets/css/component/footer-styles.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <header>
        <?php include __DIR__.'/Component/nav.view.php'; ?>
    </header>
    <div class="page-container">
    <section class="class-section">
      <div class="header-container">
        <h1 class="section-title">My Enrolled Classes</h1>

        <div class="controls-container">
          <div class="search-wrapper">
            <input type="search" class="search-bar" placeholder="Search my classes" />
            <button class="search-btn">
              <svg
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="white"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <?php if (!empty($data['classes'])): ?>
    <?php foreach ($data['classes'] as $class): ?>
        <?php if ($class['enrollment_status'] === 'enrolled' || $class['enrollment_status'] === 'completed'): ?>
            <div class="class-card">
                <div class="card-overlay">
                    <div class="overlay-links">
                        <a href="<?php echo ROOT ?>/Class/view/<?= $class['class_id'] ?>" class="overlay-link">Go to VLE</a>
                        <a href="<?php echo ROOT ?>/ClassManager/leave_class/<?= $class['class_id'] ?>" class="overlay-link">Leave Class</a>
                        
                        <?php if ($class['enrollment_status'] === 'completed'): ?>
                            <button class="apply-marking-btn">Apply For Marking Panel</button>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-content">
                    <div class="card-photo-section">Add photo</div>

                    <div class="card-details-section">
                        <div class="info-column">
                            <div class="info-row">
                                <span class="label">Class Name</span>
                                <span class="value"><?= htmlspecialchars($class['class_name']) ?></span>
                            </div>

                            <div class="info-row">
                                <span class="label">Type</span>
                                <span class="value">
                                    <?= ($class['institute_id'] == null) ? "Individual Class" : "Institute Class" ?>
                                </span>
                            </div>

                            <div class="info-row status-row">
                                <span class="label">Status</span>
                                <span class="value status-<?= strtolower($class['enrollment_status']) ?>">
                                    <?= htmlspecialchars(ucfirst($class['enrollment_status'])) ?>
                                </span>
                            </div>
                        </div>

                        <div class="timeline-column">
                            <div class="timeline-wrapper">
                                <span class="start-time-label">
                                    Enrolled: <?= htmlspecialchars($class['enrollment_date'] ?? $class['created_at']) ?>
                                </span>
                                <div class="timeline-indicator indicator-2"></div>
                                <div class="progress-bar">
                                    <div class="progress-bar-fill"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <p class="no-classes-message">You are not currently enrolled in any classes.</p>
<?php endif; ?>
    </section>

    </div>
    <div style="clear: both;"></div>
    <?php include __DIR__.'/Component/footer.view.php'; ?>
    <script src="<?php echo ROOT ?>\assets\js\component\adPopUp.js"></script>
  </body>
</html>
