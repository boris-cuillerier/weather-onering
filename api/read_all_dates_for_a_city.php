<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


isset($_GET['city']) ? $city = $_GET['city'] : print_r(json_encode(
    array('message' => 'No city found')
));

$strJsonWeatherDataContent = file_get_contents("../reunion-weather.json");
$weatherDataArray = json_decode($strJsonWeatherDataContent);

$dateDatas = "";

for ($i = 0; $i < sizeof($weatherDataArray); ++$i) {
    if ($weatherDataArray[$i]->city == $city) {
        $dateDatas = $weatherDataArray[$i]->date;
    }
}

echo json_encode($dateDatas);


