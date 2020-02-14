<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$strJsonWeatherDataContent = file_get_contents("../reunion-weather.json");
$weatherDataArray = json_decode($strJsonWeatherDataContent);

$result = new stdClass();

for ($i = 0; $i < sizeof($weatherDataArray); ++$i) {
    $result->city = $weatherDataArray[$i]->city;
    $dateDatas = $weatherDataArray[$i]->date;
    $dateDatasArray = (array) $dateDatas;
    foreach ($dateDatasArray as $key => $values) {
        $result->date = $key;
        $result->qnh = $values->qnh;
        echo json_encode($result);
    }
}



