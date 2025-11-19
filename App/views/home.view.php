<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Educational Platform - A/L Classes</title>
    <link href="<?php  echo ROOT ?>/assets/css/style.css" rel="stylesheet" />
    <link href="<?php  echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
    <link href="<?php  echo ROOT ?>/assets/css/component/card.css" rel="stylesheet" />   
    <link href="<?php  echo ROOT ?>/assets/css/component/footer-styles.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
  </head>
  <body>
    <seciton>
        <?php include __DIR__.'/Component/nav.view.php'; ?>
    </section>
    <section class="home-section home-hero-container">
      <img src="<?php  echo ROOT ?>/assets/images/hero_3.jpg">
    </section>
    <section class="home-section home-famous-class-container">
      <h3>Level Up Your Learning with Expert-Led Classes</h3>
      <p>
        Join live or online classes and build skills that matter — from school
        subjects to exam prep and beyond.
      </p>

      
      <div class="courses-container">
        <?php  foreach (range(1, 5) as $i): ?>
        <a href="<?php echo ROOT ?>/ClassPage?class_id=<?php echo 1 ?>"class="card-link-wrapper">
        <?php include __DIR__.'/Component/card.view.php'; ?>
        </a>
        <?php endforeach; ?>
      </div>
        
    </section>

    <section class="home-section home-catergary-container">
      <h3>Your A/L Journey Starts Here</h3>
      <p>
        Browse A/L classes by subject and stream. Get ready with trusted Sri
        Lankan educators.
      </p>
      <div class="home-subject-buttons">
        <button class="home-subject-btn" data-subject="Physics">Physics</button>
        <button class="home-subject-btn" data-subject="Chemistry">
          Chemistry
        </button>
        <button class="home-subject-btn" data-subject="Biology">Biology</button>
        <button class="home-subject-btn" data-subject="Mathematics">
          Mathematics
        </button>
        <button class="home-subject-btn" data-subject="ICT">ICT</button>
        <button class="home-subject-btn" data-subject="Accounting">
          Accounting
        </button>
        <button class="home-subject-btn" data-subject="Economics">
          Economics
        </button>
        <button class="home-subject-btn" data-subject="Business_Studies">
          Business Studies
        </button>
        <button class="home-subject-btn" data-subject="Media">Media</button>
        <button class="home-subject-btn" data-subject="Political_Science">
          Political Science
        </button>
      </div>
      <div class="home-subject-result">
          <button class="home-scroll-btn-left" id="scrollLeft">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M201.4 297.4C188.9 309.9 188.9 330.2 201.4 342.7L361.4 502.7C373.9 515.2 394.2 515.2 406.7 502.7C419.2 490.2 419.2 469.9 406.7 457.4L269.3 320L406.6 182.6C419.1 170.1 419.1 149.8 406.6 137.3C394.1 124.8 373.8 124.8 361.3 137.3L201.3 297.3z"/></svg>
          </button>
          <?php  foreach (range(1, 4) as $i): ?>
          <?php include __DIR__.'/Component/card.view.php'; ?>
          <?php endforeach; ?>
          <button class="home-scroll-btn-left" id="scrollLeft">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M439.1 297.4C451.6 309.9 451.6 330.2 439.1 342.7L279.1 502.7C266.6 515.2 246.3 515.2 233.8 502.7C221.3 490.2 221.3 469.9 233.8 457.4L371.2 320L233.9 182.6C221.4 170.1 221.4 149.8 233.9 137.3C246.4 124.8 266.7 124.8 279.2 137.3L439.2 297.3z"/></svg>
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
        <div class="home-institute ">
        <?php  foreach (range(1, 5) as $i): ?>
        <div class="ellipse"><img  src="<?php  echo ROOT ?>/assets/images/insitute_logo.png" /> </div>
        <?php endforeach; ?>
      </div>

    </section>
    <?php include __DIR__.'/Component/footer.view.php'; ?>
  </body>
</html>
