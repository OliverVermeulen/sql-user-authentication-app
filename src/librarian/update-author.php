<?php
// Include config file
require_once "/MAMP/htdocs/sql-user-authentication-app/src/include/config.inc.php";

// Define variables and initialize with empty values
$author_name = $author_age = $author_genre = "";
$author_name_err = $author_age_err = $book_genre_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate author_name
    $input_author_name = trim($_POST["author_name"]);
    if (empty($input_author_name)) {
        $author_name_err = "Please enter a name";
    } else {
        $author_name = $input_author_name;
    }

    // Validate author_age
    $input_author_age = trim($_POST["author_age"]);
    if (empty($input_author_age)) {
        $author_age_err = "Please enter a age";
    } else {
        $author_age = $input_author_age;
    }

    // Validate author_genre
    $input_author_genre = trim($_POST["author_genre"]);
    if (empty($input_author_genre)) {
        $author_genre_err = "Please enter a genre";
    } else {
        $author_genre = $input_author_genre;
    }

    // Check input errors before inserting in database
    if (empty($author_name_err) && empty($author_age_err) && empty($author_genre_err)) {
        // Prepare an update statement
        $query = "UPDATE `authors` SET `author_name` = '$author_name', `author_age` = '$author_age', `author_genre` = '$author_genre' WHERE `authors`.`author_id` = $id";
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
        $sql = "SELECT * FROM authors WHERE author_id = ?";
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
                    $author_name = $row["author_name"];
                    $author_age = $row["author_age"];
                    $author_genre = $row["author_genre"];
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
    // Close statement
    $stmt->close();

    // Close connection
    $link->close();
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
                    <h2>Update author</h2>
                    <p>Please edit values and submit to update the author</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Author name</label>
                            <input type="text" name="author_name" class="form-control" value="<?= $author_name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Author age</label>
                            <input type="text" name="author_age" class="form-control" value="<?= $author_age; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Author genre</label>
                            <input type="text" name="author_genre" class="form-control" value="<?= $author_genre; ?>" required>
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