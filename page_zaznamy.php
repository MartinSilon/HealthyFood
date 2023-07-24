<html>
<?php
session_start();
require 'database_login/conn.php';
require 'head.php';
require 'nav.php';
?>

<body>
<section class="mt-5 zaznamy d-flex justify-content-center align-items-center h-100 w-100">
    <div class="container mw-100 h-100">
        <div class="row">
            <div class="col-12">
                <h3 class="big mt-5 pt-5 mb-3 fw-bold text-uppercase text-center">Záznamy</h3>
                <?php
                $sql = "SELECT 
                        jedla.nazov,
                        jedla.objem,
                        jedla.kalorie,
                        jedla.bielkoviny,
                        jedla.sacharidy,
                        jedla.druh,
                        jedla.cas_vytvorenia,
                        druh.druh
                        FROM jedla
                        JOIN druh ON jedla.druh = druh.id
                        ORDER BY cas_vytvorenia DESC;
                    ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='w-100  text-center'>";
                    echo "<tr class='trMain p-2'><th>Názov</th><th>Objem [vody]</th><th>Kalórie</th><th>Bielkoviny</th><th>Sacharidy</th><th>Druh</th><th>Čas vytvorenia</th></tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='w-100 mt-3'>";
                        echo "<td>" . $row['nazov'] . "</td>";
                        echo "<td>" . $row['objem'] . "</td>";
                        echo "<td>" . $row['kalorie'] . "</td>";
                        echo "<td>" . $row['bielkoviny'] . "</td>";
                        echo "<td>" . $row['sacharidy'] . "</td>";
                        echo "<td>" . $row['druh'] . "</td>";
                        echo "<td>" . $row['cas_vytvorenia'] . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<p class='text-center'>Nenašli sa záznamy.</p>";
                }

                ?>
            </div>
        </div>
    </div>
</section>
</body>
</html>



