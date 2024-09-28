<?php
include 'connection.php';

if ($connection) {
    echo "Database connection established successfully.";
} else {
    echo "Failed to connect to the database.";
}
?>
