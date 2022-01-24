<?php

include "../../include/dbms.inc.php";

$query = "SELECT isbn, title, author, description, 
          genre, subgenre, publisher, year, pages,
          price, scount, mime_type, id
          FROM books WHERE id = '{$_GET['id']}'";

$result = $mysqli->query($query);
$json = array();
while($row = $result->fetch_assoc()){

    $json['isbn'] = $row['isbn'];
    $json['title'] = $row['title'];
    $json['author'] = $row['author'];
    $json['description'] = $row['description'];
    $json['genre'] = $row['genre'];
    $json['subgenre'] = $row['subgenre'];
    $json['publisher'] = $row['publisher'];
    $json['year'] = $row['year'];
    $json['pages'] = $row['pages'];
    $json['price'] = $row['price'];
    $json['scount'] = $row['scount'];
    $json['mime_type'] = $row['mime_type'];
    $json['id'] = $row['id'];
}
echo json_encode(($json));

?>