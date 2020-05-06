<?php
require 'db.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id = $request->id;
$id_foto = $request->id_foto;

$query = 'SELECT * FROM fotos where `Альбом`='.$id.' order by ID';
$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

while ($array=mysqli_fetch_assoc($res)) {
    $table[]=['id'=>$array['ID'],'id_album'=>$array['Альбом'],'url'=>$array['Картинка'],'likes'=>$array['Лайки'],'views'=>$array['Просмотры']];
}

header('Content-Type: text/json');

echo json_encode($table);