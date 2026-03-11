<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["message"])) {
    header('Content-Type: application/json');

    $message = strtolower(trim($_POST["message"]));
    if ($message === "") {
        echo json_encode(["response" => "Please type a message."]);
        return;
    }

//hi

    $response = "I'm not sure how to respond to that.";

    if (!isset($_SESSION['state'])) {
        $_SESSION['state'] = 'initial';
    }

    if ($_SESSION['state'] === 'initial') {
        if (strpos($message, "fit for me") !== false || strpos($message, "what job") !== false || strpos($message, "course") !== false) {
            $_SESSION['state'] = 'ask_skill';
            $response = "What skill are you most confident in? (e.g., programming, communication, design, analysis, leadership)";
        } elseif (strpos($message, "tourism") !== false && strpos($message, "graduate") !== false) {
            $_SESSION['state'] = 'ask_tourism';
            $response = "What area in tourism are you good at? (e.g., communication, organizing events, guiding tours)";
        } elseif (strpos($message, "resume") !== false) {
            $options = [
                "A resume highlights your skills, education, and experience.",
                "A well-written resume can help you stand out to employers.",
                "Tailor your resume to match the job you're applying for."
            ];
            $response = $options[array_rand($options)];
        } elseif (strpos($message, "interview") !== false && strpos($message, "tips") !== false) {
            $options = [
                "Research the company beforehand.",
                "Practice common questions and be confident.",
                "Dress appropriately and arrive early."
            ];
            $response = $options[array_rand($options)];
        } elseif (strpos($message, "highest paying job") !== false || strpos($message, "highest salary") !== false) {
            $options = [
                "Software Engineering, Medicine, and Law are among the highest-paying fields.",
                "IT, Engineering, and Healthcare jobs tend to have high salaries.",
                "Data Science, AI, and Finance roles also pay well."
            ];
            $response = $options[array_rand($options)];
        } elseif (strpos($message, "no experience") !== false || strpos($message, "first job") !== false) {
            $options = [
                "Try applying for internships or entry-level roles.",
                "Start with part-time work or freelancing.",
                "Volunteering can also help build experience."
            ];
            $response = $options[array_rand($options)];
        } elseif (strpos($message, "bsit") !== false && strpos($message, "graduate") !== false) {
            $_SESSION['state'] = 'ask_bsit';
            $response = "You're a BSIT graduate! What skill are you best at? (e.g., web development, system analysis, IT support)";
        } elseif (strpos($message, "writing") !== false) {
            $response = "Since you're good at writing, you might enjoy careers like content creation, copywriting, journalism, or technical writing.";
        } elseif (strpos($message, "problem-solving") !== false) {
            $response = "Strong problem-solving skills are ideal for roles like software engineer, data analyst, cybersecurity expert, or business strategist.";
        } elseif (strpos($message, "creativity") !== false) {
            $response = "Creative individuals often thrive in fields like graphic design, marketing, advertising, or video production.";
        } elseif (strpos($message, "communication") !== false) {
            $response = "Excellent communicators can explore careers in public relations, human resources, teaching, or sales.";
        } elseif (strpos($message, "attention to detail") !== false) {
            $response = "If you're detail-oriented, consider roles like quality assurance analyst, editor, accountant, or data entry specialist.";
        } elseif (strpos($message, "leadership") !== false) {
            $response = "Leadership skills are valuable in careers like project management, operations management, entrepreneurship, or executive roles.";
        } elseif (strpos($message, "analytical thinking") !== false) {
            $response = "If you're analytical, you may excel in careers such as market research analyst, financial analyst, or data scientist.";
        } elseif (strpos($message, "empathy") !== false) {
            $response = "Empathetic individuals often thrive as counselors, social workers, nurses, or in customer service roles.";
        } elseif (strpos($message, "technical aptitude") !== false) {
            $response = "Strong technical skills can lead to roles like IT specialist, network administrator, or systems engineer.";
        } elseif (strpos($message, "bilingual") !== false || strpos($message, "multilingual") !== false) {
            $response = "Knowing multiple languages opens doors to careers like translator, diplomat, international sales rep, or global customer support.";
        } elseif (strpos($message, "organization") !== false) {
            $response = "Organized people excel as executive assistants, event planners, project coordinators, or operations managers.";
        } elseif (strpos($message, "mathematics") !== false) {
            $response = "Consider accounting, actuarial science, data analysis, or finance.";
        } elseif (strpos($message, "public speaking") !== false) {
            $response = "Confident speakers often do well in careers like motivational speaking, teaching, sales, or law.";
        } elseif (strpos($message, "coding") !== false) {
            $response = "If you can code, explore careers in software development, app development, machine learning, or game design.";
        } elseif (strpos($message, "research") !== false) {
            $response = "Market research, UX research, academic roles, or policy analysis could be great.";
        } elseif (strpos($message, "design") !== false) {
            $response = "Creative designers thrive in UI/UX design, product design, fashion, or interior design.";
        } elseif (strpos($message, "critical thinking") !== false) {
            $response = "Critical thinkers make great lawyers, analysts, researchers, and consultants.";
        } elseif (strpos($message, "multitasking") !== false) {
            $response = "If you multitask well, consider careers in operations, hospitality, healthcare, or executive support.";
        } elseif (strpos($message, "negotiation") !== false) {
            $response = "Try real estate, law, procurement, or business development.";
        } elseif (strpos($message, "scientific knowledge") !== false) {
            $response = "If you have a strong science background, look into careers in research, biotech, or environmental science.";
        } elseif (strpos($message, "visual arts") !== false) {
            $response = "Artists often succeed in illustration, animation, tattoo artistry, or gallery management.";
        } elseif (strpos($message, "music") !== false) {
            $response = "Musically talented individuals can pursue careers in sound engineering, music teaching, or composing.";
        } elseif (strpos($message, "physical fitness") !== false) {
            $response = "Fitness enthusiasts can explore careers like personal training, physiotherapy, or sports coaching.";
        } elseif (strpos($message, "empirical thinking") !== false) {
            $response = "Empirical thinkers do well in data science, laboratory research, or evidence-based consulting.";
        } elseif (strpos($message, "interpersonal skills") !== false) {
            $response = "People with strong interpersonal skills thrive in counseling, social work, HR, or hospitality.";
        } elseif (strpos($message, "salesmanship") !== false) {
            $response = "Try real estate, account management, or sales leadership.";
        } elseif (strpos($message, "financial planning") !== false) {
            $response = "If you're good at budgeting and planning, try financial advising, investment banking, or auditing.";
        } elseif (strpos($message, "time management") !== false) {
            $response = "Great time managers succeed in project management, logistics, and administrative roles.";
        } elseif (strpos($message, "writing code efficiently") !== false) {
            $response = "Efficient coders are valued in DevOps, systems programming, and performance engineering.";
        } elseif (strpos($message, "video editing") !== false) {
            $response = "Video editors can work in film production, social media, marketing, or freelance media.";
        } elseif (strpos($message, "translate languages") !== false) {
            $response = "You can work as a translator, interpreter, or in multilingual customer support.";
        }
    } elseif ($_SESSION['state'] === 'ask_bsit') {
        if (strpos($message, "web") !== false) {
            $response = "You can become a Front-End Developer, Web Designer, or Full-Stack Developer.";
        } elseif (strpos($message, "system") !== false || strpos($message, "analysis") !== false) {
            $response = "You might be suited for roles like System Analyst or Business Analyst.";
        } elseif (strpos($message, "it support") !== false || strpos($message, "support") !== false) {
            $response = "You could work as a Technical Support Specialist or IT Helpdesk.";
        } else {
            echo json_encode(["response" => "Please mention a skill like web development, system analysis, or IT support."]);
            return;
        }
        $_SESSION['state'] = 'done';
    } elseif ($_SESSION['state'] === 'ask_tourism') {
        if (strpos($message, "communication") !== false) {
            $response = "You might thrive in guest relations, tour guiding, or travel consultancy.";
        } elseif (strpos($message, "event") !== false) {
            $response = "You could be an Event Coordinator or Corporate Events Planner.";
        } elseif (strpos($message, "guide") !== false || strpos($message, "tour") !== false) {
            $response = "You can work as a Tour Guide, Local Guide, or Cultural Presenter.";
        } else {
            $response = "Please mention a skill like communication, organizing events, or guiding tours.";
        }
        $_SESSION['state'] = 'done';
    } elseif ($_SESSION['state'] === 'ask_skill') {
        if (strpos($message, "programming") !== false) {
            $response = "You could become a Web Developer, Software Engineer, or Mobile App Developer.";
        } elseif (strpos($message, "communication") !== false) {
            $response = "You may excel in Public Relations, Customer Support, or Human Resources.";
        } elseif (strpos($message, "design") !== false) {
            $response = "You might enjoy being a Graphic Designer, UI/UX Designer, or Visual Content Creator.";
        } elseif (strpos($message, "analysis") !== false) {
            $response = "Consider roles like Data Analyst, Business Analyst, or Market Researcher.";
        } elseif (strpos($message, "leadership") !== false) {
            $response = "You might be suited for Management, Project Leadership, or Entrepreneurial roles.";
        } else {
            echo json_encode(["response" => "Please mention a skill like programming, communication, design, analysis, or leadership."]);
            return;
        }
        $_SESSION['state'] = 'done';
    } elseif ($_SESSION['state'] === 'done') {
        $_SESSION['state'] = 'initial';
        $response = "You can ask me another question now!";
    }

    echo json_encode(["response" => $response]);
    return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title>Career Advice Bot</title>
<style>
  /* Updated color palette per user request */
  :root {
    --dark-blue: #03045E;
    --blue: #0077B6;
    --light-blue: #00B4D8;
    --lighter-blue: #90E0EF;
    --lightest-blue: #CAF0FB;
    --text-dark: #222;
    --text-light: #fff;
  }

  * {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, var(--dark-blue), var(--blue));
    color: var(--text-light);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
  }

  .bot-container {
    background: var(--lightest-blue);
    max-width: 350px;
    width: 100%;
    height: 600px;
    border-radius: 15px;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    color: var(--text-dark);
  }

  header {
    background: var(--dark-blue);
    padding: 15px 20px;
    color: var(--text-light);
    font-size: 1.25rem;
    font-weight: 700;
    text-align: center;
    user-select: none;
  }

  .subtitle {
    font-weight: 400;
    font-size: 0.9rem;
    margin-top: 4px;
    color: var(--light-blue);
  }

  .chat-area {
    flex: 1;
    padding: 10px 15px;
    background: var(--lightest-blue);
    overflow-y: auto;
    border-left: 4px solid var(--dark-blue);
    border-right: 4px solid var(--blue);
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
    background-color: var(--light-blue);
    align-self: flex-start;
    border-bottom-left-radius: 0;
  }

  .message.user {
    background-color: var(--dark-blue);
    color: var(--text-light);
    align-self: flex-end;
    border-bottom-right-radius: 0;
  }

  form.input-area {
    display: flex;
    padding: 10px 15px;
    background: var(--blue);
  }

  input[type="text"] {
    flex: 1;
    border: none;
    border-radius: 25px;
    padding: 10px 15px;
    font-size: 1rem;
    outline: none;
    border: 2px solid var(--lightest-blue);
    transition: border-color 0.3s ease;
  }

  input[type="text"]:focus {
    border-color: var(--dark-blue);
  }

  button.send-btn {
    background: var(--dark-blue);
    border: none;
    margin-left: 10px;
    border-radius: 25px;
    padding: 0 20px;
    color: var(--lightest-blue);
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  button.send-btn:hover,
  button.send-btn:focus {
    background: var(--blue);
  }

  /* Scrollbar styling for chat */
  .chat-area::-webkit-scrollbar {
    width: 8px;
  }
  .chat-area::-webkit-scrollbar-track {
    background: var(--lightest-blue);
    border-radius: 5px;
  }
  .chat-area::-webkit-scrollbar-thumb {
    background: var(--dark-blue);
    border-radius: 5px;
  }

  /* Responsive adjustments */
  @media (max-width: 400px) {
    body {
      padding: 5px;
    }
    .bot-container {
      height: 100vh;
      max-width: 100%;
      border-radius: 0;
    }
  }
</style>
</head>
<body>
<div class="bot-container" role="main" aria-label="Career equality advice bot">
  <header>
    Career Advice Bot
    <div class="subtitle">Empowering your career path with equality &amp; insight</div>
  </header>
  <section class="chat-area" id="chat" aria-live="polite" aria-atomic="false" tabindex="0">
    <!-- Messages will appear here dynamically -->
  </section>
  <form id="input-form" class="input-area" autocomplete="off" aria-label="Send message form">
    <input type="text" id="user-input" name="userInput" placeholder="Type your question here..." aria-label="Type your question here" />
    <button type="submit" class="send-btn" aria-label="Send message">Send</button>
  </form>
</div>

  <script>
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

      fetch(window.location.href, {
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
  </script>
</body>
</html>
