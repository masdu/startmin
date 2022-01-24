<?php

include "../php/include/dbms.inc.php";

$query = "SELECT nickname, password FROM users
          WHERE email = '{$_POST['email']}'";

$result = $mysqli->query($query);

if ($result->num_rows == 1){

    $row = $result->fetch_assoc();

    if(password_verify($_POST['password'], $row['password'])){
        #email a password esatte controllo se l'utenza appartiene al gruppo di amministrazione
        $query = "SELECT * FROM `users_groups` WHERE user = '{$_POST['email']}' AND `group` = 'admin'";
        $result = $mysqli->query($query);
        if($result->num_rows == 1){
            session_start();
            $_SESSION['nickname'] = $row['nickname'];
            $_SESSION['email'] = $_POST['email'];
            header("location: index.php");
        } 
        else{
            http_response_code(403);
            echo "forbidden";
        }
        
    }
    
    else{
        #email giusta ma password errata redirect con alert di errore
        header("location: login.php?error");
    }

}

else{
    #email errata
    header("location: login.php?error");

}