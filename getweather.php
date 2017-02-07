<?php

// URL to San Diego, Montgomery-Gibbs Executive Airport
$url = 'http://w1.weather.gov/xml/current_obs/KMYF.xml';

// Get XML Data, Convert to array
$xmldata = getUrlContent($url);
$xml = simplexml_load_string($xmldata);
$json = json_encode($xml);
$data = json_decode($json,TRUE);

//print_r($data);

// Prepare the data
$ret = [];

// Get text before parentheses
$wind_string = trim(substr($data['wind_string'], 0, strrpos( $data['wind_string'], '(')));

if(empty($wind_string))$wind_string = $data['wind_string']; // No empty values

// Define ssid for access points
$ret[] = '>> KMYF Weather: '.$data['weather'];
$ret[] = '>> Temp: '.$data['temperature_string'];
$ret[] = '>> Relative Humidity: '.$data['relative_humidity'].'%';
$ret[] = '>> Dewpoint: '.$data['dewpoint_string'];
$ret[] = '>> Wind: '.$wind_string;
$ret[] = '>> Wind Direction: '.$data['wind_dir'];
$ret[] = '>> Visibility: '.$data['visibility_mi'].' MI';

// Output one entry per line for use by shell script
foreach($ret as $r){
    echo substr($r, 0, 31).PHP_EOL;
}

// We get a 403 without switching the user agent
function getUrlContent($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return ($httpcode>=200 && $httpcode<300) ? $data : false;
}
