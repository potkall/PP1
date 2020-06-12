<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);	
echo "start";echo '<br>';
require('classloader.php');

 $aaa=new cOto();
var_dump($aaa->get_token());
echo '<br>';
echo '<br>';
var_dump($aaa->setNewOffer(array("a"=>'1')));
echo '<br>';
echo '<br>';


// var_dump($aaa->getStats('ostatnie'));echo '<br>';

// var_dump($aaa->getOffers());

echo "koniec"; 
echo '<pre>array(45) {\n  [\"USER\"]=>\n  string(6) \"potkal\"\n  [\"HOME\"]=>\n  string(25) \"\/var\/www\/vhosts\/potkal.pl\"\n  [\"SCRIPT_NAME\"]=>\n  string(11) \"\/api\/v1.php\"\n  [\"REQUEST_URI\"]=>\n  string(13) \"\/api\/v1\/autos\"\n  [\"QUERY_STRING\"]=>\n  string(15) \"rquest=v1\/autos\"\n  [\"REQUEST_METHOD\"]=>\n  string(3) \"PUT\"\n  [\"SERVER_PROTOCOL\"]=>\n  string(8) \"HTTP\/1.0\"\n  [\"GATEWAY_INTERFACE\"]=>\n  string(7) \"CGI\/1.1\"\n  [\"REDIRECT_URL\"]=>\n  string(13) \"\/api\/v1\/autos\"\n  [\"REDIRECT_QUERY_STRING\"]=>\n  string(15) \"rquest=v1\/autos\"\n  [\"REMOTE_PORT\"]=>\n  string(5) \"54556\"\n  [\"SCRIPT_FILENAME\"]=>\n  string(52) \"\/var\/www\/vhosts\/potkal.pl\/wsinf.potkal.pl\/api\/v1.php\"\n  [\"SERVER_ADMIN\"]=>\n  string(14) \"root@localhost\"\n  [\"CONTEXT_DOCUMENT_ROOT\"]=>\n  string(41) \"\/var\/www\/vhosts\/potkal.pl\/wsinf.potkal.pl\"\n  [\"CONTEXT_PREFIX\"]=>\n  string(0) \"\"\n  [\"REQUEST_SCHEME\"]=>\n  string(5) \"https\"\n  [\"DOCUMENT_ROOT\"]=>\n  string(41) \"\/var\/www\/vhosts\/potkal.pl\/wsinf.potkal.pl\"\n  [\"REMOTE_ADDR\"]=>\n  string(13) \"91.231.140.78\"\n  [\"SERVER_PORT\"]=>\n  string(3) \"443\"\n  [\"SERVER_ADDR\"]=>\n  string(13) \"91.231.140.78\"\n  [\"SERVER_NAME\"]=>\n  string(15) \"wsinf.potkal.pl\"\n  [\"SERVER_SOFTWARE\"]=>\n  string(6) \"Apache\"\n  [\"SERVER_SIGNATURE\"]=>\n  string(0) \"\"\n  [\"PATH\"]=>\n  string(49) \"\/usr\/local\/sbin:\/usr\/local\/bin:\/usr\/sbin:\/usr\/bin\"\n  [\"CONTENT_TYPE\"]=>\n  string(16) \"application\/json\"\n  [\"HTTP_ACCEPT\"]=>\n  string(3) \"*\/*\"\n  [\"CONTENT_LENGTH\"]=>\n  string(3) \"163\"\n  [\"HTTP_CONNECTION\"]=>\n  string(5) \"close\"\n  [\"HTTP_X_ACCEL_INTERNAL\"]=>\n  string(31) \"\/internal-nginx-static-location\"\n  [\"HTTP_X_REAL_IP\"]=>\n  string(13) \"91.231.140.78\"\n  [\"HTTP_HOST\"]=>\n  string(15) \"wsinf.potkal.pl\"\n  [\"proxy-nokeepalive\"]=>\n  string(1) \"1\"\n  [\"HTTPS\"]=>\n  string(2) \"on\"\n  [\"PERL5LIB\"]=>\n  string(49) \"\/usr\/share\/awstats\/lib:\/usr\/share\/awstats\/plugins\"\n  [\"HTTP_AUTHORIZATION\"]=>\n  string(46) \"AuthSub token=\"123123123123123123123123123123\"\"\n  [\"UNIQUE_ID\"]=>\n  string(27) \"XuPgBtkfjQGl8hvcvIgZvgAAAc8\"\n  [\"REDIRECT_STATUS\"]=>\n  string(3) \"200\"\n  [\"REDIRECT_HTTPS\"]=>\n  string(2) \"on\"\n  [\"REDIRECT_PERL5LIB\"]=>\n  string(49) \"\/usr\/share\/awstats\/lib:\/usr\/share\/awstats\/plugins\"\n  [\"REDIRECT_HTTP_AUTHORIZATION\"]=>\n  string(46) \"AuthSub token=\"123123123123123123123123123123\"\"\n  [\"REDIRECT_UNIQUE_ID\"]=>\n  string(27) \"XuPgBtkfjQGl8hvcvIgZvgAAAc8\"\n  [\"FCGI_ROLE\"]=>\n  string(9) \"RESPONDER\"\n  [\"PHP_SELF\"]=>\n  string(11) \"\/api\/v1.php\"\n  [\"REQUEST_TIME_FLOAT\"]=>\n  float(1591992326.8007)\n  [\"REQUEST_TIME\"]=>\n  int(1591992326)\n}\n<\/pre>Not exist1"';

?>

