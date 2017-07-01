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

function sent($messages) {
 $fstrAccessToken = "9KexXFutJpVWfiA12ZrAIZunVdn6qH6Vi3mOdVYC9ojtWXSma5jbx14jv9eZebEA0cgEDbSqGYxNsb3NpKpGB+FtCVb8ketT6hmEamLvl9pIyv9UFKDQQkF5N2Zb2e/husUH9dAwX1Yrx4XRm+EuPgdB04t89/1O/w1cDnyilFU=";
 
 $fcontent = file_get_contents('php://input');
 $farrJson = json_decode($fcontent, true);
 
 $fstrUrl = "https://api.line.me/v2/bot/message/reply";
 
 $farrHeader = array();
 $farrHeader[] = "Content-Type: application/json";
 $farrHeader[] = "Authorization: Bearer {$fstrAccessToken}";
 $farrPostData = array();
 $farrPostData['replyToken'] = $farrJson['events'][0]['replyToken'];
 $farrPostData['messages'][0]['type'] = "text";
 $farrPostData['messages'][0]['text'] = $messages;  
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
  $message = $_GET['message'];
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = $message;
 }else{


 }
}else{
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if($_msg == 'อุณหภูมิ'||$_msg == 'อุณหภูมิเท่าไหร'||strpos($_msg, 'ตรวจสอบ')!== false||strpos($_msg, 'หลอดไฟ')!== false||strpos($_msg, 'แอร์')!== false){
  if (strpos($_msg, 'ตรวจสอบ') !== false) {
   if(strpos($_msg, 'ทั้งหมด') !== false) {
     $nurl = 'https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'';
     $njson = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"id":"'.$id.'"}');
     $ndata = json_decode($njson);
     $nisData=sizeof($ndata);
   }else{
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
      sent('ขอบคุณที่สอนนะคะ');
      /*$arrPostData = array();
      $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
      $arrPostData['messages'][0]['type'] = "text";
      $arrPostData['messages'][0]['text'] = 'ขอบคุณที่สอนนะคะ';*/
      
    }
  }
 
 
 
 }else{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
  if (strpos($_msg, 'สอน') !== false) {
    if (strpos($_msg, 'สอน') !== false) {
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
      sent('ขอบคุณที่สอนนะคะ');
      /*$arrPostData = array();
      $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
      $arrPostData['messages'][0]['type'] = "text";
      $arrPostData['messages'][0]['text'] = 'ขอบคุณที่สอนนะคะ';*/
    }
  }else{
   
   if($isData >0){
     foreach($data as $rec){
      sent($rec->answer);
      /*$arrPostData = array();
      $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
      $arrPostData['messages'][0]['type'] = "text";
      $arrPostData['messages'][0]['text'] = $rec->answer;*/
     }
    }else{
      sent('ฉันไม่รู้จักคำนี้ค่ะ!!! คุณสามารถสอนได้เพียงพิมพ์: สอน[คำถาม|คำตอบ]');
      /*$arrPostData = array();
      $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
      $arrPostData['messages'][0]['type'] = "text";
      $arrPostData['messages'][0]['text'] = 'ฉันไม่รู้จักคำนี้ค่ะ!!! คุณสามารถสอนได้เพียงพิมพ์: สอน[คำถาม|คำตอบ]';*/
     
    }
  }
 }
 
} 

/*$channel = curl_init();
curl_setopt($channel, CURLOPT_URL,$strUrl);
curl_setopt($channel, CURLOPT_HEADER, false);
curl_setopt($channel, CURLOPT_POST, true);
curl_setopt($channel, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($channel, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($channel, CURLOPT_RETURNTRANSFER,true);
curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($channel);
curl_close ($channel);*/




?>
