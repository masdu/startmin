<?php

include "../../include/dbms.inc.php";


function bookExist(){
    include "../../include/dbms.inc.php";

    $query = "SELECT id FROM discountedBooks WHERE isbn = '{$_POST['isbn']}'";

    $result = $mysqli->query($query);

    if($result->num_rows == 1){
        return true;
    }

    return false;
}

if(BookExist()){
    exit;
}

$query = "INSERT INTO discountedBooks (isbn) values ({$_POST['isbn']})";

$result = $mysqli->query($query);

?>