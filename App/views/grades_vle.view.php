<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduLink-VLE-Student-Grades</title>
 <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/grades_vle.css">
  <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/component/tabs_vle.css">
  <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/component/header_vle.css">
</head>

<body>
<?php include 'Component/header_vle.php'; ?>

  <!-- Main Container -->
  <main class="container">
    <!-- Tabs -->
     <?php include 'Component/tabs_vle.php'; ?>
<div class="stats">
  <div class="stat-box">
    <div class="stat-content">
      <div>
        <p>Overall Results</p>
        <h4>51</h4>
      </div>
      <!-- Medal SVG Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" stroke="#0d2c61" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="12" cy="8" r="7"></circle>
        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
      </svg>
    </div>
  </div>

  <div class="stat-box">
    <div class="stat-content">
      <div>
        <p>Exams Completed</p>
        <h4>2</h4>
      </div>
      <!-- File SVG Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" stroke="#0d2c61" stroke-width="2" viewBox="0 0 24 24">
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
            <th>Grade</th>
            <th>Percentage</th>
            <th>Marks</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Number System</td>
            <td>A</td>
            <td>78%</td>
            <td>78</td>
            <td><span class="status complete">Completed</span></td>
          </tr>
          <tr>
            <td>Logic Gates</td>
            <td>B</td>
            <td>66%</td>
            <td>66</td>
            <td><span class="status complete">Completed</span></td>
          </tr>
          <tr>
            <td>Networking</td>
            <td></td>
            <td></td>
            <td></td>
            <td><span class="status not">No</span></td>
          </tr>
          <tr>
            <td>Operating System</td>
            <td></td>
            <td></td>
            <td></td>
            <td><span class="status pending">Pending</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <script src="../../Public/assets/js/component/tabs_vle.js"></script>

</body>
</html>


