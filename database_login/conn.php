<?php
$conn = mysqli_connect('localhost', 'root', '');
if(!$conn){
    echo 'Connection error:' . mysqli_connect_error();
}

//CREATE DATABASE
$sql_createDatabase = "CREATE DATABASE IF NOT EXISTS zdravie1";
mysqli_query($conn, $sql_createDatabase);
$sql_use = "USE zdravie1";
mysqli_query($conn, $sql_use);

//Vytvorenie tabuliek
require 'basics.php';





?>