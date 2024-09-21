<?php

class myconnection {
    public static function connectDatabase() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "db_decorvistaa";
        //Ket nối CSQL
        $conn = mysqli_connect($servername, $username, $password, $database) or die("Connection failed: " . mysqli_connect_error());
        return $conn;
    }
}
