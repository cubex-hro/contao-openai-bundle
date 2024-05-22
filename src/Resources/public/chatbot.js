// chatbot.js
document.addEventListener('DOMContentLoaded', function() {
    const chatContainer = document.getElementById('chat-container');
    const toggleChat = document.getElementById('toggle-chat');

    toggleChat.addEventListener('click', function() {
        if (chatContainer.classList.contains('minimized')) {
            chatContainer.classList.remove('minimized');
            chatContainer.classList.add('maximized');
        } else {
            chatContainer.classList.remove('maximized');
            chatContainer.classList.add('minimized');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const sendButton = document.getElementById('send-btn');
    const messagesContainer = document.getElementById('messages');
    let chatHistory = [];

    sendButton.addEventListener('click', function() {
        const userInput = document.getElementById('user-input').value;
        if (userInput.trim() !== '') {
            chatHistory.push({ role: 'user', content: userInput });
            displayMessage(userInput, 'user');
            sendMessage(chatHistory);
            document.getElementById('user-input').value = ''; // Clear the input after sending
        }
    });

    function sendMessage(chatHistory) {
        console.log(JSON.stringify({ messages: chatHistory }));
        console.log("Sending messages to server:", chatHistory);  // Log the history being sent
        fetch('/_chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ messages: chatHistory })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                } else {
                    return response.json();
                }
            })
            .then(data => {
                console.log("Received data:", data);  // Check what data is received
                if (!data.reply) {
                    displayMessage('No response received.', 'bot');
                } else {
                    displayMessage(data.reply, 'bot');
                    chatHistory.push({ role: 'assistant', content: data.reply });
                }
            })
            .catch(error => {
                console.error('Error sending message:', error);
                displayMessage('No response received.', 'bot');
            });
    }

    function displayMessage(message, sender) {
        const messagesContainer = document.getElementById('messages');
        const messageElement = document.createElement('div');
        messageElement.className = sender; // 'user' oder 'bot'
        messageElement.textContent = message;
        messagesContainer.appendChild(messageElement);

        // Scrollen zum neuesten Nachrichtenelement
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
});