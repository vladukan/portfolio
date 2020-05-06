<?php
require 'db.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id = $request->id;
$ip = $request->ip;

$query = "SELECT * from `likes` where id_fotos=".$id." and ip='".$ip."' limit 1";
$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);
$arr1=mysqli_fetch_assoc($res);

$query = "SELECT * from `fotos` where ID=".$id." limit 1";
$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);
while ($array=mysqli_fetch_assoc($res)) {
    $sum=$array['Лайки'];
}

if(count($arr1)>0){
    $sum=$sum-1;
    $query = "DELETE from `likes` where id_fotos=".$id." and ip='".$ip."';";
    $res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);
}else{
    $sum=$sum+1;
    $query = "INSERT INTO `likes` (`id_fotos`,`ip`) VALUES ('".$id."','".$ip."');";
    $res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);
}

$query = "UPDATE `fotos` set `Лайки`=".$sum." where ID=".$id.";";
$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

echo $sum;