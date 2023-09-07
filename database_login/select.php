<?php

$sql = "SELECT max_kalorie, max_sacharidy, max_bielkoviny, max_voda FROM udaje JOIN uzivatelia ON udaje.id_uzivatela = uzivatelia.id WHERE uzivatelia.id = ?";
$stmp = $conn->prepare($sql);
$stmp->bind_param("i", $id_uzivatela); // 'i' pro celé číslo
$stmp->execute();
$stmp->bind_result($max_kalorie, $max_sacharidy, $max_bielkoviny, $max_voda);

if (!$stmp->fetch()) {
    $max_bielkoviny = 100;
    $max_sacharidy = 120;
    $max_voda = 2.5;
    $max_kalorie = 1200;
}

$stmp->close();
