<?php

include "../../include/dbms.inc.php";

function userGroupExist(){
    include "../../include/dbms.inc.php";
    $query = "SELECT * FROM users_groups WHERE id = '{$_POST['id']}'";

    
    $result = $mysqli->query($query);
    if($result->num_rows == 1){
        return true;
    }

    return false;
}

if(userGroupExist()){
    
    //update the user_group
    $stmt = $mysqli->prepare("UPDATE users_groups SET `user`= ?, `group`= ? WHERE id = ?");
    $stmt->bind_param("ssi", $_POST['user'], $_POST['group'], $_POST['id']);

    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/users_groupsTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/users_groupsTable.php?alert=error");
    }
    

} else{
    //create a new user_group

    $stmt = $mysqli->prepare("INSERT INTO `users_groups`(`user`, `group`) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST['user'], $_POST['group']);

    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/users_groupsTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/users_groupsTable.php?alert=error");
    }

}