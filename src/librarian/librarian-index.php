<?php
// Initialize the session
session_start();

// Checks if the user is logged in, if not it redirects them to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: location: /sql-user-authentication-app/src/user/login.php");
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
    <title>Librarian page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/sql-user-authentication-app/src/css/style.css">
    <link rel="shortcut icon" href="/sql-user-authentication-app/src/images/icon.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous" defer></script>
    <script src="https://kit.fontawesome.com/e4ad388285.js" crossorigin="anonymous"></script>
    <script src="/php-oop-booking-app/src/js/script.js" defer></script>
</head>

<body>
    <!-- Include Header -->
    <?php include("/MAMP/htdocs/sql-user-authentication-app/src/include/header.inc.php"); ?>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3 clearfix">
                        <div class="librarian-index-actions">
                            <!-- Create new book/author -->
                            <div>
                                <a href="create-book.php" class="btn btn-primary pull-right mb-3" title="Add new book"><i class="fa fa-plus"></i> Book</a>
                                <a href="create-author.php" class="btn btn-secondary pull-right mb-3" title="Add new author"><i class="fa fa-plus"></i> Author</a>
                            </div>
                            <!-- Search Bar -->
                            <form action="/sql-user-authentication-app/src/librarian/librarian-search-display.php" method="get" class="row g-2">
                                <div class="col-auto">
                                    <input type="text" name="search" class="form-control" placeholder="Search" title="Search by Books and Authors">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-3" title="Submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                            <!-- Filter Form -->
                            <form action="" method="post" class="row g-2">
                                <div class="col-auto">
                                    <select class="form-control" name="order" title="Sort By">
                                        <option value="book_name" title="Title">Title</option>
                                        <option value="author_id" title="Author">Author</option>
                                        <option value="book_genre" title="Genre">Genre</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <input type="submit" value="Sort" class="btn btn-primary mb-3" title="Submit selected">
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    // Include config file
                    require_once "/MAMP/htdocs/sql-user-authentication-app/src/include/config.inc.php";

                    // Gets selected value from sorting form
                    $sort = @$_POST['order'];
                    if (!empty($sort)) {
                        $query = "SELECT * FROM books ORDER BY $sort ASC"; // If you Sort it with value of your  select options
                    } else {
                        $query = "SELECT * FROM books ORDER BY book_name ASC"; // Else if you do not pass any value from select option will return this
                    };
                    // Book information table
                    if ($result = $link->query($query)) {
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

    <!-- Include Footer -->
    <?php include("/MAMP/htdocs/sql-user-authentication-app/src/include/footer.inc.php"); ?>
</body>

</html>