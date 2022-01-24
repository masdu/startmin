<?php
	require "../php/include/dbms.inc.php";
	require "../php/include/template2.inc.php";

	session_start();

	if(!(isset($_SESSION['nickname']))){
		header( "Location: login.php");
	}

	$main = new Template("frame.html"); 	// template principale comune a tutte le pagine del sito
	$body = new Template("booksTable.html"); 		// sottotemplate per la home

	$main->setContent("nickname", $_SESSION['nickname']);

    $query = "SELECT id, isbn, title, author, publisher, genre, subgenre, price, scount FROM books";

    $result = $mysqli->query($query);

    while($row = $result->fetch_assoc()){
        foreach($row as $key => $value){
            $body->setContent($key, $value);
        }
    }

	//populating select authors
	$query = "SELECT name FROM authors";

	$result = $mysqli->query($query);

	while($row = $result->fetch_assoc()){
        $body->setContent("authors", $row['name']);
    }

	//populating select genre
	$query = "SELECT name FROM genres";

	$result = $mysqli->query($query);

	while($row = $result->fetch_assoc()){
        $body->setContent("genres", $row['name']);
    }

	//populating select subgenre
	$query = "SELECT name FROM subgenres";

	$result = $mysqli->query($query);

	while($row = $result->fetch_assoc()){
        $body->setContent("subgenres", $row['name']);
    }

	//populating select publishers
	$query = "SELECT name FROM publishers";

	$result = $mysqli->query($query);

	while($row = $result->fetch_assoc()){
        $body->setContent("publishers", $row['name']);
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

	$main->setContent("body", $body->get());
	$main->close();
		

?>