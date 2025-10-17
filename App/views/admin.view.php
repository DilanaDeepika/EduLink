<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/admin.css" />
 
  </head>
  <body>

    <aside class="sidebar">
      <div class="sidebar-header">Dashboard VLE</div>
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
              Total Students <span class="kpi-icon primary">👥</span>
            </div>
            <div class="kpi-value">150</div>
            <div class="kpi-subtext">Registered in Class</div>
          </div>
          <div class="kpi-card kpi-secondary">
            <div class="kpi-title">
              Active Classes <span class="kpi-icon secondary">📚</span>
            </div>
            <div class="kpi-value">40</div>
            <div class="kpi-subtext">Currently Running</div>
          </div>
          <div class="kpi-card kpi-primary">
            <div class="kpi-title">
              Registered Institute <span class="kpi-icon primary">💯</span>
            </div>
            <div class="kpi-value">10</div>
            <div class="kpi-subtext">Across Sri Lanka</div>
          </div>
          <div class="kpi-card kpi-secondary">
            <div class="kpi-title">
              Registered Teachers <span class="kpi-icon secondary">💰</span>
            </div>
            <div class="kpi-value">25</div>
            <div class="kpi-subtext">Collected Data</div>
          </div>
        </div>
        <section>
          <h2>Performance Trends</h2>
          <div><p>Chart Area is Ready to be Developed</p></div>
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

      <div id="community-view" class="content-section">
        <h1 class="content-header">Community Management</h1>
        <p>This is where you will manage community forums, posts, and users.</p>
      </div>


        <div id="advertises-view" class="content-section">
            <h1 class="content-header">Advertisement Requests</h1>
            <table class="request-table">
                <thead>
                    <tr>
                        <th>Advertiser Name</th>
                        <th>Request Type</th>
                        <th>Date Submitted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>TechZone Tutors</td>
                        <td>Homepage Poster</td>
                        <td>Oct 16, 2025</td>
                        <td><button class="btn-review btn-review-ad">Review</button></td>
                    </tr>
                    <tr>
                        <td>Creative Minds Institute</td>
                        <td>Class Placement</td>
                        <td>Oct 15, 2025</td>
                        <td><button class="btn-review btn-review-ad">Review</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="adReviewModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Review Advertisement Request</h3>
                <span class="close-button">&times;</span>
            </div>
            <div class="modal-body">
                <h4>Advertiser Details</h4>
                <p><strong>Name:</strong> TechZone Tutors</p>
                <p><strong>Contact:</strong> contact@techzone.com</p>

                <h4>Select Placement Option</h4>
                <div class="placement-options">
                    <label><input type="radio" name="placement" value="home-poster" checked> Place Poster on Homepage</label>
                    <label><input type="radio" name="placement" value="home-class"> Place in Homepage Class Section</label>
                    <label><input type="radio" name="placement" value="community"> Place Poster in a Community</label>
                </div>

                <div class="form-group">
                    <label for="community-select">Select Community (if applicable)</label>
                    <select id="community-select">
                        <option>Physics A-Level Community</option>
                        <option>Chemistry Study Group</option>
                        <option>General Knowledge Forum</option>
                    </select>
                </div>

                <h4>Schedule Advertisement</h4>
                <div class="schedule-group">
                    <div class="form-group">
                        <label for="start-date">Start Date</label>
                        <input type="date" id="start-date">
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration (in days)</label>
                        <input type="number" id="duration" value="7" min="1">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-reject">Reject</button>
                <button class="btn btn-approve">Approve & Place Ad</button>
            </div>
        </div>
    </div>
      
    </div>

    <script src="<?php  echo ROOT ?>/assets/js/admin.js"></script>
  </body>
</html>
