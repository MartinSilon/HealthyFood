<?php
require '../database_login/conn.php';

$item = $_GET['item'];

$sql = "SELECT jedla.druh, druh.druh
        FROM druh
        JOIN jedla ON druh.id = jedla.druh
        WHERE jedla.nazov = '$item'
        LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 while ($row = $result->fetch_assoc()) {
  $druh = $row['druh'];
 }
}
echo htmlspecialchars($item);


if($druh == "napoj"){
     $sql = "INSERT INTO jedla (nazov, objem, druh, datum)
            SELECT nazov, objem, druh, CURRENT_DATE()
            FROM jedla
            WHERE (nazov, objem) = (
                SELECT nazov, objem
                FROM jedla
                WHERE nazov = '$item'
                GROUP BY nazov, objem
                ORDER BY COUNT(*) DESC
                LIMIT 1
            ) LIMIT 1";

     mysqli_query($conn, $sql);
    header("Location: ../lobby.php");
}
else{
 $sql = "INSERT INTO jedla (nazov, kalorie, bielkoviny, sacharidy, druh, datum)
         SELECT nazov, kalorie, bielkoviny, sacharidy, druh, CURRENT_DATE()
         FROM jedla
         WHERE (nazov, kalorie, bielkoviny, sacharidy, druh) = (
             SELECT nazov, kalorie, bielkoviny, sacharidy, druh
             FROM jedla
             WHERE nazov = '$item'
             GROUP BY nazov, kalorie, bielkoviny, sacharidy, druh
             ORDER BY COUNT(*) DESC
             LIMIT 1
         ) LIMIT 1";;

 mysqli_query($conn, $sql);
 header("Location: ../lobby.php");
}


?>
