

<?php

// Starts the session
session_start(); 

// Checks if visit count is set in session, if not, initialize it to 0
if (!isset($_SESSION['visit_count'])) {
    $_SESSION['visit_count'] = 0;
}

// Checks if visit has already been counted in this session
if (!isset($_SESSION['visit_counted'])) {


    $_SESSION['visit_count']++;
   
    $_SESSION['visit_counted'] = true;
}

// Gets the last visit time from the session or sets it to null if it's not set
$lastVisitTime = isset($_SESSION['last_visit_time']) ? $_SESSION['last_visit_time'] : null;

// Updates the last visit time
$_SESSION['last_visit_time'] = date("Y-m-d H:i:s");

// Displays the last visit time and visit count

echo "Last Visit: " . $lastVisitTime . ", Visit Count: " . $_SESSION['visit_count'];

?>








