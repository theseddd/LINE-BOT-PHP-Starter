<?php

if(isset($_GET['id'])&&isset($_GET['type'])&&isset($_GET['value'])){
  $id = (string)$_GET['id'];
  $type = (string)$_GET['type'];
  $value = (string)$_GET['value'];
  $api_key="pTxcx5ycWTLaFNILWW59S9eMdSiDHQrz";
  $url = 'https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'';
  $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"id":"'.$id.'"}');
  $data = json_decode($json);
  $isData=sizeof($data);
  if($isData >0){
   $uid;
    echo "1";
   
   print_r ($data);
  }else{
    echo "2.1";
    //Post New Data
    $newData = json_encode(
      array(
        'id' => $id,
        'type'=> $type
      )
    );
    echo "2.2";
    $opts = array(
      'http' => array(
          'method' => "POST",
          'header' => "Content-type: application/json",
          'content' => $newData
       )
    );
    echo "2.3";
    $context = stream_context_create($opts);
    $returnValue = file_get_contents($url,false,$context);  
  }
  echo "OK";
}else{
  echo "No data";
}




?>
