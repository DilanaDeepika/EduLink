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

            <button class="btn new-class-btn">New Class</button>
          </div>
        </div>

        <div class="class-card">
          <!-- The blue trapezium overlay (hidden by default) -->
          <div class="card-overlay">
            <div class="overlay-links">
              <a href="#" class="overlay-link">Edit Class</a>
              <a href="#" class="overlay-link">VLE Manage</a>
            </div>
          </div>

          <!-- Wrapper for the original card content -->
          <div class="card-content">
            <div class="card-photo-section">Add photo</div>
            <div class="card-details-section">
              <div class="info-column">
                <div class="info-row">
                  <span class="label">Class</span>
                  <span class="value">Maths</span>
                </div>
                <div class="info-row">
                  <span class="label">Status</span>
                  <span class="value">Complete</span>
                </div>
                <div class="info-row">
                  <span class="label">Type</span>
                  <span class="value">institute teacher</span>
                </div>
              </div>
              <div class="timeline-column">
                <div class="timeline-wrapper">
                  <span class="start-time-label">Start time</span>
                  <div class="timeline-indicator indicator-1"></div>
                  <div class="timeline-indicator indicator-2"></div>
                  <div class="progress-bar">
                    <div class="progress-bar-fill"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
            <button class="add-ad-button">
              <span class="plus-icon">+</span> Advertisement
            </button>

            <!-- Advertisement Table -->
            <table class="ad-table">
              <thead>
                <tr>
                  <th>Poster</th>
                  <th>Ad ID</th>
                  <th>Date</th>
                  <th>Duration</th>
                  <th>Status</th>
                  <th>Control</th>
                </tr>
              </thead>
              <tbody>
                <!-- First Row: Pending Status -->
                <tr>
                  <td><div class="poster-placeholder"></div></td>
                  <td>AD543</td>
                  <td>2025.09.08</td>
                  <td>9:25 - 13:30</td>
                  <td>Pending</td>
                  <td>
                    <div class="control-buttons">
                      <a href="#" class="control-link delete">Delete</a>
                      <a href="#" class="control-link show">Show</a>
                    </div>
                  </td>
                </tr>
                <!-- Second Row: Submit Status -->
                <tr>
                  <td><div class="poster-placeholder"></div></td>
                  <td>AD543</td>
                  <td>2025.09.08</td>
                  <td>9:25 - 13:30</td>
                  <td>Submit</td>
                  <td>
                    <div class="control-buttons">
                      <a href="#" class="control-link delete">Delete</a>
                      <a href="#" class="control-link show">Show</a>
                    </div>
                  </td>
                </tr>
                <!-- Add more rows here as needed -->
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
        <?php include __DIR__.'/Component/footer.view.php'; ?>
  </body>
</html>
