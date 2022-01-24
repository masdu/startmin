<?php

include "../../include/dbms.inc.php";

$query = "DELETE FROM frontBooks WHERE id = '{$_POST['id']}'";

$result = $mysqli->query($query);

return true;

?>