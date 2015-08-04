<?php

function async_get($url)
  {
      $parts=parse_url($url,PHP_URL_PATH);

      $fp = fsockopen($parts['host'],
          isset($parts['port'])?$parts['port']:80,
          $errno, $errstr, 30);

      $out = "GET ".$parts['path']." HTTP/1.1\r\n";
      $out.= "Host: ".$parts['host']."\r\n";
      $out.= "Connection: open\r\n\r\n";
      fwrite($fp, $out);
      fclose($fp);
  }


function Curl_download($Url){
	    // is cURL installed yet?
	    if (!function_exists('curl_init')){
	        die('Sorry cURL is not installed!');
	    }
	 
	    // OK cool - then let's create a new cURL resource handle
	    $ch = curl_init();
	 
	    // Now set some options (most are optional)
	 
	    // Set URL to download
	    curl_setopt($ch, CURLOPT_URL, $Url);
	 
	    // Set a referer
	    curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
	 
	    // User agent
	    curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
	 
	    // Include header in result? (0 = yes, 1 = no)
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    
		// Should cURL return or print out the data? (true = return, false = print)
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 
	    // Timeout in seconds
	    curl_setopt($ch, CURLOPT_TIMEOUT, 50);
 
	    // Download the given URL, and return output
	    $output = curl_exec($ch);
	 
	    // Close the cURL resource, and free system resources
	    curl_close($ch);
	 
	    return $output;
	}