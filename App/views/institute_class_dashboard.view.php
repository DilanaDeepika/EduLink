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

            <button class="btn new-class-btn"><a href="<?php  echo ROOT ?>/InstituteClassCreate">New Class</a></button>
          </div>
        </div>

        <div class="class-card">
          <div class="card-overlay">
            <div class="overlay-links">
              <a href="#" class="overlay-link">Edit Class</a>
              <a href="<?php  echo ROOT ?>/ClassMgt" class="overlay-link">Class Manage</a>
            </div>
          </div>

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
            <button id="openAdModalBtn" class="add-ad-button">
              <span class="plus-icon">+</span> Advertisement
            </button>

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
        <script src="<?php echo ROOT ?>\assets\js\component\adPopUp.js"></script>
        
  </body>
</html>
