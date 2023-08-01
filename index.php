<html>
<?php
session_start();
require 'database_login/conn.php';
require 'head.php';
require 'nav.php';
require 'database_login/select.php';

$suma_bielkoviny = 0;
$suma_sacharidy = 0;
$suma_voda = 0;

function done_b($x, $y) {
    if ($x >= $y) {
        echo "done_class";
    }
}

?>

<body>
<section class="lobby d-flex justify-content-center align-items-center h-100 w-100">
    <div class="container h-100 p-0 m-0">
        <div class="row h-50">
            <div class="one col-lg-6 col-sm-12 text-center d-flex align-items-center justify-content-center p-0">
                <a class="w-100" href="page_zaznamy.php">
                    <?php
                    $sql = "SELECT bielkoviny
                                FROM jedla
                                JOIN druh ON jedla.druh = druh.id
                                WHERE druh.druh = 'jedlo' AND jedla.datum = '$datum'";
                    $result = $conn->query($sql);

                    $hodnoty = array();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $hodnoty[] = $row["bielkoviny"];
                        }
                        $suma_bielkoviny = array_sum($hodnoty);

                    }
                    ?>
                    <div class="<?php done_b($suma_bielkoviny, $max_bielkoviny); ?> objekt w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                        <h3 class="text-uppercase fs-1 fw-bold">Bielkoviny</h3>
                        <p class="done fs-1"><?php echo $suma_bielkoviny . " g / $max_bielkoviny"?> g</p>
                    </div>
                </a>
            </div>
            <div class="two col-lg-6 col-sm-12 text-center d-flex align-items-center justify-content-center p-0">
                <a class="w-100" href="page_zaznamy.php">
                    <?php
                    $sql = "SELECT sacharidy FROM jedla JOIN druh ON jedla.druh = druh.id
                                WHERE druh.druh = 'jedlo' AND jedla.datum = '$datum'";
                    $result = $conn->query($sql);

                    $hodnoty = array();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $hodnoty[] = $row["sacharidy"];
                        }
                        $suma_sacharidy = array_sum($hodnoty);
                    }
                    ?>
                    <div class="<?php done_b($suma_sacharidy, $max_sacharidy); ?> objekt w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                        <h3 class="text-uppercase fw-bold fs-1">Sacharidy</h3>
                        <p class="ciel fs-1"><?php echo $suma_sacharidy . " g / $max_sacharidy"?> g</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="row h-50">
            <div class="three col-lg-6 col-sm-12 text-center d-flex align-items-center justify-content-center p-0">
                <a class="w-100" href="page_zaznamy.php">
                    <?php
                    $sql = "SELECT jedla.objem, druh.druh
                                FROM jedla
                                JOIN druh ON jedla.druh = druh.id
                                WHERE druh.druh = 'napoj' AND jedla.datum = '$datum'";
                    $result = $conn->query($sql);

                    $hodnoty = array();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $hodnoty[] = $row["objem"];
                        }
                        $suma_voda = array_sum($hodnoty);
                    }

                    ?>
                    <div class="<?php done_b($suma_voda, $max_voda); ?> objekt w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                        <h3 class="text-uppercase fw-bold fs-1">Vypité litre vody</h3>
                        <p class="ciel fs-1"><?php echo $suma_voda . " l / $max_voda"?> l</p>
                    </div>
                </a>
            </div>

            <div class="four col-lg-6 col-sm-12 text-center d-flex align-items-center justify-content-center p-0">
                <a href="page_pridanie.php">
                <div class="objekt w-100 h-100 d-flex align-items-center justify-content-center">
                    <h3 class="text-uppercase fw-bold fs-1">Pridať údaje</h3>
                </div>
                </a>
            </div>

        </div>
    </div>
</section>
</body>
</html>


