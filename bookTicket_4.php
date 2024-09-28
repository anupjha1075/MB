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
echo 'Booked Seats: ' . implode(', ', $seats);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="jquery/jquery_latest.js"></script>

    <style>
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

            <form action="confirm_booking.php" method="POST" id="seatForm">
                <input type="hidden" name="booked_seats" id="booked_seats" value="">
                <input type="hidden" name="movie_name" value="<?php echo htmlspecialchars($_SESSION['selected_movie']); ?>">
                <input type="hidden" name="time" value="<?php echo htmlspecialchars($_SESSION['show_time']); ?>">
                <input type="hidden" name="show_date" value="<?php echo htmlspecialchars($_SESSION['show_date']); ?>">
                
                <table class="table text-center">
                    <?php
                    $rows = ['A' => 32, 'B' => 32, 'C' => 32, 'D' => 34, 'R' => 23];
                    $aislePositions = ['A' => [23, 9], 'B' => [23, 9], 'C' => [23, 9], 'D' => [24, 10], 'R' => [7, 16]];

                    
                    
                    foreach ($rows as $row => $seatCount) {
                        echo '<tr class="' . ($row == 'R' ? 'row-r' : '') . '">';
                        echo '<td class="row-alphabet">' . $row . '</td>';
                        
                        for ($seat = $seatCount; $seat >= 1; $seat--) {
                            $seat_id = $row . $seat;
                            
                            if (($row == 'A' || $row == 'B' || $row == 'C') && ($seat == 9 || $seat == 32)) {
                                echo '<td></td>';
                            }

                            if (($row == 'R' && ($seat == 7 || $seat == 16 || $seat == 23))) {
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                
                            }

                            // Manually disable seats 10 to 14 in row 'R'
                            if ($row == 'R' && $seat >= 10 && $seat <= 14) {
                                echo '<td></td>';
                                continue; // Skip generating seat again for these positions
                            }

                            // Check for aisle positions (in the rows A, B, C, D, R)
                            if (in_array($seat, $aislePositions[$row])) {
                                // Add aisle
                                echo '<td><div class="aisle"></div></td>';
                            }

                            // Check if the seat is already booked
                            $is_booked = in_array($seat_id, $seats);
                            $class = 'seat';
                            $disabled = false;

                            if ($is_booked) {
                                $class = 'seat disabled';
                            }

                            // Generate the seat (with booked seat check)
                            $is_booked = in_array($seat_id, $seats);
                            $class = $is_booked ? 'seat disabled' : 'seat';
                            echo '<td><div class="' . $class . '" data-seat="' . $seat_id . '">' . $seat . '</div></td>';
                        }
                        echo '</tr>';
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
