<?php
session_start();



if (isset($_GET['movie_id']) && isset($_GET['time']) && isset($_GET['date'])) {
    $_SESSION['selected_movie'] = $_GET['movie_id'];
    $_SESSION['show_time'] = $_GET['time'];
    $_SESSION['show_date'] = $_GET['date'];
}

$seats = [];



if (isset($_SESSION['email'])) {
    include('connection.php');
    $movie_name = $_SESSION['selected_movie'];
    $show_time = $_SESSION['show_time'];
    $show_date = $_SESSION['show_date'];

    // Fetch booked seats for the selected movie, time, and date
    $query = "SELECT booked_seats FROM booking WHERE is_cancel = 0 AND movie_name='$movie_name' AND show_time='$show_time' AND show_date='$show_date'";
    $query_run = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        $booked_seats = $row['booked_seats'];
        $seats = array_merge($seats, explode(',', $booked_seats));
    }
}

// Debugging purposes
//echo 'Booked Seats: ' . implode(', ', $seats);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="jquery/jquery_latest.js"></script>

    <style>

.marquee-container {
    position: relative;
    bottom: 0;
    width: 100%;
    
    color: #fff; /* Change to your desired text color */
    padding: 10px 0; /* Adjust padding if needed */
    z-index: 1000; /* Ensure it stays on top */
}
        body {
            background-image: url('images/background.jpg');
            background-size: cover;
            background-position: center;
        }

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

        .disabled {
            background-color: #FFA500;
            cursor: not-allowed;
        }

        .btn-confirm {
            margin-top: 20px;
        }

        .horizontal-aisle {
            height: 20px;
        }

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

        .legend {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
    gap: 20px; /* Adds spacing between the legend items */
    color: white;
}

.legend-item {
    display: flex;
    align-items: center;
}

        .legend .available {
            background-color: #ddd;
        }

        .legend .selected {
            background-color: lightgreen;
        }

        .legend .disabled {
            background-color: #FFA500;
        }
    </style>
</head>
<body>
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
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="seat-card">
            <div class="screen">SCREEN</div>
            <h1 class="text-center text-white">Select Your Seats</h1>

            <!-- Legend -->
<div class="legend d-flex justify-content-center">
    <div class="legend-item">
        <span class="seat available"></span> Available
    </div>
    <div class="legend-item">
        <span class="seat selected"></span> Selected
    </div>
    <div class="legend-item">
        <span class="seat disabled"></span> Booked
    </div>
</div>

<div class="marquee-container">
    <marquee behavior="scroll" direction="left">Only 25 % Seats are available for booking on trial basis. This will be subsequently increased based on booking demands. 
        परीक्षण के आधार पर बुकिंग के लिए केवल 25% सीटें उपलब्ध हैं। बाद में बुकिंग की मांग के आधार पर इसे बढ़ाया जाएगा।.</marquee>
</div>

            <form action="confirm_booking.php" method="POST" id="seatForm">
                <input type="hidden" name="booked_seats" id="booked_seats" value="">
                <input type="hidden" name="movie_name" value="<?php echo htmlspecialchars($_SESSION['selected_movie']); ?>">
                <input type="hidden" name="time" value="<?php echo htmlspecialchars($_SESSION['show_time']); ?>">
                <input type="hidden" name="show_date" value="<?php echo htmlspecialchars($_SESSION['show_date']); ?>">
                
                <table class="table text-center">
                <?php
                    // Define row data with the number of seats per row
                    $rows = [
                       // 'A' => 36, 'B' => 36, 'C' => 37, 'D' => 37, 'E' => 38, 
                        //'F' => 39, 'G' => 39, 'H' => 40, 'I' => 41, 'J' => 41,
                        //'K' => 41, 'L' => 43, 'M' => 44, 
                        
                        'N' => 44, 'O' => 44, 
                        'P' => 45, 'Q' => 46
                    ];

                    // Define aisle details for each row
                    $aislePositions = [
                        'A' => [13, 25], 'B' => [13, 25], 
                        'C' => [12, 25], 'D' => [12, 25], 'E' => [13, 26],
                        'F' => [13, 26], 'G' => [13, 26], 'H' => [14, 27], 'I' => [14, 27], 
                        'J' => [14, 27], 'K' => [14, 27], 'L' => [15, 28], 
                        'M' => [15, 29], 'N' => [15, 29], 'O' => [15, 29], 
                        'P' => [16, 30], 'Q' => [16, 30] 
                    ];

                    

                  

                    // Loop through each row
                    foreach ($rows as $row => $seatCount) {
                        echo '<tr>';
                        echo '<td class="row-alphabet">' . $row . '</td>';

                        

                        // Add two extra seats for rows E, F,

                        if ($row == 'A' || $row == 'B'||$row == 'W') {
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
                        
                        if ($row == 'C' || $row == 'D' || $row == 'E'||$row == 'U'||$row == 'V') {
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                        }

                        // Add two extra seats for rows E, F,
                        if ($row == 'F' || $row == 'G'||$row == 'H'||$row == 'T' ) {
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            
                        }
                        // Add two extra seats for rows E, F,
                        if ($row == 'I' || $row == 'J'||$row == 'K' ) {
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                           
                            
                        }
                        // Add two extra seats for rows E, F,
                        if ($row == 'L' || $row == 'M'||$row == 'N' || $row == 'O' || $row == 'P') {
                            echo '<td></td>'; // Blank seat
                            echo '<td></td>'; // Blank seat
                        }
                        // Add two extra seats for rows E, F,
                        if ($row == 'Q' ) {
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
                            $seat_id = $row . $seat;

                           

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

                            

                            // Check if the seat is already booked
                            $is_booked = in_array($seat_id, $seats);
                            $class = 'seat';
                            $disabled = false;

                            if ($is_booked) {
                                $class = 'seat disabled';
                            }

                          
                            // Disable seats 13-25 in rows A and B
                        if (($row == 'A' || $row == 'B') && $seat >= 13 && $seat <= 25) {
                            echo '<td></td>';
                      }

                   

                      

                          

                      
                            elseif (in_array($seat, $aislePositions[$row])) {
                                // Add an aisle between specified positions
                                echo '<td><div class="aisle"></div></td>';
                                // Print the seat after the aisle
                                echo '<td><div class="seat" data-seat="' . $row . $seat . '">' . $seat . '</div></td>';
                            } else {
                                // Generate the seat (with booked seat check)
                            $is_booked = in_array($seat_id, $seats);
                            $class = $is_booked ? 'seat disabled' : 'seat';
                            echo '<td><div class="' . $class . '" data-seat="' . $seat_id . '">' . $seat . '</div></td>';
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
                <button type="submit" class="btn btn-primary btn-confirm">Confirm Seats</button>
            </form>
            <a href="user_dashboard.php" class="btn btn-primary">Go Back</a>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.seat').on('click', function() {
                if (!$(this).hasClass('disabled')) {
                    $(this).toggleClass('selected');
                }
            });

            $('#seatForm').on('submit', function(e) {
                var selectedSeats = $('.seat.selected').map(function() {
                    return $(this).data('seat');
                }).get().join(',');

                $('#booked_seats').val(selectedSeats);

                if (selectedSeats.length === 0) {
                    alert('No seats selected. Please select at least one seat.');
                    e.preventDefault(); // Prevent form submission
                }
            });
        });
    </script>
</body>
</html>
