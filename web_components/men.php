
<?php


// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
 }

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header('location: ../user/user_login.php');
    exit();
}


// Start output buffering
ob_start();

include 'header.php';

// PHP Form Submission
if (isset($_POST['name']) && isset($_POST['rating']) && isset($_POST['comment'])) {
    // Database connection details
    $db_host = "localhost";
    $db_port = "8889";
    $db_name = "fashionshop_db";
    $db_user_name = "root";
    $db_user_password = "root";

    try {
        // Create database connection
        $dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name";
        $conn = new PDO($dsn, $db_user_name, $db_user_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL statement to insert a new review
        $stmt = $conn->prepare("INSERT INTO reviews (name, rating, comment) VALUES (:name, :rating, :comment)");
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':rating', $_POST['rating']);
        $stmt->bindParam(':comment', $_POST['comment']);

        // Execute the query
        $stmt->execute();
        // Redirect back to the current page after successful submission
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Fetch existing reviews from the database
try {
    // Database connection details
    $db_host = "localhost";
    $db_port = "8889";
    $db_name = "fashionshop_db";
    $db_user_name = "root";
    $db_user_password = "root";

    // Create database connection
    $dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name";
    $conn = new PDO($dsn, $db_user_name, $db_user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch existing reviews from the database
    $stmt = $conn->query("SELECT * FROM reviews");
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// End output buffering and flush buffer
ob_end_flush();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Men Section</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />


    <style>

      body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #F2E7D9;
            color: #333;
        }

        .mens-section-heading {
            text-align: center;
            font-size: 29px;
            text-transform: uppercase;
            font-weight: bolder;
            margin-top: 100px;
            padding: 20px;
            position: relative;

       }

        .mens_products {
            padding-top: 30px;
  
        }

        .mens_products .product_container {
            display: grid;
            grid-template-columns: repeat(4, 250px);
            gap: 20px;
            justify-content: center;
            grid-row-gap: 20px;
        }

        .mens_products .product_container .product {
            background: white;
            border-radius: 10px;
            height: 100%;
            width: auto;
            position: relative;
            overflow: hidden;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-out;
            border: 3px solid white;
        }

        .mens_products .product_container .product:hover {
             transform: translateY(-5px);
         }

        .mens_products .product_container .product .image {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 350px;
            overflow: hidden;
            border-radius: 10px 10px 0 0;
        }

        .mens_products .product_container .product .image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease-out;
            border-radius: 10px 10px 0 0;
        }

        .mens_products .product_container .product .content {
            padding-top: 0;
            padding: 10px;
        }

        .mens_products .product_container .product .content h3 {
            font-size: 12px;
            margin-bottom: 5px;
            margin-top: 10px;
        }

        .mens_products .product_container .product .content .price {
            
            color: darkblue;
            font-size: 13px;
            margin-top: 10px;
        }

        .mens_products .product_container .product .content .price del {
            text-decoration: line-through;
            color: #aaa;
        }

        .mens_products .product_container .product .content .rating {
            padding: 10px 0;
            font-size: 10px;
            color: gold;
            margin-bottom: 10px;
        }

        .mens_products .product_container .product .content .availability {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .mens_products .product_container .product .content .fa-shopping-basket,
        .mens_products .product_container .product .content .fa-heart,
        .mens_products .product_container .product .content .fa-eye {
            text-align: center;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 10px;
            cursor: pointer;
            background: none;
            font-size: 12px;
            color: darkblue;
            border: 2px solid #e8ded1;
            margin: 0;
        }

        .mens_products .product_container .product .content .fa-shopping-basket:hover,
        .mens_products .product_container .product .content .fa-heart:hover,
        .mens_products .product_container .product .content .fa-eye:hover {
            color: white;
            background: #e8ded1;
            transition: 0.3s ease-in-out;
        }

        

        .review-form {
            max-width: 600px;
            margin: 200px auto 50px; 
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .review-form:hover{

            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            transform: translateY(-5px);
        }
        

        .review-form input[type="text"],
        .review-form input[type="email"],
        .review-form select,
        .review-form textarea,
        .review-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;

        }

        .review-form textarea {
            resize: vertical;
            height: 100px;
        }

        .review-form label {
            font-weight: bold;
            display: block;
            margin-bottom: 0; 
         }


        .review-form input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .review-form input[type="submit"]:hover {
            background-color: #0056b3;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .leave-review-heading,
        .previous-reviews-heading {
            text-align: center;
        }

        .leave-review-heading {
            
            margin-bottom: 20px;
        }

        .rating {
            display: inline-block;
            unicode-bidi: bidi-override;
            color: #ddd;
            font-size: 24px;
            height: 1em;
            width: auto;
        }
        .rating > span {
            display: inline-block;
            position: relative;
            width: 1em;
        }

        .rating > span:before {
            content: "\2605";
            position: absolute;
            left: 0;
            color: gold; 
        }
        
        
        .review-form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .existing-reviews {
            max-width: 600px;
            margin: 200px auto 50px; 
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .existing-reviews:hover{

            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);

        }
        .previous-reviews-heading {
            text-align: center;
            margin-bottom: 20px;
        }
        .review {
            margin-bottom: 20px;
        }
        .review p {
            margin: 5px 0;
        }


        .review-form-container,
        .existing-reviews-container {
            display: none;
            text-align: center;
        }
        .buttons-container {
            float: right;
            margin-top: 50px; 
            margin-right: 180px; 
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px; 
            width: 200px; 
            margin-bottom: 50px;
        }

        .buttons-container .button {
            display: block;
            margin-bottom: 10px;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .buttons-container .button:last-child {
            margin-bottom: 0;
        }

        .buttons-container .button i {
            margin-right: 5px;
        }

        .buttons-container .button.write-review .button.view-reviews {
            background-color: #007bff;
            color: white;
        }

        .buttons-container .button:hover {
            background-color: #0056b3;
            
        }

    </style>

</head>
<body style="overflow-y: auto;">


    <h1 class="mens-section-heading">Men's Clothes</h1>

    <!-- Men's Section -->
    <section class="mens_products" id="product">
 
        <div class="product_container">
            <div class="product">
                <div class="image">
                    <img src="images/men/Men_Beige_Hoodie.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Beige Hoodie</h3>
                    <div class="price">
                        $25.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>


            <div class="product">
                <div class="image">
                    <img src="images/men/Men_Black_Blazer.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Black Formal Blazer</h3>
                    <div class="price">
                       
                        $39.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>


            <div class="product">
                <div class="image">
                    <img src="images/men/Men_blue_hoodie.webp" alt="">
                </div>
                <div class="content">
                    <h3>Blue Hoodie</h3>
                    <div class="price">
                        $18.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-half" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Out of Stock</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>


            <div class="product">
                <div class="image">
                    <img src="images/men/men_white_shirt_with_buttons.avif" alt="">
                </div>
                <div class="content">
                    <h3>White Shirt with Buttons</h3>
                    <div class="price">
                        $29.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>

            <div class="product">
                <div class="image">
                    <img src="images/men/Men_Light_Gray_Cargo_Jeans.webp" alt="">
                </div>
                <div class="content">
                    <h3>Cargo Jeans</h3>
                    <div class="price">
                        $29.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Last 4 Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>

            <div class="product">
                <div class="image">
                    <img src="images/men/Men_Jacket_blue.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Dark Blue Jacket</h3>
                    <div class="price">
                        $19.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Out of Stock</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>


            <div class="product">
                <div class="image">
                    <img src="images/men/men_hoodie_2.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Blue Hoodie</h3>
                    <div class="price">
                        $24.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>

            <div class="product">
                <div class="image">
                    <img src="images/men/men_green_jacket.avif" alt="">
                </div>
                <div class="content">
                    <h3>Green Jacket</h3>
                    <div class="price">
                        $44.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-half" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Out of Stock</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>

        </div>

    </section>


    <div class="buttons-container">
        <button class="button write-review" id="show-review-form"><i class="fas fa-edit"></i> Write a Review</button>
        <button class="button view-reviews" id="show-existing-reviews"><i class="fas fa-eye"></i> View Reviews</button>
    </div>
    



 <!-- Review Form -->
 <div class="review-form-container">
 <div class="review-form">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h2 class="leave-review-heading">Leave a Review</h2>
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="rating">Rating:</label><br>
            <select id="rating" name="rating" required>
                <option value="5">5 Stars</option>
                <option value="4">4 Stars</option>
                <option value="3">3 Stars</option>
                <option value="2">2 Stars</option>
                <option value="1">1 Star</option>
            </select><br>
            <label for="comment">Review:</label><br>
            <textarea id="comment" name="comment" rows="4" cols="50" required></textarea><br><br>
            <input type="submit" value="Submit Review">
        </form>
    </div>
</div>



    
  <!-- Display Existing Reviews -->
  <div class="existing-reviews-container">
  <div class="existing-reviews">
        <h2 class="previous-reviews-heading">Previous Reviews</h2>

        <div class="review">
            <p><strong>Jane</strong> - Rating: <span class="rating"><span><i class="fas fa-star"></i></span><span><i class="fas fa-star"></i></span><span><i class="fas fa-star"></i></span><span><i class="fas fa-star"></i></span><span><i class="fas fa-star"></i></span></span></p>
            <p>This is a great product! I'm very satisfied with my purchase.</p>
        </div>
        <div class="review">
            <p><strong>John</strong> - Rating: <span class="rating"><span><i class="fas fa-star"></i></span><span><i class="fas fa-star"></i></span><span><i class="fas fa-star"></i></span><span><i class="fas fa-star"></i></span><span><i class="fas fa-star-half"></i></span></span></p>
            <p>Nice quality, but the size runs a bit small. Overall good purchase.</p>
        </div>

        <?php
        // Display existing reviews
        foreach ($reviews as $review) {
            echo "<div class='review'>";
            echo "<p><strong>{$review['name']}</strong> - Rating: ";
            $rating = intval($review['rating']);
            for ($i = 0; $i < $rating; $i++) {
                echo "<span class='rating'><i class='fas fa-star'></i></span>";
            }
            echo "</p>";
            echo "<p>{$review['comment']}</p>";
            echo "</div>";
        }
        ?>

    </div>

</div>
</div>


<script>
        document.addEventListener('DOMContentLoaded', function () {
            const showReviewFormBtn = document.getElementById('show-review-form');
            const showExistingReviewsBtn = document.getElementById('show-existing-reviews');
            const reviewFormContainer = document.querySelector('.review-form-container');
            const existingReviewsContainer = document.querySelector('.existing-reviews-container');

            // Show review form or hide it if already shown when "Write a Review" button is clicked
            showReviewFormBtn.addEventListener('click', function () {
                if (reviewFormContainer.style.display === 'block') {
                    reviewFormContainer.style.display = 'none';
                } else {
                    reviewFormContainer.style.display = 'block';
                    existingReviewsContainer.style.display = 'none'; // Hide existing reviews container
                }
            });

            // Show existing reviews or hide them if already shown when "View Reviews" button is clicked
            showExistingReviewsBtn.addEventListener('click', function () {
                if (existingReviewsContainer.style.display === 'block') {
                    existingReviewsContainer.style.display = 'none';
                } else {
                    existingReviewsContainer.style.display = 'block';
                    reviewFormContainer.style.display = 'none'; // Hide review form container
                }
            });
        });
    </script>


</body>




</html>