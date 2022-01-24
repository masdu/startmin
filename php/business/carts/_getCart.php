<?php

include "../../include/dbms.inc.php";

$query = "SELECT `id`, `user`, `book`, `price`, `qty`, `total` FROM `cart` WHERE id = '{$_GET['id']}'";

$result = $mysqli->query($query);
$json = array();
while($row = $result->fetch_assoc()){

    $json['id'] = $row['id'];
    $json['user'] = $row['user'];
    $json['book'] = $row['book'];
    $json['price'] = $row['price'];
    $json['qty'] = $row['qty'];
    $json['total'] = $row['total'];

}
echo json_encode(($json));

?>