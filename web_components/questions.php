<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - FAQs</title>

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
            font-family: Arial, sans-serif;
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

        #header_image  {
            position: absolute;
            top: 12%;
            right: 27%;
            transform: translate(0, -50%);
            max-width: 40px;
        }
        

        .main-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 70px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: #fff;
            margin-bottom: 100px;
            margin-top: 100px;

        }


        .faq-item {
            margin-bottom: 20px;
          
        }

        .question {
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
        }

        .answer {
            display: none;
            padding: 10px;
            border-top: 1px solid #ccc;
            margin-top: 10px;
     
        }

        .plus-minus-icon {
            font-size: 18px;
            cursor: pointer;
        }  

        a {
             text-decoration: none;
             color: darkgray; 
             cursor: pointer;
        }

        a:hover {
            color: black; 
        }
        
        .return-to-main {
                
            position: absolute;
            bottom: -400px; 
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
        <h1>Frequently Asked Questions</h1>

        <img src="images/Footer/faq_icon.png" alt="FAQ icon" id="header_image">

        
  </header>

    <div class="main-content">
        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(1)">
                <div>Should I be a member to make orders?</div>
                <div class="plus-minus-icon" id="icon1">+</div>
            </div>
            <div class="answer" id="answer1">No, there is no need.</div>
        </div>

        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(2)">
                <div>How can I see the cost of the order?</div>
                <div class="plus-minus-icon" id="icon2">+</div>
            </div>
            <div class="answer" id="answer2">You can see the cost in the <a href="shipping_info.php">shipping and cost methods</a> page.</div>
        </div>

        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(3)">
                <div>Does the prices include VAT</div>
                <div class="plus-minus-icon" id="icon3">+</div>
            </div>
            <div class="answer" id="answer3">Yes, every price written on the website includes VAT.</div>
        </div>


        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(4)">
                <div>How can I buy a product that is not available?</div>
                <div class="plus-minus-icon" id="icon4">+</div>
            </div>
            <div class="answer" id="answer4">You can proceed with the order and one of our employees will inform you about the date the product will be delivered.</div>
        </div>


        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(5)">
                <div>How can I contact you for questions?</div>
                <div class="plus-minus-icon" id="icon5">+</div>
            </div>
            <div class="answer" id="answer5">You can contact us via our phone: +2410-555343 or via email:  info@MKfashion.com or even by completing the <a href="contact.php">form</a>.</div>
        </div>


        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(6)">
                <div>If I want to return a product what is the process?</div>
                <div class="plus-minus-icon" id="icon6">+</div>
            </div>
            <div class="answer" id="answer6">It depends on if the product is under warranty, or if it has a defect or not but for more information, you can go in the <a href="product_return.php">product return policy</a> page.</div>
        </div>


        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(7)">
                <div>How can I pay the order?</div>
                <div class="plus-minus-icon" id="icon7">+</div>
            </div>
            <div class="answer" id="answer7">You can pay by bank deposit, credit, debit, prepaid card, cash on delivery or PayPal. More details on the <a href="shipping_info.php">Payment and Shipping methods</a> page.</div>
        </div>


        <div class="faq-item">
            <div class="question" onclick="toggleAnswer(8)">
                <div>Can I come in the store to see the products in person?</div>
                <div class="plus-minus-icon" id="icon8">+</div>
            </div>
            <div class="answer" id="answer8">We are exclusively an online store. But if you wish after making the order you can come to our headquarter and take the product there.</div>
        </div>
       
    </div>


    <script>
        function toggleAnswer(index) {
            const icon = document.getElementById(`icon${index}`);
            const answer = document.getElementById(`answer${index}`);
    
            if (answer.style.display === 'block') {
                answer.style.display = 'none';
                icon.textContent = '+';
            } else {
                answer.style.display = 'block';
                icon.textContent = '-';
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