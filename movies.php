<?php 
  include('connection.php');
  $query1 = "select * from movies";
  $query_run1 = mysqli_query($connection,$query1);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <!-- Bootstrap Files -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            overflow-x: hidden;
            background: url('images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
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

        #header ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: right;
        }

        #header ul li {
            display: inline-block;
            margin-left: 20px;
        }

        #header ul li a {
            color: white;
            font-size: 1.1rem;
            font-weight: 500;
            transition: color 0.3s ease;
            text-decoration: none;
        }

        #header ul li a:hover {
            color: #ffd1a3;
        }

        .container h3 {
            margin-bottom: 20px;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            color: white;
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

        .card-img-top {
            height: 300px;
            object-fit: cover;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .card-text {
            font-size: 0.9rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
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
    </style>
  </head>
  <body>
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
    <br>
    <div class="container">
      <center><h3><u>Upcoming Bollywood Releases</u></h3></center>
      <div class="row">
        <?php 
          while($row = mysqli_fetch_assoc($query_run1))
          { 
        ?>
        <div class="col-md-3">
          <div class="card mb-4">
            <img class="card-img-top" src="images/<?php echo $row['logo']; ?>" alt="Movie Image">
            <div class="card-body">
            
              
              <a href="viewMovie.php?mid=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">View details</a>
              
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </body>
</html>
