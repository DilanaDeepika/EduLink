<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduLink - Student VLE</title>

  <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/vle_student.css">
  
  <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/component/header_vle.css">
  
  <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/component/calander.css"/>

  <link href="<?php  echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
  
  <link href="<?php  echo ROOT ?>/assets/css/component/footer-styles.css" rel="stylesheet"/>

</head>

<body>
    <header>
        <?php include __DIR__.'/Component/nav.view.php'; ?>
    </header>

  <main class="container">
    <div class="tabs">
      <a href="#" class="tab active" data-target="content">Content</a>
      <a href="#" class="tab" data-target="notes">Notes</a>
      <a href="#" class="tab" data-target="participation">Participation</a>
      <a href="#" class="tab" data-target="grades">Grading & Analysis</a>
      <span class="tab-indicator"></span>
    </div>

<div id="content" class="panel active">
  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Date</th>
          <th>Topic</th>
          <th>Time</th>
          <th>Place</th>
          <th>Link</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>2025/10/28</td>
          <td>Final Project Review</td>
          <td>2:00PM - 4:00PM</td>
          <td>Online</td>
          <td>Upcoming</td>
        </tr>
        <tr>
          <td>2025/09/14</td>
          <td>Networking</td>
          <td>2:00PM - 4:00PM</td>
          <td>S104</td>
          <td><a href="#">Link</a></td>
        </tr>
        <tr>
          <td>2025/08/29</td>
          <td>Logic Gates</td>
          <td>2:00PM - 4:00PM</td>
          <td>K106</td>
          <td><a href="#">Link</a></td>
        </tr>
        <tr>
          <td>2025/08/23</td>
          <td>Number System</td>
          <td>3:30PM - 4:30PM</td>
          <td>S104</td>
          <td><a href="#">Video Upload</a></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

 <div id="notes" class="panel">
  <div class="content-section">
    <button class="section-header-button">
      <span class="arrow">▶</span>
      <span class="section-title">Notes</span>
    </button>
    <div class="section-body hidden">
      <p>No notes have been uploaded yet.</p>
    </div>
  </div>

  <div class="content-section">
    <button class="section-header-button">
      <span class="arrow">▶</span>
      <span class="section-title">Past Paper</span>
    </button>
    <div class="section-body hidden">
      <div class="file-item">
        <div class="file-icon">📄</div>
        <span class="file-name">2022 AL ICT Paper</span>
      </div>
       <div class="file-item">
        <div class="file-icon">📄</div>
        <span class="file-name">2021 AL ICT Paper</span>
      </div>
    </div>
  </div>

  <div class="content-section">
    <button class="section-header-button">
      <span class="arrow">▶</span>
      <span class="section-title">Model Paper</span>
    </button>
    <div class="section-body hidden">
       <p>No model papers have been uploaded yet.</p>
    </div>
  </div>

  <div class="content-section">
    <button class="section-header-button">
      <span class="arrow">▶</span>
      <span class="section-title">External Link</span>
    </button>
    <div class="section-body hidden">
      <p>No external links have been added yet.</p>
    </div>
  </div>

  <div class="content-section">
    <button class="section-header-button">
      <span class="arrow">▶</span>
      <span class="section-title">Quiz</span>
    </button>
    <div class="section-body hidden">
       <p>No quizzes are available at the moment.</p>
    </div>
  </div>

  <div class="content-section">
    <button class="section-header-button">
      <span class="arrow">▶</span>
      <span class="section-title">Assignment</span>
    </button>
    <div class="section-body hidden">
       <p>No assignments have been posted yet.</p>
    </div>
  </div>
</div>
    <div id="participation" class="panel">
                  <div class="calendar-placeholder">
            <p>Your calendar will be displayed here.</p>
            <?php include __DIR__.'/Component/calander.php'; ?>
          </div>
        </div>

<div id="grades" class="panel">
  <div class="stats-container">
    <div class="stat-box">
      <div class="stat-text">
        <p>Overall Results</p>
        <h3>51</h3>
      </div>
      <div class="stat-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="8" r="7"></circle>
          <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
        </svg>
      </div>
    </div>
    <div class="stat-box">
      <div class="stat-text">
        <p>Exams Completed</p>
        <h3>2</h3>
      </div>
      <div class="stat-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
        </svg>
      </div>
    </div>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Grade Item</th>
          <th>Calculated weight</th>
          <th>Percentage</th>
          <th>Marks</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Number System</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Logic Gates</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Networking</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Operating System</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
  </main>
  <?php include __DIR__.'/Component/footer.view.php'; ?>
              <script src="<?php  echo ROOT ?>/assets/js/calander.js"></script>
  <script src="<?php echo ROOT ?>/assets/js/studentVle.js"></script>
</body>
</html>