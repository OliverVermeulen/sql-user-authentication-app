<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The aim of this project is to make a OOP based booking app in PHP">
    <title>Library</title>
    <link rel="stylesheet" href="/sql-user-authentication-app/src/css/style.css">
    <link rel="shortcut icon" href="/sql-user-authentication-app/src/images/icon.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/e4ad388285.js" crossorigin="anonymous"></script>
    <script src="/php-oop-booking-app/src/js/script.js" defer></script>
</head>

<body>
    <!-- Header Module -->
    <header class="header">
        <!-- Website Logo -->
        <a href="/sql-user-authentication-app/"><img src="/sql-user-authentication-app/src/images/Untitled-removebg-preview.png" alt="Airdnd logo" class="logo" title="Home"></a>

        <form action="" method="post">
            <input type="search" name="" id="" placeholder="Search">
            <button type="submit"><i class="fa fa-search"></i></button>
            <i class="fa fa-magnifying-glass"></i>
        </form>

        <div class="dropdown">
            <button class="dropbtn">Dropdown</button>
            <div class="dropdown-content">
                <a href="#">OLIVER</a>
                <a href="#">SIGN OUT</a>
                <a href="#">CHANGE PASSWORD</a>
            </div>
        </div>
    </header>

    <!-- Footer module -->
    <footer class="footer">
        <!-- Trademarks -->
        <div class="trademarks">
            <span>© 2022 Library,Inc.</span>
            <span>|</span>
            <span>© 2022 Viswinkel,Inc.</span>
        </div>

        <!-- Extra Information -->
        <div div="extra-information">
            <span>Help <i class="fa fa-gear"></i></span>
        </div>
    </footer>
</body>

</html>