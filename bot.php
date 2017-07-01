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
function node_sent($messages,$user) {
$strAccessToken = "9KexXFutJpVWfiA12ZrAIZunVdn6qH6Vi3mOdVYC9ojtWXSma5jbx14jv9eZebEA0cgEDbSqGYxNsb3NpKpGB+FtCVb8ketT6hmEamLvl9pIyv9UFKDQQkF5N2Zb2e/husUH9dAwX1Yrx4XRm+EuPgdB04t89/1O/w1cDnyilFU=";
 
$strUrl = "https://api.line.me/v2/bot/message/push";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
 
$arrPostData = array();
$arrPostData['to'] = $user;
$arrPostData['messages'][0]['type'] = "text";
$arrPostData['messages'][0]['text'] = "นี้คือการทดสอบ Push Message";
 
 
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
  $message = $_GET['message'];
  node_sent($messages,"Ue5cca733dd1b12980bc07e47ba4c503c");
  
 }else{


 }
}else{
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 if(strpos($_msg, 'อุณหภูมิ')!== false||strpos($_msg, 'ตรวจสอบ')!== false||strpos($_msg, 'หลอดไฟ')!== false||strpos($_msg, 'แอร์')!== false){
  
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
      $message = array();
      $message[0] = 'ขอบคุณที่สอนนะคะ';
      
      sent($message);
    }
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
      $message[2] = $arrJson['events'][0]['source']['userId'];
      sent($message);
    }
  }
 } 
} 





?>
