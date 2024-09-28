<?php 
session_start();
include('connection.php');

// Update profile
if(isset($_POST['update'])){
    $query = "UPDATE users SET name = '$_POST[name]', email = '$_POST[email]', mobile = '$_POST[mobile]' WHERE email = '$_SESSION[email]'";
    $query_run = mysqli_query($connection, $query);
    if($query_run){
        echo "<script type='text/javascript'>
            alert('Profile updated successfully....');
            window.location.href = 'user_dashboard.php';  
        </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Error...Plz try again.');
            window.location.href = 'user_dashboard.php';
        </script>";
    }
}

// Change password
if(isset($_POST['change_password'])){
    $query1 = "SELECT password FROM users WHERE email = '$_SESSION[email]'";
    $query_run1 = mysqli_query($connection, $query1);
    $current_password = "";
    while($row = mysqli_fetch_assoc($query_run1)){
        $current_password = $row['password'];  
    }
    if(($current_password == $_POST['currPassword']) && ($_POST['newPassword1'] == $_POST['newPassword2'])){
        $query = "UPDATE users SET password = '$_POST[newPassword1]' WHERE email = '$_SESSION[email]'";
        $query_run = mysqli_query($connection, $query);
        if($query_run){
            echo "<script type='text/javascript'>
                alert('Password changed successfully....');
                window.location.href = 'user_dashboard.php';  
            </script>";
        } else {
            echo "<script type='text/javascript'>
                alert('Error...Try again.');
                window.location.href = 'user_dashboard.php';
            </script>";
        }
    } else {
        echo "<script type='text/javascript'>
            alert('Passwords do not match or wrong current password!');
            window.location.href = 'user_dashboard.php';
        </script>";
    }
}
?>

<?php if(isset($_SESSION['email'])): ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Dashboard</title>
    <!-- Bootstrap Files -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/style.css">
    <!-- jQuery file -->
    <script type="text/javascript" src="jquery/jquery_latest.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#view_profile").click(function(){
                $("#load_section").load("viewProfile.php");
            });
            $("#change_password").click(function(){
                $("#load_section").load("changePassword.php");
            });
            $("#book_ticket").click(function(){
                $("#load_section").load("SelectMovie.php");
            });
            $("#view_ticket").click(function(){
                $("#load_section").load("viewTicket.php");
            });
            $("#cancel_ticket").click(function(){
                $("#load_section").load("cancelTicket.php");
            });
        });
    </script>
    <style>
        body {
            background-image: url('background.jpg'); /* Replace with your background image path */
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
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
.btn {
    background-color: rgba(0, 153, 0, 0.9); /* Dark gray background */
    color: #fff; /* White text */
    border: none; /* Remove border */
    transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition for background and transform */
}

.btn:hover {
    background-color: red; /* Red on hover */
    color: #fff; /* Keep text white on hover */
    transform: scale(1.07); /* Slightly increase the button size */
}


#load_section {
    background-color: #fff;
    background-color: rgba(0, 0, 0, 0.7);
    color: #333;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
}
.container {
margin-top: 100px; /* Centering the form vertically */
background-color: rgba(0, 0, 0, 0.7);
padding: 30px;
border-radius: 10px;
box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
}   
        
    </style>
</head>
<body style="overflow-x: hidden;">
       <!-- Header code starts here -->
       <div class="header" id="header">
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
                    
                </ul></p>
            </nav>
        </div>
        
    </div>
    
            
        </div>
    </div>
</div>

    <!-- Header code ends here -->
     
    <div class="row" style="margin:25px;">
    <div class="col-md-2" style="border-right:1px solid #fff;">
        <a class="btn btn-primary btn-block mb-3" id="view_profile">View Profile</a>
        <a class="btn btn-primary btn-block mb-3" id="change_password">Change Password</a>
        <a class="btn btn-primary btn-block mb-3" id="book_ticket">Book Online Ticket</a>
        <a class="btn btn-primary btn-block mb-3" id="view_ticket">View Your Ticket</a>
        <a class="btn btn-primary btn-block mb-3" id="cancel_ticket">Cancel a Ticket</a>
        <a class="btn btn-primary btn-block mb-3" href="logout.php">Logout</a>
    </div>
    <div class="col-md-8" id="load_section" style="background-color: rgba(0, 0, 0, 0.7);">
        <h5  style="font-size: 24px; color: white;">Load Section</h5>
        <p style=" color: white;">This section is used to load all the files in this section.</p>
    </div>
    <div class="col-md-2"></div>
</div>

</body>
</html>
<?php else: ?>
    <?php header('location:login.php'); ?>
<?php endif; ?>
