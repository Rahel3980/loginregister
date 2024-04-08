<?php
//the purpose of having data base is to store and oganize data//
$serverName ="localhost";
$username ="root";
$password ="";
$dbName="mysqldatabase";
//create connection
$conn= mysqli_connect($serverName,$username,$password,$dbName);
if(mysqli_connect_error()){
    echo "failed to connect!";
    exit();
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}
?>