<?php
    $servername="localhost";
    $dbname="booking_app";
    $username="root";
    $password="Nik99sql";

    $conn=mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn)
    {
      die("Connection failed".mysqli_connect_error());
    }
    //echo "Connected successfully....";
    return 1;
?>