<?php

include "../../include/dbms.inc.php";

function genre_subgenreExist(){
    include "../../include/dbms.inc.php";
    $query = "SELECT id FROM genres_subgenres WHERE id = '{$_POST['id']}'";

    
    $result = $mysqli->query($query);
    if($result->num_rows == 1){
        return true;
    }

    return false;
}

if(genre_subgenreExist()){
    
    //update the genre_subgenre
    $stmt = $mysqli->prepare("UPDATE genres_subgenres SET `genre`= ?, `subgenre`= ? WHERE id = ?");
    $stmt->bind_param("ssi", $_POST['genre'], $_POST['subgenbre'], $_POST['id']);
    
    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/genres_subgenresTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/genres_subgenresTable.php?alert=error");
    }
    

} else{
    //create a new genre_subgenre

    $stmt = $mysqli->prepare("INSERT INTO `genres_subgenres`(`genre`, `subgenre`) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST['genre'], $_POST['subgenre']);
    
    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/genres_subgenresTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/genres_subgenresTable.php?alert=error");
    }

    
}


?>