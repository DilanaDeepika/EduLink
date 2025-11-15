<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduLink-VLE-Student-Participation</title>
  <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/participation_vle.css">
  <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/component/tabs_vle.css">
  <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/component/header_vle.css">
</head>
<body>
 <?php include 'Component/header_vle.php'; ?>
 

  <!-- Main Container -->
  <main class="container">
        <?php include 'Component/tabs_vle.php'; ?>


    <!-- Participation Section -->
    <div class="participation">
      <h3 class="month-title">
        <!-- Calendar Icon -->
        <svg class="calendar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 
          1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 
          16H5V9h14v11z"/>
        </svg>
        August
      </h3>

      <!-- Independent Participation Rows -->
       <div class="participation-head">
        <div>Date</div>
        <div>Topic</div>
        <div>Participation </div>
        </div>

      <div class="participation-row">
        <div>2025/08/22</div>
        <div>Number System</div>
        <div>
          <label>
            <input type="checkbox">
            <span class="custom-checkbox"></span>
          </label>
        </div>
      </div>

      <div class="participation-row">
        <div>2025/08/23</div>
        <div>Logic Gates</div>
        <div>
          <label>
            <input type="checkbox">
            <span class="custom-checkbox"></span>
          </label>
        </div>
      </div>

      <div class="participation-row">
        <div>2025/08/24</div>
        <div>Networking</div>
        <div>
          <label>
            <input type="checkbox">
            <span class="custom-checkbox"></span>
          </label>
        </div>
      </div>

      <div class="participation-row">
        <div>2025/08/25</div>
        <div>Operating System</div>
        <div>
          <label>
            <input type="checkbox">
            <span class="custom-checkbox"></span>
          </label>
        </div>
      </div>

    </div>
  </main>
<script src="../../Public/assets/js/component/tabs_vle.js"></script>
</body>
</html>