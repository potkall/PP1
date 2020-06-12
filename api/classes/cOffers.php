<?php
class cOffers{

  function __construct() {
    
  }

  public function getAutosFilter(string $method, string $request)
  { 
    $db = new cDb();
    $db->getDbHang()->beginTransaction();
    $ret=array();
    try{
      $filters = explode("&",substr($request,10));
      $qf = "";
      $arr= array();
      foreach ($filters AS $f){

        $f_tmp = explode("=",$f);
        if (count($f_tmp)!=2)
          throw new Exception("Wrong Pararam", 1);

        switch ($f_tmp[0]) {
          case 'cena':
            if (!strpos($f_tmp[1],'-'))
              throw new Exception("\"-\" required.", 1);
            
            $price= (explode("-",$f_tmp[1]));

            if (strlen($price[0]>0)) //xxx-;xxx-yyy
            {
              if (!is_numeric($price[0]))
                throw new Exception("First price must be a number", 1);

              if (strlen($price[1]>0)){//xxx-yyy
                if (!is_numeric($price[1]))
                  throw new Exception("Second price must be a number", 1);

                $qf.=" AND cena BETWEEN ? AND ?";
                array_push($arr,$price[0]);
                array_push($arr,$price[1]);
              }
              else {//xxx-
                $qf.=" AND cena >= ?";
                array_push($arr,$price[0]);
              }
              $this->addCounterQuerys($db, "filters",$f_tmp[0]);
            }
            else {//-yyy
              if (!is_numeric($price[1]))
                throw new Exception("Second price must be a number", 1);
              
                $qf.=" AND cena <= ?";
                array_push($arr,$price[1]);
            }
          break;
          case 'marka':
            if (strlen(trim($f_tmp[1]))>0){
              $qf.=" AND marka LIKE ?";
              array_push($arr,'%'.$f_tmp[1].'%');
              $this->addCounterQuerys($db, "filters",$f_tmp[0]);
            }
            else 
              throw new Exception("Parameter cannot be empty", 1);
          break;
          case 'model':
            if (strlen(trim($f_tmp[1]))>0){
              $qf.=" AND nazwa_krotka LIKE ?";
              array_push($arr,'%'.$f_tmp[1].'%');
              $this->addCounterQuerys($db, "filters",$f_tmp[0]);
            }
            else 
              throw new Exception("Parameter cannot be empty", 1);
          break;
          case 'rocznik':
            if (!strpos($f_tmp[1],'-'))
              throw new Exception("\"-\" required.", 1);
          
            $year= (explode("-",$f_tmp[1]));

            if (strlen($year[0]>0)) //xxx-;xxx-yyy
            {
              if (!is_numeric($year[0]))
                throw new Exception("First year must be a number", 1);

              if (strlen($year[1]>0)){//xxx-yyy
                if (!is_numeric($year[1]))
                  throw new Exception("Second year must be a number", 1);

                $qf.=" AND rocznik BETWEEN ? AND ?";
                array_push($arr,$year[0]);
                array_push($arr,$year[1]);
              }
              else {//xxx-
                $qf.=" AND rocznik >= ?";
                array_push($arr,$year[0]);
              }
              $this->addCounterQuerys($db, "filters",$f_tmp[0]);
            }
            else {//-yyy
              if (!is_numeric($year[1]))
                throw new Exception("Second year must be a number", 1);
              
                $qf.=" AND rocznik <= ?";
                array_push($arr,$year[1]);
            }
          break;
          case 'nieoto':
            $this->addCounterQuerys($db, "filters",$f_tmp[0]);
            if ($f_tmp[1]==="true")
              $qf.=" AND otomotoid IS NOT NULL";
            elseif ($f_tmp[1]==="false") 
              $qf.=" AND otomotoid IS NULL";
            else 
              throw new Exception("Parameter must be a boolean", 1);
          break;
          default:
            throw new Exception("Wrong parameter", 1);
        }
      }

      $qs = "SELECT `id`, `otomotolink`, `marka`, `nazwa_krotka`, `opis`, `rocznik`, `przebieg`, `pojemnosc`, `paliwo`, `cena`, `waluta`, `miasto`, `wojewodztwo`, `otomotoid` FROM `pp_otomoto` WHERE `status`=1 ".$qf;
      
      $ret = $db->getSelect($qs,$arr);
      header('Content-Type: application/json');
      echo json_encode($ret);

      $db->getDbHang()->commit();
    }
    catch(Exception $e){
      $db->getDbHang()->rollBack();
      $ret->msg=$e->getMessage();
      header("HTTP/1.1 400 Invalid status value");
      echo json_encode($ret);
    }
    
  }

  public function getAutosId(string $method, string $request)
  { 
    $db = new cDb();
    $ret=array();
    switch ($method) {
      case 'GET':
        $db->getDbHang()->beginTransaction();
        try{
          $qs="SELECT `id`, `otomotolink`, `marka`, `nazwa_krotka`, `opis`, `rocznik`, `przebieg`, `pojemnosc`, `paliwo`, `cena`, `waluta`, `miasto`, `wojewodztwo`, `otomotoid` FROM `pp_otomoto` WHERE id=?";
          $this->addCounterQuerys($db, "getAutosId", $request);
          $offer = $db->getSelect($qs,array($request));

          $qs="SELECT cena, insertdate AS `date` FROM `pp_otomoto` WHERE `otomotoid` IN (SELECT `otomotoid` FROM `pp_otomoto` WHERE id=?) order by insertdate ASC";
          $offer['history']=$db->getSelect($qs,array($request));

          header('Content-Type: application/json');
          echo json_encode($offer);
          $db->getDbHang()->commit();
        }
        catch(Exception $e){
          $db->getDbHang()->rollBack();
          $ret->msg=$e->getMessage();
          header("HTTP/1.1 400 Invalid status value");
          echo json_encode($ret);
        }
      break;
      case 'DELETE':
        $db->getDbHang()->beginTransaction();
        try{
          
          $qd="UPDATE `pp_otomoto` SET `status`=0 WHERE id=?";
          $db->GetExecute($qd,array($request));
          $db->getDbHang()->commit();
        }
        catch(Exception $e){
          $db->getDbHang()->rollBack();
          $ret->msg=$e->getMessage();
          header("HTTP/1.1 400 Invalid status value");
          echo json_encode($ret);
        }
      break;
    }
  }

  public function getAutos(string $method)//=NULL
  { 
    $db = new cDb();
    $ret=array();
    switch ($method) {
      case 'GET':
        $db->getDbHang()->beginTransaction();
        try {
          $qs = "SELECT `id`, `otomotolink`, `marka`, `nazwa_krotka`, `opis`, `rocznik`, `przebieg`, `pojemnosc`, `paliwo`, `cena`, `waluta`, `miasto`, `wojewodztwo`, `otomotoid` FROM `pp_otomoto` WHERE `status`=1 ";
          $offers = $db->getSelect($qs,array());
          $this->addCounterQuerys($db, "getAutos", "GetAll");

          header('Content-Type: application/json');
          echo json_encode($offers);

          $db->getDbHang()->commit();
        }
        catch(Exception $e){
          $db->getDbHang()->rollBack();
          $ret->msg=$e->getMessage();
          header("HTTP/1.1 400 Invalid status value");
          echo json_encode($ret);
        }
      break;
      case 'PUT':
        
        $db->getDbHang()->beginTransaction();
        try {
          $putfp = fopen('php://input', 'r');
          $putdata = '';
          while($data = fread($putfp, 1024))
              $putdata .= $data;
          fclose($putfp);
          $putdata_arr = json_decode($putdata);

          //sprawdzenie pól
          if ($putdata_arr->link!=''&&!filter_var($putdata_arr->link, FILTER_VALIDATE_URL))
            throw new Exception("Wrong Pararam", 1);
          if (!is_string($putdata_arr->marka)||strlen($putdata_arr->marka)>128)
            throw new Exception("Wrong Pararam", 1);
          if (!is_string($putdata_arr->model)||strlen($putdata_arr->model)>256)
            throw new Exception("Wrong Pararam", 1);
          if (!is_string($putdata_arr->txt)||strlen($putdata_arr->txt)>1024)
            throw new Exception("Wrong Pararam", 1);
          if (!is_string($putdata_arr->paliwo)||strlen($putdata_arr->paliwo)>32)
            throw new Exception("Wrong Pararam", 1);
          if (!is_string($putdata_arr->waluta)||strlen($putdata_arr->waluta)>3)
            throw new Exception("Wrong Pararam", 1);
          if (!is_string($putdata_arr->miasto)||strlen($putdata_arr->miasto)>96)
            throw new Exception("Wrong Pararam", 1);
          if (!is_string($putdata_arr->wojewodztwo)||strlen($putdata_arr->wojewodztwo)>96)
            throw new Exception("Wrong Pararam", 1);
          
          if (!is_numeric($putdata_arr->rocznik)||strlen((string)$putdata_arr->rocznik)>4)
            throw new Exception("Wrong Pararam", 1);
          if (!is_numeric($putdata_arr->przebieg)||strlen((string)$putdata_arr->przebieg)>11)
            throw new Exception("Wrong Pararam", 1);
          if (!is_numeric($putdata_arr->pojemnosc)||strlen((string)$putdata_arr->pojemnosc)>11)
            throw new Exception("Wrong Pararam", 1);
          if (!is_numeric($putdata_arr->cena)||strlen((string)$putdata_arr->cena)>8)
            throw new Exception("Wrong Pararam", 1);
          
          $qs="SELECT id FROM pp_otomoto WHERE otomotolink=? AND marka=? AND nazwa_krotka=? AND rocznik=? AND przebieg=? AND pojemnosc=? AND paliwo=? AND miasto=? AND wojewodztwo=? AND `status`=1";

          $qi="INSERT INTO `pp_otomoto`(`id`, `otomotolink`, `marka`, `nazwa_krotka`, `opis`, `rocznik`, `przebieg`, `pojemnosc`, `paliwo`, `cena`, `waluta`, `miasto`, `wojewodztwo`, `insertdate`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),1)";

          //args do $qs
          $sqlargs=array();
          array_push($sqlargs, $putdata_arr->link);//otomotolink
          array_push($sqlargs, $putdata_arr->marka);//marka
          array_push($sqlargs, $putdata_arr->model);//nazwa_krotka
          array_push($sqlargs, $putdata_arr->rocznik);//rocznik
          array_push($sqlargs, $putdata_arr->przebieg);//przebieg
          array_push($sqlargs, $putdata_arr->pojemnosc);//pojemnosc
          array_push($sqlargs, $putdata_arr->paliwo);//paliwo
          array_push($sqlargs, $putdata_arr->miasto);//miasto
          array_push($sqlargs, $putdata_arr->wojewodztwo);//wojewodztwo

          $olds = $db->getSelect($qs,$sqlargs);
          if ($olds)
          {
            // foreach ($olds AS $o) {
            //   $qu = "UPDATE `pp_otomoto` SET `status`=0 WHERE id=?";
            //   $db->GetExecute($qu,array($o['id']));
            // }
          }
          
          //args do $qi
          $sqlargs=array();
          array_push($sqlargs,(new cGuid())->create_guid());
          array_push($sqlargs, $putdata_arr->link);//otomotolink
          array_push($sqlargs, $putdata_arr->marka);//marka
          array_push($sqlargs, $putdata_arr->model);//nazwa_krotka
          array_push($sqlargs, $putdata_arr->txt);//opis
          array_push($sqlargs, $putdata_arr->rocznik);//rocznik
          array_push($sqlargs, $putdata_arr->przebieg);//przebieg
          array_push($sqlargs, $putdata_arr->pojemnosc);//pojemnosc
          array_push($sqlargs, $putdata_arr->paliwo);//paliwo
          array_push($sqlargs, $putdata_arr->cena);//cena
          array_push($sqlargs, $putdata_arr->waluta);//waluta
          array_push($sqlargs, $putdata_arr->miasto);//miasto
          array_push($sqlargs, $putdata_arr->wojewodztwo);//wojewodztwo
          $inserted = $db->GetExecute($qi,$sqlargs);

          $db->getDbHang()->commit();
          //  echo json_encode($inserted);
        }
        catch(Exception $e){
          $db->getDbHang()->rollBack();
          $ret=$e->getMessage();
          header("HTTP/1.1 400 Invalid status value");
          echo json_encode($ret);
        }
        header('Content-Type: application/json');
        echo json_encode($ret);
      break;
      case 'POST':
        $putfp = fopen('php://input', 'r');
          $putdata = '';
          while($data = fread($putfp, 1024))
              $putdata .= $data;
          fclose($putfp);
          $putdata_arr = json_decode($putdata);
        // echo $putdata;
        $db->getDbHang()->beginTransaction();
        try{
          if (!is_string($putdata_arr->txt)||strlen($putdata_arr->txt)>1024)
            throw new Exception("Wrong Pararam", 1);

          $qu="UPDATE `pp_otomoto` SET `opis`=? WHERE id=?";
          $db->GetExecute($qu,array($putdata_arr->txt, $putdata_arr->id));
          $db->getDbHang()->commit();
          // $ret->msg='ok';
        }
        catch(Exception $e){
          $db->getDbHang()->rollBack();
          $ret['msg']=$e->getMessage();
          header("HTTP/1.1 400 Invalid status value");
          echo json_encode($ret);
        }
        // echo json_encode('|$_POST|');
        echo json_encode($ret);
      break;
    }
  }

  private function addCounterQuerys(cDb $db, string $type, string $filter=NULL)
  {
    $c=array();
    if (isset($filter)){
      $qs = "SELECT MAX(counter) as count FROM pp_stats WHERE countertype=? AND countername=?";
      $c = $db->getSelect($qs,array($type, $filter));
    }
    else {
      $qs = "SELECT MAX(counter) as count FROM pp_stats WHERE countertype=?";
      $c = $db->getSelect($qs,array($type));
    }
    if ($c)
      if (is_numeric($c[0]['count'])&&intval($c[0]['count'])>0)
        $counter = intval($c[0]['count']);
      else 
      $counter=0;
    else 
      $counter=0;
    $counter ++;
    $qi="INSERT INTO `pp_stats`(`counter`, `countername`, `countertype`) VALUES (?,?,?)";
    $tmp = $db->getExecute($qi,array($counter, $filter, $type));
  }

}