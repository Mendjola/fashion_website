
<?php


// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}

// Check if user is not logged in or user_id is empty
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    // Redirect to the login page
    header('location: ../user/user_login.php');
    exit; // Stop further execution
}


// Set error reporting to display all errors
error_reporting(E_ALL); 
ini_set('display_errors', 1);


require_once "../Assets/config.php";
include "header.php";

// Initialize $seller_id variable
$seller_id = '';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Retrieve user_id from session


    try {
        // Establish a database connection
        $conn = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", $db_user_name, $db_user_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query to fetch seller_id based on user_id
        $select_seller_query = $conn->prepare("SELECT seller_id FROM seller WHERE user_id = ?");
        $select_seller_query->execute([$user_id]);

        // Check if seller_id is found
        if ($select_seller_query->rowCount() > 0) {
            $seller_id = $select_seller_query->fetch(PDO::FETCH_ASSOC)['seller_id'];
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo "<script>console.error('Connection failed: " . $e->getMessage() . "');</script>";
    }
}
    
 else {
   
        //header('location:../user/user_login.php');
        $user_id ='';
 
}


// Function to delete a product by its ID
function deleteProduct($conn, $product_id) {
    try {
        // Prepare the delete statement
        $delete_product_query = $conn->prepare("DELETE FROM products WHERE id = ?");

        // Bind the product ID to the placeholder
        $delete_product_query->bindParam(1, $product_id);

        // Execute the query
        $delete_product_query->execute();

        echo "Product with ID $product_id deleted successfully.";
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error deleting product: " . $e->getMessage();
    }
}

// Function to update a product's name, price, and stock by its ID
function updateProduct($conn, $product_id, $updated_name, $updated_price, $updated_stock) {
    try {
        // Prepare the update statement
        $update_product_query = $conn->prepare("UPDATE products SET name = ?, price = ?, stock = ? WHERE id = ?");

        // Bind parameters
        $update_product_query->bindParam(1, $updated_name);
        $update_product_query->bindParam(2, $updated_price);
        $update_product_query->bindParam(3, $updated_stock);
        $update_product_query->bindParam(4, $product_id);

        // Execute the query
        $update_product_query->execute();

        echo "Product with ID $product_id updated successfully.";
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error updating product: " . $e->getMessage();
    }
}

// Example delete product with ID 2
//deleteProduct($conn, 2);

// Example update product with ID 6
updateProduct($conn, 6, "White Shirt", 29.99, 50);


try {
    $conn = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", $db_user_name, $db_user_password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Delete existing products from the database
    $delete_products_query = "DELETE FROM products";
    $conn->exec($delete_products_query);

    // Check if products are already inserted
    $select_products = $conn->prepare("SELECT COUNT(*) as total_products FROM products");
    $select_products->execute();
    $total_products = $select_products->fetch(PDO::FETCH_ASSOC)['total_products'];

    if ($total_products == 0) {
        // Insert products into the database if no products exist
        $insert_products_query = "
            INSERT INTO products (id, seller_id, name, price, image, stock, product_details, product_status)
            VALUES
            ('1', '$seller_id', 'Gold Dress', 149.99, 'women_formal_gold_dress.jpeg', 100, 'Description of Gold Dress', 'active'),
            ('2', '$seller_id', 'Blue Wide Jeans', 34.99, 'wide_jeans_product2.jpeg', 100, 'Description of Blue Wide Jeans', 'active'),
            ('3', '$seller_id', 'Formal Green Jumpsuit', 42.99, 'women_green_jumpsuit_formal.jpeg', 100, 'Description of Formal Green Jumpsuit', 'active'),
            ('4', '$seller_id', 'Beige Hoodie', 29.99, 'Women_beige_hoodie.webp', 0, 'Description of Beige Hoodie', 'inactive'),
            ('5', '$seller_id', 'Black Formal Jumpsuit', 25.99, 'black_jumpsuit_product_3.webp', 100, 'Description of Black Formal Jumpsuit', 'active'),
            ('6', '$seller_id', 'White Shirt with buttons', 23.99, 'white_shirt_buttons.jpeg', 100, 'Description of White Shirt with buttons', 'active'),
            ('7', '$seller_id', 'White Jeans', 27.99, 'women_white_jeans.webp', 100, 'Description of White Jeans', 'active'),
            ('8', '$seller_id', 'Formal Black Dress', 149.99, 'formal_black_dress_glitter.jpeg', 100, 'Description of Formal Black Dress', 'active')
        ";

        // Execute the insert query
        $conn->exec($insert_products_query);
        echo "<script>console.log('Products inserted successfully into the database.');</script>";
    } else {
        echo "<script>console.log('Products already exist in the database.');</script>";
    }
} catch (PDOException $e) {
    // Handle database connection errors 
    echo "<script>console.error('Connection failed: " . $e->getMessage() . "');</script>";
}

// Include messages.php to display messages
include_once "../Assets/message.php";







//ob_end_flush();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Women Section</title>
    
    <link rel="stylesheet" href="../css/user_style.css" type="text/css">
    <link rel="stylesheet" href="../css/footer.css" type="text/css">

    <!--FONT FILES LINK-->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <style>


       body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #F2E7D9; 
            color: #333;
        }


        .womens-section-heading {

            text-align: center;
            font-size: 36px;
            font-weight: bold;
            color: #fff;
            background: linear-gradient(to right, #F2E7D9, #e1c5c0 60%); 
            padding: 20px;
            margin: 100px auto 0; /* top, right, bottom, left */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); 
            text-transform: uppercase;
            font-family: 'Arial', sans-serif;
            letter-spacing: 2px; 
        }


        

       .women_products .product_container .product .content h3 {
              font-size: 12px;
           
              margin-bottom: 15px;
              background: black; 
              color: white; 
              padding: 10px 12px; 
              border-radius: 0 0 20px 20px; 
           
         }


        .women_products {
            padding-top: 30px;
            margin-top: 40px;
            margin-bottom: 50px;
        }

        .women_products .product_container {
            display: grid;
            grid-template-columns: repeat(4, 250px); 
            gap: 20px;
            justify-content: center;
            grid-row-gap: 20px;
         
        }

        .women_products .product_container .product {
            background: white;
            border-radius: 10px; 
            height: 100%;
            width: auto;
            position: relative;
            overflow: hidden;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); 
            transition: transform 0.3s ease-out;
            border: 3px solid white;
        }

        .women_products .product_container .product:hover {
             transform: translateY(-5px); 
         }


        .women_products .product_container .product .image {

            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 350px; 
            overflow: hidden;
            border-radius: 10px 10px 0 0; 
        }

        .women_products .product_container .product .image img {
           
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease-out;
            border-radius: 10px 10px 0 0;

        }

        .women_products .product_container .product .content {

            padding-top: 0;
            padding: 10px;
        }

        .women_products .product_container .product .content h3 {
            font-size: 12px;
            margin-bottom: 5px; 

        }

        .women_products .product_container .product .content .price {
            display: inline-block;
            color: #e1c5c0;
            font-size: 13px;
        }

        .women_products .product_container .product .content .price del {
            text-decoration: line-through;
            color: #aaa;
        }

        .women_products .product_container .product .content .rating {
            padding: 10px 0;
            font-size: 10px;
            color: #e1c5c0;
        }

        .women_products .product_container .product .content .availability {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .women_products .product_container .product .content button[type="submit"] {
            border: none; 
            background: none; 
            cursor: pointer;
            font-size: 12px;
            color: #e1c5c0;
            margin: 0;
            padding: 0;
          
        }


        .women_products .product_container .product .content .fa-shopping-basket,
        .women_products .product_container .product .content .fa-heart,
        .women_products .product_container .product .content .fa-eye {
            text-align: center;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 10px;
            cursor: pointer;
            background: none;
            font-size: 12px;
            color: #e1c5c0;
            border: 2px solid #e8ded1;
            margin: 0;
            
        }

        .women_products .product_container .product .content .fa-shopping-basket:hover,
        .women_products .product_container .product .content .fa-heart:hover,
        .women_products .product_container .product .content .fa-eye:hover {
          
            color: white;
            background: #e8ded1;
            transition: 0.3s ease-in-out;
        }


        .flex-btn {

            display: flex; 
            align-items: center;
        }

        .qty {
            width: 30px; 
            height: 30px;
            padding: 0; 
            margin-right: 5px; 
            font-size: 14px; 
          }

        .btn {
            margin-right: 10px; 
        }

       
        </style>


<?php include "../Assets/add_to_cart.php"; ?>


    
</head>

<body style="overflow-y: auto;">


    <h1 class="womens-section-heading">Women's Clodhes</h1>

  <!-- Women's Section -->
    <section class="women_products" id="product">


        <div class="product_container">

                <?php 
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id = ?"); // Retrieve all products for the current seller
                $select_products->execute([$seller_id]);

                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                    
                ?>

                <form action="" method="post" class="box" <?php if($fetch_products['stock'] ==0) {echo 'disabled'; } ?>>

                    <div class="product">
                        <div class="image">
                            <img src="Images/women/<?= $fetch_products['image']; ?>" alt="">
                        </div>
                        <div class="content">
                            <h3><?= $fetch_products['name']; ?></h3>
                            <div class="price">
                    
                            $<?= $fetch_products['price']; ?>

                            </div>
                            <div class="rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            
                    <?php if($fetch_products['stock'] > 9) { ?>
                    <span class ="stock" style="color: green;">In Stock</span>
                    <?php } else if($fetch_products['stock'] ==0) { ?>
                    <span class ="stock" style="color: red;">Out of Stock</span>
                    <?php } else { ?>
                    <span class ="stock" style="color: orange;">Only <?= $fetch_products['stock']; ?> left in stock</span>

                    <?php } ?>

                            <button type="submit" name="add_to_cart"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button>
                      
                            <button type="button" name="add_to_favorites" class="add-to-favorites" style="border: none; background: none;">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </button>


                            <a href="product_information.php?pid=<?= $fetch_products['id']; ?>" class="fa fa-eye" aria-hidden="true"></a>
                    
                            <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                            <div class="flex-btn">

                                <a href="../user/checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">Buy Now</a>
                                <input type="number" required min="1" max="10" maxlength="2" name="qty" value="1" class="qty">
                            </div>

                        </div>
                    </div>


                    </form>

                    <?php 

                    }

                } else {

                    echo '<p class="empty">No products added yet!</p>';
                }

                ?>
        
        </div>

  </section>

<!-- message link -->
<?php include '../Assets/message.php'; ?>




<?php 

// Initialize empty arrays for messages
$errors = [];
$success = [];


// Check if user is logged in
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    echo json_encode(array('status' => 'error', 'message' => 'User is not logged in.'));
    exit;
}

// Retrieve user_id from session
$user_id = $_SESSION['user_id'];

// Retrieve product_id, price, and image from POST data
if (isset($_POST['product_id']) && isset($_POST['price']) && isset($_POST['image'])) {
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    require_once "../Assets/config.php"; 

    try {
        $conn = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", $db_user_name, $db_user_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the product is already in the favorites list
        $check_favorite_query = $conn->prepare("SELECT * FROM favorites WHERE user_id = ? AND product_id = ?");
        $check_favorite_query->execute([$user_id, $product_id]);

        if ($check_favorite_query->rowCount() > 0) {
            //echo "Product is already in the favorites list.";
            $error[] = "Product is already in the favorites list.";
        } else {
            // Generate a unique ID for the favorite
            $favorite_id = uniqid();

            // Insert the favorite product into the favorites table
            $insert_favorite_query = $conn->prepare("INSERT INTO favorites (id, user_id, product_id, price, image) VALUES (?, ?, ?, ?, ?)");
            $insert_favorite_query->execute([$favorite_id, $user_id, $product_id, $price, $image]);
        
            echo json_encode(array('status' => 'success', 'message' => 'Product added to favorites.'));
            $success[] = "Product added to favorites.";
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo json_encode(array('status' => 'error', 'message' => 'Failed to add product to favorites: ' . $e->getMessage()));
    }
} 

?>





<!-- Add to favorites script -->

<script>

$(document).ready(function() {
    // Add event listener for clicking the favorite button
    $('.add-to-favorites').click(function() {
        // Get product details from the clicked element or other relevant source
        var productId = $(this).siblings('input[name="product_id"]').val();
        var productPrice = $(this).siblings('.price').text().trim().replace('$', ''); 
        var productImage = $(this).closest('.product').find('.image img').attr('src');

        // Log product details to the console for debugging
        console.log("Product ID: " + productId);
        console.log("Price: " + productPrice);
        console.log("Image URL: " + productImage);

        // Send AJAX request to add the product to favorites
        $.ajax({
            url: 'women.php', 
            type: 'POST',
            data: {
                product_id: productId,
                price: productPrice,
                image: productImage
            },
            success: function(response) {
                
                // Check if the response is HTML (error message)
                if (response.startsWith('<')) {

                    // Handle HTML response (product is already in favorites)
                    alert(response);

                } else {

                    // Handles JSON response
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.status === 'success') {
                        alert(jsonResponse.message);
                    } else {
                        alert(jsonResponse.message);
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while adding to favorites: ' + error);
            }
        });
    });
});


</script>


</body>


<!--Javascript Section for the footer-->

<script>

// Function to subscribe 
function subscribe() {
    var emailInput = document.getElementById("email");
    var email = emailInput.value.trim();
    var termsCheckbox = document.getElementById("termsCheckbox");

    // Regular expression for a basic email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email === "") {
        alert("Email is mandatory.");
    } else if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
    } else if (!termsCheckbox.checked) {
        alert("Please check the checkbox to continue with the subscription.");
    } else {

        // Log the email to the console
        console.log("Subscribed successfully! Email: " + email);

        
    }

    window.location.href = "subscription.html";

}


// Function to toggle the active class and show/hide dropdown content

function toggleDropdown(dropdownId) {
    var dropdown = document.getElementById(dropdownId + 'Dropdown');

    // Toggle active class for the specific dropdown
    dropdown.classList.toggle('active');

    // Toggle dropdown content based on the active class
    if (dropdown.classList.contains('active')) {
        dropdown.style.display = 'block';
    } else {
        dropdown.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Get all dropdown buttons
    var dropdownButtons = document.querySelectorAll('.dropdown-btn');

    // Add click event listener to each dropdown button
    dropdownButtons.forEach(function (dropdownButton) {
        dropdownButton.addEventListener('click', function () {
            // Toggle active class for the clicked dropdown button
            this.classList.toggle('active');

            // Hide/show dropdown content based on the active class
            var dropdownContent = this.nextElementSibling;
            if (this.classList.contains('active')) {
                dropdownContent.style.display = 'block';
            } else {
                dropdownContent.style.display = 'none';
            }

            // Close other dropdowns when a dropdown is clicked
            closeOtherDropdowns(this);
        });
    });

    // Function to close other dropdowns except the clicked one
    function closeOtherDropdowns(clickedDropdown) {
        dropdownButtons.forEach(function (dropdownButton) {
            if (dropdownButton !== clickedDropdown) {
                dropdownButton.classList.remove('active');
                dropdownButton.nextElementSibling.style.display = 'none';
            }
        });
    }


// Function to scroll to specific section (smooth scroll)
function scrollToSection(sectionId) {
    var section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: "smooth" });
    }
}

});



</script>


<!--Footer HTML Section-->
<footer id="contact">

    <div class="subscribe-section">
        <h2>Newsletter</h2>
        <form id="subscriptionForm"> 
          <!--  <label for="email">Email:</label> -->
            <input type="email" id="email" name="email" placeholder="type email here..." required>
            <button type="button" onclick="subscribe()">Subscribe</button>
            <br>
            <input type="checkbox" id="termsCheckbox" required>
            <label for="termsCheckbox">I agree with the terms and conditions</label>
            <br>
            
        </form>
    </div>

    <div class="social-media-section">
        <p>Do you want to get informed first about new products or offers?</p>
        <p>Follow us on our social media accounts!</p>
        <div class="social-icons">
            <a href="#" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="#" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
            <a href="#" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
        </div>
    </div>

    <div class="dropdown-buttons">
        <button id="contactDropdownBtn" class="dropdown-btn" onclick="toggleDropdown('contactDropdown')">Contact Us</button>
        <div class="dropdown-content" id="contactDropdown">
            <p class="phone"><i class="fa fa-phone" aria-hidden="true"></i> Phone: +2410-555343</p>
            <p class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> Location: 123 Main Street, New York</p>
            <p class="email"><i class="fa fa-envelope" aria-hidden="true"></i> Email: info@MKfashion.com</p>
            <p class="time"><i class="fa fa-clock-o" aria-hidden="true"></i> Monday-Friday: 9:00-21:00 <br>Saturday:9:00-20:00 <br>Sunday:Closed</p>
        </div>

        <button id="customerServiceDropdownBtn" class="dropdown-btn" onclick="toggleDropdown('customerServiceDropdown')">Customer Service</button>
        <div class="dropdown-content" id="customerServiceDropdown">
            <a href="shipping_info.php" target="_blank">Payment and Shipping Methods</a>
            <a href="product_return.php" target="_blank">Product Return Policy</a>
            <a href="terms_conditions.php" target="_blank">Terms and Conditions</a>
        </div>
       
        <button id="aboutUsDropdownBtn"  class="dropdown-btn" onclick="toggleDropdown('aboutUsDropdown')">About Us</button>
        <div class="dropdown-content" id="aboutUsDropdown">
            <a href="store_information.php" target="_blank">Who We Are</a>
            <a href="contact.php" target="_blank">Contact</a>
            <a href="questions.php" target="_blank">FAQs</a>
   
        </div>

        <button id="sellerDropdownBtn"  class="dropdown-btn" onclick="toggleDropdown('sellerDropdown')">Sellers</button>
        
        <div class="dropdown-content" id="aboutUsDropdown">
            <a href="../admin/register.php" target="_blank">New Seller</a>
            <a href="../admin/admin_login.php" target="_blank">Seller Login</a>
            <a href="../admin/dashboard.php" target="_blank">Dashboard</a>

        </div>
        
    </div>

    <img src="images/MK.png" alt="" id="logo_img">

    <p class="copyright-text">The content of this site is copyright-protected ©  and is the property of MK Store.</p>



</footer>


<script>

    

     // Add event listener for scrolling to specific sections
     $('#homeLink').on('click', function() {
        scrollToTop();
    });


    $('#newsletterLink').on('click', function() {
      
        // If it's the "newsletter" link, display a message
        alert('Subscribe to our newsletter below!');

    });


</html>

