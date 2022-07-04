<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The aim of this project is to make a OOP based booking app in PHP">
    <title>Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="/sql-user-authentication-app/src/css/style.css">
    <link rel="stylesheet" href="/sql-user-authentication-app/src/include/style2.css">
    <link rel="shortcut icon" href="/sql-user-authentication-app/src/images/icon.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/e4ad388285.js" crossorigin="anonymous"></script>
    <script src="/php-oop-booking-app/src/js/script.js" defer></script>
</head>

<body>
    <?php
    // Header
    include("/MAMP/htdocs/sql-user-authentication-app/src/include/header.inc.php");

    // Switch Router
    $request = $_SERVER['REQUEST_URI'];
    $basepath = "sql-user-authentication-app/";
    $request = str_replace($basepath, "", $request);
    $request = strtok($request, '?');
    switch ($request) {
        case '/':
            require __DIR__ . '/src/include/login.php';
            break;
        case '':
            require __DIR__ . '/src/include/login.php';
            break;
        case '/login':
            require __DIR__ . '/src/include/login.php';
            break;
        case '/register':
            require __DIR__ . '/src/include/register.php';
            break;
        case '/welcome':
            require __DIR__ . '/src/include/welcome.php';
            break;
        default:
            http_response_code(404);
            echo "page not found";
            break;
    };

    // Footer
    include("/MAMP/htdocs/sql-user-authentication-app/src/include/footer.inc.php");
    ?>
</body>

</html>