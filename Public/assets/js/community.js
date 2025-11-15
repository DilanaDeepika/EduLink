document.addEventListener("DOMContentLoaded", () => {
  const messagesArea = document.getElementById("messages-area");
  const messageInput = document.getElementById("message-input");
  const sendButton = document.getElementById("send-button");

  // --- Function to add a message to the chat ---
  function addMessage(author, text, type) {
    const messageDiv = document.createElement("div");
    messageDiv.classList.add("message", type);

    const bubbleDiv = document.createElement("div");
    bubbleDiv.classList.add("bubble");

    const authorP = document.createElement("p");
    authorP.classList.add("author");
    authorP.textContent = author;

    const textP = document.createElement("p");
    textP.textContent = text;

    bubbleDiv.appendChild(authorP);
    bubbleDiv.appendChild(textP);
    messageDiv.appendChild(bubbleDiv);

    messagesArea.appendChild(messageDiv);

    // Scroll to the latest message
    messagesArea.scrollTop = messagesArea.scrollHeight;
  }

  // --- Function to handle sending a message ---
  function sendMessage() {
    const messageText = messageInput.value.trim();
    if (messageText !== "") {
      addMessage("You", messageText, "sent");

      messageInput.value = "";
    }
  }
});
