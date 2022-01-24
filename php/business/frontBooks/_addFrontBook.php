<?php

include "../../include/dbms.inc.php";


function bookExist(){
    include "../../include/dbms.inc.php";

    $query = "SELECT id FROM frontBooks WHERE isbn = '{$_POST['isbn']}'";

    $result = $mysqli->query($query);

    if($result->num_rows == 1){
        return true;
    }

    return false;
}

function tableIsFull(){
    include "../../include/dbms.inc.php";

    $query = "SELECT * from frontBooks";

    $result = $mysqli->query($query);

    if($result->num_rows == 2){
        return true;
    }

    return false;

}

if(BookExist() || tableIsFull()){
    exit;
}

$query = "INSERT INTO frontBooks (isbn) values ({$_POST['isbn']})";

$result = $mysqli->query($query);

?>