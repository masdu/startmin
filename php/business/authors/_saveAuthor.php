<?php

include "../../include/dbms.inc.php";

function authorExist(){

    include "../../include/dbms.inc.php";

    $query = "SELECT name FROM authors WHERE id = '{$_POST['id']}'";

    $result = $mysqli->query($query);
    if($result->num_rows == 1){
        return true;
    }

    return false;
}

if(authorExist()){
    //update the author
    $stmt = $mysqli->prepare("UPDATE authors SET `name`= ?, `biography`= ? WHERE id = ?");
    $stmt->bind_param("ssi", $_POST['name'], $_POST['biography'], $_POST['id']);
    
    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/authorsTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/authorsTable.php?alert=error");
    }

    } else{
    //create a new author
    $stmt = $mysqli->prepare("INSERT INTO `authors`(`name`, `biography`) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST['name'], $_POST['biography']);
    
    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/authorsTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/authorsTable.php?alert=error");
    }


}


?>