<?php

$conn = new mysqli("localhost", "root","","vuecrud");

if($conn -> connect_errno){
    die("Database connect errno!");
}

$response = [
    "error" => false
];

$action = "read";

if(isset($_GET["action"])){
    $action = $_GET["action"];
}

if($action == "read"){
   $users = array();
   $result= $conn->query("SELECT * FROM `users`");
   while($row = $result->fetch_assoc()){
       array_push($users, $row);
   }
   $response["users"] = $users;

} elseif($action == "create"){
    $name= $_POST["name"];
    $name= $_POST["email"];
    $name= $_POST["username"];

    $result = $conn->query("INSERT INTO `users`(`name`, `username`,`email`)VALUES('name','username','email')");

    if($result){
        $response["message"] ="Data save success!";
    }else{
        $response["error"] = true;
        $response["message"] ="Data save failed!";
    }

} elseif($action == "update"){
    $name= $_POST["id"];
    $name= $_POST["name"];
    $name= $_POST["email"];
    $name= $_POST["username"];

    $result = $conn->query("UPDATE `users` SET `name`='$name', `username`='$username', `email`='$email' WHERE `id` = '$id'");

    if($result){
        $response["message"] ="Data update success!";
    }else{
        $response["error"] = true;
        $response["message"] ="Data update failed!";
    }
} elseif($action == "delete"){
    $name= $_POST["id"];

    $result = $conn->query("DELETE FROM `users` WHERE `id` = '$id'");

    if($result){
        $response["message"] ="Data delete success!";
    }else{
        $response["error"] = true;
        $response["message"] ="Data delete failed!";
    }
} else{
    die("Invalid action!");
}


header("content-type: application/json");
echo json_encode($response);

