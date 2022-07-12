<!-- Header Module -->
<header class="header">
    <!-- Website Logo -->
    <a href="/sql-user-authentication-app/index.php"><img src="/sql-user-authentication-app/src/images/library-logo.png" alt="library logo" class="logo img-thumbnail" title="Home"></a>

    <!-- Sign Out and Change Password Dropdown -->
    <div class="dropdown">
        <button class="dropbtn">Functions</button>
        <div class="dropdown-content">
            <a title="Username"><?= htmlspecialchars($_SESSION["username"]); ?></a>
            <a href="/sql-user-authentication-app/src/pages/logout.php" title="Sign Out">Sign Out</a>
            <a href="/sql-user-authentication-app/src/pages/reset-password.php" title="Reset Password">Reset Password</a>
        </div>
    </div>
</header>