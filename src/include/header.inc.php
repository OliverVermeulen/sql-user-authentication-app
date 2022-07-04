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
            <a><?= htmlspecialchars($_SESSION["username"]); ?></a>
            <a href="logout.php">Sign Out of Your Account</a>
            <a href="reset-password.php">Reset Your Password</a>
        </div>
    </div>
</header>