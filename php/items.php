<?php
require 'db.php';
//$id = json_decode($_POST['id']);
//$id=$_POST['id'];
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id = $request->id;


$query = 'SELECT * FROM items where id='.$id;
$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

while ($array=mysqli_fetch_assoc($res)) {
    $category['id']=$array['id'];
    $category['name']=$array['name'];
    $category['id_name']=$array['id_name'];
    $category['desc']=$array['desc'];
}
header('Content-Type: text/json');

echo json_encode($category);