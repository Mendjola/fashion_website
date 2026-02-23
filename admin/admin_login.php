<?php


session_start(); 

include "../Assets/config.php";


if(isset($_POST['submit'])){


    $email=$_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $pass =$_POST['password'];
    $pass = filter_var($pass, FILTER_SANITIZE_SPECIAL_CHARS);

    $select_seller =$conn->prepare("SELECT * FROM `seller` WHERE email = ? AND password = ?");
    $select_seller->execute([$email, $pass]);
    $row = $select_seller->fetch(PDO::FETCH_ASSOC);

   if($select_seller->rowCount() > 0){

        $_SESSION['seller_id'] = $row['id'];
        header('location:dashboard.php');

   }else{
         $warning[] = 'Incorrect email or password';
   }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Seller Login</title>
    <link rel="stylesheet" href="../css/admin.css" type="text/css">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- sweet alert library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">


</head>
<body>


<div class="form-cont">

    <form action="" method="post" enctype="multipart/form-data" class="login-form">
        <h2>Login Now</h2>

        <div class="input-fields">
                            
                <p>Email <span>*</span></p>
                <div class="input-icon-container">
                     <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box" style="text-align: left;" autocomplete="email">    
                </div>
        </div>


         <div class="input-fields">

                <p>Password <span>*</span></p>
                <div class="input-icon-container">
                    <input type="password" name="password" placeholder="Enter your password" maxlength="20" required class="box" style="text-align: left;" autocomplete="current-password">
                </div>
        </div>
        


        <div class="btn-login-container">
                   <p class="account">Do not have an account? <a href="register.php">Register Now</a></p>
                   <i class="bi bi-box-arrow-in-right" style="position: relative;left: 38px;top: 46px;"></i>
                   <input type="submit" name="submit" value="login Now" class="btn-login">
                   
        </div>

   </form>

</div>




<!-- message link -->
<?php include '../Assets/message.php'; ?>


    
</body>
</html>