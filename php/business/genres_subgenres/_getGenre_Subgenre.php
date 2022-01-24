<?php

include "../../include/dbms.inc.php";

$query = "SELECT id, genre, subgenre
          FROM genres_subgenres WHERE id = '{$_GET['id']}'";

$result = $mysqli->query($query);
$json = array();
while($row = $result->fetch_assoc()){

    $json['id'] = $row['id'];
    $json['genre'] = $row['genre'];
    $json['subgenre'] = $row['subgenre'];


}
echo json_encode(($json));

?>