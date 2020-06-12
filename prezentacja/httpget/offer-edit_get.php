<?php
session_start();
require('../classloader.php');

if(isset($_SESSION['user_name'])){

  if (isset($_POST['setOffer'])){
    $o = new cOto();
    $ret=array();
    if ($_POST['setOffer']=='')
      $ret=$o->setNewOffer($_POST['dane']);
    else 
      $ret=$o->setOffer(array('id'=>$_POST['setOffer'],'txt'=>$_POST['dane']['txt']));
       
    header('Content-Type: application/json');
    echo json_encode($ret);
  }

  
}
else{
  header("Location: login.php");
}


?>