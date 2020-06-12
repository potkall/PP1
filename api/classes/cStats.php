<?php
class cStats{

  public function getPerday()
  { 
    $db = new cDb();
    try {
      $qs = "SELECT COUNT(id) AS `RequestsToday` FROM `pp_stats` WHERE DATE(`adddate`) = CURDATE()";
      $req = $db->getSelect($qs,array());
      header('Content-Type: application/json');
      echo json_encode($req);
    }
    catch(Exception $e){
      $ret['msg']=$e->getMessage();
      header("HTTP/1.1 400 Invalid status value");
      echo json_encode($ret);
    }
  }

  public function getOverall()
  { 
    $db = new cDb();
    try {
      $qs = "SELECT COUNT(id) AS `RequestsOverall` FROM `pp_stats`";
      $req = $db->getSelect($qs,array());
      header('Content-Type: application/json');
      echo json_encode($req);
    }
    catch(Exception $e){
      $ret['msg']=$e->getMessage();
      header("HTTP/1.1 400 Invalid status value");
      echo json_encode($ret);
    } 
  }

  public function getLastcheck()
  { 
    $db = new cDb();
    try {
      $qs = "SELECT MAX(insertdate) AS LastCheck FROM `pp_otomoto`";
      $req = $db->getSelect($qs,array());
      header('Content-Type: application/json');
      echo json_encode($req);
    }
    catch(Exception $e){
      $ret['msg']=$e->getMessage();
      header("HTTP/1.1 400 Invalid status value");
      echo json_encode($ret);
    }
  }
    
}