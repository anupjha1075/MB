<?php
session_start();
include('connection.php');

// Ensure the user is logged in
if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit();
}

$email = $_SESSION['email'];
$booked_seats = isset($_POST['booked_seats']) ? explode(',', $_POST['booked_seats']) : null;

$movieName = isset($_SESSION['selected_movie']) ? $_SESSION['selected_movie'] : null;
$showTime = isset($_SESSION['show_time']) ? $_SESSION['show_time'] : null;
$showDate = isset($_SESSION['show_date']) ? $_SESSION['show_date'] : null;

if (!$booked_seats || !$movieName || !$showTime || !$showDate) {
    echo '<script>alert("Invalid booking details. Please try again."); window.location.href="bookTicket_3.php";</script>';
    exit();
}

$todayDate = date('Y-m-d');

// Fetch user category from session
$category = isset($_SESSION['category']) ? $_SESSION['category'] : null;
if (!$category) {
    echo '<script>alert("User category is not set. Please log in again."); window.location.href="login.php";</script>';
    exit();
}

// Check if the user has already booked more than 6 seats for the same movie in the current week
$startDate = date('Y-m-d', strtotime('last Friday'));
$endDate = date('Y-m-d', strtotime('next Thursday'));

// Fetch user email once at the start of the script
$userEmail = $_SESSION['email']; // Assuming this is already set in the session

// Modified query
$sqlCheck = "SELECT COALESCE(SUM(seats_count), 0) as totalBookings 
             FROM booking 
             WHERE user_id = '$userEmail' 
             AND movie_name = '$movieName' 
             AND show_date BETWEEN '$startDate' AND '$endDate' 
             AND is_cancel = 0";

$resultCheck = mysqli_query($connection, $sqlCheck);

if (!$resultCheck) {
    die("Query failed: " . mysqli_error($connection));
}

$rowCheck = mysqli_fetch_assoc($resultCheck);

// Check if total bookings exceed or equal to 6
if ($rowCheck['totalBookings'] + count($booked_seats) > 6) {
    // Redirect based on user category
    $redirectPage = '';
    switch ($category) {
        case 1:
            $redirectPage = 'bookTicket_1.php';
            break;
        case 2:
            $redirectPage = 'bookTicket_2.php';
            break;
        case 3:
            $redirectPage = 'bookTicket_3.php';
            break;
        case 4:
            $redirectPage = 'bookTicket_4.php';
            break;
        default:
            $redirectPage = 'bookTicket_3.php'; // Default redirection if category is not set correctly
    }
    echo '<script>alert("You cannot book more than 6 seats for this movie in the current week."); window.location.href="' . $redirectPage . '";</script>';
    exit();
}


// Insert the seat bookings into the database
// Calculate the seat count
$seatsCount = count($booked_seats);
$bookedSeats = implode(',', $booked_seats);

// Modified insert query using email directly from the session
$sqlInsert = "INSERT INTO booking (booked_seats, seats_count, user_id, movie_name, show_time, show_date, booking_time, is_cancel, category) 
              VALUES ('$bookedSeats', '$seatsCount', '$userEmail', '$movieName', '$showTime', '$showDate', NOW(), 0, '$category')";

if (!mysqli_query($connection, $sqlInsert)) {
    die("Insert failed: " . mysqli_error($connection));
}


echo '<script>alert("Booking confirmed!"); window.location.href="user_dashboard.php";</script>';
?>
