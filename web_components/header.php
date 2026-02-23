<?php 

    //ob_start(); // Start output buffering
    include "../Assets/config.php";
    

    if(isset($_SESSION['user_id'])){

        $user_id = $_SESSION['user_id'];

    } else {
        
        $user_id = '';
    }

       // Error handling for database connection
       if ($conn->errorCode() != '00000') {
        $errorInfo = $conn->errorInfo();
        die("Connection failed: " . $errorInfo[2]);
    }

      // Initialize the $id variable
      $id = '';

      if(isset($_SESSION['user_id'])){
          $id = $_SESSION['user_id'];
      }
  
?>

<!-- HTML CODE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--FONT FILES LINK-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

    <!--CSS FILE LINK-->
    <link rel="stylesheet" href="../css/main.css">
 
    <!--JSS FILE LINK-->
    <script src="../js/script.js" defer></script>

    <!--J Query CDN Link-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Sweet Alert Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>

        .search_box{

        display: none; 
        position: absolute;
        top:80%;
        right: 32px;
        left: 80%;
        width: 100px;
        width: 20%;
        }

        .search_box input{

        padding: 24px 32px;
        width: 100%;
        border-radius: 10px;
        border: 2px solid #E8DED1;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);


        }


    </style>

</head>

<body>


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
    
        <h5 style>Free shipping on all orders over $50 &nbsp; <i class="fa fa-truck" aria-hidden="true" ></i></h5>
    </div>


    <div class="header_box_fixed">
 

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
            $select_profile->execute([$id]);
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

<form action ="" method ="post">

 <input type="text" name="search_product" placeholder="search" maxlength="100" id="searchInput" >
 

</form>

</div>

        </div>

            <button id="menubtn"><i class="fa fa-bars" aria-hidden="true"></i></button>


    </div>

</div>


<div id="menuContent" style="display: none; z-index: 2;">

<ul>

<li><a href="women.php" class="icon-btn" id="womenbtn"><i class="material-icons">woman</i>WOMEN</a></li>
<li><a href="men.php" class="icon-btn" id="menbtn"><i class="material-icons">man</i>MEN</a></li>
<li><a href="girls.php" class="icon-btn" id="girlsbtn"><i class="material-symbols-outlined">girl</i>GIRLS</a></li>
<li><a href="boys.php" class="icon-btn" id="boysbtn"><i class="material-symbols-outlined">boy</i>BOYS</a></li>
<li><a href="babies.php" class="icon-btn" id="babiesbtn"><i class="material-symbols-outlined">pediatrics</i>BABIES</a></li>
<li><a href="accessories.php" class="icon-btn" id="accessoriesbtn"><i class="material-symbols-outlined">watch</i>ACCESSORIES</a></li>

</ul>

</div>


<!-- Search Functionality -->
<script>
        function toggleSearch() {
            var searchInput = document.getElementById("searchInput");
            if (searchInput.style.display === "none") {
                searchInput.style.display = "block";
                searchInput.focus(); 
            } else {
                searchInput.style.display = "none";
            }
        }

        // Live search functionality
        document.getElementById("searchInput").addEventListener("input", function() {
            var input = this.value.toLowerCase();
            var products = document.getElementsByClassName("product");
            for (var i = 0; i < products.length; i++) {
                var productName = products[i].querySelector("h3").innerText.toLowerCase();
                if (productName.includes(input)) {
                    products[i].style.display = "block";
                } else {
                    products[i].style.display = "none";
                }
            }
        });
    </script>


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


</body>
</html>


