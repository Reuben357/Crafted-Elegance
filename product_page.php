<?php
global $conn;
include 'config/connection.php';

if (isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);

    $stmt->execute();
    $product = $stmt->get_result();

}else{
    header('location: home_page.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>

    <!--Css link  -->
    <link rel="stylesheet" href="/css/product_page.css">
    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Box Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

</head>
<body>

<?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/assets/php/"; include $IPATH."nav_bar.html" ?>

  
     <section class="product">
      <div class="product-container">
      <?php while($row = $product->fetch_assoc()){ ?>
     <!-- Product Image -->
     <div class="product-image">
         <img id="product-img" src="/images/<?php echo $row['product_image'] ?>" alt="product_image">
    

         <!-- Similar products -->
         <div class="similar-products">
          <img class="thumbnail active" src="./images/baseball_leather_jacket.png" alt="">
          <img class="thumbnail" src="./images/black_jacket.png" alt="">
          <img class="thumbnail" src="./images/black_men_leather_jacket.png" alt="">
          <img class="thumbnail" src="./images/black_trench_coat.png" alt="">
         </div>

     </div>

     <!-- Right side -->
     <div class="product-info">
      <h3 class="product_name"> <?php echo $row['product_name'] ?> </h3>
      <h5 class="product_price"> <?php echo $row['product_price'] ?> </h5>
      <p class="product_desc"> <?php echo $row['product_description'] ?> </p>

      <form method="POST" action="cart_page.php">
        <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
        <input type="hidden" name="product_image" value="<?php echo $row['product_image'] ?>">
        <input type="hidden" name="product_name" value="<?php echo $row['product_name'] ?>">
        <input type="hidden" name="product_price" value="<?php echo $row['product_price'] ?>">

        <div class="product-quantity">
          <input type="number" name="product_quantity" value="1" min="1"> Quantity
        </div>

        <div class = "btn-groups">
          <button type = "submit"  name="add_to_cart"
                  class = "add-cart-btn"> <i class = "fas fa-shopping-cart"></i>add to cart</button>
          <button type = "button" class = "buy-now-btn"><i class = "fas fa-wallet"></i>buy now</button>
          </div>
      </form>
     </div>
  
      <?php } ?>
     </div>
     </section>

    <!-- products page js -->
    <script src="/js/product_page.js"></script>
    
    <!-- Bootstrap js cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</body>
</html>

