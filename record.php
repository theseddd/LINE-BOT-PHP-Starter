<?php
date_default_timezone_set("Asia/Bangkok");



if(isset($_GET['id'])&&isset($_GET['type'])&&isset($_GET['value1'])){
  $time = date("d-m-Y H:i");
  $id = (string)$_GET['id'];
  $type = (string)$_GET['type'];
  $value1 = (string)$_GET['value1'];
  $value2= "";
  if(isset($_GET['value2'])){
    $value2= $_GET['value2'];
  }
  if(isset($_GET['mode'])){
    
  }
  $api_key="pTxcx5ycWTLaFNILWW59S9eMdSiDHQrz";
  $url = 'https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'';
  $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"id":"'.$id.'"}');
  $data = json_decode($json);
  $isData=sizeof($data);
  $working = "0";
  if($isData >0){
   $uid;
   $array_ = json_decode(json_encode($data[0]),true);
   $array__ = (string)$array_['_id']['$oid'];
   $check = (string)$array_['work'];
   $name = (string)$array_['name'];
    if($check == "1"){
      $working = "1";
    }

    $newData = json_encode(
      array(
        '_id' => array('$oid' => $array__),
        'id' => $id,
        'name' => $name,
        'type'=> $type,
        'time' => $time,
        'value1' => $value1,
        'value2' => $value2,
        'work' => "0"
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
  }else{
    $newData = json_encode(
      array(
        'id' => $id,
        'name' => $id,
        'type'=> $type,
        'time' => $time,
        'value1' => $value1,
        'value2' => $value2,
        'work' => "0"
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
  }
  if($working == "1"){
    echo "Have_work";
  }else{
    echo "OK";
  }
}else{
  echo "No data";
}




?>
<server_main working="<?=$working?>"/>
