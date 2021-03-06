<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

isset($_GET['date']) ? $date = $_GET['date'] : print_r(json_encode(
    array('message' => 'No date found')
));

$strJsonWeatherDataContent = file_get_contents("../reunion-weather.json");
$weatherDataArray = json_decode($strJsonWeatherDataContent);

$dateObject = new stdClass();
$weather = new stdClass();
$result = [];

for ($i = 0; $i < sizeof($weatherDataArray); ++$i) {
    $dateDatas = $weatherDataArray[$i]->date;
    $dateDatasArray = (array) $dateDatas;
    foreach ($dateDatasArray as $key => $values) {
        if( $key == $date ) {
            $dateObject->city = $weatherDataArray[$i]->city;
            $weather->temp = $values->temp;
            $weather->qnh = $values->qnh;
            $weather->humidity = $values->humidity;
            $dateObject->weather = $weather;
            array_push($result, $dateObject);
        }
    }
}

echo json_encode($result);
