<?php
    file_put_contents("scrap-otomoto-cron.log","[".date("Y-m-d H:i:s")."] - Start script".PHP_EOL,FILE_APPEND);
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require("classloader.php");

    $url="https://www.otomoto.pl/osobowe/?page=";
    $max_pages=1;
    $dom = new DOMDocument();

    //pierwsza strona do pobrania ilości podstron
    $internalErrors = libxml_use_internal_errors(true);
    $dom->loadHtml(file_get_contents($url."1"));
    libxml_use_internal_errors($internalErrors);

    //wyszukanie paginacji i znalezienie maksymalnej wartości
    $uls=$dom->getElementsByTagName('ul');
    foreach ($uls as $i=>$val)
    {
        $el_class=$val->getAttribute('class'); 
        if ($el_class=="om-pager rel")
        {
            $pag_li = $val->getElementsByTagName('li');
            $li_items = $pag_li->length;
            $max_pages = $pag_li->item($li_items-2)->nodeValue;
        }   
    }
    
    //zmniejszenie podstron ze względu na parametry hostingu
    $max_pages=50;
    $br="<br>";
    $sqlarray=array();
    file_put_contents("scrap-otomoto-cron.log","[".date("Y-m-d H:i:s")."] - Pages=".$max_pages.PHP_EOL,FILE_APPEND);
    for ($i=1;$i<$max_pages;$i++)
    {
        $internalErrors = libxml_use_internal_errors(true);
        $ttmp=file_get_contents($url.$i);
        if ($ttmp)
            $dom->loadHtml($ttmp);
        else
            continue;
        libxml_use_internal_errors($internalErrors);
        $autos = $dom->getElementsByTagName('article');
        foreach ($autos as $auto)
        {
            $sqlargs=array();
            $auto_block = new DomDocument;
            $auto_block->appendChild($auto_block->importNode($auto, true));   
            $finder = new DomXPath($auto_block);

            array_push($sqlargs,(new cGuid())->create_guid());

            //otomotoid
            array_push($sqlargs,$auto->getAttribute('data-ad-id'));
            //linkotomoto
            array_push($sqlargs,$auto->getAttribute('data-href'));
            //marka
            array_push($sqlargs,$auto->getAttribute('data-param-make'));

            $tag = $finder->query("//*[contains(@class, 'offer-title__link')]");
            if ($tag->length==1)
                array_push($sqlargs,trim($tag->item(0)->textContent));
            else if ($tag->length>1)
                array_push($sqlargs,"Array()");
            else array_push($sqlargs,"");

            $tag = $finder->query("//*[contains(@class, 'offer-item__subtitle')]");
            if ($tag->length==1)
                array_push($sqlargs,trim($tag->item(0)->textContent));
            else if ($tag->length>1)
                array_push($sqlargs,"Array()");
            else array_push($sqlargs,"");

            $tag = $finder->query("//*[contains(@data-code, 'year')]");
            if ($tag->length==1)
                array_push($sqlargs,trim($tag->item(0)->textContent));
            else if ($tag->length>1)
                array_push($sqlargs,"Array()");
            else array_push($sqlargs,"0");
            
            $tag = $finder->query("//*[contains(@data-code, 'mileage')]");
            if ($tag->length==1)
                array_push($sqlargs,intval(str_replace(' ','',trim($tag->item(0)->textContent))));
            else if ($tag->length>1)
                array_push($sqlargs,"Array()");
            else array_push($sqlargs,"0");
            
            $tag = $finder->query("//*[contains(@data-code, 'engine_capacity')]");
            if ($tag->length==1)
                array_push($sqlargs,intval(str_replace(' ','',trim($tag->item(0)->textContent))));
            else if ($tag->length>1)
                array_push($sqlargs,"Array()");
            else array_push($sqlargs,"0");
            
            $tag = $finder->query("//*[contains(@data-code, 'fuel_type')]");
            if ($tag->length==1)
                array_push($sqlargs,trim($tag->item(0)->textContent));
            else if ($tag->length>1)
                array_push($sqlargs,"Array()");
            else array_push($sqlargs,"");
            
            $tag = $finder->query("//*[contains(@class, 'offer-price__number')]");
            if ($tag->length==1)
                array_push($sqlargs,intval(str_replace(' ','',trim($tag->item(0)->textContent))));
            else if ($tag->length>1)
                array_push($sqlargs,"Array()");
            else array_push($sqlargs,"0");
            
            $tag = $finder->query("//*[contains(@class, 'offer-price__currency')]");
            if ($tag->length==1)
                array_push($sqlargs,trim($tag->item(0)->textContent));
            else if ($tag->length>1)
                array_push($sqlargs,"Array()");
            else array_push($sqlargs,"");
            
            $tag = $finder->query("//*[contains(@class, 'ds-location-city')]");
            if ($tag->length==1)
                array_push($sqlargs,trim($tag->item(0)->textContent));
            else if ($tag->length>1)
                array_push($sqlargs,"Array()");
            else array_push($sqlargs,"");
            
            $tag = $finder->query("//*[contains(@class, 'ds-location-region')]");
            if ($tag->length==1)
                array_push($sqlargs,substr(trim($tag->item(0)->textContent),1,-1));
            else if ($tag->length>1)
                array_push($sqlargs,"Array()");
            else array_push($sqlargs,"");
            
            array_push($sqlarray,$sqlargs);
        }
        
    }
    $db=new cDb();
    $db->getDbHang()->beginTransaction();
    $err=array();
    try{
        $qu1="UPDATE `pp_otomoto` SET `status`=? WHERE otomotoid IS NOT NULL";
        $qi1="INSERT INTO `pp_otomoto`(`id`, `otomotoid`, `otomotolink`, `marka`, `nazwa_krotka`, `opis`, `rocznik`, `przebieg`, `pojemnosc`, `paliwo`, `cena`, `waluta`, `miasto`, `wojewodztwo`, `insertdate`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),1)";
        $db->GetExecute($qu1,array(0));
        foreach ($sqlarray as $arr) {
            $err=$arr;
            $db->GetExecute($qi1,$arr);
        }
        $db->getDbHang()->commit();
    }
    catch(Exception $e){
        $db->getDbHang()->rollBack();
        file_put_contents("scrap-otomoto-cron.log","[".date("Y-m-d H:i:s")."] - error:".$e->getMessage().PHP_EOL."     ".serialize($err).PHP_EOL,FILE_APPEND);
        echo $e->getMessage();
    }
    file_put_contents("scrap-otomoto-cron.log","[".date("Y-m-d H:i:s")."] - end script".PHP_EOL.PHP_EOL,FILE_APPEND);

?>