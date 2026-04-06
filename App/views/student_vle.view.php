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

  <meta name="root" content="<?= ROOT ?>">


</head>

<body>
    <header>
        <?php include __DIR__.'/Component/nav.view.php'; ?>
    </header>

    <?php $schedules = $schedules ?? [];
    date_default_timezone_set('Asia/Colombo');
 ?>
    


  <main class="container">
    <div class="tabs">
  <a href="#" class="tab active" data-target="schedule">Schedule</a>
  <a href="#" class="tab" data-target="content">Content</a>
  <a href="#" class="tab" data-target="participation">Participation</a>
  <a href="#" class="tab" data-target="grades">Grades</a>
  <a href="#" class="tab" data-target="analysis">Analysis</a>
  <span class="tab-indicator"></span>
</div>


<div id="schedule" class="panel active">

  <div class="vle-panels">

    <!-- ================= Schedule Today ================= -->
    <div class="schedule-section">
      <h2>Schedule Today</h2>

      <table class="vle-table">
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
        <?php if (!empty($schedules)): ?>
          <?php foreach ($schedules as $row): ?>
            <tr>
              <td><?= htmlspecialchars($row->day_of_week) ?></td>
              <td>Schedule</td>
              <td><?= htmlspecialchars($row->start_time . ' - ' . $row->end_time) ?></td>
              <td><?= htmlspecialchars($row->place) ?></td>
              <td>
                <?php
                  $today = date('Y-m-d');
                  $start = strtotime($today . ' ' . $row->start_time);
                  $end   = strtotime($today . ' ' . $row->end_time);
                  $now   = time();

                  if (!empty($row->link)) {
                    if ($now < $start) {
                      echo "<span class='status soon'>Soon</span>";
                    } elseif ($now <= $end) {
                      echo "<a href='".htmlspecialchars($row->link)."' target='_blank' class='join-btn'>Join</a>";
                    } else {
                      echo "<span class='status expired'>Expired</span>";
                    }
                  } else {
                    echo "No Link";
                  }
                ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5">No schedules for today</td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- ================= History ================= -->
    <div class="schedule-section">
      <h2>History</h2>
      <h3>Past Classes</h3>

      <table class="vle-table">
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
<?php if (!empty($pastSchedules)): ?>
    <?php foreach ($pastSchedules as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row->day_of_week) ?></td>
            <td>Schedule</td>
            <td><?= htmlspecialchars($row->start_time . ' - ' . $row->end_time) ?></td>
            <td><?= htmlspecialchars($row->place) ?></td>
            <td>
                <?php if (!empty($row->link)): ?>
                    <a href="<?= htmlspecialchars($row->link) ?>" target="_blank" class="join-btn">View Link</a>
                <?php else: ?>
                    No Link
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="5">No history available</td>
    </tr>
<?php endif; ?>
</tbody>

      </table>
    </div>

  </div>
</div>



 <div id="content" class="panel">
 <?php
// Group contents by type for easier rendering
$groupedContents = [];
if(!empty($contents)) {
    foreach($contents as $content) {
        $groupedContents[$content->content_type][] = $content;
    }
}
?>

<!-- Notes Section -->
<div class="content-section">
    <button class="section-header-button">
      <span class="arrow">▶</span>
      <span class="section-title">Notes</span>
    </button>
    <div class="section-body hidden">
        <?php if(!empty($groupedContents['note'])): ?>
            <?php foreach($groupedContents['note'] as $note): ?>
                <div class="file-item">
                    <div class="file-icon">📄</div>
                    <span class="file-name"><?= htmlspecialchars($note->title) ?></span>
                    <?php if(!empty($note->content_path)): ?>
                        - <a href="<?= htmlspecialchars($note->content_path) ?>" target="_blank">View</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No notes have been uploaded yet.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Past Papers -->
<div class="content-section">
    <button class="section-header-button">
      <span class="arrow">▶</span>
      <span class="section-title">Past Paper</span>
    </button>
    <div class="section-body hidden">
        <?php if(!empty($groupedContents['past_paper'])): ?>
            <?php foreach($groupedContents['past_paper'] as $paper): ?>
                <div class="file-item">
                    <div class="file-icon">📄</div>
                    <span class="file-name"><?= htmlspecialchars($paper->title) ?></span>
                    <a href="<?= htmlspecialchars($paper->content_path) ?>" target="_blank">View</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No past papers have been uploaded yet.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Model Paper -->
<div class="content-section">
    <button class="section-header-button">
      <span class="arrow">▶</span>
      <span class="section-title">Model Paper</span>
    </button>
    <div class="section-body hidden">
        <?php if(!empty($groupedContents['model_paper'])): ?>
            <?php foreach($groupedContents['model_paper'] as $paper): ?>
                <div class="file-item">
                    <div class="file-icon">📄</div>
                    <span class="file-name"><?= htmlspecialchars($paper->title) ?></span>
                    <a href="<?= htmlspecialchars($paper->content_path) ?>" target="_blank">View</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No model papers have been uploaded yet.</p>
        <?php endif; ?>
    </div>
</div>

<!-- External Link -->
<div class="content-section">
    <button class="section-header-button">
      <span class="arrow">▶</span>
      <span class="section-title">External Link</span>
    </button>
    <div class="section-body hidden">
        <?php if(!empty($groupedContents['external_link'])): ?>
            <?php foreach($groupedContents['external_link'] as $link): ?>
                <div class="file-item">
                    <div class="file-icon">🔗</div>
                    <span class="file-name"><?= htmlspecialchars($link->title) ?></span>
                    <a href="<?= htmlspecialchars($link->content_path) ?>" target="_blank">Visit</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No external links have been added yet.</p>
        <?php endif; ?>
    </div>
</div>


<!-- ================= Quiz Section ================= -->
<div class="content-section">
  <button class="section-header-button">
    <span class="arrow">▶</span>
    <span class="section-title">Quiz</span>
  </button>

  <div class="section-body hidden">

    <?php if(!empty($quizzes)): ?>

      <div class="quiz-card-container">
        <?php foreach($quizzes as $quiz): ?>
          <div class="quiz-card">
            
            <!-- Quiz Title -->
            <h4><?= htmlspecialchars($quiz->title ?? 'Quiz') ?></h4>
            
            <!-- Quiz Info with Icons -->
            <div class="quiz-info">
              <div class="quiz-info-item">
                <span class="icon">📝</span>
                <span><?= count($quizData[$quiz->quiz_id] ?? []) ?> Questions</span>
              </div>
              
              <div class="quiz-info-item">
                <span class="icon">⏱️</span>
                <span><?= htmlspecialchars($quiz->time_limit_minutes ?? 'N/A') ?> minutes</span>
              </div>
            </div>
            
            <!-- Start Quiz Button -->
            <button type="button"
                    class="start-quiz-btn"
                    data-quiz-id="<?= $quiz->quiz_id ?>"
                    data-duration="<?= htmlspecialchars($quiz->time_limit_minutes ?? 0) ?>">
              Start Quiz
            </button>
            
          </div>
        <?php endforeach; ?>
      </div>
      
    <?php else: ?>
      <p>No quizzes available.</p>
    <?php endif; ?>

  </div>
</div>


<!-- Quiz Modal -->
<div class="quiz-modal hidden" id="quizModal">
  <div class="quiz-modal-content">
    <div class="quiz-header">
      <h3 id="quizTitle">Quiz Title</h3>
      <div class="quiz-timer" id="quizTimer">
        <span class="timer-icon">⏱️</span>
        <span id="timeRemaining">00:00</span>
      </div>
      <button class="close-quiz-modal">&times;</button>
    </div>

 
<!-- Progress Bar -->
<div class="quiz-progress">
  <div class="quiz-progress-bar" id="quizProgressBar"></div>
</div>
<form method="POST" id="quizForm">
  <input type="hidden" name="quiz_id" id="quizId">
  <input type="hidden" name="class_id" value="<?= $_GET['id'] ?>">
  <div id="questionContainer" class="question-container"></div>

  <div class="quiz-actions">
    <button type="button" id="prevQuestion" class="btn btn-secondary" disabled>Previous</button>
    <button type="button" id="nextQuestion" class="btn btn-primary">Next</button>
    <button type="submit" id="submitQuiz" class="btn btn-success hidden">Submit Quiz</button>
  </div>
</form>



  </div>
</div>


 <div class="content-section">
    <button class="section-header-button">
        <span class="arrow">▶</span>
        <span class="section-title">Assignment</span>
    </button>

    <div class="section-body hidden">
        <?php if (!empty($assignments)): ?>
            <div class="assignments-container">
                <?php foreach ($assignments as $assignment): ?>
                    <div class="assignment-box">
    <h4><?= htmlspecialchars($assignment->title) ?></h4>

    <?php if (!empty($assignment->description)): ?>
        <p><?= nl2br(htmlspecialchars($assignment->description)) ?></p>
    <?php endif; ?>
<?php if (!empty($assignment->content_path)): ?>
    <a href="<?= ROOT . '/' . str_replace('\\', '/', $assignment->content_path) ?>"
       target="_blank"
       class="file-item">
        <span class="file-icon">📄</span>
        <span class="file-name">
            <?= pathinfo($assignment->content_path, PATHINFO_BASENAME) ?>
        </span>
    </a>
<?php endif; ?>


    <?php if (!empty($assignment->due_date)): ?>
        <div class="assignment-due">
            <strong>Due:</strong> <?= date('d M Y, h:i A', strtotime($assignment->due_date)) ?>
        </div>
    <?php endif; ?>

<?php
$isSubmitted = isset($submittedMap[$assignment->assignment_id]);

$dueTime = !empty($assignment->due_date)
    ? strtotime($assignment->due_date)
    : null;

$isPastDue = $dueTime && $now > $dueTime;
?>

<?php if ($isPastDue && $isSubmitted): ?>

    <button class="submitted-btn" disabled>
        Submitted
    </button>

<?php elseif (!$isPastDue && $isSubmitted): ?>

    <button type="button"
            class="open-upload-modal update-btn"
            data-assignment-id="<?= $assignment->assignment_id ?>">
        Update Submission
    </button>

<?php elseif ($isPastDue && !$isSubmitted): ?>

    <button class="deadline-btn" disabled>
       Deadline Passed
    </button>

<?php else: ?>

    <button type="button"
            class="open-upload-modal"
            data-assignment-id="<?= $assignment->assignment_id ?>">
        Submit Assignment
    </button>

<?php endif; ?>



</div>

                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No assignments have been posted yet.</p>
        <?php endif; ?>
    </div>
</div>

<div class="upload-modal hidden" id="uploadModal">
  <div class="upload-modal-content">

    <div class="upload-header">
      <h3>Upload Assignment</h3>
      <button class="close-modal">&times;</button>
    </div>

    <form action="<?= ROOT ?>/StudentVle/submit_assignment" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="assignment_id" id="modalAssignmentId">

      <label class="file-drop">
        <input type="file" name="submission_files[]" id="fileInput" multiple hidden>
        <span>Click to select files</span>
      </label>
      <ul class="file-list" id="fileList"></ul>


 
<div class="submitted-files-container">
  <?php
  $assignmentId = $assignment->assignment_id;
  if (!empty($submissionFiles[$assignmentId])):
      foreach ($submissionFiles[$assignmentId] as $file): ?>
      <div class="submitted-file-card" data-file-id="<?= $file->submission_id ?>">
          <div class="file-info">
              <div class="file-icon">📄</div>
              <a href="<?= ROOT . '/' . str_replace('\\','/',$file->submission_path) ?>" 
                 target="_blank" class="file-name">
                 <?= htmlspecialchars($file->display_name ?? basename($file->submission_path)) ?>
              </a>
          </div>
          <a href="<?= ROOT ?>/StudentVle/delete_submission?file_id=<?= $file->submission_id ?>&assignment_id=<?= $assignmentId ?>" 
             class="delete-file" data-file-id="<?= $file->submission_id ?>">🗑️</a>
      </div>
  <?php endforeach; endif; ?>
</div>





      <div class="upload-actions">
        <button type="submit" class="submit-files">Submit</button>
      </div>
    </form>

  </div>
</div>
</div> <!-- CLOSE CONTENT PANEL -->


    <div id="participation" class="panel">
                  <div class="calendar-placeholder">
            <p>Your calendar will be displayed here.</p>
            <?php include __DIR__.'/Component/calander.php'; ?>
          </div>
        </div>
      </div>
<div id="grades" class="panel">
  
<div class="stats-container">
    
    
    <div class="stat-box">
      <div class="stat-text">
        <p>Exams Completed</p>
        <h3><?= $exams_completed ?? 0 ?></h3>
      </div>
      <div class="stat-icon">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
    </div>
    
    <div class="stat-box">
      <div class="stat-text">
        <p>Pending Grading</p>
<h3><?= $pending_grading ?? 0 ?></h3>

      </div>
      <div class="stat-icon">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
          <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </div>
    </div>
  </div>

  <!-- Grades Table -->
  <div class="grades-table-wrapper">
    <h3 class="section-title">Your Grades</h3>
    
    <?php if (!empty($papers_with_marks)): ?>
      <div class="table-container">
        <table class="grades-table">
          <thead>
            <tr>
              <th>Paper Title</th>
              <th>Status</th>
              <th>Marks Obtained</th>
              <th>Grade</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($papers_with_marks as $paper): ?>
              <tr class="<?= $paper->status === 'graded' ? 'graded' : 'pending' ?>">
                <td class="paper-title">
                  <span class="paper-icon">📄</span>
                  <?= htmlspecialchars($paper->paper_title) ?>
                </td>
                
<td>
<?php if ($paper->status === 'graded'): ?>
    <span class="status-badge graded">Graded</span>
<?php elseif ($paper->status === 'not_graded'): ?>
    <span class="status-badge pending">Not Graded</span>
<?php elseif ($paper->status === 'not_completed'): ?>
    <span class="status-badge not-completed">Not Completed</span>
<?php endif; ?>
</td>


                
                <td class="marks-cell">
                  <?php if ($paper->marks_obtained !== null): ?>
                    <span class="marks-display"><?= number_format($paper->marks_obtained, 2) ?></span>
                  <?php else: ?>
                    <span class="no-marks">-</span>
                  <?php endif; ?>
                </td>
                
                <td>
                  <?php if ($paper->marks_obtained !== null): ?>
                    <?php
                      $marks = $paper->marks_obtained;
                      $grade = '';
                      $gradeClass = '';
                      
                      if ($marks >= 75) {
                        $grade = 'A';
                        $gradeClass = 'grade-a';
                      } elseif ($marks >= 65) {
                        $grade = 'B';
                        $gradeClass = 'grade-b';
                      } elseif ($marks >= 55) {
                        $grade = 'C';
                        $gradeClass = 'grade-c';
                      } elseif ($marks >= 40) {
                        $grade = 'S';
                        $gradeClass = 'grade-s';
                      } else {
                        $grade = 'F';
                        $gradeClass = 'grade-f';
                      }
                    ?>
                    <span class="grade-badge <?= $gradeClass ?>"><?= $grade ?></span>
                  <?php else: ?>
                    <span class="no-grade">-</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      
      <!-- Performance Chart Placeholder -->
      <div class="performance-chart">
        <h4>Performance Overview</h4>
        <div class="chart-placeholder">
          <?php if ($exams_completed > 0): ?>
            <div class="progress-bar-container">
              <div class="progress-label">Your Average Performance</div>
              <div class="progress-bar-track">
                <div class="progress-bar-fill" style="width: <?= min($overall, 100) ?>%">
                  <span class="progress-text"><?= $overall ?>%</span>
                </div>
              </div>
            </div>
          <?php else: ?>
            <p class="no-data">Complete your first exam to see performance data</p>
          <?php endif; ?>
        </div>
      </div>
      
    <?php else: ?>
      <div class="no-grades-message">
        <div class="empty-state">
          <div class="empty-icon">📋</div>
          <h3>No Papers Available</h3>
          <p>Your instructor hasn't posted any papers yet. Check back later!</p>
        </div>
      </div>
    <?php endif; ?>
  </div>
  
</div>

    </div>

<div id="analysis" class="panel">
   

<div class="an-header">
    <div>
      <h2 class="an-title">Performance Analysis</h2>
      <p class="an-subtitle">Visual breakdown of your academic progress</p>
    </div>

    <!-- Filter chips -->
    <div class="an-filter-group" id="anFilterGroup">
      <button class="an-chip active" data-range="all">All Time</button>
      <button class="an-chip" data-range="recent">Recent 5</button>
    </div>
  </div>

  <!-- ── KPI STRIP ────────────────────────────────────────────── -->
  <div class="an-kpi-strip">

    <div class="an-kpi" id="kpiAvg">
      <div class="an-kpi-icon">📊</div>
      <div>
        <div class="an-kpi-val" id="kpiAvgVal">—</div>
        <div class="an-kpi-label">Overall Avg</div>
      </div>
    </div>

    <div class="an-kpi" id="kpiBest">
      <div class="an-kpi-icon">🏆</div>
      <div>
        <div class="an-kpi-val" id="kpiBestVal">—</div>
        <div class="an-kpi-label">Best Score</div>
      </div>
    </div>

    <div class="an-kpi" id="kpiWorst">
      <div class="an-kpi-icon">📈</div>
      <div>
        <div class="an-kpi-val" id="kpiWorstVal">—</div>
        <div class="an-kpi-label">Lowest Score</div>
      </div>
    </div>

    <div class="an-kpi" id="kpiRank">
      <div class="an-kpi-icon">🎯</div>
      <div>
        <div class="an-kpi-val" id="kpiRankVal">—</div>
        <div class="an-kpi-label">Class Rank</div>
      </div>
    </div>

  </div>

  <!-- ── CHARTS ROW ────────────────────────────────────────────── -->
  <div class="an-charts-row">

    <!-- LEFT: Score Distribution Histogram -->
    <div class="an-card an-card--wide">
      <div class="an-card-head">
        <div>
          <h3 class="an-card-title">Score Distribution</h3>
          <p class="an-card-desc">How your paper scores compare across the class</p>
        </div>
        <div class="an-legend" id="histLegend">
          <span class="an-legend-dot" style="background:#1e2a5e"></span><span>Class</span>
          <span class="an-legend-dot" style="background:#fed352"></span><span>You</span>
        </div>
      </div>
      <div class="an-chart-wrap">
        <canvas id="histogramChart"></canvas>
      </div>
      <!-- Percentile badge rendered by JS -->
      <div class="an-percentile-banner hidden" id="percentileBanner"></div>
    </div>

    <!-- RIGHT: Assessment Type Comparison -->
    <div class="an-card">
      <div class="an-card-head">
        <div>
          <h3 class="an-card-title">Assessment Types</h3>
          <p class="an-card-desc">Avg score by category</p>
        </div>
      </div>
      <div class="an-chart-wrap an-chart-wrap--bar">
        <canvas id="typeChart"></canvas>
      </div>
      <!-- Mini legend rendered by JS -->
      <div class="an-type-summary" id="typeSummary"></div>
    </div>

  </div>

  <!-- ── TREND LINE ────────────────────────────────────────────── -->
  <div class="an-card an-card--full">
    <div class="an-card-head">
      <div>
        <h3 class="an-card-title">Score Trend</h3>
        <p class="an-card-desc">Your progress over individual assessments</p>
      </div>
    </div>
    <div class="an-chart-wrap an-chart-wrap--trend">
      <canvas id="trendChart"></canvas>
    </div>
  </div>
  
</div>



  </main>

  <script>
window.analysisData = <?= json_encode($analysisData ?? []) ?>;
</script>


  <script>
  window.quizData = <?= json_encode($quizData) ?>;
</script>

  <?php include __DIR__.'/Component/footer.view.php'; ?>
              <script src="<?php  echo ROOT ?>/assets/js/calander.js"></script>
  <script src="<?php echo ROOT ?>/assets/js/studentVle.js"></script>
</body>
</html>