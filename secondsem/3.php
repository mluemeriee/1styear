<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Form Validation</title>
    </head>
    <body>
        <h2>PHP Form Validation Example</h2>

        <?php
        function clean_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $name = $email = $age = "";
        $success_message = "";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = clean_input($_POST['name']);
            $email = clean_input($_POST['email']);
            $age = clean_input($_POST['age']);

            if (preg_match("/^[a-zA-Z-'-]*$/", $name) &&    
                filter_var($email, FILTER_VALIDATE_EMAIL) &&
                filter_var($age, FILTER_VALIDATE_INT) && $age > 0) {

                $success_message = "Form submitted successfully! <br>
                    <strong>Name: </strong> $name <br>
                    <strong>Email: </strong> $email <br>
                    <strong>Age: </strong> $age";
            }
        }

        if ($success_message) {
            echo "<p>$success_message</p>";
        }
        ?>

        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            <br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <br><br>

            <label for="age">Age:</label>
            <input type="number" name="age" value="<?php echo htmlspecialchars($age); ?>" required>
            <br><br>

            <button type="submit">Submit</button>
        </form>
    </body>
</html>