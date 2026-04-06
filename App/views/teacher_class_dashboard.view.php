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
            
            <a href="<?php echo ROOT ?>/EditClass/<?= $class->class_id ?>" class="overlay-link">Edit Class</a>
            
            <a href="<?php echo ROOT ?>/TeacherVle/<?= $class->class_id ?>" class="overlay-link">VLE Manage</a>

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
    
    <div class="panel-header">
      <h3 class="section-title">Advertisement Requests</h3>
      
      <button class="add-ad-button" id="openModalBtn">
          <span class="plus-icon">+</span> Request Advertisement
      </button>
    </div>

    <div class="advertisement-container">
      <table class="ad-table">
        <thead>
          <tr>
            <th>Ad ID</th>
            <th>Ad Name</th>
            <th>Ad Type</th>
            <th>Duration</th>
            <th>Status</th>
            <th>Control</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($ads) && is_array($ads)): ?>
            <?php foreach ($ads as $ad): ?>
              <tr>
                <td><?= htmlspecialchars($ad->id) ?></td>
                <td><?= htmlspecialchars($ad->advertiser_name) ?></td>
                <td><?= htmlspecialchars($ad->placement_option) ?></td>
                <td><?= htmlspecialchars($ad->start_datetime) ."     -     ". htmlspecialchars($ad->end_datetime) ?></td>
                <td><?= htmlspecialchars($ad->status) ?></td>
                <td>
                  <div class="control-buttons">
                    <a href="<?php echo ROOT ?>/ClassManager/delete_advertisement_request/<?= $ad->id ?>" 
                       class="control-link delete"
                       onclick="return confirm('Are you sure?');"> Delete</a>
                    <?php 
                    // 1. Get the status safely
                      $status = htmlspecialchars($ad->status);
                      
                      // 2. Default values
                      $btnLabel = '';
                      $btnUrl   = '#';
                      $btnClass = '';
                      $isDisabled = false;

                    // 3. Logic Switch
                      switch ($status) {
                          case 'Active':
                              $btnLabel = 'Show';
                              // Change this URL to where "Show" should go (e.g., View Ad page)
                              $btnUrl   = ROOT . "/Ads/view?id=" . $ad->id; 
                              $btnClass = 'show-btn';
                              break;

                          case 'Pending':
                          case 'Admin Review': // Optional: Handle review state same as pending
                              $btnLabel = 'Wait';
                              $btnUrl   = 'javascript:void(0)'; // No link
                              $btnClass = 'wait-btn';
                              $isDisabled = true;
                              break;

                          case 'Poster Approval':
                              $btnLabel = 'Pay Here';
                              // Change this URL to your Payment page
                              $btnUrl   = ROOT . "/Payment/checkout?ad_id=" . $ad->id; 
                              $btnClass = 'pay-btn';
                              break;

                          default:
                              $btnLabel = $status;
                              $btnClass = 'default-btn';
                              break;
                      }
                    ?>
                    <a href="<?= $btnUrl ?>" class="control-link show"><?= $btnLabel ?></a>
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

<div id="advModal" class="adv-modal">
    <div class="adv-modal-content">
        <span class="adv-close-button" id="closeModalBtn">&times;</span>
        <h2>Request Advertisement</h2>

        <form action="<?php echo ROOT ?>/ClassManager/saveReq" method="POST" enctype="multipart/form-data" id="adForm">
            
            <fieldset>
                <legend>Advertiser Details</legend>
                <div class="adv-advertiser-details">
                    <p><strong>Name:</strong> <input type="text" name="advertiser_name" placeholder="Enter your name" required class="text-input"></p>
                </div>
            </fieldset>

            <fieldset>
                <legend>Select Schedule</legend>
                
                <div class="selection-status-bar">
                    <div class="status-item" id="startDisplay">
                        <span class="label">FROM:</span> <span class="value">Select Date...</span>
                    </div>
                    <div class="arrow">→</div>
                    <div class="status-item" id="endDisplay">
                        <span class="label">TO:</span> <span class="value">...</span>
                    </div>
                    <button type="button" id="resetBtn" class="reset-btn" title="Reset Selection">↺</button>
                </div>

                <input type="hidden" name="start_date" id="input_start_date">
                <input type="hidden" name="start_time" id="input_start_time">
                <input type="hidden" name="end_date"   id="input_end_date">
                <input type="hidden" name="end_time"   id="input_end_time">

                <div class="schedule-split-layout">
                    
                    <div class="calendar-wrapper">
                        <div class="calendar-header">
                            <button type="button" id="prevMonth"><i class="fas fa-chevron-left"></i> &lt;</button>
                            <span id="currentMonthYear"></span>
                            <button type="button" id="nextMonth">&gt; <i class="fas fa-chevron-right"></i></button>
                        </div>
                        <div class="calendar-grid" id="calendarGrid"></div>
                        
                        <div class="legend-row">
                            <span class="legend-item"><span class="dot full-booked"></span> Full</span>
                            <span class="legend-item"><span class="dot selected-start"></span> Start</span>
                            <span class="legend-item"><span class="dot selected-end"></span> End</span>
                        </div>
                    </div>

                    <div class="time-wrapper">
                        <h4 id="timeSlotHeader">Select Start Time</h4>
                        <div class="time-slots-grid" id="timeSlotsContainer">
                            <p class="placeholder-text">Please select a date first.</p>
                        </div>
                        <p id="selectionFeedback" class="selection-feedback">Step 1: Choose Start Date</p>
                    </div>

                </div>
            </fieldset>

            <fieldset>
              <legend>Placement & Poster</legend>
              
              <div class="adv-placement-options">
                  <label>
                      <input type="radio" name="placement" value="homepage_poster" checked>
                      Home Page Banner
                  </label>
                  
                  <label>
                      <input type="radio" name="placement" value="community_poster">
                      Community Ad
                  </label>
                  
                  <label>
                      <input type="radio" name="placement" value="homepage_class_section">
                      Class Ad
                  </label>
              </div>
                  <div class="adv-comm-select hidden" id="class_select_container">
                      <label for="class_id_input" class="form-label">Select Class to Advertise:</label>
                      
                      <select name="class_id" id="class_id_input" class="form-control">
                          <option value="" disabled selected>-- Choose a Class --</option>
                          
                          <?php if (!empty($data['classes'])): ?>
                              <?php foreach ($data['classes'] as $class): ?>
                                  <option value="<?= $class->class_id ?>">
                                      <?= htmlspecialchars($class->class_name) ?>
                                  </option>
                              <?php endforeach; ?>
                          <?php else: ?>
                              <option value="" disabled>No classes found</option>
                          <?php endif; ?>
                      </select>
                  </div>


                  <div class="adv-comm-select hidden" id="community_select">
                      <label for="community_id_input" class="form-label">Select Community:</label>
                      
                      <select name="community_id" id="community_id_input" class="form-control" required>

                        <option value="" disabled selected>-- Choose a Community --</option>
                        
                        <?php if (!empty($data['community_details'])): ?>
                            <?php foreach ($data['community_details'] as $community): ?>
                                <option value="<?= htmlspecialchars($community->id) ?>">
                                    <?= htmlspecialchars($community->name) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled>No communities available</option>
                        <?php endif; ?>
                      </select>
                  </div>

                  <div class="adv-comm-select hidden" id="community_desc_container" style="margin-top: 15px;">
                      <label for="ad_description" class="form-label">Post Caption / Description:</label>
                      <textarea 
                          name="description" 
                          id="ad_description" 
                          class="form-control" 
                          rows="4" 
                          placeholder="Write something about this post..."></textarea>
                  </div>

              <div class="adv-file-upload" id="fileUploadContainer">
                  <label for="ad_file" class="adv-upload-label">
                      <span class="adv-upload-icon">&#128229;</span> Choose Poster
                  </label>
                  <input type="file" id="ad_file" name="ad_poster" class="adv-hidden-file-input" required>
                  <span id="fileNameDisplay" style="font-size:0.8rem; margin-left:10px; color:#666;"></span>
              </div>

          </fieldset>

            <button type="submit" class="adv-submit-button" id="submitAdvBtn" disabled>Submit Request</button>
        </form>
    </div>
</div>
</div>
        <?php include __DIR__.'/Component/footer.view.php'; ?>
        <script>
          const ROOT = "<?php echo ROOT; ?>";
        </script>
        <script src="<?php echo ROOT ?>/assets/js/component/adPopUp.js"></script>
        
  </body>
</html>
