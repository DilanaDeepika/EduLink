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
                <tr class="empty-row">
                  <td colspan="5">
                    <button class="add-schedule-btn">
                      <span>＋ schedule</span>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="schedule-section">
            <h2>History</h2>
            <h3>March</h3>

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
                <tr>
                  <td>2024/08/22</td>
                  <td>Number System</td>
                  <td>2.30PM - 4.30PM</td>
                  <td>S104</td>
                  <td><a href="#">Video Upload</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div id="content" class="vle-panel">
          
            <?php
            // --- SETUP FOR THE DYNAMIC LOOP ---

            // This is our master list. It controls the order and names.
            // The KEYS ('note', 'past_paper') MUST match the values 
            // saved in your database (from $_POST['linkType']).
            $content_sections = [
                'note' => 'Notes',
                'past_paper' => 'Past Paper',
                'model_paper' => 'Model Paper',
                'external_link' => 'External Link',
                'quiz' => 'Quiz',
                'assignment' => 'Assignment'
            ];
            $grouped_content = $data['content'] ?? [];
            ?>
            <div class="content-container">
                <button class="add-content-btn" onclick="openPopup()">
                    Add Content
                </button>

                <?php 
                ?>
                <?php foreach ($content_sections as $type_key => $type_name) : ?>
                    
                    <div class="content-section">
                        <button class="section-header-button">
                            <span class="arrow">▶</span>
                            <span class="section-title"><?php echo htmlspecialchars($type_name); ?></span>
                        </button>
                        <div class="section-body hidden">
                            
                            <?php 
                            // Check if we have any content for this specific type_key
                            if (isset($grouped_content[$type_key]) && !empty($grouped_content[$type_key])) : 
                            ?>
                                
                                <?php 
                                // --- INNER LOOP ---
                                // Loop through each item (note, paper, link) in this group
                                foreach ($grouped_content[$type_key] as $item) : 
                                ?>
                                    
                          <div class="file-item">
                              
                              <div class="file-item-info">
                                  <?php 
                                      $icon = '📄'; 
                                      if ($type_key === 'external_link') $icon = '🔗';
                                      if ($type_key === 'quiz') $icon = '❓';
                                      if ($type_key === 'assignment') $icon = '📝';
                                  ?>
                                  <div class="file-icon"><?php echo $icon; ?></div>
                                  
                                  <div class="file-item-info-text"> <?php 
                                      $url = htmlspecialchars($item->content_path);
                                      $target = '_blank';
                                      if ($type_key !== 'external_link' && !empty($url)) {
                                          $url = ROOT . '/' . $url; 
                                      } elseif (empty($url)) {
                                          $url = '#'; 
                                          $target = '';
                                      }
                                      ?>
                                      <a href="<?php echo $url; ?>" <?php if($target) echo 'target="_blank"'; ?> class="file-name" title="<?php echo htmlspecialchars($item->title); ?>">
                                          <?php echo htmlspecialchars($item->title); ?>
                                      </a>
                                      
                                      <?php if (!empty($item->description)): ?>
                                          <p class="file-description" title="<?php echo htmlspecialchars($item->description); ?>">
                                              <?php echo htmlspecialchars($item->description); ?>
                                          </p>
                                      <?php endif; ?>
                                  </div>
                              </div>

           <div class="vle-content-actions">
              <button 
                  class="vle-text-button edit-btn" 
                  title="Edit"
                  onclick="openUpdateForm(this)"
                  
                  data-id="<?php echo $item->content_id; ?>"
                  data-title="<?php echo htmlspecialchars($item->title); ?>"
                  data-desc="<?php echo htmlspecialchars($item->description); ?>"
                  data-type="<?php echo $item->content_type; ?>"
                  data-url="<?php echo htmlspecialchars($item->content_path); ?>"
              >
                  Edit
              </button>
              
              <button 
                  class="vle-text-button delete-btn" 
                  title="Delete"
                  onclick="handleDelete(
                      '<?php echo $item->content_id; ?>', 
                      '<?php echo $data['class']->class_id; ?>'
                  )"
              >
                  Delete
              </button>
          </div>
                          </div>

                          <?php endforeach;?>
                            
                            <?php else : ?>
                                
                                <p>No <?php echo strtolower(htmlspecialchars($type_name)); ?> have been added yet.</p>

                            <?php endif;  ?>

                        </div>
                    </div>

                <?php endforeach; ?>
                <?php ?>

            </div>
        </div>
        <div id="popupWindow" class="popup">
          <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>Select Content Type</h2>
            <div class="content-icons">
              <button onclick="openCreateForm()" title="Document" class= "popup-icon">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 640 640"
                  width="40"
                  height="40"
                >
                  <path
                    d="M192 64C156.7 64 128 92.7 128 128L128 512C128 547.3 156.7 576 192 576L448 576C483.3 576 512 547.3 512 512L512 234.5C512 217.5 505.3 201.2 493.3 189.2L386.7 82.7C374.7 70.7 358.5 64 341.5 64L192 64zM453.5 240L360 240C346.7 240 336 229.3 336 216L336 122.5L453.5 240z"
                  />
                </svg>
                <span class="popup-title">Document</span>

              </button>
              <button onclick="chooseContent('UploadPopup')" title="Upload" class= "popup-icon">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 640 640"
                  width="40"
                  height="40"
                >
                  <path
                    d="M352 173.3L352 384C352 401.7 337.7 416 320 416C302.3 416 288 401.7 288 384L288 173.3L246.6 214.7C234.1 227.2 213.8 227.2 201.3 214.7C188.8 202.2 188.8 181.9 201.3 169.4L297.3 73.4C309.8 60.9 330.1 60.9 342.6 73.4L438.6 169.4C451.1 181.9 451.1 202.2 438.6 214.7C426.1 227.2 405.8 227.2 393.3 214.7L352 173.3zM320 464C364.2 464 400 428.2 400 384L480 384C515.3 384 544 412.7 544 448L544 480C544 515.3 515.3 544 480 544L160 544C124.7 544 96 515.3 96 480L96 448C96 412.7 124.7 384 160 384L240 384C240 428.2 275.8 464 320 464zM464 488C477.3 488 488 477.3 488 464C488 450.7 477.3 440 464 440C450.7 440 440 450.7 440 464C440 477.3 450.7 488 464 488z"
                  />  
                </svg>
                <span class="popup-title">UploadLink</span>
              </button>
              <button onclick="chooseContent('quizPopup')" title="question" class= "popup-icon">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 640 640"
                  width="40"
                  height="40"
                >
                  <path
                    d="M320 576C461.4 576 576 461.4 576 320C576 178.6 461.4 64 320 64C178.6 64 64 178.6 64 320C64 461.4 178.6 576 320 576zM320 240C302.3 240 288 254.3 288 272C288 285.3 277.3 296 264 296C250.7 296 240 285.3 240 272C240 227.8 275.8 192 320 192C364.2 192 400 227.8 400 272C400 319.2 364 339.2 344 346.5L344 350.3C344 363.6 333.3 374.3 320 374.3C306.7 374.3 296 363.6 296 350.3L296 342.2C296 321.7 310.8 307 326.1 302C332.5 299.9 339.3 296.5 344.3 291.7C348.6 287.5 352 281.7 352 272.1C352 254.4 337.7 240.1 320 240.1zM288 432C288 414.3 302.3 400 320 400C337.7 400 352 414.3 352 432C352 449.7 337.7 464 320 464C302.3 464 288 449.7 288 432z"
                  />
                </svg>
                <span class="popup-title">Quiz</span>
              </button>
            </div>
          </div>
        </div>
          <?php include __DIR__.'/content_gen.view.php'; ?>
        <div id="monitoring" class="vle-panel">
          <div class="monitoring-section">
            <h2>Class Schedule</h2>
            <table class="vle-table">
              <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Attendance</th>
                  <th>Present</th>
                  <th>Last Payment</th>
                  <th>Phone Number</th>
                </tr>
              </thead>
              <tbody>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div id="analysis" class="vle-panel">
          <div class="vle-grid-two-col">
            <div class="schedule-section">
              <h2>Top Students</h2>
              <table class="vle-table">
                <thead>
                  <tr>
                    <th>Current.R</th>
                    <th>Full Name</th>
                    <th>Avg. Score</th>
                    <th>Start.R</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="schedule-section">
              <h2>Interested Students</h2>
              <table class="vle-table">
                <thead>
                  <tr>
                    <th>Current.R</th>
                    <th>Full Name</th>
                    <th>Avg. Score</th>
                    <th>Start.R</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div id="grading" class="vle-panel">
          <div class="grading-section">
            <h2>Paper Marks Management</h2>
            <p>View the status of marks for all papers. You can import marks for papers that have not yet been released.</p>

            <div class="table-container">
              <table class="vle-table">
                <thead>
                  <tr>
                    <th>Paper Name</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    // --- DUMMY DATA ---
                    // In your real application, you'll fetch this array from your database.
                    // It's sorted to show the most recent papers first.
                    $papers = [
                      ['id' => 'ICT003', 'name' => 'Final Term Paper', 'year' => 2025, 'is_marks_released' => false],
                      ['id' => 'ICT002', 'name' => 'Mid Term Paper', 'year' => 2025, 'is_marks_released' => true],
                      ['id' => 'ICT001', 'name' => 'First Term Paper', 'year' => 2025, 'is_marks_released' => true],
                      ['id' => 'PAP004', 'name' => 'End of Year Paper', 'year' => 2024, 'is_marks_released' => true],
                    ];

                    if (!empty($papers)):
                      foreach ($papers as $paper):
                  ?>
                    <tr>
                      <td><?php echo htmlspecialchars($paper['name']); ?></td>
                      <td><?php echo htmlspecialchars($paper['year']); ?></td>
                      <td>
                        <?php if ($paper['is_marks_released']): ?>
                          <span class="status-badge released">Released</span>
                        <?php else: ?>
                          <span class="status-badge not-released">Not Released</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if (!$paper['is_marks_released']): ?>
                          <a href="upload_marks.php?paper_id=<?php echo htmlspecialchars($paper['id']); ?>" class="import-btn">
                            Import Marks
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