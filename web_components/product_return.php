<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Product Return</title>


    <!--Link for the icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
 
    <!--CSS FILE LINK-->
    <link rel="stylesheet" href="../css/footer.css" type="text/css">
 
    <!--FONT FILES LINK-->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
 
    <!--JQuery link for the footer used for the arrow-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!--CSS CODE-->

    <style>


    body {
       font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f8f8;
        
     }


    /* Header Section */
     header {
        background: linear-gradient(45deg, black, #333);
        color: white;
        padding: 50px 0;
        text-align: center;
        position: relative;
    }

    .header-img{

        position: absolute;
        top: 44%;
        right: 28%;
        transform: translate(0, -50%);
        max-width: 50px;

    }

    header h1 {
       font-size: 36px;
       margin-bottom: 10px;
     }

    header p {
       font-size: 18px;
     }


    .icon {
            display: flex;
            align-items: center;
     
    }

    .icon i {
            margin-right: 8px; /* Adds space between icon and text */
            margin-top: -3px;

    }

    .icon i:hover{

        transform: scale(1.3);
        color: #E8D1D3;
    }
     

    .return-case ul {
        list-style-type: square;
         padding: 0;

      
      }

    .return-case li {
        position: relative;
        padding-left: 5px;
        margin-bottom: 10px;
        line-height: 1.5;
        transform: rotateX(10deg);
        text-align: justify;
        margin-left: 20px;
     }

    .return-case ul li:before {
        content: "";  
        position: absolute;
        left: 0;
        color: #333;

      
      }


     .return-procedure {
        max-width: 800px;
        margin: 0 auto;
        margin-top: 100px;
        margin-bottom: 100px;
     }

    .return-case {
        background-color: #f9f9f9;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

     .return-case h3 {
        font-size: 24px;
        margin-bottom: 15px;
        color: #333;
    }

    .return-case p {
        font-size: 16px;
        line-height: 1.5;
        text-align: justify;
        color: #666;
        
    }

    .return-case:hover{

        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    }


      .return-to-main {
                
            position: absolute;
            bottom: -1100px; 
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

<body style="overflow-y: auto;"></body>


    <header>
        <h1>Product Return Policy</h1>
        <p>Your satisfaction is our priority!</p>

        <img src="images/Footer/return_icon.png" alt="Return Product" class="header-img">


    </header>

    <section class="return-procedure">

        <div class="return-case">
            <h3 class="icon"><i class="material-symbols-outlined"> warning</i>Case 1: Defective Product</h3>

            <p>The return of the products, which are considered defective on delivery will be accepted within seven (7) calendar days from their delivery to the customer. At the same time, the product must be undamaged and have all the original documents that accompanied the product and its complete packaging. </p>
                
               <p>In these cases the following applies: </p> 
             
               <ul>

                   <li>The product is received and examined to determine the defect reported by the CUSTOMER.</li>
                   <li>Provided that these have been previously received and checked by the COMPANY, the item will be replaced with the same new one, or in case of non-availability with another product of the same quality and price, but in case the customer does not wish to be replaced, it will be a refund of the original purchase money to the customer.</li>
                   <li>In the case of paying via credit card, the COMPANY is obliged to inform the issuing Bank of the cancellation of the transaction and the bank will proceed with any subsequent actions provided for on the basis of the contract it has drawn up with the customer without the COMPANY being responsible anymore. In the case of cash payment, if the customer had chosen the "pick up from the store" option, it will be done with a refund to him from the COMPANY's network store. In case of payment by bank transfer, a reverse bank transfer will be applied from the COMPANY's accounts to the customer.</li>
                   <li>  The shipping costs both for the return of the products to the COMPANY and for the return to the CUSTOMER of the replaced product are borne by the COMPANY.</li>

               </ul>
             
              
        </div>

        <div class="return-case">
            <h3 class="icon"><i class="material-symbols-outlined">check_circle</i>Case 2: Damaged Item (Under Warranty)</h3>
           
            <p>If the product breaks down within the warranty period, please contact us and the product will either be repaired by our service or replaced with the same product, if there is in stock. Otherwise it will be replaced with another one that matches what you ordered. </p>

        
        </div>

        <div class="return-case">
            <h3 class="icon"><i class="material-symbols-outlined">sentiment_dissatisfied</i>Case 3: Not Satisfied or Changed Mind</h3>
            <p> If you are not satisfied with the product or have changed your mind. In this case: </p>
                
            <ul>

                <li>The product packaging has not been altered or tampered with, so that it is in its original condition</li>
                <li>The product must not have been used</li>
                <li>Don't forget to include the retail receipt sent to you with the product</li>


            </ul>
               
                <p>By paying the above, you should send the product by calling the carrier that delivered the product to you. Shipping costs are your responsibility.</p>
                
                <p>The product will be checked and if it meets the above, it will be replaced with another of equal value or the money you have paid will be returned to a bank account that you will indicate to us. In case it does not meet the above, the product will be returned to you.</p>
                
                <p>The above procedure should be done within 15 days from the date of receipt of the product. </p>

        
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

</html>