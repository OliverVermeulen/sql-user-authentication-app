<?php
require_once "/MAMP/htdocs/sql-user-authentication-app/src/include/config.inc.php";
$case = $_POST['yeet'];
switch ($case) {
    case 'alphabet':
        $query = "SELECT * FROM books ORDER BY book_name";
        break;
    case 'year':
        $query = "SELECT * FROM books ORDER BY release_year";
        break;
    case 'genre':
        $query = "SELECT * FROM books ORDER BY book_genre";
        break;
    default:
        echo "Error Something happened";
        break;
}
$result = mysqli_query($link, $query);
header("location: index.php");