<?php
 
class cOto {
	
	private $_client_id;
  private $_client_secret;
	
	public function __construct(){
		$this->_client_id = '398_1fxn3vmqmwg04kkw8sk0k08cw4wgg4w0wwwscccc84o04ko4s0';
		$this->_client_secret = '1qviw28qye9wo4o40c04w8kcg0kss8ssgsgg4sgkww48sg0w4s';
		
  }

  public function get_token() {
    $url = "https://wsinf.potkal.pl/oauth/v2/token";

    $post = array(
      "client_id" => $this->_client_id,
      "client_secret" => $this->_client_secret,
      "grant_type" => "write",
      "scope"=>"autos",
    );
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, $this->_client_id.":".$this->_client_secret);
    $r = curl_exec($curl);
    curl_close($curl);
    //$r['aaa']=$this->_client_id;
    $obj = json_decode($r);
    return $obj->access_token;
    //return $r;
  }
    
  private function call_get($url, $token){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, trim($url));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
        'Authorization: Bearer '.$token,                                                                       
        'Content-Type: application/json; charset=UTF-8', 
        )                                                                       
    );
    $output = curl_exec($ch);
    $respondcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
    curl_close($ch);
    $res = json_decode($output,true);
    $res['respondcode']=$respondcode;
    return $res;
  } 

  private function call_post($url, $arr, $token){

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, trim($url));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
        'Authorization: Bearer '.$token.'',                                                                       
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen(json_encode($arr))
        )                                                                       
    );
    $output = curl_exec($ch);
    $respondcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
    $output['respondcode']=$respondcode;
    curl_close($ch);
    
    return $output;
    $output = curl_exec($ch);
    $respondcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
    curl_close($ch);
    $res = json_decode($output,true);
    $res['respondcode']=$respondcode;
    return $res;
  }

  private function call_put($url, $arr, $token){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arr));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
        'Authorization: AuthSub token="'.$token.'"',                                                                       
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen(json_encode($arr))
        )                                                                       
    );
    // $output = curl_exec($ch);
    // $respondcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
    // $output['respondcode']=$respondcode;
    // curl_close($ch);
    // return $output;
    $output = curl_exec($ch);
    $respondcode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
    curl_close($ch);
    $res = json_decode($output,true);
    $res['respondcode']=$respondcode;
    return $res;
  }

  // private function call_delete($url, $arr, $token){
  //   $ch = curl_init();
  //   curl_setopt($ch, CURLOPT_URL, $url);
  //   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
  //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
  //         'Authorization: Bearer '.$token,                                                                       
  //         'Content-Type: application/json; charset=UTF-8', 
  //         )                                                                       
  //     );
  //   $output = curl_exec($ch);
  //   curl_close($ch);
  //   return $output;
  // }

  private function call_delete($url, $token){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, trim($url));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
        'Authorization: Bearer '.$token,                                                                       
        'Content-Type: application/json; charset=UTF-8', 
        )                                                                       
    );
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
  }

  public function getStats(string $stat){
    if ($stat=="dzis"){
      $url = "https://wsinf.potkal.pl/api/v1/stats/perday";
      $respond = $this->call_get($url,$this->get_token());
      return $respond;
    }
    elseif ($stat=="all") {
      $url = "https://wsinf.potkal.pl/api/v1/stats/overall";
      $respond = $this->call_get($url,$this->get_token());
      return $respond;
    }
    elseif ($stat=="ostatnie") {
      $url = "https://wsinf.potkal.pl/api/v1/stats/lastcheck";
      $respond = $this->call_get($url,$this->get_token());
      return $respond;
    }
  }

  public function getOffers(){
    $url = "https://wsinf.potkal.pl/api/v1/autos";
    $respond = $this->call_get($url,$this->get_token());
    return $respond;
  }

  public function getOffersFiltered(string $filtr){
    $url = "https://wsinf.potkal.pl/api/v1/autos/findByTag".$filtr;
    $respond = $this->call_get($url,$this->get_token());
    return $respond;
  }

  public function getOfferDetail(string $offerid){
    $url = "https://wsinf.potkal.pl/api/v1/autos/".$offerid;
    $respond = $this->call_get($url,$this->get_token());
    return $respond;
  }

  public function setNewOffer(array $data){
    $url = "https://wsinf.potkal.pl/api/v1/autos";
    $respond = $this->call_put($url,$data,$this->get_token());
    return $respond;
  }

  public function setOffer(array $data){
    $url = "https://wsinf.potkal.pl/api/v1/autos";
    $respond = $this->call_post($url,$data,$this->get_token());
    return $respond;
  }

  public function delOffer(string $offerid){
    $url = "https://wsinf.potkal.pl/api/v1/autos/".$offerid;
    $respond = $this->call_delete($url,$this->get_token());
    return $respond;
  }

}