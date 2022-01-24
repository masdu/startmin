<?php

include "../../include/dbms.inc.php";

function groupExist(){
    include "../../include/dbms.inc.php";
    $query = "SELECT `name` FROM `groups` WHERE id = '{$_POST['id']}'";

    
    $result = $mysqli->query($query);
    if($result->num_rows == 1){
        return true;
    }

    return false;
}

if(groupExist()){
    
    //update the group
    $stmt = $mysqli->prepare("UPDATE `groups` SET `name`= ? WHERE id = ?");
    $stmt->bind_param("si", $_POST['name'], $_POST['id']);

    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/groupsTable.php?alert=success");

    } else{
        $stmt->close();
        header("Location: ../../../pages/groupsTable.php?alert=error");
    }
    

} else{
    //create a new group
    $stmt = $mysqli->prepare("INSERT INTO `groups`(`name`) VALUES (?)");
    $stmt->bind_param("s", $_POST['name']);

    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/groupsTable.php?alert=success");

    } else{
        $stmt->close();
        header("Location: ../../../pages/groupsTable.php?alert=error");
    }


}


?>