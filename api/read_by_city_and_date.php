<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


isset($_GET['city']) ? $city = $_GET['city'] : print_r(json_encode(
    array('message' => 'No city found')
));
isset($_GET['date']) ? $date = $_GET['date'] : print_r(json_encode(
    array('message' => 'No date found')
));

$strJsonWeatherDataContent = file_get_contents("../reunion-weather.json");
$weatherDataArray = json_decode($strJsonWeatherDataContent);

$dateDatas = "";
$weatherDatas = "";

for ($i = 0; $i < sizeof($weatherDataArray); ++$i) {
    if ($weatherDataArray[$i]->city == $city) {
        $dateDatas = $weatherDataArray[$i]->date;
    }
    $dateDatasArray = (array) $dateDatas;
    foreach ($dateDatasArray as $key => $values) {
        if( $key == $date ) {
            $weatherDatas = $values;
        }
    }
}

echo json_encode($weatherDatas);


