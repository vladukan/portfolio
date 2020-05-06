<?php
require 'db.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id = $request->id;

//$query = 'SELECT * FROM albums order by id limit '.($id-1).',1';
$query = 'SELECT * FROM articles order by id';
$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

while ($array=mysqli_fetch_assoc($res)) {
    $table[]=['id'=>$array['ID'],'name'=>$array['Название'],'title'=>$array['Заголовок'],'picture'=>$array['Картинка']];
}

header('Content-Type: text/json');

echo json_encode($table);