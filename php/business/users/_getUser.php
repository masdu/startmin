<?php

include "../../include/dbms.inc.php";

$query = "SELECT id, nickname, email
          FROM users WHERE id = '{$_GET['id']}'";

$result = $mysqli->query($query);
$json = array();
while($row = $result->fetch_assoc()){

    $json['id'] = $row['id'];
    $json['nickname'] = $row['nickname'];
    $json['email'] = $row['email'];

}
echo json_encode(($json));

?>