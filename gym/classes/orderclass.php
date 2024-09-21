<?php

class orderclass {

    public function addOrder($conn, $companyname, $email, $phone, $address) {
        $sql = "INSERT INTO orders (CompanyName, email, phone, Address, tinhtrang) VALUES ('$companyname', '$email', '$phone', '$address', 0)";
        if (mysqli_query($conn, $sql)) {
            $billID = mysqli_insert_id($conn);
            return $billID;
        } else {
            return false;
        }
    }

    public function addWDetails($conn, $customerID, $workID) {
        $sql = "INSERT INTO worksdetails(CustomerID, worksID) VALUES ('$customerID', '$workID')";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            echo "Error: " . mysqli_error($conn);
            return false;
        }
    }


    public function updatetinhtrang($conn, $xuly, $orderid) {
        $sql = "UPDATE orderdetails SET tinhtrang = '$xuly' WHERE OrderID = '$orderid'";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteOrder($conn, $categoyname) {
        $sql = "delete from orderdetails where OrderDetailID= '$categoyname'";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updatehuydon($conn, $xuly, $orderid) {
        $sql = "UPDATE orderdetails SET huydon = '$xuly' WHERE OrderID = '$orderid'";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($conn, $name, $email, $pass, $customerID) {
        $sql = "UPDATE customers SET CompanyName = ?, Email = ?, pass = ? WHERE customerID = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $pass, $customerID);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                return true;
            } else {
                mysqli_stmt_close($stmt);
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateDE($conn, $name, $email, $pass, $customerID) {
        $sql = "UPDATE designer SET name = ?, email = ?, password = ? WHERE designerID = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $pass, $customerID);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                return true;
            } else {
                mysqli_stmt_close($stmt);
                return false;
            }
        } else {
            return false;
        }
    }


    public function addOrderDetails($conn, $productname, $unitprice, $quantity, $image, $orderid, $cusomerID) {
        $sql = "INSERT INTO orderdetails(ProductName, UnitPrice, quantity, image, OrderID,CustomerID,tinhtrang) VALUES ('$productname',$unitprice,$quantity,'$image',$orderid,'$cusomerID','0')";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    
    }

    public function addWork($conn, $customerID, $workName, $date, $start, $end, $images) {
        $sql = "INSERT INTO works (designerID, wordname, date, startTime, endTime, images) 
            VALUES ('$customerID', '$workName', '$date', '$start', '$end', '$images')";

        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function addNews($conn,$newname,$image,$description) {
        $sql = "INSERT INTO news (newsName,image,mota) 
            VALUES ('$newname', '$image', '$description')";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }


    public function showCustomer($conn, $customerID) {
        $sql = "SELECT * FROM orderdetails WHERE CustomerID = '$customerID' ORDER BY OrderID DESC";
        $result = mysqli_query($conn, $sql);
        return $result;
    }


    public function showcus($conn, $customerID) {
        $sql = "SELECT * from customers WHERE CustomerID = '$customerID'";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    public function showDE($conn, $customerID) {
        $sql = "SELECT * from designer WHERE designerID = '$customerID'";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    public function showcontact($conn,$id) {
        $sql = "SELECT * from binhluan where newsID='$id'";
        $result = mysqli_query($conn, $sql);
        return $result;

    }
    public function showbinhluan($conn) {
        $sql = "SELECT * from binhluan";
        $result = mysqli_query($conn, $sql);
        return $result;

    }
     public function contact($conn) {
        $sql = "SELECT * from contact ";
        $result = mysqli_query($conn, $sql);
        return $result;

    }


    public function showorderdetails($conn) {
        $sql = "select * from orderdetails";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    public function showdonhang($conn) {
        $sql = "select * from orders";
        $result = mysqli_query($conn, $sql);
        return $result;
    }
}
