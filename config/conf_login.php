<?php
session_start();
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (empty($_POST['pass'])) {
    header("Location: ../page_login.php?error=Zadaj heslo.");
    exit();
}

if (isset($_POST['pass'])) {
    $password = validate($_POST['pass']);
    $correct_password = "o";

    if ($password === $correct_password) {
        $_SESSION['login'] = 1;
        header("Location: ../lobby.php");
    } else {
        header("Location: ../page_login.php?error=Zle heslo.");
        exit();
    }
}

?>

