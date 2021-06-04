<?php


include_once '../model/user.php';
include_once '../database.php';


$database = new Database();
$db = $database->connect();
$user = new User($db);

$user->username = $_POST['username'];
$user->password = $_POST['password'];


$stmt = $user->login();
if($stmt){

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['ID'] = $row["ID"];
    $_SESSION['score'] = $row["score"];

     $user_arr=array(
            "status" => true,
            "message" => "Successfully Login!",
            "id" => $row["ID"],
            "username" => $user->username,
            "score" => $row["score"],
        );
    }
else{
    
    $user_arr=array(
        "status" => false,
        "message" => "Invalid Username or Password!",
    );
}


echo json_encode($user_arr);

?>