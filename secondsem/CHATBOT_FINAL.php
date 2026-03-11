<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    session_start();

    define('DEFAULT_FALLBACK', "I'm not sure I got that. Try mentioning a skill or type 'reset' to restart.");

    function reply($text) {
        echo json_encode(["response" => $text]);
        exit;
    }

    if (isset($_POST["message"])) {
        $message = strtolower(trim($_POST["message"]));
        if ($message === "") {
            reply("Please type a message.");
        }

        if (in_array($message, ["reset", "restart"])) {
            reply("Conversation reset. How can I assist you today?");
        }

        function normalizeMessage($text) {
            $synonyms = [
                'tip' => ['tips', 'tip', 'advice', 'suggestion', 'suggestions'],
                'programmer' => ['programmer', 'developer', 'coder'],
                'resume' => ['resume', 'cv', 'curriculum vitae'],
                'communication' => ['talking', 'speaking', 'presenting'],
                'support' => ['helpdesk', 'assistance', 'support'],
                'design' => ['designer', 'creative', 'design'],
                'multilingual' => ['multilingual', 'bilingual', 'polyglot'],
                'visual arts' => ['drawing', 'painting', 'illustration', 'visual arts'],
                'mathematics' => ['math', 'mathematics', 'calculation', 'calculations'],
                'coding' => ['coding', 'programming', 'code'],
                'career suggestion' => ['career suggestions', 'career recommendation', 'career path', 'job path', 'what job', 'what career']
            ];

            $keywords = [];
            foreach ($synonyms as $canonical => $variants) {
                foreach ($variants as $variant) {
                    if (preg_match('/\b' . preg_quote($variant, '/') . '\b/', $text)) {
                        $keywords[] = $canonical;
                        break;
                    }
                }
            }
            return $keywords;
        }

        function keywordSkillMatch($keywords) {
            $entries = [
                [
                    'keywords' => ['bsit', 'information technology'],
                    'response' => "As a BSIT graduate, you can explore careers in web development, network administration, cybersecurity, or data analysis. Upskilling with certifications can give you a competitive edge."
                ],
                [
                    'keywords' => ['tourism', 'tourism management'],
                    'response' => "As a Tourism Management graduate, careers in travel consultancy, event planning, hotel management, and tour operations are great options. Consider building communication and customer service skills."
                ],
                [
                    'keywords' => ['what skill', 'skills needed', 'skills to learn'],
                    'response' => "Some valuable skills include communication, problem-solving, digital literacy, and adaptability. Choose ones that align with your career goals."
                ],
                [
                    'keywords' => ['coding', 'design'],
                    'response' => "You may enjoy front-end or game development combined with creative design."
                ],
                [
                    'keywords' => ['coding', 'programmer'],
                    'response' => "To improve your coding skills, work on real-world projects, contribute to open-source, practice algorithms, and read clean code practices."
                ],
                [
                    'keywords' => ['tip'],
                    'response' => "Keep learning consistently, break problems into smaller parts, and focus on writing clean, readable code."
                ],
                [
                    'keywords' => ['coding', 'programmer', 'career suggestion'],
                    'response' => "If you're good at coding, consider careers like software development, mobile apps, game development, data engineering, or AI/ML. Choose a field that excites you and build focused projects around it."
                ],
                [
                    'keywords' => ['resume'],
                    'response' => "To make your resume stand out, highlight your key skills, achievements, and relevant experience. Tailor it to the job you're applying for."
                ],
                [
                    'keywords' => ['interview'],
                    'response' => "Prepare by researching the company, practicing common interview questions, and highlighting your strengths. Confidence is key!"
                ],
                [
                    'keywords' => ['no experience'],
                    'response' => "If you have no experience, focus on your transferable skills, volunteer work, or relevant coursework. You can also pursue internships or freelance gigs."
                ],
                [
                    'keywords' => ['job hunt'],
                    'response' => "Look for jobs on online platforms like JobStreet, Indeed, or LinkedIn. Networking and referrals can also open opportunities."
                ],
                [
                    'keywords' => ['career growth'],
                    'response' => "Upskilling through online courses, certifications, and consistent learning is vital for career growth."
                ],
                [
                    'keywords' => ['linkedin'],
                    'response' => "Make sure your LinkedIn profile is complete, professional, and highlights your achievements. Engage with industry content to increase visibility."
                ],
                [
                    'keywords' => ['cover letter'],
                    'response' => "A strong cover letter should complement your resume by explaining why you're a great fit for the role and how your skills meet the job's requirements."
                ],
                [
                    'keywords' => ['communication'],
                    'response' => "Strong communication skills are essential in almost every industry. They help you collaborate, present ideas, and resolve conflicts effectively."
                ],
                [
                    'keywords' => ['support'],
                    'response' => "Support-related careers include helpdesk, tech support, and customer service roles. Patience, empathy, and technical knowledge are valuable here."
                ],
                [
                    'keywords' => ['multilingual'],
                    'response' => "Being multilingual can open roles in translation, international relations, or teaching foreign languages."
                ],
                [
                    'keywords' => ['visual arts'],
                    'response' => "Visual arts skills are valuable in illustration, design, animation, and creative industries."
                ],
                [
                    'keywords' => ['mathematics'],
                    'response' => "Mathematical strengths can lead to careers in data analysis, finance, engineering, or academia."
                ]
            ];

            foreach ($entries as $entry) {
                foreach ($entry['keywords'] as $keyword) {
                    if (in_array($keyword, $keywords)) {
                        return $entry['response'];
                    }
                }
            }

            return DEFAULT_FALLBACK;
        }

        $keywords = normalizeMessage($message);
        $response = keywordSkillMatch($keywords);
        reply($response);
    } else {
        reply("Invalid request.");
    }

    exit;
}
?>

<!DOCTYPE html><html lang="en"><head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Career Guidance Chatbot</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --dark-blue: #03045E;
      --blue: #0077B6;
      --light-blue: #00B4D8;
      --lighter-blue: #90E0EF;
      --lightest-blue: #CAF0FB;
      --text-dark: #222;
      --text-light: #fff;
      --light-gray: #f1f1f1;
    }body {
  margin: 0;
  font-family: 'Inter', 'Segoe UI', sans-serif;
  background: radial-gradient(circle at top left, var(--blue), var(--dark-blue));
  color: var(--text-light);
  height: 100vh;
}

.chat-wrapper {
  display: flex;
  height: 100vh;
}

.sidebar {
  width: 240px;
  background: #dcdcdc;
  color: var(--text-dark);
  display: flex;
  flex-direction: column;
  border-right: 1px solid #ccc;
  height: 100vh;
  overflow: hidden;
}

.sidebar-actions {
  display: flex;
  justify-content: space-between;
  gap: 8px;
  padding: 10px 16px;
}

.sidebar button {
  flex: 1;
  padding: 10px 8px;
  font-size: 0.9rem;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  background: var(--blue);
  color: var(--text-light);
  cursor: pointer;
  transition: background-color 0.3s;
}

.sidebar button:hover {
  background: var(--dark-blue);
}

.history-box {
  flex: 1;
  overflow-y: auto;
  padding: 0 16px;
  margin-top: 20px;
  background-color: #bbb; /* darker background */
  border-top: 1px solid #aaa;
}

.history-entry {
  padding: 6px 0;
  font-weight: 600;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #ccc;
  cursor: pointer;
  line-height: 1.2;
}

.history-entry span {
  flex: 1;
  padding-right: 16px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.history-entry:hover {
  background: #eaeaea;
}

.delete-button {
  align-self: center;
  height: 28px;
  background: #333;     
  color: white;            
  border: none;
  padding: 4px 10px;
  border-radius: 6px;
  font-size: 0.8rem;
  cursor: pointer;
}

.chat-container {
  flex: 1;
  background: var(--lightest-blue);
  display: flex;
  flex-direction: column;
}

.chat-title {
  background: linear-gradient(90deg, var(--lighter-blue), var(--lightest-blue));
  padding: 30px 0;
  text-align: center;
  font-size: clamp(2rem, 4vw, 2.8rem);
  font-weight: 700;
  letter-spacing: -0.5px;
  color: var(--dark-blue);
  border-bottom: 3px solid var(--blue);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
  text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.3);
}

.chat-box {
  flex: 1;
  padding: 32px;
  overflow-y: auto;
  border-left: 6px solid var(--dark-blue);
  border-right: 6px solid var(--blue);
  max-height: calc(100% - 160px);
  background: var(--lightest-blue);
}

.message {
  max-width: 65%;
  padding: 14px 20px;
  margin: 14px 0;
  border-radius: 22px;
  font-size: clamp(1rem, 1.2vw, 1.15rem);
  line-height: 1.6;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.message.user {
  background-color: var(--dark-blue);
  color: var(--text-light);
  align-self: flex-end;
  border-bottom-right-radius: 0;
  margin-left: auto; /* push to right edge */
}

.message.bot {
  background-color: var(--light-blue);
  align-self: flex-start;
  border-bottom-left-radius: 0;
  margin-right: auto; /* push to left edge */
}

.input-box {
  display: flex;
  padding: 20px 32px;
  background: var(--blue);
}

input[type="text"] {
  flex: 1;
  padding: 14px 20px;
  font-size: 1.05rem;
  border-radius: 30px;
  border: 2px solid var(--lightest-blue);
  outline: none;
  transition: border-color 0.3s;
}

input[type="text"]:focus {
  border-color: var(--dark-blue);
}

.input-box button {
  background: var(--dark-blue);
  margin-left: 12px;
  border-radius: 30px;
  padding: 0 28px;
  color: var(--lightest-blue);
  font-weight: bold;
  font-size: 1.05rem;
  border: none;
  cursor: pointer;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
  transition: background-color 0.3s;
}

.input-box button:hover {
  background: var(--blue);
}

  </style>
</head>
<body>
  <div class="chat-wrapper">
<div class="sidebar">
  <div class="sidebar-actions">
    <button onclick="startNewChat()">New</button>
    <button onclick="clearAllChats()">Clear</button>
  </div>
  <div id="history-box" class="history-box"></div>
</div>
    <div class="chat-container">
  <h1 class="chat-title"><span style="margin-right: 10px;">💼</span>Career Advice Chatbot</h1>
  <div id="chat-box" class="chat-box"></div>
  <div class="input-box">
    <input type="text" id="message" placeholder="Type your message..." autocomplete="off" autofocus />
    <button onclick="sendMessage()">Send</button>
  </div>
</div>

  </div> 
  <script>
    const chatBox = document.getElementById('chat-box');
    const historyBox = document.getElementById('history-box');
    const inputField = document.getElementById('message');
    const sendButton = document.querySelector('button[onclick="sendMessage()"]');

    let allChats = JSON.parse(localStorage.getItem('all_chat_sessions') || '[]');
    let currentSession = [];
    let typingInterval;

    
    window.addEventListener('DOMContentLoaded', () => {
  allChats = JSON.parse(localStorage.getItem('all_chat_sessions') || '[]');
  const saved = localStorage.getItem('chat_history');
  if (saved) {
    const messages = JSON.parse(saved);
    currentSession = messages;
    renderChat(messages);
  }
  renderHistory(); // <- Load sidebar history
});

    function renderChat(messages) {
      chatBox.innerHTML = '';
      messages.forEach(({ type, content }) => {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message', type);
        messageDiv.textContent = content;
        chatBox.appendChild(messageDiv);
      });
      chatBox.scrollTop = chatBox.scrollHeight;
    }
    
    function renderHistory() {
  const historyBox = document.getElementById('history-box');
  historyBox.innerHTML = '';
  const history = JSON.parse(localStorage.getItem('all_chat_sessions') || '[]');

  if (history.length === 0) {
    historyBox.innerHTML = '<em>No previous chats.</em>';
  } else {
    history.forEach((chat, idx) => {
      const entry = document.createElement('div');
      entry.classList.add('history-entry');

      const label = document.createElement('span');
      label.textContent = chat.title || `Chat ${idx + 1}`;

      const delBtn = document.createElement('button');
      delBtn.textContent = 'Delete';
      delBtn.className = 'delete-button';
      delBtn.addEventListener('click', (event) => {
        event.stopPropagation();
        deleteChat(idx, event);
      });

      entry.appendChild(label);
      entry.appendChild(delBtn);

      entry.addEventListener('click', () => loadChat(idx));
      historyBox.appendChild(entry);
    });
  }
}

    function appendMessage(content, type) {
      const messageDiv = document.createElement('div');
      messageDiv.classList.add('message', type);
      messageDiv.textContent = content;
      chatBox.appendChild(messageDiv);
      chatBox.scrollTop = chatBox.scrollHeight;

      currentSession.push({ type, content });
      localStorage.setItem('chat_history', JSON.stringify(currentSession));
    }

    function startTypingAnimation(container) {
      let dots = 1;
      typingInterval = setInterval(() => {
        container.textContent = 'Typing' + '.'.repeat(dots);
        dots = (dots % 3) + 1;
      }, 750);
    }

    function stopTypingAnimation(container, text) {
      clearInterval(typingInterval);
      container.textContent = text;
    }

    function sendMessage() {
      if (sendButton.disabled) return;

      const userMessage = inputField.value.trim().replace(/</g, "&lt;").replace(/>/g, "&gt;");
      if (!userMessage) return;

      appendMessage(userMessage, 'user');
      inputField.value = '';
      sendButton.disabled = true;

      const typingIndicator = document.createElement('div');
      typingIndicator.classList.add('message', 'bot', 'typing');
      typingIndicator.textContent = 'Typing';
      chatBox.appendChild(typingIndicator);
      chatBox.scrollTop = chatBox.scrollHeight;
      startTypingAnimation(typingIndicator);

      fetch(window.location.href, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `message=${encodeURIComponent(userMessage)}`
      })
      .then(response => response.json())
      .then(data => {
let index = 0;
const fullText = data.response;
const messageDiv = document.createElement('div');
messageDiv.classList.add('message', 'bot');
messageDiv.textContent = '';
chatBox.removeChild(typingIndicator);
chatBox.appendChild(messageDiv);
chatBox.scrollTop = chatBox.scrollHeight;

function typeNextChar() {
  if (index < fullText.length) {
    messageDiv.textContent += fullText.charAt(index);
    index++;
    chatBox.scrollTop = chatBox.scrollHeight;
    setTimeout(typeNextChar, 20); // speed of typing (lower = faster)
  } else {
    currentSession.push({ type: 'bot', content: fullText });
    localStorage.setItem('chat_history', JSON.stringify(currentSession));
    sendButton.disabled = false;
  }
}
typeNextChar();
      })
      .catch(() => {
        chatBox.removeChild(typingIndicator);
        appendMessage("Sorry, something went wrong. Please try again.", 'bot');
        sendButton.disabled = false;
      });
    }

    inputField.addEventListener('keypress', function(event) {
      if (event.key === 'Enter') {
        sendMessage();
      }
    });

    function loadChat(index) {
  const all = JSON.parse(localStorage.getItem('all_chat_sessions') || '[]');
  if (all[index]) {
    currentSession = all[index].messages; // Fix: access messages array
    localStorage.setItem('chat_history', JSON.stringify(currentSession));
    renderChat(currentSession);
  }
}

    function deleteChat(index, event) {
      event.stopPropagation();
      if (!confirm('Delete this chat?')) return;
      const all = JSON.parse(localStorage.getItem('all_chat_sessions') || '[]');
      all.splice(index, 1);
      localStorage.setItem('all_chat_sessions', JSON.stringify(all));
      renderHistory();
    }

    function startNewChat() {
  allChats = JSON.parse(localStorage.getItem('all_chat_sessions') || '[]');

  const userMessages = currentSession.filter(msg => msg.type === 'user');
  if (userMessages.length > 0) {
    const firstUserMessage = userMessages[0].content;
    allChats.push({
      title: firstUserMessage.slice(0, 40),
      messages: currentSession
    });
    localStorage.setItem('all_chat_sessions', JSON.stringify(allChats));
  }

  currentSession = [];
  localStorage.removeItem('chat_history');
  chatBox.innerHTML = '';
  historyBox.innerHTML = '';
  
  renderHistory();
}

    function clearAllChats() {
      if (confirm('Are you sure you want to delete all chat history?')) {
        localStorage.removeItem('chat_history');
        localStorage.removeItem('all_chat_sessions');
        chatBox.innerHTML = '';
        historyBox.innerHTML = '';
        currentSession = [];
        allChats = [];
        
        renderHistory();
      }
    }
  </script>
  </body>
</html>