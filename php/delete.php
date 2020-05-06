<?php
require 'db.php';
//$id = json_decode($_POST['id']);
//$id=$_POST['id'];
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id = $request->id;


$query = 'delete FROM category where id='.$id;
$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);


header('Content-Type: text/json');

echo json_encode($res);