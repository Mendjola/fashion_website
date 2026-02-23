

<?php

        session_start(); 

        include "../Assets/config.php";

        if (isset($_SESSION['seller_id'])) {
            $seller_id = $_SESSION['seller_id']; // Retrieve seller_id from session
        } else {

            header('location: admin_login.php');
            exit; 
        }
        

        /* Delete message from database */

        if (isset($_POST['delete_message'])) {

            $delete_id = $_POST['delete_id'];
            $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

            $verify_delete = $conn->prepare("SELECT * FROM `message` WHERE id = ?");
            $verify_delete->execute([$delete_id]);

            if ($verify_delete->rowCount() > 0) {
                $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
                $delete_message->execute([$delete_id]);
                $success[] = 'Message deleted successfully';
            } else {
                $warning[] = 'Message not found';
            }

        }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Registered Users</title>
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


            <section class="user_container">


              <div class="heading">

                  <h1>Registered Users</h1>

              </div>


             <div class="box-container">


                <?php

                $select_users = $conn->prepare("SELECT * FROM `users`");
                $select_users->execute();
                if ($select_users->rowCount() > 0) {
                    while ($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)) {

                        $user_id = $fetch_users['id'];
                ?>


                <div class="box">

         
                    <img src="../uploaded_img/<?= $fetch_users['image']; ?>">
                    <!--<p>ID: <span> <*/?= $user_id; ?></span></p>-->
                    <p><span class="bold">Name:</span> <span><?= $fetch_users['user_name']; ?></span></p>
                     <p><span class="bold">Email:</span> <span><?= $fetch_users['email']; ?></span></p>
                  

                </div>
                <?php 

                    }
                    
                }else{

                    echo '<div class="empty"><p>No User Registered Yet</p></div>';

                }

                ?>

                


    

             </div>



    </section>


</div>



<!-- message link -->
<?php include '../Assets/message.php'; ?>

 <!-- admin js file link  -->
 <script src="../js/admin_script.js"></script>




    
</body>
</html>