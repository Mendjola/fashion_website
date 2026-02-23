

<?php

        session_start(); 

        include "../Assets/config.php";

        if (isset($_SESSION['seller_id'])) {
            $seller_id = $_SESSION['seller_id']; // Retrieve seller_id from session
        } else {

            header('location:admin_login.php');
            exit; 
        }
        

        /* Update from Database */

        if (isset($_POST['update_order'])) {
            if (isset($_POST['update_payment'])) {
                $order_id = $_POST['order_id'];
                $update_payment = $_POST['update_payment'];
                
                $update_payment_query = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
                $update_payment_query->execute([$update_payment, $order_id]);
                
                $success = "Payment status has been updated";
            } else {
                $warning = "Payment status is not set";
            }
        }
        

        /* Delete Order */

        if (isset($_POST['delete_order'])) {
            $delete_id = $_POST['order_id'];
        
            $verify_delete = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
            $verify_delete->execute([$delete_id]);
        
            if ($verify_delete->rowCount() > 0) {
                $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
                $delete_order->execute([$delete_id]);
                $success = "Order has been deleted";
            } else {
                $warning = "Order not found";
            }
        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Order Page</title>
    <link rel="stylesheet" href="../css/admin.css" type="text/css">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!--Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
     <!-- sweet alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <style>

       .select-container {
            margin-right: 400px;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        .select-container select {
            width: 150px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
            background-color: #fff;
        }
        



    </style>
</head>
<body>


   <div class="main-container">

            <?php include 'admin_header.php'; ?>


            <section class="order_container">


              <div class="heading">

                  <h1>Total Orders Placed</h1>

              </div>


             <div class="box-container" style="width: 1000px;">

                 
                  <?php

                   $select_orders = $conn->prepare("SELECT o.*, u.user_name AS user_name FROM orders o INNER JOIN users u ON o.user_id = u.id WHERE o.seller_id = ?");
                   $select_orders->execute([$seller_id]);
                   if ($select_orders->rowCount() > 0) {
                       while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {

                  ?>


                <div class="box">
                    
                    <div class="status" style="margin-left: 25px; color: <?php if($fetch_orders['order_status']=='in progress'){echo "green";}else{echo "red";}?>"><?= $fetch_orders['order_status']; ?></div>
                    
                    <div class="details">
                        <p>User Name:<span><?= $fetch_orders['user_name']; ?></span></p>
                        <p>Placed on: <span><?= $fetch_orders['dates']; ?></span></p>
                        <p>User Phone Number: <span><?= $fetch_orders['number']; ?></span></p>
                        <p>User Email: <span><?= $fetch_orders['email']; ?></span></p>
                        <p>Total Price: <span>$<?= $fetch_orders['price']; ?></span></p>
                        <p>Payment Method: <span><?= $fetch_orders['payment_method']; ?></span></p>
                        <p>User Address: <span><?= $fetch_orders['address']; ?></span></p>
                    </div>

                    <form action="" method="post">

                        <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                        <div class="select-container">
                            <select name="update_payment">
                                <option disabled selected><?= $fetch_orders['payment_status']; ?></option>
                                <option value="pending">Pending</option>
                                <option value="completed">Order Completed</option>
                            </select>
                        </div>

                       <div class="flex-btn" style=" gap: 15px;">
                        <input type="submit" value="Update Payment" class="btn" name="update_order">
                        <input type="submit" value="Delete Order" class="btn" name="delete_order" onclick="return confirm('Delete this order?');">
                       </div>
                
                    </form>

                </div>

                <?php 
                   }
                   } else {
                       echo '<p class="empty">No orders placed yet!</p>';
                   }
                ?>
             

             </div>



    </section>


</div>



<!-- message link -->
<?php include '../Assets/message.php'; ?>

 <!-- admin js link  -->
 <script src="../js/admin_script.js"></script>




    
</body>
</html>