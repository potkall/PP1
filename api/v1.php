<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);	

$method = $_SERVER['REQUEST_METHOD'];
if (isset($_SERVER['REQUEST_URI']))
  $request = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
else{
  http_response_code(404);
  die('Not Found');
} 


//miejsce na sprawdzenie tokena
if (
  !isset($_SERVER['HTTP_AUTHORIZATION'])
//   (substr($_SERVER['HTTP_AUTHORIZATION'],-31,30)=='123123123123123123123123123123'||
//   substr($_SERVER['HTTP_AUTHORIZATION'],7)=='123123123123123123123123123123')
){
  http_response_code(404);
  die('Not exist1');
}
////////////////////////

require("classloader.php");

if (isset($request[2]))
  switch ($request[2]) {
    case 'stats':
      if (isset($request[3])&&$_SERVER['REQUEST_METHOD']=="GET")
        switch ($request[3]) {
          case 'perday':
            (new cStats())->getPerday();
            break;
          case 'overall':
            (new cStats())->getOverall();
            break;
          case 'lastcheck':
            (new cStats())->getLastcheck();
            break;
          default:
            http_response_code(404);
            die('Not exist2');
            break;
        }
      else {
        http_response_code(404);
        die('Not exist3');
      }
      break;
    case 'autos':
      if (isset($request[3])&&strlen($request[3])==36){
        (new cOffers())->getAutosId($method, $request[3]);
      }
      else if (isset($request[3])) {
        (new cOffers())->getAutosFilter($method, $request[3]);
      }
      else {
        (new cOffers())->getAutos($method);
      }  
    break;  
    
    default:
      http_response_code(404);
      die('Not exist4');
      break;
  }
else {
  http_response_code(404);
  die('Not exist5');
}

?>