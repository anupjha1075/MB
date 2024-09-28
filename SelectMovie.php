<?php
session_start();
if(isset($_SESSION['email'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap Files -->
 
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    
    <!-- CSS Files -->

    <!-- jQuery file -->
    <script type="text/javascript" src="jquery/jquery_latest.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
    // Function to get the current week starting from the last Thursday
    function getWeekDates() {
        var today = new Date();
        var day = today.getDay();
        var daysFromThursday = (day >= 4) ? (day - 4) : (day + 3);
        var weekStart = new Date(today);
        weekStart.setDate(today.getDate() - daysFromThursday);

        var dates = [];
        for (var i = 0; i < 7; i++) {
            var date = new Date(weekStart);
            date.setDate(weekStart.getDate() + i);
            if (date >= today) { // Only add dates from today onwards
                dates.push(date);
            }
        }
        return dates;
    }

    

    // Generate the date strip for the current week
    var weekDates = getWeekDates();
    var dateStrip = '';
    weekDates.forEach(function(date, index) {
        var day = date.toLocaleDateString('en-US', { weekday: 'short' });
        var dayNum = date.getDate();
        var month = date.toLocaleDateString('en-US', { month: 'short' });
        
        var isToday = index === 0;
        var isTomorrow = index === 1;
        var isEnabled = isToday || isTomorrow;
        var additionalClass = isEnabled ? 'enabled' : 'disabled';
        var disabledAttr = isEnabled ? '' : 'style="pointer-events: none; opacity: 0.5;"';
        
        dateStrip += `<div class="date-item ${additionalClass}" data-date="${date.toISOString().split('T')[0]}" ${disabledAttr}>${day}, ${month} ${dayNum}</div>`;
    });

    $('#date-strip').html(dateStrip);

    // Click event to handle date selection
    $('.date-item.enabled').on('click', function() {
        $('.date-item').removeClass('selected');
        $(this).addClass('selected');
        
        var selectedDate = $(this).data('date');
        // Fetch movies for the selected date via AJAX
        $.ajax({
            url: 'fetch_movies.php',
            type: 'POST',
            data: { date: selectedDate },
            success: function(response) {
                if (response.trim() === "") {
                    // If no movies are returned, show the maintenance day images and message
                    $('#movie-container').html(`
                        <div class="col-md-6">
                            <img src="images/hk3.png" alt="Maintenance Image 1" style="width:100%; height:300px; border-radius:10px;">
                        </div>
                        <div class="col-md-6">
                            <img src="images/hk.jpg" alt="Maintenance Image 2" style="width:100%; height:300px; border-radius:10px;">
                        </div>
                        <div class="col-12 text-center" style="margin-top:20px;">
                            <strong style="font-size: 24px; color: white;">MAINTENANCE DAY TODAY</strong>
                        </div>
                    `);
                } else {
                    // If movies are returned, show the movie cards
                    $('#movie-container').html(response);
                }
            }
        });
    });
});



    </script>
    <style>

.marquee-container {
    position: relative;
    bottom: 0;
    width: 100%;
    
    color: #fff; /* Change to your desired text color */
    padding: 10px 0; /* Adjust padding if needed */
    z-index: 1000; /* Ensure it stays on top */
}
        /* Date Strip */
        .date-strip {
            display: flex;
            justify-content: flex-start;
            background-color: rgba(0, 255, 0, 0.5);
            padding: 10px 0;
            margin-top: 20px;
            overflow-x: auto; /* Enable horizontal scrolling */
            white-space: nowrap; /* Prevent wrapping of dates */
        }
        #header {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 5px 0;
            border-bottom: 2px solid white;
        }

        .date-item {
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #222;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            color: white; /* Text color white */
            transition: all 0.3s ease; /* Smooth transition for hover effects */
        }

        .date-item:hover {
            background-color: red;
            color: #fff;
            transform: scale(1.05); /* Slightly enlarge the date item on hover */
            box-shadow: 0 0 10px rgba(255, 107, 107, 0.5); /* Add a subtle shadow */
        }

        .date-item.selected {
            background-color: #ff6b6b;
            color: #fff;
        }

        /* Movie Card */
        .movie-card {
            background-color: #333;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .movie-card img {
            max-width: 100%;
            border-radius: 10px;
        }

        .screening-time {
            margin: 10px 0;
        }

        .screening-time a {
            color: #ff6b6b;
            font-weight: bold;
            text-decoration: none;
            margin-right: 10px;
        }

        .screening-time a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Date Strip -->
    <div class="date-strip" id="date-strip"></div>

    <!-- Movie Options -->
    <div class="movie-options">
        <div id="movie-container" class="movie-container row" style="margin: 25px;"></div>
    </div>
</body>

<div class="marquee-container">
    <marquee behavior="scroll" direction="left">Movie bookings are only permitted for the day of the movie and the preceding day.
    सिनेमा बुकिंग की अनुमति केवल फिल्म के दिन और उससे पहले वाले दिन के लिए है।</marquee>
</div>
</html>
<?php  
} else {
    header('location:login.php');
}
?>
