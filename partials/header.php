<?php if (!session_status())
    session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Course Management System</title>
    <style>
        body {
            padding-top: 56px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
            overflow-y: auto;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .footer {
            width: 100%;
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        .wrapper {
            display: flex;
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Course Management System</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <?php
                        if (isset($_SESSION['name'])) {
                            $user_obj = new users();
                            $user = $user_obj->get_user_by_name($_SESSION['name']);
                            ?>
                            <li class="nav-item">
                                <a href="<?php echo SITEURL ?>dashboard/dashboard.php"
                                    class="nav-link text-primary font-weight-bold"><?php echo 'Hello ' . $_SESSION["name"] . '!'; ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo SITEURL ?>login_sys/logout.php"
                                    class="nav-link btn btn-primary text-white">LOGOUT</a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li class="nav-item">
                                <a href="<?php echo SITEURL ?>index.php"
                                    class="nav-link btn btn-primary text-white">LOGIN</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>