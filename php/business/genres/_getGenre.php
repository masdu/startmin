<?php

include "../../include/dbms.inc.php";

$query = "SELECT id, name
          FROM genres WHERE id = '{$_GET['id']}'";

$result = $mysqli->query($query);
$json = array();
while($row = $result->fetch_assoc()){

    $json['id'] = $row['id'];
    $json['name'] = $row['name'];

}
echo json_encode(($json));

?>