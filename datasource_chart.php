
<?php
$json=file_get_contents("./data.json");
$data = json_decode($json);


$stack = [];
$max_data = 0;

foreach($data as $result){
    $max_data++;
    if ($max_data > 168){
        break;
    }
    $stack1 = [];
    $result = json_decode($result[0]);

    $download =number_format(intval($result->download->bandwidth) / 131072, 2);
    $upload =number_format(intval($result->upload->bandwidth) / 131072, 2);
    $ping =intval($result->ping->latency);

    $timestamp = new DateTime($result->timestamp);
    $timezone = new DateTimeZone('Europe/Vienna');
    $timestamp->setTimezone($timezone);
    $datetime = $timestamp->format("d.m.Y");
    $datetimeall = $timestamp->format("d.m.Y H:i");
    

    $stack1["download"]=$download;
    $stack1["upload"]=$upload;
    $stack1["ping"]=$ping;
    $stack1["datetime"]=$datetime;
    $stack1["datetimeall"]=$datetimeall;

    array_push($stack,$stack1);
    
}

echo json_encode($stack);

?>