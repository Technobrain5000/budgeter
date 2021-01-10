<?php
    $server="127.0.0.1";
    $username="root";
    $password="";
    $dbname="budgeter";

    $conn = mysqli_connect($server, $username, $password, $dbname);

    if(!$conn) {
        echo 'Connection failed!';
    }

    $id = $_POST['id'];
    $spalte = $_POST['spalte'];
    $alter = $_POST['alter'];

    $sql = "UPDATE `transactions` SET `$spalte` = '$alter' WHERE `transactions`.`ID` = $id;";

    echo $id;
    echo $spalte;
    echo $alter;

    $run = mysqli_query($conn,$sql);

    if($run) {
        echo "Successfully";
    } else {
        echo "Form not submitted";
    }

    header("refresh:1; url=index.html");
?>