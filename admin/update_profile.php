

<?php

       error_reporting(0);

        session_start(); 

        include "../Assets/config.php";


        if (isset($_SESSION['seller_id'])) {
            $seller_id = $_SESSION['seller_id']; // Retrieve seller_id from session
        } else {

            header('location:admin_login.php');
            exit; 
        }


        if(isset($_POST['submit'])){
            
            $select_seller =$conn->prepare("SELECT * FROM `seller` WHERE id = ? LIMIT 1");
            $select_seller->execute([$seller_id]);
            $fetch_seller = $select_seller->fetch(PDO::FETCH_ASSOC);

            $prev_pass = $fetch_seller['password'];
            $prev_image = $fetch_seller['image'];

            $name = $_POST['name'];
            $name = filter_var($name, FILTER_SANITIZE_STRING);
        

            $email = $_POST['email'];
            $email = filter_var($email, FILTER_SANITIZE_STRING);

            /* Update Name */
            if (!empty($name)){

                $update_name = $conn->prepare("UPDATE `seller` SET seller_name = ? WHERE id = ?");
                $update_name->execute([$name, $seller_id]);

                $success[] = 'Name updated successfully!';
            }

            /* Update Email */
            if (!empty($email)){

                $update_email = $conn->prepare("SELECT * FROM `seller` WHERE email = ? AND id != ?");
                $update_email->execute([$email, $seller_id]);

                if ($update_email ->rowCount()>0){

                    $warning[] = 'Email already exists!';
                }

                else{

                    $update_email = $conn->prepare("UPDATE `seller` SET email = ? WHERE id = ?");
                    $update_email->execute([$email, $seller_id]);

                    $success[] = 'Email updated successfully!';
                }

            }

            /* Update Image */

            $image = $_FILES['image']['name'];
            $image = filter_var($image, FILTER_SANITIZE_STRING);
            $ext = pathinfo($image, PATHINFO_EXTENSION);

            $rename = unique_id().'.'.$ext;
            $image_size = $_FILES['image']['size'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_folder = '../uploaded_img/'.$rename;

            if (!empty($image)){

                if ($image_size > 2000000){

                    $warning[] = 'Image size is too large!';
                }

                else{

                    $update_image = $conn->prepare("UPDATE `seller` SET image = ? WHERE id = ?");
                    $update_image->execute([$rename, $seller_id]);

                    move_uploaded_file($image_tmp_name, $image_folder);

                    if ($prev_image != '' AND $prev_image != $rename){

                        unlink('../uploaded_img/'.$prev_image);

                    }

                    $success[] = 'Image updated successfully!';
                }

            }


            /* Update Password */

            $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';

            $old_pass = $_POST['old_pass'];
            $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);

            $new_pass = $_POST['new_pass'];
            $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);

            $cpass = $_POST['cpass'];
            $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

            if ($old_pass != $empty_pass){

                if ($old_pass != $prev_pass){

                    $warning[] = 'Old password is incorrect!';

                }
                elseif ($new_pass != $cpass){

                    $warning[] = 'New password does not match!';
                }

                else{

                    if ($new_pass != $empty_pass){

                        $update_pass = $conn->prepare("UPDATE `seller` SET password = ? WHERE id = ?");
                        $update_pass->execute([$cpass, $seller_id]);
                        $success[] = 'Password updated successfully!';
                    }

                    else{

                        $warning[] = 'Please enter a new password!';

                    }


                }

            }

        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Update Seller Profile</title>
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


         <section class="form-cont">

             <div class="update_heading">

                     <h1> Update Profile Details</h1>

            </div>

             <form action="" method="post" enctype="multipart/form-data" class="register">

                 <div class="img-box">
                    <img src="../uploaded_img/<?= $fetch_profile['image']; ?>" >
                 </div>

                 <h2>Update Profile</h2>

                 <div class="flex">

                   <div class="col">

                     <div class="input-fields">
                        <p>Your name<span>*</span></p>
                        <input type="text" name="name" value="<?= $fetch_profile['seller_name']; ?>"class="box">
  
                     </div>

                     <div class="input-fields">
                        <p>Your Email<span>*</span></p>
                        <input type="email" name="email" value="<?= $fetch_profile['email']; ?>"class="box">
  
                     </div>

                     <div class="input-fields">
                        <p>Select Image<span>*</span></p>
                        <input type="file" name="image" accept ="image/*" class="box">
  
                   </div>
                </div>


                <div class="col">

                    <div class="input-fields">
                        <p>Old Password<span>*</span></p>
                        <input type="password" name="old_pass" placeholder="Enter your old password" class="box">

                    </div>

                    <div class="input-fields">
                        <p>New Password<span>*</span></p>
                        <input type="password" name="new_pass" placeholder="Enter your new password" class="box">

                    </div>

                    <div class="input-fields">
                        <p>Confirm Password<span>*</span></p>
                        <input type="password" name="cpass" placeholder="Confirm your password" class="box">

                    </div>

                </div>
            </div>

           
                <input type="submit" name="submit" value="Update" class="btn">
            
        </form>
    </section>
</div>



<!-- message link -->
<?php include '../Assets/message.php'; ?>

 <!-- admin js file link  -->
 <script src="../js/admin_script.js"></script>




    
</body>
</html>