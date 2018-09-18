<?php

$ip = getenv('REMOTE_ADDR'); //remote ip address
$local = false;
if ($local){
  function getPublicAddress() {
    $api_url = "https://api.ipify.org?format=json";
    $data = file_get_contents($api_url);
    $obj = json_decode($data);
    return $obj->ip;
  }
  $ip =  getPublicAddress();  //the IP address to query
}
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
if($query && $query['status'] == 'success') {
  echo 'Hello visitor from ' . $query['country'] . '(' . $query['countryCode'] . '), '. $query['city'] .'!';
} else {
  die('Unable to get location');
}
$city = preg_replace('/\s+/', '', $query['city']); //remove all white spaces
$url="http://api.aladhan.com/timingsByCity?city=$city&country=" . $query['countryCode'] . "&method=2"; //query api site for json

$data= file_get_contents($url);
$obj = json_decode($data);
foreach ($obj->data->timings as $key => $value) {
  echo PHP_EOL . "$key $value ";
}
echo PHP_EOL;
?>
