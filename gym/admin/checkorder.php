<!DOCTYPE html>
<?php session_start(); ?>
<?php
if (isset($_SESSION["username"]) == null) {
    header("location:login.php");
}
?>
<?php
require_once '../config/dbconnect.php';
require_once '../classes/orderclass.php';
$order = new orderclass();

if (isset($_POST['capnhapdonhang'])) {
    $orderIDs = $_POST['mahangxuly'];
    $statuses = $_POST['xuly'];

    // Loop through each submitted order
    for ($i = 0; $i < count($orderIDs); $i++) {
        $orderid = $orderIDs[$i];
        $xuly = $statuses[$i];
        $order->updatetinhtrang($conn, $xuly, $orderid);
    }
}
if (isset($_GET["action"]) && ($_GET["action"] == "delete")) {
    $flag = $order->deleteOrder($conn, $_GET["OrderDetailID"]);
    if (!$flag) {
        echo "Error: insert incorrect!!!";
    }
  header("location:checkorder.php");
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
        <!--<link href="../assets/css/style.css" rel="stylesheet" type="text/css"/>-->
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

                <br/>
                <!--Display Region Table-->
                <?php
                $result = $order->showorderdetails($conn);
                if (mysqli_num_rows($result) > 0) {
                    ?>
                    <form method="POST" action="">
                        <table border="1">
                        <thead>
                            <tr>
                                <th colspan="2">Đơn hàng</th>                       
                            </tr>
                        </thead>
                            <thead>
                                <tr>
                                    <th width="6%">Mã đơn hàng</th>
                                    <th width="6%">Mã khách hàng</th>
                                    <th width="10%">Sản phẩm</th>
                                    <th width="5%">Số lượng</th>
                                    <th width="10%">Giá</th>
                                    <th width="5%">Ảnh</th>
                                    <th width="5%">trạng thái</th>
                                    <th width="5%">Yêu cầu</th>
                                    <th width="10%">Ngày giao dịch</th>
                                    <th width="5%">trạng thái</th>
                                    <th width="5%">Xóa</th>
                                    
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
                                                <td colspan="1">Tổng tiền:</td>
                                                <td style="text-align:right;"><?php echo number_format($totalPrice, 3); ?> VNĐ</td>
                                                
                                            </tr>
                                            <?php
                                            $totalPrice = 0;
                                        }
                                        ?>
                                        <tr>
                                    <input type="hidden" name="mahangxuly[]" value="<?php echo $row["OrderID"]; ?>">
                                    <td><?php echo $row["OrderID"]; ?></td>
                                    <td style="text-align:left;"><?php echo $row["CustomerID"]; ?></td>
                                    <td style="text-align:left;"><?php echo $row["ProductName"]; ?></td>
                                    <td style="text-align:left;"><?php echo $row["quantity"]; ?></td>
                                    <td style="text-align:right;"><?php echo $row["unitprice"]; ?> VNĐ</td>
                                    <td style="text-align:left;"><img src="<?php echo '../assetss/img/products/' . $row["image"]; ?>" class="cart-item-image" /></td>
                                    <td style="text-align:left;">
                                        <select name="xuly[]">
                                            <option value="0" <?php echo ($row['tinhtrang'] == 0 && $row['OrderID']) ? 'selected' : ''; ?>>Chưa xử lý</option>
                                            <option value="1" <?php echo ($row['tinhtrang'] == 1) ? 'selected' : ''; ?>>Đã xử lý</option>
                                            <option value="2" <?php echo ($row['tinhtrang'] == 2) ? 'selected' : ''; ?>>Xác nhận hủy</option>
                                        </select>
                                    </td>
                                    <td style="text-align:left;"><?php
                                        if ($row['huydon'] == 0) {
                                            echo"";
                                        } else {
                                            echo"Yêu cầu hủy";
                                        }
                                        ?></td>
                                    <td style="text-align:left;"><?php echo $row["ngaythang"]; ?></td>
                                    <td style="text-align:left;"><input type="submit" name="capnhapdonhang" /></td>
                                    <td style="text-align:left;"><a href="?action=delete&OrderDetailID=<?php echo $row["OrderDetailID"]; ?>"><img src="../assetss/img/app/icons8-delete-30.png" width="30px"/></a></td>

                                    </tr>
                                    <?php
                                    $previousOrderID = $row["OrderID"];
                                    $totalPrice += $row["unitprice"];
                                } else {
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align:left;"><?php echo $row["ProductName"]; ?></td>
                                        <td style="text-align:left;"><?php echo $row["quantity"]; ?></td>
                                        <td style="text-align:right;"><?php echo $row["unitprice"]; ?> VNĐ</td>
                                        <td height="10px" style="text-align:center;"><img src="<?php echo '../assetss/img/products/' . $row["image"]; ?>" class="cart-item-image" /></td>
                                    </tr>
                                    <?php
                                    $totalPrice += $row["unitprice"];
                                }
                            }
                            if ($previousOrderID !== null) {
                                ?>
                                    <br>
                                <tr>
<tr>
                                                <td colspan="1">Tổng tiền:</td>
                                                <td style="text-align:right;"><?php echo number_format($totalPrice, 3); ?> VNĐ</td>
                                                
                                            </tr>
                                    
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </form>
                    <?php
                } else {
                    echo "Bạn chưa có đơn hàng nào";
                }
                ?>
                <!--Find Region by Name-->
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
                                    <th width="10%">Loại</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result1 as $item) {
                                    ?>
                                    <tr>

                                        <td><?php echo $item["ProductName"]; ?></td>
                                        <td><?php echo $item["UnitPrice"]; ?></td>
                                        <td><?php echo $item["CategoryID"]; ?></td>
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
        <script>
       
    </body>
</html>
