<?php 
        include "header.php";
        require_once "../Assets/config.php";


        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
        } else {
            $user_id = '';
        }

        // Error handling for database connection
        $errorInfo = $conn->errorInfo();
        if ($errorInfo[0] != '00000') {
            die("Connection failed: " . $errorInfo[2]);
         }


         if(isset($_POST['submit'])){
            $id = unique_id();
            $name = $_POST['name'];
            $name = htmlspecialchars($name);
        
            $email = $_POST['email'];
            $email = htmlspecialchars($email);
        
            $pass = $_POST['password'];
            $cpass = $_POST['cpassword'];
        
            if(strlen($pass) < 8){
                $warning[] = 'Password must be at least 8 characters long';
            } elseif($pass != $cpass){
                $warning[] = 'Passwords do not match';
            } else {
                $image = $_FILES['image']['name'];
                $image = htmlspecialchars($image);
                $ext = pathinfo($image, PATHINFO_EXTENSION);
                $rename = unique_id().'.'.$ext;
                $image_size = $_FILES['image']['size'];
                $image_tmp_name = $_FILES['image']['tmp_name'];
                $image_folder = '../uploaded_img/'.$rename;
        
                $select_seller = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
                $select_seller->execute([$email]);
        
                if ($select_seller->rowCount() > 0){
                    $warning[] = 'Email already taken';
                    
                } elseif($image_size > 2000000){
                    $error[] = 'Image size is too large';
                } else {
                    // No need for password hashing here, you can use the plain password
                    $insert_seller = $conn->prepare("INSERT INTO `users`(id, user_name, email, password, image) VALUES(?,?,?,?,?)");
                    $insert_seller->execute([$id, $name, $email, $pass, $rename]);
        
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $success[] = 'User registered successfully! Please Login now';
                }
            }
        }
        

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - User Registration Page</title>

    <!-- CSS file link for user style forms-->
    <link rel="stylesheet" href="../css/user_style.css" type="text/css">

    <!--CSS footer file link-->
    <link rel="stylesheet" href="../css/footer.css" type="text/css">

     <!--Font Awesome CDN Link-->
     <link rel="stylesheet" href="../web_components/font-awesome-4.7.0/css/font-awesome.min.css">
    
  
    

    <style>


        .icon {
              display: flex;
              align-items: center;
          }
  
        .icon i {
              margin-right: 8px;
              margin-top: -3px;
          }

          span.required-star {
            color: red;
            margin-left: 3px;
        }

        .form-cont:hover{
            
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
        }


  


    </style>
    
</head>
<body style="overflow-y: auto;">

<div class="container">
    <div class="detail">
        <h1>
            <span>Become</span>
            <span>a</span>
            <span>member</span>
            <span>of</span>
            <span>Fashion</span>
            <span>MK</span>
            <span>Store</span>
            <span>and</span>
            <span>get</span>
            <span>exclusive</span>
            <span>offers!</span>
        </h1>

    </div>



    <div class="form-cont">
        <form action="" method="post" enctype="multipart/form-data" class="registration-form">
            <h2 class="icon"><i class="material-symbols-outlined">group</i>Become Member</h2>
          
            <div class="flex">
                <div class="col">
                    <div class="input-fields">
                        <p>Full Name <span>*</span></p>
                        <input type="text" name="name" placeholder="Enter your name" maxlength="50" required class="box">
                    </div>
                    <div class="input-fields">
                        <p>Email <span>*</span></p>
                        <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box">    
                    </div>
                </div>
                <div class="col">
                    <div class="input-fields">  
                        <p>Password <span>*</span></p>
                        <input type="password" name="password" placeholder="Enter your password" maxlength="20" required class="box">
                    </div>
                    <div class="input-fields">
                        <p>Confirm Password <span>*</span></p>
                        <input type="password" name="cpassword" placeholder="Confirm your password" maxlength="20" required class="box">   
                    </div>
                </div>
            </div>
            <div class="input-fields">
                <p>Profile<span>*</span></p>
                        
                    <input type="file" id="file-input" name="image" class="box" required >
        
            </div>
            <p class="account">Already have an account? <a href="user_login.php">Login Now</a></p>
            <input type="submit" name="submit" value="Register Now" class="btn">

            <p style="text-align: right; margin-top: 10px;"><span class="required-star">*</span> Required fields</p>

        </form>
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
