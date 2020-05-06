<?php
require 'db.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id = $request->id;

$query = "SELECT * from `fotos` where ID=".$id." limit 1";
$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

while ($array=mysqli_fetch_assoc($res)) {
    $arr['sum']=$array['Просмотры'];
    $arr['like']=$array['Лайки'];
}
$arr['sum']=$arr['sum']+1;

$query = "UPDATE `fotos` set `Просмотры`=".$arr['sum']." where ID=".$id.";";

$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);


header('Content-Type: text/json');

echo json_encode($arr);
