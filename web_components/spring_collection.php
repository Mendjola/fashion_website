

<?php

require_once "../Assets/config.php";

// Check if session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
if (isset($_SESSION['seller_id'])) {
    $seller_id = $_SESSION['seller_id']; // Retrieve seller_id from session
} else {
    header('location:../user/user_login.php');
    exit;
}
*/

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Spring Collection</title>

    <!--Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!--Bootstrap JS Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!--JQuery CDN Link-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!--Sakura Petals Animation-->
    <script src="../SakuraPetals_Animation/jquery-sakura.min.js"></script>
    <link href="../SakuraPetals_Animation/jquery-sakura.css" rel="stylesheet">

    <!--Link for the icons-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!--JQuery UI-->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!--CSS footer file link-->
    <link rel="stylesheet" href="../css/footer.css" type="text/css">

    <!--Font Awesome CDN Link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">


    
    <style>

    .body{
        
        background-color: #E8DED1;
    }

    @keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
    }




    .product-card{
        
      position: relative;
      overflow: hidden;
      border: 2px solid #ccc;
      border-radius: 6%;
      height: 25rem;
      transition: all 0.3s ease;
      width: calc(25% - 20px); 
      margin: 10px; 
      height: 25rem;
      margin: auto; 
      animation: fadeIn 0.5s ease;
      width: 18rem;
      margin-bottom: 25px;

     
    }

    .product-details {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      background: rgba(0, 0, 0, 0.7);
      color: #fff;
      padding: 10px;
      transition: all 0.3s ease;
    }

    .product-card:hover .product-details {
      bottom: -50px;
    }

    .product-card img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
            transition: all 0.3s ease;
            
    }

    .product-card:hover {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
     
    }
    
    
  
    .product-card:hover img {
      transform: scale(1.1);
    }

    .header {
            text-align: center;
            padding: 10px;
            width: 100%;
            margin-bottom: 40px;
            
        }

        .header h2 {
            color: white;
            background-color: black;
            font-size: 36px;
            margin: 0;
            padding: 10px;
            display: inline-block;
            width: 100%; 
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.5); 
        }

        .search-bar {

            height: 25px;
            width: 0;
            position: absolute;
            overflow: hidden;
            transition: background-color 0.3s ease; 
            transition: width 0.3s ease;
            right: calc(100% + 25px);
            
       }

        .search-bar-container {


            position: absolute;
            top: 80px;
            right: 100px;

         }


        .search-bar input[type="text"] {
            width: 200px;
            height: 25px;
            border-radius: 5px;
            
            transition: width 0.3s ease;
        }

        .search-bar input[type="text"]:focus {
            outline: none;
            border: 1px solid black; 
        }

        .search-bar input[type="text"]::placeholder {
            color: lightgray; 
        }

        .search-bar input[type="text"]:hover {
            background-color: #f9f9f9; /
        }

        
        .ui-menu-item-wrapper:hover {
            background-color: lightgray !important; /* important used to override the default style */
            color: black !important;
        }

        .ui-menu-item-wrapper {
            border: none !important;
        }

        .ui-autocomplete {
            border-color: white !important;
        }

        .search-icon {
            position: absolute;
            top: 0;
            right: 0;
            cursor: pointer;
            color: white;
        }
        
        .return-to-main {
                
                position: absolute;
                bottom: -3150px; 
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

    <!-- JQuery sakura plugin -->
    <script>

        $(function(){

        $('body').sakura();}); 


    </script>


    <div class="container mt-5">
        
        <!-- Search Bar -->
        <div class="search-bar-container">
            <div class="search-bar">
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">
            </div>
            <span class="search-icon material-symbols-outlined">search</span>
        </div>
    
      
        <div class="header">
          <h2>Spring Collection</h2>
       </div>


        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    
            <!-- Women's Section -->
            <div class="col-md-3">
                <div class="product-card">
                    <img src="Images/women/floral_offshoulder_spring_dress.webp" class="product-img" alt="Floral Dress">
                    <div class="product-details">
                        <h5 class="product-title">Floral Dress off-Shoulder</h5>
                        <p class="product-price">$39.99</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-card">
                    <img src="Images/women/blue_spring_dress.webp" class="product-img" alt="Blue Leaf Dress">
                    <div class="product-details">
                        <h5 class="product-title">Blue Leaf Dress</h5>
                        <p class="product-price">$29.99</p>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="product-card">
                    <img src="Images/women/white_spring_shirt.webp" class="product-img" alt="White Long-Sleeve Shirt">
                    <div class="product-details">
                        <h5 class="product-title">White Long-Sleeve Shirt</h5>
                        <p class="product-price">$25.99</p>
                    </div>
                </div>
            </div>
    

            <div class="col-md-3">
                <div class="product-card">
                    <img src="Images/women/blue_spring_costume.webp" class="product-img" alt="Blue Formal Costume">
                    <div class="product-details">
                        <h5 class="product-title">Blue Formal Costume</h5>
                        <p class="product-price">$89.99</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-card">
                    <img src="Images/women/white_off_shoulder_spring_dress.webp" class="product-img" alt="White Off-Shoulder Dres">
                    <div class="product-details">
                        <h5 class="product-title">White Off-Shoulder Dress</h5>
                        <p class="product-price">$29.99</p>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="product-card">
                    <img src="Images/women/satin_spring_dress.webp" class="product-img" alt="Blue Satin Dress">
                    <div class="product-details">
                        <h5 class="product-title">Blue Satin Dress</h5>
                        <p class="product-price">$49.99</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-card">
                    <img src="Images/women/leather_dress_spring.webp" class="product-img" alt="Black Leather Dress">
                    <div class="product-details">
                        <h5 class="product-title">Black Leather Dress</h5>
                        <p class="product-price">$59.99</p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-3">
                <div class="product-card">
                    <img src="Images/women/Jean_Jacket_Spring.webp" class="product-img" alt="Blue Jean Jacket">
                    <div class="product-details">
                        <h5 class="product-title">Blue Jean Jacket</h5>
                        <p class="product-price">$19.99</p>
                    </div>
                </div>
            </div>
    

            <!-- Men's Section -->
            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/men/Casual_shirt_spring.webp" class="product-img" alt="Casual White Shirt">
                    <div class="product-details">
                        <h5 class="product-title">Casual White Shirt</h5>
                        <p class="product-price">$29.99</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/men/Black_cargo_spring.jpeg" class="product-img" alt="Black Cargo Jeans">
                    <div class="product-details">
                        <h5 class="product-title">Black Cargo Jeans</h5>
                        <p class="product-price">$39.99</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/men/Black_jacket_spring.webp" class="product-img" alt="Black Jean Jacket">
                    <div class="product-details">
                        <h5 class="product-title">Black Jean Jacket</h5>
                        <p class="product-price">$25.99</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/men/shirt_buttons_spring.jpeg" class="product-img" alt="Blue Square Shirt">
                    <div class="product-details">
                        <h5 class="product-title">Blue Square Shirt</h5>
                        <p class="product-price">$19.99</p>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/men/Blazer_jacket_spring.webp" class="product-img" alt="Gray Formal Blazer">
                    <div class="product-details">
                        <h5 class="product-title">Gray Formal Blazer</h5>
                        <p class="product-price">$49.99</p>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/men/Skinny_spring_jeans.jpeg" class="product-img" alt="Gray Skinny Jeans">
                    <div class="product-details">
                        <h5 class="product-title">Gray Skinny Jeans</h5>
                        <p class="product-price">$25.99</p>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/men/green_jacket_spring.webp" class="product-img" alt="Sleeveless Green Jacket">
                    <div class="product-details">
                        <h5 class="product-title">Sleeveless Green Jacket</h5>
                        <p class="product-price">$22.99</p>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/men/Blue_shirt_spring.jpeg" class="product-img" alt="Blue Formal Shirt">
                    <div class="product-details">
                        <h5 class="product-title">Blue Formal Shirt</h5>
                        <p class="product-price">$35.99</p>
                    </div>
                </div>
            </div>

    
            <!-- Girls' Section -->
            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Girls/white_formal_overalls_spring.jpeg" class="product-img" alt="White Formal Overalls">
                    <div class="product-details">
                        <h5 class="product-title">White Formal Overalls</h5>
                        <p class="product-price">$39.99</p>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Girls/blue_jeans_spring.jpeg" class="product-img" alt="Blue Wide Leg Jeans">
                    <div class="product-details">
                        <h5 class="product-title">Blue Wide Leg Jeans</h5>
                        <p class="product-price">$25.99</p>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Girls/pink_overalls_spring.webp" class="product-img" alt="Pink Formal Overalls">
                    <div class="product-details">
                        <h5 class="product-title">Pink Formal Overalls</h5>
                        <p class="product-price">$49.99</p>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Girls/pink_cargo_jeans_spring.avif" class="product-img" alt="Pink Cargo Jeans">
                    <div class="product-details">
                        <h5 class="product-title">Pink Cargo Jeans</h5>
                        <p class="product-price">$29.99</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Girls/black_cargo_jeans.jpeg" class="product-img" alt="Black Cargo Jeans">
                    <div class="product-details">
                        <h5 class="product-title">Black Cargo Jeans</h5>
                        <p class="product-price">$22.99</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Girls/pink_formal_dress_spring.jpeg" class="product-img" alt="Pink Formal Dress">
                    <div class="product-details">
                        <h5 class="product-title">Pink Formal Dress</h5>
                        <p class="product-price">$59.99</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Girls/floral_blouse_spring.avif" class="product-img" alt="Floral Blouse">
                    <div class="product-details">
                        <h5 class="product-title">Floral Blouse</h5>
                        <p class="product-price">$19.99</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Girls/black_dress_spring.jpeg" class="product-img" alt="Black Dress">
                    <div class="product-details">
                        <h5 class="product-title">Black Dress</h5>
                        <p class="product-price">$39.99</p>
                    </div>
                </div>
            </div>
    
          
    
            <!-- Boys' Section -->
            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Boys/Blue_jean_jacket_spring.webp" class="product-img" alt="Blue Jean Jacket">
                    <div class="product-details">
                        <h5 class="product-title">Blue Jean Jacket</h5>
                        <p class="product-price">$25.99</p>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Boys/Square_shirt_spring.avif" class="product-img" alt="Square Shirt">
                    <div class="product-details">
                        <h5 class="product-title">Square Shirt</h5>
                        <p class="product-price">$29.99</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Boys/Baseball_jacket_spring.jpeg" class="product-img" alt="Baseball Jacket">
                    <div class="product-details">
                        <h5 class="product-title">Baseball Jacket</h5>
                        <p class="product-price">$49.99</p>
                    </div>
                </div>
            </div>
 

            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Boys/black_cargo_spring.webp" class="product-img" alt="Black Cargo Jeans">
                    <div class="product-details">
                        <h5 class="product-title">Black Cargo Jeans</h5>
                        <p class="product-price">$35.99</p>
                    </div>
                </div>
            </div>
 

            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Boys/Blue_denim_shirt_spring.jpeg" class="product-img" alt="Blue Denim Shirt">
                    <div class="product-details">
                        <h5 class="product-title">Blue Denim Shirt</h5>
                        <p class="product-price">$19.99</p>
                    </div>
                </div>
            </div>
 

            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Boys/Light_blue_jeans_spring.webp" class="product-img" alt="Blue Jeans">
                    <div class="product-details">
                        <h5 class="product-title">Blue Jeans</h5>
                        <p class="product-price">$22.99</p>
                    </div>
                </div>
            </div>
 

            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Boys/Blue_shirt_spring.jpeg" class="product-img" alt="Light Blue shirt">
                    <div class="product-details">
                        <h5 class="product-title">Light Blue Shirt</h5>
                        <p class="product-price">$29.99</p>
                    </div>
                </div>
            </div>
 

            <div class="col-md-3">
                <div class="product-card">
                    <img src="images/Boys/Black_formal_blazer_spring.webp" class="product-img" alt="Black Formal Blazer">
                    <div class="product-details">
                        <h5 class="product-title">Black Formal Blazer</h5>
                        <p class="product-price">$59.99</p>
                    </div>
                </div>
            </div>
 
 
 
    
        </div>
    </div>


    <script>

  $(document).ready(function() {


        $('.search-icon').on('click', function() {
        var searchBar = $(this).prev('.search-bar');
        searchBar.toggleClass('active');
        if (searchBar.hasClass('active')) {
            searchBar.css('width', '200px');
            $('#searchInput').val(''); 
            $('.product-card').show(); 
        } else {
            searchBar.css('width', '0');
        }
    });

        
        $('#searchInput').autocomplete({
        source: function(request, response) {
            var searchText = request.term.toLowerCase();
            var suggestions = [];
            $('.product-title').each(function() {
                var titleText = $(this).text().toLowerCase();
                if (titleText.includes(searchText)) {
                    suggestions.push($(this).text());
                    // Show the corresponding product card
                    $(this).closest('.product-card').show();
                } else {
                    // Hide the product card if it doesn't match the search text
                    $(this).closest('.product-card').hide();
                }
            });
            response(suggestions);
        },

        select: function(event, ui) {
            // Show only the selected product card
            var selectedTitle = ui.item.value;
            $('.product-title').each(function() {
                var titleText = $(this).text();
                if (titleText === selectedTitle) {
                    $(this).closest('.product-card').show();
                } else {
                    $(this).closest('.product-card').hide();
                }
            });
        }
        
    });

}); 

    </script>



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

<a href="index.php" class="return-to-main">MAIN PAGE</a>
    
    
</body>
</html>