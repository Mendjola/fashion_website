
<?php 

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
 }

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header('location: ../user/user_login.php');
    exit();
}


include 'header.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Accessories</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!--CSS FILE LINK-->
    <link rel="stylesheet" href="../css/footer.css" type="text/css">
    <link rel="stylesheet" href="../css/user_style.css" type="text/css">

    <!--FONT FILES LINK-->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    
    <style>


        body {

            color: #333;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #fce8e8 25%, #ffffff 100%);
    
         }
         
         

         .bags_section, .shoes_section {
            text-align: center;
            font-size: 24px;
            text-transform: uppercase;
            font-weight: bolder;
            background: rgba(255, 255, 255, 0.9);
            margin: 40px 0;
            padding: 20px;
            position: relative;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
            animation: shadowMovement 3s infinite alternate; 
        }


        @keyframes shadowMovement {
            0% {
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
            }
            100% {
                box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.7); 


            }
        }


        .accessories-products {
            padding-top: 30px;
            margin-bottom: 100px;
            margin-top: 100px;

        }

        .accessories-products .product_container {
            display: grid;
            grid-template-columns: repeat(4, 250px);
            gap: 20px;
            justify-content: center;
            grid-row-gap: 20px;
        }

        .accessories-products .product_container .product {
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

        .accessories-products .product_container .product:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .accessories-products .product_container .product .image {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 250px; 
            overflow: hidden;
            border-radius: 10px;
            background: #D1BFA9; 
        }

        .accessories-products .product_container .product .image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease-out;
        }

        .accessories-products .product_container .product .content {
            padding-top: 0;
            padding: 10px;
        }

        .accessories-products .product_container .product .content h3 {
            font-size: 12px;
            margin-bottom: 5px;
        }

        .accessories-products .product_container .product .content .price {
            display: inline-block;
            color: #7C6E62; 
            font-size: 13px;
        }

        .accessories-products .product_container .product .content .price del {
            text-decoration: line-through;
            color: #aaa;
        }

        .accessories-products .product_container .product .content .rating {
            padding: 10px 0;
            font-size: 10px;
            color: #7C6E62; 
        }

        .accessories-products .product_container .product .content .availability {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .accessories-products .product_container .product .content .fa-shopping-basket,
        .accessories-products .product_container .product .content .fa-heart,
        .accessories-products .product_container .product .content .fa-eye {
            text-align: center;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 10px;
            cursor: pointer;
            background: none;
            font-size: 12px;
            color: #7C6E62; 
            border: 2px solid #D1BFA9; 
            margin: 0;
        }

        .accessories-products .product_container .product .content .fa-shopping-basket:hover,
        .accessories-products .product_container .product .content .fa-heart:hover,
        .accessories-products .product_container .product .content .fa-eye:hover {
            color: white;
            background: #D1BFA9; 
            transition: 0.3s ease-in-out;
        }


        @media only screen and (max-width: 768px) {
            .accessories-section-heading {
                font-size: 18px;
            }

            .age-range {
                font-size: 16px;
            }

            .accessories-products .product_container {
                grid-template-columns: repeat(2, 1fr);
            }

            .accessories-products .product_container .product {
                max-width: 100%;
            }
        }   

       
    

    </style>





</head>

<body style ="overflow-y: auto;">


    <!-- Accessories Section -->
    <section class="accessories-products" id="product">

        <h2 class="bags_section">Bags</h2>

        <div class="product_container">
            <div class="product">
                <div class="image">
                    <img src="images/Accessories/black_shoulder_bag.webp" alt="">
                </div>
                <div class="content">
                    <h3>Black Shoulder Bag</h3>
                    <div class="price">
                       
                        $49.99
                        
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Available</div>
                    <i class="fa fa-heart" data-product-name="Product Name" data-product-image="product-image.jpg"></i>
                    <i class="fa fa-shopping-basket basket-icon" data-product-name="Product Name" data-quantity="0" data-product-image="product-image.jpg"></i>
                    <i class="fa fa-eye" data-product-image="product-image.jpg"></i>
                </div>
            </div>

            <div class="product">
                <div class="image">
                    <img src="images/Accessories/pink_bag.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Pink Bag</h3>
                    <div class="price">
                       
                        $29.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket " aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>

            <div class="product">
                <div class="image">
                    <img src="images/Accessories/formal_glitter_tote_bag.webp" alt="">
                </div>
                <div class="content">
                    <h3>Glitter Tote Bag</h3>
                    <div class="price">
                       
                        $59.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>


            <div class="product">
                <div class="image">
                    <img src="images/Accessories/men_brown_bag.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Men Brown Leather Bag</h3>
                    <div class="price">
                       
                        $139.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>

             

        </div>


         <!-- Shoes' Section -->
         <h2 class="shoes_section">Shoes</h2>

         <div class="product_container">
             <div class="product">
                 <div class="image">
                     <img src="images/Accessories/booter_over_the_knee.jpeg" alt="">
                 </div>
                 <div class="content">
                     <h3>Over the knee Boots</h3>
                     <div class="price">
                        
                         $79.99
                     </div>
                     <div class="rating">
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                     </div>
                     <div class="availability">Available</div>
                     <i class="fa fa-heart" aria-hidden="true"></i>
                     <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                     <i class="fa fa-eye" aria-hidden="true"></i>
                 </div>
             </div>
 
 
             <div class="product">
                 <div class="image">
                     <img src="images/Accessories/black_boots.webp" alt="">
                 </div>
                 <div class="content">
                     <h3>Black Boots</h3>
                     <div class="price">
                         
                         $69.99
                     </div>
                     <div class="rating">
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                     </div>
                     <div class="availability">Available</div>
                     <i class="fa fa-heart" aria-hidden="true"></i>
                     <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                     <i class="fa fa-eye" aria-hidden="true"></i>
                 </div>
             </div>
 
 
             <div class="product">
                 <div class="image">
                     <img src="images/Accessories/men_formal_brown_shoes.avif" alt="">
                 </div>
                 <div class="content">
                     <h3>Men Formal Brown Shoes</h3>
                     <div class="price">
                      
                         $139.99
                     </div>
                     <div class="rating">
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star-o" aria-hidden="true"></i>
                     </div>
                     <div class="availability">Available</div>
                     <i class="fa fa-heart" aria-hidden="true"></i>
                     <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                     <i class="fa fa-eye" aria-hidden="true"></i>
                 </div>
             </div>
 
 
             <div class="product">
                 <div class="image">
                     <img src="images/Accessories/men_brown_boots.webp" alt="">
                 </div>
                 <div class="content">
                     <h3>Men Brown Boots</h3>
                     <div class="price">
                       
                         $159.99
                     </div>
                     <div class="rating">
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                         <i class="fa fa-star" aria-hidden="true"></i>
                     </div>
                     <div class="availability">Available</div>
                     <i class="fa fa-heart" aria-hidden="true"></i>
                     <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                     <i class="fa fa-eye" aria-hidden="true"></i>
                 </div>
             </div>
 
         </div>

    </section>

  

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