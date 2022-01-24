<?php

include "../../include/dbms.inc.php";


$imagePath = $_FILES['image']['tmp_name'];
$mimeType = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
$imageContent = addslashes(file_get_contents($imagePath));



$title = addslashes($_POST['title']);
$author = addslashes($_POST['author']);
$description = addslashes($_POST['description']);
$scount = 0;

if($_POST['scount'] != null){
    $scount = $_POST['scount'];
}

if(bookExist()){
    
    //update the book
    $query = "UPDATE books SET `isbn`='{$_POST['isbn']}', `title`='{$title}',
             `author`='{$author}', `description`='{$description}',
             `genre`='{$_POST['genre']}', `subgenre`='{$_POST['subgenre']}',
             `publisher`='{$_POST['publisher']}', `year`='{$_POST['year']}',
             `image`='{$imageContent}', `mime_type`='{$mimeType}',
             `pages`='{$_POST['pages']}', `price`='{$_POST['price']}',
             `scount`='{$scount}'
            WHERE id = '{$_POST['id']}'";

    if($result = $mysqli->query($query)){

        header("Location: ../../../pages/booksTable.php?alert=success");

    } else{ header("Location: ../../../pages/booksTable.php?alert=error");}
    

} else{
    //create a new book

    $query = "INSERT INTO books (`isbn`, `title`, `author`, `description`, `genre`,
             `subgenre`, `publisher`, `year`, `pages`, `price`,
             `scount`, `image`, `mime_type`) VALUES ('{$_POST['isbn']}', '{$title}',
             '{$author}', '{$description}', '{$_POST['genre']}',
             '{$_POST['subgenre']}', '{$_POST['publisher']}', '{$_POST['year']}',
             '{$_POST['pages']}', '{$_POST['price']}', '{$scount}',
             '{$imageContent}', '{$mimeType}')";


    if($result = $mysqli->query($query)){


        header("Location: ../../../pages/booksTable.php?alert=success");

    } else{ header("Location: ../../../pages/booksTable.php?alert=error");}
    

}

function bookExist(){
    include "../../include/dbms.inc.php";

    $query = "SELECT title FROM books WHERE id = '{$_POST['id']}'";

    $result = $mysqli->query($query);

    if($result->num_rows == 1){
        return true;
    }

    return false;
}


?>