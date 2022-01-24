<?php

include "../../include/dbms.inc.php";

$query = "DELETE FROM discountedBooks WHERE id = '{$_POST['id']}'";

$result = $mysqli->query($query);

return true;

?>