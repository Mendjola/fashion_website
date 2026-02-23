<?php

// Start session
session_start();

include "header.php"; 
require_once "../Assets/config.php";



// Redirect users to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header('location:user_login.php');
    exit;
}

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Fetch favorite products for the logged-in user 
$select_favorites = $conn->prepare("SELECT f.*, p.name AS product_name, p.price AS product_price, p.image AS product_image FROM `favorites` f INNER JOIN `products` p ON f.product_id = p.id WHERE f.user_id = ?");
$select_favorites->execute([$user_id]);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Favorites List</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

    <link rel="stylesheet" href="../web_components/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../css/user_style.css" type="text/css">
    <link rel="stylesheet" href="../css/footer.css" type="text/css">



    <style>

        h1 {
            text-align: center;
            font-size: 36px;
            color: #333;
            margin-top: 50px; 
            text-transform: uppercase;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            
        }

        .favorites-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px; 
            margin-bottom: 0px;

        }

        .favorite-products {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 40px;
        }
        .product {
            margin: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }
        .product img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
            width: auto; 
            height: 250px; 
        }
        .product-buttons {
            margin-top: 10px;
            display: flex; 
            justify-content: space-around; 
        }
       
        .product:hover {
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .btn {
            padding: 5px;
            font-size: 14px;

        }

        .btn i.fa-trash {
            font-size: 16px;
            margin-left: 5px;
        }


        .btn i.fa-trash {
            display: none;
        }

        .btn:hover i.fa-trash {
            display: inline-block;
        }

        .delete-all-container{

            margin-left: 800px;
            margin-top: 50px;
            margin-bottom: 50px;
            color: #007bff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            width: 300px;
        }

        .delete-all-container:hover {
            
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);

        }

    </style>
</head>
<body style="overflow-y: auto;">

<div class="favorites-container">
    <h1>My Favorites</h1>
</div>
    <div class="favorite-products">
    <?php
    // Check if favorites exist for the user
    if ($select_favorites->rowCount() > 0) {
        while ($favorite = $select_favorites->fetch(PDO::FETCH_ASSOC)) {
            // Display each favorite product
            $favorite_product_name = $favorite['product_name'];
            $favorite_product_price = $favorite['product_price'];
            $favorite_product_image = $favorite['product_image'];


            echo '<div class="product">';

            // Display product image
            if (!empty($favorite_product_image)) {
                    echo '<img src="../web_components/images/women/' . $favorite_product_image . '" alt="' . $favorite_product_name . '">';
            } else {
                    echo '<p>Image: N/A</p>';
            }
    
            // Display product name
            if (!empty($favorite_product_name)) {
                echo '<h2>' . $favorite_product_name . '</h2>';
            } else {
                echo '<h2>Unknown Product</h2>';
            }

            // Display product price
            if (!empty($favorite_product_price)) {
                echo '<p>Price: $' . $favorite_product_price . '</p>';
            } else {
                echo '<p>Price: N/A</p>';
            }



            // Add buttons to view and delete product
            echo '<div class="product-buttons">';
            //echo '<button class="btn" onclick="viewProduct(' . $favorite['product_id'] . ')">View Product</button>';

            echo '<button class="btn" onclick="deleteFromFavorites(\'' . $favorite['id'] . '\')">Delete<i class="fa fa-trash"></i></button>';

            echo '</div>'; 

            echo '</div>'; 
        }
    } else {
        echo '<p>No favorite products found.</p>';
    }
    ?>
    </div>

    <div class="delete-all-container">
        <button class="btn" onclick="deleteAllFavorites()">Delete All</button>
    </div>


    <script>
        // Function to view product details
        function viewProduct(productId) {
            window.location.href = "../web_components/product_information.php?product_id=" + productId;
        }

        // Function to delete a product from favorites
        function deleteFromFavorites(favorite_id) {
                    
            // Add confirmation dialog
            if (confirm("Are you sure you want to delete this product from the favorites list?")) {
                // If confirmed, send AJAX request to delete_favorites.php
                $.ajax({
                    url: 'delete_favorites.php',
                    type: 'POST',
                    data: { favorite_id: favorite_id }, // Ensure favorite_id is being sent correctly
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            }
}


        // Function to delete all products from favorites list
        function deleteAllFavorites() {
            // Show confirmation dialog
            if (confirm("Are you sure you want to delete all products from the favorites?")) {
                // If confirmed, send AJAX request to delete_all_favorites.php
                $.ajax({
                    url: 'delete_all_favorites.php',
                    type: 'POST',
                    success: function(response) {
                        // Handle success response, e.g., reload the page
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            }
        }

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