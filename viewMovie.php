<?php
    session_start();
    include('connection.php');
    $query = "SELECT * FROM movies WHERE id = $_GET[mid]";
    $movie_name = "";
    $movie_description = "";
    $movie_link = "";
    $query_run = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($query_run)){
        $movie_name = $row['name'];
        $movie_description = $row['description'];
        $movie_link = $row['link']; 
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Movie</title>
    <!-- Bootstrap Files -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: url('images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }
        #header {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px 0;
            border-bottom: 2px solid white;
        }
        #header h1 {
            margin: 0;
            font-size: 2rem;
            letter-spacing: 1px;
            font-family: 'Arial', cursive;
        }
        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #ffd1a3 !important;
            text-decoration: none;
        }
        .table {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            color: white;
            margin-top: 20px;
        }
        .table th, .table td {
            text-align: justify;
            vertical-align: middle;
        }
        .btn-danger {
            background-color: #d9534f;
            border: none;
        }
        .btn-danger:hover {
            background-color: #e77370;
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
            <div class="col-md-10">
                <h1 id="auditorium-name">SAGAT SINGH AUDITORIUM</h1>
                <nav class="navbar navbar-expand-md navbar-light justify-content-center">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="index.php" class="nav-link active">Home</a></li>
                        <li class="nav-item"><a href="movies.php" class="nav-link">Movies</a></li>
                        <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
                        <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="admin/login.php" class="nav-link">Admin Login</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Header code ends here -->

    <!-- Movie Detail Section -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 m-auto" id="movie-details">
                <center><h3><u>Movie Detail</u></h3></center>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Movie Name</th>
                            <th>Movie Description</th>
                            <th>Trailer Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $movie_name; ?></td>
                            <td><?php echo $movie_description; ?></td>
                            <td><a href="<?php echo $movie_link; ?>" target="_blank" class="btn btn-danger btn-sm">Watch Now</a></td>
                        </tr>
                    </tbody>
                </table>
                <center><a href="login.php" class="btn btn-danger btn-sm">Book Ticket</a></center>
            </div>
        </div>
    </div>

</body>
</html>
