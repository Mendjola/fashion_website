
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

// Fetch user profile data
$user_id = $_SESSION['user_id'];
$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);


// Fetch total orders
$select_orders = $conn->prepare("SELECT COUNT(*) AS total_orders FROM `orders` WHERE user_id = ?");
$select_orders->execute([$user_id]);
$total_orders_result = $select_orders->fetch(PDO::FETCH_ASSOC);
$total_orders = $total_orders_result['total_orders'];

// Fetch total messages
$select_message = $conn->prepare("SELECT COUNT(*) AS total_message FROM `message` WHERE user_id = ?");
$select_message->execute([$user_id]);
$total_message_result = $select_message->fetch(PDO::FETCH_ASSOC);
$total_message = $total_message_result['total_message'];


// Check if profile data is fetched successfully
if (!$fetch_profile) {
  
    header("Location: index.php");
    exit(); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - User Profile Page</title>
    <link rel="stylesheet" href="../css/user_style.css" type="text/css">
    <link rel="stylesheet" href="../css/footer.css" type="text/css">

    <link rel="stylesheet" href="../web_components/font-awesome-4.7.0/css/font-awesome.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    

    <style>

    .box-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        
        flex-wrap: wrap; 
        width: 100%;
        margin: 0 auto;
    }

    .box {
        width: 45%;
        padding: 20px; 
        box-sizing: border-box;
        border-radius: 10px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
        margin-bottom: 20px; 

      
    }

    .left-box {
     order: 1; 
    }

    .right-box {
        order: 2; 
    }
    

    .circle {
        width: 60px; 
        height: 60px; 
        background-color: white; 
        color: white; 
        border-radius: 50%; 
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px; 
        font-weight: bold; 
        margin-bottom: 10px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 

    }



    .flex {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .info {
        margin-top: 10px; 
    }

    .info p {
        margin: 0; 
    }


   

    </style>


</head>
<body style="overflow-y: auto;">

<div class="container">
    
<section class="profile">

   <div class="heading">

     <h2>Profile Details</h2>

   </div>
   

   <div class="details">

       <div class="user">

            <img src="uploaded_img/<?= $fetch_profile['image']; ?>" >
            <h3><?= $fetch_profile['user_name']; ?></h3>
            <p style="margin-top: 10px; font-size: 16px;">Customer</p>
            <a href="update.php" class="btn">Update Profile</a>

       </div>

        <div class="box-container">
            <div class="box left-box">
                <div class="flex">
                    <div class="circle">
                        <i class="bi bi-truck" style="font-size: 24px; color:lightpink;"></i>
                    </div>
                  <p>Total Orders: <?= $total_orders;?></p>
                 </div>
               <a href="orders.php" class="btn">View Orders</a>
            </div>

            <div class="box right-box">
                <div class="flex">
                 <div class="circle">
                    <i class="bi bi-chat-left-text" style="font-size: 24px; color:lightpink;"></i>
                </div>
                <p>Total Messages: <?= $total_message; ?></p>
            </div>
            <a href="message.php" class="btn">View Messages</a>
        </div>

       </div>
   </div>

</section>
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

