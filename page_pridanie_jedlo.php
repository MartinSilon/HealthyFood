<?php
require 'database_login/conn.php';
require 'head.php';
require 'nav.php';
// --->     Overovanie EMAILU z DB a preloženie na ID    <---
require 'config/email_check.php';
?>
<html>
<body>
<section class="pridanieItem d-flex justify-content-center align-items-center h-100 w-100">
    <div class="container w-100">
        <div class="row">
            <div class="col-12 text-center">
                <form method="POST" action="config/conf_pridanie.php">
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error fs-5"><?php echo htmlspecialchars($_GET['error']); ?></p>
                    <?php } ?>
                    <label class="white text-uppercase fw-bold big">Pridanie jedla: </label><br>
                    <input class="w-100 py-1 mb-4 smaller" type="text" id="name" name="name" placeholder="Meno"><br>
                    <input class="w-100 py-1 mb-4 smaller" type="number" id="kcal" name="kcal" placeholder="Počet kalórií"><br>
                    <input class="w-100 py-1 mb-4 smaller" type="number" id="protein" name="protein" placeholder="Počet bielkovín"><br>
                    <input class="w-100 py-1 mb-4 smaller" type="number" id="sacharidy" name="sacharidy" placeholder="Počet sacharidov"><br>
                    <input class="w-100 py-2 fw-bold mt-5 text-uppercase submit  smaller" type="submit" value="Pridať">
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 text-center d-flex justify-content-around">
                <?php
                $sql = "SELECT jedla.nazov, COUNT(*) AS pocet_opakovani
                            FROM jedla
                            JOIN druh ON jedla.druh = druh.id
                            WHERE druh.druh = 'jedlo' AND jedla.id_uzivatela = '$id_uzivatela'
                            GROUP BY jedla.nazov
                            ORDER BY pocet_opakovani DESC
                            LIMIT 4;";
                $result = $conn->query($sql);
                $riadok = 0;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <a class="w-100 d-flex justify-content-around" href="config/conf_item.php?item=<?php echo $row["nazov"];?>"><div class="p-1 mb-2 item w-75">
                                <p class="p-0 m-0  smaller"><?php echo $row["nazov"];?></p>
                            </div></a>
                        <?php
                        $riadok++;
                        if ($riadok >= 4){
                            break;
                        }
                    }
                }
                ?>
                </a>
            </div>
        </div>
    </div>
</section>
</body>
</html>



