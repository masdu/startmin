<?php

include "../../include/dbms.inc.php";



if (isset($_GET['isbn'])){

    $query = "SELECT price FROM books WHERE isbn = '{$_GET['isbn']}'";
    $result = $mysqli->query($query);

    $row = $result->fetch_assoc();

    echo $row['price'];
}


?>