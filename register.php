<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Notice Page</title>
    <!-- Bootstrap Files -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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
            font-size: 4rem;
            letter-spacing: 1px;
            font-family: 'Times New Roman', cursive;
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
        .notice-container {
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
            max-width: 600px;
            margin: 20px auto;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center vertically */
            height: 300px; /* Adjust height as needed */
        }
        .notice-container h1 {
            font-size: 2rem;
            margin: 0;
            line-height: 1.5; /* Adjust for spacing */
        }
        .notice-container p {
            font-size: 1.2rem;
            margin: 20px 0; /* Margin between lines */
            line-height: 1.6; /* Increase line spacing */
            text-align : justify;
        }
    </style>
</head>
<body>
    <!-- Header code starts here -->
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

    <!-- Notice Section -->
    <div class="notice-container">
       <u> <h1>REGISTRATION NOTICE</h1></u>
        <p>PLEASE CONTACT YOUR OWN ORGANIZATION OFFICE IN ORDER TO REGISTER WITH US. ONCE YOUR ORGANIZATION SHARES THE 
          REQUISITE DETAILS WITH US IN THE PROMULGATED FORMAT, WE WILL REGISTER AND SHARE THE LOGIN CREDENTIALS TO YOUR OFFICE.</p>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
