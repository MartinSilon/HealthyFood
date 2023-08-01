<?php
$sql = "SELECT max_kalorie, max_sacharidy, max_bielkoviny, max_voda FROM udaje";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $max_kalorie = $row["max_kalorie"];
    $max_sacharidy = $row["max_sacharidy"];
    $max_bielkoviny = $row["max_bielkoviny"];
    $max_voda = $row["max_voda"];
} else {
    echo "Žádný záznam nebyl nalezen.";
}
