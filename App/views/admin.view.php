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
                <th>Applicant Name</th>
                <th>Email Address</th>
                <th>Date Submitted</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Dr. Aruni Silva</td>
                <td>aruni.s@email.com</td>
                <td>Oct 15, 2025</td>
                <td><button class="btn-review">Review</button></td>
              </tr>
              <tr>
                <td>Kasun Perera</td>
                <td>kasun.p@email.com</td>
                <td>Oct 14, 2025</td>
                <td><button class="btn-review">Review</button></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div id="institutes-content" class="tab-content">
          <h3>Pending Institute Requests</h3>
          <table class="request-table">
            <thead>
              <tr>
                <th>Institute Name</th>
                <th>Contact Person</th>
                <th>Date Submitted</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Bright Future Academy</td>
                <td>Mr. Saman Kumara</td>
                <td>Oct 12, 2025</td>
                <td><button class="btn-review">Review</button></td>
              </tr>
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
            <span id="applicantName">Dr. Aruni Silva</span>
          </p>
          <p>
            <strong>Email:</strong>
            <span id="applicantEmail">aruni.s@email.com</span>
          </p>
          <h4>Submitted Documents</h4>
          <ul class="document-list">
            <li>
              <a href="#" download>University_Degree.pdf <span>&darr;</span></a>
            </li>
            <li>
              <a href="#" download>National_ID_Copy.pdf <span>&darr;</span></a>
            </li>
          </ul>
          <h4>Response Message (Optional)</h4>
          <textarea
            placeholder="Enter a reason for rejection or a welcome message..."
          ></textarea>
        </div>
        <div class="modal-footer">
          <button class="btn btn-reject">Reject Request</button>
          <button class="btn btn-approve">Approve</button>
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
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach($data['home_request_details'] as $req): ?>
                        <tr>
                            <td><?= htmlspecialchars($req->advertiser_name) ?></td>
                            <td><?= htmlspecialchars($req-> start_datetime) ?></td>
                            <td><?= htmlspecialchars($req-> end_datetime) ?></td>
                            <td><button class="btn-review-ad" onclick='openAdModal(<?= json_encode($req) ?>, <?= json_encode($data["communities"]) ?>)'>Review</button></td>
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
                            <th>Start datetime</th>
                            <th>End datetime</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach($data['comm_request_details'] as $req): ?>
                        <tr>
                            <td><?= htmlspecialchars($req->advertiser_name) ?></td>
                            <td><?= htmlspecialchars($req-> start_datetime) ?></td>
                            <td><?= htmlspecialchars($req-> end_datetime) ?></td>
                            <td><button class="btn-review-ad" onclick='openAdModal(<?= json_encode($req) ?>, <?= json_encode($data["communities"]) ?>)'>Review</button></td>
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
                <p><strong>Name:</strong> </span></p>
                <p><strong>Account Type:</strong> </span></p>
                <p><strong>Payment Amount:</strong> $<span id="paymentAmount"></span></p>

                <!-- Placement Info -->
                <p><strong>Placement:</strong> <span id="placementOption"></span></p>

                <!-- Document Downloads -->
                <h4>Submitted Documents</h4>
                <ul id="documentList" class="document-list">
                    <!-- Documents dynamically filled here -->
                </ul>

                <!-- Community Selection (only if placement is community) -->
                <div class="form-group" id="communitySelectWrapper" style="display:none;">
                    <label for="community-select">Select Community</label>
                    <select id="community-select">
                        <!-- Options dynamically filled here -->
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-reject">Reject</button>
                <button class="btn btn-approve">Approve & Place Ad</button>
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

  </body>
</html>
