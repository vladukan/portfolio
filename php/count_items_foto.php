<?php
require 'db.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id = $request->id;


$query = 'SELECT count(*) FROM fotos where id_album='.$id;
$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

while ($array=mysqli_fetch_assoc($res)) {
$category['count']=$array['count(*)'];
}

header('Content-Type: text/json');

echo json_encode($category);