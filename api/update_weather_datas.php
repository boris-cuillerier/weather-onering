<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');

$datas = json_decode(file_get_contents("php://input"));
$strJsonWeatherDataContent = file_get_contents("../reunion-weather.json");
$weatherDataArray = json_decode($strJsonWeatherDataContent);

$city = $datas->city;
$date = $datas->date;
$temp = $datas->temp;
$qnh = $datas->qnh;
$humidity = $datas->humidity;
$dateDatas = "";

for ($i = 0; $i < sizeof($weatherDataArray); ++$i) {
    if ($weatherDataArray[$i]->city == $city) {
        $dateDatas = $weatherDataArray[$i]->date;
    }
    $dateDatasArray = (array) $dateDatas;
    foreach ($dateDatasArray as $key => $values) {
        if( $key == $date ) {
            $values->temps = $temp;
            $values->qnh = $qnh;
            $values->humidity = $humidity;
        }
    }
}

echo json_encode($weatherDataArray);
file_put_contents("../reunion-weather.json", $weatherDataArray);
