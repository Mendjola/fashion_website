<?php 

      session_start(); 

      if(isset($_SESSION['user_id'])){
          $user_id = $_SESSION['user_id'];
  
          error_reporting(error_reporting() & ~E_DEPRECATED);
          include "header.php";
          require_once "../Assets/config.php";
          
  
      } else {
          $user_id = '';
          header('location:user_login.php');
      }
      
    // Error handling for database connection
    if ($conn->errorCode() != '00000') {
        $errorInfo = $conn->errorInfo();
        die("Connection failed: " . $errorInfo[2]);
    }

    // Fetch user data
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
    $select_user->execute([$user_id]);
    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

    if (!$fetch_user) {
        die("User not found");
    }

    $prev_pass = $fetch_user['password'];
    $prev_image = $fetch_user['image'];

    if(isset($_POST['submit'])){

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        /* Update Name */
        if (!empty($name)) {
            $update_name = $conn->prepare("UPDATE `users` SET user_name = ? WHERE id = ?");
            $update_name->execute([$name, $user_id]);
            $success[] = 'Name updated successfully!';
        }

        /* Update Email */
        if (!empty($email)) {
            $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND id != ?");
            $select_email->execute([$email, $user_id]);

            if ($select_email->rowCount() > 0) {
                $warning[] = 'Email already exists!';
            } else {
                $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
                $update_email->execute([$email, $user_id]);
                $success[] = 'Email updated successfully!';
            }
        }

        /* Update Image */
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $ext = pathinfo($image, PATHINFO_EXTENSION);

        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/'.$rename;

        if (!empty($image)) {
            if ($image_size > 2000000) {
                $warning[] = 'Image size is too large!';
            } else {
                $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
                $update_image->execute([$rename, $user_id]);
                move_uploaded_file($image_tmp_name, $image_folder);

                if ($prev_image != '' && $prev_image != $rename) {
                    unlink('uploaded_img/'.$prev_image);
                }
                $success[] = 'Image updated successfully!';
            }
        }

        /* Update Password */
        $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';

        $old_pass = $_POST['old_pass'];
        $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);

        $new_pass = $_POST['new_pass'];
        $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);

        $cpass = $_POST['cpass'];
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

        if ($old_pass != $empty_pass) {
            if ($old_pass != $prev_pass) {
                $warning[] = 'Old password is incorrect!';
            } elseif ($new_pass != $cpass) {
                $warning[] = 'New password does not match!';
            } else {
                if ($new_pass != $empty_pass) {
                    $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
                    $update_pass->execute([$cpass, $user_id]);
                    $success[] = 'Password updated successfully!';
                } else {
                    $warning[] = 'Please enter a new password!';
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store-Update Profile Page</title>
    <link rel="stylesheet" href="../css/user_style.css" type="text/css">
    <link rel="stylesheet" href="../css/footer.css" type="text/css">
    
</head>
<body style="overflow-y: auto;">

<div class="container">

    <section class="form-cont">

        <form action="" method="post" enctype="multipart/form-data" class="register">
            <div class="img-box">
                <img src="uploaded_img/<?= $fetch_user['image']; ?>" >
            </div>

            <h2>Update Profile</h2>

            <div class="flex">
                <div class="col">
                    <div class="input-fields">
                        <p>Your name<span>*</span></p>
                        <input type="text" name="name" value="<?= $fetch_user['user_name']; ?>" class="box">
                    </div>

                    <div class="input-fields">
                        <p>Your Email<span>*</span></p>
                        <input type="email" name="email" value="<?= $fetch_user['email']; ?>" class="box">
                    </div>

                    <div class="input-fields">
                        <p>Select Image<span>*</span></p>
                        <input type="file" name="image" accept="image/*" class="box">
                    </div>
                </div>

                <div class="col">
                    <div class="input-fields">
                        <p>Old Password<span>*</span></p>
                        <input type="password" name="old_pass" placeholder="Enter your old password" class="box">
                    </div>

                    <div class="input-fields">
                        <p>New Password<span>*</span></p>
                        <input type="password" name="new_pass" placeholder="Enter your new password" class="box">
                    </div>

                    <div class="input-fields">
                        <p>Confirm Password<span>*</span></p>
                        <input type="password" name="cpass" placeholder="Confirm your password" class="box">
                    </div>
                </div>
            </div>

            <input type="submit" name="submit" value="Update" class="btn">
        </form>
    </section>
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

