<?php

session_start(); // Start the session to access session variables

require_once "../Assets/config.php";

// Error handling for database connection
if ($conn) {
    // Connection successful
} else {
    // Connection failed
    $errorInfo = $conn->errorInfo();
    die("Connection failed: " . $errorInfo[2]);
}

/* Message  */

if (isset($_POST['send_message'])) {
    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_SPECIAL_CHARS);

    $subject = $_POST['subject']; 
    $subject = filter_var($subject, FILTER_SANITIZE_SPECIAL_CHARS);

    $message = $_POST['message'];
    $message = filter_var($message, FILTER_SANITIZE_SPECIAL_CHARS);

    // Retrieve user ID from session
    $user_id = $_SESSION['user_id'];

    $verify_message = $conn->prepare("SELECT * FROM `message` WHERE name = ? AND email = ? AND topic = ? AND text = ?");
    $verify_message->execute([$name, $email, $subject, $message]);

    if ($verify_message->rowCount() > 0) {
        $warning[] = 'Message already sent';
    } else {
        $insert_message = $conn->prepare("INSERT INTO `message`(id, user_id, name, email, topic, text) VALUES(?,?,?,?,?,?)");
        $insert_message->execute([$id, $user_id, $name, $email, $subject, $message]);
        $success[] = 'Message sent successfully';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Contact</title>
     
    <!--CSS link for the footer-->
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 
    <!--JQuery link for the footer used for the arrow-->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!--font files link-->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    
     <!--Link for the icons-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    

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
            padding: 40px 0;
            text-align: center;
        }

        .main-content {
            
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: white;
            border-radius: 10px;
            margin-top: 80px; 
            margin-bottom: 100px; 
        }
        
        

        .contact-container {
            display: flex;
            justify-content: space-between;
           
        }

        .contact-info {
            width: 48%;
            
        }

        .contact-form-container {
            width: 48%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px;
            background-color: #fff;
         
        }

        h1, h2, p {
            color: #333;
            margin-top: 50px;
        }

        #contact_text {
            text-align: justify;
        }

        ul {
            list-style-type: none;
            padding-left: 20px;
        }

        ul li {
            position: relative;
            padding-left: 20px;
            margin-top: 10px;
        }

        ul li::before {
            content: '\2022';
            position: absolute;
            left: 0;
            color: #333;
        }

        .contact-info h2, .contact-form-container h2 {
            font-size: 24px;
           
        }

        .contact-info p, .contact-form p {
            margin-bottom: 15px;
            
        }
        .contact-form-container h2{

            margin-top:10px;
        }

        .contact-form {
            max-width: 400px;
            margin-top: 20px;
            transition: all 0.3s ease;
         
        }


        .required {
            color: red;
            font-weight: bold;
        }

        .error-message {
            color: red;
            margin-top: 5px;
        }

        .success-message {
            color: #E8D1D3;
            margin-top: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #666;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        input:focus, textarea:focus {
            border-color: #E8D1D3;
            outline: none;
        }

        .btn {
            background-color: #666;
            padding: 10px 15px;
            border: none;
            border-radius: 2px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }



        .btn:hover {
            background-color: #E8D1D3;
            color: transparent;

            
        }

        .btn i {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: transparent;
        }

        .btn:hover i {
            color: black; /* Displays the icon on hover */
        }


        .contact-info ul {
          list-style-type: none;
           padding-left: 0;
        }

        .contact-info ul li {
           margin-bottom: 10px;

        }

        .contact-info ul li::before {
          content: '\25A0'; /* Unicode character for a solid square */
          margin-right: 5px; 
          }



        .icon {
            display: flex;
            align-items: center;
     
         }


         .icon i {
            margin-right: 8px; 
            margin-top: -3px;

         }

         #map-container {
             width: 85%; 
             height: 250px;
             margin-top: 30px;
             overflow: hidden;
             border: 1px solid #ccc; 
             border-radius: 10px; 
             box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); 
             margin-right: 20px; 
           }

           .return-to-main {
                
                position: absolute;
                bottom: -460px; 
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
        <h1>Contact Us</h1>
    </header>
    
    <div class="main-content">
        <div class="contact-container">
            <div class="contact-info">
                <h2 class="icon"><i class="material-symbols-outlined">schedule</i>Contact Hours</h2>

                <ul>
                    <li>Monday – Friday: 09:00 – 21:00</li>
                    <li>Saturday: 9:00 – 20:00</li>
                    <li>Sunday: Closed</li>

                </ul>

                <h2 class="icon"><i class="material-symbols-outlined">location_on</i>New York Main Street</h2>

                <div id="map-container">
         
                    <!-- Google Maps embed code -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.1841011486276!2d-73.82767012442949!3d40.735974371390036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c260618039000d%3A0x4e4216fa03a650cf!2zTWFpbiBTdCwgUXVlZW5zLCBOWSwgzpfOvc-JzrzOrc69zrXPgiDOoM6_zrvOuc-EzrXOr861z4I!5e0!3m2!1sel!2sgr!4v1702091302027!5m2!1sel!2sgr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>


            </div>
        
            <div class="contact-form-container">
            <div class="form-cont">

            <h2 class="icon"><i class="material-symbols-outlined">call</i>Contact us</h2>
            <p id="contact_text">For any question or clarification, please contact us at +2410-555343 or send an email to
            customercare@mkfashion.gr.</p>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="register">


                <div class="input-fields">

                <label>Name <sup class="required">*</sup></label>
                <input type="text" name="name" placeholder="Enter your name" required class="box">

                </div>


                <div class="input-fields">

                     <div><label>Email <sup class="required">*</sup></label>

                    <input type="email" name="email" placeholder="Enter your email" required class="box">

                </div>

                <div class="input-fields">

                    <label>Subject <sup class="required">*</sup></label>
                    <input type="text" name="subject" placeholder="Reason..." required class="box">

                </div>

                <div class="input-fields">

                   <label>Message <sup class="required">*</sup></label>
                    <textarea name="message" cols="30" rows="10" placeholder="" required class="box"></textarea>

                </div>

                <button type ="submit" name ="send_message" class="btn">Send <i class="fa fa-paper-plane"></i></button>


            </form>
               
        </div>

            
        </div>

    </div>

    </div>

    </div>

    <!--Javascript for the form-->
    <script>


    document.addEventListener('DOMContentLoaded', function () {
    const contactForm = document.getElementById('contactForm');
    const submitButton = contactForm.querySelector('button');
    const successMessage = document.getElementById('successMessage');

    contactForm.addEventListener('input', function () {
      const requiredFields = contactForm.querySelectorAll('[required]');
      let formComplete = true;

      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          formComplete = false;
          document.getElementById('error' + field.id).textContent = field.name + ' is required.';
        } else {
          document.getElementById('error' + field.id).textContent = '';
        }
      });

      // Clears email validation error when the user is typing
      document.getElementById('errorEmail').textContent = '';


      submitButton.disabled = !formComplete;
    });

    contactForm.addEventListener('submit', function (event) {
      event.preventDefault();

      // Validates email
      const emailField = contactForm.querySelector('#email');
      const emailValue = emailField.value.trim().toLowerCase();
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!emailRegex.test(emailValue)) {
        document.getElementById('errorEmail').textContent = 'Invalid email format.';
        return;
      } else {
        document.getElementById('errorEmail').textContent = '';
      }
    
      // Displays success message with the entered name
      const enteredName = formDataObject['firstName'];
      successMessage.textContent = `Thank you ${enteredName}! One of our employees will reach out to you as soon as possible.`;

      // Clears the form after submission
      contactForm.reset();
      submitButton.disabled = true;

      // Clears success message after a few seconds
      setTimeout(() => {
        successMessage.textContent = '';
      }, 5000);
    });

    // Activates animated form
    const animatedForm = document.querySelector('.animated-form');
    animatedForm.classList.add('active');
  });

</script>


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
        <h2 style="color: white;">Newsletter</h2>
        <form id="subscriptionForm"> 
          <!--  <label for="email">Email:</label> -->
            <input type="email" id="email" name="email" placeholder="type email here..." required>
            <button type="button" onclick="subscribe()">Subscribe</button>
            <br>
            <input type="checkbox" id="termsCheckbox" required style ="margin-left: 596px; top: 29px; position: relative;">
            <label for="termsCheckbox" >I agree with the terms and conditions </label>
            <br>
            
        </form>
    </div>

    <div class="social-media-section">
        <p style="color: white;">Do you want to get informed first about new products or offers?</p>
        <p style="color: white;">Follow us on our social media accounts!</p>
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


<a href="index.php" class="return-to-main">MAIN PAGE</a>


</html>