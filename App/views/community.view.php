<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Community Chat</title>
    <link rel="stylesheet" href="<?php  echo ROOT ?>/assets/css/community.css" />
                <link
      href="<?php  echo ROOT ?>/assets/css/component/footer-styles.css"
      rel="stylesheet"
    />
    <link href="<?php  echo ROOT ?>/assets/css/component/nav.css" rel="stylesheet" />
  </head>
  <body>
            <?php include __DIR__.'/Component/nav.view.php'; ?>
  <div class="community-chat-page">
    <div class="pending-messages" id="pending-messages">
      <aside class="sidebar">
        <div class="top-bar">
            <a href="<?= ROOT ?>/admin" class="back-btn">
                <i class="arrow left"></i> 
            </a>

            <h2 class="panel-title">Community Panel</h2>
        </div>
        <ul class="nav-list">
          
          <li class="nav-item active"> <a href="#" data-target="analytics-view">My Communities</a>
            
            <ul class="sub-list">
              <?php foreach($data["community_details"]  as $community):  ?>
              <li><a href="<?= ROOT ?>/community?community_id=<?= htmlspecialchars($community->id) ?>"><?= htmlspecialchars($community->name) ?></a></li>
              <?php endforeach; ?>
            </ul>
          </li>
          <?php
            $selectedId = $_GET['community_id'] ?? null;
            $selectedCommunity = null;

            foreach ($data["community_details"] as $community) {
                if ($community->id == $selectedId) {
                    $selectedCommunity = $community;
                    break;
                }
            }
          ?>

          <li class="nav-item">
              <a href="#" data-target="community-view">Pending Post</a>
              
              <ul class="sub-list">
                  <?php 
                  // 1. Safely get the current Community ID from the URL
                  $currentCommId = isset($_GET['community_id']) ? $_GET['community_id'] : 0;
                  
                  // Check if we have posts to loop through
                  if (!empty($data['post_list'])): 
                      foreach($data['post_list'] as $list): 
                          
                          // 2. Filter: Only show posts belonging to THIS community
                          // We use '==' to allow string '5' to match integer 5
                          if($list->community_id == $currentCommId):
                              
                              // Prepare Data for JS
                              $postData = [
                                  'post_id'     => $list->id, // Ensure your DB column is 'id' or 'post_id'
                                  'user_name'   => $list->name,
                                  'created_at'  => $list->created_at,
                                  'description' => $list->description,
                                  'file_path'   => $list->file_path
                              ];
                              // Encode safely
                              $jsonData = htmlspecialchars(json_encode($postData), ENT_QUOTES, 'UTF-8');
                  ?>
                      <li>
                          <a href="javascript:void(0)" 
                            onclick="openPostApproval(<?= $jsonData ?>)"
                            style="cursor: pointer; display: block; padding: 5px;">
                            
                            <?= htmlspecialchars($list->name) ?>
                          </a>
                      </li> 

                  <?php 
                          endif; // End ID check
                      endforeach; 
                  endif; // End empty check
                  ?>
              </ul>
          </li>

        </ul>
      </aside>
      <div class="right-sidebar" id="membersSidebar">
        <div class="sidebar-header">
            <h3>Community Members</h3>
            <button id="closeSidebarBtn">&times;</button>
        </div>
        
        <div class="sidebar-stats">
            <span id="memberCount">Loading...</span> Members
        </div>

        <ul class="member-list" id="memberListContainer">
        </ul>
      </div>
    </div>

    <div class="chat-container">
      <div class="chat-header">
        <h2><?= htmlspecialchars($selectedCommunity->name ?? "Select a Community") ?></h2>
        <button id="memberToggleBtn" class="toggle-sidebar-btn">
            <i class="fas fa-users"></i> See Members
        </button>
      </div>
      <div class="messages-area" id="messages-area">
        <!-- Messages will be dynamically added here -->
      </div>
      <div class="typing-bar">
        <input
          type="text"
          id="message-input"
          placeholder="Type your message..."
        />
        <button class="open-post-btn" id="openPostBtn">+</button>
        <button id="send-button">Send</button>
      </div>
    </div>
</div>

<!-- pop up window for creating post -->

  <div class="modal" id="postModal">
      <div class="modal-content">
          <span class="close-btn" id="closePostBtn">&times;</span>

          <h2>Create New Post</h2>

          <form id="createPostForm" method="POST" 
                action="<?php echo ROOT ?>/community/postSend?community_id=<?= htmlspecialchars($community->id) ?>" 
                enctype="multipart/form-data">

              <div class="form-group">
                  <label for="name">Name for identification</label>
                  <input type="text" name="name" id="name" placeholder="Enter a title..." required />
              </div>

              <div class="form-group">
                  <label for="postDescription">Description</label>
                  <textarea name="description" id="postDescription" placeholder="Write something..." required></textarea>
              </div>

              <div class="form-group">
                  <label for="postAttachment">Attach File (Optional)</label>
                  <input type="file" name="attachment" id="postAttachment" accept=".jpg,.jpeg,.png,.pdf" />
              </div>

              <div class="modal-actions">
                  <button type="reset" class="cancel-btn" id="cancelPostBtn">Cancel</button>
                  <button type="submit" class="submit-btn">Submit Post</button>
              </div>
          </form>
      </div>
  </div>


    <!-- Approval Popup -->
    <div class="modal" id="approval-popup">
        <div class="modal-content post-card">
            
            <div class="modal-header">
                <h3>Review Post</h3>
                <span class="close-btn close-button">&times;</span>
            </div>

            <div class="modal-body">
                
                <div class="user-header">
                    <div class="user-avatar-placeholder">
                        <i class="fas fa-user"></i> 
                    </div>
                    <div class="user-meta">
                        <h4 id="post-user-name">User Name</h4>
                        <span class="post-time" id="post-date-display">--</span>
                    </div>
                </div>

                <div class="post-body">
                    <p id="post-description-text">
                        Loading description...
                    </p>
                </div>

                <div class="attachment-preview" id="post-media-container">
                    </div>

            </div>

        <div class="modal-footer action-footer">
            <form action="<?php echo ROOT ?>/Community/approvedPost" method="POST">

                <input type="hidden" name="post_id" id="modal_post_id">
                <input type="hidden" name="comm_id" value="<?= $_GET['community_id'] ?>">
                
                <label>
                    <input type="radio" name="status" value="approved" required> 
                    Approve Poster
                </label>
                <br>
                <label>
                    <input type="radio" name="status" value="rejected"> 
                    Reject Poster
                </label>

                <br><br>
                <button type="submit" id="approve-btn" class="action-btn btn-approve">Approve</button>
            
            </form> 
          </div>
        </div>
    </div>


    <?php include __DIR__.'/Component/footer.view.php'; ?>
    <script>
        const CURRENT_USER_ID = <?= json_encode($_SESSION['USER']['account_id'] ?? 0) ?>;
        const ROOT = "<?= ROOT ?>";
        const communityId = <?= json_encode($_GET['community_id'] ?? 0) ?>;
        const userId = <?= json_encode($_SESSION['USER']['account_id'] ?? 0) ?>;
        let lastMessageId = 0;
    </script>
    <script src="<?php  echo ROOT ?>/assets/js/community.js"></script>
  </body>
</html>




