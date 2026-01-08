// ==========================================
// 1. CHAT & MESSAGING LOGIC
// ==========================================
const messagesArea = document.getElementById("messages-area");
const messageInput = document.getElementById("message-input");
const sendButton = document.getElementById("send-button");

const postDate = {};

// 1. Initialize Timestamp Tracker
let lastTimestamp = "1970-01-01 00:00:00";

async function fetchMessages() {
  try {
    if (typeof communityId === "undefined") return;

    // 2. Send last_time instead of ID
    const response = await fetch(
      `Community/fetchMessages?community_id=${communityId}&last_time=${lastTimestamp}`
    );
    const contentList = await response.json();

    // Loop through mixed content (messages AND posts)
    contentList.forEach((item) => {
      // Create container
      const div = document.createElement("div");
      div.classList.add("message-container");

      // Check ownership
      const isMine = item.user_id == CURRENT_USER_ID;
      if (isMine) div.classList.add("my-message");
      else div.classList.add("other-message");

      // 3. RENDER LOGIC: Is it a Post or a Message?
      if (item.type === "post") {
        div.innerHTML = createPostHTML(item);
      } else {
        div.innerHTML = createMessageHTML(item);
      }

      messagesArea.appendChild(div);

      // 4. Update the tracker to the latest item's time
      // We compare strings to find the newest date
      if (item.created_at > lastTimestamp) {
        lastTimestamp = item.created_at;
      }
    });

    // Auto-scroll to bottom
    if (contentList.length > 0) {
      messagesArea.scrollTop = messagesArea.scrollHeight;
    }
  } catch (error) {
    console.error("Fetch error:", error);
  }
}

// --- HTML Helper Functions ---

function createMessageHTML(msg) {
  return `
      <div class="message-bubble text-msg">
        <div class="msg-header"><strong>${msg.username}</strong></div>
        <div class="msg-body">${msg.message}</div>
        <div class="msg-time">${formatTime(msg.created_at)}</div>
      </div>
    `;
}

function createPostHTML(post) {
  let mediaHTML = "";

  // Generate HTML for files/images if they exist
  if (post.file_path) {
    const rawPaths = post.file_path.replace("Poster Path: ", "").split(",");

    rawPaths.forEach((path) => {
      if (!path) return;
      const cleanPath = path.trim().replace(/^\//, "");
      const webUrl = "/EDULINK/public/" + cleanPath;
      const lowerPath = cleanPath.toLowerCase();

      // Check if Image
      if (lowerPath.match(/\.(jpeg|jpg|png|gif)$/)) {
        mediaHTML += `<img src="${webUrl}" class="chat-post-img" onclick="window.open('${webUrl}')" style="max-width:100%; margin-top:5px; border-radius:5px; cursor:pointer;">`;
      } else {
        // It's a Document
        mediaHTML += `
                    <a href="${webUrl}" download class="chat-post-file" style="display:block; margin-top:5px; background:#f0f0f0; padding:8px; text-decoration:none; color:#333; border-radius:4px;">
                       📄 Download Attachment
                    </a>
                `;
      }
    });
  }

  return `
      <div class="message-bubble post-msg" style="border: 2px solid #1E2A5E; background-color: #f4f6f9; padding:10px; border-radius:8px; width:100%;">
        
        <div class="msg-header" style="color: #1E2A5E; border-bottom:1px solid #ccc; margin-bottom:5px;">
            <strong>${
              post.username
            }</strong> <span style="background:#1E2A5E; color:white; font-size:10px; padding:2px 5px; border-radius:3px;">POST</span>
        </div>
        
        <div class="msg-body" style="margin-bottom:8px;color: #1E2A5E;">${
          post.message
        }</div>
        <div class="msg-media">${mediaHTML}</div>
        
        <div style="margin-top:10px; padding-top:5px; border-top:1px solid #ddd; display:flex; justify-content:space-between; align-items:center;">
             <small class="msg-time" style="color:#666;">${formatTime(
               post.created_at
             )}</small>
             <button onclick="toggleCommentSection(${
               post.id
             })" style="background:none; border:none; color:#1E2A5E; cursor:pointer; font-weight:bold; font-size:12px;">
                💬 Comments
             </button>
        </div>

        <div id="comment-section-${
          post.id
        }" style="display:none; margin-top:10px; background:#e9ecef; padding:8px; border-radius:5px;">
            
            <div id="comment-list-${
              post.id
            }" style=" margin-bottom:8px; font-size:13px;height: auto;overflow: visible;margin-bottom: 12px;">
                Loading comments...
            </div>

            <div style="display:flex; gap:5px;">
                <input type="text" id="comment-input-${
                  post.id
                }" placeholder="Write a reply..." style="flex:1; padding:5px; border-radius:4px; border:1px solid #ccc;">
                <button onclick="sendComment(${
                  post.id
                })" style="background:#1E2A5E; color:white; border:none; padding:5px 10px; border-radius:4px; cursor:pointer;">➤</button>
            </div>
        </div>

      </div>
    `;
}

function formatTime(dateString) {
  const date = new Date(dateString);
  return date.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
}

// Toggle the comment section and fetch comments
async function toggleCommentSection(postId) {
  const section = document.getElementById(`comment-section-${postId}`);
  const list = document.getElementById(`comment-list-${postId}`);

  // Toggle Display
  if (section.style.display === "none") {
    section.style.display = "block";

    // Fetch Comments from Backend
    list.innerHTML = "Loading...";
    try {
      const res = await fetch(`Community/getComments?post_id=${postId}`);
      const comments = await res.json();

      console.log("Debug Comments:", comments);

      list.innerHTML = ""; // Clear loader
      if (comments.length === 0) {
        list.innerHTML =
          "<div style='color:#888; padding:5px;'>No comments yet.</div>";
      } else {
        comments.forEach((c) => {
          const initial = c.username.charAt(0).toUpperCase();
          list.innerHTML += `
                <div class="comment-item">
                    <div class="comment-avatar">${initial}</div>
                    <div class="comment-content">
                        <span class="comment-username">${c.username}</span>
                        <span class="comment-text">${c.reply}</span>
                    </div>
                </div>
            `;
        });
      }
    } catch (err) {
      console.error(err);
      list.innerHTML = "Error loading comments.";
    }
  } else {
    section.style.display = "none";
  }
}

// Send a new comment
async function sendComment(postId) {
  const input = document.getElementById(`comment-input-${postId}`);

  const text = input.value.trim();

  if (!text) return;

  try {
    await fetch("Community/submitComment", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        post_id: postId,
        comment: text,
      }),
    });

    input.value = ""; // Clear input

    // Refresh the list to show new comment
    toggleCommentSection(postId);
    // Force refresh: close and reopen quickly to reload data
    document.getElementById(`comment-section-${postId}`).style.display = "none";
    setTimeout(() => toggleCommentSection(postId), 100);
  } catch (error) {
    console.error("Error sending comment:", error);
  }
}
// Send a new message

async function sendMessage() {
  const message = messageInput.value.trim();
  if (!message) return;

  try {
    await fetch("Community/sendMessage", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        community_id: communityId,
        user_id: userId,
        message,
      }),
    });
    messageInput.value = "";
    fetchMessages(); // fetch immediately after sending
  } catch (error) {
    console.error("Error sending message:", error);
  }
}

if (sendButton) {
  sendButton.addEventListener("click", sendMessage);
  // Poll every 1 second
  setInterval(fetchMessages, 1000);
  // Initial fetch
  fetchMessages();
}

// ==========================================
// 2. NAVIGATION LOGIC
// ==========================================
document.querySelectorAll(".nav-item > a").forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();

    let parentLi = this.parentElement;

    if (parentLi.classList.contains("active")) {
      return;
    }
    document
      .querySelectorAll(".nav-list > .nav-item.active")
      .forEach((item) => {
        item.classList.remove("active");
      });
    parentLi.classList.add("active");
  });
});

// ==========================================
// 3. MODAL & APPROVAL LOGIC
// ==========================================

const openBtn = document.getElementById("openPostBtn");
const openApprovalBtn = document.getElementById("openApprovalPostBtn");

const modal = document.getElementById("postModal"); // Create Post Modal
const ApprovalModel = document.getElementById("approval-popup"); // Review Post Modal

const closeBtns = document.querySelectorAll(".close-btn");

// Logic to Open "Create Post" Modal
if (openBtn) {
  openBtn.onclick = () => (modal.style.display = "flex");
}

// Logic to Open "Approval" Modal (TESTING)
// When you click the approval button, we pass DUMMY DATA to test the design
if (openApprovalBtn) {
  openApprovalBtn.onclick = () => {
    // TEST DATA: Simulating a post with an image
    const dummyPostData = {
      post_id: 101,
      user_name: "Dilana Deepika",
      created_at: "10 mins ago",
      description: "Here is the lecture note for next week. Please review it.",
      // Simulating a file path (Change this to test 'pdf' vs 'image')
      file_path:
        "Poster Path: public/uploads/notes.pdf, public/uploads/image1.jpg",
    };

    openPostApproval(dummyPostData);
  };
}

// Close Button Logic (Works for both modals)
closeBtns.forEach((btn) => {
  btn.onclick = () => {
    if (modal) modal.style.display = "none";
    if (ApprovalModel) ApprovalModel.style.display = "none";
  };
});

// Click Outside to Close
window.onclick = (e) => {
  if (e.target === modal) modal.style.display = "none";
  if (e.target === ApprovalModel) ApprovalModel.style.display = "none";
};

// ==========================================
// 4. FUNCTION TO POPULATE & OPEN APPROVAL MODAL
// ==========================================
window.openPostApproval = (postData) => {
  // 1. Fill Text Data
  document.getElementById("post-user-name").textContent =
    postData.user_name || "Unknown User";
  document.getElementById("post-date-display").textContent =
    postData.created_at || "Just now";
  document.getElementById("post-description-text").textContent =
    postData.description || "No description available.";

  // 2. Handle Attachments
  const mediaContainer = document.getElementById("post-media-container");
  mediaContainer.innerHTML = ""; // Clear old content

  if (postData.file_path) {
    // Clean the string (Remove "Poster Path: " if it exists)
    const rawString = postData.file_path.replace("Poster Path: ", "");
    const paths = rawString.split(",").map((p) => p.trim());

    paths.forEach((path, index) => {
      if (!path) return;

      const cleanPath = path.replace(/^\//, ""); // Remove leading slash
      const webUrl = "/EDULINK/public/" + cleanPath;
      const lowerPath = cleanPath.toLowerCase();

      // CHECK: Is it an Image? (jpg, png, jpeg, gif)
      if (lowerPath.match(/\.(jpeg|jpg|png|gif)$/)) {
        mediaContainer.innerHTML += `
                    <div style="margin-bottom:10px;">
                        <img src="${webUrl}" alt="Post Image ${
          index + 1
        }" style="width:100%; border:1px solid #ddd; border-radius:4px;">
                    </div>
                `;
      } else {
        // It is a document (pdf, doc, zip, etc.) -> Show Button
        mediaContainer.innerHTML += `
                    <a href="${webUrl}" download style="text-decoration:none; display:block; margin-bottom:8px;">
                        <button type="button" class="action-btn" style="width:100%; border:1px solid #ccc; background:#fff; padding:10px; cursor:pointer;">
                           📄 Download Document ${index + 1}
                        </button>
                    </a>
                `;
      }
    });
  } else {
    mediaContainer.innerHTML =
      "<span style='color:#888; font-style:italic;'>No attachments.</span>";
  }

  const hiddenInput = document.getElementById("modal_post_id");
  if (hiddenInput) {
    hiddenInput.value = postData.post_id;
  } else {
    console.log("it not working");
  }

  // Uncheck radio buttons when opening new post
  const radios = document.getElementsByName("status");
  radios.forEach((r) => (r.checked = false));

  // 4. Show the Modal
  if (ApprovalModel) ApprovalModel.style.display = "flex";
};

// --- SIDEBAR LOGIC ---

const sidebar = document.getElementById("membersSidebar");
const toggleBtn = document.getElementById("memberToggleBtn");
const closeBtn = document.getElementById("closeSidebarBtn");
const memberListContainer = document.getElementById("memberListContainer");
const memberCountLabel = document.getElementById("memberCount");
const chatContainer = document.querySelector(".chat-container");

// 1. Open Sidebar
if (toggleBtn) {
  toggleBtn.addEventListener("click", () => {
    sidebar.classList.add("open");

    if (chatContainer) chatContainer.classList.add("with-sidebar");
    fetchMembers();
  });
}

// 2. Close Sidebar
if (closeBtn) {
  closeBtn.addEventListener("click", () => {
    sidebar.classList.remove("open");

    if (chatContainer) chatContainer.classList.remove("with-sidebar");
  });
}

// 3. Fetch Members Function
async function fetchMembers() {
  try {
    memberListContainer.innerHTML = "<li style='padding:15px'>Loading...</li>";

    // Use your ROOT variable
    const res = await fetch(
      `${ROOT}/Community/getMembers?community_id=${communityId}`
    );
    const data = await res.json();

    // Update Count
    memberCountLabel.textContent = data.count;

    // Render List
    memberListContainer.innerHTML = "";

    if (data.list.length === 0) {
      memberListContainer.innerHTML =
        "<li style='padding:15px'>No members found.</li>";
      return;
    }

    data.list.forEach((member) => {
      const initial = member.name.charAt(0).toUpperCase();

      // Set different colors for different roles
      let color = "#999";
      if (member.role === "Teacher") color = "#1E2A5E";
      if (member.role === "Student") color = "#28a745";

      memberListContainer.innerHTML += `
                <li class="member-item">
                    <div class="member-avatar" style="background-color:${color}">
                        ${initial}
                    </div>
                    <div>
                        <div style="font-weight:bold; font-size:14px;">${member.name}</div>
                        <div style="font-size:11px; color:#666;">${member.role}</div>
                    </div>
                </li>
            `;
    });
  } catch (error) {
    console.error("Error fetching members:", error);
    memberListContainer.innerHTML =
      "<li style='padding:15px; color:red;'>Error loading list</li>";
  }
}
