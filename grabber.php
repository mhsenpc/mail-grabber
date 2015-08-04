<?php
    include_once("curl.php");
    
    $link= urldecode( $_GET['link']);
        
    $url_pattern="/\b(?:(?:http?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
    $mail_pattern="/[a-z0-9_\+-]+(\.[a-z0-9_\+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2,4})/";
    
    //download page
    $page=Curl_download($link);

    //first part: save emails
    preg_match_all($mail_pattern,$page,$emails);
    $emails=$emails[0];
    foreach($emails as $email){
        echo $email."\n";
    }
    
    //then find links in page and crawl them too
    preg_match_all($url_pattern,$page,$urls);

    $urls=$urls[0];
    foreach($urls as $url){
        echo $url."\n";

    }

    
    function IsInBlacklist($surl){
        //check if url isn't in the black list :
        //extension
        $pi=pathinfo($surl);
        $blacklist=array('css','jpg','png','bmp','gif','swf','js','mp3','wav','wma','wmv','avi','mkv','zip','rar','ico');
        if(!empty($pi['extension']))
        {
            if(in_array($pi['extension'],$blacklist))
                return true;
            else
                return false;
        }
        return false;
    }
?>