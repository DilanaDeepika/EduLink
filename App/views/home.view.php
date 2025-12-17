<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Educational Platform - A/L Classes</title>
    <link href="<?php  echo ROOT ?>/assets/css/style.css" rel="stylesheet" />
    <link href="<?php  echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
    <link href="<?php  echo ROOT ?>/assets/css/component/card.css" rel="stylesheet" />   
        <link
      href="<?php  echo ROOT ?>/assets/css/component/footer-styles.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
  </head>
  <body>
    <seciton>
        <?php include __DIR__.'/Component/nav.view.php'; ?>
    </section>
    <section class="home-section home-hero-container">
      <div class="hero-ad-slider" id="heroAdSlider">
        <?php foreach ($approved_ads as $ad): ?>
            <div class="hero-ad-slide">
                <img src="<?= ROOT ?>/uploads/ads/<?= basename($ad->poster_path) ?>" alt="Ad">
            </div>
        <?php endforeach; ?>
    </div>
    </section>
    <section class="home-section home-famous-class-container">
      <h3>Level Up Your Learning with Expert-Led Classes</h3>
      <p>
        Join live or online classes and build skills that matter — from school
        subjects to exam prep and beyond.
      </p>

      
      <div class="courses-container">
        <?php if (!empty($data['priority_classes'])): ?>
          <?php foreach ($data['priority_classes'] as $item): ?>
            <a href="<?php echo ROOT ?>/ClassPage?class_id=<?php echo $item->class_id; ?>" class="card-link-wrapper">
              <?php $class = $item; include __DIR__.'/Component/card.view.php'; ?>
            </a>
          <?php endforeach; ?>

        <?php else: ?>
          <p>No featured classes available right now.</p>
        <?php endif; ?>
      </div>
        
    </section>

    <section class="home-section home-catergary-container" id="home-section home-catergary-container">
      <h3>Your A/L Journey Starts Here</h3>
      <p>
        Browse A/L classes by subject and stream. Get ready with trusted Sri
        Lankan educators.
      </p>
      <div class="home-subject-buttons" id="home-subject-buttons">
        <button class="home-subject-btn" data-subject="Physics">
          Physics
        </button>
        <button class="home-subject-btn" data-subject="Chemistry">
          Chemistry
        </button>
        <button class="home-subject-btn" data-subject="Biology">Biology</button>
        <button class="home-subject-btn" data-subject="CombinedMathematics">
          Combined Mathematics
        </button>
        <button class="home-subject-btn" data-subject="ICT">
          ICT
        </button>
        <button class="home-subject-btn" data-subject="Accounting">
          Accounting
        </button>
        <button class="home-subject-btn" data-subject="Economics">
          Economics
        </button>
        <button class="home-subject-btn" data-subject="BusinessStudies">
          Business Studies
        </button>
        <button class="home-subject-btn" data-subject="Media">
          Media
        </button>
        <button class="home-subject-btn" data-subject="PoliticalScience">
          Political Science
        </button>
        <button class="home-subject-btn" data-subject="GeneralEnglish">
          General English
        </button>
        <button class="home-subject-btn" data-subject="Logic">
          Logic
        </button>
        <button class="home-subject-btn" data-subject="Sinhala">
          Sinhala
        </button>
        <button class="home-subject-btn" data-subject="Agriculture">
          Agriculture
        </button>
      </div>
      <div class="home-subject-result" id="home-subject-result">
          <button class="home-scroll-btn-left" id="scrollLeft">
              <i class="fa fa-chevron-left"></i>          
          </button>
          <div class="cards-wrapper">
            <?php foreach($data['subject_classes']as $item): ?>
              <a href="<?php echo ROOT ?>/ClassPage?class_id=<?php echo $item->class_id; ?>" class="card-link-wrapper">
                <?php include __DIR__.'/Component/card.view.php'; ?>
              </a>
            <?php endforeach; ?>
          </div>
          <button class="home-scroll-btn-right" id="scrollRight">
              <i class="fa fa-chevron-right"></i>
          </button>
      </div>

    </section>

    <section class="home-section home-testimonials">
      <h3>See what others are achieving through learning</h3>
      <div class="home-comment-section">
        <div class="home-comment">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 280C96 213.7 149.7 160 216 160L224 160C241.7 160 256 174.3 256 192C256 209.7 241.7 224 224 224L216 224C185.1 224 160 249.1 160 280L160 288L224 288C259.3 288 288 316.7 288 352L288 416C288 451.3 259.3 480 224 480L160 480C124.7 480 96 451.3 96 416L96 280zM352 280C352 213.7 405.7 160 472 160L480 160C497.7 160 512 174.3 512 192C512 209.7 497.7 224 480 224L472 224C441.1 224 416 249.1 416 280L416 288L480 288C515.3 288 544 316.7 544 352L544 416C544 451.3 515.3 480 480 480L416 480C380.7 480 352 451.3 352 416L352 280z"/></svg>
          <p>
            "The Tuition Management System has made organizing classes and tracking student progress so much easier. It’s intuitive and saves us a lot of time!"
          </p>
          <img src="https://via.placeholder.com/80" alt="John Doe" />
          <h4>John Doe</h4>
        </div>
        <div class="home-comment">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 280C96 213.7 149.7 160 216 160L224 160C241.7 160 256 174.3 256 192C256 209.7 241.7 224 224 224L216 224C185.1 224 160 249.1 160 280L160 288L224 288C259.3 288 288 316.7 288 352L288 416C288 451.3 259.3 480 224 480L160 480C124.7 480 96 451.3 96 416L96 280zM352 280C352 213.7 405.7 160 472 160L480 160C497.7 160 512 174.3 512 192C512 209.7 497.7 224 480 224L472 224C441.1 224 416 249.1 416 280L416 288L480 288C515.3 288 544 316.7 544 352L544 416C544 451.3 515.3 480 480 480L416 480C380.7 480 352 451.3 352 416L352 280z"/></svg>
          <p>
            "The Tuition Management System has made organizing classes and tracking student progress so much easier. It’s intuitive and saves us a lot of time!"
          </p>
          <img src="https://via.placeholder.com/80" alt="John Doe" />
          <h4>John Doe</h4>
        </div>
        <div class="home-comment">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 280C96 213.7 149.7 160 216 160L224 160C241.7 160 256 174.3 256 192C256 209.7 241.7 224 224 224L216 224C185.1 224 160 249.1 160 280L160 288L224 288C259.3 288 288 316.7 288 352L288 416C288 451.3 259.3 480 224 480L160 480C124.7 480 96 451.3 96 416L96 280zM352 280C352 213.7 405.7 160 472 160L480 160C497.7 160 512 174.3 512 192C512 209.7 497.7 224 480 224L472 224C441.1 224 416 249.1 416 280L416 288L480 288C515.3 288 544 316.7 544 352L544 416C544 451.3 515.3 480 480 480L416 480C380.7 480 352 451.3 352 416L352 280z"/></svg>
          <p>
            "The Tuition Management System has made organizing classes and tracking student progress so much easier. It’s intuitive and saves us a lot of time!"
          </p>
          <img src="https://via.placeholder.com/80" alt="John Doe" />
          <h4>John Doe</h4>
        </div>
      </div>
      
    </section>

    <section class="home-section home-cta-section">
      <p>
        Browse A/L classes by subject and stream. Get ready with trusted Sri
        Lankan educators.
      </p>
        <div class="home-institute">
        <?php foreach ($priorityInstitutes as $institute): ?>
        <div class="ellipse">
            <?php if (!empty($institute->logo_path)): ?>
                <img src="<?= ROOT . '/' . $institute->logo_path ?>" alt="<?= htmlspecialchars($institute->name) ?>" />
            <?php else: ?>
                <img src="<?= ROOT ?>/assets/images/default_logo.png" alt="No logo" />
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        </div>

    </section>
    <?php include __DIR__.'/Component/footer.view.php'; ?>
    <script src="<?php  echo ROOT ?>/assets/js/home.view.js"></script>
  </body>
</html>