<?php
    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $servername = "localhost";
        $pass = "";
        $username = "root";
        $db = "todolists";

        $conn = new mysqli($servername, $username, $pass, $db);

        $sql = "DELETE FROM todo WHERE sr_no = $id";
        $conn -> query($sql);
    }

    header("location: ./index.php");
    exit;
    
?>