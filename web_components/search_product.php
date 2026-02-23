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

        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Search Product</title>
     
     <!--Link for the icons-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
 
    <!--CSS FILE LINK-->
    <link rel="stylesheet" href="../css/footer.css" type="text/css">
 
     <!--FONT FILES LINK-->
     <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
 
     <!--JQuery link for the footer used for the arrow-->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

    <style>

         body {
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            margin-top: 40px;
            color: white;
            padding: 50px 0;
            text-align: center;
            font-size: 36px;
            text-transform: uppercase; 
            text-shadow: 1px 4px 1px rgba(0, 0, 0, 0.5); 
            transition: all 0.3s ease-in-out;
        }

        .box-container.grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            grid-gap: 20px;
        }

        .product {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            transition: transform 0.3s ease;
            margin: 30px;
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }

        .img-box {
            width: 100%;
            height: 350px; 
            overflow: hidden;
            margin-bottom: 10px;
        }

        .img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .details {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); 
            border-radius: 10px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            transform: translateY(-10px); 
            opacity: 0; 
        }

        .product:hover .details {
            transform: translateY(0); 
            opacity: 1; 
        }

        .product_details {
            color: #666;
            line-height: 1.5;
        }

        .product_price {
            color: lightpink;
            font-weight: bold;
            margin-top: 10px;
        }

        .info h2 {
            margin-bottom: 10px;
        }

        .info p {
            margin-bottom: 15px;
        }

        .info p:last-child {
            margin-bottom: 0;
        }

        .title {
            margin-bottom: 10px;
            font-size: 24px;
            color: lightpink;
        }

        .info {
            text-align: center;
            padding: 20px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
        
        
    </style>


</head>

<body style="overflow-y: auto;">


<div class="products">
    <h1>Search Products</h1>
    <div class="box-container grid-container">
        <?php 
        // Fetch and display products
        if (isset($_POST['search_product']) || isset($_GET['searchBtn'])) {
            $search_products = isset($_POST['search_product']) ? $_POST['search_product'] : (isset($_GET['search_product']) ? $_GET['search_product'] : '');

            if (!empty($search_products)) {
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE ? AND product_status = 'active'");
                $select_products->execute(["%{$search_products}%"]);

                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                        // Display product information
                        echo '<div class="product">';
                        echo '<div class="img-box">';
                        echo '<img src="Images/women/' . $fetch_products['image'] . '" alt="' . $fetch_products['name'] . '">';
                        echo '</div>';
                        echo '<div class="info">';
                        echo '<h2>' . $fetch_products['name'] . '</h2>';
                        echo '<p>' . $fetch_products['product_details'] . '</p>';
                        echo '<p>Price: $' . $fetch_products['price'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="empty">No Products Found!</p>';
                }
            } else {
                echo '<p class="empty">Please search for something else!</p>';
            }
        } else {
            // Fetch all products if no search query is provided
            $select_all_products = $conn->prepare("SELECT * FROM `products` WHERE product_status = 'active'");
            $select_all_products->execute();

            if ($select_all_products->rowCount() > 0) {
                while ($fetch_products = $select_all_products->fetch(PDO::FETCH_ASSOC)) {
                    // Display product information

                    echo '<div class="product">';
                    echo '<div class="img-box">';
                    echo '<img src="Images/women/' . $fetch_products['image'] . '" alt="' . $fetch_products['name'] . '">';
                    echo '</div>';
                    echo '<div class="info">';
                    echo '<h2 class="title">' . $fetch_products['name'] . '</h2>';
                    echo '<div class="details">';
                    echo '<p class="product_details">' . $fetch_products['product_details'] . '</p>';
                    echo '<p class="product_price">$' . $fetch_products['price'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    
                }
            } else {
                echo '<p class="empty">No Products Found!</p>';
            }
        }
        ?>
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
                dropdownButton.classList

                .remove('active');
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


</script>



</html>


