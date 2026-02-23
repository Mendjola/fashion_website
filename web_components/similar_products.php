
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Similar Products</title>

        <!-- Include Owl Carousel CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

        <!-- Include jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Include Owl Carousel JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

        <style>
            .owl-carousel .owl-item {
                position: relative;
                height: 350px; 
            }

            .owl-carousel .owl-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: opacity 0.3s ease;
            }

            .owl-carousel .owl-item:hover img {
                    opacity: 0.8; 
                }


            .item-content {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                background-color: rgba(0, 0, 0, 0.6);
                color: white;
                padding: 10px;
                box-sizing: border-box;
                opacity: 0; 
                transition: opacity 0.3s ease;
            }

            .owl-carousel .owl-item:hover .item-content {
                opacity: 1; 
             }


            .stock {
                font-weight: bold;
                margin-bottom: 10px;
                display: block;
                text-align: center;
                padding: 5px;
                border-radius: 5px;
                font-size: 14px;
            }

            .name {
                margin: 0;
                font-size: 16px;
                margin-bottom: 10px;
                text-align: center; 
            }

            .button_container {
                margin-top: 10px;
                text-align: center;
                background-color: rgba(0, 0, 0, 0.1);
                box-shadow: 0 4px 6px rgba(255, 255, 255, 0.1), 0 1px 3px rgba(255, 255, 255, 0.08);
                padding: 10px; 
                border-radius: 8px; 
            }

            .button_container button, .button_container a   {
                color: pink;
                border: none;
                padding: 10px 20px;
                margin-right: 5px;
                background-color: transparent;
                font-size: 18px; 
            }


            .button_container a:hover i {
                 color: pink !important; 
             }


            .price {
                font-weight: bold;
                margin-bottom: 10px;
                font-size: 20px;
                text-align: center; 
    
            }

            .empty {
                font-style: italic;
            }

            
            .owl-prev, .owl-next {
                font-size: 30px;
                color: pink;
                padding: 10px;
                background-color: rgba(0, 0, 0, 0.6);
                border: none;
                cursor: pointer;
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            .owl-prev:hover, .owl-next:hover {
            
                color: pink !important;
                background-color: transparent !important;
                cursor: pointer;
            }

         </style>

</head>

<body>


<div class="products">
    <div class="owl-carousel owl-theme">
        <?php 
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE product_status = ? LIMIT 6");
        $select_products->execute(['active']);
        
        if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
        ?>
        <div class="item">
            <img src="Images/women/<?= $fetch_products['image']; ?>" class="image">
            <div class="item-content">
                <?php if ($fetch_products['stock'] > 9){ ?>
                    <span class="stock" style="color:green;">In Stock</span>
                <?php } elseif ($fetch_products ['stock'] == 0){ ?>
                    <span class="stock" style="color:red;">Out of Stock</span>
                <?php } else { ?>
                    <span class="stock" style="color:orange;">Only <?= $fetch_products['stock']; ?> left in stock</span>
                <?php } ?>

                <h2 class="name"><?= $fetch_products['name']; ?></h2>
                <p class="price">$<?= $fetch_products['price']; ?></p>

                <div class="button_container">
                    <button type="submit" name="add_to_cart"> <i class="fa fa-shopping-cart"></i></button>
                    <button type="submit" name="add_to_wishlist"> <i class="fa fa-heart"></i></button>
                    <a href="product_information.php?pid=<?= $fetch_products['id']; ?>"><i class="fa fa-eye" style="color: black; "></i></a>
                </div>
            
            </div>
        </div>
        <?php 
            }
        } else {
            echo '<p class="empty">No products added yet!</p>';
        }
        ?>
    </div>
</div>


<!-- Owl Carousel -->
<script>
      $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            autoplay:true, // Autoplay 
            autoplayTimeout:3000, // Autoplay interval set to 3 seconds
            autoplayHoverPause:true, // Pause autoplay on hover
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        });
    });
</script>

</body>
</html>