<?php

// --->     Overovanie EMAILU z DB     <---
if(isset($_GET['email'])){
    $email = $_GET['email'];
    $sql = "SELECT id FROM uzivatelia WHERE email = ?";
    $stmp = $conn->prepare($sql);
    $stmp->bind_param("s",$email);
    $stmp->execute();
    $stmp->bind_result($ziskaneID);

    if($stmp->fetch()){
        $id_uzivatela = $ziskaneID; //Preloženie EMAILU na ID uživateľa
        $stmp->close();
    }

}

?>