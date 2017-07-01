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

 $nurl = 'https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'';
 $njson = file_get_contents('https://api.mlab.com/api/1/databases/line_bot/collections/node?apiKey='.$api_key.'&q={"id":"'.$id.'"}');
 $ndata = json_decode($njson);
 $nisData=sizeof($ndata);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['bot'])){
 if(isset($_GET['message'])){
  $message = $_GET['message'];
  $chOne = curl_init();
  curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
  // SSL USE
  curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
  //POST
  curl_setopt( $chOne, CURLOPT_POST, 1);
  // Message
  curl_setopt( $chOne, CURLOPT_POSTFIELDS, $message);
  //ถ้าต้องการใส่รุป ให้ใส่ 2 parameter imageThumbnail และimageFullsize
  //curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$message&imageThumbnail=http://10.10.10.10/small.jpg&imageFullsize=http://10.10.10.10/large.jpg");
  // follow redirects
  curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
  //ADD header array
  $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$strAccessToken, );  // หลังคำว่า Bearer ใส่ line authen code ไป
  curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
  //RETURN
  curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec( $chOne );
  //Check error
  if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); }
  else { $result_ = json_decode($result, true);
  echo "status : ".$result_['status']; echo "message : ". $result_['message']; }
  //Close connect
  curl_close( $chOne );







 }else{







 }
}else{
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
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
     $arrPostData = array();
     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
     $arrPostData['messages'][0]['type'] = "text";
     $arrPostData['messages'][0]['text'] = 'ขอบคุณที่สอนนะคะ';
   }
 }else{
   
   if($isData >0){
    foreach($data as $rec){
     $arrPostData = array();
     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
     $arrPostData['messages'][0]['type'] = "text";
     $arrPostData['messages'][0]['text'] = $rec->answer;
    }
   }else{
     $arrPostData = array();
     $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
     $arrPostData['messages'][0]['type'] = "text";
     $arrPostData['messages'][0]['text'] = 'ฉันไม่รู้จักคำนี้ค่ะ!!! คุณสามารถสอนได้เพียงพิมพ์: สอน[คำถาม|คำตอบ]';
   }
 }

} 
$channel = curl_init();
curl_setopt($channel, CURLOPT_URL,$strUrl);
curl_setopt($channel, CURLOPT_HEADER, false);
curl_setopt($channel, CURLOPT_POST, true);
curl_setopt($channel, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($channel, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($channel, CURLOPT_RETURNTRANSFER,true);
curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($channel);
curl_close ($channel);
?>
