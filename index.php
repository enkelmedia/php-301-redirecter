<?php

$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
$hostAndPath = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$hostAndPath = stripTrailingSlash($hostAndPath);

$strJsonContent = file_get_contents("redirects.json");
$jsonFile = json_decode($strJsonContent);       


foreach($jsonFile->redirects as $redirect)
{
    // Compare this redirect with the current request, if there is a match. Perform a 302 redirect.
    if($hostAndPath == stripTrailingSlash($redirect->origin))
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $redirect->destination);
        exit();
    }    
}


// If no redirect has been performed at this stage, look to see if the redirect should be stored in the redirects-file.
$strNotFoundContent = file_get_contents("notFound.json");

if (strpos($strNotFoundContent, $hostAndPath) !== false) {}
else{
    // This url is not in the "notFound" file already, let's add it.
    file_put_contents ("notFound.json", $hostAndPath . "\n",FILE_APPEND);
}

// Redirect to the default page
header('HTTP/1.1 301 Moved Permanently');
header('Location: ' . $jsonFile->defaultRedirect);
exit();




/* ------------------ functions ---------------------- */

function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}

function stripTrailingSlash($url)
{
    if(!endsWith($url, "/"))
        return $url;
    
    return substr($url, 0, strlen($url) - 1);
}


?>