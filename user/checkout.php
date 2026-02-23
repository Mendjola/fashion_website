<?php
   

    session_start(); 

    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];

        error_reporting(error_reporting() & ~E_DEPRECATED);
        include "header.php";
        require_once "../Assets/config.php";
        

    } else {
        $user_id = '';
        header('location:user_login.php');
    }

    // Error handling for database connection
    if ($conn) {
        // Connection successful
    } else {
        // Connection failed
        $errorInfo = $conn->errorInfo();
        die("Connection failed: " . $errorInfo[2]);
    }

if (isset($_POST['place_order'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $address = $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['country'] .', '. $_POST['pin'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);

    $address_type = $_POST['address_type'];
    $address_type = filter_var($address_type, FILTER_SANITIZE_STRING);

    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);

    if (isset($_GET['get_id'])){
        $get_id = $_GET['get_id'];
        $get_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $get_product->execute([$get_id]);

        if ($get_product->rowCount() > 0){
            while ($fetch_product = $get_product->fetch(PDO::FETCH_ASSOC)){
                $seller_id = $fetch_product['seller_id'];
                $insert_order = $conn->prepare("INSERT INTO orders (id, seller_id, user_id, name, number, email, address, address_type, payment_method, product_id, price, qty, order_status, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_order->execute([uniqid(), $seller_id, $user_id, $name, $number, $email, $address, $address_type, $method, $fetch_product['id'], $fetch_product['price'], 1, 'pending', 'pending']);

            }
            header('location:orders.php');
        } else {
            $warning = 'Something went wrong';
        }
    } else {
        $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $verify_cart->execute([$user_id]);

        if ($verify_cart->rowCount() > 0){
            while ($fetch_cart = $verify_cart->fetch(PDO::FETCH_ASSOC)){
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                $select_products->execute([$fetch_cart['product_id']]);
                $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);

                // Check if $fetch_products is not null
                if ($fetch_products) {
                    $seller_id = $fetch_products['seller_id'];
                    $insert_order = $conn->prepare("INSERT INTO orders (id, seller_id, user_id, name, number, email, address, address_type, payment_method, product_id, price, qty, order_status, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $insert_order->execute([uniqid(), $seller_id, $user_id, $name, $number, $email, $address, $address_type, $method, $fetch_products['id'], $fetch_products['price'], 1, 'pending', 'pending']);
                }
            }
            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart->execute([$user_id]);
            header('location:orders.php');
        }
    }
} else {
    $warning = 'Something went wrong';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Checkout Page</title>
    <link rel="stylesheet" href="../css/user_style.css" type="text/css">
    <link rel="stylesheet" href="../css/footer.css" type="text/css">

    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    

    <link rel="stylesheet" href="../web_components/font-awesome-4.7.0/css/font-awesome.min.css">


    <style>

       .form-checkout {

            width: 60%;
            margin: 80px  auto;
            padding: 30px;
            border-radius: 25px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .form-checkout:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }


        .form-checkout .input-fields p {
            margin-bottom: 5px; 
            font-weight: bold;
            color: #555;
            font-size: 14px;
            width: auto;
            float: left; 
            clear: both;
        }

        h3{
            text-align:left;
            padding: 25px;
        }

        .input-fields {
            margin-bottom: 20px;
        }

        .input-fields p {
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .input-fields input[type="text"],
        .input-fields input[type="number"],
        .input-fields input[type="email"],
        .input-fields select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
            font-size: 14px;
            box-sizing: border-box;
        }

        .input-fields input[type="text"]:focus,
        .input-fields input[type="number"]:focus,
        .input-fields input[type="email"]:focus,
        .input-fields select:focus {
            border-color: #ff80bf;
            outline: none;
        }

        .input-fields p span {
            color: red;
            font-size: 12px; 
            margin-left: 4px; 
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        button[type="submit"]:hover {
            background-color: lightpink;
        }

        .summary {
            border-top: 2px solid #ccc;
            padding-top: 20px;
            padding-bottom: 20px;
        }

       
        .summary .flex .info .image {
            width: 100px;
            height: auto;
       
            
        }
        .summary .flex .info .name {
            font-size: 18px;
            margin-bottom: 5px;

        }

        .summary .flex .info .price {
            font-size: 16px;
            color: #888;
           
            
        }

        .grand-total {
          margin-top: 20px;
         

         }

        .grand-total span,
        .grand-total p {
            display: inline-block; 
            vertical-align: middle; 
        }
        
        h2 {
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
        
        }

        .bi {
            font-size: 1.2rem; 
            vertical-align: middle; 
            margin-right: 5px; 
            position: relative;
            top:-4px;
        }

        h2:hover{
            color: lightpink; 
            cursor: pointer; 
            transform: scale(1.05); 
            transition: color 0.3s, transform 0.3s;


        }

        .summary .flex .info {
            background-color: #f9f9f9;
            border-radius: 10px;
            margin-top: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;

            display: flex;
            flex-direction: column; 
            align-items: center; 
                    
        }

        .summary .flex .info:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }



        
    </style>
    
</head>
<body style="overflow-y: auto;">



<div class="form-checkout">



        <h2><i class="bi bi-cart-check-fill"></i>Checkout Summary</h2>

  

    <div class="row">
        <form action="" method="post" class="register">
            <input type="hidden" name="product_id" value= "<?=$get_id; ?>">
            <h3><i class="bi bi-person-lines-fill"></i>Your Details</h3>
            <div class="flex">

                 <div class="box">

                    <div class="input-fields">

                       <p>Name<span>*</span></p>
                       <input type="text" name="name" placeholder="Enter your name" maxlength="50" required class="input">

                    </div>

                    <div class="input-fields">

                        <p>Phone number<span>*</span></p>
                        <input type="number" name="number" placeholder="Enter your phone number" maxlength="10" required class="input">

                    </div>


                    <div class="input-fields">

                        <p>Email<span>*</span></p>
                        <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="input">

                     </div>

                     <div class="input-fields">

                            <p>Payment method<span>*</span></p>
                            <select name="method" class="input">
                                <option value="cash on delivery">Cash on delivery</option>
                                <option value="credit or debit card">Credit or debit card</option>
                                <option value="paypal">Paypal</option>
                            </select>    
                            

                    </div>



                    <div class="input-fields">

                            <p>Address type<span>*</span></p>
                            <select name="address_type" class="input">
                                <option value="home">Home</option>
                                <option value="office">Office</option>
                            </select>    

                    </div>
             

                     <div class="input-fields">

                        <p>Street Name<span>*</span></p>
                        <input type="text" name="flat" placeholder="Enter your street" maxlength="50" required class="input">

                     </div>


                     <div class="input-fields">

                        <p>Street number<span>*</span></p>
                        <input type="text" name="street" placeholder="Enter your street number" maxlength="50" required class="input">

                    </div>


                    <div class="input-fields">

                        <p>City name<span>*</span></p>
                        <input type="text" name="city" placeholder="Enter your city" maxlength="50" required class="input">

                    </div>


                    <div class="input-fields">

                        <p>Country name <span>*</span></p>
                        <input type="text" name="country" placeholder="Enter your country" maxlength="50" required class="input">

                    </div>


                    <div class="input-fields">

                        <p>Pin code<span>*</span></p>
                        <input type="number" name="pin" placeholder="e.g. 11111" maxlength="6" min="0" required class="input">

                    </div>

               
                    </div>
            </div>
            
            <button type="submit" name="place_order" value="btn">Place Order</button>

        </form>

    </div>

        <div class="summary">

            <h2><i class="bi bi-bag-fill"></i>Order Summary</h2>
            
            <?php 
                $total= 0;
                if (isset($_GET['id'])){

                    $select_get =$conn ->prepare("SELECT * FROM `products` WHERE id = ?");
                    $select_get->execute([$_GET[$get_id]]);

                    while ($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)) {
                        $sub_total += $fetch_get['price'];
                        $total = $sub_total;

            ?>

            <div class="flex">

                <img src="../web_components/Images/women/<?= $fetch_get['image']; ?>" class="image">
                <div>

                    <h3 class="name"><?= $fetch_get['name']; ?></h3>
                    <p class="price"><?= $fetch_get['price']; ?></p>

                </div>

            </div>


                <?php

                    }

                } else{

                    $select_cart =$conn ->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $select_cart->execute([$user_id]);

                    if ($select_cart->rowCount() > 0) {
                        
                        while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                            $select_products->execute([$fetch_cart['product_id']]);
                            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
                            $sub_total = $fetch_products['price'] * $fetch_cart['qty'];
                            $total += $sub_total;
                          

                ?>

                <div class="flex">

                <div class="info">
                <img src="../web_components/Images/women/<?= $fetch_products['image']; ?>" class="image">
             

                    <h3 class="name"><?= $fetch_products['name']; ?></h3>
                    <p class="price">$<?= $fetch_products['price']; ?> x <?= $fetch_cart['qty']; ?></p>

                </div>

                </div>

                <?php
                    
                        }

                    } else {
                        
                        echo '<p class="empty">Your cart is empty!</p>';
                    }

                }

                   

                ?>
        </div>

        <div class="grand-total" style ="text-align: center; margin-top: 10px;">

             <span style="font-weight: bold;">Total Amount:</span>
             <p>$<?= $total; ?></p>

        </div>


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

