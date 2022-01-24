<?php

include "../../include/dbms.inc.php";



function wishlistsExist(){
    include "../../include/dbms.inc.php";
    $query = "SELECT id FROM wishlists WHERE id = '{$_POST['id']}'";

    
    $result = $mysqli->query($query);
    if($result->num_rows == 1){
        return true;
    }

    return false;
}

if(wishlistsExist()){
    
    //update the wishlists
    $stmt = $mysqli->prepare("UPDATE wishlists SET `email` = ?, `book` = ?, `price` = ? WHERE id = ?");
    $stmt->bind_param("ssdi", $_POST['user'], $_POST['book'], $_POST['price'], $_POST['id']);


    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/wishlistsTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/wishlistsTable.php?alert=error");
    }
    

} else{
    //create a new wishlist
    $stmt = $mysqli->prepare("INSERT INTO wishlists (`email`, `book`, `price`) VALUES ( ?, ?, ?)");
    $stmt->bind_param("ssd", $_POST['user'], $_POST['book'], $_POST['price']);
    
    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/wishlistsTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/wishlistsTable.php?alert=error");
    }

}


?>