<?php

class CustomerClass {

    public function addCustomer($conn, $uname,$email, $pword) {
        $sql = "insert into customers (CompanyName,email,pass) values ('$email','$uname','$pword')";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
}
