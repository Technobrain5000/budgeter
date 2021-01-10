<!DOCTYPE html>
<html lang="de-CH">
    <head>
        <title>Budget Rechner</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <div id="show_table">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Transaktionsart</th>
                    <th>Kategorie</th>
                    <th>Verkäufer</th>
                    <th>Beschreibung</th>
                    <th>Preismodell</th>
                    <th>Bezahloption</th>
                    <th>Preis</th>
                    <th>Kaufdatum</th>
                    <th>Fälligkeitsdatum</th>
                </tr>
                <?php

                error_reporting(0);

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "budgeter";

                $art_in = $_POST['tae'];
                $art_out = $_POST['taa'];
                $kat = $_POST['kat'];
                $bei = $_POST['bei'];
                $besch = $_POST['besch'];
                $prm = $_POST['pm'];
                $opt = $_POST['bezopt'];
                $pr_von = $_POST['pr_von'];
                $pr_bis = $_POST['pr_bis'];
                $von = $_POST['von'];
                $bis = $_POST['bis'];
                $ord = $_POST['ord'];
                $sr = $_POST['sr'];
                
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if($art_in!="") {
                    $art_in_query = "`Transaktionsart` = '$art_in'";
                } else {
                    $art_in_query = "`Transaktionsart` = ''";
                }

                if($art_out!="") {
                    $art_out_query = "`Transaktionsart` = '$art_out'";
                } else {
                    $art_out_query = "`Transaktionsart` = ''";
                }

                if($kat!="none") {
                    $kat_query = "`Kategorie` = '$kat'";
                } else {
                    $kat_query = "`Kategorie` != ''";
                }

                if($bei!="none") {
                    $bei_query = "`Verkaeufer` = '$bei'";
                } else {
                    $bei_query = "`Verkaeufer` != ''";
                }

                if($besch!="") {
                    $besch_query = "`Beschreibung` LIKE '%$besch%'";
                } else {
                    $besch_query = "`Beschreibung` != ''";
                }

                if($prm!="") {
                    $prm_query = "`Preismodell` = '$prm'";
                } else {
                    $prm_query = "`Preismodell` != ''";
                }

                if($opt!="none") {
                    $opt_query = "`Bezahloption` = '$opt'";
                } else {
                    $opt_query = "`Bezahloption` != ''";
                }

                if($pr_von!="") {
                    $pr_von_query = $pr_von;
                } else {
                    $pr_von_query = 0;
                }

                if($pr_bis!="") {
                    $pr_bis_query = $pr_bis;
                } else {
                    $pr_bis_query = 9999999;
                }

                if($von!="") {
                    $von_query = '$von';
                } else {
                    $von_query = '2000-01-01 00:00:00';
                }

                if($bis!="") {
                    $bis_query = '$bis';
                } else {
                    $bis_query = '3000-12-31 23:59:59';
                }

                $sql = "SELECT * FROM `transactions` WHERE $art_in_query OR $art_out_query AND $kat_query AND $bei_query AND $besch_query AND $prm_query AND $opt_query AND `Preis` BETWEEN '$pr_von_query' AND '$pr_bis_query' AND `Kaufdatum` BETWEEN '$von_query' AND '$bis_query' ORDER BY `$ord` $sr";
                $result = $conn->query($sql);

                if (!$result) {
                    trigger_error('Invalid query: ' . $conn->error);
                }

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>".$row["ID"]."</td>
                        <td>".$row["Transaktionsart"]."</td>
                        <td>".$row["Kategorie"]."</td>
                        <td>".$row["Verkaeufer"]."</td>
                        <td>".$row["Beschreibung"]."</td>
                        <td>".$row["Preismodell"]."</td>
                        <td>".$row["Bezahloption"]."</td>
                        <td>".$row["Preis"]."</td>
                        <td>".$row["Kaufdatum"]."</td>
                        <td>".$row["Faelligkeitsdatum"]."</td>
                        </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 Results";
                }

                $conn->close();
                ?>
            </table>
        </div>
    </body>
</html>