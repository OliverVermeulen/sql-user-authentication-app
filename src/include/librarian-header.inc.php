<!-- Header Module -->
<header class="header">
    <!-- Website Logo -->
    <a href="/sql-user-authentication-app/src/pages/librarian-dashboard.php"><img src="/sql-user-authentication-app/src/images/library-logo.png" alt="library logo" class="logo img-thumbnail" title="Home"></a>

    <!-- Search Bar -->
    <form class="row g-2">
        <div class="col-auto">
            <input type="search" name="search" class="form-control" placeholder="Search">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3"><i class="fa fa-search"></i></button>
        </div>
    </form>

    <!-- Sign Out and Change Password Dropdown -->
    <div class="dropdown">
        <button class="dropbtn">Dropdown</button>
        <div class="dropdown-content">
            <a title="username"><?= htmlspecialchars($_SESSION["username"]); ?></a>
            <a href="/sql-user-authentication-app/src/pages/logout.php" title="Sign Out">Sign Out</a>
        </div>
    </div>
</header>