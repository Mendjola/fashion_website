

<?php

error_reporting(E_ERROR | E_PARSE);
session_start(); 

include "../Assets/config.php";

if (isset($_SESSION['seller_id'])) {
    $seller_id = $_SESSION['seller_id']; // Retrieve seller_id from session
} else {
    header('location:login.php');
    exit; 
}


// Add products in database
if (isset($_POST['publish'])){

    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 

    $detail = $_POST['detail'];
    $detail = filter_var($detail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 

    $stock = $_POST['stock'];
    $stock = filter_var($stock, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 

    $status = 'active';

    $image = $_FILES['image']['name'];
    $image_folder = '../uploaded_img/' . $image;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];

    $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id = ?");
    $select_image->execute([$image, $seller_id]);

    if (isset($image)){
        if ($select_image->rowCount() > 0){
            $warning[] = 'Image name repeated';
        } elseif($image_size > 2000000){
            $warning[] = 'Image size is too large';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $image = '';
    }

    if ($select_image->rowCount() > 0 && $image != ''){
        $warning[] = 'Please rename the image';
    } else {
        $insert_product = $conn->prepare("INSERT INTO `products`(id, seller_id, name, price, image, stock, product_details, product_status) VALUES(?,?,?,?,?,?,?,?)");
        $insert_product->execute([$id, $seller_id, $name, $price, $image, $stock, $detail, $status]);
        $success[] = 'Product added successfully';
    }
}

if (isset($_POST['draft'])){
    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 

    $detail = $_POST['detail'];
    $detail = filter_var($detail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 

    $stock = $_POST['stock'];
    $stock = filter_var($stock, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 

    $status = 'deactive';

    $image = $_FILES['image']['name'];
    $image_folder = '../uploaded_img/' . $image;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];

    $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id = ?");
    $select_image->execute([$image, $seller_id]);

    if (isset($image)){
        if ($select_image->rowCount() > 0){
            $warning[] = 'Image name repeated';
        } elseif($image_size > 2000000){
            $warning[] = 'Image size is too large';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $image = '';
    }

    if ($select_image->rowCount() > 0 && $image != ''){
        $warning[] = 'Please rename the image';
    } else {
        $insert_product = $conn->prepare("INSERT INTO `products`(id, seller_id, name, price, image, stock, product_details, product_status) VALUES(?,?,?,?,?,?,?,?)");
        $insert_product->execute([$id, $seller_id, $name, $price, $image, $stock, $detail, $status]);
        $success[] = 'Product saved as draft successfully';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Admin Add Products</title>
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
        

    <section class="add-products">

        <div class="form-cont">

             <div class="heading">

                 <h1>Add Product</h1>

               </div>

               
                <form action="" method="post" enctype="multipart/form-data" class="register-form">

                        <div class="input-fields">

                            <p>Product Name <span>*</span></p>
                            <input type="text" name="name" placeholder="Enter product name" maxlength="100" required class="box">
                            
                        </div>


                        <div class="input-fields">

                            <p>Product Price <span>*</span></p>
                            <input type="number" name="price" placeholder="Enter product price" maxlength="100" required class="box">

                        </div>


                        <div class="input-fields">

                            <p>Product Detail <span>*</span></p>
                            <textarea name="detail" class="box" required placeholder="Enter product detail" maxlength="500" cols="30" rows="10"></textarea>

                        </div>


                        <div class="input-fields">

                            <p>Product Stock <span>*</span></p>
                            <input type="number" name="stock" placeholder="Enter product stock" maxlength="9999999999" required class="box">

                        </div>
                        

                        <div class="input-fields">

                            <p>Product Image <span>*</span></p>
                            <input type="file" name="image" accept="image/*"  required class="box">

                        </div>

                        <div class="flex-btn">

                            <input type="submit" name="publish" value="Add Product" class="btn">
                            <input type="submit" name="draft" value="Save as Draft" class="btn">


                        </div>


            </div>

    </section>

</div>

<!-- message link -->
<?php include '../Assets/message.php'; ?>

 <!-- admin js link  -->
 <script src="../js/admin_script.js"></script>
    
</body>
</html>