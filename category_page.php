global$belt_products,$jacket_products; <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>

    <!-- Box Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- Categories css -->
    <link rel="stylesheet" href="/css/category_page.css">

</head>
<body>

<!--Navbar Link -->
<?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/assets/php/"; include $IPATH."nav_bar.html" ?>

<section class="category" id="category">

    <!-- Category Side nav -->
    <div class="category_sidenav">
        <div class="sidenav_categories">
            <h4 class="">Categories</h4>
            <div class="category_accessories">
                <ul>
                    <li><a href="#coats_jackets">Coats & Jackets</a></li>
                    <li><a href="#shoes">Shoes</a></li>
                    <li><a href="#belts">Belts</a></li>
                    <li><a href="#wallets">Wallets</a></li>
                </ul>
                <div class="border_bottom"></div>
            </div>
        </div>
    </div>

    <!-- Category Products -->
    <div class="category_products">

        <!-- Accessories -->
        <div class="heading">
            <h2 id="shoes">Shoes</h2>
        </div>

        <div class="accessories">
            <div onclick="window.location.href='product_page.php';" class="box">
                <img src="/images/pngwing.com%20(19).png" alt="">
                <h2>Men Brogue</h2>
                <h2>Oxfords New Spring</h2>
                <span>80.99$</span>
                <a><i class="bx bxs-cart-alt"></i></a>
            </div>


        </div>


        <!-- Belts -->
        <div class="heading">
            <h2 id="belts">Belts</h2>
        </div>

        <div class="accessories">

            <?php include 'config/get_belts.php';?>

            <?php  while ($row= $belt_products->fetch_assoc()) { ?>

                <div class="box">
                    <img src="/images/<?php echo $row['product_image'] ?>" alt="product_image">
                    <h2><?php echo $row['product_name'] ?></h2>
                    <span> <?php echo $row['product_price'] ?> </span>
                    <a href="<?php echo "product_page.php?product_id=". $row['product_id']; ?>">
                        <i class="bx bxs-cart-alt"></i></a>
                </div>

            <?php } ?>
        </div>

        <!-- Coats & Jackets -->
        <div class="heading">
            <h2 id="coats_jackets">Coats & Jackets</h2>
        </div>

        <div class="accessories">

            <?php include 'config/get_coats_jackets.php';?>

            <?php  while ($row= $jacket_products->fetch_assoc()) { ?>

                <div class="box">
                    <img src="/images/<?php echo $row['product_image'] ?>" alt="product_image">
                    <h2><?php echo $row['product_name'] ?></h2>
                    <span> <?php echo $row['product_price'] ?> </span>
                    <a href="<?php echo "product_page.php?product_id=". $row['product_id']; ?>">
                        <i class="bx bxs-cart-alt"></i></a>
                </div>

            <?php } ?>
        </div>

    </div>
</section>

<script src="/js/category.js"></script>
</body>
</html>
