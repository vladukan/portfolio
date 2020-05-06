<?php

require 'db.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$table = $request->table;
$id = $request->id;
$begin = $request->begin;
$end = $request->end;
$desc = $request->desc;
//$table='main_menu';
$query='SHOW FIELDS FROM '.$table;


$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

while ($array=mysqli_fetch_assoc($res)) {
    $arr['fields'][]=$array['Field'];
}
$query='SELECT COUNT(1) FROM '.$table;

$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

while ($array=mysqli_fetch_assoc($res)) {
    $sum=$array['COUNT(1)'];
}
$arr['all_rows']=$sum;




if($end=='Все'){
    if($desc==0){
        $query='select * from '.$table.' ORDER by `'.$id.'`';
    }else{
        $query='select * from '.$table.' ORDER by `'.$id.'` DESC';
    }
    $arr['pages']=1;
}else{
    $arr['pages']=ceil($sum/$end);
    if($arr['pages']==0){ $arr['pages']=1;}
    if($desc==0){
        $query='select * from '.$table.' ORDER by `'.$id.'` limit '.$begin.','.$end;
    }else{
        $query='select * from '.$table.' ORDER by `'.$id.'` DESC limit '.$begin.','.$end;
    }
}

$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

while ($array=mysqli_fetch_row($res)) {
    for($i=0;$i<count($array);$i++){
        if(strripos($array[$i], '.jpg') or strripos($array[$i], '.png') or strripos($array[$i], '.gif')or strripos($array[$i], '.jpeg')>0){
            $array[$i]='<img src="'.$array[$i].'" style="width:100px;">';
        }

    }
    $arr['rows'][]=$array;
}


if($table=='fotos'){
    $query='select * from `albums` ORDER by `ID`';
    $res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);
    while ($array=mysqli_fetch_row($res)) {
        $arr2[]=$array;
    }
    for($i=0;$i<count($arr2);$i++){
        for($j=0;$j<count($arr['rows']);$j++){
            if($arr['rows'][$j][1]==$arr2[$i][0]){
                $arr['rows'][$j][1]=$arr2[$i][1];
            }
        }
    }
}

header('Content-Type: text/json');

echo json_encode($arr);

