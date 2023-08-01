<?php
session_start();

require 'database_login/conn.php';
require 'head.php';
require 'nav.php';
require  'database_login/select.php';


if(isset($_POST['max_kalorie']) || isset($_POST['max_sacharidy']) ||  isset($_POST['max_bielkoviny']) || isset($_POST['max_voda'])){
    $max_kalorie = $_POST['max_kalorie'];
    $max_sacharidy = $_POST['max_sacharidy'];
    $max_bielkoviny = $_POST['max_bielkoviny'];
    $max_voda = $_POST['max_voda'];


    $sql_updateData = "
    UPDATE udaje
        SET 
            max_kalorie = '$max_kalorie',
            max_bielkoviny = '$max_bielkoviny',
            max_sacharidy = '$max_sacharidy',
            max_voda = '$max_voda'
        WHERE 
            id = 1;
        ";
    mysqli_query($conn, $sql_updateData);
    header("Location: index.php");
}else {

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




