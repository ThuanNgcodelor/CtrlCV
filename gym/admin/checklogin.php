<!DOCTYPE html>
<?php session_start(); ?>
<?php
if (isset($_SESSION["username"]) == null) {
    header("location:login.php");
}
?>
<?php
require_once '../config/dbconnect.php';
require_once '../classes/EmployeesClass.php';
$employee = new EmployeesClass();
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
        <link href="../assetss  /css/admin.css" rel="stylesheet" type="text/css"/>


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

                <th width="10%">Tài khoản khách hàng</th>
                <!--Display Region Table-->
                <?php
                $result = $employee->adminlogin($conn);
                if (mysqli_num_rows($result) > 0) {
                    ?>
                    <table border="1">
                        <thead>
                            <tr>
                                <th width="10%">ID khách hàng</th>
                                <th width="30%">Tên khách hàng</th>
                                <th width="30%">Email</th>
                                <th width="30%">Mật khẩu</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td ><?php echo $row["CustomerID"]; ?></td>

                                    <td ><?php echo $row["CompanyName"]; ?></td>
                                    <td ><?php echo $row["email"]; ?></td>
                                    <td ><?php echo $row["pass"]; ?></td>                                    
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo "No data in Region Table";
                }
                ?>
                <!--Find Region by Name        -->
                <br/>

                <br/>
                <!--Display Region Table-->

                <?php
                if (isset($_POST['keyword'])) {
                    $result1 = $employee->adminloginsearch($conn, $_POST['keyword']);
                    if (sizeof($result1) > 0) {
                        ?>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th colspan="5">Sản phẩm tìm kiếm</th>                       
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th width="10%">Tên sản phẩm</th>
                                    <th width="10%">Giá tiền</th>
                                    <th width="10%"> Loại</th>
                                    \                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result1 as $item) {
                                    ?>
                                    <tr>
                                        <td ><?php echo $item["ProductName"]; ?></td>
                                        <td ><?php echo $item["UnitPrice"]; ?></td>
                                        <td ><?php echo $item["CategoryID"]; ?></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                    } else {
                        echo "Không tìm thấy trong bảng";
                    }
                }
                ?>

                <?php $conn->close(); ?>

                </tbody>
                </table>

                <!--Find Region by Name        -->
                <br/>


                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
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
