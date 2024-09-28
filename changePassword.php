<?php 
session_start();
if (isset($_SESSION['email'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>

    <!-- Custom CSS -->
  
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
        
        h5 {
            color: #ffd700; /* Gold color for the heading */
        }
        
        
        .form-control {
            background-color: rgba(255, 255, 255, 0.9); /* Light background for input fields */
            color: #333;
        }
        .form-control::placeholder {
            color: #666; /* Placeholder color */
        }
        .btn-danger {
    background-color: red;
    border: none;
    width: 260px;   /* Set the desired width */
    height: 40px;   /* Set the desired height */
}
        .btn-danger:hover {
            background-color: #e77370;
        }
    </style>
</head>
<body>
    
        <div class="row justify-content-center">
            <div class="col-md-6">
                <center><h5><u>Change Your Password</u></h5></center>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="currPassword">Current Password:</label>
                        <input type="password" class="form-control" name="currPassword" placeholder="Current password" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword1">New Password:</label>
                        <input type="password" class="form-control" name="newPassword1" placeholder="New password" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword2">Confirm Password:</label>
                        <input type="password" class="form-control" name="newPassword2" placeholder="Confirm password" required>
                    </div>
                    <button type="submit" class="btn btn-danger btn-block" name="change_password">Change Password</button>
                </form>
            </div>
       
    </div>
</body>
</html>
<?php 
} else {
    header('location:login.php');
}
?>
