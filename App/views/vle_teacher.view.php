<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VLE - <?php echo htmlspecialchars($data['class']->class_name ?? 'Class'); ?></title> 
    <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/vle_teacher.css" />
        <link
      rel="stylesheet"
      href="<?php  echo ROOT ?>/assets/css/component/content_gen.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    />
    <link href="<?php  echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
    <link href="<?php  echo ROOT ?>/assets/css/component/footer-styles.css" rel="stylesheet"/>
  </head>
  <body>
    <header>
        <?php include __DIR__.'/Component/nav.view.php'; ?>
    </header>

    <div class="vle-container">
      <div class="vle-tabs">
        <button class="vle-tab active" data-panel="schedule">Schedule</button>
        <button class="vle-tab" data-panel="content">Content</button>
        <button class="vle-tab" data-panel="monitoring">Monitoring</button>
        <button class="vle-tab" data-panel="analysis">Analysis</button>
        <button class="vle-tab" data-panel="grading">Grading</button>
      </div>

      <div class="vle-panels">
<div id="schedule" class="vle-panel active">
    
    <?php 
        // --- 1. PHP LOGIC: Split & Sort Sessions ---
        $current_time = time();
        $upcoming_sessions = [];
        $history_sessions = [];
        
        // Get sessions safely
        $all_sessions = $data['session_details'] ?? [];

        foreach ($all_sessions as $session) {
            $end_timestamp = strtotime($session->end_time);
            
            // If the class end time has passed, it goes to History
            if ($end_timestamp < $current_time) {
                $history_sessions[] = $session;
            } else {
                $upcoming_sessions[] = $session;
            }
        }

        // Sort Upcoming: Nearest date first (Ascending)
        usort($upcoming_sessions, function($a, $b) {
            return strtotime($a->start_time) - strtotime($b->start_time);
        });

        // Sort History: Newest date first (Descending)
        usort($history_sessions, function($a, $b) {
            return strtotime($b->start_time) - strtotime($a->start_time);
        });
    ?>

    <div class="schedule-section">
        <h2>Schedule Today & Upcoming</h2>

        <table class="vle-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Topic</th>
                    <th>Time</th>
                    <th>Place</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="empty-row">
                    <td colspan="5">
                        <button class="add-schedule-btn" onclick ="openSchedulePopup()">
                            <span> + schedule</span>
                        </button>
                    </td>
                </tr>

                <?php if (!empty($upcoming_sessions)): ?>
                    <?php foreach ($upcoming_sessions as $session) : ?>
                    <?php 
                        $start_ts = strtotime($session->start_time); 
                        $end_ts   = strtotime($session->end_time);
                        $display_date  = date('M j, Y', $start_ts); 
                        $display_start = date('g:i A', $start_ts); 
                        $display_end   = date('g:i A', $end_ts);
                        
                        $join_time = $start_ts - (15 * 60);
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($display_date) ?></td>
                        <td><?= htmlspecialchars($session->title) ?></td>
                        <td><?= htmlspecialchars($display_start . ' - ' . $display_end) ?></td>
                        <td><?= htmlspecialchars($session->place) ?></td>
                        <td class="action-buttons">
                            
                            <?php if ($current_time < $join_time): ?>
                                <span class="status-soon">Starts soon</span>
                            <?php else: ?>
                                <a href="https://meet.jit.si/<?= urlencode($session->meeting_link) ?>" 
                                   target="_blank" class="btn-common btn-join">
                                   Join
                                </a>
                            <?php endif; ?>

                            <form action="<?= ROOT ?>/TeacherVle/deleteSession" method="POST" onsubmit="return confirm('Delete this schedule?');" style="display:inline-block; margin-left: 5px;">
                                <input type="hidden" name="session_id" value="<?= $session->session_id ?>">
                                <input type="hidden" name="class_id" value="<?= $session->class_id ?>">
                                <button type="submit" class="btn-common btn-delete" title="Delete">
                                    <i class="fa-solid fa-trash"></i> </button>
                            </form>
                            <button type="button" 
                                    class="btn-common btn-edit" 
                                    onclick='openEditPopup(<?php echo htmlspecialchars(json_encode($session), ENT_QUOTES, "UTF-8"); ?>)'
                                    style="margin-left:5px; background-color: #ffc107; color: #000;">
                                Edit
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="empty-cell">No upcoming sessions scheduled.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="schedule-section">
        <h2>History (Finished Classes)</h2>

        <table class="vle-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Topic</th>
                    <th>Time</th>
                    <th>Place</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($history_sessions)): ?>
                    <?php foreach ($history_sessions as $session) : ?>
                    <?php 
                        $start_ts = strtotime($session->start_time); 
                        $end_ts   = strtotime($session->end_time);
                        $display_date  = date('M j, Y', $start_ts); 
                        $display_start = date('g:i A', $start_ts); 
                        $display_end   = date('g:i A', $end_ts);
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($display_date) ?></td>
                        <td><?= htmlspecialchars($session->title) ?></td>
                        <td><?= htmlspecialchars($display_start . ' - ' . $display_end) ?></td>
                        <td><?= htmlspecialchars($session->place) ?></td>
                        <td>
                            <span>✔ Completed</span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="empty-cell">No class history available yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<div id="schedulePopup" class="popup">
    <div class="popup-content schedule-popup-content">
        <span class="close" onclick="closeSchedulePopup()">&times;</span>
        
        <h2 id="popup-title">Create Class Schedule</h2>
        
        <form id="schedule-form" class="vle-form" action="<?php echo ROOT ?>/TeacherVle/scheduleLiveSession?index=<?php echo $data['class']->class_id; ?>" method='POST'>
            
            <input type="hidden" id="edit_session_id" name="session_id" value="">

            <div class="form-group">
                <label for="topic">Topic</label>
                <input type="text" id="topic" name="topic" placeholder="e.g. Number Systems" required>
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" required>
            </div>

            <div class="form-row">
                <div class="form-group half">
                    <label for="start_time">Start Time</label>
                    <input type="time" id="start_time" name="start_time" required>
                </div>
                <div class="form-group half">
                    <label for="end_time">End Time</label>
                    <input type="time" id="end_time" name="end_time" required>
                </div>
            </div>

            <div class="form-group">
                <label for="class-type">Class Type</label>
                <select id="class-type" name="type_name"> 
                  <option value="Physical">Physical</option>
                    <option value="Online">Online</option>
                    <option value="Hybrid">Hybrid</option>
                </select>
            </div>

            <div class="form-group" id="place-group">
                <label for="place">Place / Hall</label>
                <input type="text" id="place" name="place" placeholder="e.g. S104" required>
            </div>

            <button type="submit" id="submit-btn" class="submit-btn">Add Schedule</button>
        </form>
    </div>
</div>

</div>
<div id="content" class="vle-panel">
  <?php
    $content_sections = [
        'note'          => 'Notes',
        'past_paper'    => 'Past Paper',
        'model_paper'   => 'Model Paper',
        'external_link' => 'External Link',
        'Quiz'          => 'Quiz',
        'assignment'    => 'Assignment'
    ];
    $grouped_content = $data['content'] ?? [];
  ?>

  <div class="content-container">
    <button class="add-content-btn" onclick="openPopup()">Add Content</button>

    <?php foreach ($content_sections as $type_key => $type_name) : ?>
      
      <div class="content-section">
        <button class="section-header-button">
            <span class="arrow">▶</span>
            <span class="section-title"><?php echo htmlspecialchars($type_name); ?></span>
        </button>

        <div class="section-body hidden">
            
            <?php if (isset($grouped_content[$type_key]) && !empty($grouped_content[$type_key])) : ?>
                
            <?php foreach ($grouped_content[$type_key] as $item) : ?>
                
                <?php 
                // --- DYNAMIC DATA EXTRACTION ---

                $itemId = $item->content_id ?? null;
                $title  = $item->title ?? 'Untitled';
                $desc   = $item->description ?? '';
                $url    = $item->content_path ?? '#';
                $target = '_blank';
                $icon   = '📄';

                if ($type_key === 'Quiz') {
                    $itemId = $item->quiz_id; 
                    $icon   = '❓';
                    $url    = ROOT . '/TeacherVle/quizManager/' . $itemId;
                    $target = ''; 
                } 
                elseif ($type_key === 'assignment') {
                    $itemId = $item->assignment_id; 
                    $icon   = '📝';
                    $url    =  ROOT . '/TeacherVle/assignmentManager/' . $itemId;
                    $target = '';
                }
                elseif ($type_key === 'external_link') { 
                    $icon = '🔗'; 
                }

                if ($type_key !== 'Quiz' && $type_key !== 'assignment' && $type_key !== 'external_link' && !empty($url) && $url !== '#') {
                    $url = ROOT . '/' . $url;
                }
                ?>

                <div class="file-item">
                    <div class="file-item-info">
                        <div class="file-icon"><?php echo $icon; ?></div>
                        
                        <div class="file-item-info-text">
                            <a href="<?php echo $url; ?>" target="<?php echo $target; ?>" class="file-name">
                                <?php echo htmlspecialchars($title); ?>
                            </a>
                            
                            <?php if (!empty($desc)): ?>
                                <p class="file-description"><?php echo htmlspecialchars($desc); ?></p>
                            <?php endif; ?>
                            
                            <?php if ($type_key === 'Quiz' && !empty($item->time_limit_minutes)): ?>
                                <small style="color: #666; font-size: 0.85em;">⏱ <?php echo $item->time_limit_minutes; ?> Mins</small>
                            <?php endif; ?>

                            <?php if ($type_key === 'assignment' && !empty($item->due_date)): ?>
                                <small style="color: #d9534f; font-size: 0.85em; font-weight:bold;">
                                    📅 Due: <?php echo $item->due_date; ?>
                                </small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="vle-content-actions">
                        <button class="vle-text-button edit-btn"
                                onclick="openUpdateForm(this)"
                                data-id="<?php echo $itemId; ?>"
                                data-title="<?php echo htmlspecialchars($title); ?>"
                                data-desc="<?php echo htmlspecialchars($desc); ?>"
                                data-type="<?php echo $type_key; ?>"
                                data-url="<?php echo htmlspecialchars($url); ?>">
                            Edit
                        </button>
                        
                        <button class="vle-text-button delete-btn"
                                onclick="handleDelete('<?php echo $itemId; ?>', '<?php echo $data['class']->class_id; ?>')">
                            Delete
                        </button>
                    </div>
                </div>

            <?php endforeach; ?>

            <?php else : ?>
                <p>No <?php echo strtolower(htmlspecialchars($type_name)); ?> have been added yet.</p>
            <?php endif; ?>

        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
  <div id="popupWindow" class="popup">
    <div class="popup-content">
      <span class="close" onclick="closeAllPopups()">&times;</span> <h2>Select Content Type</h2>
      <div class="content-icons">
        
        <button onclick="chooseContent('documentPopup')" title="Document" class="popup-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="40" height="40">
            <path d="M192 64C156.7 64 128 92.7 128 128L128 512C128 547.3 156.7 576 192 576L448 576C483.3 576 512 547.3 512 512L512 234.5C512 217.5 505.3 201.2 493.3 189.2L386.7 82.7C374.7 70.7 358.5 64 341.5 64L192 64zM453.5 240L360 240C346.7 240 336 229.3 336 216L336 122.5L453.5 240z"/>
          </svg>
          <span class="popup-title">Document</span>
        </button>

        <button onclick="chooseContent('UploadPopup')" title="Upload" class="popup-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="40" height="40">
            <path d="M352 173.3L352 384C352 401.7 337.7 416 320 416C302.3 416 288 401.7 288 384L288 173.3L246.6 214.7C234.1 227.2 213.8 227.2 201.3 214.7C188.8 202.2 188.8 181.9 201.3 169.4L297.3 73.4C309.8 60.9 330.1 60.9 342.6 73.4L438.6 169.4C451.1 181.9 451.1 202.2 438.6 214.7C426.1 227.2 405.8 227.2 393.3 214.7L352 173.3zM320 464C364.2 464 400 428.2 400 384L480 384C515.3 384 544 412.7 544 448L544 480C544 515.3 515.3 544 480 544L160 544C124.7 544 96 515.3 96 480L96 448C96 412.7 124.7 384 160 384L240 384C240 428.2 275.8 464 320 464zM464 488C477.3 488 488 477.3 488 464C488 450.7 477.3 440 464 440C450.7 440 440 450.7 440 464C440 477.3 450.7 488 464 488z"/>
          </svg> 
          <span class="popup-title">UploadLink</span>
        </button>

        <button onclick="chooseContent('quizPopup')" title="question" class="popup-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="40" height="40">
            <path d="M320 576C461.4 576 576 461.4 576 320C576 178.6 461.4 64 320 64C178.6 64 64 178.6 64 320C64 461.4 178.6 576 320 576zM320 240C302.3 240 288 254.3 288 272C288 285.3 277.3 296 264 296C250.7 296 240 285.3 240 272C240 227.8 275.8 192 320 192C364.2 192 400 227.8 400 272C400 319.2 364 339.2 344 346.5L344 350.3C344 363.6 333.3 374.3 320 374.3C306.7 374.3 296 363.6 296 350.3L296 342.2C296 321.7 310.8 307 326.1 302C332.5 299.9 339.3 296.5 344.3 291.7C348.6 287.5 352 281.7 352 272.1C352 254.4 337.7 240.1 320 240.1zM288 432C288 414.3 302.3 400 320 400C337.7 400 352 414.3 352 432C352 449.7 337.7 464 320 464C302.3 464 288 449.7 288 432z"/>
          </svg>
          <span class="popup-title">Quiz</span>
        </button>

      </div>
    </div>
  </div>
          <?php include __DIR__.'/content_gen.view.php'; ?>
        <div id="monitoring" class="vle-panel">
          <div class="monitoring-section">
            <?php $monitoring = $data['monitoring'] ?? [];?>
            <h2>Class Schedule</h2>
            <table class="vle-table">
              <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Attendance</th>
                  <th>Last Payment</th>
                  <th>Phone Number</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($monitoring)) : ?>
                  <?php foreach ($monitoring as $student) : ?>
                    <tr>
                      <td><?= htmlspecialchars($student['full_name']) ?></td>
                      <td><?= htmlspecialchars($student['attendance']) ?></td>
                      <td><?= htmlspecialchars($student['last_payment']) ?></td>
                      <td><?= htmlspecialchars($student['phone_number']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" style="padding: 20px; text-align: center; color: #888;">
                            No students enrolled in this class yet.
                        </td>
                    </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

        <div id="analysis" class="vle-panel">
          <div class="vle-grid-two-col">
            <div class="schedule-section">
              
              <h2>Top Students</h2>
              <?php $topStudentData = $data['top_students'] ?? [];?>
              <table class="vle-table">
                <thead>
                  <tr>
                    <th>Current.R</th>
                    <th>Full Name</th>
                    <th>Avg. Score</th>
                  </tr>
                </thead>
                <tbody>
                <?php if (!empty($topStudentData)) : ?>
                  <?php foreach ($topStudentData as $student) : ?>
                  <tr>
                    <td><?= htmlspecialchars($student->rank) ?></td>
                    <td><?= htmlspecialchars($student->first_name) . ' ' . htmlspecialchars($student->last_name) ?></td>
                    <td><?= htmlspecialchars($student->avg_score ) ?></td>

                  </tr>
                  <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="4">No Data</td></tr>
                <?php endif; ?> </tbody>
              </table>
            </div>

            <div class="schedule-section">
              <h2>Interested Students</h2>
              <?php $bottomStudentData = $data['interested_students'] ?? [];?>
              <table class="vle-table">
                <thead>
                  <tr>
                    <th>Current.R</th>
                    <th>Full Name</th>
                    <th>Avg. Score</th>
                  </tr>
                </thead>
                <tbody>
                <?php if (!empty($bottomStudentData)) : ?>
                  <?php foreach ($bottomStudentData as $student) : ?>
                  <tr>
                    <td><?= htmlspecialchars($student->rank) ?></td>
                    <td><?= htmlspecialchars($student->first_name) . ' ' . htmlspecialchars($student->last_name) ?></td>
                    <td><?= htmlspecialchars($student->avg_score ) ?></td>

                  </tr>
                  <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="4">No Data</td></tr>
                <?php endif; ?> </tbody>
              </table>
            </div>
          </div>
        </div>
        <div id="grading" class="vle-panel">
          <div class="grading-section">
            <h2>Paper Marks Management</h2>
            <p>View the status of marks for all papers. You can import marks for papers that have not yet been released.</p>

            <button type="button" class="add-content-btn" onclick="openAddPaperPopup()">
                + Add New Paper
            </button>

            <div class="table-container">
              <table class="vle-table">
                <thead>
                  <tr>
                    <th>Paper Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $papers = $data['papers'] ?? [];

                    if (!empty($papers)):
                      foreach ($papers as $paper):
                  ?>
                    <tr>
                      <td><?php echo htmlspecialchars($paper->title); ?></td>
                      <td>
                        <?php if ($paper->is_released): ?>
                          <span class="status-badge released">Released</span>
                        <?php else: ?>
                          <span class="status-badge not-released">Not Released</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if (!$paper->is_released): ?>
                          <button 
                              type="button"
                              class="vle-text-button edit-btn"
                              onclick="openImportPopup('<?= $paper->paper_id ?>', '<?= htmlspecialchars($paper->title) ?>')"
                          >
                              Import Marks
                          </button>
                      <?php else: ?>
                          <a 
                              href="<?php echo ROOT ?>/TeacherVle/StudentMarks?index=<?php echo $data['class']->class_id; ?>&paperID=<?= htmlspecialchars($paper->paper_id)?>" 
                              class="vle-button-primary" 
                              target="_blank"
                          > 
                              View Marks 
                          </a>
                      <?php endif; ?>
                      </td>
                    </tr>
                  <?php
                      endforeach;
                    else:
                  ?>
                    <tr>
                      <td colspan="4" style="text-align: center;">No papers found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include __DIR__.'/Component/footer.view.php'; ?>
    <script>
        const ROOT_URL = "<?php echo ROOT ?>";
    </script>
    <script src="<?php  echo ROOT ?>/assets/js/vle_teacher.js"></script>
  </body>
</html>