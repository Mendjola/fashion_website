<?php
    session_start(); // Ensure session is initialized

    // Check if user is logged in
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    } else {
        $user_id = '';
    }

    // Include necessary files
    include "header.php";
    require_once "../Assets/config.php";

    // Error handling for database connection
    if ($conn) {
        // Connection successful
    } else {
        // Connection failed
        $errorInfo = $conn->errorInfo();
        die("Connection failed: " . $errorInfo[2]);
    }

    // Initialize product ID variable
    $pid = '';

    // Check if the 'pid' parameter is set in the URL
    if (isset($_GET['pid'])) {
        $pid = $_GET['pid'];
    } 

    // Include file for adding to cart
    include "../Assets/add_to_cart.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Product Information</title>
    <link rel="stylesheet" href="../css/user_style.css" type="text/css">
    <link rel="stylesheet" href="../css/footer.css" type="text/css">


    <style>

        .box {
            display: flex;
            align-items: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px; 
            background-color: #f9f9f9; 
            transition: transform 0.3s ease; 
            margin: 100px;
        }

        .product_info {
            padding: 20px;

            border-radius: 10px; 
            background-color: #f9f9f9; 
        }
        
        .product_info h1 {
            font-size: 32px;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(255, 0, 128, 0.5); 
            background: linear-gradient(45deg, #FFB6C1, lightpink); 
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: slide-in 0.5s ease-out forwards, pulse 2s ease infinite;
            transition: text-shadow 0.3s ease;
            margin-top: 100px;
        }

        @keyframes slide-in {
            0% {
                transform: translateY(-100%);
            }
            100% {
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                text-shadow: 2px 2px 4px rgba(255, 0, 128, 0.5);
            }
            50% {
                text-shadow: 4px 4px 8px rgba(255, 0, 128, 0.7);
            }
            100% {
                text-shadow: 2px 2px 4px rgba(255, 0, 128, 0.5);
            }
        }

       
        .img-box {
            flex: 1;
            margin-right: 20px;
        }

        .img-box img {
            max-width: 400px; 
            width: 100%;
            height: 500px;
            border-radius: 5px;
            
        }

        .info {
            flex: 2;
        }

        .name {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .stock {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .price {
            font-size: 18px;
            margin-bottom: 10px;
            color: lightpink;
        }

        .name {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .product_info {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .button {
            display: flex;
            align-items: center;
        }



        .box:hover {
            transform: translateY(-5px); /* Move the container slightly upwards */
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1); 
        }

        .btn:first-child {
            margin-right: 10px;
        }




    </style>



</head>

<body style="overflow-y: auto;">


<section class="product_info">

     <h1>Product Information</h1>

     <?php 

        
        if (isset ($_GET['pid'])) {
            $pid = $_GET['pid'];

            $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_product->execute([$pid]);
            

        if ($select_product->rowCount() > 0) {
            while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {

    ?>

    <form action="" method="post" class ="box">

      <div class="img-box">

        <img src="Images/women/<?= $fetch_product['image']; ?>" >

      </div>

      

      <div class="info">

        <?php if ($fetch_product['stock'] > 9) { ?>
            
            <span class="stock" style ="color: green;">In Stock</span>

        <?php } elseif ($fetch_product['stock'] == 0) { ?>

            <span class="stock" style ="color: red;">Out of Stock</span>

            
        <?php } else { ?>

            <span class="stock" style ="color: orange;"> Only <?= $fetch_product['stock']; ?> left in stock!</span>
            
        <?php } ?>

        <P class="price">$<?= $fetch_product['price']; ?></P>

        <div class="name"><?= $fetch_product['name']; ?></div>

        <p class="product_info"><?= $fetch_product['product_details']; ?></p>

        
        <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">

        <div class="button">

        
            <button type="submit" class="btn" name="add_to_cart">Add to cart <i class="fa fa-shopping-cart"></i></button>
            <input type= "hidden" name ="qty" value="1" min = "0" class ="quantity">

            <button type="submit" class="btn" name="add_to_favorites">Add to wishlist<i class="fa fa-heart"></i></button>

            

        </div>

    
      </div>

    </form>

    <?php 

            }

        }

    }


    ?>

   

 </section>

 <div class="products">

    <div class="heading">

        <h2>Similar Products</h2>

    </div>

     <?php include "similar_products.php"; ?>

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
            <a href="store_information.php" target="_blank">Who We Are</a>
            <a href="contact.php" target="_blank">Contact</a>
            <a href="questions.php" target="_blank">FAQs</a>
   
        </div>

        <button id="customerServiceDropdownBtn" class="dropdown-btn" onclick="toggleDropdown('customerServiceDropdown')">Customer Service</button>
        <div class="dropdown-content" id="customerServiceDropdown">
            <a href="shipping_info.php" target="_blank">Payment and Shipping Methods</a>
            <a href="product_return.php" target="_blank">Product Return Policy</a>
            <a href="terms_conditions.php" target="_blank">Terms and Conditions</a>
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



