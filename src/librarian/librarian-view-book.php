<?php
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "/MAMP/htdocs/sql-user-authentication-app/src/include/config.inc.php";

    // Prepare a select statement
    $sql = "SELECT * FROM books WHERE book_id = ?";

    if ($stmt = $link->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

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
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    $stmt->close();

    // Close connection
    $link->close();
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The aim of this project is to make a OOP based booking app in PHP">
    <title>Book Details</title>
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
                    <h1 class="mb-3">Book details</h1>
                    <div class="form-group">
                        <h5>Book name</h5>
                        <p><?= $row["book_name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <h5>Release year</h5>
                        <p><?= $row["release_year"]; ?></p>
                    </div>
                    <div class="form-group">
                        <h5>Book genre</h5>
                        <p><?= $row["book_genre"]; ?></p>
                    </div>
                    <div class="form-group">
                        <h5>Age group</h5>
                        <p><?= $row["age_group"]; ?></p>
                    </div>
                    <div class="form-group">
                        <?= '<a href="/sql-user-authentication-app/src/librarian/update.php?id=' . $row['book_id'] . '" class="btn btn-primary ml-2" title="Update book details" ><i class="fa fa-pencil"></i> Update</a>'; ?>
                        <a href="librarian-index.php" class="btn btn-secondary" title="Cancel">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>