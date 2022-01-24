<?php

include "../../include/dbms.inc.php";

function subgenreExist(){
    include "../../include/dbms.inc.php";
    $query = "SELECT name FROM subgenres WHERE id = '{$_POST['id']}'";

    
    $result = $mysqli->query($query);
    if($result->num_rows == 1){
        return true;
    }

    return false;
}


if(subgenreExist()){
    //update the subgenre
    $stmt = $mysqli->prepare("UPDATE subgenres SET `name`= ? WHERE id = ?");
    $stmt->bind_param("si", $_POST['name'], $_POST['id']);
    
    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/subgenresTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/subgenresTable.php?alert=error");
    }

} else{
    //create a new subgenre
    $stmt = $mysqli->prepare("INSERT INTO subgenres (name) VALUES (?)");
    $stmt->bind_param("s", $_POST['name']);
    
    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/subgenresTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/subgenresTable.php?alert=error");
    }
}


?>