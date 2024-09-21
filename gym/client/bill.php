<?php
session_start();
require_once '../config/dbconnect.php';
require_once './productclass.php';
$product = new productclass();

// Add to cart
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
<style>
    .category-list {
        list-style-type: none;
        padding: 0;
        margin-left:  94vh;
        text-align: center;
        /*margin-top:  2px;*/

    }

    .category-list li {
        display: inline-block;
        margin-right: 10px;
        cursor: pointer;
    }
    .category-list li a{
        text-decoration: none;
    }

    .category-list li.active {
        font-weight: bold;
    }

    /* CSS cho danh sách sản phẩm */
    .product-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .product-list li {
        margin-bottom: 10px;

    }

</style>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"/>

        <title>View Product</title>
        <link href="../assets/css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <section class="py-5">
            <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
                <div class="container px-5">
                    <a class="navbar-brand" href="../index.php">GYM STORE</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ms-auto">

                            <li class="nav-item"><a class="nav-link" href="../index.php">Trang chủ</a></li>
                            <li class="nav-item"><a class="nav-link" href="shopping_cart.php">Sản phẩm</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.php">Liên hệ</a></li>
                            <li class="nav-item"><a class="nav-link" name="login" href="../admin/login.php">
                                    <?php
                                    if (isset($_SESSION["username"])) {
                                        echo $_SESSION["username"];
                                    } else {
                                        echo "Đăng nhập";
                                    }
                                    ?></a></li>
                            <li class="nav-item">
                                <a class="nav-link" name="cart" href="cart_details.php">
                                    <?php
                                    if (isset($_SESSION['cart'])) {
                                        $total_quantity = 0;
                                        $total_price = 0;
                                        foreach ($_SESSION['cart'] as $x => $value) {
                                            $total_quantity += intval($value["quantity"]);
                                            $total_price += doubleval($value["price"]) * intval($value["quantity"]);
                                        }
                                        echo "<span>Giỏ hàng " . $total_quantity . "</span>";
                                    } else {
                                        echo"Giỏ hàng";
                                    }
                                    ?>

                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <br>

            <section class="py-5">

              
            <div class="container">
                <p class="m-0 text-center text-red">Cảm ơn bạn đã đặt hàng</p>
                <p class="m-0 text-center text-red"><a href="user.php">Tại đây</a></p>
              
            </div>
            </section>

    </body>
</html>