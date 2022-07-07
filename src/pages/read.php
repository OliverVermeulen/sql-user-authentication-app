<?php
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "/MAMP/htdocs/sql-user-authentication-app/src/include/config.inc.php";

    // Prepare a select statement
    $sql = "SELECT * FROM books WHERE id = ?";

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
    <title>View Record</title>
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
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Book Name</label>
                        <p><b><?php echo $row["book_name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Release Year</label>
                        <p><b><?php echo $row["release_year"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Book Genre</label>
                        <p><b><?php echo $row["book_genre"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Age Group</label>
                        <p><b><?php echo $row["age_group"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>