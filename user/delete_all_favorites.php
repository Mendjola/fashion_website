<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header('Location: user_login.php');
    exit;
}

// Include the database configuration file
require_once "../Assets/config.php";

// Retrieve the user ID from the session
$user_id = $_SESSION['user_id'];

try {
    // Delete all favorite products for the logged-in user
    $delete_all_favorites = $conn->prepare("DELETE FROM favorites WHERE user_id = ?");
    
    // Bind the user ID parameter as a string
    $delete_all_favorites->bindParam(1, $user_id, PDO::PARAM_STR);
    
    // Execute the SQL statement
    $delete_all_favorites->execute();
    
    // Redirect the user back to the favorites page
    header('Location: favorites.php');
    exit;
} catch (PDOException $e) {
    // Handle any exceptions
    echo "Error: " . $e->getMessage();
}
?>
