<?php
session_start();
require_once '../config/dbconnect.php';
require_once 'productclass.php';
require_once '../classes/orderclass.php';
require_once '../classes/RegionClass.php';

$product = new productclass();
$category = new productclass();
$order = new orderclass();
$customer = new RegionClass();


if (isset($_SESSION["username"]) == null) {
    header("location:../admin/login.php");
    exit; // Add this line to stop the script execution
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Update user profile logic here
    $updateSuccess = $order->updateUser($conn, $name, $email, $pass, $_SESSION['CustomerID']);

    if ($updateSuccess) {
        echo '<script>alert("Profile updated successfully!");</script>';
    } else {
        echo '<script>alert("Failed to update profile.");</script>';
    }
}
if (isset($_POST['yeucauhuy'])) {
    $orderIDs = $_POST['mahangxuly'];
    $statuses = $_POST['xuly'];

    // Loop through each submitted order
    for ($i = 0; $i < count($orderIDs); $i++) {
        $orderid = $orderIDs[$i];
        $xuly = $statuses[$i];
        $order->updatehuydon($conn, $xuly, $orderid);
    }
}
?>
<?php
if (isset($_SESSION['CustomerID'])) {
    $customerID = $_SESSION['CustomerID'];
}
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    #shopping-cart {
        background-color: #fff;
        padding: 20px;
        margin: 20px;
        width: 80%;
        margin-left: 150px;
        border: 1px solid #ccc;
    }

    .cart-item-image {
        width: 100px;
        height: 100px;
    }

    .no-records {
        text-align: center;
        margin-top: 20px;
    }

    .btn-remove-action {
        text-decoration: none;
    }

    .btn-custom {
        background-color: #007bff;
        color: #fff;
        border-radius: 4px;
        text-decoration: none;
        margin-right: 10px;
    }

    .btn-custom:hover {
        background-color: #0056b3;
    }

    .card img {
        width: 100%;
        height: auto;
    }

    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.8);
        max-width: 50vh;
        margin: auto;
        text-align: left;
        padding: 20px;
    }

    .card a {
        text-decoration: none;
    }
</style>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

        <!-- title -->
        <title>Users</title>

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
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="breadcrumb-text">
                            <p></p>
                            <h1>Hello Users</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $result = $order->showcus($conn, $_SESSION['CustomerID']);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            ?>
            <div class="container mt-5">
                <div class="card" style="max-width: 500px; margin: auto;">
                    <div class="card-body">
                        <form method="POST">
                            <div class="text-center">
                                <h1><img src="../assetss/img/app/profile.jpg" alt="Profile" class="img-fluid rounded-circle" style="max-width: 150px;"></h1>
                            </div>

                            <div class="form-group">
                                <label for="name">Hi:</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($row['CompanyName']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="pass">Password:</label>
                                <input type="password" class="form-control" id="pass" name="pass" value="<?php echo htmlspecialchars($row['pass']); ?>" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block" name="update">Update Profile</button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="../admin/signout.php" class="btn btn-danger btn-block">Log Out</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        } else {
            echo "<div class='container'><p class='text-center text-danger'>No data available.</p></div>";
        }
        ?>
        <section id="shopping-cart" class="container mt-5">
            <br>
            <?php
            $result = $order->showCustomer($conn, $customerID);
            if (mysqli_num_rows($result) > 0) {
                ?>
                <form method="post" action="">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th colspan="7" class="text-center">Your Order</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Request Cancellation</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $previousOrderID = null;
                        $totalPrice = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row["OrderID"] !== $previousOrderID) {
                                if ($previousOrderID !== null) {
                                    ?>
                                    <tr>
                                        <td colspan="5"></td>
                                        <th colspan="2" class="text-right">Total: <?php echo number_format($totalPrice, 3); ?> VNĐ</th>
                                    </tr>
                                    <?php
                                    $totalPrice = 0;
                                }
                                ?>
                                <tr>
                                    <td><?php echo $row["OrderID"]; ?></td>
                                    <input type="hidden" name="mahangxuly[]" value="<?php echo $row["OrderID"]; ?>">
                                    <td class="text-center"><img src="<?php echo '../assetss/img/products/' . $row["image"]; ?>" class="cart-item-image img-fluid" /></td>
                                    <td><?php echo $row["ProductName"]; ?></td>
                                    <td class="text-center"><?php echo $row["quantity"]; ?></td>
                                    <td class="text-center"><?php echo $row["ngaythang"]; ?></td>
                                    <td><?php
                                        if ($row['tinhtrang'] == 0 && $row['OrderID']) {
                                            echo 'Pending';
                                        } elseif ($row['tinhtrang'] == 1 && $row['OrderID']) {
                                            echo 'Processed';
                                        } else {
                                            echo 'Canceled';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <select name="xuly[]" class="form-control">
                                            <option value="0" <?php echo ($row['huydon'] == 0) ? 'selected' : ''; ?>></option>
                                            <option value="1" <?php echo ($row['huydon'] == 1) ? 'selected' : ''; ?>>Request cancellation</option>
                                        </select>
                                        <button type="submit" name="yeucauhuy" class="btn btn-custom mt-2">Confirm</button>
                                    </td>
                                </tr>
                                <?php
                                $previousOrderID = $row["OrderID"];
                                $totalPrice += $row["unitprice"];
                            } else {
                                ?>
                                <tr>
                                    <td></td>
                                    <td class="text-center"><img src="<?php echo '../assetss/img/products/' . $row["image"]; ?>" class="cart-item-image img-fluid" /></td>
                                    <td><?php echo $row["ProductName"]; ?></td>
                                    <td class="text-center"><?php echo $row["quantity"]; ?></td>
                                </tr>
                                <?php
                                $totalPrice += $row["unitprice"];
                            }
                        }
                        if ($previousOrderID !== null) {
                            ?>
                            <tr>
                                <td colspan="5"></td>
                                <th colspan="2" class="text-right">Total: <?php echo number_format($totalPrice, 3); ?> VNĐ</th>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </form>
                <?php
            } else {
                echo "<p class='no-records'>You don't have any orders yet.</p>";
            }
            ?>
        </section>

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
