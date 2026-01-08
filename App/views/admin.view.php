<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/admin.css" />
            <link
      href="<?php  echo ROOT ?>/assets/css/component/footer-styles.css"
      rel="stylesheet"
    />
    <link href="<?php  echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
  </head>
  <body>
        <?php include __DIR__.'/Component/nav.view.php'; ?>
        <?php 
          $analyticsDetails = $data['analytics_details'];
          $weekly_logins = $data['Weekly_login_counts'];
        ?>

  <div class="admin-layout">
    <aside class="sidebar">
      <div class="sidebar-header">Admin Panel</div>
      <ul class="nav-list">
        <li class="nav-item active">
          <a href="#" data-target="analytics-view">Analytics</a>
        </li>
        <li class="nav-item">
          <a href="#" data-target="acception-view">Acception</a>
        </li>
        <li class="nav-item">
          <a href="#" data-target="community-view">Community</a>
        </li>
        <li class="nav-item">
          <a href="#" data-target="advertises-view">Advertises</a>
        </li>
      </ul>
    </aside>

    <div class="main-content">
      
      <div id="analytics-view" class="content-section active">
        <h1 class="content-header">Analytics Overview</h1>
        <div class="kpi-row">
          <div class="kpi-card kpi-primary">
            <div class="kpi-title">
              Total Students <span class="kpi-icon primary"></span>
            </div>
            <div class="kpi-value"><?= $analyticsDetails[0]?></div>
            <div class="kpi-subtext">Registered in Class</div>
          </div>
          <div class="kpi-card kpi-secondary">
            <div class="kpi-title">
              Active Classes <span class="kpi-icon secondary"></span>
            </div>
            <div class="kpi-value"><?= $analyticsDetails[1]?></div>
            <div class="kpi-subtext">Currently Running</div>
          </div>
          <div class="kpi-card kpi-primary">
            <div class="kpi-title">
              Registered Institute <span class="kpi-icon primary"></span>
            </div>
            <div class="kpi-value"><?= $analyticsDetails[2]?></div>
            <div class="kpi-subtext">Across Sri Lanka</div>
          </div>
          <div class="kpi-card kpi-secondary">
            <div class="kpi-title">
              Registered Teachers <span class="kpi-icon secondary"></span>
            </div>
            <div class="kpi-value"><?= $analyticsDetails[3]?></div>
            <div class="kpi-subtext">Collected Data</div>
          </div>
        </div>
        <section>
          <h2>Performance Trends</h2>
          <div>
            <p>Chart Area is Ready to be Developed</p>
            <div>
              <canvas id="admin-chart"></canvas>
            </div>       
          </div>
        </section>
      </div>

      <div id="acception-view" class="content-section">
        <h1 class="content-header">Acception Management</h1>
        <div class="tabs">
          <button class="tab-link active" data-tab="teachers-content">
            Teacher Requests
          </button>
          <button class="tab-link" data-tab="institutes-content">
            Institute Requests
          </button>
        </div>

        <div id="teachers-content" class="tab-content active">
          <h3>Pending Teacher Requests</h3>
          <table class="request-table">
            <thead>
              <tr>
                <th>Applicant ID</th>
                <th>Applicant Name</th>
                <th>Subject</th>
                <th>Date Submitted</th>
                <th>Actions</th>
              </tr>
            </thead>
                    <tbody>
           
                      <?php foreach($data["teacher_pending_req"] as $req): ?>
                        <tr>
                          <td><?= htmlspecialchars($req->teacher_id ) ?></td>
                            <td><?= htmlspecialchars($req->	first_name)?> - <?=htmlspecialchars($req->last_name)?></td>
                            <td><?= htmlspecialchars($req-> subjects_taught) ?></td>
                            <td><?= htmlspecialchars($req->account_info->created_at) ?></td>
                            <td><button class="btn-review" onclick='openAcceptModel(<?= json_encode($req) ?>)'>Review</button></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
          </table>
        </div>

        <div id="institutes-content" class="tab-content">
          <h3>Pending Institute Requests</h3>
          <table class="request-table">
            <thead>
              <tr>
                <th>Institute Id</th>
                <th>Institute Name</th>
                <th>location</th>
                <th>Date Submitted</th>
                <th>Actions</th>
              </tr>
            </thead>
                    <tbody>
           
                      <?php foreach($data["institute_pending_req"] as $req): ?>
                        <tr>
                          <td><?= htmlspecialchars($req->institute_id ) ?></td>
                            <td><?= htmlspecialchars($req->institute_name)?> </td>
                            <td><?= htmlspecialchars($req->location) ?></td>
                            <td><?= htmlspecialchars($req->account_info->created_at) ?></td>

                            
                            <td><button class="btn-review" onclick='openAcceptModel(<?= json_encode($req) ?>)'>Review</button></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
          </table>
        </div>
      </div>

    <div id="reviewModal" class="modal-overlay">
      <div class="modal-content">
        <div class="modal-header">
          <h3>Review Request</h3>
          <span class="close-button">&times;</span>
        </div>
        <div class="modal-body">
          <h4>Applicant Details</h4>
          <p>
            <strong>Name:</strong>
            <span id="applicantName"></span>
          </p>
          <p>
            <strong>Email:</strong>
            <span id="applicantEmail"></span>
          </p>
          <h4>Submitted Documents</h4>
            <div id= "acceptModalDownloadContainer"></div>
        </div>
        <div class="modal-footer">
                        <form action="<?php echo ROOT ?>/Admin/aprovelSend" method="POST" id="pendingReviewForm">
                          <strong>Actions: </strong><br>

                          <input type="hidden" name="user_id" id="user_id">
                          <input type="hidden" name="user_email" id="user_email">

                          <label>
                            <input type="radio" name="status" value="approved" required> 
                            Approve The User
                          </label>
                          <br>
                          <label>
                              <input type="radio" name="status" value="rejected"> 
                              Reject The User
                          </label>

                          <br><br>
                          <div class="hidden" id="message_container" style="display:none;"> 
                              <label for="admin_message">Admin Message:</label><br>
                              <textarea id="admin_message" name="admin_message" rows="4" cols="50"></textarea>
                          </div>

                          <br><br>
                          <button type="submit">Submit Update</button>
                      </form>
        </div>
      </div>
    </div>

 <!-- ======================================== -->
        <!-- 5. My Community Section     -->
        <!-- ======================================== -->
        <section id="community-view" class="content-section">
          <div class="content-header">
            <h1><i class="fa-solid fa-users"></i> My Communities</h1>
            <button class="btn btn-primary btn-open-admin-create">
              <i class="fa-solid fa-plus"></i> Create New Community
            </button>
          </div>

          <div class="community-search-bar">
            <i class="fa-solid fa-search"></i>
            <input type="search" placeholder="Search your communities by name..." />
          </div>

          <div class="community-list">
            <?php foreach($data["community_details"]  as $community): ?>
            <div class="community-card">
              <div class="community-info">
                <h3><?= htmlspecialchars($community->name) ?></h3>
                <div class="community-meta">
                  <span><i class="fa-solid fa-users"></i><?= htmlspecialchars($community->description) ?></span>
                </div>
              </div>
              <button class="btn btn-secondary"><a class="btn btn-secondary" href="<?= ROOT ?>/community?community_id=<?= htmlspecialchars($community->id) ?>">Manage</a></button>
            </div>
            <?php endforeach; ?>
          </div>
        </section>  

       <!-- Admin Create Global Community Modal -->
      <div id="adminCreateCommunityModal" class="modal-overlay">
        <div class="modal-content">
          <div class="modal-header">
            <h3>Create Global Community</h3>
            <span class="close-button">&times;</span>
          </div>
          <div class="modal-body">
            <form id="adminCreateCommunityForm" method="POST" action="<?php echo ROOT ?>/admin/communityCreate" enctype="multipart/form-data">
              <div class="form-group">
                <label for="communityName">Community Name</label>
                <input type="text" id="communityName" name="communityName" placeholder="Enter community name" required>
              </div>

              <div class="form-group">
                <label for="communityDesc">Description</label>
                <textarea id="communityDesc" name="communityDesc" placeholder="Enter a description..." required></textarea>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-cancel">Cancel</button>
                <button type="submit" class="btn btn-create">Create Community</button>
              </div>
            </form>
          </div>
        </div>
      </div> 



 <!-- ======================================== -->
        <!-- 5. My advertises Request Section     -->
        <!-- ======================================== -->

        <section id="advertises-view" class="content-section">
            <h1 class="content-header">Advertisement Requests</h1>
            <div class="tabs">
                <button class="tab-link active" data-tab="homepage-content">
                    Homepage Requests
                </button>
                <button class="tab-link" data-tab="community-content">
                    Community Requests
                </button>
            </div>

            <!-- Homepage Requests Tab -->
            <div id="homepage-content" class="tab-content active">
                <h3>Pending Homepage Requests</h3>
                <table class="request-table">
                    <thead>
                        <tr>
                            <th>Advertiser Name</th>
                            <th>Start datetime</th>
                            <th>End datetime</th>
                            <th>Actions</th>
                            <th>Left Hours</th>
                        </tr>
                    </thead>
                    <tbody>
           
                      <?php foreach($data['home_request_details'] as $req): ?>
                        <?php  
                            $createdDate = new DateTime($req->created_at);
                            $expiryDate  = clone $createdDate;
                            $expiryDate->modify('+5 days'); 

                            $now = new DateTime();

                            $interval = $now->diff($expiryDate);
                          
                            $isUrgent =  ($interval->days < 1);

                            if($isUrgent) {
                                $timeStyle = 'color: red; font-weight: bold;';
                                $leftTime = $interval->format('%h hrs %i mins left');
                            } else {
                                $timeStyle = 'color: green; font-weight: bold;';
                                $leftTime = $interval->format('%a days left');
                            }
                          
                          ?>
                        <tr>
                            <td><?= htmlspecialchars($req->advertiser_name) ?></td>
                            <td><?= htmlspecialchars($req-> start_datetime) ?></td>
                            <td><?= htmlspecialchars($req-> end_datetime) ?></td>
                            <td><button class="btn-review-ad" onclick='openAdModal(<?= json_encode($req) ?>)'>Review</button></td>
                            <td style="<?= $timeStyle ?>"> <?= htmlspecialchars($leftTime) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Community Requests Tab -->
            <div id="community-content" class="tab-content">
                <h3>Pending Community Poster Requests</h3>
                <table class="request-table">
                    <thead>
                        <tr>
                            <th>Advertiser Name</th>
                            <th>Start Datetime</th>
                            <th>End Datetime</th>
                            <th>Actions</th>
                            <th>Left Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach($data['comm_request_details'] as $req): ?>
                        <?php  
                            $createdDate = new DateTime($req->created_at);
                            $expiryDate  = clone $createdDate;
                            $expiryDate->modify('+5 days'); 

                            $now = new DateTime();

                            $interval = $now->diff($expiryDate);

                            $isUrgent =  ($interval->days < 1);

                            if($isUrgent) {
                                $timeStyle = 'color: red; font-weight: bold;';
                                $leftTime = $interval->format('%h hrs %i mins left');
                            } else {
                                $timeStyle = 'color: green; font-weight: bold;';
                                $leftTime = $interval->format('%a days left');
                            }
                          
                          ?>
                        <tr >
                            <td><?= htmlspecialchars($req->advertiser_name) ?></td>
                            <td><?= htmlspecialchars($req-> start_datetime) ?></td>
                            <td><?= htmlspecialchars($req-> end_datetime) ?></td>
                            <td><button class="btn-review-ad" onclick='openAdModal(<?= json_encode($req) ?>, <?= json_encode($data["community_details"]?? []) ?>)'>Review</button></td>
                            <td style="<?= $timeStyle ?>"> <?= htmlspecialchars($leftTime) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

      <div id="adReviewModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Review Advertisement Request</h3>
                <span class="close-button">&times;</span>
            </div>
            <div class="modal-body">
                <!-- Advertiser Info -->
                <h4>Advertiser Details</h4>
                <p><strong>Name:</strong><span id="modalAdvertiserName"></span></p>
                <p><strong>Hours For Ad:</strong><span id="modalAdDate"> </span></p>

                
                <!-- Document Downloads -->
                <h4>Submitted Documents</h4>
                    <div id= "modalDownloadContainer"></div>

                <!-- Community Selection (only if placement is community) -->
                <div class="form-group hidden" id="communitySelectWrapper" >
                    <label for="community-select">Selected Community</label>
                    <span id="community-select">
                        <!--  dynamically filled here -->
                      </span>
                </div>
            </div>
            

            <div class="modal-footer">

              <form action="<?php  echo ROOT ?>/Admin/reviewSend" method="POST" id="reviewForm">
                  <strong>Actions:</strong><br>

                  <input type="hidden" id="adRequestId" name="ad_id" value="">

                  <label>
                      <input type="radio" name="status" value="Poster Approval" required> 
                      Approve Poster
                  </label>
                  <br>
                  <label>
                      <input type="radio" name="status" value="Rejected"> 
                      Reject Poster
                  </label>

                  <br><br>

                  <label>Hourly Rate (Rs):</label><br>
                  <input type="number" id="hourlyRate" name="hourly_rate" step="0.01" min="0" placeholder="Enter rate per hour">
                  
                  <br><br>

                  <label>Total Calculated Cost (Rs):</label><br>
                  <input type="text" id="totalCost" name="total_cost" readonly value="0.00">

                  <br><br>

                  <label for="admin_message">Admin Message:</label><br>
                  <textarea id="admin_message" name="admin_message" rows="4" cols="50"></textarea>


                  <br><br>

                  <button type="submit">Submit Update</button>
              </form>
        </div>
      </div>

      
  </div>
  
  </div>
  </div>
  
  <script>
    const weeklyData = <?php echo json_encode($weekly_logins); ?>;
  </script>
  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php  echo ROOT ?>/assets/js/admin.js"></script>
    <script src="<?php  echo ROOT ?>/assets/js/admin_chart.js"></script>
    <?php include __DIR__.'/Component/footer.view.php'; ?>
  </body>
</html>
