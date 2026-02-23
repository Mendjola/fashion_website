
<!-- PHP CODE -->
<?php 

    include "../Assets/config.php";
    
    session_start();

    if(isset($_SESSION['user_id'])){

        $user_id = $_SESSION['user_id'];

    } else {
        
        $user_id = '';
    }   


// Function to set a cookie
function setCookieValue($name, $value, $expiry = 0) {
    setcookie($name, $value, $expiry, "/");
}

// Function to check if the user has accepted cookies
function hasAcceptedCookies() {
    return (
        isset($_COOKIE['analyticsAccepted']) && 
        isset($_COOKIE['preferencesAccepted']) && 
        isset($_COOKIE['marketingAccepted'])
    );
}

// Show cookie consent banner if the user hasn't accepted cookies
function showCookieConsent() {
    if (!hasAcceptedCookies()) {
        // Output the cookie consent banner HTML
        echo '
        <!-- Cookie consent banner -->
        <div class="cookie-consent" id="cookieConsent">
            <div class="cookie-message">
                <p> <span class="material-symbols-outlined">cookie</span>MK Store uses cookies to ensure you get the best experience on our website.</p>
            </div>
            <div class="cookie-buttons">
                <button onclick="acceptAllCookies()">Accept All</button>
                <button onclick="rejectAllCookies()">Reject All</button>
                <button onclick="showSettingsPanel()">Customize Cookies</button>
            </div>
            <button class="close-button" onclick="hideCookieBanner()"><span class="material-symbols-outlined">cancel</span></button>
        </div>
        ';
    }
}

showCookieConsent();

?>

<!-- HTML CODE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>MK Store - Home Page</title>

    <!--Icon in the title bar-->
    <link rel="shortcut icon" href="Images/fashion.ico" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!--FONT FILES LINK-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <!--CSS FILE LINK-->
    <link rel="stylesheet" href="../css/main.css">
 
    <!--JSS FILE LINK-->
    <script src="../js/script.js" defer></script>

    <!--Script link for implementing the swiper-->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!--J Query CDN Link-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Sweet Alert Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!--Script link for implementing the swiper-->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.swiper_slide');
    const totalSlides = slides.length;
    const slidesToShow = 4; // Number of slides to show at once
    let currentSlide = 0;

    function showSlides() {
        // Calculate the starting index and ending index for visible slides
        let startIndex = currentSlide;
        let endIndex = Math.min(currentSlide + slidesToShow, totalSlides);

        // If there are not enough slides to show at the end, adjust the starting index
        if (endIndex - startIndex < slidesToShow) {
            startIndex = totalSlides - slidesToShow;
            endIndex = totalSlides;
        }

        // Display visible slides and hide others
        slides.forEach((slide, index) => {
            if (index >= startIndex && index < endIndex) {
                slide.style.display = 'block';
            } else {
                slide.style.display = 'none';
            }
        });
    }

    function moveSlide(step) {
        currentSlide += step;

        // Loop back if at the end or start
        if (currentSlide >= totalSlides - slidesToShow + 1) {
            currentSlide = 0;
        } else if (currentSlide < 0) {
            currentSlide = totalSlides - slidesToShow;
        }

        showSlides();
    }

    function autoSlide() {
        moveSlide(1);
    }

    // Set initial slide position
    showSlides();

    // Change slide every 3 seconds
    setInterval(autoSlide, 3000);

    // Get the buttons
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');

    // Add event listeners to the buttons
    prevButton.addEventListener('click', () => {
        moveSlide(-1); // Move to the previous slide
    });

    nextButton.addEventListener('click', () => {
        moveSlide(1); // Move to the next slide
    });
});


</script>


<style>
       
    
        .swiper_next_btn{

            background-color: rgba(255, 255, 255, 0.5);

        }


        .swiper_next_btn:hover{

            background-color: rgba(255, 255, 255, 0.8);

        }


        .swiper_previous_btn {
            background-color: rgba(255, 255, 255, 0.5);

        }



        .swiper_previous_btn:hover{

            background-color: rgba(255, 255, 255, 0.8);

        }



        #visitInfoTextBox {

            position: absolute;
            bottom: -20px; 
            left: 1100px;
            width: 400px;
            height: auto;
            padding: 10px;
            margin-top: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            font-size: 14px;

        }

        #visitInfoTextBox:hover{

            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.8);


        }

        .fa-eye{

            cursor: pointer; 
        }

        .fa-eye:hover {
            color: #e1c5c0;
        }

        .seller_slider {
            max-width: 1200px;
            max-height: 650px;
            padding-bottom: 100px; 
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            display: flex;
            justify-content: space-between;
        }

        .best_selling .seller_slider .swiper_slide {
            width: calc(25% - 20px);
            padding: 10px;
            box-sizing: border-box;
            display: flex; 
            flex-direction: column; 
        }

        .best_selling .seller_slider .swiper_slide .image {
            width: 100%;
            height: 70%; 
        }

        .best_selling .seller_slider .swiper_slide .rating {
            width: 100%;
            height: 30%; 
            padding-top: 10px; 
        }



</style>


</head>

<body>

    <!-- message link -->
    <?php include '../Assets/message.php'; ?>

    <!-- custom js file link  -->
    <script src="../js/user_script.js"></script>
    
    
    <!-- snow effect -->
    <div class="snow_wrap">
        <div class="snow"></div>
    </div> 


    <script>

        document.addEventListener("DOMContentLoaded", function() {
            var snow = document.querySelector(".snow");
            setTimeout(function() {
                snow.style.opacity = "0"; // Set opacity to 0 for fading effect
                setTimeout(function() {
                    snow.remove(); 
                }, 1000); 
            }, 3000); 
        });

    </script>
    
    <div class="flowers">
        <img src="Images/flower.png" alt="">
        <img src="Images/flower.png" alt="">
        <img src="Images/flower.png" alt="">
        <img src="Images/flower.png" alt="">
        <img src="Images/flower.png" alt="">
        <img src="Images/flower.png" alt="">
        <img src="Images/flower.png" alt="">
        <img src="Images/flower.png" alt="">
        <img src="Images/flower.png" alt="">
        <img src="Images/flower.png" alt="">
     
     
       
    </div>
    
    
    <!-- loading screen -->
    <div id="screenloading">

        <img src="Images/MK.png" alt="MK Logo" id="loadinglogo">
        
    </div>

    

    <!-- Header -->
    <div class="header_box">


           <ul>
               <li class="lang_menu">
                 <a href="#">Languages ▾</a>
            
                <!-- Language Dropdown -->
                <ul class="dropdown">

                    <li><a href="#" class="us">USA</a></li>
                    <li><a href="#" class="fr">FR</a></li>
                    <li><a href="#" class="it">IT</a></li>
                    <li><a href="#" class="de">DE</a></li>
           
                </ul>
        
                </li>

            
            <li class="currency_menu">
                <a href="#">Currency ▾</a>
            
                <ul class="dropdown">

                    <li><a href="#" class="usd"><i class="fa fa-usd" aria-hidden="true"></i> USD</a></li>
                    <li><a href="#" class="gbp"><i class="fa fa-gbp" aria-hidden="true"></i> GBP</a></li>
                    <li><a href="#" class="eur"><i class="fa fa-eur" aria-hidden="true"></i> EUR</a></li>
                
                </ul>

            </li>
       
        </ul>
    
        <h5>Free shipping on all orders over $50 &nbsp; <i class="fa fa-truck" aria-hidden="true"></i></h5>

    </div>



    <div class="header_box_fixed">

    <!-- Header buttons -->
    <div class="subbox">
        

        <ol>

            <li><a href="index.php" id="homeLink">Home</a></li>
            <li><a href="contact.php" id="contactLink">Contact</a></li>
            <li><a href="store_information.php" id="orderLink">About</a></li>
            <li><a href="#contact" id="newsletterLink">Newsletter</a></li>

        </ol>  

        <div class="icon">

            <h2><font>MK</font>Store</h2>


            <a href="#"> <i class="fa fa-search" aria-hidden="true" id="searchBtn"></i></a> 

            <!--<button type ="submit" id="searchBtn"><i class="fa fa-search" aria-hidden="true"></i></button> -->

            <?php

                try {
                    $conn = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", $db_user_name, $db_user_password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Count favorites
                    $count_favorite_item = $conn->prepare("SELECT * FROM favorites WHERE user_id = ?");
                    $count_favorite_item->execute([$user_id]);
                    $total_favorite_item = $count_favorite_item->rowCount();

                    // Count cart items
                    $count_cart_item = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
                    $count_cart_item->execute([$user_id]);
                    $total_cart_item = $count_cart_item->rowCount();

                } catch (PDOException $e) {
                    // Handle database connection errors
                    echo "Error: " . $e->getMessage();
                }
                
             ?>

                <a href="../user/cart.php" id="basketBtn">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <sup><?= $total_cart_item; ?></sup>
                </a>

                <a href="../user/favorites.php" id="favoritesBtn">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <sup><?= $total_favorite_item; ?></sup>
                </a>

                <i class="fa fa-user" aria-hidden="true" id="userIcon"></i>




<div class="profile-container">

  <?php 
        $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
        if ($select_profile) {
            $select_profile->execute([$user_id]);
            if ($select_profile->rowCount() > 0) {
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
    ?>
                
                <div class="profile-info">
                        <img src="../uploaded_img/<?= $fetch_profile['image']; ?>" class="profile-image">
                        <h2 class="profile-name"><?= $fetch_profile['user_name']; ?></h2>
                 </div>
              
                <div class="flex-btn">
                    <a href="../user/profile.php" class="btn">View Profile</a>
                    <a href="../user/user_logout.php" class="btn" onclick="return confirm('Are you sure you want to logout?');">Logout</a>
                </div>
    <?php 
            } else {
    ?>  
                <h2>Please Login or Register</h2> 
                <div class="flex-btn">
                    <a href="../user/user_login.php" class="btn">Login</a>
                    <a href="../user/user_register.php" class="btn">Register</a>
                </div>
    <?php 
            }
        } else {
            echo "Error: Unable to prepare statement.";
        }
    ?>

</div>


            <div class="search_box">


                <input type="text" name="search_product" placeholder="search" maxlength="100" id="searchInput" >
                

            </div>

            <!-- Icon -->
            <i id="visitInfoIcon" class="fa fa-eye" aria-hidden="true" style = "margin-left: 10px;"></i>

            <!-- Text box -->
            <input type="text" id="visitInfoTextBox" readonly style="position: absolute; bottom: -30px; display: none;">



            

        </div>

            <button id="menubtn"><i class="fa fa-bars" aria-hidden="true"></i></button>


    </div>

</div>


<!-- JavaScript code for visit info -->
<script>

document.addEventListener("DOMContentLoaded", function() {
    
            // Gets the icon and text box elements
            var visitInfoIcon = document.getElementById("visitInfoIcon");
            var visitInfoTextBox = document.getElementById("visitInfoTextBox");


            visitInfoIcon.addEventListener("click", function() {

                // Toggles the display of the text box
                if (visitInfoTextBox.style.display === "none") {

                    // Shows the text box
                    visitInfoTextBox.style.display = "block";
                    
                    // Fetches the last visit time and visit count using AJAX
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "get_visit_info.php", true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            // Sets the response (last visit time and visit count) in the text box
                            visitInfoTextBox.value = xhr.responseText;
                        }
                    };
                    xhr.send();
                } else {

                    // Hides the text box
                    visitInfoTextBox.style.display = "none";
                }
            });
        });

</script>

<!-- JavaScript code for profile dropdown -->
<script>

    document.addEventListener("DOMContentLoaded", function() {
        // Get the user icon element
        var userIcon = document.getElementById("userIcon");
        // Get the profile container element
        var profileContainer = document.querySelector(".profile-container");

        // Add click event listener to the user icon
        userIcon.addEventListener("click", function() {
            // Toggle the display of the profile container
            if (profileContainer.style.display === "none") {
                profileContainer.style.display = "block";
            } else {
                profileContainer.style.display = "none";
            }
        });
    });
</script>


    <div class="background_cover">
 
        <img src="Images/Models_Background_Photo.jpeg" alt="">


        <div class="text">


            <h1>Get up to 50% off in limited products</h1>
            
            <h2>Summer Collection 2024</h2>

        
            <a class="button" href="winter_sales.php"><input type="submit" value="Last Chance Sales"></a>
        
            <a class="button" href="../user/user_register.php"><input type="submit" value="Become Member"></a>

            <a class="button" href="spring_collection.php"><input type="submit" value="Spring Season"></a>

        </div>

        

    </div>


    <!-- Menu button content -->

     <div id="menuContent" style="display: none;">

            <ul>
    
            <li><a href="women.php" class="icon-btn" id="womenbtn"><i class="material-icons">woman</i>WOMEN</a></li>
            <li><a href="men.php" class="icon-btn" id="menbtn"><i class="material-icons">man</i>MEN</a></li>
            <li><a href="girls.php" class="icon-btn" id="girlsbtn"><i class="material-symbols-outlined">girl</i>GIRLS</a></li>
            <li><a href="boys.php" class="icon-btn" id="boysbtn"><i class="material-symbols-outlined">boy</i>BOYS</a></li>
            <li><a href="babies.php" class="icon-btn" id="babiesbtn"><i class="material-symbols-outlined">pediatrics</i>BABIES</a></li>
            <li><a href="accessories.php" class="icon-btn" id="accessoriesbtn"><i class="material-symbols-outlined">watch</i>ACCESSORIES</a></li>
            
          </ul>
            
    </div>

    <script>
   

    document.addEventListener('DOMContentLoaded', function () {
        const searchBtn = document.getElementById("searchBtn");
        const searchBox = document.querySelector(".search_box");
        const menuBtn = document.getElementById("menubtn");
        const menuContent = document.getElementById("menuContent");

        searchBtn.addEventListener("click", function (event) {
            event.preventDefault();
            console.log("Search button clicked!");
            searchBox.style.display = searchBox.style.display === "none" ? "block" : "none";
        });

        menuBtn.addEventListener("click", function () {
            console.log("Menu button clicked!");
            menuContent.style.display = menuContent.style.display === "none" ? "block" : "none";
        });
    });

    

    </script>


    <section class="web_banner">

        <div class="box_container">

                <div class="box">

                    <a href="spring_collection.php">
                    <img src="Images/spring_collection.jpeg" alt="Spring Collection">
                    <div class="content">
    
                        <h3>Last Season - Spring Collection</h3>
    
                    </div>
                </div>

                <div class="box">

                    <a href="summer_collection.php">
                    <img src="Images/summer_collection.webp" alt="New Collection">
                    <div class="content">

                        <h3>New Collection - Summer Season 2024</h3>

                   </div>

                </div>

                <div class="box">


                    <a href="accessories.php">
                    <img src="Images/web_banner_3.avif" alt="A bag">

                    <div class="content">

                        <h3>Accesories</h3>

                    </div>

                    </a>

                </div>
                

        </div>



    </section>


    <section class="products" id=product>

        <h1 class="heading" style="color: black;">Recommended <span>Products</span></h1>

        <div class="box_container">

            <div class="box">
                <div class="image">

                    <img src="images/women/women_formal_gold_dress.jpeg" alt="">
                    <img src="images/women/women_formal_gold_dress_1b.jpeg" alt="" class="second_image">
        
                </div>

                <div class="content">

                    <h3>Gold dress</h3>
                    <div class="price">$149.99</div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>

                    </div>


                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>

                </div>

            </div>


            <div class="box">
                <div class="image">

                    <img src="images/women/wide_jeans_product2.jpeg" alt="">
                    <img src="images/women/wide_jeans_product2b.jpeg" alt="" class="second_image">
        
                </div>

                <div class="content">

                    <h3>Blue wide jeans</h3>
                    <div class="price">$34.99</div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-half" aria-hidden="true"></i>

                    </div>


                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>

                </div>

            </div>

            <div class="box">
                <div class="image">

                    <img src="images/women/black_jumpsuit_product_3.webp" alt="">
                    <img src="images/women/black_jumpsuit_product_3b.webp" alt="" class="second_image">
        
                </div>

                <div class="content">

                    <h3>Black formal jumpsuit</h3>
                    <div class="price">$25.99</div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>

                    </div>


                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>

                </div>

            </div>
            


            <div class="box">
                <div class="image">

                    <img src="images/women/blazer_product_4.webp" alt="">
                    <img src="images/women/blazer_product_4b.jpeg" alt="" class="second_image">
        
                </div>

                <div class="content">

                    <h3>White blazer</h3>
                    <div class="price">$39.99</div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        

                    </div>


                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>

                </div>

            </div>

            


            <div class="box">
                <div class="image">

                    <img src="images/men/men_shirt_buttons_3.webp" alt="">
                    <img src="images/men/Men_shirt_buttons_3b.webp" alt="" class="second_image">
        
                </div>

                <div class="content">

                    <h3>Green shirt with buttons</h3>
                    <div class="price">$22.99</div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>

                    </div>


                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>

                </div>

            </div>


            <div class="box">
                <div class="image">

                    <img src="images/men/Men_formal_2.webp" alt="">
                    <img src="images/men/Men_formal_2b.webp" alt="" class="second_image">
        
                </div>

                <div class="content">

                    <h3>Dark blue formal blazer</h3>
                    <div class="price">$49.99</div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-half" aria-hidden="true"></i>

                    </div>


                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>

                </div>

            </div>


            <div class="box">
                <div class="image">

                    <img src="images/men/men_blue_shirt_with_buttons.avif" alt="">
                    <img src="images/men/men_blue_shirt_with_buttons_b.avif" alt="" class="second_image">
        
                </div>

                <div class="content">

                    <h3>Blue Shirt with Buttons</h3>
                    <div class="price">$29.99</div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>

                    </div>


                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>

                </div>

            </div>


            <div class="box">
                <div class="image">

                    <img src="images/men/men_sweatshirt_1.webp" alt="">
                    <img src="images/men/men_sweatshirt_1b.webp" alt="" class="second_image">
        
                </div>

                <div class="content">

                    <h3>Black Sweatshirt</h3>
                    <div class="price">$25.99</div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>

                    </div>


                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>

                </div>

            </div>


         </div>

    
    </section>


<!--Best Selling Products-->

<section class="best_selling" id="bestselling">

    <h1 class="heading" style="color: black;">Best Sellers</h1>

    <div class="seller_slider" style ="margin-bottom: 50px;">

        <div class="swiper_wrapper">
            
        
            <!--Product 1-->

            <div class="swiper_slide">

                <div class="icons">

                    <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>

                </div>

                <div class="image">

                    <img src="images/women/women_black_formal_dress.jpeg" alt="">

                </div>

                <div class="content">

                    <h2>Black Formal Dress</h2>
                    <div class="price">

                        <div class="amount">$69,99</div>

                    </div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>

                    </div>
                </div>

            </div>

             <!--Product 2-->

            <div class="swiper_slide" style="display: none;"  >

                <div class="icons">

                    <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>

                </div>

                <div class="image">

                    <img src="images/women/women_white_formal_dress.jpeg" alt="">

                </div>

                <div class="content">

                    <h2>White Dress</h2>
                    <div class="price">

                        <div class="amount">$34.99</div>

                    </div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>

                    </div>
                </div>

            </div>

             <!--Product 3-->

            <div class="swiper_slide" style="display: none;">

                <div class="icons">

                    <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>

                </div>

                <div class="image">

                    <img src="images/women/women_cargo_black_jeans.jpeg" alt="">

                </div>

                <div class="content">

                    <h2>Black Cargo Jeans</h2>
                    <div class="price">

                        <div class="amount">$23.99</div>

                    </div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>

                    </div>
                </div>

            </div>

             <!--Product 4-->

            <div class="swiper_slide" style="display: none;">

                <div class="icons">

                    <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>

                </div>

                <div class="image">

                    <img src="images/women/black_midi_dress.webp" alt="">

                </div>

                <div class="content">

                    <h2>Black midi dress</h2>
                    <div class="price">

                        <div class="amount">$22.49</div>

                    </div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>

                    </div>
                </div>

            </div>

             <!--Product 5-->

            <div class="swiper_slide" style="display: none;">

                <div class="icons">

                    <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>

                </div>

                <div class="image">

                    <img src="images/women/women_jeans_4.jpeg" alt="">

                </div>

                <div class="content">

                    <h2>Blue Straight Jeans</h2>
                    <div class="price">

                        <div class="amount">$19,99</div>

                    </div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>

                    </div>
                </div>

            </div>

             <!--Product 6-->


            <div class="swiper_slide" style="display: none;">

                <div class="icons">

                    <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>

                </div>

                <div class="image">

                    <img src="images/women/women_blue_jumpsuit.jpeg" alt="">

                </div>

                <div class="content">

                    <h2>Blue Formal Jumpsuit</h2>
                    <div class="price">

                        <div class="amount">$38,99</div>

                    </div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>

                    </div>
                </div>

            </div>


                 <!--Product 7-->


                 <div class="swiper_slide" style="display: none;">

                <div class="icons">

                    <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>

                </div>

                <div class="image">

                    <img src="images/women/blue_spring_costume.webp" alt="">

                </div>

                <div class="content">

                    <h2>Blue Costume</h2>
                    <div class="price">

                        <div class="amount">$49,99</div>

                    </div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>

                    </div>
                </div>

                </div>

            
            <!--Product 8-->


            <div class="swiper_slide" style="display: none;">

                <div class="icons">

                    <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>

                </div>

                <div class="image">

                    <img src="images/women/classy_outfit_summer.jpeg" alt="">

                </div>

                <div class="content">

                    <h2>White Classy Outfit</h2>
                    <div class="price">

                        <div class="amount">$58,99</div>

                    </div>

                    <div class="rating">

                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>

                    </div>
                </div>

                </div>


             <!--Product 9-->


            <div class="swiper_slide" style="display: none;">

            <div class="icons">

                <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>

            </div>

            <div class="image">

                <img src="images/women/satin_spring_dress.webp" alt="">

            </div>

            <div class="content">

               <h2>Satin Spring Dress</h2>
                <div class="price">

                    <div class="amount">$28,99</div>

                </div>

                <div class="rating">

                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>

                </div>
            </div>

            </div>

        <!--Product 10-->


        <div class="swiper_slide" style="display: none;">

            <div class="icons">

                <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>

            </div>

            <div class="image">

               <img src="images/women/pink_outfit_summer.webp" alt="">

            </div>

            <div class="content">

                <h2>Pink Classy Outfit</h2>
                <div class="price">

                    <div class="amount">$49,99</div>

                </div>

                <div class="rating">

                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>

                </div>
            </div>

            </div>

     <!--Product 11-->


    <div class="swiper_slide" style="display: none;">

        <div class="icons">

            <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>

        </div>

        <div class="image">

            <img src="images/women/blue_spring_dress.webp" alt="">

        </div>

        <div class="content">

            <h2>Blue Spring Dress</h2>
            <div class="price">

                <div class="amount">$28,99</div>

            </div>

            <div class="rating">

                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>

            </div>
        </div>

        </div>

     <!--Product 12-->


    <div class="swiper_slide" style="display: none;">

        <div class="icons">

            <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>

        </div>

        <div class="image">

        <img src="images/women/satin_midi_dress_summer.jpeg" alt="">

        </div>

        <div class="content">

        <h2>Pink Satin Midi Dress</h2>
            <div class="price">

                <div class="amount">$49,99</div>

            </div>

            <div class="rating">

                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>

            </div>
        </div>

        </div>

     <!--Product 13-->


     <div class="swiper_slide" style="display: none;">

        <div class="icons">

            <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>

        </div>

        <div class="image">

            <img src="images/women/satin_dress_summer.png" alt="">

        </div>

        <div class="content">

        <h2>Satin Dress</h2>
            <div class="price">

                <div class="amount">$68,99</div>

            </div>

            <div class="rating">

                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>

            </div>
        </div>

        </div>

     <!--Product 14-->


    <div class="swiper_slide" style="display: none;">

        <div class="icons">

            <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>

        </div>

        <div class="image">

          <img src="images/women/blue_skirt_summer.jpeg" alt="">

        </div>

        <div class="content">

            <h2>Blue Skirt</h2>
            <div class="price">

                <div class="amount">$28,99</div>

            </div>

            <div class="rating">

                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>

            </div>
        </div>

        </div>
    </div>
        

    <div class="swiper_next_btn" onclick="moveSlide(1)">
        <a class="next">&#10095;</a> <!-- Next icon -->
    </div>

    <div class="swiper_previous_btn" onclick="moveSlide(-1)">
        <a class="prev">&#10094;</a> <!-- Previous icon -->
    </div>


    </div>
    
</section>



    <section class="delivery_info">

        <div class="box_container">

            <div class="delivery_icons">
                <div class="image">

                <img src="images/logos/shipping_icon.png" alt="shipping icon" class="front_img">
                <img src="images/logos/shipping_logo.png" alt="shipping logo" class="rear_img">
                 </div>

            </div>
        </div>

    </div>

        <div class="box_container">
            <div class="delivery_icons">
                
                <div class="image">

               <img src="images/logos/return_icon.png" alt="return icon" class="front_img">
               <img src="images/logos/return_logo.png" alt="return logo" class="rear_img">

               </div>

            </div>

        </div>
    
 
        <div class="box_container">
      
            <div class="delivery_icons">

               <div class="image">

                  <img src="images/logos/satisfaction_icon.png" alt="satisfaction icon" class="front_img">
                  <img src="images/logos/satisfaction_logo.png" alt="satisfaction logo" class="rear_img">
               </div>

            </div>

        
        </div>



        <div class="box_container">
      
            <div class="delivery_icons">

               <div class="image">

                  <img src="images/logos/money_back_icon.png" alt="money back icon" class="front_img">
                  <img src="images/logos/money_back_logo.png" alt="money back logo" class="rear_img">
               </div>

            </div>

        
        </div>
    

</section>




<!--Javascript for the footer-->
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

            // Redirect to subscription.html only if the checkbox is checked
            window.location.href = "subscription.html";
        }
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



<!--Footer Section -->

<footer id="contact">

    <div class="subscribe-section">
        <h2>Newsletter</h2>
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


</body>
</html>



<!-- Settings panel -->
<div class="settings-panel" id="settingsPanel">
    <div class="settings-panel-content">
        <h2>Cookie Customization Settings</h2>
        <div class="cookie-toggles">
            <div class="cookie-toggle">
                <input type="checkbox" id="analyticsToggle" checked>
                <label for="analyticsToggle">Analytics</label>
            </div>
            <div class="cookie-toggle">
                <input type="checkbox" id="preferencesToggle" checked>
                <label for="preferencesToggle">Preferences</label>
            </div>
            <div class="cookie-toggle">
                <input type="checkbox" id="marketingToggle" checked>
                <label for="marketingToggle">Marketing</label>
            </div>
            <div class="cookie-toggle">
                <input type="checkbox" id="personalizationToggle" checked>
                <label for="personalizationToggle">Personalization</label>
            </div>
            <div class="cookie-toggle">
                <input type="checkbox" id="socialMediaToggle" checked>
                <label for="socialMediaToggle">Social Media</label>
            </div>
            <div class="cookie-toggle">
                <input type="checkbox" id="targetingToggle" checked>
                <label for="targetingToggle">Targeting</label>
            </div>
        </div>
        <button class="save-settings-button" onclick="saveSettingsAndHidePanel()">Save Settings</button>
    </div>
</div>

<!-- JavaScript code for handling cookie consent -->
<script>
   // Function to set a cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Function to accept all cookies
function acceptAllCookies() {
    setCookie("analyticsAccepted", "true", 365); 
    setCookie("preferencesAccepted", "true", 365); 
    setCookie("marketingAccepted", "true", 365); 
    hideCookieBanner();
}

// Function to reject all cookies
function rejectAllCookies() {
    setCookie("analyticsAccepted", "false", -1); 
    setCookie("preferencesAccepted", "false", -1);
    setCookie("marketingAccepted", "false", -1); 
    hideCookieBanner();
}

// Function to show settings panel
function showSettingsPanel() {
    document.getElementById("settingsPanel").style.display = "flex";
}

// Function to save settings and hide settings panel
function saveSettingsAndHidePanel() {
    var analyticsAccepted = document.getElementById("analyticsToggle").checked;
    var preferencesAccepted = document.getElementById("preferencesToggle").checked;
    var marketingAccepted = document.getElementById("marketingToggle").checked;

    setCookie("analyticsAccepted", analyticsAccepted ? "true" : "false", 365);
    setCookie("preferencesAccepted", preferencesAccepted ? "true" : "false", 365);
    setCookie("marketingAccepted", marketingAccepted ? "true" : "false", 365);

    hideSettingsPanel();
}

// Function to hide settings panel
function hideSettingsPanel() {
    document.getElementById("settingsPanel").style.display = "none";
}

// Function to check if the user has accepted cookies
function hasAcceptedCookies() {
    return (
        document.cookie.indexOf("analyticsAccepted=true") !== -1 &&
        document.cookie.indexOf("preferencesAccepted=true") !== -1 &&
        document.cookie.indexOf("marketingAccepted=true") !== -1
    );
}

// Show cookie consent banner if the user hasn't accepted cookies
function showCookieConsent() {
    if (!hasAcceptedCookies()) {
        document.getElementById("cookieConsent").style.display = "block";
    }
}

// Hide the cookie consent banner
function hideCookieBanner() {
    document.getElementById("cookieConsent").style.display = "none";
}

// Show cookie consent banner when the page loads
document.addEventListener("DOMContentLoaded", showCookieConsent);

</script>





</body>
</html>