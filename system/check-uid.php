<?php
function uid($type,$respawn,$token){
if($type == 'bv'){
$url = 'https://autofb.pro/api/checklinkfb/check_post/';    
$data = '{"id_user":13128,"link":"'.$respawn.'"}';
$curl = curl_init();    
curl_setopt_array($curl, array(
      CURLOPT_URL => "$url",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>"$data",
      CURLOPT_HTTPHEADER => array(
        "user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.150 Mobile Safari/537.36",
        "content-type: application/json",
        "origin: https://autofb.pro",
        "ht-token: $token"),
    ));  
    curl_setopt($curl, CURLOPT_HEADER, 0);
    $checkin21a = curl_exec($curl); 
    curl_close($curl);
$obja4 = json_decode($checkin21a);
$status23 = $obja4-> status;
if($status23 == 200){
$id = $obja4-> id;
}else{
$id = $respawn;    
}
}elseif($type == 'cmt'){
$respawn = explode("comment_id=", $respawn);
$id1 =  $respawn['1'];
$respawn = explode("/", $id1);
$id =  $respawn['0'];
}elseif($type == 'bvins'){
$respawn = explode("p/", $respawn);
$id1 =  $respawn['1'];
$respawn = explode("/", $id1);
$id =  $respawn['0'];
}elseif($type == 'uidins'){
$respawn = explode("instagram.com/", $respawn);
$id1 =  $respawn['1'];
$respawn = explode("/", $id1);
$id =  $respawn['0'];
}elseif($type == 'bvyoutube'){
$respawn = explode("?v=", $respawn);
$id1 =  $respawn['1'];
$respawn = explode("&", $id1);
$id =  $respawn['0'];
}elseif($type == 'bvtiktok'){
$respawn = explode("video/", $respawn);
$id1 =  $respawn['1'];
$respawn = explode("?", $id1);
$id =  $respawn['0'];
}elseif($type == 'uidtiktok'){
$respawn = explode("tiktok.com/@", $respawn);
$id1 =  $respawn['1'];
$respawn = explode("/", $id1);
$id =  $respawn['0'];
}elseif($type == 'uidyoutube'){
$respawn = explode("channel/", $respawn);
$id1 =  $respawn['1'];
$respawn = explode("/", $id1);
$id =  $respawn['0'];
}elseif($type == 'group'){
$respawn = explode("groups/", $respawn);
$id1 =  $respawn['1'];
$respawn = explode("/", $id1);
$id =  $respawn['0'];
}elseif($type == 'video'){
$respawn = explode("videos/", $respawn);
$id1 =  $respawn['1'];
$respawn = explode("live/?v=", $id1);
$id1 =  $respawn['1'];
$respawn = explode("/", $id1);
$id =  $respawn['0'];
}elseif($type == 'uid'){
$url = 'https://autofb.pro/api/checklinkfb/check/';    
$data = '{"id_user":13128,"link":"'.$respawn.'"}';
$curl = curl_init();    
curl_setopt_array($curl, array(
      CURLOPT_URL => "$url",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>"$data",
      CURLOPT_HTTPHEADER => array(
        "user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.150 Mobile Safari/537.36",
        "content-type: application/json",
        "origin: https://autofb.pro",
        "ht-token: $token"),
    ));  
    curl_setopt($curl, CURLOPT_HEADER, 0);
    $checkin21a = curl_exec($curl); 
    curl_close($curl);
$obja4 = json_decode($checkin21a);
$status23 = $obja4-> status;
if($status23 == 200){
$id = $obja4-> id;
}else{
$id = $respawn;    
}
}else{
$id = $respawn;     
}
return $id;
}


function oder($url,$token,$path,$referer,$data){
$curl = curl_init();    
curl_setopt_array($curl, array(
      CURLOPT_URL => "$url",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>"$data",
      CURLOPT_HTTPHEADER => array(
        "user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.150 Mobile Safari/537.36",
        "content-type: application/json",
        "origin: https://autofb.pro",
        "ht-token: $token"),
    ));  
    curl_setopt($curl, CURLOPT_HEADER, 0);
    $response = curl_exec($curl); 
    curl_close($curl);
    return $response; 
        }
 function odervip($url,$token,$path,$referer,$data){

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => ''.$url.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>''.$data.'',
  CURLOPT_HTTPHEADER => array(
    'ht-token: '.$token.'',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;     
 }    
function check_id($data,$token){
$curl = curl_init();    
curl_setopt_array($curl, array(
      CURLOPT_URL => "https://autofb.pro/api/checklinkfb/check/",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>"$data",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/json",
        "origin: https://autofb.pro",
        "ht-token: $token"),
    ));  
    curl_setopt($curl, CURLOPT_HEADER, 0);
    $response = curl_exec($curl); 
    curl_close($curl);
    return $response; 
        } 
           function check_name($data,$token){
$curl = curl_init();    
curl_setopt_array($curl, array(
      CURLOPT_URL => "https://autofb.pro/api/checklinkfb/getnameuser/",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>"$data",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/json",
        "origin: https://autofb.pro",
        "ht-token: $token"),
    ));  
    curl_setopt($curl, CURLOPT_HEADER, 0);
    $response = curl_exec($curl); 
    curl_close($curl);
    return $response; 
        }      
function check_tiktok($data,$token){
$curl = curl_init();    
curl_setopt_array($curl, array(
      CURLOPT_URL => "https://autofb.pro/api/tiktok_buff/getinfotiktok",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>"$data",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/json",
        "origin: https://autofb.pro",
        "ht-token: $token"),
    ));  
    curl_setopt($curl, CURLOPT_HEADER, 0);
    $response = curl_exec($curl); 
    curl_close($curl);
    return $response; 
        } 
function curl_send1($path,$url,$post_data,$token){
$curl = curl_init();    
curl_setopt_array($curl, array(
      CURLOPT_URL => "$url",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>"$post_data",
      CURLOPT_HTTPHEADER => array(
        "authority:thuycute.hoangvanlinh.vn",
       "path: $path",
        "cache-control: no-cache",
        "accept: application/json, text/javascript, */*; q=0.01",
        "x-requested-with: XMLHttpRequest",
        "user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.150 Mobile Safari/537.36",
        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
        "origin: https://thuycute.hoangvanlinh.vn",
        "sec-fetch-site: same-origin",
        "sec-fetch-mode: cors",
        "sec-fetch-dest: empty",
        "api-token: $token",
        "referer: $url"
        ),
    ));  
    curl_setopt($curl, CURLOPT_HEADER, 0);
    $response = curl_exec($curl);  
    return $response; 
        }
function oderbao($url,$token,$data){
$curl = curl_init();    
curl_setopt_array($curl, array(
      CURLOPT_URL => "$url",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>"$data",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/json",
        "api-key: $token"),
    ));  
    curl_setopt($curl, CURLOPT_HEADER, 0);
    $response = curl_exec($curl); 
    curl_close($curl);
    return $response; 
        }        
function respawnver4($url,$data){
$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;    
} 
function checkstatus($url,$token,$patch,$referer,$data){
$curl = curl_init();    
curl_setopt_array($curl, array(
      CURLOPT_URL => "$url",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_POSTFIELDS =>"",
      CURLOPT_HTTPHEADER => array(
        "authority: autofb.pro",
       "path: $patch",
        "accept: application/json, text/plain, */*",
        "accept-encoding: application/json, text/plain, */*",
        "x-requested-with: XMLHttpRequest",
        "user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.150 Mobile Safari/537.36",
        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
        "origin: https://autofb.pro",
        "sec-fetch-site: same-origin",
        "sec-fetch-mode: cors",
        "sec-fetch-dest: empty",
        "referer: $referer",
        "ht-token:$token"
        ),
    ));  
    curl_setopt($curl, CURLOPT_HEADER, 0);
    $response = curl_exec($curl); 
    curl_close($curl);
    return $response; 
        }
function checksubgiare($url,$referer,$token,$data){
$curl = curl_init();    
curl_setopt_array($curl, array(
      CURLOPT_URL => "$url",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_HTTPHEADER => array(
        "authority: thuycute.hoangvanlinh.vn",
       "path: /service/facebook/comment-sale/list",
        "cache-control: no-cache",
        "accept: application/json, text/javascript, */*; q=0.01",
        "x-requested-with: XMLHttpRequest",
        "user-agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.150 Mobile Safari/537.36",
        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
        "origin: https://thuycute.hoangvanlinh.vn",
        "sec-fetch-site: same-origin",
        "sec-fetch-mode: cors",
        "sec-fetch-dest: empty",
        "api-token: $token",
        "referer: $referer"
        ),
  CURLOPT_POSTFIELDS => 'code_orders='.$data.'',
    ));  
    curl_setopt($curl, CURLOPT_HEADER, 0);
    
    $response2 = curl_exec($curl);  
        curl_close($curl);
    return $response2; 
        }  
function get_cookie($usernametraodoisub,$passtraodoisub){
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://traodoisub.com/scr/login.php",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>"username=$usernametraodoisub&password=$passtraodoisub",
      CURLOPT_HTTPHEADER => array(
        "authority: traodoisub.com",
        "pragma: no-cache",
        "cache-control: no-cache",
        "accept: application/json, text/javascript, */*; q=0.01",
        "x-requested-with: XMLHttpRequest",
        "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36 Edg/84.0.522.52",
        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
        "origin: https://traodoisub.com",
        "sec-fetch-site: same-origin",
        "sec-fetch-mode: cors",
        "sec-fetch-dest: empty",
        "referer: https://traodoisub.com/",
        "accept-language: vi,en;q=0.9"
        ),
    ));
    curl_setopt($curl, CURLOPT_HEADER, 1);
    $response = curl_exec($curl);
    
    curl_close($curl);
    preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', 
          $response,  $match_found); 
$cookies = array(); 
foreach($match_found[1] as $item) { 
    parse_str($item,  $cookie); 
    if($cookie["PHPSESSID"])
    $cookies = array_merge($cookies,  $cookie);
}
return $cookies; 
}
function curl_sendtds($cookie,$url,$post_data,$refff){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 100,
  CURLOPT_TIMEOUT => 200,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $post_data,
  CURLOPT_HTTPHEADER => array(
    "authority: traodoisub.com",
    "pragma: no-cache",
    "cache-control: no-cache",
    "accept: */*",
    "x-requested-with: XMLHttpRequest",
    "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36 Edg/84.0.522.52",
    "content-type: application/x-www-form-urlencoded; charset=UTF-8",
    "origin: https://traodoisub.com",
    "sec-fetch-site: same-origin",
    "sec-fetch-mode: cors",
    "sec-fetch-dest: empty",
    "referer: $refff",
    "accept-language: vi,en;q=0.9",
    "cookie: $cookie"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;

}        
?>