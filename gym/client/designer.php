<?php
session_start();
require_once '../config/dbconnect.php';
require_once 'productclass.php';
require_once '../classes/orderclass.php';
$product = new productclass();
$category = new productclass();
$order = new orderclass();

if (isset($_SESSION["designerID"]) == null) {
    header("location:../admin/login.php");
    exit; // Add this line to stop the script execution
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

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Update user profile logic here
    $updateSuccess = $order->updateDE($conn, $name, $email, $pass, $_SESSION['designerID']);
    if ($updateSuccess) {
        echo '<script>alert("Profile updated successfully!");</script>';
    } else {
        echo '<script>alert("Failed to update profile.");</script>';
    }
}
?>
<?php
if (isset($_SESSION['designerID'])) {
    $customerID = $_SESSION['designerID'];
}

if (isset($_POST['addnews'])) {
    $news = $_POST['newName'];
    $description = $_POST['description'];
    if (isset($_FILES["event_image"]) && $_FILES["event_image"]["size"] > 0) {
        $target_dir = '../assetss/img/products/';
        $target_file = $target_dir . basename($_FILES["event_image"]["name"]);
        move_uploaded_file($_FILES["event_image"]["tmp_name"], $target_file);
        $images = $_FILES["event_image"]["name"];
    } else {
        $images = "";
    }
    $addnew = $order->addNews($conn,$news,$images,$description);
}

if (isset($_POST['saveEvent'])) {
    // Retrieving form data
    $workName = $_POST['event_name'];
    $date = $_POST['event_date'];
    $start = $_POST['event_start_time'];
    $end = $_POST['event_end_time'];
    $description = $_POST['event_description'];

    if (isset($_FILES["event_image"]) && $_FILES["event_image"]["size"] > 0) {
        $target_dir = '../assetss/img/products/';
        $target_file = $target_dir . basename($_FILES["event_image"]["name"]);
        move_uploaded_file($_FILES["event_image"]["tmp_name"], $target_file);
        $images = $_FILES["event_image"]["name"];
    } else {
        $images = "";
    }

    $addWork = $order->addWork($conn, $customerID, $workName, $date, $start, $end, $images);

    if ($addWork) {
        echo "";
        echo '<script>alert("Work added successfully!");</script>';
    } else {
        echo '<script>alert("Failed to add work.");</script>';
    }
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
    <title>Single Product</title>

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
                    <p>Thực phẩm bổ sung</p>
                    <h1>Hello Users</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$result = $order->showDE($conn, $_SESSION['designerID']);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container mt-5">
        <div class="card" style="max-width: 500px; margin: auto;">
            <div class="card-body">
                <form method="POST" action="designer.php">
                    <div class="text-center">
                        <h1><img src="../assetss/img/app/profile.jpg" alt="Profile" class="img-fluid rounded-circle" style="max-width: 150px;"></h1>
                    </div>

                    <div class="form-group">
                        <label for="name">Hi:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="pass">Password:</label>
                        <input type="password" class="form-control" id="pass" name="pass" value="<?php echo htmlspecialchars($row['password']); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" name="update">Update Profile</button>
                    <!-- Button to trigger the modal -->
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#calendarModal">
                        Create a calendar
                    </button>
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#participantsModal">
                        View consultation participants
                    </button>
                </form>

                <div class="text-center mt-3">
                    <a href="../admin/signout.php" class="btn btn-danger btn-block">Log Out</a>
                </div>
            </div>
        </div>
    </div>
    <br>

    <!-- Modal for Creating a Calendar -->
    <div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calendarModalLabel">Create a Calendar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="designer.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="event_name">Event Name:</label>
                            <input type="text" class="form-control" id="event_name" name="event_name" required>
                        </div>

                        <div class="form-group">
                            <label for="event_date">Event Date:</label>
                            <input type="date" class="form-control" id="event_date" name="event_date" required>
                        </div>

                        <div class="form-group">
                            <label for="event_start_time">Start Time:</label>
                            <input type="time" class="form-control" id="event_start_time" name="event_start_time" required>
                        </div>

                        <div class="form-group">
                            <label for="event_end_time">End Time:</label>
                            <input type="time" class="form-control" id="event_end_time" name="event_end_time" required>
                        </div>

                        <div class="form-group">
                            <label for="event_description">Description:</label>
                            <textarea class="form-control" id="content" name="event_description" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="event_image">Event Image (optional):</label>
                            <input type="file" class="form-control" id="event_image" name="event_image">
                        </div>

                        <button type="submit" class="btn btn-primary" name="saveEvent">Save Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Consultation Participants -->
    <!-- Modal cho Thêm Tham Gia Tư Vấn -->
    <div class="modal fade" id="participantsModal" tabindex="-1" role="dialog" aria-labelledby="participantsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="participantsModalLabel">Add Consultation Participants</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="designer.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="newName">Name:</label>
                            <input type="text" class="form-control" id="newName" name="newName" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" rows="10" cols="80"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control" id="images" name="images" required>
                        </div>
                        <div class="form-group">
                            <label for="datetime">Date/Time:</label>
                            <input type="datetime-local" class="form-control" id="datetime" name="datetime" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="addnews">Add Participant</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
} else {
    echo "<div class='container'><p class='text-center text-danger'>No data available.</p></div>";
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        CKEDITOR.replace('description');
        CKEDITOR.replace('content');
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        CKEDITOR.replace('content');
    });
</script>
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
                        <li><a href="../client/contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-box subscribe">
                    <h2 class="widget-title">Sign up</h2>

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

<script src="../assetss/js/jquery-1.11.3.min.js"></script>
<script src="../assetss/bootstrap/js/bootstrap.min.js"></script>
<script src="../assetss/js/jquery.countdown.js"></script>
<script src="../assetss/js/jquery.isotope-3.0.6.min.js"></script>
<script src="../assetss/js/waypoints.js"></script>
<script src="../assetss/js/owl.carousel.min.js"></script>
<script src="../assetss/js/jquery.magnific-popup.min.js"></script>
<script src="../assetss/js/jquery.meanmenu.min.js"></script>
<script src="../assetss/js/sticker.js"></script>
<script src="../assetss/js/main.js"></script>

</body>
</html>
