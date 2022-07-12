<?php
// Include config file
require_once "/MAMP/htdocs/sql-user-authentication-app/src/include/config.inc.php";

// Define variables and initialize with empty values
$book_name = $release_year = $book_genre = $age_group = $author_id = "";
$book_name_err = $release_year_err = $book_genre_err = $age_group_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    $input_book_name = trim($_POST["book_name"]);
    if (empty($input_book_name)) {
        $book_name_err = "Please enter a name.";
    } else {
        $book_name = $input_book_name;
    }

    // Validate release_year
    $input_release_year = trim($_POST["release_year"]);
    if (empty($input_release_year)) {
        $release_year_err = "Please enter a name.";
    } else {
        $release_year = $input_release_year;
    }

    // Validate book_genre
    $input_book_genre = trim($_POST["book_genre"]);
    if (empty($input_book_genre)) {
        $book_genre_err = "Please enter a name.";
    } else {
        $book_genre = $input_book_genre;
    }

    // Validate age_group
    $input_age_group = trim($_POST["age_group"]);
    if (empty($input_age_group)) {
        $age_group_err = "Please enter a name.";
    } else {
        $age_group = $input_age_group;
    }

    // Get selected author
    $author_id = $_POST["author_id"];

    // Check input errors before inserting in database
    if (empty($book_name_err) && empty($release_year_err) && empty($book_genre_err) && empty($book_genre_err) && empty($age_group_err)) {
        // Prepare an update statement
        $query = "UPDATE `books` SET `book_name` = '$book_name', `release_year` = '$release_year', `book_genre` = '$book_genre', `age_group` = '$age_group', `author_id` = '$author_id' WHERE `books`.`book_id` = $id";
        $result = mysqli_query($link, $query);
        // redirects user to home page
        header("location: librarian-index.php");
    }

    // Close connection
    $link->close();
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM books WHERE book_id = ?";
        if ($stmt = $link->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $book_name = $row["book_name"];
                    $release_year = $row["release_year"];
                    $book_genre = $row["book_genre"];
                    $age_group = $row["age_group"];
                    $author_id = $row["author_id"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The aim of this project is to make a OOP based booking app in PHP">
    <title>Update Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/sql-user-authentication-app/src/css/style.css">
    <link rel="shortcut icon" href="/sql-user-authentication-app/src/images/icon.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous" defer></script>
    <script src="https://kit.fontawesome.com/e4ad388285.js" crossorigin="anonymous"></script>
    <script src="/php-oop-booking-app/src/js/script.js" defer></script>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2>Update book</h2>
                    <p>Please edit values and submit to update the book</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Book Name</label>
                            <input type="text" name="book_name" class="form-control" value="<?= $book_name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Release Year</label>
                            <input type="text" name="release_year" class="form-control" value="<?= $release_year; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Book Genre</label>
                            <input type="text" name="book_genre" class="form-control" value="<?= $book_genre; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Age Group</label>
                            <input type="text" name="age_group" class="form-control" value="<?= $age_group; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Author</label>
                            <select name="author_id" class="form-control" required>
                                <?php
                                // Loops through authors table to get author name
                                $sql = "SELECT * FROM authors";
                                if ($result = $link->query($sql)) {
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value='$row[author_id]'>" . $row['author_name'] . "</option>";
                                    }
                                    $result->free();
                                }
                                // Close statement
                                $stmt->close();

                                // Close connection
                                $link->close(); ?>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="librarian-index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>