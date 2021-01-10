<?php
    $server="127.0.0.1";
    $username="root";
    $password="";
    $dbname="budgeter";

    $conn = mysqli_connect($server, $username, $password, $dbname);

    if(!$conn) {
        echo 'Connection failed!';
    }

    $art = $_POST['ta'];
    $kategorie = $_POST['kat'];
    $bei = $_POST['bei'];
    $beschreibung = $_POST['besch'];
    $preismodell = $_POST['pm'];
    $option = $_POST['bezopt'];
    $preis = $_POST['pr'];
    $datum = $_POST['dat'];
    $next = $_POST['nxt'];

    if($next=="") {
        $sql = "INSERT INTO transactions (Transaktionsart, Kategorie, Verkaeufer, Beschreibung, Preismodell, Bezahloption, Preis, Kaufdatum) VALUES ('$art','$kategorie','$bei','$beschreibung','$preismodell','$option','$preis','$datum')";
    } elseif($bei=="none") {
        $sql = "INSERT INTO transactions (Transaktionsart, Kategorie, Beschreibung, Preismodell, Bezahloption, Preis, Kaufdatum, Faelligkeitsdatum) VALUES ('$art','$kategorie','$beschreibung','$preismodell','$option','$preis','$datum','$next')";
    } else {
        $sql = "INSERT INTO transactions (Transaktionsart, Kategorie, Verkaeufer, Beschreibung, Preismodell, Bezahloption, Preis, Kaufdatum, Faelligkeitsdatum) VALUES ('$art','$kategorie','$bei','$beschreibung','$preismodell','$option','$preis','$datum','$next')";
    }

    $run = mysqli_query($conn,$sql);

    if($run) {
        echo "Successfully";
    } else {
        echo "Form not submitted";
    }

    //header("refresh:1; url=index.html");
?>