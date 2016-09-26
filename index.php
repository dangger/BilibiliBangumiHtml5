<?php
error_reporting(0);
//获取前台传过来的bangumi url
$_POST["input_url"];

//截取bangumi ID
$episode_id=substr($_POST["input_url"],36);

//请求API拿到aid&cid
function request_by_curl($remote_server) {  
  $ch = curl_init();  
  curl_setopt($ch, CURLOPT_URL, $remote_server);  
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'mypost=' . $post_string);  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36 TheWorld 7");  
  $data = curl_exec($ch);
$result = json_decode($data,true);
//echo $result['result']['cid'];
return $result;
  curl_close($ch);
}  
$result=request_by_curl("http://bangumi.bilibili.com/web_api/get_source?episode_id={$episode_id}");
//拼接需要跳转的页面,然后走你
header("Location: http://www.bilibili.com/html/html5player.html?aid={$result['result']['aid']}&cid={$result['result']['cid']}");

?>