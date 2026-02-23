<?php

include "../Assets/config.php";

if(isset($_POST['submit'])){
    $id = unique_id();
    $name = $_POST['name'];
    $name = htmlspecialchars($name);

    $email = $_POST['email'];
    $email = htmlspecialchars($email);

    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];

    if(strlen($pass) < 8){
        $warning[] = 'Password must be at least 8 characters long';
    } elseif($pass != $cpass){
        $warning[] = 'Passwords do not match';
    } else {
        $image = $_FILES['image']['name'];
        $image = htmlspecialchars($image);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_img/'.$rename;

        $select_seller = $conn->prepare("SELECT * FROM `seller` WHERE email = ?");
        $select_seller->execute([$email]);

        if ($select_seller->rowCount() > 0){
            $warning[] = 'Email already taken';
            
        } elseif($image_size > 2000000){
            $error[] = 'Image size is too large';
        } else {
          
            $insert_seller = $conn->prepare("INSERT INTO `seller`(id, seller_name, email, password, image) VALUES(?,?,?,?,?)");
            $insert_seller->execute([$id, $name, $email, $pass, $rename]);

            move_uploaded_file($image_tmp_name, $image_folder);
            $success[] = 'Seller registered successfully! Please Login now';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Seller Registration</title>
    <link rel="stylesheet" href="../css/admin.css" type="text/css">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- sweet alert library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<body>


<div class="form-cont">

    <form action="" method="post" enctype="multipart/form-data" class="registration-form">
        <h2>Register Now</h2>
    
         <div class="flex">

                <div class="col">

                        <div class="input-fields">


                            <p>Full Name <span>*</span></p>
                            <input type="text" name="name" placeholder="Enter your name" maxlength="50" required class="box">

                        </div>


                        <div class="input-fields">
                            
                                <p>Email <span>*</span></p>
                                <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box">    

                        </div>

                </div>


                <div class="col">

                        <div class="input-fields">  

                            <p>Password <span>*</span></p>
                            <input type="password" name="password" placeholder="Enter your password" maxlength="20" required class="box">

                        </div>


                        <div class="input-fields">

                            <p>Confirm Password <span>*</span></p>
                            <input type="password" name="cpassword" placeholder="Confirm your password" maxlength="20" required class="box">   

                        </div>
            </div>

       </div>

    <div class="input-fields">

            <p>Profile<span>*</span></p>
            
                <input type="file" id="file-input" name="image" class="box" required >

       

    
   </div>


            <p class="account">Already have an account? <a href="admin_login.php">Login Now</a></p>

            <input type="submit" name="submit" value="Register Now" class="btn">


   </form>

</div>


<!-- message link -->
<?php include '../Assets/message.php'; ?>


    
</body>
</html>