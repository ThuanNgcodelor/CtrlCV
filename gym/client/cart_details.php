<?php
session_start();
require_once '../config/dbconnect.php';
require_once 'productclass.php';
$category = new productclass();
$product = new productclass();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST["item_id"];
    $new_quantity = $_POST["quantity" . $item_id];

    // tăng sản phẩm lên
    $_SESSION["cart"][$item_id]["quantity"] = $new_quantity;

    //chuển về cart
    header("Location: cart_details.php");
    exit();
}

// check get có xóa ko
if (isset($_GET['action']) && $_GET['action'] === "remove") {
    $item_id = $_GET['id'];

    // xóa sp
    unset($_SESSION["cart"][$item_id]);

    
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
        <title>Cart</title>

        <!-- favicon -->
        <link rel="shortcut icon" type="image/png" href="../assetss/img/logo5.png">
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
                                    <li ><a href="../index.php">Home</a></li>


                                    <li><a href="contact.php">Contacts</a></li>
                                    <li><a href="../admin/login.php"><?php
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
                                                    <li><a href="brandcart.php?brandID=<?php echo $categoryID; ?>"><?php echo $row['brandName']; ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>

                                    </li>

                                    <li class="current-list-item"><a href="#" >Products</a>
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
                                    <li><a href="news.php">News</a></li>

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
                        <span class="close-btn"><i class="fas fa-window-close"></i></span>
                        <div class="search-bar">
                            <div class="search-bar-tablecell">
                                <h3>Search For:</h3>
                                <input type="text" placeholder="Keywords">
                                <button type="submit">Search <i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end search arewa -->

        <!-- breadcrumb-section -->
        <div class="breadcrumb-section breadcrumb-bg">
            <div class="container">
                <br>
                <br>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="breadcrumb-text">
                            <p></p>
                            <h1>Shopping cart</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end breadcrumb section -->

        <!-- cart -->
        <div class="cart-section mt-150 mb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="cart-table-wrap">
                            <?php
                            if (isset($_SESSION["cart"])) {
                                $total_quantity = 0;
                                $total_price = 0;
                                ?>	
                                <table class="cart-table">
                                    <thead class="cart-table-head">
                                        <tr class="table-head-row">
                                            <th class="product-remove"></th>
                                            <th class="product-image">Images</th>
                                            <th class="product-name">Product name</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
    <!--                                            <th class="product-total">Total</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($_SESSION["cart"] as $item => $value) {
                                            $item_price = $value["quantity"] * $value["price"];
                                            ?>
                                            <tr class="table-body-row">
                                                <td class="product-remove"><a href="?action=remove&id=<?php echo $item; ?>"><i class="far fa-window-close"></i></a></td>
                                                <td class="product-image"><img src="<?php echo '../assetss/img/products/' . $value["image"]; ?>" alt=""></td>
                                                <td class="product-name"><?php echo $value["name"]; ?></td>
                                                <td class="product-price"><?php echo $value["price"]; ?> VNĐ</td>
                                        <form method="POST" action="cart_details.php">
                                            <input type="hidden" name="item_id" value="<?php echo $item; ?>">
                                            <td class="product-quantity">
                                                <input type="number" name="quantity<?php echo $item; ?>" min="1" value="<?php echo $value['quantity']; ?>">
                                                <button type="submit" class="update-quantity-btn">Update</button>
                                            </td>
                                        </form>
                                        </tr>
                                        <?php
                                        $total_quantity += $value["quantity"];
                                        $total_price += ($value["price"] * $value["quantity"]);
                                    }
                                    ?>
                                    <?php
                                } else {
                                    ?>
                                    <div class="no-records">Your shopping cart is empty</div>

                                    <?php
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="total-section">

                            <tr>
                                <td colspan="2" align="right">Total:</td>

                                <td align="right" colspan="2"><strong></strong></td>
                                <td></td>
                            </tr>
                            <table class="total-table">
                                <thead class="total-table-head">
                                    <tr class="table-total-row">
                                        <th >Tất cả</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="total-data">
                                        <td><strong>Quantity </strong></td>
                                        <td><?php
                                            if (isset($total_quantity)) {
                                                echo $total_quantity;
                                            } else {
                                                echo 0;
                                            }
                                            ?></td>
                                    </tr>
                                    <tr class="total-data">
                                        <td><strong>Make money</strong></td>
                                        <td><?php
                                            if (isset($total_price)) {
                                                echo " " . number_format($total_price, 3) . " VNĐ";
                                            } else {
                                                echo "0 VNĐ";
                                            }
                                            ?></td>
                                    </tr>

                                </tbody>
                            </table>

                            <div class="cart-buttons">
                                <a href="shopping_cart.php?categoryID=4" class="boxed-btn"> Continue shopping</a>
                                <a href="order.php" class="boxed-btn black">Order</a>
                            </div>
                        </div>

                        <div class="coupon-section">
                            <h3>Discount code</h3>
                            <div class="coupon-form-wrap">
                                <form action="index.html">
                                    <p><input type="text" placeholder="Coupon"></p>
                                    <p><input type="submit" value="Confirm"></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end cart -->

        <!-- logo carousel -->
        <div class="logo-carousel-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="logo-carousel-inner">
                            <div class="single-logo-item">
                                <img src="../assetss/img/company-logos/1.webp" alt="">
                            </div>
                            <div class="single-logo-item">
                                <img src="../assetss/img/company-logos/2.webp" alt="">
                            </div>
                            <div class="single-logo-item">
                                <img src="../assetss/img/company-logos/3.webp" alt="">
                            </div>
                            <div class="single-logo-item">
                                <img src="../assetss/img/company-logos/4.webp" alt="">
                            </div>
                            <div class="single-logo-item">
                                <img src="../assetss/img/company-logos/5.webp" alt="">
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
                            <h2 class="widget-title">About us</h2>
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

                                <li><a href="../admin/login.php">Login</a></li>
                                <li><a href="">Products</a></li>
                                <li><a href="../client/news.php">News</a></li>
                                <li><a href="../client/contact.php">Contacts</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-box subscribe">
                            <h2 class="widget-title">Sign Up</h2>

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
        <script src="../assetss/js/giohang.js" type="text/javascript"></script>
    </body>
</html>
