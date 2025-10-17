<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../Public/assets/css/notes_vle.css">
  <link rel="stylesheet" href="../../Public/assets/css/component/tabs_vle.css">
  <link rel="stylesheet" href="../../Public/assets/css/component/header_vle.css">
</head>
<body>
 <?php include 'Component/header_vle.php'; ?>

  <main class="container">
    <!-- Tabs -->
     <?php include 'Component/tabs_vle.php'; ?>

<div class="notes-section">
  <!-- Papers Accordion -->
  <div class="accordion">
    <div class="accordion-header">
      <span class="arrow">&#9656;</span>
      <span class="title">Papers</span>
    </div>
    <div class="accordion-content">
      <div class="file-box">
        <span class="file-icon">📄</span>
        <a href="#">2022 AL ICT Paper</a>
      </div>
    </div>
  </div>

  <!-- Notes Accordion -->
  <div class="accordion">
    <div class="accordion-header">
      <span class="arrow">&#9656;</span>
      <span class="title">Notes</span>
    </div>
    <div class="accordion-content">
      <p>No notes uploaded yet.</p>
    </div>
  </div>
</div>

  </main>
  <!-- Tab indicator script -->
     <script src="../../Public/assets/js/component/tabs_vle.js"></script>
     <script src="../../Public/assets/js/notes_vle.js"></script>
 
</body>
</html>