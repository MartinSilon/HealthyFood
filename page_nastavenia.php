<?php
session_start();
require 'database_login/conn.php';
require 'head.php';
require 'nav.php';

// --->     Overovanie EMAILU z DB a preloženie na ID    <---
require 'config/email_check.php';

require  'database_login/select.php';


if(isset($_POST['max_kalorie']) || isset($_POST['max_sacharidy']) ||  isset($_POST['max_bielkoviny']) || isset($_POST['max_voda'])){
    $max_kalorie = $_POST['max_kalorie'];
    $max_sacharidy = $_POST['max_sacharidy'];
    $max_bielkoviny = $_POST['max_bielkoviny'];
    $max_voda = $_POST['max_voda'];


    $sql = "SELECT id_uzivatela FROM udaje JOIN uzivatelia ON udaje.id_uzivatela = uzivatelia.id WHERE uzivatelia.id = $id_uzivatela";  //Ak neexistuje záznam tak sa insertnú nové dáta
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {   //Ak dáta už existujú tak sa budu len upravovať, aby sa nezahlcovala DATABAZA
        //INSERT do ÚDAJE
        $sql_insertData = "
            INSERT INTO udaje (id_uzivatela, max_kalorie, max_bielkoviny, max_sacharidy, max_voda) 
                VALUES
                ('$id_uzivatela','1200','100' ,'120', '2.5');
        ";
        mysqli_query($conn, $sql_insertData);
    }

    $sql_updateData = "
    UPDATE udaje
        JOIN uzivatelia ON udaje.id_uzivatela = uzivatelia.id
        SET 
            max_kalorie = '$max_kalorie',
            max_bielkoviny = '$max_bielkoviny',
            max_sacharidy = '$max_sacharidy',
            max_voda = '$max_voda'
        WHERE uzivatelia.id = '$id_uzivatela'
        ";
    mysqli_query($conn, $sql_updateData);

    header("Location: index.php?email=$email");
}

?>
<html>
<body>
<section class="pridanieItem d-flex justify-content-center align-items-center h-100 w-100">
    <div class="container w-50">
            <div class="row h-100">
                <div class="col-12 h-100 d-flex justify-content-center align-items-center">
                    <form method="POST">
                        <label class="big white text-uppercase text-center fw-bold mb-3">Nastavenia:</label><br>
                        <input class="w-100 py-1 mb-4 smaller" type="number" id="max_kalorie" name="max_kalorie" value="<?php echo $max_kalorie ?>"><br>
                        <input class="w-100 py-1 mb-4 smaller" type="number" id="max_sacharidy" name="max_sacharidy" value="<?php echo $max_sacharidy ?>"><br>
                        <input class="w-100 py-1 mb-4 smaller" type="number" id="max_bielkoviny" name="max_bielkoviny" value="<?php echo $max_bielkoviny ?>"><br>
                        <input class="w-100 py-1 mb-4 smaller" type="number" step="any" id="max_voda" name="max_voda" value="<?php echo $max_voda ?>"><br>
                        <input class="w-100 py-2 fw-bold mt-5 text-uppercase submit smaller" type="submit" value="Pridať">
                    </form>
                </div>
            </div>
    </div>
</section>
</body>
</html>




