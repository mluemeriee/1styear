<!DOCTYPE html><html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Career Guidance Chatbot</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .chat-container {
      width: 100%;
      max-width: 600px;
      background: #fff;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
    }
    .chat-box {
      flex: 1;
      overflow-y: auto;
      max-height: 60vh;
      margin-bottom: 15px;
      padding: 15px;
    }
    .message {
      padding: 12px 18px;
      border-radius: 12px;
      margin: 10px 0;
      max-width: 80%;
      line-height: 1.5;
    }
    .user {
      background: #cce5ff;
      align-self: flex-end;
      border-bottom-right-radius: 0;
    }
    .bot {
      background: #e2e2e2;
      align-self: flex-start;
      border-bottom-left-radius: 0;
    }
    .input-box {
      display: flex;
    }
    input[type=text] {
      flex: 1;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 10px 0 0 10px;
      font-size: 16px;
    }
    button {
      padding: 12px 18px;
      border: none;
      background: #007bff;
      color: white;
      font-size: 16px;
      border-radius: 0 10px 10px 0;
      cursor: pointer;
    }
    .typing {
      font-style: italic;
      color: gray;
    }
  </style>
</head>
<body>
  <div class="chat-container">
    <div id="chat-box" class="chat-box"></div>
    <div class="input-box">
      <input type="text" id="message" placeholder="Type your message..." autocomplete="off" autofocus />
      <button onclick="sendMessage()">Send</button>
    </div>
  </div>  <script>
    const chatBox = document.getElementById('chat-box');
    const inputField = document.getElementById('message');
    const sendButton = document.querySelector('button');

    function appendMessage(content, type) {
      const messageDiv = document.createElement('div');
      messageDiv.classList.add('message', type);
      messageDiv.textContent = content;
      chatBox.appendChild(messageDiv);
      chatBox.scrollTop = chatBox.scrollHeight;
    }

    function sendMessage() {
      const userMessage = inputField.value.trim().replace(/</g, "&lt;").replace(/>/g, "&gt;");
      if (!userMessage) return;

      appendMessage(userMessage, 'user');
      inputField.value = '';
      sendButton.disabled = true;

      const typingIndicator = document.createElement('div');
      typingIndicator.classList.add('message', 'bot', 'typing');
      typingIndicator.textContent = 'Typing...';
      chatBox.appendChild(typingIndicator);
      chatBox.scrollTop = chatBox.scrollHeight;

      fetch('', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `message=${encodeURIComponent(userMessage)}`
      })
      .then(response => response.json())
      .then(data => {
        setTimeout(() => {
          chatBox.removeChild(typingIndicator);
          appendMessage(data.response, 'bot');
          sendButton.disabled = false;
        }, 600);
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
  </script><?php
// PHP logic starts here
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["message"])) {
    header('Content-Type: application/json');

    $message = strtolower(preg_replace('/\s+/', ' ', trim($_POST["message"])));
    if ($message === "") {
        echo json_encode(["response" => "Please type a message."]);
        exit;
    }

    if ($message === "reset" || $message === "restart") {
        $_SESSION['state'] = 'initial';
        echo json_encode(["response" => "Conversation reset. How can I assist you today?"]);
        exit;
    }

    $response = "I'm not sure how to respond to that.";

    if (!isset($_SESSION['state'])) {
        $_SESSION['state'] = 'initial';
    }

    function generalSkillMatch($message) {
        $concepts = [
            [['writing code efficiently'], 'Efficient coders are valued in DevOps, systems programming, and performance engineering.'],
            [['writing'], 'You might enjoy careers like content creation, copywriting, journalism, or technical writing.'],
            [['problem-solving'], 'Ideal roles: software engineer, data analyst, cybersecurity expert, business strategist.'],
            [['creativity'], 'Creatives thrive in graphic design, marketing, advertising, or video production.'],
            [['communication', 'people skills'], 'Explore careers in public relations, human resources, teaching, or sales.'],
            [['attention to detail'], 'Consider quality assurance, editing, accounting, or data entry.'],
            [['leadership'], 'Valuable in project management, operations, entrepreneurship, or executive roles.'],
            [['analytical thinking'], 'Great for market research, finance, and data science careers.'],
            [['empathy'], 'Ideal for counseling, social work, nursing, or customer service.'],
            [['technical aptitude', 'tech'], 'Consider IT specialist, systems engineer, or network administrator roles.'],
            [['bilingual', 'multilingual'], 'Careers include translator, diplomat, international sales, or global support.'],
            [['organization'], 'Great for event planning, project coordination, or operations management.'],
            [['mathematics'], 'Try accounting, actuarial science, finance, or data analysis.'],
            [['public speaking'], 'Consider teaching, motivational speaking, sales, or law.'],
            [['coding'], 'Explore software/app development, game design, or machine learning.'],
            [['research'], 'Relevant fields: UX research, market analysis, academic, or policy work.'],
            [['design'], 'Ideal for UI/UX, product design, fashion, or interior design.'],
            [['critical thinking'], 'Valuable for law, research, analysis, or consulting careers.'],
            [['multitasking'], 'Useful in operations, healthcare, or executive support.'],
            [['negotiation'], 'Great for real estate, procurement, or business development.'],
            [['scientific knowledge'], 'Explore biotech, research, or environmental science careers.'],
            [['visual arts'], 'Consider illustration, animation, or gallery management.'],
            [['music'], 'Options: composing, sound engineering, or music teaching.'],
            [['physical fitness'], 'Careers in personal training, physiotherapy, or sports coaching.'],
            [['empirical thinking'], 'Try data science, lab research, or evidence-based consulting.'],
            [['interpersonal skills'], 'Useful in HR, hospitality, counseling, or social work.'],
            [['salesmanship'], 'Consider sales leadership, real estate, or account management.'],
            [['financial planning'], 'Try financial advising, auditing, or investment banking.'],
            [['time management'], 'Valuable for logistics, admin, and project management roles.'],
            [['video editing'], 'Work in media production, social content, or marketing.'],
            [['translate languages'], 'Pursue careers as translator, interpreter, or multilingual support.']
        ];

        foreach ($concepts as [$keywords, $reply]) {
            foreach ($keywords as $kw) {
                if (strpos($message, $kw) !== false) {
                    return $reply;
                }
            }
        }
        return null;
    }

    if ($_SESSION['state'] === 'initial') {
        if (preg_match('/\b(fit for me|what job|course)\b/', $message)) {
            $_SESSION['state'] = 'ask_skill';
            $response = "What skill are you most confident in? (e.g., programming, communication, design, analysis, leadership)";
        } elseif (strpos($message, "tourism") !== false && strpos($message, "graduate") !== false) {
            $_SESSION['state'] = 'ask_tourism';
            $response = "What area in tourism are you good at? (e.g., communication, organizing events, guiding tours)";
        } elseif (strpos($message, "resume") !== false) {
            $response = "A resume highlights your skills, education, and experience.";
        } elseif (preg_match('/\binterview\b.*\btips\b/', $message)) {
            $response = "Research the company beforehand, practice common questions, and be confident.";
        } elseif (preg_match('/\b(highest paying job|highest salary)\b/', $message)) {
            $response = "Software Engineering, Medicine, and Law are among the highest-paying fields.";
        } elseif (preg_match('/\b(no experience|first job)\b/', $message)) {
            $response = "Try applying for internships or entry-level roles.";
        } elseif (strpos($message, "bsit") !== false && strpos($message, "graduate") !== false) {
            $_SESSION['state'] = 'ask_bsit';
            $response = "You're a BSIT graduate! What skill are you best at? (e.g., web development, system analysis, IT support)";
        } else {
            $fallback = generalSkillMatch($message);
            if ($fallback) {
                $response = $fallback;
            }
        }
    } elseif ($_SESSION['state'] === 'ask_bsit' || $_SESSION['state'] === 'ask_tourism' || $_SESSION['state'] === 'ask_skill') {
        $matched = false;
        if ($_SESSION['state'] === 'ask_bsit') {
            if (strpos($message, "web") !== false) {
                $response = "You can become a Front-End Developer, Web Designer, or Full-Stack Developer.";
                $matched = true;
            } elseif (strpos($message, "system") !== false || strpos($message, "analysis") !== false) {
                $response = "You might be suited for roles like System Analyst or Business Analyst.";
                $matched = true;
            } elseif (strpos($message, "it support") !== false || strpos($message, "support") !== false) {
                $response = "You could work as a Technical Support Specialist or IT Helpdesk.";
                $matched = true;
            }
        } elseif ($_SESSION['state'] === 'ask_tourism') {
            if (strpos($message, "communication") !== false) {
                $response = "You might thrive in guest relations, tour guiding, or travel consultancy.";
                $matched = true;
            } elseif (strpos($message, "event") !== false) {
                $response = "You could be an Event Coordinator or Corporate Events Planner.";
                $matched = true;
            } elseif (strpos($message, "guide") !== false || strpos($message, "tour") !== false) {
                $response = "You can work as a Tour Guide, Local Guide, or Cultural Presenter.";
                $matched = true;
            }
        } elseif ($_SESSION['state'] === 'ask_skill') {
            if (strpos($message, "programming") !== false || strpos($message, "tech") !== false) {
                $response = "You could become a Web Developer, Software Engineer, or Mobile App Developer.";
                $matched = true;
            } elseif (strpos($message, "communication") !== false) {
                $response = "You may excel in Public Relations, Customer Support, or Human Resources.";
                $matched = true;
            } elseif (strpos($message, "design") !== false) {
                $response = "You might enjoy being a Graphic Designer, UI/UX Designer, or Visual Content Creator.";
                $matched = true;
            } elseif (strpos($message, "analysis") !== false) {
                $response = "Consider roles like Data Analyst, Business Analyst, or Market Researcher.";
                $matched = true;
            } elseif (strpos($message, "leadership") !== false) {
                $response = "You might be suited for Management, Project Leadership, or Entrepreneurial roles.";
                $matched = true;
            }
        }

        if (!$matched) {
            $fallback = generalSkillMatch($message);
            $response = $fallback ?: "Please mention a skill relevant to this context or type 'reset' to start over.";
        }

        $_SESSION['state'] = 'done';
    } elseif ($_SESSION['state'] === 'done') {
        $_SESSION['state'] = 'initial';
        $response = "You can ask me another question now!";
    }

    echo json_encode(["response" => $response]);
    exit;
}
?>
</body>
</html>