
<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the database configuration file
include_once "../Assets/config.php";

// Check if seller_id is set in the session
if (isset($_SESSION['seller_id'])) {
    $seller_id = $_SESSION['seller_id']; // Retrieve seller_id from session

    // Retrieve seller profile information
    $select_profile = $conn->prepare("SELECT * FROM `seller` WHERE id = ?");
    $select_profile->execute([$seller_id]);

    if ($select_profile->rowCount() > 0) {
        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        $seller_name = $fetch_profile['seller_name']; // Retrieve seller name
    }
}
?>


<header>

     <div class="logo">

        <img src="../web_components/Images/MK.png" width="100">

     </div>

   
    <div class="right">
        <div id="user-btn"><i class="bi bi-person-circle"></i></div> 
        <div class="toggle-btn"><i class="bi bi-list"></i></div> 
    </div> 
    

    <div class="profile-info-container">

    <div class="profile-info">
       
            <img src="../uploaded_img/<?= $fetch_profile['image']; ?>" alt="" class="logo" width="100">
            <p><?= $fetch_profile['seller_name']; ?></p>
        

        <div class="flex-btn">
            <a href="admin_profile.php" class="profile-btn">Profile</a>
            <form action="admin_logout.php" method="post" onsubmit="return confirm('Are you sure you want to logout?');">
                <input type="hidden" name="logout" value="1">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
    </div>

</header>



<div class="side-bar-container">

    <div class="side-bar">

        <div class="profile">
            <img src="../uploaded_img/<?= $fetch_profile['image']; ?>"  class="logo-img" width="100">
            <p><?= $fetch_profile['seller_name']; ?></p>
        </div>

        <h4>Menu</h4>

        <div class="navbar" style ="margin-top: 0px;">
            <ul>
                <li><a href="dashboard.php"><i class="bi bi-house-fill"></i>Dashboard</a></li>
                <li><a href="add_product.php"><i class="bi bi-bag-fill"></i>Add Products</a></li>
                <li><a href="view_product.php"><i class="bi bi-list"></i>View Products</a></li>
                <li><a href="user_information.php"><i class="bi bi-person-circle"></i></i>User Accounts</a></li>
                <li><a href="admin_logout.php" onclick="return confirm('Logout from the website');"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
            </ul>
        </div>

        <h4>Find US</h4>

        <div class="social-links" style ="margin-bottom: 150px; margin-top: 15px;">
        <i class="bi bi-facebook"></i>
        <i class="bi bi-twitter"></i>
        <i class="bi bi-linkedin"></i>
        <i class="bi bi-whatsapp"></i>
        <i class="bi bi-youtube"></i>
        </div>
    </div>

</div>







