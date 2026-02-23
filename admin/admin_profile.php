

<?php

        session_start(); 

        include "../Assets/config.php";


        if (isset($_SESSION['seller_id'])) {
            $seller_id = $_SESSION['seller_id']; // Retrieve seller_id from session
        } else {

            header('location:admin_login.php');
            exit; 
        }

        $select_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id = ?");
        $select_products->execute([$seller_id]);
        $total_products = $select_products->rowCount();

        $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ?");
        $select_orders->execute([$seller_id]);
        $total_orders = $select_orders->rowCount();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Seller Profile</title>
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


   <div class="main-container">

            <?php include 'admin_header.php'; ?>


    <section class="seller_profile">


            <div class="heading">

                <h1>Profile Details</h1>

            </div>


            <div class="details">

                <div class="seller">

                   <img src="../uploaded_img/<?= $fetch_profile['image']; ?>">
                   <h2 class="name"><?= $fetch_profile['seller_name']; ?></h2>
                   <span> Seller </span>
                   <a href="update_profile.php" class="btn">Update Profile</a>
                </div>

                <div class="flex">


                    <div class="box">
                      
                        <p>Total Products<span><?= $total_products; ?> </span></p>
                        <a href="view_product.php" class="btn">View Products</a></a>

                    </div>

                    <div class="box">
                 
                        <p>Total Orders Placed<span> <?= $total_orders; ?> </span></p>
                        <a href="admin_orders.php" class="btn">View Orders</a></a>

                    </div>

                </div>





            </div>


    </section>


</div>



<!-- message link -->
<?php include '../Assets/message.php'; ?>

 <!--admin js link  -->
 <script src="../js/admin_script.js"></script>




    
</body>
</html>