<?php
if (session_status() == PHP_SESSION_ACTIVE) {
    session_destroy();
} else {
    session_start();
}
include("./config/dbconfig.php");

// error message
$error_msg = null;
$_SESSION['username'] = null;
$_SESSION['password'] = null;

if (isset($_POST['submit'])) {
    $query = $pdo->prepare("SELECT * FROM users WHERE email = ? and password = ?");
    $query->execute([$_POST['email'], $_POST['password']]);
    $res = $query->fetch();
    if ($res['email'] == $_POST['email'] && $res['password'] == $_POST['password']) {
        $_SESSION['fname'] = $res['first_name'];
        $_SESSION['lname'] = $res['last_name'];
        $_SESSION['username'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        $error_msg = null;
        header("Location: ./member.php");
        exit();
    } else {
        $error_msg = "User doesn't exist";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <!-- Add a title for better SEO and accessibility -->
    <title>Login Page</title>
</head>
<body>
    <!-- header -->
    <?php include("./templates/header.php"); ?>

    <h3>Log In</h3>
    <?php
    if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
        printf('
        <form action="%s" method="POST">
        <div>
            Email Address:
            <input type="email" id="email" maxlength="50" name="email" placeholder="Email Address">
        </div>
        <div>
            Password:
            <input type="password" id="password" maxlength="80" name="password">
        </div>
        <input type="submit" value="Submit" name="submit">
        </form>', $_SERVER["PHP_SELF"]);
        if (isset($error_msg)) {
            echo ("<br>" . $error_msg);
        }
    }
    ?>
    <!-- footer -->
    <br>
    <?php include("./templates/footer.php"); ?>
</body>
</html>
