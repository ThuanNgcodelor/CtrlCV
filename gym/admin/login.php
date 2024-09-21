<!DOCTYPE html>
<?php session_start(); ?>
<?php
require_once '../config/myconnection.php';
require_once '../classes/EmployeesClass.php';
require_once '../classes/CustomerClass.php';
$conn = MyConnection::connectDatabase();
$employee = new EmployeesClass();
$customer = new CustomerClass();

// Redirect if the customer or designer is already logged in
if (isset($_SESSION['username'])) {
    header('location: ../client/user.php');
    exit(); // Ensure script stops after redirect
}

if (isset($_SESSION['designerID'])) {
    header('location: ../client/designer.php');
    exit(); // Ensure script stops after redirect
}

// Handle customer registration
if (isset($_POST["AddCustomer"])) {
    $flag = $customer->addCustomer($conn, $_POST["email"], $_POST["CompanyName"], $_POST["password"]);
    if (!$flag) {
        echo "Error: insert incorrect!!!";
    } else {
        echo '<script>alert("Đăng ký thành công.");</script>';
    }
}

if (isset($_POST["username"])) {
    $email = $_POST["username"];
    $pword = $_POST["password"];

    // Check if the login is for an employee
    $emp = $employee->checkLogin($conn, $email, $pword);

    if ($emp != null) {
        $role = $emp["role"];
        $_SESSION["role"] = $role;
        $_SESSION["CustomerID"] = $emp["CustomerID"];
        $_SESSION["CompanyName"] = $emp["CompanyName"];
        $_SESSION["email"] = $email;
        $_SESSION["username"] = $email;

        // Redirect based on role
        if ($role == 1) {
            header("location:admin.php");
        } else {
            header("location:../client/user.php");
        }
        exit(); // Ensure script stops after redirect
    } else {
        // Check if the login is for a designer
        $designer = $employee->checkDe($conn, $email, $pword);

        if ($designer != null) {
            // Designer login successful
            $_SESSION["designerID"] = $designer["designerID"];
            $_SESSION["role"] = $designer["role"];
            $_SESSION["email"] = $email;

            // Redirect to designer page if the role is 1
            if ($designer["role"] == 1) {
                header("location:../client/designer.php");
            } else {
                echo '<script>alert("Sai email hoặc mật khẩu."); window.location.href = "../admin/login.php";</script>';
            }
            exit();
        } else {
            echo '<script>alert("Sai email hoặc mật khẩu."); window.location.href = "../admin/login.php";</script>';
        }
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../assetss/css/login.css" rel="stylesheet" type="text/css"/>
        

    </head>

    <body>

        

        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="login.php" method="POST">
                    <h1>Tạo tài khoản</h1>
                    <div class="social-container">

                    </div>
                    <span>hoặc sử dụng email của bạn để đăng ký</span>
                    <input type="text"name="CompanyName" placeholder="Name" />
                    <input type="email" name="email" placeholder="Email" />
                    <input type="password" name="password" placeholder="Password" />
                    <a href="../client/designer.php">bạn quên mật khẩu?</a>
                    <button name="AddCustomer">Đăng ký</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="login.php"onsubmit="return loginform()"  method="POST" name="login">
                    <h1>Đăng nhập</h1>
                    <div class="social-container">

                    </div>
                    <span>hoặc sử dụng tài khoản của bạn</span>
                    <input type="email" name="username" placeholder="Email" />
                    <input type="password" name="password" placeholder="Password" />
                    <button name="dangnhap" type="submit"  onclick="">Đăng nhập</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <a href="../index.php">Trang chủ</a>

                        <button class="ghost" id="signIn">Đăng nhập</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <a href="../index.php">Trang chủ</a>

                        <button  class="ghost" name="AddCustomer" id="signUp">Đăng ký</button>
                    </div>
                </div>
            </div>
        </div>


        <script>
            const signUpButton = document.getElementById('signUp');
            const signInButton = document.getElementById('signIn');
            const container = document.getElementById('container');

            signUpButton.addEventListener('click', () => {
                container.classList.add("right-panel-active");
            });

            signInButton.addEventListener('click', () => {
                container.classList.remove("right-panel-active");
            });
            
        </script>  
    </body>
   <script src="../assetss/js/login.js"></script>
</html>
