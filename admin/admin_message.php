

<?php

        session_start(); 

        include "../Assets/config.php";

        if (isset($_SESSION['seller_id'])) {
            $seller_id = $_SESSION['seller_id']; // Retrieve seller_id from session
        } else {

            header('location:admin_login.php');
            exit; 
        }
        

        /* Delete message from database */

        if (isset($_POST['delete_message'])) {

            $delete_id = $_POST['delete_id'];

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
    <title>MK Store - Messages</title>
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


        .main-container{

            margin-top: 100px;
        }


        .heading {
            text-align: center;
            margin-bottom: 20px;
        }

        .heading h1 {

            font-size: 35px;
            font-weight: bold;
            text-transform: uppercase;
            color: lightpink;
            margin-top: 25px;
        }

        .box-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .box {
            background-color: #f2f2f2;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .box h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .box h3 {
            font-size: 18px;
            color: #666;
            margin-bottom: 10px;
        }

        .box p {
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
        }

        .empty {
            text-align: center;
            color: #666;
        }



    </style>
</head>
<body style="overflow-y: auto;">


   <div class="main-container">

            <?php include 'admin_header.php'; ?>



              <div class="heading">

                  <h1>Unread Messages</h1>

              </div>


             <div class="box-container">

                <?php 

                    $select_messages = $conn->prepare("SELECT * FROM `message`");
                    $select_messages->execute();

                    if ($select_messages->rowCount() > 0) {
                        while ($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)) {


                ?>


                <div class="box">
                    <h2 class="name" style="color:black;"><?= $fetch_messages['name']; ?></h2>
                    <h3><?= $fetch_messages['topic']; ?></h3>
                    <p><?= $fetch_messages['text']; ?></p>

                    <form action="" method="post">
                        <input type="hidden" name="delete_id" value="<?= $fetch_messages['id']; ?>">
                        <input type="submit" name="delete_message" value="Delete Message" class="btn" onclick="return confirm('Delete this message?');">
                    </form>

                </div>  
                

                <?php
                        }
                    } else {
                        echo '<p class="empty">No Messages Yet!</p>';
                    }
                ?>

             </div>



</div>



<!-- message link -->
<?php include '../Assets/message.php'; ?>

    
</body>
</html>