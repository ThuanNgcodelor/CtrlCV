<?php
session_start();
require_once 'config/dbconnect.php';
require_once 'client/productclass.php';
require_once 'classes/RegionClass.php';

$category = new productclass();
$product = new productclass();
$slider = new productclass();
$region = new RegionClass();

if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id = intval($_GET['id']);
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $result = $product->findProductsRange($conn, $id);
        $row = $result->fetch_assoc();
        if (isset($row['ProductID'])) {
            $_SESSION['cart'][$row['ProductID']] = array(
                "name" => $row['ProductName'],
                "quantity" => 1,
                "price" => $row['UnitPrice'],
                "image" => $row['image']
            );
        } else {
            $message = "This product id is invalid!";
        }
    }
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

        <!-- title -->
        <title>GYMSTORE</title>

        <!-- favicon -->
        <link rel="shortcut icon" type="image/png" href="assetss/img/logo5.png">
        <!-- google font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
        <!-- fontawesome -->
        <link rel="stylesheet" href="assetss/css/all.min.css">
        <!-- bootstrap -->
        <link rel="stylesheet" href="assetss/bootstrap/css/bootstrap.min.css">
        <!-- owl carousel -->
        <link rel="stylesheet" href="assetss/css/owl.carousel.css">
        <!-- magnific popup -->
        <link rel="stylesheet" href="assetss/css/magnific-popup.css">
        <!-- animate css -->
        <link rel="stylesheet" href="assetss/css/animate.css">
        <!-- mean menu css -->
        <link rel="stylesheet" href="assetss/css/meanmenu.min.css">
        <!-- main style -->
        <link rel="stylesheet" href="assetss/css/main.css">
        <!-- responsive -->
        <link rel="stylesheet" href="assetss/css/responsive.css">

    </head>
    <body>

        <!--PreLoader-->
        <div class="loader">
            <div class="loader-inner">
                <div class="circle"></div>
            </div>
        </div>
        <!--PreLoader Ends-->

        <!-- header -->
        <div class="top-header-area" id="sticker">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 text-center">
                        <div class="main-menu-wrap">
                            <!-- logo -->
                            <div class="site-logo">
                                <a href="index.php">
                                    <img style="width: 100px" src="assetss/img/logo5.png" alt=""/>

                                </a>
                            </div>
                            <!-- logo -->

                            <!-- menu start -->
                            <nav class="main-menu">
                                <ul>
                                    <li class="current-list-item"><a href="index.php">Home</a></li>
                                    <li><a href="client/contact.php">Contacts</a></li>
                                    <li ><a href="admin/login.php"> <?php
                                            if (isset($_SESSION["username"])) {
                                                echo $_SESSION["username"];
                                            } else {
                                                echo "Login";
                                            }
                                            ?></a></li>                         
                                    <li><a href="#">Category</a>
                                        <?php
                                        $result = $category->showALLbrand($conn);
                                        if (mysqli_num_rows($result) > 0) {
                                            ?>
                                            <ul class="sub-menu">
                                                <?php
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $categoryID = $row['brandID'];
                                                    ?>
                                                    <li><a href="client/brandcart.php?brandID=<?php echo $categoryID; ?>"><?php echo $row['brandName']; ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>

                                    </li>
                                    <li><a href="#">Products</a>
                                        <?php
                                        $result = $category->showAllcategory($conn);
                                        if (mysqli_num_rows($result) > 0) {
                                            ?>
                                            <ul class="sub-menu">
                                                <?php
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $categoryID = $row['categoryID'];
                                                    ?>
                                                    <li><a href="client/shopping_cart.php?categoryID=<?php echo $categoryID; ?>"><?php echo $row['categoryName']; ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>

                                    </li>
                                    <li><a href="client/news.php">News</a></li>

                                    <li>
                                        <div class="header-icons">
                                        <a class="" href="client/cart_details.php">
                                        <a class="shopping-cart" href="client/cart_details.php">
                                            <?php
                                                if (isset($_SESSION['cart'])) {
                                                    $total_quantity = 0;
                                                    $total_price = 0;
                                                    foreach ($_SESSION['cart'] as $x => $value) {
                                                        $total_quantity += intval($value["quantity"]);
                                                        $total_price += doubleval($value["price"]) * intval($value["quantity"]);
                                                    }
                                                    echo "<i class='fas fa-shopping-cart'></i>      " . $total_quantity;
                                                } else {
                                                    echo "<i class='fas fa-shopping-cart'></i>";
                                                }
                                            ?>
                                        </a>
   
                                            <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                            <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                            <div class="mobile-menu"></div>
                            <!-- menu end -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end header -->


        <!-- ảnh nền -->
        <div id="demo" class="carousel slide" data-ride="carousel">
            <div class="search-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>'</h3>
                            <h3>'</h3>
                            <h3>'</h3>

                            <span class="close-btn"><i class="fas fa-window-close"></i></span>
                            <div class="search-bar">
                                <form method="POST" action="client/sreach.php" class="search-bar-tablecell">
                                    <input type="text" name="keyword" placeholder="Search">
                                    <button type="submit">Search<i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>        
            </ul>

            <!-- The slideshow -->
            <?php
            $result = $slider->showslider($conn);
            if (mysqli_num_rows($result) > 0) {
                ?>
                <div class="carousel-inner">
                    <?php
                    $active = true;
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                            <img height="100%" src="<?php echo 'assetss/img/app/' . $row["image"]; ?>" class="d-block w-100" alt="Slide Image">
                        </div>
                        <?php
                        $active = false;
                    }
                    ?>
                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
                <?php
            }
            ?>
        </div>

        <!-- ảnh nền-->


        <!-- product section -->
        <div class="product-section mt-150 mb-150">          

            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="section-title">	
                            <h3><span class="orange-text"></span>Outstanding product</h3>
                        </div>
                    </div>
                </div>

                <?php
                $result = $product->showAllwive($conn);
                if (mysqli_num_rows($result) > 0) {
                    ?>
                    <div class="row">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="col-lg-4 col-md-6 text-center">
                                <div class="single-product-item">
                                    <div class="product-image">
                                        <a href="client/product_details.php?id=<?php echo $row["ProductID"]; ?>"><img src="<?php echo 'assetss/img/products/' . $row["image"]; ?>" alt=""></a>

                                    </div>
                                    <h3><?php echo $row["ProductName"]; ?></h3>
                                    <p class="product-price"><span>Per Kg</span> <?php echo $row['UnitPrice']; ?> </p>                                
                                    <a  href="index.php?action=add&id=<?php echo $row['ProductID'] ?>" class="cart-btn"><i class="fas fa-shopping-cart"></i>Thêm vào giỏ</a>

                                </div>
                            </div>

                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <!-- end product section -->
            </div>

            <!-- latest news -->
            <div class="latest-news pt-150 pb-150">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 text-center">
                            <div class="section-title">	
                                <h3><span class="orange-text"></span>News</h3>
                            </div>
                        </div>
                    </div>
                    <?php
                    $result = $product->shownews($conn);
                    if (mysqli_num_rows($result) > 0) {
                        ?>
                        <div class="row">
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-latest-news">
                                        <a href="client/news_details.php?id=<?php echo $row["newsID"]; ?>"><img src="<?php echo 'assetss/img/news/' . $row["image"]; ?>" alt=""></a>

                                        <div class="news-text-box">
                                            <h3><a href="client/news_details.php?id=<?php echo $row["newsID"]; ?>"><?php echo $row['newsName']; ?></a></h3>
                                            <p class="blog-meta">
                                                <span class="author"><i class="fas fa-user"></i> Admin</span>
                                                <span class="date"><i class="fas fa-calendar"></i><?php echo $row['ngaythang']; ?></span>
                                            </p>
                                            <a href="client/news_details.php?id=<?php echo $row["newsID"]; ?>" class="read-more-btn">Chi tiết <i class="fas fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
            <!-- end latest news -->
            <div class="logo-carousel-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="logo-carousel-inner">
                            <div class="single-logo-item">
                                <img src="assetss/img/company-logos/1.webp" alt="">
                            </div>
                            <div class="single-logo-item">
                                <img src="assetss/img/company-logos/2.webp" alt="">
                            </div>
                            <div class="single-logo-item">
                                <img src="assetss/img/company-logos/3.webp" alt="">
                            </div>
                            <div class="single-logo-item">
                                <img src="assetss/img/company-logos/4.webp" alt="">
                            </div>
                            <div class="single-logo-item">
                                <img src="assetss/img/company-logos/5.webp" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- footer -->
            <div class="footer-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-box about-widget">
                                <h2 class="widget-title">AboutUS</h2>
                                <p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-box get-in-touch">
                                <h2 class="widget-title">Address</h2>
                                <ul>
                                    <li>597/39A mạc cửu,vĩnh quang-RG-KG.</li>
                                    <li>nguentrungthuan417@gmail.com</li>
                                    <li>+84 388509046</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-box pages">
                                <h2 class="widget-title">Home</h2>
                                <ul>

                                    <li><a href="admin/login.php">Login</a></li>
                                    <li><a href="">Products</a></li>
                                    <li><a href="client/news.php">News</a></li>
                                    <li><a href="client/contact.php">Contacts</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-box subscribe">
                                <h2 class="widget-title">SignUp</h2>

                                <form action="index.html">
                                    <input type="email" placeholder="Email">
                                    <button type="submit"><i class="fas fa-paper-plane"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end footer -->

            
            
            <!-- copyright -->
            <div class="copyright">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 text-right col-md-12">
                            <div class="social-icons">
                                <ul>
                                    <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end copyright -->

            <!-- jquery -->
            <script src="assetss/js/jquery-1.11.3.min.js"></script>
            <!-- bootstrap -->
            <script src="assetss/bootstrap/js/bootstrap.min.js"></script>
            <!-- count down -->
            <script src="assetss/js/jquery.countdown.js"></script>
            <!-- isotope -->
            <script src="assetss/js/jquery.isotope-3.0.6.min.js"></script>
            <!-- waypoints -->
            <script src="assetss/js/waypoints.js"></script>
            <!-- owl carousel -->
            <script src="assetss/js/owl.carousel.min.js"></script>
            <!-- magnific popup -->
            <script src="assetss/js/jquery.magnific-popup.min.js"></script>
            <!-- mean menu -->
            <script src="assetss/js/jquery.meanmenu.min.js"></script>
            <!-- sticker js -->
            <script src="assetss/js/sticker.js"></script>
            <!-- main js -->
            <script src="assetss/js/main.js"></script>

    </body>
</html>