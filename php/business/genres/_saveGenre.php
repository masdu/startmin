<?php

include "../../include/dbms.inc.php";

function genreExist(){
    include "../../include/dbms.inc.php";
    $query = "SELECT name FROM genres WHERE id = '{$_POST['id']}'";

    
    $result = $mysqli->query($query);
    if($result->num_rows == 1){
        return true;
    }

    return false;
}

if(genreExist()){ 
    //update the genre
    $stmt = $mysqli->prepare("UPDATE genres SET `name`= ? WHERE id = ?");
    $stmt->bind_param("si", $_POST['name'], $_POST['id']);
    
    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/genresTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/genresTable.php?alert=error");
    }

    

} else{
    //create a new genre
    $stmt = $mysqli->prepare("INSERT INTO genres (name) VALUES (?)");
    $stmt->bind_param("s", $_POST['name']);
    
    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/genresTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/genresTable.php?alert=error");
    }
}


?>