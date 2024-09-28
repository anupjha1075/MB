<?php
session_start();

if (isset($_SESSION['email'])) {
    include('connection.php');

    $user_id = $_SESSION['email']; // Ensure this is correct
    $todayDate = date('Y-m-d');
    $startDate = date('Y-m-d', strtotime('last Friday'));
    $endDate = date('Y-m-d', strtotime('next Thursday'));

    // Query to fetch bookings for the current week including show_date, user_name, and movie name
    $query = "SELECT b.*, u.email AS user_email, m.name AS movie_name FROM booking b
              JOIN users u ON b.user_id = u.email
              JOIN movies m ON b.movie_name = m.id
              WHERE b.user_id = '$user_id' 
              AND b.is_cancel = 0 
              AND DATE(b.show_date) BETWEEN '$startDate' AND '$endDate'";
    $query_run = mysqli_query($connection, $query);

    if (!$query_run) {
        die("Query failed: " . mysqli_error($connection));
    }

    // Check if there are results
    
    if (mysqli_num_rows($query_run) == 0) {
        $message = "There are no bookings for this week.";
    } else {
        $message = '';
        while ($row = mysqli_fetch_assoc($query_run)) {
            $booked_seats = $row['booked_seats']; 
            $booking_time = $row['booking_time'];
            $show_date = $row['show_date'];
            $user_email = $row['user_email'];
            $movie_name = $row['movie_name'];

            if ($booked_seats == "") {
                $message .= "<p>No seats booked.</p>";
            } else {
                $message .= "<div class='booking-details'>";
                $message .= "<p>Username: " . htmlspecialchars($user_email) . "</p>";
                $message .= "<p>You Booked: <span class='seat-numbers'>";
                foreach (explode(',', $booked_seats) as $seat) {
                    $message .= htmlspecialchars($seat) . " , ";
                }
                $message .= "</span></p>";
                $message .= "<p>Movie Name: " . htmlspecialchars($movie_name) . "</p>";
                $message .= "<p>Show Time: " . htmlspecialchars($row['show_time']) . "</p>";
                $message .= "<p>Show Date: " . date('d-m-Y', strtotime($show_date)) . "</p>";
                $message .= "<p>Booking Time: " . htmlspecialchars($booking_time) . "</p>";
                $message .= "</div>";

                

                
            }
        }
    }
} else {
    header('location: login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bookings</title>
  
    <style>
        body {
            background-image: url('images/background.jpg');
            background-size: cover;
            background-position: center;
            color: white; /* Ensures all text is white */
        }
        .container {
            margin-top: 20px;
        }
        .instructions {
            background-color: rgba(0, 255, 0, 0.4);
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            color: white; /* Ensures instruction text is white */
        }
        .booking-details {
            background-color: rgba(0, 255, 0, 0.4);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            color: white; /* Ensures booking details text is white */
        }
        .seat-numbers {
            font-size: 2em; /* Enlarged seat numbers */
            color: white; /* Ensures seat numbers are white */
        }
        h3 {
            margin-top: 20px;
            color: white; /* Ensures heading text is white */
        }
    </style>
</head>
<body>
 
        <h3><u>Movie Ticket</u></h3>
        <?php echo $message; ?>
        <h3><u>Instructions</u></h3>
        <p class="instructions">
        
            1. Please adhere to dress regulations.<br>
            2. Please reach on time.<br>
            3. Control your wards from running around and jumping on the seats of the auditorium.
        </p>
  
</body>
</html>
