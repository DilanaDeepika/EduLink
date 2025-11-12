<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Class Detail</title>
    <link href="<?php  echo ROOT ?>/assets/css/class_viewstyle.css" rel="stylesheet" />
    <link href="<?php  echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
                    <link
      href="<?php  echo ROOT ?>/assets/css/component/footer-styles.css"
      rel="stylesheet"
    />
</head>
<body>
  <?php include __DIR__.'/Component/nav.view.php'; ?>
  <?php $class = $data['class_details'][0] ?>
  <?php $teacher = $data['teacher_details'][0] ?>
  <?php $schedule = $data['Schedule_details'][0] ?>
  <?php $Objective = $data['Objective_details'][0] ?>

<header class="course-banner" style="background-image: url('<?php echo ROOT ?>/assets/images/edu.png');">
    <div class="banner-overlay">
        <div class="banner-content">
            <div class="class-type-indicator">Institute Class</div>

            <h1>Welcome to the <?php echo htmlspecialchars( $class->class_name) ; ?> Class!</h1>
            <p class="welcome-message"><?php  echo htmlspecialchars($class->welcome_message) ; ?></p>
        </div>
    </div>
</header>

    <main class="class-container">
        <div class="course-details">
            <section class="course-section">
                <h2>Course Description</h2>
                <p><?php echo htmlspecialchars($class->description); ?></p>
            </section>
            
            <section class="course-section">
                <h2>A Message from Your Teacher</h2>
                <div class="video-container"> <video width="100%" controls>
                        <source src="<?php echo ROOT ?>/assets/videos/<?php  echo htmlspecialchars($class->trailer_path); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </section>
          
            <section class="course-section">
                <h2>Class Schedule</h2>
                <div class="schedule-list">
                    <div class="schedule-item">
                        <span class="day"><?php  echo htmlspecialchars($schedule->day_of_week); ?></span>
                        <span class="time"><?php  echo htmlspecialchars($schedule->start_time . " - " .$schedule->end_time); ?></span>
                    </div>
                    <!-- upadte need here-->
                    <div class="schedule-item">
                        <span class="day"><?php  echo htmlspecialchars($schedule->day_of_week); ?></span>  
                        <span class="time"><?php  echo htmlspecialchars($schedule->start_time . " - " .$schedule->end_time); ?></span>
                    </div>
                </div>
            </section>
               <!-- upadte need here-->
            <section class="course-section">
                <h2>Who is this course for?</h2>
                <p class="intended-learners"><?php  echo htmlspecialchars($Objective->objective_text); ?></p>
            </section>
        </div>

        <aside class="class-sidebar">
            <div class="sidebar-card">
                <div class="teacher-info">
                    <div class="teacher-image"></div>
                    <p class="teacher-name"><?php echo htmlspecialchars($teacher->first_name ." " .$teacher->last_name); ?> <span class="verified">✔ Verified</span></p>
                </div>
                <hr>
    
                <ul class="class-info-list">
                    <li><strong>Class Name:</strong> <span><?php echo htmlspecialchars($class->class_name); ?></span></li>
                    <li><strong>Subject:</strong> <span><?php echo htmlspecialchars($class->subject_name); ?></span></li>
                    <li><strong>Grade/Level:</strong> <span><?php echo htmlspecialchars($class->grade_level_name); ?></span></li>
                    <li><strong>Duration:</strong> <span><?php echo htmlspecialchars($class->duration_hours); ?> hours per week</span></li>
                    <li><strong>Language:</strong> <span><?php echo htmlspecialchars($class->language_name); ?></span></li>
                </ul>
                <hr>

                <p class="price">Rs. <?php echo htmlspecialchars($class->monthly_fee); ?></p>
                <div class="payment-actions">
                    <button class="btn pay">Pay Now!</button>
                    <button class="btn wishlist"><i class="fa-regular fa-heart"></i></button>
                </div>
                <p class="free-access">Free full access for 2 weeks - No payment Needed</p>
                <button class="btn free-card" id="apply-free-card-btn">Apply for Free card</button>
                <a href="#" class="share-link">
                    <i class="fa-solid fa-share-nodes"></i> Share
                </a>
            </div>
        </aside>
<div id="free-card-popup" class="popup-overlay" hidden>
  <div class="popup-content">
    <h3>Apply for a Free Access Card</h3>
    <p>To apply, please upload a document for verification (e.g., a letter from your school, proof of financial need, etc.).</p>
    <form id="free-card-form" enctype="multipart/form-data">
<div class="file-input-wrapper">
  <p>Verification Document:</p>
  
  <input type="file" id="proof-document" name="proof_document" required hidden />
  
  <label for="proof-document" class="custom-file-upload">
    <i class="fa-solid fa-cloud-arrow-up"></i> Choose File
  </label>
  
  <span class="file-name" id="file-name-display">No file selected.</span>
</div>
      <div class="popup-actions">
        <button type="submit" class="btn submit">Submit Application</button>
        <button type="button" id="close-popup-btn" class="btn cancel">Cancel</button>
      </div>
    </form>
  </div>
</div>
    </main>
    <script src="<?php  echo ROOT ?>/assets/js/class.js"></script>
    <?php include __DIR__.'/Component/footer.view.php'; ?>
</body>
</html>