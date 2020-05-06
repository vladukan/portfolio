<?php

require 'db.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$table = $request->table;
$update = $request->update;
$id = $request->id;

switch ($table){
    case 'albums':
        $name = $request->name;
        $text = $request->text;
        $img = $request->img;
        if($update==1){$query = "update `".$table."` set `Название` ='".$name."',`Описание` = '".$text."',`Картинка` = '".$img."' where id =".$id." ;";}
        else{$query = "INSERT INTO `".$table."` (`Название`,`Описание`,`Картинка`) VALUES ('".$name."','".$text."', '".$img."');";}
        break;
    case 'fotos':
        $name = $request->name;
        $img = $request->img;
        if($update==1){$query = "update `".$table."` set `Альбом` ='".$name."',`Картинка` = '".$img."' where id =".$id." ;";}
        else{$query = "INSERT INTO `".$table."` (`Альбом`,`Картинка`) VALUES ('".$name."', '".$img."');";}
        break;
}






$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

echo $res;