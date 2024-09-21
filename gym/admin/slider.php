<!DOCTYPE html>
<?php session_start(); ?>
<?php
if (isset($_SESSION["username"]) == null) {
    header("location:login.php");
}
?>
<?php
require_once '../config/myconnection.php';
require_once '../classes/RegionClass.php';
require_once '../client/productclass.php';
$conn = myconnection::connectDatabase();
$slider = new productclass();
$region = new RegionClass();

if (isset($_POST["addslider"])) {
    $slidername = $_POST["sliderName"];
    if(isset($_FILES["image"])){
        $target_dir = "../assetss/img/app/"; // Specify the directory where you want to store the uploaded files
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }

    // Check if any data is empty
    if (empty($slidername) || empty($_FILES["image"]["name"])) {
        echo "Error: All fields are required.";
    } else {
        $flag = $region->addslider($conn, $slidername, $_FILES["image"]["name"]);
        if (!$flag) {
            echo "Error: insert incorrect!!!";
        }
    }
}


//Delete
if (isset($_GET["action"]) && ($_GET["action"] == "delete")) {
    $flag = $region->deleteslider($conn, $_GET["sliderName"]);
    if (!$flag) {
        echo "Error: insert incorrect!!!";
    }
  header("location:slider.php");
}
?>

<style>
    /* Định dạng cho form */
    .product {
        margin-bottom: 20px;
    }

    /* Định dạng cho table */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Định dạng cho input */
    input[type="text"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    /* Định dạng cho nút submit và reset */
    input[type="submit"], input[type="reset"] {
        padding: 8px 16px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover, input[type="reset"]:hover {
        background-color: #45a049;
    }

    /* Định dạng cho hình ảnh */
    img {
        max-width: 100%;
        height: auto;
    }
</style>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>


        <link href="../assetss/css/admin.css" rel="stylesheet" type="text/css"/>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    </head>

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="admin.php">Whey Store</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" method="POST">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" name="keyword" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        <!--<li><hr class="dropdown-divider" /></li>-->
                        <li><a class="dropdown-item" href="signout.php">Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">


                            <!--<div class="sb-sidenav-menu-heading"></div>-->

                            <div class="sb-sidenav-menu-heading">Sản phẩm</div>

                            <a class="nav-link" href="region.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Sản phẩm
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>

                                Thêm
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="region.php">Thêm sản phẩm</a>
                                    <a class="nav-link" href="addloaihang.php">Thêm Loại hàng</a>
                                    <a class="nav-link" href="addnews.php">Thêm tin tức</a>
                                    <a class="nav-link" href="addbrand.php">Thêm nhãn hàng  </a>

                                    <a class="nav-link" href="slider.php">Thêm backgroud </a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Khách hàng</div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Đơn hàng
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="checkorder.php">Đơn hàng khách đặt</a>


                                </nav>
                            </div>
                            <a class="nav-link" href="checklogin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Tài khoản khách hàng
                            </a>
                            <a class="nav-link" href="checkcontact.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Phản hồi 
                            </a>
                             <a class="nav-link" href="binhluan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Bình luận
                            </a>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Đăng nhập với tư cách</div>
                        Quản trị viên
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">



                <form method="POST" enctype="multipart/form-data">
    <table border="0">
        <thead>
            <tr>
                <th colspan="2">Ảnh</th>                       
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tên ảnh</td>
                <td><input type="text" name="sliderName" value='<?php
                    if (isset($_GET["action"]) && ($_GET["action"] == "update")) {
                        echo $regionupdate["sliderName"];
                    }
                ?>' /></td>
            </tr>

            <tr>
                <td>ảnh chính</td>
                <td><input type="file" name="image" value='<?php
                    if (isset($_GET["action"]) && ($_GET["action"] == "update")) {
                        echo $regionupdate["image"];
                    }
                ?>' /></td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" 
                           value='<?php
                           if (isset($_GET["action"]) && ($_GET["action"] == "update")) {
                               echo "Chỉnh sửa";
                           } else {
                               echo "Thêm";
                           }
                           ?>' 
                           name='<?php
                           if (isset($_GET["action"]) && ($_GET["action"] == "update")) {
                               echo "updatecategory";
                           } else {
                               echo "addslider";
                           }
                           ?>' />
                    <input type="reset" value="Sửa" />
                </td>
            </tr>
        </tbody>
    </table>
</form>

                <br/>
                <!--Display Region Table-->
                <?php
                $result = $slider->showslider($conn);
                if (mysqli_num_rows($result) > 0) {
                    ?>

                    <table border="1">
                        <thead>
                            <tr>
                                <th width="10%">Thứ tự</th>

                                <th width="10%">Tên ảnh</th>
                                <th width="40%">Ảnh chính</th>

                                <th width="10%">Xóa</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row["sliderID"]; ?></td>

                                    <td><?php echo $row["sliderName"]; ?></td>


                                    <td width="10%"><img  src="<?php echo '../assetss/img/app/' . $row["image"]; ?>" class="d-block w-100" alt="Slide Image"></td>



                                    <td>
                                        <a href="?action=delete&sliderName=<?php echo $row["sliderName"]; ?>"><img src="../assetss/img/app/icons8-delete-30.png" width="30px"/></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody >
                    </table>
                    <?php
                } else {
                    echo "No data in Region Table";
                }
                ?>


                <?php $conn->close(); ?>

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"> </div>
                            <div>

                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
