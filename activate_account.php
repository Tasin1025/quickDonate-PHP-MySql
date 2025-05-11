<?php
// Start session
session_start();

// Include the database connection file
include('config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

// Fetch user data from the database
$user_id = $_SESSION['user_id']; // Get user ID from session
$sql = "UPDATE users SET status = 'active' WHERE id = '$user_id'";

// Execute the query and check if it was successful
if ($conn->query($sql) === TRUE) {
    // Account activated, redirect to the dashboard or show success message
    header("Location: user_dashboard.php");
    exit;
} else {
    // Error in activating account
    echo "Error: " . $conn->error;
}
?>
