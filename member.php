<?php 
// Start the session at the beginning of the script
session_start();
// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['fname']) || !isset($_SESSION['lname'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Move the link to the stylesheet here within the head -->
    <link rel="stylesheet" href="styles.css">
    <!-- Add a title for better SEO and accessibility -->
    <title>Member Page</title>
</head>
<body>
    <!-- Include the header -->
    <?php include("./templates/header.php"); ?>

    <!-- Welcome message -->
    <h2>Welcome <?php echo htmlspecialchars($_SESSION['fname'] . " " . $_SESSION['lname']); ?></h2>

    <!-- Content of the page -->

    <!-- Include the footer -->
    <?php include("./templates/footer.php"); ?>
</body>
</html>
