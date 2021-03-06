<?php
function myClassLoader(string $className, bool $debug=false)
{
  if ($debug){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);	
  }

  $files = 'classes/'.$className.'.php'; 
  if(file_exists($files)){
    require($files);
  }
  return true;
}

function myClassLoader1(string $className, bool $debug=false)
{
  if ($debug){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);	
  }
  $files = '../../classes/'.$className.'.php';
  if(file_exists($files)){
    require($files);
  }
  return true;
}

function myClassLoader2(string $className, bool $debug=false)
{
  if ($debug){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);	
  }
  $files = '../classes/'.$className.'.php';
  if(file_exists($files)){
    require($files);
  }
  return true;
}

spl_autoload_register('myClassLoader', true);
spl_autoload_register('myClassLoader1', true);
spl_autoload_register('myClassLoader2', true);