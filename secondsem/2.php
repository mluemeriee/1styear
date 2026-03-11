<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    $userQuestion = strtolower(trim($_POST['question']));

    $response = "Sorry, I don't understand that question.";
    $responses = [
        ['keywords' => ['grade'], 'response' => "Your grade is 87. Keep it up!"],
        ['keywords' => ['fail'], 'response' => "No, you're not failing. Stay consistent!"],
        ['keywords' => ['name'], 'response' => "I'm your helpful assistant bot!"],
        ['keywords' => ['hello', 'hi'], 'response' => "Hey there! What can I do for you?"]
    ];

    foreach ($responses as $item) {
        foreach ($item['keywords'] as $keyword) {
            if (strpos($userQuestion, $keyword) !== false) {
                $response = $item['response'];
                break 2;
            }
        }
    }

    echo json_encode(['response' => $response]);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mini AI Bot</title>
    <style>
        body { font-family: Arial; background: #f7f7f7; padding: 30px; }
        .chat-box { background: white; padding: 20px; width: 500px; margin: auto; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1); }
        .messages { min-height: 200px; margin-bottom: 20px; white-space: pre-line; }
        .user { color: blue; margin: 10px 0; }
        .bot { color: green; margin: 10px 0; }
        input[type="text"] { width: 80%; padding: 8px; }
        input[type="submit"] { padding: 8px 12px; }
    </style>
</head>
<body>
    <div class="chat-box">
        <h2>Ask the AI Bot</h2>
        <div class="messages" id="chat"></div>
        <form id="chatForm" method="POST">
            <input type="text" name="question" id="questionInput" placeholder="Type your question..." required autocomplete="off" />
            <input type="submit" value="Send" />
        </form>
    </div>

    <script>
        document.getElementById("chatForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const questionInput = document.getElementById("questionInput");
            const question = questionInput.value;
            const chatBox = document.getElementById("chat");
            chatBox.innerHTML += "\nYou: " + question + "\n";

            fetch("", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "ajax=1&question=" + encodeURIComponent(question)
            })
            .then(response => response.json())
            .then(data => {
                let i = 0;
                const botResponse = data.response;
                const interval = setInterval(() => {
                    if (i < botResponse.length) {
                        chatBox.innerHTML += botResponse.charAt(i);
                        i++;
                    } else {
                        clearInterval(interval);
                        chatBox.innerHTML += "\n\n";
                    }
                }, 50);
            });

            questionInput.value = "";
        });
    </script>
</body>
</html>