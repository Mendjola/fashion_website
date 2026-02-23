<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Shipping and Payment Information</title>

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
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            color: black;
        }

        header {
            background: linear-gradient(45deg, black, darkgray );
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        header .image-container {
            position: absolute;
            top: 12%;
            right: 20%;
            transform: translate(0, -50%);
            max-width: 50px;
        }

        header img{

            max-width: 85%;
          
            
        }

        #header_icon {
            font-size: 24px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 13px;
        }


        h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        

        .main-content {
            max-width: 800px;
            margin: 100px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 100px;
      
        }

        .main-content:hover{

            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        }

        section {
            margin-bottom: 30px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            color: #666;
            text-align: justify;
        }

        .return-to-main {
                
            position: absolute;
            bottom: -850px; 
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

       ul {
            list-style: square;
             padding-left: 20px;
           }

        li {
           margin-bottom: 8px;
            text-align: justify;
            color: #666;
        }

        .icon {
            display: flex;
            align-items: center;
     
       }

        .icon i {
            margin-right: 8px; 
            margin-top: -3px;

        }

        /*Style for the table*/
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: lightgray;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        @media only screen and (max-width: 768px) {
            table {
                font-size: 14px;
            }
        }


    </style>



</head>

<body style="overflow-y: auto;"></body>


    <header>

        <h1>Shipping and Payment Methods</h1>

        <div class="image-container">

        <img src="images/Footer/shipping.png"  alt="Shipping Icon">
 

        <i class="material-symbols-outlined" id="header_icon">monetization_on</i>
      
    </div>

    </header>

    <div class="main-content">

        <section>
            <h2 class="icon"><i class="material-symbols-outlined">account_balance</i>Bank Deposit</h2>
            <p>You can prepay your order by bank deposit by making sure you send us a copy of the deposit in our email: info@MKfashion.com including your order number.</p>
        </section>

        <section>
            <h2 class="icon"><i class="material-symbols-outlined">wallet</i>Payment via PayPal</h2>
            <p>Make your purchases via PayPal on a website designed for fast, easy, secure, and safe online financial transactions.</p>
            <p>Your PayPal code and connected card or account details are not disclosed to the online store.</p>

       
        </section>

        <section>
            <h2 class="icon"><i class="material-symbols-outlined">credit_card</i>Payment by Card (Credit - Debit - Prepaid)</h2>
            

            <ul>
                <li>Our online fashion store accepts all Visa, MasterCard, Maestro, and Electron credit cards.</li>
                <li>The charge is made on the day the shipping process of the products begins.</li>
                <li>You must provide a landline number and may be asked for copies of your ID and credit, debit, or prepaid card.</li>
            </ul>



        </section>

        <section>
            <h2 class="icon"><i class="material-symbols-outlined">percent </i>Interest-free Installment Plan</h2>
            <p>Take advantage of our interest-free installment plan and make purchases in up to 3 interest-free installments!</p>
        </section>

        <section>
            <h2 class="icon"><i class="material-symbols-outlined">payments</i>Cash on Delivery (Cash + €2.00)</h2>
            <p>Choose payment by cash on delivery by paying the total price to the courier. An additional fee of 2.00 Euro (incl. VAT) applies.</p>
            <p>The maximum allowable amount for cash payment is €200. Above this amount, a 20% deposit is required.</p>
        </section>


    <!-- Shipping Cost Table -->
    <section>
        <h2 class="icon"><i class="material-symbols-outlined">local_shipping</i>Shipping Cost Table</h2>
        <table>
            <thead>
                <tr>
                    <th>Package Cost</th>
                    <th>Package Weight</th>
                    <th>Shipping Cost</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Below $50</td>
                    <td>Below 2kg</td>
                    <td>$3.90</td>
                </tr>
                <tr>
                    <td>Below $50</td>
                    <td>Above 2kg</td>
                    <td>$4.90</td>
                </tr>
                <tr>
                    <td>$50 and above</td>
                    <td>Below 2kg</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td>$50 and above</td>
                    <td>Above 2kg</td>
                    <td>$1.99</td>
                </tr>
            </tbody>
        </table>
    </section>


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


</html>