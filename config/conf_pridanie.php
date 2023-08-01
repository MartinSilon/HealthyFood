<?php
require '../database_login/conn.php';

session_start();
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//CREATE TABLE
$sql_createTable = "
        CREATE TABLE IF NOT EXISTS jedla (
            id INT AUTO_INCREMENT,
            nazov VARCHAR(15),
            kalorie SMALLINT,
            bielkoviny TINYINT,
            sacharidy TINYINT,
            objem DECIMAL(3,2),
            druh TINYINT(1),
            datum DATE,
            cas_vytvorenia TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        );
        
    ";
mysqli_query($conn, $sql_createTable);



if (isset($_POST['name']) && isset($_POST['protein']) && isset($_POST['sacharidy'])) {
    $nazov = validate($_POST['name']);
    $kalorie = validate($_POST['kcal']);
    $bielkoviny = validate($_POST['protein']);
    $sacharidy = validate($_POST['sacharidy']);

    $sql_insertData = "
        INSERT INTO jedla (nazov, kalorie, bielkoviny, sacharidy, datum, druh) 
            VALUES
            ('$nazov','$kalorie' ,'$bielkoviny', '$sacharidy', '$datum', '1');
        ";
    mysqli_query($conn, $sql_insertData);
    header("Location: ../index.php");

} else {
    if (isset($_POST['name_voda']) && isset($_POST['objem']) && $_POST['objem']!="" && $_POST['name_voda']!="") {
        $nazov = validate($_POST['name_voda']);
        $objem = validate($_POST['objem']);

        $sql_insertData = "
        INSERT INTO jedla (nazov, objem, datum, druh) 
            VALUES
            ('$nazov','$objem', '$datum','2');
        ";
        mysqli_query($conn, $sql_insertData);
        header("Location: ../index.php");
    }else{
        header("Location: ../page_pridanie_voda.php?Chyba");
    }


}

?>

