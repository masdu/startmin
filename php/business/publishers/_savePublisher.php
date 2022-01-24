<?php

include "../../include/dbms.inc.php";

function publisherExist(){
    include "../../include/dbms.inc.php";
    $query = "SELECT name FROM authors WHERE id = '{$_POST['id']}'";
 
    $result = $mysqli->query($query);
    if($result->num_rows == 1){
        return true;
    }

    return false;
}

if(publisherExist()){
    //update the publisher
    $stmt = $mysqli->prepare("UPDATE publishers SET `name`= ? WHERE id = ?");
    $stmt->bind_param("si", $_POST['name'], $_POST['id']);
    
    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/publishersTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/publishersTable.php?alert=error");
    }
    
} else{
    //create a new publisher
    $stmt = $mysqli->prepare("INSERT INTO publishers (name) VALUES (?)");
    $stmt->bind_param("s", $_POST['name']);
    
    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/publishersTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/publishersTable.php?alert=error");
    }

}


?>