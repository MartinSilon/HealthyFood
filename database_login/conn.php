<?php

$conn = mysqli_connect('edudb-02.nameserver.sk', 'martinsiloncgp_s', 'Ka4ydmek');
//mysqli_set_charset($conn,"utf8");

if(!$conn){
    echo 'Connection error:' . mysqli_connect_error();
}

//CREATE DATABASE
$sql_createDatabase = "CREATE DATABASE IF NOT EXISTS zdravie1";
mysqli_query($conn, $sql_createDatabase);
$sql_use = "USE zdravie1";
mysqli_query($conn, $sql_use);


$sql_createTable = "
        CREATE TABLE IF NOT EXISTS druh (
            id TINYINT(1),
            druh CHAR(5),
            PRIMARY KEY (id)
        );
    ";
mysqli_query($conn, $sql_createTable);

$sql_insertData = "
        INSERT INTO druh (id, druh) 
            SELECT * FROM (SELECT '1', 'jedlo') AS tmp
            WHERE NOT EXISTS (
                SELECT id FROM druh WHERE id = '1'
            )
        UNION ALL
            SELECT * FROM (SELECT '2', 'napoj') AS tmp
            WHERE NOT EXISTS (
                SELECT id FROM druh WHERE id = '2'
            )
        ";
mysqli_query($conn, $sql_insertData);

$datum = date('Y-m-d');;

?>