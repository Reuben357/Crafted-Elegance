<?php
global $conn, $shop_products;
session_start();

include "config/connection.php";
//include " config/signup_logic.php";

//$user_data = checkLogin($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <!-- Css -->
  <link rel="stylesheet" href="/css/home_page.css">
  <!-- Box Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

  <!-- Glider cdn -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.css">
  

</head>
<body>

  <!-- Navbar -->
<?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/assets/php/"; include $IPATH."nav_bar.html"  ?>


  <!-- Home -->
  <section class="home" id="home">
    <!-- Home Content -->
    <div class="home-container container">
      <div class="home-text">
        <h1>Crafted Elegance</h1>
        <p>Explore timeless pieces made with passion and precision. We use only the finest materials,
            to create heirloom-quality bags, wallets, and accessories that elevate you're every day.</p>
        <!-- Home Button -->
        <a href="category_page.php" class="shop-btn">Shop Now</a>
      </div>
      <!-- Home Image -->
      <div class="home-img">
        <img src="/images/black_jacket.png" alt="" class="mySlides">

      </div>
    </div>
  </section>

  <!-- Featured -->
  <section class="featured" id="featured">
    <!-- Heading -->
    <div class="heading">
      <h2>Featured <span>Items</span></h2>
    </div>

<!--    Featured Products-->
    <div class="featured-container container">
      <div class="box">
        <img src="/images/brown_jacket.png" alt="">
        <div class="text">
          <h2>New Collection <br>Of Jackets</h2>
          <a href="#">View More</a>
        </div>
      </div>
  
         <div class="box">
          <div class="text">
            <h2>20% Discount <br>On Shoes</h2>
            <a href="#">View More</a>
          </div>
          <img src="/images/pngwing.com (19).png" alt="">
        </div>
    </div>

  </section>

  <!-- Shop -->
  <section class="shop" id="shop">
    <div class="heading">
      <h2><span>Shop</span> Now</h2>
    </div>

    <!-- Shop Content -->
    <div class="shop-container container">

        <?php include 'config/get_products.php'; ?>

        <?php while ($row= $shop_products->fetch_assoc()) { ?>
      <div class="box">
        <img src="/images/<?php echo $row['product_image']; ?>" alt="product_image">
        <h2> <?php echo $row['product_name']; ?></h2>
        <span><?php echo $row['product_price']; ?></span>
        <a href="<?php echo "product_page.php?product_id=". $row['product_id']; ?>"><i class="bx bxs-cart-alt"></i></a>
      </div>
      <?php } ?>
      
    </div>

  </section>

  <!-- New Arrivals -->
  <section class="new" id="new">
    <div class="heading">
      <h2><span>New</span> Arrivals</h2>
    </div>

    <!-- Shop Content -->
    <div class="shop-container container">
      <div class="box">
        <img src="/images/pngwing.com (11).png" alt="">
        <h2>North Men</h2>
        <span>80.99$</span>
        <a href="#"><i class="bx bxs-cart-alt"></i></a>
      </div>

      <div class="box">
        <img src="/images/pngwing.com (12).png" alt="">
        <h2>North Men</h2>
        <span>80.99$</span>
        <a href="#"><i class="bx bxs-cart-alt"></i></a>
      </div>

      <div class="box">
        <img src="/images/oxford_shoes.png" alt="">
        <h2>North Men</h2>
        <span>80.99$</span>
        <a href="#"><i class="bx bxs-cart-alt"></i></a>
      </div>
    </div>
  </section>



  <!-- Footer -->
<?php include $IPATH."footer.html" ?>

  <!-- Copyright -->
  <div class="copyright">
    <p>&#169; Rooben All Right Reserves. </p>
    <div class="to-top">
      <a href="#home"><i class='bx bxs-up-arrow-square'></i></a>
    </div>
  </div>
    


  <script src="/js/home_page.js"></script>

  <!-- Glider cdn -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.js"></script>
</body>
</html>
