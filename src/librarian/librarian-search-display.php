<?php
// Initialize the session
session_start();

// Checks if the user is logged in, if not it redirects them to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: location: /sql-user-authentication-app/src/pages/login.php");
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
    <title>Books</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/sql-user-authentication-app/src/css/style.css">
    <link rel="shortcut icon" href="/sql-user-authentication-app/src/images/icon.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous" defer></script>
    <script src="https://kit.fontawesome.com/e4ad388285.js" crossorigin="anonymous"></script>
    <script src="/php-oop-booking-app/src/js/script.js" defer></script>
</head>

<body>
    <!-- Librarian Header Module -->
    <?php include("/MAMP/htdocs/sql-user-authentication-app/src/include/header.inc.php"); ?>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "/MAMP/htdocs/sql-user-authentication-app/src/include/config.inc.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM books";
                    if ($result = $link->query($sql)) {
                        $search = $_REQUEST["search"];
                        $query = "SELECT * from books where book_name like '%$search%' OR release_year like '%$search%' OR book_genre like '%$search%' OR age_group like '%$search%'"; //search books table by given parameter
                        $result = mysqli_query($link,$query);   
                        if ($result->num_rows > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Book Name</th>";
                            echo "<th>Release Year</th>";
                            echo "<th>Book Genre</th>";
                            echo "<th>Age Group</th>";
                            echo "<th>Action</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = $result->fetch_array()) {
                                echo "<tr>";
                                echo "<td>" . $row['book_name'] . "</td>";
                                echo "<td>" . $row['release_year'] . "</td>";
                                echo "<td>" . $row['book_genre'] . "</td>";
                                echo "<td>" . $row['age_group'] . "</td>";
                                echo "<td class='action-list'>";
                                echo '<a href="/sql-user-authentication-app/src/librarian/read-author.php?id=' . $row['author_id'] . '" class="mr-3" title="View Author Details" ><span class="fa fa-user"></span></a>';
                                echo '<a href="/sql-user-authentication-app/src/librarian/librarian-read.php?id=' . $row['book_id'] . '" class="mr-3" title="View Book Details" ><span class="fa fa-book"></span></a>';
                                echo '<a href="/sql-user-authentication-app/src/librarian/update.php?id=' . $row['book_id'] . '" class="mr-3" title="Update Information" ><span class="fa fa-pencil"></span></a>';
                                echo '<a href="/sql-user-authentication-app/src/librarian/delete.php?id=' . $row['book_id'] . '" title="Delete Information" ><span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            $result->free();
                        } else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    // Close connection
                    $link->close();
                    ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Module -->
    <?php include("/MAMP/htdocs/sql-user-authentication-app/src/include/footer.inc.php"); ?>
</body>

</html>