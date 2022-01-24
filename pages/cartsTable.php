<?php
	require "../php/include/dbms.inc.php";
	require "../php/include/template2.inc.php";

	session_start();

	if(!(isset($_SESSION['nickname']))){
		header( "Location: login.php");
	}

	$main = new Template("frame.html"); 	// template principale comune a tutte le pagine del sito
	$body = new Template("cartsTable.html"); 		// sottotemplate per la home

	$main->setContent("nickname", $_SESSION['nickname']);

    $query = "SELECT cart.id, cart.user, books.title as title, cart.price, cart.qty, cart.total FROM cart INNER JOIN books ON books.isbn = cart.book";

    $result = $mysqli->query($query);

    while($row = $result->fetch_assoc()){
        foreach($row as $key => $value){
            $body->setContent($key, $value);
        }
    }

	//setting users
	$query = "SELECT email FROM users";

	$result = $mysqli->query($query);

	while($row = $result->fetch_assoc()){
        $body->setContent("users", $row['email']);
    }

	//setting books
	$query = "SELECT isbn, title FROM books";

	$result = $mysqli->query($query);

	while($row = $result->fetch_assoc()){
        $body->setContent("books", $row['isbn']);
		$body->setContent("titleEdit", $row['title']);
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