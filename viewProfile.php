<?php 
    session_start();
    if(isset($_SESSION['email'])){
    include('connection.php');
    
    // Fetch user data from the database
    $query1 = "select * from users where email = '$_SESSION[email]'";
    $query_run1 = mysqli_query($connection, $query1);
    
    // Initialize variables
    $name = "";
    $email = "";
    $mobile = "";
    $org_id = "";
    $category = "";
    
    // Retrieve the user data
    while($row = mysqli_fetch_assoc($query_run1)){
        $name = $row['name'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $org_id = $row['org_id'];  // Fetch Organisation ID
        $category = $row['category'];  // Fetch Category
    }
?>
<html>
    <head>
        <!-- Bootstrap Files -->
        
     
        
        <style>
            body {
            background-image: url('background.jpg'); /* Replace with your background image path */
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
        }
            .form-group {
                display: flex;
                justify-content: space-between;
                align-items: center; /* Aligns the items vertically in the center */
            }
            .form-group label {
                margin-right: 15px;
            }
            .form-group span {
                color: white;
                vertical-align: middle; /* Ensures vertical alignment */
            }
        </style>
    </head>
    <body>
        <div class="row" style="margin:25px;">
            <div class="col-md-4">
                <center style="color: white;"><h5><u>Your Profile</u></h5></center>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email" style="color: white;">Username:</label>
                        <!-- Display email in one line and style the text -->
                        <span><?php echo $email; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="org_id" style="color: white;">Organisation ID:</label>
                        <!-- Display Organisation ID in one line -->
                        <span><?php echo $org_id; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="category" style="color: white;">Category:</label>
                        <!-- Display Category in one line -->
                        <span><?php echo $category; ?></span>
                    </div>
                
                </form>
            </div>
        </div>
    </body>
</html>
<?php  
}
else{
  header('location:login.php');
}
?>
