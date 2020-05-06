<?php

require 'db.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id = $request->id;
$table = $request->table;

    $query = "Delete from ".$table." where id=".$id.";";


$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

echo $res;