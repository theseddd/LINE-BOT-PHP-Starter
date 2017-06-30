<?php

if(isset($_GET['id'])&&isset($_GET['type'])){
  $id = (string)$_GET['id'];
  $type = (string)$_GET['type'];
  
  $api_key="pTxcx5ycWTLaFNILWW59S9eMdSiDHQrz";
  $url = 'https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'';
  $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"question":"'.$_msg.'"}');
  $data = json_decode($json);
  $isData=sizeof($data);

  //Post New Data
  $newData = json_encode(
    array(
      'question' => $id,
      'answer'=> $type
    )
  );
  $opts = array(
    'http' => array(
        'method' => "POST",
        'header' => "Content-type: application/json",
        'content' => $newData
     )
  );
  $context = stream_context_create($opts);
  $returnValue = file_get_contents($url,false,$context);
  echo "OK";
}else{
  echo "No data";
}




?>
