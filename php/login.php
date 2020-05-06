<?php

require 'db.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$login = $request->login;
$password = $request->password;

$hash=sha1(sha1(sha1($x.$password)));

$query = "SELECT * from `users` where name='".$login."'";


$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);


while ($array=mysqli_fetch_assoc($res)) {
    $pass=$array['password'];
}

if($pass==$hash){
    $result=1;
}else{
    $result=0;
}
echo $result;
