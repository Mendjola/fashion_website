<?php 
       include "header.php";
       require_once "../Assets/config.php";
    

        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
        } else {
            $user_id = '';
        }

        // Error handling for database connection
        if ($conn) {
            // Connection successful
        } else {
            // Connection failed
            $errorInfo = $conn->errorInfo();
            die("Connection failed: " . $errorInfo[2]);
        }


        if (isset($_GET['get_id'])){
            $get_id = $_GET['get_id'];
        } else{

            $get_id = '';
            header('location:orders.php');
        }

        if (isset($_POST['cancel'])){

            $update_order = $conn->prepare("UPDATE `orders` SET product_status = ? WHERE id = ?");
            $update_order->execute(['canceled', $get_id]);

            header('location:orders.php');


        }

         
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Order Details Page</title>
    <link rel="stylesheet" href="css/user_style.css" type="text/css">
    <link rel="stylesheet" href="css/footer.css" type="text/css">

    <link rel="stylesheet" href="../web_components/font-awesome-4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    

    <style>

       body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
           
        }
        

        .content-wrapper {

            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            margin-top:100px;
            margin-bottom: 100px;
        }


        .order-detail {

            width: 100%; 
            max-width: 800px; 
            background-color: #f3f3f3; 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 

        }

        .order-detail:hover {
            transform: translateY(-5px); /* Lifts the container slightly on hover */
            transition: transform 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); 
        }

        .box {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .col {
            flex: 1;
            min-width: 200px;
        }

        .heading {
            text-align: center;
            margin-bottom: 20px; 
            font-size: 16px;
        }


        .image-container {
            width: 200px;
            height: auto;
            border: 2px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
        }
        .image-container img {
            width: 100%;
            height: auto;
            display: block;
        }


        .billing-details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }

        .billing-details .title {
            font-size: 19px;
            font-weight: bold;
            color: #444;
            margin-bottom: 10px;
        }

        .billing-details p {
            margin-top: 5px;
            font-size: 16px;
            color: #333;
        }

        .billing-details .user i {
            margin-right: 5px;
        }

        .billing-container {
            display: flex;
            flex-direction: column;
            
        }

        .billing-container p {
            margin-bottom: 8px;
        }

        .btn {
            margin-top: 10px;
        }


        .product-information .image-container {
            margin-bottom: 40px;
        }

        .product-information p {
            margin-top: 10px; 
            margin-bottom: 10px; 
            margin-left: 5px;
            color: black;
        }


        .product-information .date,
        .product-information .time,
        .product-information .price,
        .product-information .total {
            font-size: 16px;
           
        }

        .product-information .date i, 
        .product-information .time i,
        .product-information .price i,
        .product-information .name i {
    
           color: lightpink;
           margin-right: 5px;
        }




        .product-information .date i:hover, 
        .product-information .time i:hover,
        .product-information .price i:hover,
        .product-information .name i:hover {
    
            cursor: pointer;
            transform: scale(1.1);
        }


        .total-container {

            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 10px;
            margin-top: 10px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            
        }


    </style>
    
</head>
<body style="overflow-y: auto;">


<div class="content-wrapper">
<div class="order-detail">

   <div class="heading">

       <h1>Order Information</h1>

   </div>


   <div class="box-container">

    <?php

        $total = 0;

        $select_order = $conn->prepare("SELECT * FROM `orders` WHERE id = ? LIMIT 1");
        $select_order->execute([$get_id]);

        if ($select_order->rowCount() > 0) {
            
            while ($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)) {

                $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
                $select_products->execute([$fetch_order['product_id']]);

                if ($select_products->rowCount() > 0) {

                    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {

                        $sub_total = $fetch_order['price'] * $fetch_order['qty'];
                        $total += $sub_total;

    ?>

    <div class="box">

            <div class="col">

                <div class="product-information">

                <?php
                    // Splitting date and time
                    $dateAndTime = explode(' ', $fetch_order['dates']);
                    $date = $dateAndTime[0]; // Extracting date
                    $time = $dateAndTime[1]; // Extracting time
                ?>

                                    

                <div class="image-container">
                    <img src="../web_components/Images/women/<?= $fetch_product['image']; ?>" alt="Product Image">
                 </div>

                    <p class="name" style="font-size: 20px;"><i class="bi bi-bag-fill"></i><?= $fetch_product['name']; ?></p>

                    <p class="date"><i class="bi bi-calendar"></i> <?= $date; ?></p>
                    <p class="time"><i class="bi bi-clock"></i> <?= $time; ?></p>
                    <p class="price"><i class="bi bi-tag-fill"></i> $<?= $fetch_product['price']; ?></p>
                    <div class="total-container">
                    <p class="total"><strong>Total Payable Amount: </strong>$<?= $sub_total; ?></p>
                    </div>
            
              </div>

            </div>

              

            <div class="col billing-details">

            <div class="billing-container">

              
                <p class="title">Billing Address</p>

                
                <p class="user"><i class="bi bi-person-bounding-box"></i> <?= $fetch_order['name']; ?></p>
                <p class="user"><i class="bi bi-phone"></i> <?= $fetch_order['number']; ?></p>
                <p class="user"><i class="bi bi-envelope"></i> <?= $fetch_order['email']; ?></p>
                <p class="user"><i class="bi bi-pin-map"></i> <?= $fetch_order['address']; ?></p>

                
                <p class="status" style="color: <?php if(isset($fetch_order['product_status']) && $fetch_order['product_status'] == 'delivered') {echo 'green';} elseif(isset($fetch_order['product_status']) && $fetch_order['product_status'] == 'canceled') {echo 'red';} else {echo 'orange';} ?>"><?= isset($fetch_order['product_status']) ? $fetch_order['product_status'] : ''; ?></p>

                    
                <?php if ($fetch_order && isset($fetch_order['product_status']) && $fetch_order['product_status'] == 'canceled') { ?>

                    <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn" style="line-height:2;">Order Again</a>
                    <?php } else { ?>

                        <form action="" method="post">

                             <button type="submit" name="cancel" class="btn" onclick="return confirm('Are you sure you want to cancel this order?');">Cancel</button>


                        </form>

                    <?php  } ?>


                </div>


            </div>

    </div>

    

    <?php
    

                }

            }

        }

    } else {

        echo '<p class="empty">No orders placed yet!</p>';
    }


     ?>

        


      

   </div>



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

