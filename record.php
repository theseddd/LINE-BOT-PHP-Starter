<?php
date_default_timezone_set("Asia/Bangkok");



if(isset($_GET['id'])&&isset($_GET['type'])&&isset($_GET['value'])){
  $time = date("d-m-Y H:i");
  $id = (string)$_GET['id'];
  $type = (string)$_GET['type'];
  $value = (string)$_GET['value'];
  if(isset($_GET['mode'])){
    
  }
  $api_key="pTxcx5ycWTLaFNILWW59S9eMdSiDHQrz";
  $url = 'https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'';
  $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"id":"'.$id.'"}');
  $data = json_decode($json);
  $isData=sizeof($data);
  if($isData >0){
   $uid;
   // echo "1.1";
   print_r ($data); 
    //echo "1.2";
   $array_ = json_decode(json_encode($data[0]),true);
   print_r ($array_);
   // echo "1.3";
   $array__ = (string)$array_['_id']['$oid'];
   print_r ($array__);
    //echo "1.4";
    //Post New Data
    $newData = json_encode(
      array(
        '_id' => array('$oid' => $array__),
        'id' => $id,
        'type'=> $type,
        'time' => $time,
        'value' => $value        
      )
    );
    //echo "1.5";
    $opts = array(
      'http' => array(
          'method' => "POST",
          'header' => "Content-type: application/json",
          'content' => $newData
       )
    );
    //echo "1.6";
    $context = stream_context_create($opts);
    $returnValue = file_get_contents($url,false,$context);  
  }else{
    //echo "2.1";
    //Post New Data
    $newData = json_encode(
      array(
        'id' => $id,
        'type'=> $type,
        'time' => $time,
        'value' => $value,
        'work' => "0"
      )
    );
    //echo "2.2";
    $opts = array(
      'http' => array(
          'method' => "POST",
          'header' => "Content-type: application/json",
          'content' => $newData
       )
    );
    //echo "2.3";
    $context = stream_context_create($opts);
    $returnValue = file_get_contents($url,false,$context);  
  }
  echo "OK";
}else{
  echo "No data";
}




?>
