<?php
error_reporting(E_ERROR | E_PARSE);
session_start(); 

include "../Assets/config.php";

if (isset($_SESSION['seller_id'])) {
    $seller_id = $_SESSION['seller_id']; // Retrieve seller_id from session
} else {
    header('location: admin_login.php');
    exit; 
}

/* Delete Product */
if (isset($_POST['delete_product'])) { 
    $p_id = $_POST['product_id']; 
    $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_product->execute([$p_id]);

    $success[] = "Product Deleted Successfully!";
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MK Store - View Products</title>
    <link rel="stylesheet" href="../css/admin.css" type="text/css">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!--Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
     <!-- sweet alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<body>

<?php include 'admin_header.php'; ?>


<section class="show-products">


    <div class="box-container" style="box-shadow: none;">
        <?php 
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id = ?");
        $select_products->execute([$seller_id]);
        
        if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="box">
            <form action="" method="post">
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <?php if ($fetch_products['image'] != '') { ?>
                    <img src="../web_components/Images/<?= $fetch_products['image']; ?>" class="image">
                <?php } ?>
                <div class="status" style="color: <?= ($fetch_products['product_status'] == 'active') ? 'green' : 'red'; ?>;"><?= $fetch_products['product_status']; ?></div>
                <div class="price"><?= $fetch_products['price']; ?>$</div>
                <div class="content">
                    <div class="title"><?= $fetch_products['name']; ?></div> 
                </div>
                <div class="flex-btn">
                    <a href="edit_product.php?id=<?= $fetch_products['id']; ?>" class="btn">Edit</a>
                    <button type="submit" class="btn" name="delete_product" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                    <a href="read_product.php?post_id=<?= $fetch_products['id']; ?>" class="btn">Read</a>
                </div>
            </form>
        </div>
        <?php 
            }
        } else {
            echo '<div class="empty"><p>No products added yet!<br><a href="add_product.php" class="btn" style="margin-top: 1rem;">Add Products</a></p></div>';
        }
        ?>
    </div>

</section>



<!-- message link -->
<?php include '../Assets/message.php'; ?>

 <!-- admin js file link  -->
 <script src="../js/admin_script.js"></script>




    
</body>
</html>