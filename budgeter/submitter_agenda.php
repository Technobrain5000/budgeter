<?php
    $server="127.0.0.1";
    $username="root";
    $password="";
    $dbname="budgeter";

    $conn = mysqli_connect($server, $username, $password, $dbname);

    if(!$conn) {
        echo 'Connection failed!';
    }

    $title = $_POST['title'];
    $besch = $_POST['besch'];
    $time = $_POST['time'];
    $place = $_POST['place'];
    $color = $_POST['color'];

    $sql = "INSERT INTO agenda (Titel, Beschreibung, Zeitpunkt, Ort, color) VALUES ('$title','$besch','$time','$place','$color')";

    $run = mysqli_query($conn,$sql);

    if($run) {
        echo "Successfully";
    } else {
        echo "Form not submitted";
    }

    header("refresh:1; url=index.html");
?>