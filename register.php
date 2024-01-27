<?php
session_start();
include("./config/dbconfig.php");

$error = null;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $fname = trim($_POST['fname']);
  $lname = trim($_POST['lname']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  // Check if all fields are filled
  if (empty($fname) || empty($lname) || empty($email) || empty($password)) {
    $error = 'All fields are required.';
  }
  // Check if the email is valid
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Invalid email format.';
  }
  // Check if the email already exists
  else {
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $emailExists = $stmt->fetchColumn();
    
    if ($emailExists) {
      $error = 'Email already exists.';
    } else {
      // Hash the password
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      // Insert user data into the database
      $stmt = $pdo->prepare('INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)');
      if ($stmt->execute([$fname, $lname, $email, $hashedPassword])) {
        // Save user's first and last name to session
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;

        // Redirect to member page
        header('Location: member.php');
        exit;
      } else {
        $error = 'There was a problem with the registration.';
      }
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <h1>Register</h1>
  <?php if (isset($error)) { ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
  <?php } ?>
  <p>Please fill in the following fields to register:</p>
  <form method="post" action="">
    <label>First Name:</label>
    <input type="text" name="fname"><br>
    <label>Last Name:</label>
    <input type="text" name="lname"><br>
    <label>Email:</label>
    <input type="email" name="email"><br>
    <label>Password:</label>
    <input type="password" name="password"><br>
    <input type="submit" value="Register">
  </form>
</body>
</html>
