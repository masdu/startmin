<?php

include "../../include/dbms.inc.php";

function userExist(){
    include "../../include/dbms.inc.php";
    $query = "SELECT nickname FROM users WHERE id = '{$_POST['id']}'";
   
    $result = $mysqli->query($query);
    if($result->num_rows == 1){
        return true;
    }

    return false;
}

if(userExist()){
    
    //update the user
    $psw_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("UPDATE `users` SET `nickname` = ?, `email` = ?, `password` = ? WHERE `id` = ?");
    $stmt->bind_param("sssi", $_POST['nickname'], $_POST['email'], $psw_hash, $_POST['id']);

    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/usersTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/usersTable.php?alert=error");
    }
    

} else{
    //create a new user

    $psw_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO `users`(`nickname`, `password`, `email`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $_POST['nickname'], $psw_hash, $_POST['email']);
    
    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/usersTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/usersTable.php?alert=error");
    }

}


?>