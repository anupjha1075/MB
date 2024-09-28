<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home Page</title>
    <!-- Bootstrap Files -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        
        body {
        overflow-x: hidden;
        background: url('images/background.jpg') no-repeat center center fixed;
        background-size: cover;
        color: white; /* Set default text color to white */
        font-family: 'Poppins', sans-serif;
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
        .carousel-item img {
            height: 450px;
            object-fit: cover;
            border-radius: 10px;
        }
        .carousel-caption {
    background-color: rgba(0, 0, 0, 0.4); /* Same background color */
    width: 100%; /* Full width of the carousel */
    left: 0; /* Align to the left edge */
    right: 0; /* Align to the right edge */
    bottom: 0; /* Align to the bottom of the carousel item */
    padding: 5px; /* Increased padding for a more substantial strip */
    border-radius: 0; /* Remove rounded corners */
    text-align: center; /* Center the text */
}
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 10px;
    overflow: hidden;
    background-color: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    color: white;
    border: none;
}

.card:hover {
    transform: scale(1.05); /* Zoom effect */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); /* Shadow effect */
}
        }
        .btn {
            border-radius: 50px;
            padding: 5px 20px;
            transition: background-color 0.3s ease;
        }
        .btn-primary {
            background-color: #ff6f61;
            border: none;
        }
        .btn-primary:hover {
            background-color: #ff8568;
        }
        .btn-danger {
            background-color: #d9534f;
            border: none;
        }
        .btn-danger:hover {
            background-color: #e77370;
        }
        .container h3 {
            margin-bottom: 20px;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
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
            <p><nav class="navbar navbar-expand-md navbar-light justify-content-center">
                <ul class="navbar-nav">
                    <li></li>
                    <li></li>
                    <li></li><li></li><li></li>
                    <li class="nav-item"><a href="index.php" class="nav-link active">Home</a></li>
                    <li class="nav-item"><a href="movies.php" class="nav-link">Movies</a></li>
                    <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
                    <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="admin/login.php" class="nav-link">Admin Login</a></li>
                </ul></p>
            </nav>
        </div>
        
    </div>
    
            
        </div>
    </div>
</div>




    <!-- Header code ends here -->

    <!-- Carousel for Featured Movies -->
    <div id="movieCarousel" class="carousel slide mt-4" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/devara.jpg" class="d-block w-100" alt="Movie 1">
                <div class="carousel-caption d-none d-md-block">
                    <H1>DEVARA</h1>
                    <p> Jr NTR, Janhvi Kapoor, Saif Ali Khan &bull;  2h 57m &bull; Hindi &bull; Action, Drama, Thriller &bull; U/A </p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/sagat 2.jpg" class="d-block w-100" alt="Movie 2">
                <div class="carousel-caption d-none d-md-block">
                    
                    <h2>WELCOME TO SSA &bull; PLEASE ADHERE TO DRESS CODE REGULATIONS.</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/Shramantika.jpg" class="d-block w-100" alt="Movie 3">
                <div class="carousel-caption d-none d-md-block">
                   
                    <h2>ENCHANTING GARDEN, LIVELY FOOD COURTS, PICTURESEQUE HAVEN </h2>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/ROCKCLIMB.jpg" class="d-block w-100" alt="Movie 3">
                <div class="carousel-caption d-none d-md-block">
                   
                    <h2>"CONQUER HEIGHTS, TEST YOUR LIMITS, AND RISE ABOVE CHALLENGES!" </h2>
                </div>
            </div>

            <div class="carousel-item">
                <img src="images/sagat 2.jpg" class="d-block w-100" alt="Movie 3">
                <div class="carousel-caption d-none d-md-block">
                   
                    <h2>PLEASE MAKE SURE THAT YOU BOOK TICKETS BEFORE COMING FOR MOVIE</h2>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#movieCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#movieCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container mt-4">
    <h3 class="text-center"><u>AMENITIES INSIDE SAGAT SINGH AUDITORIUM</u></h3>
    <div class="row">
        <!-- Soft Play Area -->
        <div class="col-md-3">
            <div class="card mb-4">
                <img class="card-img-top" src="images/SOFTPLAY.jpg" alt="Soft Play Area">
                <div class="card-body">
                    <h5 class="card-title">SOFT PLAY AREA</h5>
                    <p class="card-text">Colorful, safe space with interactive play equipment.</p>
                </div>
            </div>
        </div>

        <!-- Gaming Zone -->
        <div class="col-md-3">
            <div class="card mb-4">
                <img class="card-img-top" src="images/GAME ZONE.jpg" alt="Gaming Zone">
                <div class="card-body">
                    <h5 class="card-title">GAMING ZONE</h5>
                    <p class="card-text">Exciting, immersive space with diverse arcade games.</p>
                </div>
            </div>
        </div>

        <!-- PLAY AREA -->
        <div class="col-md-3">
            <div class="card mb-4">
                <img class="card-img-top" src="images/play area.jpg" alt="Gaming Zone">
                <div class="card-body">
                    <h5 class="card-title">PLAY AREA</h5>
                    <p class="card-text">Adventure-filled play area with shooting range, trampoline, and rock climbing wall.</p>
                </div>
            </div>
        </div>

        <!-- Food Court -->
        <div class="col-md-3">
            <div class="card mb-4">
                <img class="card-img-top" src="images/food court.jpg" alt="Food Court">
                <div class="card-body">
                    <h5 class="card-title">FOOD COURT</h5>
                    <p class="card-text">Diverse dining space with various international cuisines.</p>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

        </div>
    </div>

    <!-- Note Section -->
    <div class="container-fluid text-center mt-5 p-3" style="background: rgba(0, 0, 0, 0.5); color: white;">
        <p style="font-size: 1.2rem; margin: 0;">
        <marquee> <strong>Note:</strong> Please adhere to the dress code regulations &bull; Kindly ensure that children are supervised during the screening of movies &bull; 
    Recliners will be open for booking only two hours before commencement of movie &bull; Please produce a valid iden proof for entry (I Card/ COI Card/ Dependent Card)</marquee>
        </p>
    </div>

    

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Fetch featured movies from the database
$result = $connection->query("SELECT * FROM carousel");
if ($result->num_rows > 0) {
    $active = true; // To manage the active class
    while ($row = $result->fetch_assoc()) {
        $activeClass = $active ? 'active' : '';
        echo '<div class="carousel-item ' . $activeClass . '">
                <img src="' . $row['image_path'] . '" class="d-block w-100" alt="' . $row['title'] . '">
                <div class="carousel-caption d-none d-md-block">
                    <h1>' . $row['title'] . '</h1>
                    <p>' . $row['cast'] . ' &bull; ' . $row['running_time'] . ' &bull; ' . $row['language'] . ' &bull; ' . $row['genre'] . ' &bull; ' . $row['certification'] . '</p>
                </div>
              </div>';
        $active = false; // Set to false after first iteration
    }
} else {
    echo '<div class="carousel-item active">
            <img src="images/default.jpg" class="d-block w-100" alt="Default Movie">
            <div class="carousel-caption d-none d-md-block">
                <h1>No Featured Movies Available</h1>
            </div>
          </div>';
}
?>

