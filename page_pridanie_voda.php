<?php
require 'database_login/conn.php';
require 'head.php';
require 'nav.php';
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
                    <label class="big white text-uppercase fw-bold mb-3">Pridanie vody: </label><br>
                    <input class="w-100 py-1 mb-4 smaller" type="text" id="name_voda" name="name_voda" placeholder="Meno"><br>
                    <input class="w-100 py-1 mb-4 smaller" type="number" step="any" id="objem" name="objem" placeholder="Vypitý objem vody"><br>
                    <input class="w-100 py-2 fw-bold mt-5 text-uppercase submit smaller" type="submit" value="Pridať">
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 text-center d-flex justify-content-around">
                <?php
                $sql = "SELECT jedla.nazov, COUNT(*) AS pocet_opakovani
                            FROM jedla
                            JOIN druh ON jedla.druh = druh.id
                            WHERE druh.druh = 'napoj'
                            GROUP BY jedla.nazov
                            ORDER BY pocet_opakovani DESC
                            LIMIT 4;";
                $result = $conn->query($sql);
                $riadok = 0;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <a class="w-100 d-flex justify-content-around" href="config/conf_item.php?item=<?php echo $row["nazov"];?>"><div class="p-1 mb-2 item w-75">
                                <p class="p-0 m-0 smaller"><?php echo $row["nazov"];?></p>
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



