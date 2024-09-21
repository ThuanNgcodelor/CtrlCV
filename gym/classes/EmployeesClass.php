<?php

class EmployeesClass {
    private $email;
    private $password;
    private $role;
        private $customerID;

    
    public function checkLogin($conn, $email, $pword) {
        $sql = "SELECT * FROM customers WHERE email='$email' AND pass='$pword'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function checkDe($conn, $email, $pword) {
        $sql = "SELECT * FROM designer WHERE email='$email' AND password='$pword'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result);
    }

   

     public function adminlogin($conn) {
        $sql = "SELECT CustomerID,CompanyName,email,pass FROM customers where role=0";
        $result = $conn->query($sql);
        return $result;
    }
    
}
