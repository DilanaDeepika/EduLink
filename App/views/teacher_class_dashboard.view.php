<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher Dashboard</title>
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
    <!-- Main container for the whole page -->
    <div class="page-container">
      
      <!-- ============================================= -->
      <!-- ============== CLASSES SECTION ============== -->
      <!-- ============================================= -->
  <section class="class-section">
  <div class="header-container">
    <h1 class="section-title">Classes</h1>

    <div class="controls-container">
      <div class="search-wrapper">
        <input type="search" class="search-bar" placeholder="Search" />
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

      <button class="btn new-class-btn">
        <a href="<?php echo ROOT ?>/CreateClass">New Class</a>
      </button>
    </div>
  </div>

  <!-- ✅ Loop starts here -->
  <?php if (!empty($classes)): ?>
    <?php foreach ($classes as $class): ?>
      <div class="class-card">
        <!-- The blue trapezium overlay (hidden by default) -->
        <div class="card-overlay">
          <div class="overlay-links">
            
            <a href="<?php echo ROOT ?>/EditClass/index/<?= $class->class_id ?>" class="overlay-link">Edit Class</a>
            
            <a href="<?php echo ROOT ?>/TeacherVle/index/<?= $class->class_id ?>" class="overlay-link">VLE Manage</a>

          </div>
        </div>

        <!-- Wrapper for the original card content -->
        <div class="card-content">
          <div class="card-photo-section">Add photo</div>

          <div class="card-details-section">
            <div class="info-column">
              <div class="info-row">
                <span class="label">Class</span>
                <span class="value"><?= htmlspecialchars($class->class_name) ?></span>
              </div>

              <div class="info-row">
                <span class="label">Type</span>
                <span class="value">
                  <?= ($class->institute_id == null) ? "Individual Class" : "Institute Class" ?>
                </span>
              </div>
            </div>

            <div class="timeline-column">
              <div class="timeline-wrapper">
                <span class="start-time-label"><?= htmlspecialchars($class->created_at) ?></span>
                <div class="timeline-indicator indicator-2"></div>
                <div class="progress-bar">
                  <div class="progress-bar-fill"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No classes found.</p>
  <?php endif; ?>
  <!-- ✅ Loop ends here -->
</section>

      <!-- =================================================== -->
      <!-- ============== ADVERTISEMENT SECTION ============== -->
      <!-- =================================================== -->
      <section class="advertisement-section">
        <!-- The introductory text you provided -->
        <p class="advertisement-description">
          This section is dedicated to teachers who wish to promote their
          classes or tutoring services. You can create advertisements to
          showcase your courses, share your teaching approach, and highlight the
          subjects or skills you specialize in. This platform allows you to
          reach students who are actively looking for learning opportunities,
          helping you grow your class and connect with learners efficiently.
        </p>
        <div class="advertisement-request-panel">
          <h3 class="section-title">Advertisement Requests</h3>
          <div class="advertisement-container">
            <!-- "+ Advertisement" Button -->
            <button id="openAdModalBtn" class="add-ad-button">
              <span class="plus-icon">+</span> Advertisement
            </button>

            <!-- Advertisement Table -->
            <table class="ad-table">
              <thead>
                <tr>
                  <th>Ad ID</th>
                  <th>Date</th>
                  <th>Duration</th>
                  <th>Status</th>
                  <th>Control</th>
                </tr>
              </thead>
              <tbody>
                <!-- First Row: Pending Status -->
              <?php if (!empty($ads) && is_array($ads)): ?>
              <?php foreach ($ads as $ad): ?>
                <tr>
                  <td><?= htmlspecialchars($ad->id) ?></td>
                  <td><?= htmlspecialchars($ad->created_at) ?></td>
                  <td><?= htmlspecialchars($ad->start_time) ."-". htmlspecialchars($ad->end_time) ?></td>
                  <td><?= htmlspecialchars($ad->status) ?></td>
                  <td>
                    <div class="control-buttons">
                      <a 
                        href="<?php echo ROOT ?>/ClassManager/delete_advertisement_request/<?= $ad->id ?>" 
                        class="control-link delete"
                        onclick="return confirm('Are you sure you want to delete this advertisement request?');"
                        > Delete</a>
                      <a 
                          href="#" 
                          class="control-link edit open-ad-modal" 
                          data-ad-id="<?= $ad->id ?>"
                      >Edit</a>
                      <a href="#" class="control-link show">Show</a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5">No advertisement requests found.</td>
                </tr>
              <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>

<div class="advertisement-module">
    <div id="adRequestModal" class="adv-modal">
        <div class="adv-modal-content">
            <span class="adv-close-button">&times;</span>
            <h2>Submit Advertisement Request</h2>

      
              <form method="POST" action="<?php echo ROOT; ?>/ClassManager/save_advertisement_request" enctype="multipart/form-data" id="adRequestForm">
                    <input type="hidden" name="ad_id" id="ad_id" value="">
                    <input type="hidden" name="advertiser_name" value="TechZone Tutors">
                    <input type="hidden" name="advertiser_contact" value="contact@techzone.com">

  

                <fieldset class="adv-placement-options">
                    <legend>Select Placement Option</legend>
                    
                    <label>
                        <input type="radio" name="placement" value="homepage_poster" required>
                        Place Poster on Homepage
                    </label><br>
                    
                    <label>
                        <input type="radio" name="placement" value="homepage_class_section">
                        Place in Homepage Class Section
                    </label><br>
                    
                    <label>
                        <input type="radio" name="placement" value="community_poster">
                        Place Poster in a Community
                    </label>
                </fieldset>

                <div class="adv-time-selection">
                    <label for="start_time">Start Time:</label>
                    <input type="time" id="start_time" name="start_time" required>
                </div>

                <div class="adv-time-selection">
                    <label for="end_time">End Time:</label>
                    <input type="time" id="end_time" name="end_time" required>
                </div>
                
                    <div class="adv-file-upload">
                        <label class="adv-upload-label" for="ad_poster">
                            <span class="adv-upload-icon"></span> Choose Poster Image...
                        </label>
                        <input type="file" id="ad_poster" name="ad_poster" accept="image/*" class="adv-hidden-file-input">
                        <span id="advFileName" class="adv-file-name">No file selected.</span>
                    </div>

                <button type="submit" class="adv-submit-button">Send Request</button>
            </form>
        </div>
    </div>
</div>
    </div>

    
        <?php include __DIR__.'/Component/footer.view.php'; ?>
        <script>
            const appRoot = "<?php echo ROOT; ?>";
        </script>
        <script src="<?php echo ROOT ?>\assets\js\component\adPopUp.js"></script>
        
  </body>
</html>
