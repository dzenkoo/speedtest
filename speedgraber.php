<?php

$data[] = $_POST['data'];

$inp = file_get_contents('data.json');
$tempArray = json_decode($inp);
array_push($tempArray, $data);
$jsonData = json_encode($tempArray);
file_put_contents('data.json', $jsonData);
?>


