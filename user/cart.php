

<?php 

session_start();
    include "header.php";
    require_once "../Assets/config.php";

     // Redirect if user is not logged in
     if (!isset($_SESSION['user_id'])) {
        header('Location: user_login.php');
        exit(); // Stop further execution
    }

    $user_id = $_SESSION['user_id'];

    // Fetch user's name based on ID
    $stmt = $conn->prepare("SELECT user_name FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_name = $user['user_name'];
    
    
    // Error handling for database connection
    if (!$conn) {

        $errorInfo = $conn->errorInfo();
        die("Connection failed: " . $errorInfo[2]);
    }


    
     /* Update the quantity in cart */
    if (isset($_POST['update_cart'])) {
        $cart_id = $_POST['cart_id'];
        $qty = $_POST['qty'];

        $update_qty = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id = ?");
        $update_qty->execute([$qty, $cart_id]);

        $success[] = 'Cart quantity updated!';
    }

    /* Remove item from cart */
    if (isset($_POST['delete_cart_item'])) {
        
        $cart_id = $_POST['cart_id'];

        $remove_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
        if ($remove_cart_item->execute([$cart_id])) {
            $success[] = 'Cart item deleted!';
        } else {
            $warning[] = 'Failed to delete cart item';
        }
    }

    /* Empty cart */
    if (isset($_POST['empty_cart'])) {
        $empty_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        if ($empty_cart->execute([$user_id])) {
            $success[] = 'Cart emptied!';
        } else {
            $warning[] = 'Failed to empty cart';
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - User Cart Page</title>
    <link rel="stylesheet" href="../css/user_style.css" type="text/css">
    <link rel="stylesheet" href="../css/footer.css" type="text/css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="../web_components/font-awesome-4.7.0/css/font-awesome.min.css">

    <style>

        body {
            color: black;
            font-family: Arial, sans-serif;
            
        }

        .container {
            text-align: center;
            margin-top: 20px;
        }


        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
   
        }

        .box {
            width: 300px;
            height: 500px;
            background-color: white;
            border-radius: 10px;
            margin: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
      
            
        }

        .box img {
            width: 100%;
            height: 200px;
            object-fit: contain; 
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            
        }

        .content {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            margin-top: 25px;
        }

        .content h3 {
            color: black;
            margin-bottom: 25px;
        }

        .flex-btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .price {
            color: black;
            margin-right: 10px;
        }

        .sub-total {
            color: black;
        }


        .box {
          position: relative;
      
        }

        .stock {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }


        .cart-total {
            position: relative;
            bottom: 0;
            left: 0;
            text-align: center;
            padding: 15px 0; 
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column; 
            align-items: center; 
            width: 1200px;
       
        }

        .cart-total p {
            margin-top: 10px; 
            font-size: 18px; 
            font-weight: bold; 
         }

        .cart-total .button {

            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            margin-bottom: 25px;
        
        }

        .button button,
        .button a.btn {
            height: 40px;
            font-size: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            width: 150px;/
        }



        h1{

            color: #336699; 
            font-size: 24px; 
            text-align: center; 
            border: 1px solid #f5c6cb; 
            border-radius: 5px; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
            color: black;
            padding: 10px
          
        }
       


    </style>
    
</head>
<body style="overflow-y: auto;">


<h1 style="display: block;  margin: 100px auto 0 auto;">Welcome, <?php echo $user_name ?>! Your Shopping Cart</h1>


<div class="products" style="background-color: #f9f9f9;">

     <div class="box-container">

        <?php 


          $total = 0;
          $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
          $select_cart -> execute([$user_id]);


          if ($select_cart->rowCount() > 0) {

            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {


                $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                $select_products->execute([$fetch_cart['product_id']]);


                if ($select_products->rowCount() > 0) {
                    $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);


          ?>

        <form action="" method="post" class="box" <?php if ($fetch_products['stock'] == 0) { echo 'disabled'; } ?>>
            <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
            <img src="../web_components/Images/women/<?= $fetch_products['image']; ?>" alt="">
            <?php if ($fetch_products['stock'] > 9) { ?>
                <span class="stock" style="color: green;">In Stock</span>
            <?php } elseif ($fetch_products['stock'] == 0) { ?>
                <span class="stock" style="color: red;">Out of Stock</span>
            <?php } else { ?>
                <span class="stock" style="color: orange;">Only <?= $fetch_products['stock']; ?> Left</span>
            <?php } ?>

            <div class="content">

                <h3><?= $fetch_products['name']; ?></h3>

                <div class="flex-btn">
                    <p class="price">Price: $<?= $fetch_products['price']; ?></p>
                    <input type="number" name="qty" required min="1" max="10" maxlength="2" class="qty" value="<?= $fetch_cart['qty']; ?>">
                    <button type="submit" name="update_cart"><i class="bi bi-pencil-square"></i></button>
                </div>

                <div class="flex-btn">
                    <p class="sub-total">Total: <span>$<?= $sub_total = ($fetch_products['price'] * $fetch_cart['qty']); ?></span></p>
                    <button type="submit" name="delete_cart_item" class="btn" onclick="return confirm('Are you sure you want to delete from cart?');" style="margin-left: 10px;">Delete<i class="bi bi-trash-fill" style="margin-left: 4px;"></i></button>
                </div>
            </div>
        </form>


         <?php
              
               $total += $sub_total; 

                } else{

                    echo '<p class="empty">No products were found in cart</p>';
                }

            } 

        } else{

            echo '<p class="empty">No products added yet!</p>';
        }

        ?>
       


     </div>


       <?php if($total !=0) { ?>
       <div class="cart-total">
          <p>Total Amount: <span>$<?= $total; ?></span></p>
          
            <div class="button">
            
               <form action ="" method ="post">

                    <button type ="submit" name ="empty_cart" class="btn" onclick ="return confirm('Are you sure you want to delete all from cart?');">Delete All</button>

                </form>

                <a href="checkout.php" class="btn">Checkout</a>
          
            </div>
       </div>
       <?php } ?>

</div>





<!-- message link -->
<?php include '../Assets/message.php'; ?>


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

        <button id="aboutUsDropdownBtn"  class="dropdown-btn" onclick="toggleDropdown('aboutUsDropdown')">About Us</button>
        <div class="dropdown-content" id="aboutUsDropdown">
           <a href="../web_components/store_information.php" target="_blank">Who We Are</a>
            <a href="../web_components/contact.php" target="_blank">Contact</a>
            <a href="../web_components/questions.php" target="_blank">FAQs</a>
   
        </div>

        <button id="customerServiceDropdownBtn" class="dropdown-btn" onclick="toggleDropdown('customerServiceDropdown')">Customer Service</button>
        <div class="dropdown-content" id="customerServiceDropdown">
            <a href="../web_components/shipping_info.php" target="_blank">Payment and Shipping Methods</a>
            <a href="../web_components/product_return.php" target="_blank">Product Return Policy</a>
            <a href="../web_components/terms_conditions.php" target="_blank">Terms and Conditions</a>
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


    <div id="scrollToTop" onclick="scrollToTop()">
        <i class="fa fa-arrow-up" aria-hidden="true"></i>
    </div>


</footer>


<script>

    
    // Function to scroll to top when arrow in footer is clicked
    function scrollToTop() {
        $('html, body').animate({scrollTop : 0},800);
    }

     // Add event listener for scrolling to specific sections
     $('#homeLink').on('click', function() {
        scrollToTop();
    });


    $('#newsletterLink').on('click', function() {
      
        // If it's the "newsletter" link, display a message
        alert('Subscribe to our newsletter below!');

    });


</script>



</html>

