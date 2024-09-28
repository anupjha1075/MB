<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (isset($_POST['login'])) {
    include('connection.php');

    // Sanitize user input
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Query to fetch user details including category
    $query = "SELECT id, email, category FROM users WHERE email = '$email' AND password = '$password'";
    $query_run = mysqli_query($connection, $query);

    if (!$query_run) {
        die("Query failed: " . mysqli_error($connection));
    }

    if (mysqli_num_rows($query_run) > 0) {
        // User found
        $row = mysqli_fetch_assoc($query_run);
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['email'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['category'] = $row['category']; // Set the user's category in the session

        echo "<script type='text/javascript'>
            window.location.href = 'user_dashboard.php';
        </script>";
    } else {
        // User not found
        echo "<script type='text/javascript'>
            alert('Please enter correct email and password.');
            window.location.href = 'login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <!-- Bootstrap Files -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-image: url('images/background.jpg');
            background-size: cover;
            background-attachment: fixed;
        }
        #header {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 5px 0;
            border-bottom: 2px solid white;
        }
        #header h4 {
            font-family: 'Arial', cursive;
            margin: 0;
            font-size: 1.5rem;
            letter-spacing: 1px;
            color: #fff;
        }
        .nav-link {
            color: white !important;
            font-weight: 500;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            text-decoration: none;
            color: #ffd1a3 !important;
        }
        #login_form {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
            max-width: 500px;
        }
        #login_form h3 {
            margin-bottom: 30px;
            font-family: 'Arial ', cursive, sans-serif;
            color: #fff;
            text-align: center;
        }
        .form-control {
            border-radius: 20px;
            padding: 15px;
            font-size: 1rem;
            border: none;
            box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
        }
        .btn-danger {
            border-radius: 20px;
            padding: 10px 30px;
            font-size: 1rem;
            background-color: #dc3545;
            border-color: #dc3545;
            transition: background-color 0.3s ease;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 8px;
        }
        .note {
            color: white;
            font-size: 0.9rem;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Header code starts here -->
    <div class="container-fluid" id="header">
        <div class="row align-items-center">
            <div class="col-md-2 d-flex align-items-center justify-content-center">
                <img src="images/logo.png" alt="Company Logo" class="img-fluid">
            </div>
            <h1 id="auditorium-name">SAGAT SINGH AUDITORIUM</h1>
            <div class="col-md-7 text-center">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="movies.php" class="nav-link">Movies</a></li>
                    <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
                    <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Header code ends here -->
    <div class="row">
        <div class="col-md-12">
            <div id="login_form">
                <h3>Login to Your Account</h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Username:</label>
                        <input class="form-control" type="text" name="email" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input class="form-control" type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button class="btn btn-danger" type="submit" name="login">Login</button>
                </form>
                <p class="note">For first-time users, please contact us through your office to get login credentials.</p>
            </div>
        </div>
    </div>
</body>
</html>