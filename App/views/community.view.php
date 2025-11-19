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
              <?php foreach($data['post_list']  as $list):  ?>
              <li><button id="openPostBtn"><?= htmlspecialchars($list->name) ?></button></li> 
              <?php endforeach; ?>

            </ul>
          </li>

        </ul>
      </aside>
    </div>

    <div class="chat-container">
      <div class="chat-header">
        <button class="open-post-btn" id="openPostBtn">Create Post</button>
        <h2><?= htmlspecialchars($selectedCommunity->name ?? "Select a Community") ?></h2>
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
                  <button type="button" class="cancel-btn" id="cancelPostBtn">Cancel</button>
                  <button type="submit" class="submit-btn">Submit Post</button>
              </div>
          </form>
      </div>
  </div>


    <!-- Approval Popup -->
<div class="modal" id="approval-popup"> 
  <div class="modal-content">          
    <span class="close-btn" id="closePostBtn">&times;</span>
    <h2>Post Approval</h2>              
    <div class="post-details">
      <p><strong>Name:</strong> <span id="post-name"></span></p>
      <p><strong>Description:</strong> <span id="post-description"></span></p>
      <p><strong>Attached Files:</strong> <span id="post-files"></span></p>
      <p><strong>Created At:</strong> <span id="post-date"></span></p>
      <p><strong>Posted By:</strong> <span id="post-user"></span></p>
    </div>
    <div class="modal-actions">         
      <button id="reject-btn" class="cancel-btn">Reject</button>    
      <button id="approve-btn" class="submit-btn">Approve</button>  
    </div>
  </div>
</div>


    <?php include __DIR__.'/Component/footer.view.php'; ?>
    <script>
        const CURRENT_USER_ID = <?= json_encode($_SESSION['USER']['account_id'] ?? 0) ?>;
        
        const communityId = <?= json_encode($_GET['community_id'] ?? 0) ?>;
        const userId = <?= json_encode($_SESSION['USER']['account_id'] ?? 0) ?>;
        let lastMessageId = 0;
    </script>
    <script src="<?php  echo ROOT ?>/assets/js/community.js"></script>
  </body>
</html>




