<!DOCTYPE html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Class Detail</title>
  <link href="<?php  echo ROOT ?>/assets/css/class_viewstyle.css" rel="stylesheet" />
</head>   
<body>


<!-- Banner Section -->
  <div class="class-banner"> 
    <div class="class-banner-inside"></div>
  </div>

  <!-- Main Content -->
  <main class="class-content">

    <!-- Course Overview Section -->
    <section class="class-overview">
      <div class="details">
        <div class="features"><h4>This course includes:</h4> </div>
      </div>

      
   <!-- Side Information: Teacher & Price -->
      <aside class="class-sidebar">
      <div class="teacher-info">
  <div class="teacher-top">
    <div class="teacher-image"></div>
    <button class="verified">✔ Verified</button>
  </div>
  <p class="teacher-name">S M Dilana Deepika</p>
</div>

      <hr>
        <p class="price">Rs. 1000.00</p>

      <div class="payment-actions">
       <button class="btn pay">Pay Now!</button>
       <button class="btn wishlist">♡</button>
     </div>

      <p class="free-access">Free full access for 2 weeks - No payment Needed</p>

      <button class="btn free-card">Apply for Free card</button>

      <p class="share-link"> Share</p>
    </aside>

  </section>

<!-- Course Content by Grade -->
<section class="course-content">
  <h3>Course Content:</h3>

  <!-- Grade 12 -->
  <div class="class-syllabus">
    <h4>Grade 12</h4>
    <div class="syllabus-list">
<?php  foreach (range(1, 5) as $i): ?>
      <div class="syllabus-item">
        <div class="syllabus-header">
          <span class="arrow">▶</span>
          <p>Comparatively analyses the alternative ways of solving the basic economic problems in an economic system.</p>
          <span class="date">Jan - Feb</span>
        </div>
        <div class="syllabus-subtopics">
          <ul>
            <li>Scarcity and choice</li>
            <li>Opportunity cost</li>
            <li>Economic systems</li>
          </ul>
        </div>
      </div>
<?php endforeach; ?>
    </div>
  </div>

  <!-- Grade 13 -->
  <div class="class-syllabus">
    <h4>Grade 13</h4>
    <div class="syllabus-list">
<?php  foreach (range(1, 5) as $i): ?>
      <div class="syllabus-item">
        <div class="syllabus-header">
          <span class="arrow">▶</span>
          <p>Investigates the behaviour of money and price levels that affects economic activities and banking system.</p>
          <span class="date">Jan - Feb</span>
        </div>
        <div class="syllabus-subtopics">
          <ul>
            <li>Functions of money</li>
            <li>Monetary policy</li>
            <li>Inflation and deflation</li>
          </ul>
        </div>
      </div>
<?php endforeach; ?>
    </div>
  </div>
</section>




  </main>
 <script src="<?php  echo ROOT ?>/assets/js/class.js" ></script>
</body>
</html>