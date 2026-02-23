<?php 
        include "header.php";
        require_once "../Assets/config.php";
    

        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
        } else {
            $user_id = '';
            header ('location:user_login.php');
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
    <title>MK Store - User order Page</title>
    <link rel="stylesheet" href="../css/user_style.css" type="text/css">
    <link rel="stylesheet" href="../css/footer.css" type="text/css">

    <link rel="stylesheet" href="../web_components/font-awesome-4.7.0/css/font-awesome.min.css">


    <style>

    .box {
        width: 250px; 
        height: 400px;
        padding: 20px; 
        margin: 20px;
        border: 1px solid #ccc;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
    }

    .image {
        max-width: 100%;
        max-height: 100%;
        margin-bottom: 10px;
    }

    .content {
        text-align: center; 
    }

    .name {
        font-size: 18px; 
        margin-bottom: 5px;
        color:black;
        font-weight: bold; 
    }

    .price {
        font-size: 16px; 
        margin-bottom: 5px;
        color:black;
    }

    .date {
        font-style: italic;
        color: #888;
    }



    </style>

    
</head>
<body style="overflow-y: auto;">



<div class="orders">

  <div class="heading">

    <h1>Order History</h1>

  </div>

  <div class="box-container">

  <?php 

$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY dates DESC");

$select_orders->execute([$user_id]);

if($select_orders->rowCount() > 0){
    
    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
    
        $product_id = $fetch_orders['product_id'];

        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $select_products->execute([$product_id]);

        $product_status = '';
        if ($select_products->rowCount() > 0){

            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

                // Check if 'product_status' key exists in $fetch_orders
                $product_status = isset($fetch_orders['product_status']) ? $fetch_orders['product_status'] : '';

    ?>

    <div class="box" <?php if($product_status == 'canceled') {echo 'style="border: 1px solid red"';} ?>>

        <a href="order_information.php?get_id=<?= $fetch_orders['id']; ?>">
        <img src="../web_components/Images/women/<?= $fetch_products['image']; ?>" class="image">
        <p class="date"><i class="fa fa-calendar" aria-hidden="true" style="margin-left: 5px;"></i> <?= $fetch_orders['dates']; ?></p>

        <div class="content">

         <div class="row">

            <h2 class="name"><?= $fetch_products['name']; ?></h2>
            <p class="price">Price: $<?= $fetch_products['price']; ?></p>
            <p class="status" style="color: <?php if($product_status == 'delivered') {echo 'green';} elseif($product_status == 'canceled') {echo 'red';} else {echo 'orange';} ?>"><?= $product_status; ?></p>
            
         </div>

        </div>

        </a>

    </div>

    <?php 
               }
        }
    }
} else {
    echo '<p class="empty">No Orders Yet!</p>';
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

