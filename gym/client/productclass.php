<?php

class productclass {

    public function showAllcategory($conn) {
        $sql = "SELECT * from category order by categoryID ASC";
        $result = $conn->query($sql);
        return $result;
    }



    public function showslider($conn) {
        $sql = "SELECT * FROM slider";
        $result = $conn->query($sql);
        return $result;
    }
    public function showsAllnews($conn) {
        $sql = "SELECT * FROM news";
        $result = $conn->query($sql);
        return $result;
    }

        public function shownews($conn) {
        $sql = "SELECT * from news";
        $result = $conn->query($sql);
        return $result;
    }

    public function showWork($conn) {
        $sql = "SELECT * from works";
        $result = $conn->query($sql);
        return $result;
    }

    public function showALLbrand($conn) {
        $sql = "SELECT * from brand order by brandID ASC";
        $result = $conn->query($sql);
        return $result;
    }

    public function showAllbrand1($conn, $brandID) {
        $sql = "SELECT p.ProductID, p.ProductName, p.Image, p.UnitPrice
            FROM Products p
            INNER JOIN brand b ON p.brandID = b.brandID
            WHERE b.brandID = '$brandID'";
        $result = $conn->query($sql);
        return $result;
    }

    public function showAllProducts($conn, $categoryID) {
        $sql = "SELECT ProductID, ProductName, Image, UnitPrice FROM Products where categoryID='$categoryID'";
        $result = $conn->query($sql);
        return $result;
    }

    public function show($conn) {
        $sql = "SELECT ProductID, ProductName, Image, UnitPrice FROM Products ";
        $result = $conn->query($sql);
        return $result;
    }

    public function searchProducts($conn, $keyword) {
        $sql = "SELECT ProductID, ProductName, UnitPrice, Image, mota, CategoryID FROM products WHERE ProductName LIKE '%$keyword%'";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    public function showAllwive($conn) {
        $sql = "SELECT *
FROM Products where hot = 1 ";

        $result = $conn->query($sql);
        return $result;
    }

    public function findProductsbyID($conn, $id) {
        $sql = "select ProductID, ProductName, UnitPrice,brandName, Image, motaa from products
        INNER JOIN brand ON products.brandID = brand.brandID
         where ProductID = $id";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result);
    }
   public function findnewsbyID($conn, $id) {
    $sql = "SELECT * FROM news WHERE newsID = $id";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false; // Return false if the news item is not found
    }
}
      public function findnewsRange($conn, $strIds) {
        $stmt = $conn->prepare("SELECT * FROM news WHERE newsID IN ($strIds)");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function findProductsRange($conn, $strIds) {
        $stmt = $conn->prepare("SELECT ProductID, ProductName, image, UnitPrice FROM products WHERE ProductID IN ($strIds)");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
