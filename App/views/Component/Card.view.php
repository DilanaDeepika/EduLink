<div class="course-card">
  <div class="course-thumbnail">
    <img src="<?= ROOT . $item->thumbnail_path ?>" alt="Class Thumbnail" />
    <!-- <span class="course-bestseller-tag">Bestseller</span> -->
    <div class="course-type">
      <?php if (empty($item->institute_id)) : ?>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28" height="28" fill="black">
            <path d="M14 2L2 8v2h2v12h6V14h8v8h6V10h2V8L14 2zM6 24h16v2H6v-2z"/>
          </svg>
      <?php else : ?>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28" height="28" fill="currentColor">
              <path d="M14 4.5 L22 8 L14 11.5 L6 8 L14 4.5Z"/>
              <path d="M13.5 11 L13.5 14 L14.5 14 L14.5 11 Z"/>
              <circle cx="14" cy="11" r="3"/>
              <path d="M7 23V20C7 17.2386 9.23858 15 12 15H16C18.7614 15 21 17.2386 21 20V23H7Z"/>
          </svg>
      <?php endif; ?>


    </div>
  </div>

  <div class="course-content">
    <h3 class="course-title"><?= htmlspecialchars($item->class_name) ?></h3>
    <p class="course-instructor">Teacher: <?= htmlspecialchars($item->teacher_name) ?></p>
    <p class="course-institute">
      <?= empty($item->institute_id) ? 'Home Class' : 'Institute ID: ' . $item->institute_id ?>
    </p>

    <div class="course-rating">
      <span class="course-rating-value">4.6</span>
      <div class="course-stars">★★★★★</div>
      <span class="course-review-count">(501,970)</span>
    </div>

    <div class="course-price">
      <span class="course-original-price">Rs. <?= number_format($item->monthly_fee, 2) ?></span>
    </div>
  </div>
</div>
