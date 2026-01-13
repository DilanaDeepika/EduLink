<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
    <link href="<?php  echo ROOT ?>/assets/css/component/card.css" rel="stylesheet" />  
    <link href="<?php  echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
    <link href="<?php  echo ROOT ?>/assets/css/class_list.css" rel="stylesheet" /> 
    <link href="<?php  echo ROOT ?>/assets/css/component/footer-styles.css" rel="stylesheet"/>
</head>
<body>
    <seciton>
        <?php include __DIR__.'/Component/nav.view.php'; ?>
    </section>
  
    <div class="filter-dropdown">
    <button id="filterButton" class="dropdown-btn">Newest ▼</button>
    <ul id="dropdownMenu" class="dropdown-menu">
        <li data-sort="newest">Newest</li>
        <li data-sort="highest-rated">Highest Rated</li>
        <li data-sort="most-reviewed">Most Reviewed</li>
        <li data-sort="most-relevant">Most Relevant</li>
    </ul>
    </div>
    <div class = card-container>
  <?php foreach ($data['items'] as $item): ?>
      <?php include __DIR__ . '/Component/Card.view.php'; ?>
  <?php endforeach; ?>
    </div>
    <?php include __DIR__.'/Component/footer.view.php'; ?>
</body>
<script src="<?php  echo ROOT ?>/assets/js/class_list.js"></script>
</html>