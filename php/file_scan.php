<?php


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$dir = $request->str;

//if($str==''){
//    $dir='../images';
//}else{
//    $dir='../images/'.$str;
//}


$arr = scandir($dir);
$out=[];
for($i=2;$i<count($arr);$i++){
    if(strpos($arr[$i],'.')===false){
        $out['folders'][]=[$arr[$i],$dir.$arr[$i]];
    }else {
        $out['files'][] = [$arr[$i],$dir.'/'.$arr[$i]];
    }
}

header('Content-Type: text/json');

echo json_encode($out);

