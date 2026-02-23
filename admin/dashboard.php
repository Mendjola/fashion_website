

<?php

        session_start(); 

        include "../Assets/config.php";

        if (isset($_SESSION['seller_id'])) {
            $seller_id = $_SESSION['seller_id']; // Retrieves seller_id from session
        } else {

            header('location:admin_login.php');
            exit; 
        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Seller Dashboard</title>
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


    <section class="dashboard">


            <div class="heading">

                <h1>Dashboard</h1>
                <h1>Dashboard</h1>


            </div>


        <div class="box-container">

            <div class="box">


                    <h2>Welcome</h2>

                    <p><?= $fetch_profile['seller_name']; ?></p>
                    <a href="update_profile.php" class="btn">Update Profile</a>

               </div>

            <div class="box">


                    <?php 
                        $select_message = $conn->prepare("SELECT * FROM `message`");
                        $select_message->execute();
                        $total_messages = $select_message->rowCount();
                    ?>


                    <h2><?= $total_messages; ?></h2>

                    <p>Unread Messages</p>
                    <a href="admin_message.php" class="btn">See Message</a>

            </div>


            <div class="box">


                    <?php 
                        $select_products = $conn->prepare("SELECT * FROM `products` where seller_id=?");
                        $select_products->execute([$seller_id]);
                        $total_products = $select_products->rowCount();
                     
                    ?>


                    <h2><?= $total_products; ?></h2>

                    <p>Products added</p>
                    <a href="add_product.php" class="btn">Add Products</a>

             </div>


             <div class="box">


                    <?php 
                        $select_active = $conn->prepare("SELECT * FROM `products` where seller_id=? AND product_status=?");
                        $select_active->execute([$seller_id, 'active']);
                        $total_active = $select_active->rowCount();
                    
                    ?>


                    <h2><?= $total_active ?></h2>

                    <p>Total Active Products</p>
                    <a href="view_product.php" class="btn">Active Product</a>

            </div>



            <div class="box">


                    <?php 
                        $select_deactive = $conn->prepare("SELECT * FROM `products` where seller_id=? AND product_status=?");
                        $select_deactive->execute([$seller_id, 'deactive']);
                        $total_deactive = $select_deactive->rowCount();
                    
                    ?>


                    <h2><?= $total_deactive; ?></h2>

                    <p>Total Deactive Products</p>
                    <a href="view_product.php" class="btn">Deactive Product</a>

            </div>



            <div class="box">


                    <?php 
                        $select_users = $conn->prepare("SELECT * FROM `users`");
                        $select_users->execute();
                        $total_users = $select_users->rowCount();
                    ?>


                    <h2><?= $total_users; ?></h2>

                    <p>Users Details</p>
                    <a href="user_information.php" class="btn">See Users</a>

            </div>


            <div class="box">


                    <?php 
                        $select_sellers = $conn->prepare("SELECT * FROM `seller`");
                        $select_sellers->execute();
                        $total_sellers = $select_sellers->rowCount();
                    ?>


                    <h2><?= $total_sellers; ?></h2>

                    <p>Sellers Details</p>
                    <a href="admin_profile.php" class="btn">See Sellers</a>

            </div>



            <div class="box">


                        <?php 
                            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id=?");
                            $select_orders->execute([$seller_id]);
                            $total_orders = $select_orders->rowCount();
                        ?>


                        <h2><?= $total_orders; ?></h2>

                        <p>Total User Orders</p>
                        <a href="admin_orders.php" class="btn">Total Orders</a>

            </div>



            <div class="box">


                    <?php 
                        $select_confirm_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id=? AND order_status=?");
                        $select_confirm_orders->execute([$seller_id, 'in progress']);
                        $total_confirm_orders = $select_confirm_orders->rowCount();
                    ?>


                    <h2><?= $total_confirm_orders; ?></h2>

                    <p>Total Confirm Orders</p>
                    <a href="admin_orders.php" class="btn">Confirm Orders</a>

            </div>


            <div class="box">


                    <?php 
                        $select_canceled_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id=? AND order_status=?");
                        $select_canceled_orders->execute([$seller_id, 'canceled']);
                        $total_canceled_orders = $select_canceled_orders->rowCount();
                    ?>


                    <h2><?= $total_canceled_orders; ?></h2>

                    <p>Total Canceled Orders</p>
                    <a href="admin_orders.php" class="btn">Canceled Orders</a>

            </div>

        </div>



    </section>


</div>



<!-- message link -->
<?php include '../Assets/message.php'; ?>

 <!-- admin script -->
 <script src="../js/admin_script.js"></script>




    
</body>
</html>