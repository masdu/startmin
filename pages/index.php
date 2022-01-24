<?php


	require "../php/include/dbms.inc.php";
	require "../php/include/template2.inc.php";

	session_start();

	if(!(isset($_SESSION['nickname']))){
		header( "Location: login.php");
	}

	$main = new Template("frame.html"); 	// template principale comune a tutte le pagine del sito
	$body = new Template("index.html"); 		// sottotemplate per la home

	$main->setContent("nickname", $_SESSION['nickname']);


	$main->setContent("body", $body->get());
	$main->close();
		



?>