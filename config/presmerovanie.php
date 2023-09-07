<?php
session_start();
$email = $_SESSION['email'];
header("Location: ../page_nastavenia.php?email=$email"); //Presmerovanie na vlastné konto
exit();
?>
