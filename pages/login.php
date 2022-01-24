<?php

	require "../php/include/template2.inc.php";

	$main = new Template("login.html");

	if(isset($_GET['error'])){
        $main->setContent("error", "email or password incorrect");
    }

	$main->close();

?>