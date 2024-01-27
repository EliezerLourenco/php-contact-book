<?php
session_start();
include("./config/dbconfig.php");

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data to prevent XSS attacks
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // Verify that all input fields are not empty
    if (empty($name) || empty($email) || empty($message)) {
        $error_message = "Please fill in all required fields.";
    }
    // Verify that email address is valid
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format. Please enter a valid email address.";
    } else {
        // Prepare SQL statement to insert message into database
        $statement = $pdo->prepare("INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)");
        // Bind values to parameters to prevent SQL injection
        $statement->bindValue(':name', $name);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':message', $message);
        // Execute the statement and check the result
        $result = $statement->execute();

        if ($result) {
            $success_message = "Your message has been sent successfully.";
        } else {
            $error_message = "Error sending message. Please try again.";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <h1>Contact Us</h1>

    <?php if (isset($success_message)) { ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php } ?>

    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>

    <form method="post">
        <label for="name">Full Name:</label><br>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" required></textarea><br>

        <input type="submit" value="Send Message">
    </form>
</body>

</html>
