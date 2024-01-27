<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Users' Info Using PHP with MySQL</title>
</head>

<body>
    <div id="container">
        <header id="banner">
            <h1>Welcome to Our Website</h1>
            <h3>Users' Info Using PHP with MySQL</h3>
        </header>

        <div id="nav">
            <ul>
                <li><a href="./index.php">Home</a></li>
                <?php
                if (basename($_SERVER['PHP_SELF']) == "member.php") {
                    echo ("<li><a href='./index.php'>Logout</a></li>");
                } else {
                    echo ("<li><a href='./register.php'>Register</a></li>");
                }
                ?>
                <li><a href="./contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="main-content">
