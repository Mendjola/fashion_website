
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK Store - Season Sales</title>
    
    <!--Link for the icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!--CSS FILE LINK-->
    <link rel="stylesheet" href="../css/footer.css" type="text/css">

    <!--FONT FILES LINK-->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

    <!--JQuery link for the footer used for the arrow-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>


      body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #E8DED1;
            color: #333;
        }

        
        .heading {
            margin-top: 0;
            text-align: center;
            font-size: 28px;
            text-transform: uppercase;
            padding: 30px;
            font-weight: bolder;
            background: black;
            color: white;
            margin-bottom: 50px;
            height:60px;
            display: flex; 
            justify-content: center;
            align-items: center; 
            position: relative;
            z-index: 0;
           
        }


        .snowflake-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        

          /* Snowflake container */
          .snowflake {
            position: absolute;
            font-size: 18x;
            animation: snowflake-fall 10s linear infinite;
            animation-delay: calc(-1s * var(--animation-delay)); 

        }

        @keyframes snowflake-fall {
            0% {
                transform: translateY(-10vh);
            }

            100% {
                transform: translateY(110vh);
            }
        }

        /* Products In Sale*/

        .products {
            padding-top: 30px;
            
        }

        .products .box_container {
            display: grid;
            grid-template-columns: repeat(4, 250px);
            gap: 20px;
            justify-content: center;
            grid-row-gap: 50px;
            margin-bottom: 100px;
       
        }

        .products .box_container .box {
            background: white;
            border-radius: 15px;
            height: 100%;
            width: auto;
            position: relative;
            overflow: hidden;
            text-align: center;
            margin-left: 15px;
  
        }

        .products .box_container .box .image {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 350px;
        }

        .products .box_container .box .image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease-out;
        }

        .products .box_container .box .content {
            padding-top: 0;
            padding: 10px;
        }

        .products .box_container .box:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);

        }

        .products .box_container .box .content h3 {
            font-size: 12px;
            margin-bottom: 5px; 
        }

        .products .box_container .box .content .price {
            display: inline-block;
            color: #e1c5c0;
            font-size: 13px;
        }

        .products .box_container .box .content .price del {
            text-decoration: line-through;
            color: #aaa;
        }

        .products .box_container .box .content .rating {
            padding: 10px 0;
            font-size: 10px;
            color: #e1c5c0;
        }

        .products .box_container .box .content .availability {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .products .box_container .box .content .fa-shopping-basket,
        .products .box_container .box .content .fa-heart,
        .products .box_container .box .content .fa-eye {
            text-align: center;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 10px;
            cursor: pointer;
            background: none;
            font-size: 12px;
            color: #e1c5c0;
            border: 2px solid #e8ded1;
            margin: 0;
        }

        .products .box_container .box .content .fa-shopping-basket:hover,
        .products .box_container .box .content .fa-heart:hover,
        .products .box_container .box .content .fa-eye:hover {
            color: white;
            background: #e8ded1;
            transition: 0.3s ease-in-out;
        }


         /* Headers for Men's and Women's sections */
         .womens-section-heading {
            
             text-align: center;
             font-size: 24px;
             text-transform: uppercase;
             font-weight: bolder;
             background: whitesmoke;
             margin-top: 0;
             margin-bottom: 50px;
             padding: 15px;
             position: relative;
    

        }
        .products .box_container .box:hover .image img {
            opacity: 1;
        }

        .mens-section-heading{


             text-align: center;
             font-size: 24px;
             text-transform: uppercase;
             font-weight: bolder;
             background: whitesmoke;
             margin-top: 70px;
             margin-bottom: 50px;
             padding: 15px;
             position: relative;
             z-index: 2;

        }

        #searchContainer {
            position: relative;
        }
        #searchInput {
            display: none;
            border: none;
            outline: none;
            padding: 5px;
            width: 150px; 
            position: absolute;
            right: 220px;
            top: 50px;
            box-shadow : 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1;
        }
        #searchButton {
            border: none;
            background-color: transparent;
            cursor: pointer;
            position: absolute;
            right: 200px;
            top: 50px;
            display:flex;
            z-index: 1;
            cursor : pointer;
        }

        #searchButton:hover {
            transform: scale(1.2);
        }

        #searchButton i {
            font-size: 14px;
        }

        @media screen and (max-width: 768px) {

            #searchButton {
                right: 200px;
            }
        }


           @media screen and (min-width: 1200px) {
            #searchButton {
                right: 200px;
            }
        }

        .return-to-main {
                
                position: absolute;
                bottom: -2800px; 
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

  

    <div class="snowflake-container">
       

    </div>

    <h1 class="heading">Final Offers</h1>


    <div id="searchContainer">
        <input type="text" id="searchInput" placeholder="Search products...">
        <button id="searchButton" onclick="toggleSearch()">
            <i class="fas fa-search"></i> 
        </button>
    </div>

    <!--Women's Section-->
    <section class="products" id=product>

        <h2 class="womens-section-heading">Women's Section</h2>
      
        <div class="box_container">
            <div class="box">
                <div class="image">
                    <img src="images/women/black_dress_short.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Black Dress with Long Sleeves </h3>
                    <div class="price">
                        <span style="text-decoration: line-through; color: #aaa;">$49.99</span>
                        <br>
                        <span style="color: red;">40% OFF</span>
                        <br>
                        $29.99
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

            <div class="box">
                <div class="image">
                    <img src="images/women/women_white_jeans.webp" alt="">
                </div>
                <div class="content">
                    <h3>White Jeans</h3>
                    <div class="price">
                        <span style="text-decoration: line-through; color: #aaa;">$39.99</span>
                        <br>
                        <span style="color: red;">30% OFF</span>
                        <br>
                        $27.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-half" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>


            <div class="box">
                <div class="image">
                    <img src="images/women/women_cargo_black_jeans.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Black Cargo Jeans</h3>
                    <div class="price">
                        <span style="text-decoration: line-through; color: #aaa;">$39.99</span>
                        <br>
                        <span style="color: red;">40% OFF</span>
                        <br>
                        $23,99
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



            <div class="box">
                <div class="image">
                    <img src="images/women/white_shirt_buttons.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>White Shirt with Buttons</h3>
                    <div class="price">
                        <span style="text-decoration: line-through; color: #aaa;">$29.99</span>
                        <br>
                        <span style="color: red;">20% OFF</span>
                        <br>
                        $23.99
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

            <div class="box">
                <div class="image">
                    <img src="images/women/women_black_jeans.webp" alt="">
                </div>
                <div class="content">
                    <h3>Black Slim Fit Jeans</h3>
                    <div class="price">
                        <span style="text-decoration: line-through; color: #aaa;">$25.99</span>
                        <br>
                        <span style="color: red;">50% OFF</span>
                        <br>
                        $12.99
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


            <div class="box">
                <div class="image">
                    <img src="images/women/women_blue_jumpsuit.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Blue Formal Jumpsuit</h3>
                    <div class="price">
                        <span style="text-decoration: line-through; color: #aaa;">$64.99</span>
                        <br>
                        <span style="color: red;">40% OFF</span>
                        <br>
                        $38.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Limited Availability</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>


            <div class="box">
                <div class="image">
                    <img src="images/women/women_black_dress.webp" alt="">
                </div>
                <div class="content">
                    <h3>Black Short Dress</h3>
                    <div class="price">
                        <span style="text-decoration: line-through; color: #aaa;">$49.99</span>
                        <br>
                        <span style="color: red;">30% OFF</span>
                        <br>
                        $34.99
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


            <div class="box">
                <div class="image">
                    <img src="images/women/black_midi_dress.webp" alt="">
                </div>
                <div class="content">
                    <h3>Black Dress with Long Sleeves </h3>
                    <div class="price">
                        <span style="text-decoration: line-through; color: #aaa;">$29.99</span>
                        <br>
                        <span style="color: red;">25% OFF</span>
                        <br>
                        $22.49
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


            <div class="box">
                <div class="image">
                    <img src="images/women/Glitter_Dress_Product_5.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Party Dress with Glitter</h3>
                    <div class="price">
                        <span style="text-decoration: line-through; color: #aaa;">$49.99</span>
                        <br>
                        <span style="color: red;">50% OFF</span>
                        <br>
                        $24.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-half" aria-hidden="true"></i>
                    </div>
                    <div class="availability"> 5 Last Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>


            <div class="box">
                <div class="image">
                    <img src="images/women/women_blue_jumpsuit.webp" alt="">
                </div>
                <div class="content">
                    <h3>Blue Jumpsuit</h3>
                    <div class="price">
                        <span style="text-decoration: line-through; color: #aaa;">$29.99</span>
                        <br>
                        <span style="color: red;">50% OFF</span>
                        <br>
                        $14.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Out of Stock</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>


            <div class="box">
                <div class="image">
                    <img src="images/women/women_green_jumpsuit_formal.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Formal Green Jumpsuit</h3>
                    <div class="price">
                        <span style="text-decoration: line-through; color: #aaa;">$85,99</span>
                        <br>
                        <span style="color: red;">50% OFF</span>
                        <br>
                        $42.99
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


            <div class="box">
                <div class="image">
                    <img src="images/women/women_blue_jeans.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Blue Jeans</h3>
                    <div class="price">
                        <span style="text-decoration: line-through; color: #aaa;">$19.99</span>
                        <br>
                        <span style="color: red;">40% OFF</span>
                        <br>
                        $11.99
                    </div>
                    <div class="rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    </div>
                    <div class="availability">Last 3 Available</div>
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </div>
        </div>


        <!--Men's Section-->

        <h2 class="mens-section-heading">Men's Section</h2>

            <div class="box_container">
                <div class="box">
                    <div class="image">
                        <img src="images/men/men_hoodie.webp" alt="">
                    </div>
                    <div class="content">
                        <h3>Blue Hoodie</h3>
                        <div class="price">
                            <span style="text-decoration: line-through; color: #aaa;">$29.99</span>
                            <br>
                            <span style="color: red;">50% OFF</span>
                            <br>
                            $14.99
                        </div>
                        <div class="rating">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star-half" aria-hidden="true"></i>
                        </div>
                        <div class="availability">Available</div>
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </div>
                </div>

               
                    <div class="box">
                        <div class="image">
                            <img src="images/men/men_green_jacket.avif" alt="">
                        </div>
                        <div class="content">
                            <h3>Green Jacket</h3>
                            <div class="price">
                                <span style="text-decoration: line-through; color: #aaa;">$59.99</span>
                                <br>
                                <span style="color: red;">25% OFF</span>
                                <br>
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


                 
                        <div class="box">
                            <div class="image">
                                <img src="images/men/men_white_shirt_buttons.webp" alt="">
                            </div>
                            <div class="content">
                                <h3>White Shirt with Buttons</h3>
                                <div class="price">
                                    <span style="text-decoration: line-through; color: #aaa;">$29.99</span>
                                    <br>
                                    <span style="color: red;">20% OFF</span>
                                    <br>
                                    $23.99
                                </div>
                                <div class="rating">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                                <div class="availability">2 Last Available</div>
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </div>
                        </div>


                     
                            <div class="box">
                                <div class="image">
                                    <img src="images/men/men_blue_hoodie.jpeg" alt="">
                                </div>
                                <div class="content">
                                    <h3>Dark Blue hoodie</h3>
                                    <div class="price">
                                        <span style="text-decoration: line-through; color: #aaa;">$29.99</span>
                                        <br>
                                        <span style="color: red;">30% OFF</span>
                                        <br>
                                        $20.99
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

                            <div class="box">
                                <div class="image">
                                    <img src="images/men/men_blue_shirt_with_buttons.webp" alt="">
                                </div>
                                <div class="content">
                                    <h3>Blue shirt with Buttons</h3>
                                    <div class="price">
                                        <span style="text-decoration: line-through; color: #aaa;">$25.99</span>
                                        <br>
                                        <span style="color: red;">30% OFF</span>
                                        <br>
                                        $18.19
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

                            <div class="box">
                                <div class="image">
                                    <img src="images/men/Men_Loose_fit_hoodie.jpeg" alt="">
                                </div>
                                <div class="content">
                                    <h3>Beige Hoodie</h3>
                                    <div class="price">
                                        <span style="text-decoration: line-through; color: #aaa;">$19.99</span>
                                        <br>
                                        <span style="color: red;">30% OFF</span>
                                        <br>
                                        $13.99
                                    </div>
                                    <div class="rating">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <div class="availability"> 4 Last Available</div>
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </div>
                            </div>
                            
                            
                            <div class="box">
                                <div class="image">
                                    <img src="images/men/men_blue_jean.jpeg" alt="">
                                </div>
                                <div class="content">
                                    <h3>Blue Jeans Slim Fit</h3>
                                    <div class="price">
                                        <span style="text-decoration: line-through; color: #aaa;">$29.99</span>
                                        <br>
                                        <span style="color: red;">50% OFF</span>
                                        <br>
                                        $14.99
                                    </div>
                                    <div class="rating">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-half" aria-hidden="true"></i>
                                    </div>
                                    <div class="availability">Available</div>
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </div>
                            </div>


                            <div class="box">
                                <div class="image">
                                    <img src="images/men/Men_Jacket_blue.jpeg" alt="">
                                </div>
                                <div class="content">
                                    <h3>Dark Blue Jacket</h3>
                                    <div class="price">
                                        <span style="text-decoration: line-through; color: #aaa;">$39.99</span>
                                        <br>
                                        <span style="color: red;">50% OFF</span>
                                        <br>
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
             </div>

    </section>


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
            var products = document.getElementsByClassName("box");
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


        // JavaScript code to create snowflakes
        const snowflakeContainer = document.querySelector('.snowflake-container');

        for (let i = 0; i < 50; i++) {
            const snowflake = document.createElement('div');
            snowflake.classList.add('snowflake');
            snowflake.innerHTML = '❄️';
            snowflake.style.left = `${Math.random() * 100}vw`;
            snowflake.style.animationDuration = '10s';
            snowflake.style.animationDelay = `${Math.random()}s`;
            snowflakeContainer.appendChild(snowflake);
        }
   
    </script>


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
                <input type="email" id="email" name="email" placeholder="type email here..." required>
                <button type="button" onclick="subscribe()">Subscribe</button>
                <br>
                <input type="checkbox" id="termsCheckbox" required>
                <label for="termsCheckbox">I agree with the terms and conditions</label>
                <br>
                
            </form>
        </div>
    
        <div class="social-media-section">
            <p style="color: white; text-align: center;">Do you want to get informed first about new products or offers?</p>
            <p style="color: white; text-align: center;">Follow us on our social media accounts!</p>
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
    
        <p class="copyright-text" style ="text-align: center;">The content of this site is copyright-protected ©  and is the property of MK Store.</p>
    
    
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