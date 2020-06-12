<?php
class cScrapper {
	
    function getContent(String $url)
    {
        echo file_get_contents($url);
    }
}

?>

