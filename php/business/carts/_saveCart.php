<?php

include "../../include/dbms.inc.php";



function cartExist(){
    include "../../include/dbms.inc.php";
    $query = "SELECT id FROM cart WHERE id = '{$_POST['id']}'";

    
    $result = $mysqli->query($query);
    if($result->num_rows == 1){
        return true;
    }

    return false;
}

if(cartExist()){
    
    //update the cart
    $stmt = $mysqli->prepare("UPDATE cart SET `user` = ?, `book` = ?, `price` = ?, `qty` = ?, `total` = ? WHERE id = ?");
    $stmt->bind_param("ssdidi", $_POST['user'], $_POST['book'], $_POST['price'], $_POST['qty'], $_POST['total'], $_POST['id']);


    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/cartsTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/cartsTable.php?alert=error");
    }
    

} else{
    //create a new cart
    $stmt = $mysqli->prepare("INSERT INTO cart (`user`, `book`, `price`, `qty`, `total`) VALUES ( ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdid", $_POST['user'], $_POST['book'], $_POST['price'], $_POST['qty'], $_POST['total']);
    
    if($stmt->execute()){
        $stmt->close();
        header("Location: ../../../pages/cartsTable.php?alert=success");
    } else{
        $stmt->close();
        header("Location: ../../../pages/cartsTable.php?alert=error");
    }

}


?>