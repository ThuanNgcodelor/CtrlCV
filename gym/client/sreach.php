<?php
session_start();
require_once '../config/dbconnect.php';
require_once 'productclass.php';
require_once '../classes/RegionClass.php';
$category = new productclass();
$product = new productclass();
$region = new RegionClass();

// Add to cart

if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id = intval($_GET['id']);
    $categoryID = isset($_GET['categoryID']) ? $_GET['categoryID'] : ""; // Get the categoryID parameter
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
// Redirect to the shopping cart page with the categoryID parameter
    header("Location:cart_details.php");
    exit();
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

        <!-- title -->
        <title>News</title>

        <!-- favicon -->
        <link rel="shortcut icon" type="../assetss/img/png" href="../assetss/img/logo5.png">
        <!-- google font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
        <!-- fontawesome -->
        <link rel="stylesheet" href="../assetss/css/all.min.css">
        <!-- bootstrap -->
        <link rel="stylesheet" href="../assetss/bootstrap/css/bootstrap.min.css">
        <!-- owl carousel -->
        <link rel="stylesheet" href="../assetss/css/owl.carousel.css">
        <!-- magnific popup -->
        <link rel="stylesheet" href="../assetss/css/magnific-popup.css">
        <!-- animate css -->
        <link rel="stylesheet" href="../assetss/css/animate.css">
        <!-- mean menu css -->
        <link rel="stylesheet" href="../assetss/css/meanmenu.min.css">
        <!-- main style -->
        <link rel="stylesheet" href="../assetss/css/main.css">
        <!-- responsive -->
        <link rel="stylesheet" href="../assetss/css/responsive.css">

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
                                <a href="../index.php">
                                    <img src="../assetss/img/logo5.png" alt="">
                                </a>
                            </div>
                            <!-- logo -->

                            <!-- menu start -->
                            <nav class="main-menu">
                                <ul>
                                    <li ><a href="../index.php">Trang chủ</a></li>


                                    <li><a href="contact.php">Liên hệ</a></li>
                                    <li><a href="../admin/login.php"><?php
                                            if (isset($_SESSION["username"])) {
                                                echo $_SESSION["username"];
                                            } else {
                                                echo "Đăng nhập";
                                            }
                                            ?></a></li>
                                    <li><a href="#">Thương hiệu</a>
                                        <?php
                                        $result = $category->showALLbrand($conn);
                                        if (mysqli_num_rows($result) > 0) {
                                            ?>
                                            <ul class="sub-menu">
                                                <?php
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $categoryID = $row['brandID'];
                                                    ?>
                                                    <li><a href="brandcart.php?brandID=<?php echo $categoryID; ?>"><?php echo $row['brandName']; ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>

                                    </li>

                                    <li><a href="#">Sản phẩm</a>
                                        <?php
                                        $result = $category->showAllcategory($conn);
                                        if (mysqli_num_rows($result) > 0) {
                                            ?>
                                            <ul class="sub-menu">
                                                <?php
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $categoryID = $row['categoryID'];
                                                    ?>
                                                    <li><a href="shopping_cart.php?categoryID=<?php echo $categoryID; ?>"><?php echo $row['categoryName']; ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>

                                    </li>
                                    <li><a href="news.php">Tin tức mới</a></li>

                                    <li>
                                        <div class="header-icons">
                                        <a class="shopping-cart" href="cart_details.php">
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

        <!-- search area -->
      <div class="search-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>'</h3>
                            <h3>'</h3>
                            <h3>'</h3>

                            <span class="close-btn"><i class="fas fa-window-close"></i></span>
                            <div class="search-bar">
                                <form method="POST" action="sreach.php" class="search-bar-tablecell">
                                    <input type="text" name="keyword" placeholder="Tìm kiếm">
                                    <button type="submit">Tìm kiếm <i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- end search arewa -->

        <!-- breadcrumb-section -->
        <div class="breadcrumb-section breadcrumb-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="breadcrumb-text">
                            <p>Thực phẩm bổ sung</p>
                            <h1>Tìm kiếm</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end breadcrumb section -->

        <!-- latest news -->
        <div class="latest-news mt-150 mb-150">



            <div class="container">
                <?php
                if (isset($_POST['keyword'])) {
                    $result1 = $region->findRegionbyName($conn, $_POST['keyword']);
                    if (sizeof($result1) > 0) {
                        ?>
                        <div class="row product-lists">
                            <?php
                            $count = 0;
                            foreach ($result1 as $item) {
                                if ($count % 3 === 0) {
                                    echo '<div class="row">';
                                }
                                ?>
                                <div class="col-lg-4 col-md-6 text-center strawberry">
                                    <div class="single-product-item">
                                        <div class="product-image">
                                            <a href="product_details.php?id=<?php echo $item["ProductID"]; ?>"><img src="../assetss/img/products/<?php echo $item["image"]; ?>" alt=""></a>
                                        </div>
                                        <h3><?php echo $item["ProductName"]; ?></h3>
                                        <p class="product-price"><span>Per Kg</span> <?php echo $item["UnitPrice"]; ?></p>
                                        <a href="?action=add&id=<?php echo $item['ProductID']; ?>" class="cart-btn"><i class="fas fa-shopping-cart"></i>Thêm vào giỏ</a>


                                    </div>
                                </div>
                                <?php
                                $count++;
                                if ($count % 3 === 0) {
                                    echo '</div>';
                                }
                            }
                            if ($count % 3 !== 0) {
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <?php
                    } else {
                        echo "Không tìm thấy sản phẩm trong bảng";
                    }
                }
                ?>
            </div>
        </div>
        <!-- products -->
        <div class="container">
             <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="section-title">	
                            <h3><span class="orange-text"></span>Tất cả sản phẩm</h3>

                            <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>-->
                        </div>
                    </div>
                </div>

            <?php
            $result = $region->showre($conn);
            if (mysqli_num_rows($result) > 0) {
                ?>

                <div class="row product-lists">
                    <?php
                    $count = 0;
                    foreach ($result as $item) {
                        if ($count % 3 === 0) {
                            echo '<div class="row">';
                        }
                        ?>
                        <div class="col-lg-4 col-md-6 text-center strawberry">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <a href="product_details.php?id=<?php echo $item["ProductID"]; ?>"><img src="../assetss/img/products/<?php echo $item["image"]; ?>" alt=""></a>
                                </div>
                                <h3><?php echo $item["ProductName"]; ?></h3>
                                <p class="product-price"><span>Per Kg</span> <?php echo $item["UnitPrice"]; ?></p>
                                <a href="?action=add&id=<?php echo $item['ProductID']; ?>" class="cart-btn"><i class="fas fa-shopping-cart"></i>Thêm vào giỏ</a>


                            </div>
                        </div>
                        <?php
                        $count++;
                        if ($count % 3 === 0) {
                            echo '</div>';
                        }
                    }
                    if ($count % 3 !== 0) {
                        echo '</div>';
                    }
                    ?>
                </div>
                <?php
            } else {
                echo "Không tìm thấy sản phẩm trong bảng";
            }
            ?>
        </div>
    </div>


</div>
</div>
<!-- end latest news -->

<!-- logo carousel -->
<div class="logo-carousel-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="logo-carousel-inner">
                    <div class="single-logo-item">
                        <img src="../assetss/img/company-logos/1.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="../assetss/img/company-logos/2.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="../assetss/img/company-logos/3.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="../assetss/img/company-logos/4.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="../assetss/img/company-logos/5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end logo carousel -->

<!-- footer -->
<div class="footer-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-box about-widget">
                                <h2 class="widget-title">Về chúng tôi</h2>
                                <p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-box get-in-touch">
                                <h2 class="widget-title">Địa chỉ</h2>
                                <ul>
                                    <li>597/39A mạc cửu,vĩnh quang-RG-KG.</li>
                                    <li>nguentrungthuan417@gmail.com</li>
                                    <li>+84 388509046</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-box pages">
                                <h2 class="widget-title">Trang chủ</h2>
                                <ul>

                                    <li><a href="../admin/login.php">Đăng nhập</a></li>
                                    <li><a href="">Sản phẩm</a></li>
                                    <li><a href="../client/news.php">Tin tức</a></li>
                                    <li><a href="../client/contact.php">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-box subscribe">
                                <h2 class="widget-title">Đăng ký</h2>

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
            <div class="col-lg-6 col-md-12">
                <p>Copyrights &copy; 2019 - <a href="https://imransdesign.com/">Imran Hossain</a>,  All Rights Reserved.<br>
                    Distributed By - <a href="https://themewagon.com/">Themewagon</a>
                </p>
            </div>
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
<script src="../assetss/js/jquery-1.11.3.min.js"></script>
<!-- bootstrap -->
<script src="../assetss/bootstrap/js/bootstrap.min.js"></script>
<!-- count down -->
<script src="../assetss/js/jquery.countdown.js"></script>
<!-- isotope -->
<script src="../assetss/js/jquery.isotope-3.0.6.min.js"></script>
<!-- waypoints -->
<script src="../assetss/js/waypoints.js"></script>
<!-- owl carousel -->
<script src="../assetss/js/owl.carousel.min.js"></script>
<!-- magnific popup -->
<script src="../assetss/js/jquery.magnific-popup.min.js"></script>
<!-- mean menu -->
<script src="../assetss/js/jquery.meanmenu.min.js"></script>
<!-- sticker js -->
<script src="../assetss/js/sticker.js"></script>
<!-- main js -->
<script src="../assetss/js/main.js"></script>

</body>
</html>