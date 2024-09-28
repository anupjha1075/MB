<?php
session_start();
include('connection.php');

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    // Get the user's category from the session
    $email = $_SESSION['email'];
    $query = "SELECT category FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $category = $user['category'];
    } else {
        echo 'User not found.';
        exit();
    }
} else {
    echo 'User not logged in.';
    exit();
}

$date = $_POST['date'];

// Query to fetch movies and their showtimes for the selected date
$query = "
    SELECT movies.id, movies.name, movies.logo, screenings.screening_time 
    FROM movies 
    JOIN screenings ON movies.id = screenings.movie_id 
    WHERE screenings.screening_date = '$date'
    ORDER BY movies.name, screenings.screening_time
";
$query_run = mysqli_query($connection, $query);

$movies = [];
while ($row = mysqli_fetch_assoc($query_run)) {
    $movie_id = $row['id'];
    $movie_name = $row['name'];
    $movie_image = 'images/' . $row['logo']; // Adjust path as necessary
    $show_time = date('H:i', strtotime($row['screening_time'])); // Format the time
    
    if (!isset($movies[$movie_id])) {
        $movies[$movie_id] = [
            'name' => $movie_name,
            'image' => $movie_image,
            'times' => []
        ];
    }
    
    $movies[$movie_id]['times'][] = $show_time;
}

foreach ($movies as $movie_id => $movie) {
    echo '
    <div class="col-md-4 movie-card">
        <img src="' . $movie['image'] . '" alt="' . $movie['name'] . '" class="movie-image">
        <h5>' . $movie['name'] . '</h5>
        <div class="screening-times">';
    
    foreach ($movie['times'] as $index => $time) {
        if ($index % 3 == 0 && $index != 0) {
            echo '<div class="clearfix"></div>'; // Force new row every 3 times
        }
        // Create a booking URL based on the category
        $booking_url = "bookTicket_{$category}.php?movie_id=$movie_id&time=$time&date=$date";
        echo '<a href="' . $booking_url . '" class="time-link">' . $time . '</a> ';
    }

    echo '</div></div>';
}
?>
