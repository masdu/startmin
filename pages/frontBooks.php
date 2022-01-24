<?php
	require "../php/include/dbms.inc.php";
	require "../php/include/template2.inc.php";

	session_start();

	if(!(isset($_SESSION['nickname']))){
		header( "Location: login.php");
	}

	$main = new Template("frame.html"); 	// template principale comune a tutte le pagine del sito
	$body = new Template("frontBooks.html"); 		// sottotemplate per la home

	$main->setContent("nickname", $_SESSION['nickname']);

    $query = "SELECT id, isbn, title, author, publisher, genre, subgenre, price, scount FROM books";

    $result = $mysqli->query($query);

    while($row = $result->fetch_assoc()){
        foreach($row as $key => $value){
            $body->setContent($key, $value);
        }
    }

    //setting discount books
    $query = "SELECT frontBooks.id as idFront, books.isbn as isbnFront, books.title as titleFront, books.author as authorFront, books.publisher as publisherFront, books.genre as genreFront, books.subgenre as subgenreFront, books.price as priceFront, books.scount as scountFront FROM frontBooks INNER JOIN books ON frontBooks.isbn = books.isbn";

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

	$main->setContent("body", $body->get());
	$main->close();
		

?>