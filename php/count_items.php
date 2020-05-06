<?php
require 'db.php';

$query = 'SELECT count(*) FROM albums';
$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

while ($array=mysqli_fetch_assoc($res)) {
$category['count']=$array['count(*)'];
}

$query = 'SELECT count(*) FROM articles';
$res = mysqli_query($db, $query) or trigger_error(mysqli_error() . " in " . $query);

while ($array=mysqli_fetch_assoc($res)) {
    $category['articles']=$array['count(*)'];
}

header('Content-Type: text/json');

echo json_encode($category);