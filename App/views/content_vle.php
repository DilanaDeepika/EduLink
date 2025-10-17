<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduLink-VLE-Student-Content</title>
 <link rel="stylesheet" href="../../Public/assets/css/content_vle.css">
  <link rel="stylesheet" href="../../Public/assets/css/component/tabs_vle.css">
  <link rel="stylesheet" href="../../Public/assets/css/component/header_vle.css">
</head>

<body>
<?php include 'Component/header_vle.php'; ?>

  <!-- Main Container -->
  <main class="container">
    <!-- Tabs -->
     <?php include 'Component/tabs_vle.php'; ?>

    <!-- Table -->
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
            <td>2024/08/23</td>
            <td>Number System</td>
            <td>3.30PM - 4.30PM</td>
            <td>S104</td>
            <td><a href="#">Video Upload</a></td>
          </tr>
          <tr>
            <td>2024/08/29</td>
            <td>Logic Gates</td>
            <td>2.00PM - 4.00PM</td>
            <td>K106</td>
            <td><a href="#">Link</a></td>
          </tr>
          <tr>
            <td>2024/09/14</td>
            <td>Networking</td>
            <td>2.00PM - 4.00PM</td>
            <td>S104</td>
            <td>Upcoming</td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

<script src="../../Public/assets/js/component/tabs_vle.js"></script>
</body>
</html>
