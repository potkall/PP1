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

//miejsce na sprawdzenie autoryzacji
if (!isset($_SERVER['HTTP_AUTHORIZATION'])){
  http_response_code(404);
  die('Not exist');
}

$auth = explode(":",base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'],6)));

if (count($auth)==2){
  if ($auth[0]!='398_1fxn3vmqmwg04kkw8sk0k08cw4wgg4w0wwwscccc84o04ko4s0'&&$auth[1]!='1qviw28qye9wo4o40c04w8kcg0kss8ssgsgg4sgkww48sg0w4s'){
    http_response_code(404);
    die('Not exist');
  }
}
else {
  http_response_code(404);
  die('Not exist');
}
////////////////////////

if (isset($request[2]))
  switch ($request[2]) {
    case 'token':
      
        //powinno być jeszcze sprawdzenie POST-a
        if ($_POST['client_id']==='398_1fxn3vmqmwg04kkw8sk0k08cw4wgg4w0wwwscccc84o04ko4s0'&&$_POST['client_secret']==='1qviw28qye9wo4o40c04w8kcg0kss8ssgsgg4sgkww48sg0w4s'&&$_POST['grant_type']==='write'&&$_POST['scope']==='autos'){
          $ret['access_token']="123123123123123123123123123123";
          header('Content-Type: application/json');
          echo json_encode($ret);
        }
        else {
          http_response_code(404);
          die('Not exist');
        }
      
    break;  
    default:
      http_response_code(404);
      die('Not exist');
    break;
  }
else {
  http_response_code(404);
  die('Not exist');
}
?>