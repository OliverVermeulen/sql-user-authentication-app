<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: /sql-user-authentication-app/src/pages/librarian-dashboard.php");
    exit;
}

// Include config file
require_once "/MAMP/htdocs/sql-user-authentication-app/src/include/config.inc.php";
$sql = "SELECT * FROM librarians WHERE username = librarian";

$_SESSION["loggedin"] = true;
$_SESSION["username"] = "Librarian";
header("location: /sql-user-authentication-app/src/pages/librarian-dashboard.php");