<?php
// Include config file
require_once "/MAMP/htdocs/sql-user-authentication-app/src/include/config.inc.php";

// Define variables and initialize with empty values
$author_name = $author_age = $author_genre = "";
$author_name_err = $author_age_err = $book_genre_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Check input errors before inserting into table
    if (empty($author_name_err) && empty($author_age_err) && empty($book_genre_err)) {
        // Prepare an insert statement
        $query = "INSERT INTO authors(author_name, author_age, author_genre) VALUES ('$author_name','$author_age','$author_genre')";
        // Inserts into authors table
        $result = mysqli_query($link, $query);
        // redirects user to home page
        header("location: librarian-dashboard.php");
    }

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
    <title>Add new record</title>
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
                    <h2 class="mt-5">Create Author</h2>
                    <p>Please fill this form and submit to add a new author record to the database.</p>
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Author Name</label>
                            <input type="text" name="author_name" class="form-control" value="<?= $author_name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Author Age</label>
                            <input type="text" name="author_age" class="form-control" value="<?= $author_age; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Author Genre</label>
                            <input type="text" name="author_genre" class="form-control" value="<?= $author_genre; ?>" required>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="librarian-dashboard.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>