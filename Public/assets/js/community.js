const messagesArea = document.getElementById("messages-area");
const messageInput = document.getElementById("message-input");
const sendButton = document.getElementById("send-button");

console.log("message");
// Fetch only new messages
async function fetchMessages() {
  try {
    const response = await fetch(
      `Community/fetchMessages?community_id=${communityId}&last_message_id=${lastMessageId}`
    );
    const messages = await response.json();
    console.log(messages);

    messages.forEach((msg) => {
      if (msg.id > lastMessageId) {
        const div = document.createElement("div");
        div.classList.add("message");

        // check if message belongs to current user
        const isMine = msg.user_id == CURRENT_USER_ID;
        if (isMine) div.classList.add("my-message");

        div.id = "msg-" + msg.id;
        div.innerHTML = `
          <div class="message-text">
            <strong>${msg.username}:</strong>${msg.message}
          </div>
        `;

        messagesArea.appendChild(div);

        // Update last message ID
        lastMessageId = msg.id;
      }
    });
  } catch (error) {
    console.error("Fetch error:", error);
  }
}

// Send a new message
async function sendMessage() {
  const message = messageInput.value.trim();
  console.log(message);
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

sendButton.addEventListener("click", sendMessage);

// Poll every 1 second
setInterval(fetchMessages, 1000);

// Initial fetch
fetchMessages();

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

// popup window for post creation

const openBtn = document.getElementById("openPostBtn");
const modal = document.getElementById("postModal");
const closeBtn = document.getElementById("closePostBtn");
const cancelBtn = document.getElementById("cancelPostBtn");

openBtn.onclick = () => (modal.style.display = "flex");
closeBtn.onclick = () => (modal.style.display = "none");
cancelBtn.onclick = () => (modal.style.display = "none");

//popup window for post aprovel
const approvalModal = document.getElementById("approval-popup");

// Click outside closes modal
window.onclick = (e) => {
  if (e.target === modal) modal.style.display = "none";
};
