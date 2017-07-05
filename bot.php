<?php
$strAccessToken = "9KexXFutJpVWfiA12ZrAIZunVdn6qH6Vi3mOdVYC9ojtWXSma5jbx14jv9eZebEA0cgEDbSqGYxNsb3NpKpGB+FtCVb8ketT6hmEamLvl9pIyv9UFKDQQkF5N2Zb2e/husUH9dAwX1Yrx4XRm+EuPgdB04t89/1O/w1cDnyilFU=";
 
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
 
$strUrl = "https://api.line.me/v2/bot/message/reply";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
$_msg = $arrJson['events'][0]['message']['text'];
 
 
$api_key="pTxcx5ycWTLaFNILWW59S9eMdSiDHQrz";
$url = 'https://api.mlab.com/api/1/databases/line_bot/collections/line_bot?apiKey='.$api_key.'';
$json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/line_bot?apiKey='.$api_key.'&q={"question":"'.$_msg.'"}');
$data = json_decode($json);
$isData=sizeof($data);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function node_sent($messages) {
 $api_key="pTxcx5ycWTLaFNILWW59S9eMdSiDHQrz";
 $url = 'https://api.mlab.com/api/1/databases/line_bot/collections/user?apiKey='.$api_key.'';
 $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/user?apiKey='.$api_key.'&q={"_id":"0"}');
 $data = json_decode($json);
 $isData=sizeof($data);

 $strAccessToken = "9KexXFutJpVWfiA12ZrAIZunVdn6qH6Vi3mOdVYC9ojtWXSma5jbx14jv9eZebEA0cgEDbSqGYxNsb3NpKpGB+FtCVb8ketT6hmEamLvl9pIyv9UFKDQQkF5N2Zb2e/husUH9dAwX1Yrx4XRm+EuPgdB04t89/1O/w1cDnyilFU=";

 $strUrl = "https://api.line.me/v2/bot/message/push";
 if($isData >0){
    $user;
    foreach($data as $rec){      
     $user = $rec->uid;
    } 
    $arrHeader = array();
    $arrHeader[] = "Content-Type: application/json";
    $arrHeader[] = "Authorization: Bearer {$strAccessToken}";

    $arrPostData = array();
    $arrPostData['to'] = $user;
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = (string)$messages;


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$strUrl);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close ($ch);

 }else{

 }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function sent($messages) {
 $size_msg = sizeof($messages);
 $fstrAccessToken = "9KexXFutJpVWfiA12ZrAIZunVdn6qH6Vi3mOdVYC9ojtWXSma5jbx14jv9eZebEA0cgEDbSqGYxNsb3NpKpGB+FtCVb8ketT6hmEamLvl9pIyv9UFKDQQkF5N2Zb2e/husUH9dAwX1Yrx4XRm+EuPgdB04t89/1O/w1cDnyilFU=";
 
 $fcontent = file_get_contents('php://input');
 $farrJson = json_decode($fcontent, true);
 
 $fstrUrl = "https://api.line.me/v2/bot/message/reply";
 
 $farrHeader = array();
 $farrHeader[] = "Content-Type: application/json";
 $farrHeader[] = "Authorization: Bearer {$fstrAccessToken}";
 $farrPostData = array();
 $farrPostData['replyToken'] = $farrJson['events'][0]['replyToken'];
 for ($i = 0; $i < $size_msg; $i++) {
  $farrPostData['messages'][$i]['type'] = "text";
  $farrPostData['messages'][$i]['text'] = $messages[$i];  
 }
 $channel = curl_init();
 curl_setopt($channel, CURLOPT_URL,$fstrUrl);
 curl_setopt($channel, CURLOPT_HEADER, false);
 curl_setopt($channel, CURLOPT_POST, true);
 curl_setopt($channel, CURLOPT_HTTPHEADER, $farrHeader);
 curl_setopt($channel, CURLOPT_POSTFIELDS, json_encode($farrPostData));
 curl_setopt($channel, CURLOPT_RETURNTRANSFER,true);
 curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, false);
 $result = curl_exec($channel);
 curl_close ($channel);
 
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['bot'])){
 if(isset($_GET['message'])){ 
  $messages = $_GET['message'];
  $mass = "";
  $massn = "";
  $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"temp"}');
     $data = json_decode($json);
     $isData=sizeof($data);
     if($isData>0){
      foreach($data as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       if(strpos($messages, $tid)!== false){
        $mass = $tname;
        $massn = $tid;
       }
      }
     }
  $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"lamp"}');
     $data = json_decode($json);
     $isData=sizeof($data);
     if($isData>0){
      foreach($data as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       if(strpos($messages, $tid)!== false){
        $mass = $tname;
        $massn = $tid;
       }
      }
     }
  $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"plug"}');
     $data = json_decode($json);
     $isData=sizeof($data);
     if($isData>0){
      foreach($data as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       if(strpos($messages, $tid)!== false){
        $mass = $tname;
        $massn = $tid;
       }
      }
     }
  $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"paper"}');
     $data = json_decode($json);
     $isData=sizeof($data);
     if($isData>0){
      foreach($data as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       if(strpos($messages, $tid)!== false){
        $mass = $tname;
        $massn = $tid;
       }
      }
     }

  $pieces = explode($massn, $messages);
  $messages = $pieces[0].$mass.$pieces[1];
  node_sent($messages);
  
 }
}else{
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if(strpos($_msg, 'ตรวจสอบ')!== false){
 if(strpos($_msg, 'ตรวจสอบรายชื่ออุปกรณ์')!== false||strpos($_msg, 'ตรวจสอบกระดาษ')!== false||strpos($_msg, 'ตรวจสอบอุณหภูมิ')!== false||strpos($_msg, 'ตรวจสอบทั้งหมด')!== false||strpos($_msg, 'ตรวจสอบหลอดไฟ')!== false||strpos($_msg, 'ตรวจสอบปลั๊กไฟ')!== false){
  $y=0;
  if(strpos($_msg, 'ตรวจสอบอุณหภูมิ')!== false){
     $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"temp"}');
     $data = json_decode($json);
     $isData=sizeof($data);
     $message = array();
     $y=0;
     if($isData>0){
      foreach($data as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       $tvalue1 = $rec->value1;
       $tvalue2 = $rec->value2;
       $ttime = $rec->time;
       if($tname=="-"){
        $tname = $tid;
       }
       $message[$y] = "อุณหภูมิของ ".(string)$tname." คือ ".(string)$tvalue1."C  ความชื้น ".(string)$tvalue2."% (".(string)$ttime.")";
       $y++;
      }
     }else{
      $message[0] = 'ไม่มีอุปกรณ์สำหรับตรวจสอบอุณหภูมิค่ะ';
     } 
     sent($message);    
  }
  if(strpos($_msg, 'ตรวจสอบหลอดไฟ')!== false){
     $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"lamp"}');
     $data = json_decode($json);
     $isData=sizeof($data);
     $message = array();
     $y=0;
     if($isData>0){
      foreach($data as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       $tvalue1 = $rec->value1;
       if((string)$tvalue1 == "1"){
        $tvalue1 = "เปิด";
       }else{
        $tvalue1 = "ปิด";
       }
       if($tname=="-"){
        $tname = $tid;
       }
       $ttime = $rec->time;
       $message[$y] = "หลอดไฟของ ".(string)$tname." สถานะ ".(string)$tvalue1."ค่ะ (".(string)$ttime.")";
       $y++;
      }
     }else{
      $message[0] = 'ไม่มีอุปกรณ์สำหรับตรวจสอบหลอดไฟค่ะ';
     } 
     sent($message);    
  }
  if(strpos($_msg, 'ตรวจสอบปลั๊กไฟ')!== false){
     $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"plug"}');
     $data = json_decode($json);
     $isData=sizeof($data);
     $message = array();
     $y=0;
     if($isData>0){
      foreach($data as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       $tvalue1 = $rec->value1;
       if((string)$tvalue1 == "1"){
        $tvalue1 = "เปิด";
       }else{
        $tvalue1 = "ปิด";
       }
       if($tname=="-"){
        $tname = $tid;
       }
       $ttime = $rec->time;
       $message[$y] = "ปลั๊กไฟของ ".(string)$tname." สถานะ ".(string)$tvalue1."ค่ะ (".(string)$ttime.")";
       $y++;
      }
     }else{
      $message[0] = 'ไม่มีอุปกรณ์สำหรับตรวจสอบปลั๊กไฟค่ะ';
     }
     sent($message);    
  }
    if(strpos($_msg, 'ตรวจสอบกระดาษ')!== false){
     $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"paper"}');
     $data = json_decode($json);
     $isData=sizeof($data);
     $message = array();
     $y=0;
     if($isData>0){
      foreach($data as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       $tvalue1 = $rec->value1;
       if($tname=="-"){
        $tname = $tid;
       }
       $ttime = $rec->time;
       $message[$y] = "กระดาษของ ".(string)$tname." สถานะ ".(string)$tvalue1."ค่ะ (".(string)$ttime.")";
       $y++;
      }
     }else{
      $message[0] = 'ไม่มีอุปกรณ์สำหรับตรวจสอบกระดาษค่ะ';
     }
     sent($message);    
  }
  if(strpos($_msg, 'ตรวจสอบทั้งหมด')!== false){
     
     $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"temp"}');
     $data = json_decode($json);
     $isData=sizeof($data);
     $message = array();
     $y=0;
     $message[$y] .= 'ผลการตรวจสอบทั้งหมดค่ะ
     ';
     
     if($isData>0){
      foreach($data as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       $tvalue1 = $rec->value1;
       $tvalue2 = $rec->value2;
       $ttime = $rec->time;
       if($tname=="-"){
        $tname = $tid;
       }
       $message[$y] .= 'อุณหภูมิของ '.(string)$tname.' คือ '.(string)$tvalue1.'C  ความชื้น '.(string)$tvalue2.'% ('.(string)$ttime.')
       ';
       //$y++;
      }
     }else{
      $message[$y] .= 'ไม่มีอุปกรณ์สำหรับตรวจสอบอุณหภูมิค่ะ
      ';
      //$y++;
     } 
     $json2 = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"lamp"}');
     $data2 = json_decode($json2);
     $isData=sizeof($data2);
     if($isData>0){
      foreach($data2 as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       $tvalue1 = $rec->value1;
       if((string)$tvalue1 == "1"){
        $tvalue1 = "เปิด";
       }else{
        $tvalue1 = "ปิด";
       }
       if($tname=="-"){
        $tname = $tid;
       }
       $ttime = $rec->time;
       $message[$y] .= 'หลอดไฟของ '.(string)$tname.' สถานะ '.(string)$tvalue1.'ค่ะ ('.(string)$ttime.')
       ';
       //$y++;
      }
     }else{
      $message[$y] .= 'ไม่มีอุปกรณ์สำหรับตรวจสอบหลอดไฟค่ะ
      ';
      //$y++;
     } 
     $json3 = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"plug"}');
     $data3 = json_decode($json3);
     $isData3=sizeof($data3);
     if($isData3>0){
      foreach($data3 as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       $tvalue1 = $rec->value1;
       if((string)$tvalue1 == "1"){
        $tvalue1 = "เปิด";
       }else{
        $tvalue1 = "ปิด";
       }
       if($tname=="-"){
        $tname = $tid;
       }
       $ttime = $rec->time;
       $message[$y] .= 'ปลั๊กไฟของ '.(string)$tname.' สถานะ '.(string)$tvalue1.'ค่ะ ('.(string)$ttime.')
       ';
       //$y++;
      }
     }else{
      $message[$y] .= 'ไม่มีอุปกรณ์สำหรับตรวจสอบปลั๊กไฟค่ะ
      ';
      //$y++;
     }
     $json4 = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"paper"}');
     $data4 = json_decode($json4);
     $isData4=sizeof($data4);
     $y=0;
     if($isData4>0){
      foreach($data4 as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       $tvalue1 = $rec->value1;
       $tvalue2 = $rec->value2;
       $ttime = $rec->time;
       if($tname=="-"){
        $tname = $tid;
       }
       $message[$y] .= 'สถานะของกระดาษของ '.(string)$tname.' คือ '.(string)$tvalue1.' ('.(string)$ttime.')';
       //$y++;
      }
     }else{
      $message[$y] .= 'ไม่มีอุปกรณ์สำหรับตรวจสอบกระดาษค่ะ';
      //$y++;
     } 
     sent($message);    
  }
  if(strpos($_msg, 'ตรวจสอบรายชื่ออุปกรณ์')!== false){
   
     $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"temp"}');
     $data = json_decode($json);
     $isData = sizeof($data);
     $message = array();
     $message[$y] .= "รายชื่ออุปกรณ์มีดังนี้ค่ะ
     ";
     $y=0;
     if($isData>0){
      foreach($data as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       $tvalue1 = $rec->value1;
       $tvalue2 = $rec->value2;
       $ttime = $rec->time;
       if($tname=="-"){
        $tname = $tid;
       }
       $message[$y] .= "อุปกรณ์อุณหภูมิ รหัส ".(string)$tid." ชื่อ ".(string)$tname."
       ";    
      }
      //$y++;
     }else{
      $message[$y] .= "ไม่มีอุปกรณ์สำหรับตรวจสอบอุณหภูมิค่ะ
      ";
      //$y++;
     } 
     $json2 = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"lamp"}');
     $data2 = json_decode($json2);
     $isData=sizeof($data2);
     if($isData>0){
      foreach($data2 as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       $tvalue1 = $rec->value1;
       if((string)$tvalue1 == "1"){
        $tvalue1 = "เปิด";
       }else{
        $tvalue1 = "ปิด";
       }
       if($tname=="-"){
        $tname = $tid;
       }
       $ttime = $rec->time;
       $message[$y] .= "อุปกรณ์สวิทช์หลอดไฟ รหัส ".(string)$tid." ชื่อ ".(string)$tname."
       ";       
       
      }    
      //$y++;
     }else{
      $message[$y] .= "ไม่มีอุปกรณ์สวิทช์หลอดไฟค่ะ
      ";
      //$y++;
     } 
     $json3 = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"plug"}');
     $data3 = json_decode($json3);
     $isData3=sizeof($data3);
     if($isData3>0){
      foreach($data3 as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       $tvalue1 = $rec->value1;
       if((string)$tvalue1 == "1"){
        $tvalue1 = "เปิด";
       }else{
        $tvalue1 = "ปิด";
       }
       if($tname=="-"){
        $tname = $tid;
       }
       $ttime = $rec->time;
       $message[$y] .= "อุปกรณ์สวิทช์ปลั๊กไฟ รหัส ".(string)$tid." ชื่อ ".(string)$tname."
       ";    
       
      }
     // $y++;
     }else{
      $message[$y] .= "ไม่มีอุปกรณ์สวิทช์ปลั๊กไฟค่ะ
      ";
      //$y++;
     }
     $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"type":"paper"}');
     $data = json_decode($json);
     $isData=sizeof($data);
     $y=0;
     if($isData>0){
      foreach($data as $rec){      
       $tid = $rec->id;
       $tname = $rec->name;
       $tvalue1 = $rec->value1;
       $tvalue2 = $rec->value2;
       $ttime = $rec->time;
       if($tname=="-"){
        $tname = $tid;
       }
       $message[$y] .= "อุปกรณ์ตรวจกระดาษ รหัส ".(string)$tid." ชื่อ ".(string)$tname
        ;       
       
      }
      //$y++;
     }else{
      $message[$y] .= "ไม่มีอุปกรณ์สำหรับตรวจสอบกระดาษค่ะ
      ";
      //$y++;
     } 
     sent($message);    
  }
  
 }else{
  $message = array();
    
      $message[0] = 'จะตรวจสอบอะไรหรอค่ะ??
      ตรวจสอบอุณหภูมิ
      ตรวจสอบหลอดไฟ
      ตรวจสอบแอร์
      ตรวจสอบกระดาษ
      ตรวจสอบทั้งหมด
      ตรวจสอบรายชื่ออุปกรณ์';
      //$message[2] = $arrJson['events'][0]['source']['userId'];
      sent($message);
  
 }
 }else{
  if(strpos($_msg, 'บันทึกผู้ใช้งานใหม่') !== false){
     $api_key="pTxcx5ycWTLaFNILWW59S9eMdSiDHQrz";
     $url = 'https://api.mlab.com/api/1/databases/line_bot/collections/user?apiKey='.$api_key.'';
     $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/user?apiKey='.$api_key.'&q={"id":"0"}');
     $data = json_decode($json);
     $isData=sizeof($data);
      //Post New Data
      $newData = json_encode(
        array(
          '_id' => "0",
          'id' => "0",
          'uid' => $arrJson['events'][0]['source']['userId'],
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
      $message = array();
      $message[0] = 'ทำการบันทึกเรียบร้อยค่ะ';      
      sent($message);
   
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
  }else{
   if (strpos($_msg, 'หลอดไฟ[') !== false||strpos($_msg, 'ปลั๊กไฟ[') !== false){
    if(strpos($_msg, 'หลอดไฟ[') !== false){
     $x_tra = str_replace("หลอดไฟ","", $_msg);
     $pieces = explode("|", $x_tra);
     $_id=str_replace("[","",$pieces[0]);
     $_value=str_replace("]","",$pieces[1]);    

     if($_value == 'ปิด' || $_value == 'เปิด'){

      $mode = 0;
      if($_value == 'เปิด'){
       $mode = 1;       
      }else{
       $mode = 0;       
      }

      $api_key="pTxcx5ycWTLaFNILWW59S9eMdSiDHQrz";
      $url = 'https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'';
      $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"name":"'.$_id.'"}');
      $data = json_decode($json);
      $isData=sizeof($data);
      $working = "0";
      if($isData >0){
       $uid;

       $array_ = json_decode(json_encode($data[0]),true);
       $array__ = (string)$array_['_id']['$oid'];

       $working = (string)$array_['work'];
       $id = (string)$array_['id'];
       $name = (string)$array_['name'];
       $value1 = (string)$array_['value1'];
       $value2 = (string)$array_['value2'];
       $time = (string)$array_['time'];
       $type = (string)$array_['type'];
       $message = array();
       if((int)$mode == (int)$value1){
        $working = 0;
        if((int)$mode == 1){        
         $message[0] = 'หลอดไฟเปิดอยู่แล้วค่ะ';
        }else{
         $message[0] = 'หลอดไฟปิดอยู่แล้วค่ะ';
        }
       }else{
        $working = 1;
        if((int)$mode == 1){        
         $message[0] = 'รอแปบนึงนะค่ะ';
         $message[1] = 'กำลังดำเนินการเปิดหลอดไฟอยู่ค่ะ';
        }else{
         $message[0] = 'รอแปบนึงนะค่ะ';
         $message[1] = 'กำลังดำเนินการปิดหลอดไฟอยู่ค่ะ';
        }
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
        'work' => $working
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
       sent($message);
      }else{
       $message = array();
       $message[0] = $_id.' ไม่มีอยู่ในรายชื่ออุปกรณ์ค่ะ';
       sent($message);			
      }
     }else{
      $message = array();
      $message[0] = 'กรุณาใส่ข้อมูลให้ถูกต้องค่ะ';
      $message[1] = 'หลอดไฟ[ชื่อ|เปิด/ปิด]';
      sent($message);
     }
    }
    if(strpos($_msg, 'ปลั๊กไฟ[') !== false){
     $x_tra = str_replace("ปลั๊กไฟ","", $_msg);
     $pieces = explode("|", $x_tra);
     $_id=str_replace("[","",$pieces[0]);
     $_value=str_replace("]","",$pieces[1]);    

     if($_value == 'ปิด' || $_value == 'เปิด'){

      $mode = 0;
      if($_value == 'เปิด'){
       $mode = 1;       
      }else{
       $mode = 0;       
      }

      $api_key="pTxcx5ycWTLaFNILWW59S9eMdSiDHQrz";
      $url = 'https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'';
      $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"name":"'.$_id.'"}');
      $data = json_decode($json);
      $isData=sizeof($data);
      $working = "0";
      if($isData >0){
       $uid;

       $array_ = json_decode(json_encode($data[0]),true);
       $array__ = (string)$array_['_id']['$oid'];

       $working = (string)$array_['work'];
       $id = (string)$array_['id'];
       $name = (string)$array_['name'];
       $value1 = (string)$array_['value1'];
       $value2 = (string)$array_['value2'];
       $time = (string)$array_['time'];
       $type = (string)$array_['type'];
       $message = array();
       if((int)$mode == (int)$value1){
        $working = 0;
        if((int)$mode == 1){        
         $message[0] = 'ปลั๊กไฟเปิดอยู่แล้วค่ะ';
        }else{
         $message[0] = 'ปลั๊กไฟปิดอยู่แล้วค่ะ';
        }
       }else{
        $working = 1;
        if((int)$mode == 1){        
         $message[0] = 'รอแปบนึงนะค่ะ';
         $message[1] = 'กำลังดำเนินการเปิดปลั๊กไฟอยู่ค่ะ';
        }else{
         $message[0] = 'รอแปบนึงนะค่ะ';
         $message[1] = 'กำลังดำเนินการปิดปลั๊กไฟอยู่ค่ะ';
        }
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
        'work' => $working
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
       sent($message);
      }else{
       $message = array();
       $message[0] = $_id.' ไม่มีอยู่ในรายชื่ออุปกรณ์ค่ะ';
       sent($message);			
      }
     }else{
      $message = array();
      $message[0] = 'กรุณาใส่ข้อมูลให้ถูกต้องค่ะ';
      $message[1] = 'ปลั๊กไฟ[ชื่อ|เปิด/ปิด]';
      sent($message);
     }
    }

   }else{
   if (strpos($_msg, 'สอน[') !== false||strpos($_msg, 'เปลี่ยนชื่ออุปกรณ์[') !== false && $f == 0) {
    if (strpos($_msg, 'สอน[') !== false && strpos($_msg, 'เปลี่ยนชื่ออุปกรณ์[') == false) {
      $x_tra = str_replace("สอน","", $_msg);
      $pieces = explode("|", $x_tra);
      $_question=str_replace("[","",$pieces[0]);
      $_answer=str_replace("]","",$pieces[1]);
      //Post New Data
      $newData = json_encode(
        array(
          'question' => $_question,
          'answer'=> $_answer
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
      $message = array();
      $message[0] = 'ขอบคุณที่สอนนะคะ';
      
      sent($message);
    }else{
      $x_tra = str_replace("เปลี่ยนชื่ออุปกรณ์","", $_msg);
      $pieces = explode("|", $x_tra);
      $_id=str_replace("[","",$pieces[0]);
      $_name=str_replace("]","",$pieces[1]);
      //Post New Data
      $api_key="pTxcx5ycWTLaFNILWW59S9eMdSiDHQrz";
      $url = 'https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'';
      $json = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"id":"'.$_id.'"}');
      $data = json_decode($json);
      $isData=sizeof($data);
      if($isData >0){
       $uid;
       $array_ = json_decode(json_encode($data[0]),true);
       $array__ = (string)$array_['_id']['$oid'];
       $name = $_name;
       $id = (string)$array_['id'];
       $type = (string)$array_['type'];
       $time = (string)$array_['time'];
       $value1 = (string)$array_['value1'];
       $value2 = (string)$array_['value2'];
       $work = (string)$array_['work'];
        $newData = json_encode(
          array(
            '_id' => array('$oid' => $array__),
            'id' => $id,
            'name' => $name,
            'type'=> $type,
            'time' => $time,
            'value1' => $value1,
            'value2' => $value2,
            'work' => $work
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
        $message = array();
        $message[0] = 'ทำการเปลี่ยนชื่ออุปกรณ์ให้แล้วนะคะ'; 
        sent($message);
      }else{
       $message = array();
       $message[0] = 'ไม่สามารถเปลี่ยนชื่ออุปกรณ์ได้ค่ะ';  
       $message[1] = 'เพราะไม่พบอุปกรณ์ของ '._id.' ค่ะ';  
       sent($message);
      }
    }
   
  }else{
   if(strpos($_msg, 'คำสั่งทั้งหมด') !== false){
       $messagess = array();
       $messagess[0] = 'คำสั่งที่สามารถใช้ได้ค่ะ
       สอน[คำถาม|คำตอบ] 
       เปลี่ยนชื่ออุปกรณ์[รหัส|ชื่อใหม่]
       หลอดไฟ[ชื่ออุปกรณ์|เปิด/ปิด]
       ปลั๊กไฟ[ชื่ออุปกรณ์|เปิด/ปิด]
       ตรวจสอบอุณหภูมิ
       ตรวจสอบหลอดไฟ
       ตรวจสอบปลั๊กไฟ
       ตรวจสอบกระดาษ
       ตรวจสอบรายชื่ออุปกรณ์
       ตรวจสอบทั้งหมด';  
 
       sent($messagess);
   }else{
    if($isData >0){
      $message = array();
      foreach($data as $rec){      
       $message[0] = $rec->answer;
      }
      sent($message);
    }else{
       $message = array();

       $message[0] = 'ฉันไม่รู้จักคำนี้ค่ะ!!';
       $message[1] = 'คุณสามารถสอนได้เพียงพิมพ์: สอน[คำถาม|คำตอบ]';
       //$message[2] = $arrJson['events'][0]['source']['userId'];
       sent($message);
    }
   }
   }
    
   }
  }
 } 
} 





?>
