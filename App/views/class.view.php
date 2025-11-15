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
<header class="course-banner" style="background-image: url('<?php echo ROOT ?>/assets/images/edu.png');">
    <div class="banner-overlay">
        <div class="banner-content">
            <div class="class-type-indicator">Institute Class</div>
            <h1>Welcome to the Advanced Physics Class!</h1>
            <p class="welcome-message">Unlock the secrets of the universe with our comprehensive course designed for dedicated learners.</p>
        </div>
    </div>
</header>

    <main class="class-container">
        <div class="course-details">
            <section class="course-section">
                <h2>Course Description</h2>
                <p>This course covers a wide range of topics in advanced physics, from classical mechanics to quantum theory. It is designed to provide students with a deep understanding of the fundamental principles that govern the natural world. Taught by an experienced educator, this class is perfect for those looking to excel in their exams or pursue a career in science.</p>
            </section>
            
            <section class="course-section">
                <h2>A Message from Your Teacher</h2>
                <div class="video-container"> <video width="100%" controls>
                        <source src="<?php echo ROOT ?>/assets/videos/Tuition_Class.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </section>
            <section class="course-section">
                <h2>Class Schedule</h2>
                <div class="schedule-list">
                    <div class="schedule-item">
                        <span class="day">Mondays:</span>
                        <span class="time">4:00 PM - 6:00 PM</span>
                    </div>
                    <div class="schedule-item">
                        <span class="day">Thursdays:</span>
                        <span class="time">5:00 PM - 7:00 PM</span>
                    </div>
                </div>
            </section>

            <section class="course-section">
                <h2>Who is this course for?</h2>
                <p class="intended-learners">This course is ideal for A-Level students, university applicants, and anyone with a passion for physics who wishes to deepen their knowledge. A basic understanding of mathematics is recommended.</p>
            </section>
        </div>

        <aside class="class-sidebar">
            <div class="sidebar-card">
                <div class="teacher-info">
                    <div class="teacher-image"></div>
                    <p class="teacher-name">S M Dilana Deepika <span class="verified">✔ Verified</span></p>
                </div>
                <hr>
                
                <ul class="class-info-list">
                    <li><strong>Class Name:</strong> <span>Advanced Physics</span></li>
                    <li><strong>Subject:</strong> <span>Physics</span></li>
                    <li><strong>Grade/Level:</strong> <span>A-Level</span></li>
                    <li><strong>Duration:</strong> <span>4 hours per week</span></li>
                    <li><strong>Language:</strong> <span>English</span></li>
                </ul>
                <hr>

                <p class="price">Rs. 1000.00</p>
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