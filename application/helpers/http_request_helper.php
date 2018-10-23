<?php
if ( ! function_exists('http_request')) {
    function http_request($data, $method, $url){
        $postdata = http_build_query($data);
        
        $opts = array('http' =>
            array(
                'method'  => $method,
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        
        $context  = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);

        return $result;
    }
}