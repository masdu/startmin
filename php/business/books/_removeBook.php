<?php

include "../../include/dbms.inc.php";

$query = "DELETE FROM books WHERE id = '{$_POST['id']}'";

$result = $mysqli->query($query);

return true;

?>