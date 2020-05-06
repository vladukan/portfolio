<?php

require 'db.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id = $request->id;
$tabl = $request->table;


$query='select * from '.$tabl.' where id='.$id.' limit 1';

$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

while ($array=mysqli_fetch_row($res)) {
    $arr=$array;

}

header('Content-Type: text/json');

echo json_encode($arr);
