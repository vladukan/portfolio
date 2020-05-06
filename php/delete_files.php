<?php

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$file = $request->file;

$file=substr($file,0,-1);

$arr = explode(":", $file);
for($i=0;$i<count($arr);$i++){
    unlink($arr[$i]);
}

//header('Content-Type: text/json');
//
//echo json_encode($out);

