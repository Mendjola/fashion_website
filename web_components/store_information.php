<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Who We Are</title>

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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        header {
            background: linear-gradient(45deg, #333, #777);
            color: white;
            padding: 50px 0;
            text-align: center;
        }

        .main-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 50px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 100px;
            margin-top: 100px;
        }

        h1, h2, p {
            color: #333;
        }

        p {
            text-align: justify;
        }

        ul {
            list-style-type: square;
            padding-left: 20px;
        }

        ul li {
            position: relative;
            padding-left: 20px;
            margin-bottom: 10px;
            text-align: justify;
        }

        ul li::before {
            content: ' ';
            position: absolute;
            left: 0;
            color: #333;
        }

        .offer-box {
            background-color: #f9f9f9;
            padding: 15px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .offer-box strong {
            color: #333;
        }

        .icon {
            display: flex;
            align-items: center;
     
        }

       .icon i {
            margin-right: 8px; 
            margin-top: -3px;

        }

        .return-to-main {
                
                position: absolute;
                bottom: -350px; 
                right: 20px; 
                display: inline-block;
                padding: 10px 20px;
                background-color: #333;
                font-size: 12px;
                color: white;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }

        .return-to-main:hover {
                background-color: gray;
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.8); 

                    
        }
   

    </style>


</head>

<body style="overflow-y: auto;">


    <header>
        <h1>Welcome to MK Fashion Store</h1>
    </header>

    <div class="main-content">
        <h2 class="icon"><i class="material-symbols-outlined">info</i>About Us</h2>
        <p>We are MK Store, a fashion-forward online retailer specializing in clothing and accessories for women, men, boys, girls, and babies. Since our inception in 2018, we have prioritized swift and accurate customer service, introduced innovative products, and maintained competitive pricing. Over the years, we've cultivated a growing customer base, expanded our product categories, and upheld our commitment to excellent service and after-sales support.</p>

        <h2 class="icon" style ="margin-top: 40px;"><i class="material-symbols-outlined">apparel</i>What We Offer</h2><div class="offer-box">
            <ul >
                <li><strong>Quality:</strong> Discover innovative products that make a difference, offered to you at competitive prices.</li>
                <li><strong>Great Deals:</strong> Sign up today and enjoy 15% off your first purchase, or take advantage of our consistently low prices!</li>
                <li><strong>Service:</strong> Our friendly and specialized staff are always ready to assist you in making your purchases with ease and speed.</li>
                <li><strong>Quick Delivery:</strong> Experience next working day delivery for orders received by 2 pm (applies to available products).</li>
            </ul>
        </div>

    </div>


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
            <h2 style="color: white;">Newsletter</h2>
            <form id="subscriptionForm"> 
                <input type="email" id="email" name="email" placeholder="type email here..." required>
                <button type="button" onclick="subscribe()">Subscribe</button>
                <br>
                <input type="checkbox" id="termsCheckbox" required>
                <label for="termsCheckbox">I agree with the terms and conditions</label>
                <br>
                
            </form>
        </div>
    
        <div class="social-media-section">
            <p style="color: white; text-align: center;">Do you want to get informed first about new products or offers?</p>
            <p style="color: white; text-align: center;">Follow us on our social media accounts!</p>
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
    
        <p class="copyright-text" style ="text-align: center;">The content of this site is copyright-protected ©  and is the property of MK Store.</p>
    
    
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

<a href="index.php" class="return-to-main">MAIN PAGE</a>
  
    
</body>
</html>