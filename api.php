<?php

$conn = new mysqli("localhost", "root","","vuecrud");

if($conn -> connect_errno){
    die("Database connect error!");
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
    echo $action;
} elseif($action == "update"){
    echo $action;
} elseif($action == "delete"){
    echo $action;
} else{
    die("Invalid action!");
}


header("content-type: application/json");
echo json_encode($response);

