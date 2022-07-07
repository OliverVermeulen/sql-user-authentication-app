<?php
// Include config file
require_once "config.php";

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
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
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