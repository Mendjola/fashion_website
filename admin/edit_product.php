<?php

session_start(); 

include "../Assets/config.php";

if (isset($_SESSION['seller_id'])) {
    $seller_id = $_SESSION['seller_id']; // Retrieve seller_id from session
} else {
    header('location:admin_login.php');
    exit; 
}

// Checks if the 'id' key is set in the $_GET array
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
} else {
    header('location: view_product.php');
    exit;
}


if (isset($_POST['update'])) {

    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $detail = $_POST['description'];
    $detail = filter_var($detail, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $stock = $_POST['stock'];
    $stock = filter_var($stock, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    // Check if 'product_status' is set before accessing it
    $status = isset($_POST['product_status']) ? filter_var($_POST['product_status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';

    $update_product = $conn->prepare("UPDATE `products` SET name = ?, price = ?, product_details = ?, stock = ?, product_status = ? WHERE id = ?");
    $update_product->execute([$name, $price, $detail, $stock, $status, $product_id]);

    $message[] = 'Product updated successfully';

    $old_image = $_POST['old_image'];

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/'.$image;

    $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id = ?");
    $select_image->execute([$image, $seller_id]);

    if ($select_image->rowCount() > 0) {
        $message[] = 'Image already exists. Please add another image or rename it!';
    } else {
        if (!empty($image)) {
            if ($image_size > 2000000) {
                $message[] = 'Image size is too large!';
            } else {
                $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
                $update_image->execute([$image, $product_id]);
                move_uploaded_file($image_tmp_name, $image_folder);

                if ($old_image != $image AND $old_image !='') {
                    unlink('../uploaded_img/'.$old_image);
                }

                $success = 'Image updated successfully';
            }
        }
    }
}

/* Delete Image */

if (isset($_POST['delete_image'])) {

    $empty_image ='';
    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $delete_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
    $delete_image->execute([ $empty_image, $product_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

    if ($fetch_delete_image !== false && $fetch_delete_image['image'] != '') {
        unlink('../uploaded_img/'.$fetch_delete_image['image']);
    }

    $unset_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
    $unset_image->execute([$empty_image, $product_id]);

    $success[] = 'image deleted successfully';


}

/* Delete Product */

if (isset($_POST['delete'])) {

    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    $delete_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
    $delete_image->execute([ ' ', $product_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);


    if ($fetch_delete_image['image'] != '') {
        unlink('../uploaded_img/'.$fetch_delete_image['image']);
    }


    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_product->execute([$product_id]);
    $success[] = 'product deleted successfully';

    header('location: view_product.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Edit Product</title>
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

        .product-editor {
            text-align: center;
            margin-top: 100px;
        }
        
        .heading h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: lightpink;
            text-transform: uppercase;
        }

        .heading h1:hover{

            color: pink;
            transform : scale(1.1);

        }
        
        .box-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .flex-btn {
            
            margin-top: 40px;
        }

        .btn {

            font-size: 1rem;
            height:3rem;
        }

        .image:hover{

            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
        }



    </style>
</head>
<body>


   <div class="main-container">

        <?php include 'admin_header.php'; ?>

  

        <section class="product-editor">


              <div class="heading">

                   <h1>Edit Product</h1>

              </div>

              <div class="box-container">

                    <?php 
                       
                        $product_id = $_GET['id'];

                        $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND seller_id =?");

                        $select_product->execute([$product_id, $seller_id]);
                        if($select_product->rowCount() > 0){
                            while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){

                    ?>
                    <div class="form-cont" style = "width: 1000px; margin: 0 auto;">


                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="old_image" value = "<?= $fetch_product['image']; ?>">

                            <input type="hidden" name="product_id" value = "<?= $fetch_product['id']; ?>">

                            <div class="input-fields">

                                <p> Product Status<span>*</span></p>

                                <select name="status" class="box" required>

                                    <option value ="<?= $fetch_product['product_status']; ?>"selected><?= $fetch_product['product_status']; ?></option>
                                    
                                    <option value="active"> Active </option>
                                    <option value="deactive"> Deactive </option>


                                </select>



                            </div>


                            <div class="input-fields">

                                    <p> Product Name<span>*</span></p>

                                    <input type="text" name="name" value = "<?= $fetch_product['name']; ?>" class="box">


                            </div>


                            <div class="input-fields">

                                    <p>Product Price<span>*</span></p>

                                    <input type="number" name="price" value = "<?= $fetch_product['price']; ?>" class="box">


                            </div>

                            
                            <div class="input-fields">

                                    <p> Product Description<span>*</span></p>

                                    <textarea name="description" class="box"> <?= $fetch_product['product_details']; ?></textarea>


                            </div>


                            <div class="input-fields">

                                    <p> Product Stock<span>*</span></p>

                                    <input type="number" name="stock" value = "<?= $fetch_product['stock']; ?>" class="box" min="0" max="9999999999" maxlength=10>


                            </div>


                            <div class="input-fields">

                                    <p> Product Image<span>*</span></p>

                                    <input type="file" name="image" accept="image/*" class="box">
                                    <?php if($fetch_product['image'] != ''){ ?>
                                        <img src="../uploaded_img/<?= $fetch_product['image']; ?>" class="image" style = "width: 200px; height:auto; margin:auto; margin-top: 25px;">
                                        
                                        
                                        <div class="flex-btn">

                                            <input type="submit" value="Delete Image" class="btn" name="delete_image" style ="width:50%; text-align:center;">
                                            <a href="view_product.php" class="btn" style="width:50%; text-align:center;" >Go back</a>
                                            
                                        </div>

                                    <?php } ?>


                             </div>

                                    <div class="flex-btn">
                                       <input type="submit" name ="update" value="Update Product" class="btn">
                                       <input type="submit" name ="delete" value="Delete Product" class="btn">
                                       
                                    </div>


                        </form>


                    </div>

                    <?php 
                    
                            }

                        } else{

                            echo '<div class="empty"><p> No products added yet!</p></div>';
                        
    

                    ?>

                             <div class="flex-btn">
                                <a href="view_product.php" class="btn">View Products"></a>
                                <a href="add_product.php" class="btn">Add Products"></a>
                             </div>
                             <?php } ?>

              </div>

    </section>

</div>



<!-- message link -->
<?php include '../Assets/message.php'; ?>


</body>
</html>