<?php

require 'db.php';


//Можно через curl
$request = file_get_contents("http://api.sypexgeo.net/json/".$_SERVER['REMOTE_ADDR']);
$array = json_decode($request);
//echo $array->country->name_ru.', '.$array->city->name_ru;
$country=$array->country->name_ru;
$city=$array->city->name_ru;

if($country==''){
    $country='Неизвестно';
}
if($city==''){
    $city='Неизвестно';
}
$today = date("Y-m-d H:i:s");
$query = "INSERT INTO `statistic` (`Дата`,`IP`,`Страна`,`Город`) VALUES ('".$today."', '".$_SERVER['REMOTE_ADDR']."', '".$country."','".$city."');";

$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

echo $_SERVER['REMOTE_ADDR'];