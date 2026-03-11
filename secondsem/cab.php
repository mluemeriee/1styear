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
                'coding' => ['coding', 'programming', 'code', 'interview'],
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


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Career Guidance Chatbot</title>
  <style>
    :root {
  --space-navy:   #03122F;    
  --andmiral-blue: #19305C;         
  --mystic-purple: #413B61;  
  --orchid-mist:  #AE7DAC; 
  --sunset-orange:  #FD916D;
  --text-dark: #222;
  --text-light: #fff;
}

    

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, var(--space-navy), var(--andmiral-blue));
      color: var(--text-light);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
    }

    .chat-container {
      background: var(--sunset-orange);
      max-width: 400px;
      width: 100%;
      height: 600px;
      border-radius: 15px;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
      color: var(--text-dark);
    }

    .chat-box {
      flex: 1;
      padding: 10px 15px;
      background: var(--burgundy:);
      overflow-y: auto;
      border-left: 4px solid var(--space-navy);
      border-right: 4px solid var(--andmiral-blue);
    }

    .history-box {
      display: none;
      max-height: 150px;
      overflow-y: auto;
      background-color: var(--orchid-mist);
      padding: 10px;
      font-size: 0.85rem;
      border-top: 2px solid var(--andmiral-blue);
      border-bottom: 2px solid var(--andmiral-blue);
    }

    .history-entry {
      cursor: pointer;
      margin: 5px 0;
      padding: 5px 10px;
      background-color: var(--mystic-purple);
      border-radius: 6px;
      color: var(--text-dark);
      transition: background-color 0.2s;
    }

    .history-entry:hover {
      background-color: var(--andmiral-blue);
      color: var(--text-light);
    }

    .message {
      margin: 10px 0;
      max-width: 80%;
      padding: 8px 15px;
      border-radius: 20px;
      line-height: 1.3;
      font-size: 0.95rem;
    }

    .message.bot {
      background-color: var(--mystic-purple);
      align-self: flex-start;
      border-bottom-left-radius: 0;
    }

    .message.user {
      background-color: var(--space-navy);
      color: var(--text-light);
      align-self: flex-end;
      border-bottom-right-radius: 0;
    }

    .message.typing {
      font-style: italic;
      opacity: 0.7;
    }

    .input-box {
      display: flex;
      padding: 10px 15px;
      background: var(--andmiral-blue);
    }

    input[type="text"] {
      flex: 1;
      border: none;
      border-radius: 25px;
      padding: 10px 15px;
      font-size: 1rem;
      outline: none;
      border: 2px solid var(--sunset-orange);
      transition: border-color 0.3s ease;
    }

    input[type="text"]:focus {
      border-color: var(--space-navy);
    }

    .input-box button {
      background: var(--space-navy);
      border: none;
      margin-left: 10px;
      border-radius: 25px;
      padding: 0 20px;
      color: var(--burgundy:);
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .input-box button:hover,
    .input-box button:focus {
      background: var(--andmiral-blue);
    }

    .bottom-controls {
      display: flex;
      justify-content: space-between;
      padding: 10px 15px;
      background: var(--sunset-orange);
      flex-wrap: wrap;
      gap: 5px;
    }

    .bottom-controls button {
      background: var(--orchid-mist);
      border: none;
      color: var(--text-light);
      padding: 8px 12px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      flex: 1;
    }

    .chat-box::-webkit-scrollbar {
      width: 8px;
    }

    .chat-box::-webkit-scrollbar-thumb {
      background: var(--space-navy);
      border-radius: 5px;
    }

    @media (max-width: 400px) {
      body {
        padding: 5px;
      }
      .chat-container {
        height: 100vh;
        max-width: 100%;
        border-radius: 0;
      }
    }
  </style>
</head>
<body>
  <div class="chat-container">
    <div id="chat-box" class="chat-box"></div>
    <div id="history-box" class="history-box"></div>
    <div class="input-box">
      <input type="text" id="message" placeholder="Type your message..." autocomplete="off" autofocus />
      <button onclick="sendMessage()">Send</button>
    </div>
    <div class="bottom-controls">
      <button onclick="startNewChat()">New Chat</button>
      <button onclick="toggleHistory()">Show History</button>
      <button onclick="clearAllChats()">Clear All</button>
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
      const saved = localStorage.getItem('chat_history');
      if (saved) {
        const messages = JSON.parse(saved);
        currentSession = messages;
        renderChat(messages);
      }
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
        const delay = Math.min(3000, data.response.length * 30);
        setTimeout(() => {
          chatBox.removeChild(typingIndicator);
          stopTypingAnimation(typingIndicator, '');
          appendMessage(data.response, 'bot');
          sendButton.disabled = false;
        }, delay);
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

    function toggleHistory() {
      if (historyBox.style.display === 'block') {
        historyBox.style.display = 'none';
        historyBox.innerHTML = '';
      } else {
        const history = JSON.parse(localStorage.getItem('all_chat_sessions') || '[]');
        historyBox.innerHTML = history.length
          ? history.map((_, idx) =>
              `<div class='history-entry'>
                <span onclick='loadChat(${idx})'>Chat ${idx + 1}</span>
                <button style="float:right;background:red;color:white;border:none;padding:2px 6px;border-radius:4px;font-size:0.8rem"
                        onclick='deleteChat(${idx}, event)'>Delete</button>
              </div>`
            ).join('')
          : '<em>No previous chats.</em>';
        historyBox.style.display = 'block';
      }
    }

    function loadChat(index) {
      const all = JSON.parse(localStorage.getItem('all_chat_sessions') || '[]');
      if (all[index]) {
        currentSession = all[index];
        localStorage.setItem('chat_history', JSON.stringify(currentSession));
        renderChat(currentSession);
        historyBox.style.display = 'none';
      }
    }

    function deleteChat(index, event) {
      event.stopPropagation();
      if (!confirm('Delete this chat?')) return;
      const all = JSON.parse(localStorage.getItem('all_chat_sessions') || '[]');
      all.splice(index, 1);
      localStorage.setItem('all_chat_sessions', JSON.stringify(all));
      toggleHistory();
      toggleHistory();
    }

    function startNewChat() {
      if (currentSession.length > 0) {
        allChats.push(currentSession);
        localStorage.setItem('all_chat_sessions', JSON.stringify(allChats));
      }
      currentSession = [];
      localStorage.removeItem('chat_history');
      chatBox.innerHTML = '';
      historyBox.innerHTML = '';
      historyBox.style.display = 'none';
    }

    function clearAllChats() {
      if (confirm('Are you sure you want to delete all chat history?')) {
        localStorage.removeItem('chat_history');
        localStorage.removeItem('all_chat_sessions');
        chatBox.innerHTML = '';
        historyBox.innerHTML = '';
        historyBox.style.display = 'none';
        currentSession = [];
        allChats = [];
      }
    }
  </script>
</body>
</html>