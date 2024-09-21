<?php session_start(); ?>

<?php
require_once '../config/dbconnect.php';
require_once '../classes/orderclass.php';
require_once '../client/productclass.php';

$order = new orderclass();
$category = new productclass();

if (!isset($_SESSION["username"])) {
    header("location:../admin/login.php");
    exit();
}

if (isset($_POST['addorder'])) {
    $name = $_POST['CompanyName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['Address'];

    if (empty($_SESSION["cart"])) {
        echo '<script>alert("Vui lòng mua sản phẩm trước khi đặt hàng.");</script>';
    } else {
        $billID = $order->addOrder($conn, $name, $email, $phone, $address);

        if ($billID === false) {
            echo "Error: failed to insert order!!!";
        } else {
            $billID = $billID;

            if ($billID) {
                foreach ($_SESSION["cart"] as $key => $value) {
                    $productname = $value["name"];
                    $unitprice = $value["price"] * $value["quantity"];
                    $quantity = $value["quantity"];
                    $image = $value["image"];
                    $customerID = $_SESSION["CustomerID"];
                    $order->addOrderDetails($conn, $productname, $unitprice, $quantity, $image, $billID, $customerID);
                }

                // Clear the session variables
                $_SESSION["cart"] = array();
                echo '<script>alert("Cảm ơn bạn đã đặt hàng."); window.location.href = "user.php";</script>';
                exit();
            }
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
        <title>Check Out</title>

        <!-- favicon -->
        <link rel="shortcut icon" type="../assetss/png" href="../assetss/img/logo5.png">
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
                            <h3>'</h3>
                            <h3>'</h3>
                            <h3>'</h3>

                            <span class="close-btn"><i class="fas fa-window-close"></i></span>
                            <div class="search-bar">
                                <form method="POST" action="sreach.php" class="search-bar-tablecell">
                                    <input type="text" name="keyword" placeholder="Tìm kiếm">
                                    <button type="submit">Search<i class="fas fa-search"></i></button>
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
                <br>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="breadcrumb-text">
                            <p></p>
                            <h1>Check out</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end breadcrumb section -->

        <!-- check out section -->
        <div class="checkout-section mt-150 mb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-accordion-wrap">
                            <div class="accordion" id="accordionExample">
                                <div class="card single-accordion">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Địa chỉ thanh toán
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="billing-address-form">
                                                <form action="" method="POST">
                                                    <p><input type="text" placeholder="Name" name="CompanyName"></p>
                                                    <p><input type="email" placeholder="Email" name="email"></p>
                                                    <p><input type="tel" placeholder="Phone" name="phone"></p>


                                                    <p><textarea name="Address" id="bill" cols="30" rows="10" placeholder="Say Something"></textarea></p>
                                                    <button class='pay-btn' type="submit" name="addorder">Đặt Hàng</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="order-details-wrap">

                            <table class="order-details">

                                <thead>
                                    <tr>
                                        <th>Chi tiết</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="order-details-body">


                                    <?php
                                    $total_quantity = 0;
                                    $total_price = 0;

                                    if (isset($_SESSION["cart"])) {
                                        foreach ($_SESSION["cart"] as $key => $value) {
                                            $total_quantity += $value["quantity"];
                                            $total_price += ($value["price"] * $value["quantity"]);
                                            ?>
                                            <tr>
                                                <td><?php echo $value["name"]; ?></td>
                                                <td><?php echo $value["price"]; ?> VNĐ</td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td>Số lượng</td>
                                        <td><?php echo $total_quantity; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tổng</td>
                                        <td><?php echo number_format($total_price, 3); ?> VNĐ</td>
                                    </tr>
                                    

                                </tbody>




                            </table>
                            <a href="sreach.php" class="boxed-btn"> Tiếp tục mua hàng</a>




                        </div>




                    </div>
                </div>
            </div>
        </div>
        <!-- end check out section -->

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

    </body>
</html>