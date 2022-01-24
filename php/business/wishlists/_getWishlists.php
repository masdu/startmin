<?php

include "../../include/dbms.inc.php";

$query = "SELECT `id`, `email`, `book`, `price` FROM `wishlists` WHERE id = '{$_GET['id']}'";

$result = $mysqli->query($query);
$json = array();
while($row = $result->fetch_assoc()){

    $json['id'] = $row['id'];
    $json['user'] = $row['email'];
    $json['book'] = $row['book'];
    $json['price'] = $row['price'];


}
echo json_encode(($json));

?>