<?php
session_start();
include "../Assets/config.php";

if (!isset($_SESSION['seller_id'])) {
    header('location: admin_login.php');
    exit;
}

$seller_id = $_SESSION['seller_id'];

// Check if 'post_id' is set in the URL parameters
if (isset($_GET['post_id'])) {
    $get_id = $_GET['post_id']; // Assign the value to $get_id
    $product_id = $get_id; // Assign it to $product_id for consistency
} else {
    // Redirect the user to view_product.php or display an error message
    header('location: view_product.php');
    exit;
}

/* Delete Product */
if (isset($_POST['delete'])) {
    $p_id = $_POST['product_id'];
    $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

    $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND seller_id = ?");
    $delete_image->execute([$p_id, $seller_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
    if ($fetch_delete_image && $fetch_delete_image['image'] != '') {
        unlink('../uploaded_img/' . $fetch_delete_image['image']);
    }

    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ? AND seller_id = ?");
    $delete_product->execute([$p_id, $seller_id]);
    header("location:view_product.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Product Information</title>
    <link rel="stylesheet" href="../css/admin.css" type="text/css">



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


        .heading h1 {
            font-size: 2rem;
            margin-top: 50px;
            color: lightpink;
            text-transform: uppercase;
            text-align: center;
        }

        .flex-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .btn {
            margin: 0 5px;
        }

        .price {
            position: relative;
            margin-top: 20px;
            margin-right: 10px;
            background-color: lightpink;
            color: white;
            border-radius: 50%;
            padding: 10px;
            font-weight: bold;
        }




</style>

</head>
<body>

<div class="main-container">
    <?php include 'admin_header.php'; ?>

    <section class="read-products">
        <div class="heading">
            <h1>Product Details</h1>
        </div>
        <div class="box-container">
            <?php
            $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND seller_id = ?");
            $select_product->execute([$product_id, $seller_id]);

            if ($select_product->rowCount() > 0) {
                while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <form action="" method="post" class="box">
                        <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">
                        <div class="status"
                             style="color: <?php echo ($fetch_product['product_status'] == 'active') ? 'green' : 'red'; ?>"><?= $fetch_product['product_status']; ?></div>
                        <?php if ($fetch_product['image'] != '') { ?>
                            <img src="../uploaded_img/<?= $fetch_product['image']; ?>" class="image">
                        <?php } ?>
                        <div class="price">$<?= $fetch_product['price']; ?></div>
                        <div class="title"><?= $fetch_product['name']; ?></div>
                        <div class="content"><?= $fetch_product['product_details']; ?></div>
                        <div class="flex-btn">
                            <button type="submit" style="height: 50px; margin-top: 8px" class="btn" name="delete"
                                    onclick="return confirm('Are you sure you want to delete this product?');">Delete
                            </button>
                            <a href="view_product.php?update_product_id=<?= $fetch_product['id']; ?>" class="btn">Go
                                back</a>
                        </div>
                    </form>
                    <?php
                }
            } else {
                echo '<div class="empty"> <p> No products added yet!<br> <a href="add_product.php" class= "btn" style = "margin:auto;">Add Products</a></p></div>';
            }
            ?>
        </div>
    </section>
</div>

<!-- message link -->
<?php include '../Assets/message.php'; ?>
<!-- Add your JavaScript code here -->

</body>
</html>
