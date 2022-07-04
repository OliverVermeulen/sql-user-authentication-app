<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The aim of this project is to make a OOP based booking app in PHP">
    <title>Library</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/sql-user-authentication-app/src/css/style.css">
    <link rel="shortcut icon" href="/sql-user-authentication-app/src/images/icon.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous" defer></script>
    <script src="https://kit.fontawesome.com/e4ad388285.js" crossorigin="anonymous"></script>
    <script src="/php-oop-booking-app/src/js/script.js" defer></script>
</head>

<body>
    <!-- Header Module -->
    <header class="header">
        <!-- Website Logo -->
        <a href=""><img src="/sql-user-authentication-app/src/images/Untitled-removebg-preview.png" alt="Airdnd logo" class="logo" title="Home"></a>

        <!-- Search Bar -->
        <form action="" method="post">
            <input type="search" name="" id="" placeholder="Search">
            <button type="submit"><i class="fa fa-search"></i></button>
            <i class="fa fa-magnifying-glass"></i>
        </form>

        <!-- Sign Out and Change Password Dropdown -->
        <div class="dropdown">
            <button class="dropbtn">Dropdown</button>
            <div class="dropdown-content">
                <a><?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                <a href="logout.php">Sign Out of Your Account</a>
                <a href="reset-password.php">Reset Your Password</a>
            </div>
        </div>
    </header>
    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex unde ut eum quos. Quibusdam eum qui esse error quo voluptatibus, inventore debitis, dolorem molestias saepe harum. Pariatur mollitia tempora sint. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim culpa qui similique maxime fugiat dolores excepturi quibusdam aperiam sed, reiciendis facilis. Inventore pariatur magni quaerat neque rerum accusamus fugiat quidem.
    <?php include("/MAMP/htdocs/sql-user-authentication-app/src/include/footer.inc.php");?>
</body>

</html>