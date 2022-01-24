<?php

include "../../include/dbms.inc.php";

$query = "SELECT id, user, `group`
          FROM users_groups WHERE id = '{$_GET['id']}'";

$result = $mysqli->query($query);
$json = array();
while($row = $result->fetch_assoc()){

    $json['id'] = $row['id'];
    $json['user'] = $row['user'];
    $json['group'] = $row['group'];

}
echo json_encode(($json));

?>