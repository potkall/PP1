<?php
session_start();
require('../classloader.php');

if(isset($_SESSION['user_name'])){

  if (isset($_GET['delOffer'])){
    $o = new cOto();
    $ret=array();
    $ret=$o->delOffer($_GET['delOffer']);

    header('Content-Type: application/json');
    echo json_encode($ret);
  }

  if (isset($_GET['getBoxess'])){
    $o = new cOto();
    $ret=array();
    $ret[0]=count($o->getOffers());
    $ret[1]=$o->getStats('dzis')[0]['RequestsToday'];
    $ret[2]=$o->getStats('ostatnie')[0]['LastCheck'];
    $ret[3]=$o->getStats('all')[0]['RequestsOverall'];
    
    header('Content-Type: application/json');
    echo json_encode($ret);
  }

  if (isset($_GET['getOffers'])){
    $o = new cOto();
    $ret=array();
    $ret['data']=array();
    $tmp=array();
    if (!isset($_GET['filters'])){
      $tmp=$o->getOffers();
    }
    else {
      $filters='?';
      $ttmp=array();
      if (isset($_GET['marka']))
        $marki=explode(',',$_GET['marka']);
      
      if (isset($_GET['nieoto']))
        $nieoto=explode(',',$_GET['nieoto']);
      
      $i=0;
      if (isset($_GET['marka'])&&$_GET['marka']!=''){
        foreach ($marki as $m) {
          if (isset($_GET['nieoto'])&&$_GET['nieoto']!=''){
            foreach ($nieoto AS $n){
              $x=boolval($n)? 'false' : 'true';
              $filters="?marka=".$m."&cena=".$_GET['cena']."&rocznik=".$_GET['rocznik']."&nieoto=".$x;
              // $ret['dbg'][]=$filters;
              // $ttmp=$o->getOffersFiltered($filters);
              $tmp=array_merge($tmp,$o->getOffersFiltered($filters));
              
            }
          }
          else {
            $filters="?marka=".$m."&cena=".$_GET['cena']."&rocznik=".$_GET['rocznik'];
            $tmp=array_merge($tmp,$o->getOffersFiltered($filters));
          }
        } 
      }
      else {
        if (isset($_GET['nieoto'])&&$_GET['nieoto']!=''){
          foreach ($nieoto AS $n){
            $x=boolval($n)? 'false' : 'true';
            $filters="?cena=".$_GET['cena']."&rocznik=".$_GET['rocznik']."&nieoto=".$x;
            // $ret['dbg'][]=$filters;
            // $ttmp=$o->getOffersFiltered($filters);
            $tmp=array_merge($tmp,$o->getOffersFiltered($filters));
            
          }
        }
        else {
          $filters="?cena=".$_GET['cena']."&rocznik=".$_GET['rocznik'];
          $tmp=array_merge($tmp,$o->getOffersFiltered($filters));
        }
      }
    }
    
    // $ret['tmp1']=$tmp;
    if ($tmp){
      $i=0;
      foreach ($tmp AS $value) {
        if ($value['id']=='')
          continue;
        $ret['data'][$i]['marka']=$value['marka'];
        $ret['data'][$i]['model']=$value['nazwa_krotka'];
        $ret['data'][$i]['miasto']=$value['miasto'].'/'.$value['wojewodztwo'];
        $ret['data'][$i]['cena']=$value['cena'].' '.$value['waluta'];
        $ret['data'][$i]['paliwo']=$value['paliwo'];
        $ret['data'][$i]['rocznik']=$value['rocznik'];
        $editBtn=($value['otomotoid']=='')?'<button onclick="editOffer(\''.$value['id'].'\')" class="btn btn-circle btn-warning"><i class="fa fa-edit"></i></button><button onclick="delOffer(\''.$value['id'].'\')" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></button>':'';
        $ret['data'][$i]['btns']='<button onclick="showOffer(\''.$value['id'].'\')" class="btn btn-circle btn-primary"><i class="fa fa-eye"></i></button>'.$editBtn;
        
        $tmp_marka[$i]=$value['marka'];
        if ($value['waluta']=='EUR')
          $tmp_cena[$i]=$value['cena']*4.21;
        else 
          $tmp_cena[$i]=$value['cena'];
        //z powodu dużego deficytu czasu, pozwolę sobie nie zrobić pobierania kursu euro i przemnażania, ustawię na sztywno kurs na poziomie 4.21
        //operację tę wykonałbym pobierając kurs euro poprzez api ze strony NBP
        $tmp_rocznik[$i]=$value['rocznik'];


        $i++;
      }

      if (!isset($_GET['filters'])){
        $ret['createfilters']=true;
        array_unshift($tmp_marka,'');
        $ret['filters']['marka']=array_values(array_unique($tmp_marka));
        $ret['filters']['cena']=max($tmp_cena);
        $ret['filters']['rocznik']['max']=max($tmp_rocznik);
        $ret['filters']['rocznik']['min']=min($tmp_rocznik);
        $ret['filters']['skad'][]=array('id'=>'','text'=>'');
        $ret['filters']['skad'][]=array('id'=>'0','text'=>'Tylko otoMoto');
        $ret['filters']['skad'][]=array('id'=>'1','text'=>'Tylko inne');
      }
    }
      
    header('Content-Type: application/json');
    echo json_encode($ret);
  }

  
}
else{
  header("Location: login.php");
}


?>