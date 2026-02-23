<?php

// Database connection details
$db_host = "localhost";
$db_port = "8889"; 
$db_name = "fashionshop_db";
$db_user_name = "root";
$db_user_password = "root";



try {
    // Create database connection
    $dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name";
    $conn = new PDO($dsn, $db_user_name, $db_user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS $db_name";
    $conn->exec($sql);
    $database_message = "Database created successfully";

    // Switch to the created database
    $conn->exec("USE $db_name");

     // Create tables
    $create_tables_sql = "
        CREATE TABLE IF NOT EXISTS `cart` (
          `id` varchar(20) NOT NULL,
          `user_id` varchar(20) NOT NULL,
          `seller_id` varchar(20) NOT NULL, 
          `product_id` varchar(20) NOT NULL,
          `price` int(50) NOT NULL,
          `qty` int(20) NOT NULL,
          `image` varchar(100) NOT NULL
        );

        CREATE TABLE IF NOT EXISTS `favorites` (
          `id` varchar(20) NOT NULL,
          `user_id` varchar(20) NOT NULL,
          `product_id` varchar(20) NOT NULL,
          `price` int(10) NOT NULL,
          `image` varchar(100) NOT NULL
        );

        CREATE TABLE IF NOT EXISTS `message` (
          `id` varchar(20) NOT NULL,
          `user_id` varchar(20) NOT NULL,
          `name` varchar(50) NOT NULL,
          `email` varchar(50) NOT NULL,
          `topic` varchar(100) NOT NULL,
          `text` varchar(1000) NOT NULL
        );

        CREATE TABLE IF NOT EXISTS `orders` (
          `id` varchar(20) NOT NULL,
          `seller_id` varchar(20) NOT NULL,
          `user_id` varchar(20) NOT NULL,
          `name` varchar(50) NOT NULL,
          `number` varchar(10) NOT NULL,
          `email` varchar(50) NOT NULL,
          `address` varchar(100) NOT NULL,
          `address_type` varchar(10) NOT NULL,
          `payment_method` varchar(50) NOT NULL,
          `product_id` varchar(20) NOT NULL,
          `price` int(10) NOT NULL,
          `qty` int(2) NOT NULL,
          `dates` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          `order_status` varchar(50) NOT NULL,
          `payment_status` varchar(100) NOT NULL
        );

        CREATE TABLE IF NOT EXISTS `products` (
          `id` varchar(20) NOT NULL,
          `seller_id` varchar(20) NOT NULL,
          `name` varchar(100) NOT NULL,
          `price` int(10) NOT NULL,
          `image` varchar(100) NOT NULL,
          `stock` int(100) NOT NULL,
          `product_details` varchar(1000) NOT NULL,
          `product_status` varchar(100) NOT NULL
        );

        CREATE TABLE IF NOT EXISTS `seller` (
          `id` varchar(20) NOT NULL,
          `seller_name` varchar(50) NOT NULL,
          `email` varchar(50) NOT NULL,
          `password` varchar(50) NOT NULL,
          `image` varchar(100) NOT NULL
        );

        CREATE TABLE IF NOT EXISTS `users` (
          `id` varchar(20) NOT NULL,
          `user_name` varchar(50) NOT NULL,
          `email` varchar(50) NOT NULL,
          `password` varchar(50) NOT NULL,
          `image` varchar(100) NOT NULL
        );

        CREATE TABLE IF NOT EXISTS `reviews` (
          id INT AUTO_INCREMENT PRIMARY KEY,
          name VARCHAR(255) NOT NULL,
          rating INT NOT NULL,
          comment TEXT NOT NULL
        );

    ";

      $conn->exec($create_tables_sql);
      $tables_message = "Tables created successfully";
  } catch(PDOException $e) {
      $error_message = "Connection failed: " . $e->getMessage();
  }
   

// Function to generate unique ID
if (!function_exists('unique_id')) {
    // Defines the unique_id function
    function unique_id() {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charsLength = strlen($chars);
        $randomString = '';
        for ($i = 0; $i < 20; $i++) {
            $randomString .= $chars[rand(0, $charsLength - 1)];
        }
        return $randomString;
    }
}

?>

<script>
    console.log("<?php echo isset($database_message) ? $database_message : ''; ?>");
    console.log("<?php echo isset($tables_message) ? $tables_message : ''; ?>");
    console.error("<?php echo isset($error_message) ? $error_message : ''; ?>");
</script>