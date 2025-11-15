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
    <div class="chat-container">
      <div class="chat-header">
        <h2>Community Chat</h2>
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
    <?php include __DIR__.'/Component/footer.view.php'; ?>
    <script src="<?php  echo ROOT ?>/assets/js/community.js"></script>
  </body>
</html>




