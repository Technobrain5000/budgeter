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
                    <th>Titel</th>
                    <th>Beschreibung</th>
                    <th>Zeitpunkt</th>
                    <th>Ort</th>
                </tr>
                <?php

                error_reporting(0);

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "budgeter";
                
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM `agenda` ";
                $result = $conn->query($sql);

                if (!$result) {
                    trigger_error('Invalid query: ' . $conn->error);
                }

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>".$row["Titel"]."</td>
                        <td>".$row["Beschreibung"]."</td>
                        <td>".$row["Zeitpunkt"]."</td>
                        <td>".$row["Ort"]."</td>
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