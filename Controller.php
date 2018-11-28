<?php

session_start();
require_once "DatabaseAdaptor.php";
$databaseAdaptor = new DatabaseAdaptor();


if (isset($_POST["method"])){
    $method = $_POST["method"];
}

//user login method
if ($method == "login"){
    if (isset($_POST["username"])){
        $username = $_POST["username"];
    }
    if (isset($_POST["password"])){
        $password = $_POST["password"];
    }
    if (isset($_POST["username"]) && isset($_POST["password"])){
        if ($databaseAdaptor->checkUserCredentials($username, $password) == TRUE){
            $_SESSION["user"] = $username;
            echo json_encode(true);
        }
        else{
            echo json_encode(false);
        }
    }
}

if ($method == "registration"){
    if (isset($_POST["username"])){
        $username = $_POST["username"];
    }
    if (isset($_POST["password"])){
        $password = $_POST["password"];
    }
        
    $arr = $databaseAdaptor->checkForUsername($username);
    if (count($arr) > 0){
        echo "Userame taken, try a different username";
    }
    else{
        $databaseAdaptor->insertNewUser($username, $password);
        echo 'Registration succesful';
    }
}

?>
