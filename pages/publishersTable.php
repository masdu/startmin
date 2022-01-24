<?php
	require "../php/include/dbms.inc.php";
	require "../php/include/template2.inc.php";

	session_start();

	if(!(isset($_SESSION['nickname']))){
		header( "Location: login.php");
	}

	$main = new Template("frame.html");
	$body = new Template("publishersTable.html");


    $query = "SELECT id, name FROM publishers";
    $result = $mysqli->query($query);

    while($row = $result->fetch_assoc()){
        foreach($row as $key => $value){
            $body->setContent($key, $value);
        }
    }

	if($_GET['alert'] == 'error'){
		$notification = "<div class='alert alert-danger alert-dismissible'>Errore
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						</div>";
		$body->setContent("notification", $notification);
	}

	if($_GET['alert'] == 'success'){
		$notification = "<div class='alert alert-success alert-dismissible'>Inserito!
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						</div>";
		$body->setContent("notification", $notification);
	}

	
	$main->setContent("nickname", $_SESSION['nickname']);
	$main->setContent("body", $body->get());
	$main->close();
		

?>