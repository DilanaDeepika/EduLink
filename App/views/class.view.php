<?php
$class = isset($class_details) ? $class_details : null;

$institute = isset($institute_details) ? $institute_details : null;

$teacher = (!empty($teacher_details) && isset($teacher_details[0])) ? $teacher_details[0] : null;

$enrollment = isset($enrollment) ? $enrollment : null;

$schedule = (!empty($Schedule_details) && isset($Schedule_details[0])) ? $Schedule_details[0] : null;

$base = !empty($enrollment->expiry_date) ? $enrollment->expiry_date : date('Y-m-d');

$pay_for_month = date('F Y', strtotime($base)); 

if (!$class) {
    echo "<h1>Error: Class data not found.</h1>";
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($class->class_name); ?> - Details</title>
    <link href="<?php echo ROOT ?>/assets/css/class_viewstyle.css" rel="stylesheet" />
    <link href="<?php echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="<?php echo ROOT ?>/assets/css/component/footer-styles.css" rel="stylesheet" />
</head>
<body>
    
    <?php include __DIR__ . '/Component/nav.view.php'; ?>

    <header class="course-banner" style="background-image: url('<?php echo ROOT ?>/assets/images/edu.png');">
        <div class="banner-overlay">
            <div class="banner-content">
                <div class="class-type-indicator">
                   <?= isset($class_type) ? htmlspecialchars($class_type) : 'Class' ?>
                </div>
                <h1>Welcome to the <?php echo htmlspecialchars($class->class_name); ?> Class!</h1>
                <p class="welcome-message"><?php echo htmlspecialchars($class->welcome_message); ?></p>
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
                <div class="video-container">
                    <?php
                    if (!empty($class->trailer_path)) {
                        // SERVER PATH (for file_exists check)
                        $videoPath = $_SERVER['DOCUMENT_ROOT'] . '/EduLink/Public/public/' . $class->trailer_path;
                        // BROWSER URL (for src)
                        $videoUrl = ROOT . '/public/' . $class->trailer_path;

                        if (file_exists($videoPath)) :
                    ?>
                            <video width="100%" controls>
                                <source src="<?= htmlspecialchars($videoUrl) ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                    <?php
                        else:
                            echo "<div class='video-placeholder'>Video file not found on server</div>";
                        endif;
                    } else {
                        echo "<div class='video-placeholder'>No video available</div>";
                    }
                    ?>
                </div>
            </section>

            <section class="course-section">
                <h2>Class Schedule</h2>
                <div class="schedule-list">
                    <?php if ($schedule): ?>
                        <div class="schedule-item">
                            <span class="day"><?php echo htmlspecialchars($schedule->day_of_week); ?></span>
                            <span class="time"><?php echo htmlspecialchars($schedule->start_time . " - " . $schedule->end_time); ?></span>
                        </div>
                    <?php else: ?>
                        <p>Schedule to be announced.</p>
                    <?php endif; ?>
                </div>

                <h2>Who is this course for?</h2>
                <ul class="intended-learners">
                    <?php if (!empty($Objective_details) && is_array($Objective_details)): ?>
                        <?php foreach ($Objective_details as $obj): ?>
                            <li><i class="fa-solid fa-check"></i> <?php echo htmlspecialchars($obj->objective_text); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No specific requirements listed.</li>
                    <?php endif; ?>
                </ul>
            </section>

            <section class="course-section ratings-section">
                <h2>Rate this Class</h2>
                <p class="rate-description">Tell others what you think</p>
                
                <div class="stars-interactive" id="user-rating" data-class-id="<?= $class->class_id ?>">
                    <span class="star" data-rating="1">★</span>
                    <span class="star" data-rating="2">★</span>
                    <span class="star" data-rating="3">★</span>
                    <span class="star" data-rating="4">★</span>
                    <span class="star" data-rating="5">★</span>
                </div>

                <a href="#" class="write-review-link">Write a review</a>
                
                <input type="checkbox" id="toggle-check" hidden>
                <label for="toggle-check" class="section-header">
                    <h2>Ratings and reviews</h2>
                    <span class="arrow">></span>
                </label>
                
                <div id="ratings-content">
                    <p class="info-text">
                        Ratings and reviews are verified.
                    </p>
                    
                    <div class="rating-summary">
                        <div class="rating-score">
                            <div class="score"><?= isset($average_rating) ? $average_rating : 0 ?></div>
                            <div class="stars">
                                <?php
                                $avg = isset($average_rating) ? $average_rating : 0;
                                $fullStars = floor($avg);
                                $halfStar = ($avg - $fullStars >= 0.5) ? 1 : 0;
                                $emptyStars = 5 - $fullStars - $halfStar;

                                for ($i = 0; $i < $fullStars; $i++) echo '<span class="star filled">★</span>';
                                if ($halfStar) echo '<span class="star half">★</span>';
                                for ($i = 0; $i < $emptyStars; $i++) echo '<span class="star">★</span>';
                                ?>
                            </div>
                            <div class="review-count"><?= isset($total_ratings) ? number_format($total_ratings) : 0 ?></div>
                        </div>

                        <div class="rating-breakdown">
                            <?php for ($i = 5; $i >= 1; $i--): 
                                $pct = isset($rating_percentages[$i]) ? $rating_percentages[$i] : 0;
                            ?>
                                <div class="bar-row">
                                    <span class="bar-label"><?= $i ?></span>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: <?= $pct ?>%;"></div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    
                    <div class="reviews-container">
                        <?php if (!empty($reviews)): ?>
                            <?php foreach ($reviews as $r): ?>
                                <div class="review-card">
                                    <div class="review-header">
                                        <div class="user-info">
                                            <div class="avatar"><?= strtoupper($r->username[0]) ?></div>
                                            <span class="username"><?= htmlspecialchars($r->username) ?></span>
                                        </div>
                                    </div>
                                    <div class="review-meta">
                                        <div class="stars">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <span class="star <?= $i <= $r->rating ? 'filled' : '' ?>">★</span>
                                            <?php endfor; ?>
                                        </div>
                                        <span class="review-date">
                                            <?= date("m/d/Y", strtotime($r->created_at)) ?>
                                        </span>
                                    </div>
                                    <p class="review-text">
                                        <?= nl2br(htmlspecialchars($r->review_text)) ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No reviews yet. Be the first!</p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>

        <aside class="class-sidebar">
            <div class="sidebar-card">
                <div class="teacher-info">
                    <div class="teacher-image">
                        <?php 
                            $photoPath = ($teacher && !empty($teacher->profile_photo_path)) 
                                ? $teacher->profile_photo_path 
                                : ROOT . '/assets/images/default-user.png';
                        ?>
                        <img src="<?= $photoPath ?>" alt="Teacher Profile Photo">
                    </div>

                    <p class="teacher-name">
                        <?php echo $teacher ? htmlspecialchars($teacher->first_name . " " . $teacher->last_name) : 'Instructor'; ?> 
                        <span class="verified">✔ Verified</span>
                    </p>
                </div>
                <hr>

                <ul class="class-info-list">
                    <li><strong>Class Name:</strong> <span><?php echo htmlspecialchars($class->class_name); ?></span></li>
                    <li><strong>Subject:</strong> <span><?php echo htmlspecialchars($class->subject_name); ?></span></li>
                    <li><strong>Grade/Level:</strong> <span><?php echo htmlspecialchars($class->grade_level_name); ?></span></li>
                    <li><strong>Language:</strong> <span><?php echo htmlspecialchars($class->language_name); ?></span></li>
                </ul>
                <hr>

                <p class="price">Rs. <?php echo htmlspecialchars($class->monthly_fee); ?></p>
                
                <div class="payment-actions">
                    <?php if (isset($is_institute_class) && $is_institute_class && isset($is_registered_to_institute) && !$is_registered_to_institute): ?> 
                        <button class="btn pay" id="registerInstituteBtn">Register to Institute</button>
                    <?php else: ?>
                        <?php if (isset($is_trial_active) && $is_trial_active): ?>
                            <button class="btn pay" disabled>Free Trial Active</button>
                        <?php elseif(isset($is_institute_class) && $is_institute_class && $enrollment->status == 'completed'): ?>
                            <button class="btn pay" >Apply Marking Panel</button>
                        <?php else: ?>
                            <button class="btn pay" id="payNowBtn">Pay Now</button>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <p class="free-access">Free full access for 2 weeks - No payment Needed</p>
                <button class="btn free-card" id="apply-free-card-btn">Apply for Free card</button>
                <a href="#" class="share-link"><i class="fa-solid fa-share-nodes"></i> Share</a>
            </div>
        </aside>

        <div id="free-card-popup" class="popup-overlay" hidden>
            <div class="popup-content">
                <h3>Apply for a Free Access Card</h3>
                <p>To apply, please upload a document for verification.</p>
                <form id="free-card-form" enctype="multipart/form-data" method="POST" action="<?= ROOT ?>/classpage/applyFreeCard/">
                    <input type="hidden" name="class_id" value="<?= $class->class_id ?>" />
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

        <div id="reviewModal" class="review-modal-overlay">
            <div class="review-modal-box">
                <button class="review-modal-close" id="closeReviewModal">&times;</button>
                <form action="<?= ROOT ?>/ClassPage/submit_review" method="post">
                    <input type="hidden" name="class_id" value="<?= $class->class_id ?>" />
                    
                    <input type="hidden" name="rating" id="modalRatingInput" value="0" required />

                    <div class="review-modal-body">
                        <h3>Rate and Review</h3>
                        
                        <div class="stars-interactive modal-stars" style="margin-bottom: 15px; font-size: 24px;">
                            <span class="star" data-rating="1">★</span>
                            <span class="star" data-rating="2">★</span>
                            <span class="star" data-rating="3">★</span>
                            <span class="star" data-rating="4">★</span>
                            <span class="star" data-rating="5">★</span>
                        </div>

                        <textarea id="reviewTextarea" class="review-textarea" name="review_text" placeholder="Write your review here..." rows="6" required></textarea>
                        <button class="review-submit-btn" type="submit">Submit Review</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="institute-popup" class="popup-overlay" style="display: none;">
            <div class="popup-content">
                <h3>Register to Institute</h3>
                <p>You must register to this institute before enrolling in the class.</p>
                <form method="post" action="<?= ROOT ?>/Institute/register">
                    <input type="hidden" name="institute_id" value="<?= isset($class->institute_id) ? $class->institute_id : '' ?>">
                    <button type="submit" class="btn submit">Register</button>
                    <button type="button" class="btn cancel" id="closeInstitutePopup">Cancel</button>
                </form>
            </div>
        </div>

        <div id="paymentModal" class="modal-overlay">
            <div class="modal-content">
                <h2>Choose Payment Option</h2>
                    <p>You are paying for: <strong><?= $pay_for_month ?></strong></p>
                    <p>Amount Due: <strong>Rs. <?= number_format($class->monthly_fee, 2) ?></strong></p>
                <button class="btn pay payhere-payment" 
                data-class-id="<?= $class->class_id ?>"
                <?= ($showFreeTrial || ($enrollment->status ?? '') === 'trial') ? 'disabled' : '' ?>>💳 Credit / Debit Card</button>
                <button id="bankBtn" <?= ($showFreeTrial || ($enrollment->status ?? '') === 'trial') ? 'disabled' : '' ?>>🏦 Bank Transfer</button>
                <?php if (isset($showFreeTrial) && $showFreeTrial): ?>
                    <hr>
                    <p><strong>🎁 2 Weeks Free Trial</strong></p>
                    <p>After 2 weeks, access will be cancelled.</p>
                    <form method="POST" action="<?= ROOT ?>/ClassPage/startTrial/<?= $class->class_id ?>">
                        <button type="submit" class="trial-btn">Start Free Trial</button>
                    </form>
                <?php endif; ?>
                <button type="button" class="btn cancel" id="closePaymentModal" style="margin-top:10px;">Cancel</button>
            </div>
        </div>
        <div id="bankModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span id="closeBankModal" class="close-btn">&times;</span>
                <h3>Bank Transfer Details</h3>
            <div class="payment-alert">
                <p>You are paying for: <strong><?= $pay_for_month ?></strong></p>
                <p>Amount Due: <strong>Rs. <?= number_format($class->monthly_fee, 2) ?></strong></p>
             </div>
                    <li><strong>Bank:</strong> <?php echo htmlspecialchars($class->bank_name); ?></li>
                    <li><strong>Account Name:</strong><?php echo htmlspecialchars($class->account_name); ?> </li>
                    <li><strong>Account Number:</strong> <?php echo htmlspecialchars($class->account_number); ?></li>
                    <li><strong>Branch:</strong> <?php echo htmlspecialchars($class->branch_name); ?></li>
                </ul>
                <hr>
                <form action="<?= ROOT ?>/payment/bank_submit" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="class_id" value="<?= $class->class_id ?>">
                    <label>Upload Payment Slip (Image/PDF):</label>
                    <input type="file" name="slip" required>
                    <div class="popup-actions">
                        <button type="submit" class="btn-submit-verification">Submit for Verification</button>
                        <button type="button" class="btn-cancel" onclick="closeBankModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    </main>

    <?php include __DIR__ . '/Component/footer.view.php'; ?>

    <script>const ROOT = "<?php echo ROOT; ?>";</script>
    <script src="<?php echo ROOT ?>/assets/js/class.js"></script>
    <script src="<?php echo ROOT ?>/assets/js/rating.js"></script>
</body>
</html>