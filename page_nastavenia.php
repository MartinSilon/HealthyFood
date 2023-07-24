<?php
session_start();

require 'database_login/conn.php';
require 'head.php';
require 'nav.php';

if(isset($_POST['max_kalorie']) || isset($_POST['max_sacharidy']) ||  isset($_POST['max_b']) || isset($_POST['max_voda'])){
    $_SESSION['max_bielkoviny'] = $_POST['max_b'];
    $_SESSION['max_kalorie'] = $_POST['max_kalorie'];
    $_SESSION['max_sacharidy'] = $_POST['max_sacharidy'];
    $_SESSION['max_voda'] = $_POST['max_voda'];

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
                        <label class="big white text-uppercase text-center fw-bold mb-3">Nastavenia: </label><br>
                        <input class="w-100 py-1 mb-4 smaller" type="number" id="max_kalorie" name="max_kalorie" placeholder="Splniteľný cieľ kalórií"><br>
                        <input class="w-100 py-1 mb-4 smaller" type="number" id="max_sacharidy" name="max_sacharidy" placeholder="Splniteľný cieľ sacharidov"><br>
                        <input class="w-100 py-1 mb-4 smaller" type="number" id="max_b" name=max_b" placeholder="Splniteľný cieľ bielkovín"><br>
                        <input class="w-100 py-1 mb-4 smaller" type="number" step="any" id="max_voda" name="max_voda" placeholder="Splniteľný cieľ vypitej vody"><br>
                        <input class="w-100 py-2 fw-bold mt-5 text-uppercase submit smaller" type="submit" value="Pridať">
                    </form>
                </div>
            </div>
    </div>
</section>
</body>
</html>




