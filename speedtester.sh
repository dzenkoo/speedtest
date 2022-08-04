SPEEDDATA=$(speedtest --format=json)
curl -X POST -F "data=$SPEEDDATA" http://url/speedtest/speedgraber.php