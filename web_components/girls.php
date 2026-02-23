
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
    <title>MK Store - Girls</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

     <!--CSS FILE LINK-->
     <link rel="stylesheet" href="../css/footer.css" type="text/css">
    <link rel="stylesheet" href="../css/user_style.css" type="text/css">

    <!--FONT FILES LINK-->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">


    <style>

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #F2D7E2; 
            color: #333;
        }


        .girls-section-heading {
            text-align: center;
            font-size: 20px;
            text-transform: uppercase;
            font-weight: bolder;
            background: #FF89A0; 
            color: white;
            margin-top: 100px;
            margin-bottom: 20px;
            padding: 5px;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center;
            height: 100px;
        }

        .girls-section-heading h1 {

            transform: perspective(1000px) rotateX(-20deg);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); 
            margin: 0; 
            font-size: 36px;

    
        }

        .age-range {
            margin-top: 10px;
            text-align: center;
            font-size: 18px;
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .girls-products {

            padding-top: 30px;
            margin-bottom: 100px;
            margin-top: 70px;
        }

        .girls-products .product_container {
            display: grid;
            grid-template-columns: repeat(4, 250px);
            gap: 20px;
            justify-content: center;
            grid-row-gap: 20px;
        }

        .girls-products .product_container .product {
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

        .girls-products .product_container .product:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .girls-products .product_container .product .image {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 350px;
            overflow: hidden;
            border-radius: 10px 10px 0 0;
        }

        .girls-products .product_container .product .image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease-out;
            border-radius: 10px 10px 0 0;
        }

        .girls-products .product_container .product .content {
            padding-top: 0;
            padding: 10px;
        }

        .girls-products .product_container .product .content h3 {
            font-size: 12px;
            margin-bottom: 5px;
        }

        .girls-products .product_container .product .content .price {
            display: inline-block;
            color: #e1c5c0;
            font-size: 13px;
        }

        .girls-products .product_container .product .content .price del {
            text-decoration: line-through;
            color: #aaa;
        }

        .girls-products .product_container .product .content .rating {
            padding: 10px 0;
            font-size: 10px;
            color: #e1c5c0;
        }

        .girls-products .product_container .product .content .availability {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .girls-products .product_container .product .content .fa-shopping-basket,
        .girls-products .product_container .product .content .fa-heart,
        .girls-products .product_container .product .content .fa-eye {
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

        .girls-products .product_container .product .content .fa-shopping-basket:hover,
        .girls-products .product_container .product .content .fa-heart:hover,
        .girls-products .product_container .product .content .fa-eye:hover {
            color: white;
            background: #e8ded1;
            transition: 0.3s ease-in-out;
        }


        @media only screen and (max-width: 768px) {
            .girls-section-heading {
                font-size: 18px;
            }

            .age-range {
                font-size: 16px;
            }

            .girls-products .product_container {
                grid-template-columns: repeat(2, 1fr);
            }

            .girls-products .product_container .product {
                max-width: 100%;
            }
        }
    </style>
        

 </style>



</head>
<body style="overflow-y: auto;">

    <div class="girls-section-heading">
    <h1 class="">Girls' Clothes</h1>
    <p class="age-range">Age: 4-14</p></div>

    <!-- Girls' Section -->
    <section class="girls-products" id="product">

        <div class="product_container">
            <div class="product">
                <div class="image">
                    <img src="images/Girls/black_cargo_jeans.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Black Cargo Jeans</h3>
                    <div class="price">

                        $25.99
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
                    <img src="images/Girls/black_dress.webp" alt="">
                </div>
                <div class="content">
                    <h3>Black Cute Dress</h3>
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
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>


            <div class="product">
                <div class="image">
                    <img src="images/Girls/blue_hoodie.webp" alt="">
                </div>
                <div class="content">
                    <h3>Blue Hoodie</h3>
                    <div class="price">
                        
                        $25.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-half" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>

            <div class="product">
                <div class="image">
                    <img src="images/Girls/pink_winter_jacket.webp" alt="">
                </div>
                <div class="content">
                    <h3>Pink Winter Jacket</h3>
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
                    <div class="availability"> 3 Last Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>


            <div class="product">
                <div class="image">
                    <img src="images/Girls/knitted_sweater dress.webp" alt="">
                </div>
                <div class="content">
                    <h3>Knitted Sweater Dress</h3>
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
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>


            <div class="product">
                <div class="image">
                    <img src="images/Girls/light_pink_skirt.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Light Pink Skirt</h3>
                    <div class="price">
                       
                        $15.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-half" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>

            <div class="product">
                <div class="image">
                    <img src="images/Girls/jean_skirt.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Jean Skirt</h3>
                    <div class="price">
            
                        $19.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Out of Stock</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>

            <div class="product">
                <div class="image">
                    <img src="images/Girls/pink_dress.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Cute Pink Dress</h3>
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
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>
            

            <div class="product">
                <div class="image">
                    <img src="images/Girls/light_pink_cargo_jeans.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Light Pink Cargo Jeans</h3>
                    <div class="price">
                       
                        $39.99
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
                    <img src="images/Girls/gold_formal_dress.webp" alt="">
                </div>
                <div class="content">
                    <h3>Gold Formal Dress</h3>
                    <div class="price">
                       
                        $119.99
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
                    <img src="images/Girls/sweater_dress.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Sweater Dress</h3>
                    <div class="price">
                
                        $39.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-half" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>

            <div class="product">
                <div class="image">
                    <img src="images/Girls/white_sweater.avif" alt="">
                </div>
                <div class="content">
                    <h3>White Sweater</h3>
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
                    <div class="availability">Last 3 Available</div>
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