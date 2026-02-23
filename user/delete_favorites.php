<?php
session_start();

// Include the database configuration file
require_once "../Assets/config.php";

// Check if favorite_id is provided
if(isset($_POST['favorite_id'])) {
    // Get the favorite_id from the POST data
    $favoriteId = $_POST['favorite_id'];

    try {
        // Prepare the delete query
        $deleteFavorite = $conn->prepare("DELETE FROM favorites WHERE id = ?");
        
        // Bind the favorite_id parameter
        $deleteFavorite->bindParam(1, $favoriteId, PDO::PARAM_STR);
        
        // Execute the delete query
        $deleteFavorite->execute();
        
        // Check if the delete operation was successful
        if($deleteFavorite->rowCount() > 0) {
            // Return success response if at least one row was affected
            echo json_encode(array("status" => "success", "message" => "Favorite deleted successfully."));
        } else {
            // Return error response if no rows were affected
            echo json_encode(array("status" => "error", "message" => "Failed to delete favorite."));
        }
    } catch (PDOException $e) {
        // Return error response if an exception occurs
        echo json_encode(array("status" => "error", "message" => "Failed to delete favorite: " . $e->getMessage()));
    }
} else {
    // Return error response if favorite_id is not provided
    echo json_encode(array("status" => "error", "message" => "Favorite ID not provided."));
}
?>
