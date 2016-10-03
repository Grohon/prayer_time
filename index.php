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
  echo 'Hello visitor from '.$query['country'].', '.$query['city'].'!';
} else {
  die('Unable to get location');
}
$city = preg_replace('/\s+/', '', $query['city']); //remove all white spaces
$url='http://muslimsalat.com/'.$city.'.json'; //query api site for json
$data= file_get_contents($url);
$obj = json_decode($data);
echo "\nFajr: ".$obj->items[0]->fajr;
echo "\nShurooq: ".$obj->items[0]->shurooq;
echo "\nDhuhr: ".$obj->items[0]->dhuhr;
echo "\nAsr: ".$obj->items[0]->asr;
echo "\nMaghrib: ".$obj->items[0]->maghrib;
echo "\nIsha: ".$obj->items[0]->isha."\n";
?>
