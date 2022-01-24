<?php

include "../../include/dbms.inc.php";

$query = "DELETE FROM `users_groups` WHERE `id` = '{$_POST['id']}'";

$result = $mysqli->query($query);

return true;

?>