<?php
// Include config file
require_once "/MAMP/htdocs/sql-user-authentication-app/src/include/config.inc.php";

// Define variables and initialize with empty values
$book_name = $release_year = $book_genre = $age_group = $book_id = "";
$book_name_err = $release_year_err = $book_genre_err = $age_group_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate book_name
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

    // Validate book_id
    $input_book_id = trim($_POST["book_id"]);
    $book_id = $input_book_id;

    // Check input errors before inserting in database
    if (empty($book_name_err) && empty($release_year_err) && empty($book_genre_err) && empty($book_genre_err)) {
        // Prepare an insert statement
        $query = "INSERT INTO books(book_name, release_year, book_genre, age_group, book_id) VALUES ('$book_name','$release_year','$book_genre','$age_group','$book_id')";
        // Inserts into books table
        $result = mysqli_query($link, $query);
        // redirects user to home page
        header("location: index.php");
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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add book record to the database.</p>
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                            <select name="book_id" class="form-control" required>
                                <?php
                                $sql = "SELECT * FROM authors";
                                if ($result = $link->query($sql)) {
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value='$row[book_id]'>" . $row['author_name'] . "</option>";
                                    }
                                    $result->free();
                                } ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>