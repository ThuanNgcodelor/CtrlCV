<?php

class RegionClass {

    private $regionID;
    private $regionDescription;

//Chỉnh sữa xóa sp
    
     public function addnews($conn, $newsname, $image, $mota) {
        $sql = "INSERT INTO news (newsName,image, mota) VALUES ('$newsname','$image','$mota')";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deletenews($conn, $newsID) {
        $sql = "delete from news where newsID='$newsID'";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
     public function findnewsID($conn, $newsID) {
        $sql = "SELECT * FROM news WHERE newsID ='$newsID'";
        $region = mysqli_query($conn, $sql);
        echo mysqli_num_rows($region);
        return mysqli_fetch_assoc($region);
    }
       public function updatenews($conn, $newsID, $newsname, $image, $mota) {
        $sql = "UPDATE news SET newsName='$newsname',image='$image',mota='$mota' where newsID='$newsID'";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    
    public function showAllRegion($conn) {
        $sql = "SELECT *  FROM products
        INNER JOIN brand ON products.brandID = brand.brandID
        INNER JOIN category ON products.categoryID = category.categoryID";
        $result = mysqli_query($conn, $sql);
        return $result;
    }
    
     public function showre($conn) {
        $sql = "SELECT *  FROM products ";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    public function addRegion($conn, $productName, $unitPrice, $image, $mota, $phanloai, $hot, $brand) {
        $sql = "INSERT INTO products (ProductName, UnitPrice, image, motaa, CategoryID, hot, brandID) VALUES ('$productName', '$unitPrice', '$image', '$mota', '$phanloai', '$hot', '$brand')";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteRegion($conn, $productName) {
        $sql = "delete from products where ProductName='$productName'";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deletebrand($conn, $brandname) {
        $sql = "delete from brand where brandName='$brandname'";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateRegion($conn, $ProductID, $unitprice, $image, $mota, $phanloai, $brand, $hot, $productname) {
        $sql = "UPDATE products SET ProductName = '$productname', UnitPrice = '$unitprice', image = '$image', motaa = '$mota', CategoryID = '$phanloai', brandID = '$brand', hot = '$hot' WHERE ProductID = '$ProductID'";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    //Chỉnh sữa xóa sp

    public function addcontact($conn, $name, $email, $phone, $gopy) {
        $sql = "INSERT INTO contact(Name,Email,phone,gopy) VALUES ('$name','$email',$phone,'$gopy')";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
 
    public function addbinnhluan($conn, $name, $email, $gopy, $newsID) {
    $sql = "INSERT INTO binhluan (Name, Email, gopy, newsID) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $gopy, $newsID);
    
    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}
    
    public function addslider($conn, $slidername, $image) {
        $sql = "INSERT INTO slider(sliderName,image) values ('$slidername','$image')";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function addbrand($conn, $brandname, $mota) {
        $sql = "INSERT INTO brand(brandName,mota) values ('$brandname','$mota')";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function addcategory($conn, $categoryname, $mota) {
        $sql = "INSERT INTO category(categoryName,mota) VALUES ('$categoryname','$mota')";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deletecategory($conn, $categoyID) {
        $sql = "delete from category where categoryID='$categoyID'";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteslider($conn, $categoyname) {
        $sql = "delete from slider where sliderName= '$categoyname'";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCategory($conn, $categoryName, $mota, $categoryID) {
        $sql = "UPDATE category SET categoryName = '$categoryName', mota = '$mota' WHERE categoryID = '$categoryID'";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateBrand($conn, $brandname, $mota, $brandID) {
        $sql = "UPDATE brand SET brandName = '$brandname', mota = '$mota' WHERE brandID = '$brandID'";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function findBrandID($conn, $brandID) {
        $sql = "SELECT * FROM brand WHERE brandID ='$brandID'";
        $region = mysqli_query($conn, $sql);
        echo mysqli_num_rows($region);
        return mysqli_fetch_assoc($region);
    }

    public function findRegionbyID($conn, $productID) {
        $sql = "SELECT * FROM products WHERE ProductID ='$productID'";
        $region = mysqli_query($conn, $sql);
        echo mysqli_num_rows($region);
        return mysqli_fetch_assoc($region);
    }

    public function findcategorybyID($conn, $id) {
        $sql = "SELECT * FROM category WHERE categoryID = '$id'";
        $region = mysqli_query($conn, $sql);
        echo mysqli_num_rows($region);
        return mysqli_fetch_assoc($region);
    }

    public function findRegionbyName($conn, $keyword) {
        $sql = "SELECT * FROM products
        INNER JOIN category ON products.categoryID = category.categoryID
         WHERE ProductName LIKE '%$keyword%'";
        $region = mysqli_query($conn, $sql);
        $listRegion = array();
        while ($row = mysqli_fetch_assoc($region)) {
            $listRegion[] = $row;
        }
        return $listRegion;
    }

    public function get_regionID() {
        return $this->regionID;
    }

    public function get_regionDescription() {
        return $this->regionDescription;
    }

    public function set_regionID($regionID): void {
        $this->regionID = $regionID;
    }

    public function set_regionDescription($regionDescription): void {
        $this->regionDescription = $regionDescription;
    }
}
