
<?php
$json=file_get_contents("./data.json");
$data = array_reverse(json_decode($json));


$stack = [];

foreach($data as $result){

    $stack1 = [];
    $result = json_decode($result[0]);

    $download =number_format(intval($result->download->bandwidth) / 131072, 2);
    $upload =number_format(intval($result->upload->bandwidth) / 131072, 2);
    $ping =intval($result->ping->latency);

    $timestamp = new DateTime($result->timestamp);
    $timezone = new DateTimeZone('Europe/Vienna');
    $timestamp->setTimezone($timezone);
    $date = $timestamp->format("d.m.Y");
    $time = $timestamp->format("H:i:s");
    

    $stack1["download"]=$download;
    $stack1["upload"]=$upload;
    $stack1["ping"]=$ping;
    $stack1["date"]=$date;
    $stack1["time"]=$time;

    #optional

    $mb_send = number_format(intval($result->upload->bytes) / 1048576, 2);
    $mb_rec = number_format(intval($result->download->bytes) / 1048576, 2);

    $stack1["byte_sent"]=$mb_send;
    $stack1["bytes_received"]=$mb_rec;
    $stack1["packetloss"]=$result->packetLoss;
    $stack1["jitter"]=$result->ping->jitter;

    $stack1["srv_id"]=$result->server->id;
    $stack1["srv_host"]=$result->server->host;
    $stack1["srv_port"]=$result->server->port;
    $stack1["srv_name"]=$result->server->name;
    $stack1["srv_location"]=$result->server->location;
    $stack1["srv_country"]=$result->server->country;
    $stack1["srv_ip"]=$result->server->ip;

    $stack1["client_ip"]=$result->interface->internalIp;
    $stack1["client_mac"]=$result->interface->macAddr;

    $stack1["id"]=$result->result->id;
    $stack1["url"]=$result->result->url;


    array_push($stack,$stack1);
    
}

echo json_encode([
    'data' => $stack,
]);

?>