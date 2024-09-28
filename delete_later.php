<?php
session_start();
if (isset($_SESSION['email'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap Files -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/style.css">
    <!-- jQuery file -->
    <script type="text/javascript" src="jquery/jquery_latest.js"></script>

    <style>
        body {
            background-image: url('images/background.jpg');
            background-size: cover;
            background-position: center;
        }

        /* Header Styling */
        #header {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 10px;
            margin-bottom: 20px;
        }
        #auditorium-name {
            color: white;
            text-align: center;
            font-size: 32px;
            margin: 0;
        }
        .navbar-nav {
            justify-content: center;
        }
        .navbar-nav li {
            margin-left: 20px;
        }
        .nav-link {
            color: white !important;
        }

        /* Seat Card */
        .seat-card {
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 15px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
            width: 90%;
            margin: 0 auto;
            overflow-x: auto;
        }

        .seat {
            width: 30px;
            height: 30px;
            border-radius: 5px;
            background-color: #ddd;
            margin: 5px;
            display: inline-block;
            text-align: center;
            line-height: 30px;
            cursor: pointer;
        }

        .seat.selected {
            background-color: lightgreen;
        }

        .aisle {
            width: 30px;
            height: 30px;
            margin: 5px;
            background-color: #222;
            color: white;
            text-align: center;
            line-height: 30px;
            border-radius: 5px;
        }

        .seat:hover {
            background-color: lightblue;
        }

        .disabled {
            background-color: #444;
            cursor: not-allowed;
        }

        .btn-confirm {
            margin-top: 20px;
        }

        /* Horizontal Aisle */
        .horizontal-aisle {
            height: 20px;
        }

        /* Screen */
        .screen {
            width: 90%;
            height: 30px;
            background-color: #444;
            color: white;
            text-align: center;
            line-height: 30px;
            margin: 20px auto;
            font-size: 18px;
            border-radius: 5px;
        }

        .row-alphabet {
            color: white;
        }

        /* Removing borders from table */
        table {
            border-collapse: collapse;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.seat').on('click', function() {
                if (!$(this).hasClass('disabled')) {
                    $(this).toggleClass('selected');
                }
            });

            // Limit to 6 seats per user
            $('form').on('submit', function(e) {
                var selectedSeats = $('.seat.selected').length;
                if (selectedSeats > 6) {
                    e.preventDefault();
                    alert('You cannot book more than 6 seats for this movie.');
                }
            });
        });
    </script>
</head>
<body>
    <!-- Header Code Starts Here -->
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
    <!-- Header Code Ends Here -->

    <div class="container">
        <div class="seat-card">
            <div class="screen">SCREEN</div>
            <h1 class="text-center text-white">Select Your Seats</h1>
            <form action="confirm_booking.php" method="POST">
                <table class="table text-center">
                    <?php
                    // Define row data with the number of seats per row
                    $rows = [
                        'R' => 37, 'S' => 37, 'T' => 35,
                        'U' => 33, 'V' => 33, 'W' => 31, 'X' => 29, 'Y' => 40, 
                        'Z' => 18, 'AA' => 18
                    ];

                    // Define aisle details for each row
                    $aislePositions = [
                        'R' => [14, 23], 
                        'S' => [14, 23], 'T' => [13, 22], 'U' => [12, 21],
                        'V' => [12, 21], 'W' => [11, 20], 'X' => [10, 19], 
                        'Y' => [9, 30], 'Z' => [], 'AA' => []
                    ];

                    

                  

                    // Loop through each row
                    foreach ($rows as $row => $seatCount) {
                        echo '<tr>';
                        echo '<td class="row-alphabet">' . $row . '</td>';

                        // Add two extra seats for rows E, F,

                        if ($row == 'W') {
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                        }

                        if ($row == 'X'||$row == 'Y') {
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                        }

                        if ($row == 'Z'||$row == 'AA') {
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                        }
                        
                        if ($row == 'U'||$row == 'V') {
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                        }

                        // Add two extra seats for rows E, F,
                        if ($row == 'T' ) {
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                        }
                        // Add two extra seats for rows E, F,
                        if ($row == 'I' || $row == 'J'||$row == 'K' ) {
                            echo '<td><div class="seat disabled" data-seat="' . $row . '-1"></div></td>';
                            echo '<td><div class="seat disabled" data-seat="' . $row . '-1"></div></td>';
                            echo '<td><div class="seat disabled" data-seat="' . $row . '0"></div></td>';
                           
                            
                        }
                        // Add two extra seats for rows E, F,
                        if ($row == 'L' || $row == 'M'||$row == 'N' || $row == 'O' || $row == 'P') {
                            echo '<td><div class="seat disabled" data-seat="' . $row . '-1"></div></td>';
                            echo '<td><div class="seat disabled" data-seat="' . $row . '-1"></div></td>';
                        }
                        // Add two extra seats for rows E, F,
                        if ($row == 'Q' ) {
                            echo '<td><div class="seat disabled" data-seat="' . $row . '-1"></div></td>';
                        
                        }
                        // Add two extra seats for rows E, F,
                        if ($row == 'R' || $row == 'S') {
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                           
                            
                        }

                        
                


                        
                        if (($row == 'A' || $row == 'B') && ($seat == 26)) {
                            //echo '<td></td>'; // Blank seat
                            echo '<td><div class="seat disabled" data-seat="' . $row . '0"></div></td>';
                            
                        }

                         // Disable seats 13-25 in rows A and B
                         if (($row == 'A' || $row == 'B') && $seat >= 13 && $seat <= 25) {
                            echo '<td><div class="seat disabled" data-seat="' . $row . $seat . '">' . $seat . '</div></td>';
                      } 

                        // Handle each seat in the row
                        for ($seat = $seatCount; $seat >= 1; $seat--) {

                           

                            if (($row == 'A' || $row == 'B') && ($seat == 25)) {
                                echo '<td></td>'; // Blank seat
                               
                                
                            }


                            if (($row == 'A' || $row == 'B') && ($seat == 12    )) {
                                echo '<td></td>'; // Blank seat
                               
                                
                            }

                            if (($row == 'A' || $row == 'B'||$row == 'C' || $row == 'D') && ($seat == 12    )) {
                                echo '<td></td>'; // Blank seat
                                
                               
                                
                            }

                            if (($row == 'E' || $row == 'F'||$row == 'G' ) && ($seat == 13    )) {
                                echo '<td></td>'; // Blank seat
                                
                               
                                
                            }
                            if (($row == 'H' || $row == 'I'||$row == 'J'||$row == 'K' ) && ($seat == 14    )) {
                                echo '<td></td>'; // Blank seat
                               
                                
                            }
                            if (($row == 'L' ) && ($seat == 15    )) {
                                echo '<td></td>'; // Blank seat
                                
                               
                                
                            }

                            if (($row == 'Z' || $row == 'AA') && ($seat == 9)) {
                                echo '<td></td>'; // Blank seat
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td><div class="seat " data-seat="' . $row . '0">' . $seat . '</div></td>';
                                
                                
                            }

                          
                            // Disable seats 13-25 in rows A and B
                        if (($row == 'A' || $row == 'B') && $seat >= 13 && $seat <= 25) {
                            echo '<td><div class="seat disabled" data-seat="' . $row . $seat . '">' . $seat . '</div></td>';
                      }

                      

                          

                      
                            elseif (in_array($seat, $aislePositions[$row])) {
                                // Add an aisle between specified positions
                                echo '<td><div class="aisle"></div></td>';
                                // Print the seat after the aisle
                                echo '<td><div class="seat" data-seat="' . $row . $seat . '">' . $seat . '</div></td>';
                            } else {
                                // Normal seats
                                echo '<td><div class="seat" data-seat="' . $row . $seat . '">' . $seat . '</div></td>';
                            }
                        }

                        

            

                        // Add two horizontal white lines between rows H and I
    if ($row == 'H' || $row=='Q') {
        // First line
        echo '<tr>';
        echo '<td colspan="' . ($seatCount + 1) . '" style="border-top: 1px solid white;"></td>';
        echo '</tr>';

       
    }
                    }
                    ?>
                </table>
                <center><button type="submit" class="btn btn-primary btn-confirm">Confirm Seats</button></center>
               
            </form><br></br>
            <center><a href="user_dashboard.php" class="btn btn-primary">Go Back</a></center>
        </div>
    </div>
</body>
</html>
<?php
} else {
    header('Location: login.php');
}
?>
