<?php
require 'db.php';
//$id = json_decode($_POST['id']);
//$id=$_POST['id'];
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$limit_begin = $request->limit_begin;
$limit_end = $request->limit_end;
//echo $limit_begin;
//$limit_begin=0;

$query = 'SELECT * FROM table_05 order by id limit '.$limit_begin.','.$limit_end;
$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

while ($array=mysqli_fetch_assoc($res)) {
//   $category['id'][]=$array['id'];
//   $category['tag'][]=$array['tag'];
//   $category['data_reg'][]=$array['data_reg'];
//   $category['value'][]=$array['value'];
    $category[]=[
        'id' => $array['id'],
        'tag' =>$array['tag'],
        'data_reg' =>$array['data_reg'],
        'value' =>$array['value']
            ];
}

header('Content-Type: text/json');

echo json_encode($category);