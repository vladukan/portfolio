<?php
require 'db.php';
//ЗАГРУЗКА graph
//select OT_TS,OT_VALUE from RPT_VALUE_INTERVAL(280, '16.01.2018', '17.01.2018', 3600)

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


$date_begin=$request->date_begin;
$date_end=$request->date_end;
$type=$request->type;

if ($type=='Часовой'){
    $type=3600000;
}else{
    $type=86400000;
}

$min=(strtotime($date_end)*1000-strtotime($date_begin)*1000)/$type;
$min=ceil($min);

$query="SELECT `Дата` FROM statistic where `Дата`>='".$date_begin."' and `Дата`<='".$date_end."' order by `Дата`";

$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);
$tabl=[];
while ($array=mysqli_fetch_assoc($res)) {
    $tabl[]=strtotime($array['Дата'])*1000;

}
$file = file_get_contents('data.json');

file_put_contents('data.json','');

$str='[';
$graph=[$date_begin,$date_end];
for($j=0;$j<$min;$j++){
    $sum=0;
    $time=strtotime($date_begin)*1000+$j*$type;
    for($i=0;$i<count($tabl);$i++){
        if(($tabl[$i]>=$time) and ($tabl[$i]<=$time+$type)){
            $sum=$sum+1;
        }
    }
    $str=$str.'['.($time+10800000).','.$sum.'],';
}

$str=substr($str,0,strlen($str)-1);
$str=$str.']';
file_put_contents('data.json',$str,FILE_APPEND);


////echo $query;
//    $dsi = ibase_query($connection, $query) or trigger_error(ibase_errcode() . $query);;
//    $str='[';
//    $tabl=[];
//    while ($array = ibase_fetch_assoc($dsi)) {
//        $date_value=floatval(utf8_encode(strtotime($array['OT_TS'])*1000+10800000));
//        $value=floatval(utf8_encode($array['OT_VALUE']));
//        $str=$str.'['.$date_value.','.$value.'],';
//        $tabl[]=[utf8_encode($array['OT_TS']),round(utf8_encode($array['OT_VALUE']),2)];
//    }
//    $str=substr($str,0,strlen($str)-1);
//    $str=$str.']';
//   //echo $str;
//    file_put_contents('data.json',$str,FILE_APPEND);

header('Content-Type: text/json',true);
echo json_encode($graph);
