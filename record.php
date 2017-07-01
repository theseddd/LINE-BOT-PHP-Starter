<?php
DateTime implements DateTimeInterface {
  /* Constants */
  const string ATOM = "Y-m-d\TH:i:sP" ;
  const string COOKIE = "l, d-M-Y H:i:s T" ;
  const string ISO8601 = "Y-m-d\TH:i:sO" ;
  const string RFC822 = "D, d M y H:i:s O" ;
  const string RFC850 = "l, d-M-y H:i:s T" ;
  const string RFC1036 = "D, d M y H:i:s O" ;
  const string RFC1123 = "D, d M Y H:i:s O" ;
  const string RFC2822 = "D, d M Y H:i:s O" ;
  const string RFC3339 = "Y-m-d\TH:i:sP" ;
  const string RSS = "D, d M Y H:i:s O" ;
  const string W3C = "Y-m-d\TH:i:sP" ;
  /* Methods */
  public __construct ([ string $time = "now" [, DateTimeZone $timezone = NULL ]] )
  public DateTime add ( DateInterval $interval )
  public static DateTime createFromFormat ( string $format , string $time [, DateTimeZone $timezone ] )
  public static array getLastErrors ( void )
  public DateTime modify ( string $modify )
  public static DateTime __set_state ( array $array )
  public DateTime setDate ( int $year , int $month , int $day )
  public DateTime setISODate ( int $year , int $week [, int $day = 1 ] )
  public DateTime setTime ( int $hour , int $minute [, int $second = 0 ] )
  public DateTime setTimestamp ( int $unixtimestamp )
  public DateTime setTimezone ( DateTimeZone $timezone )
  public DateTime sub ( DateInterval $interval )
  public DateInterval diff ( DateTimeInterface $datetime2 [, bool $absolute = false ] )
  public string format ( string $format )
  public int getOffset ( void )
  public int getTimestamp ( void )
  public DateTimeZone getTimezone ( void )
  public __wakeup ( void )
}



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
    echo "1.1";
   print_r ($data); 
    echo "1.2";
   $array_ = json_decode(json_encode($data[0]),true);
   print_r ($array_);
    echo "1.3";
   $array__ = (string)$array_['_id']['$oid'];
   print_r ($array__);
    echo "1.4";
    //Post New Data
    $newData = json_encode(
      array(
        '_id' => new MongoId($array__),
        'id' => $id,
        'type'=> $type,
        'value' => $value
      )
    );
    echo "1.5";
    $opts = array(
      'http' => array(
          'method' => "POST",
          'header' => "Content-type: application/json",
          'content' => $newData
       )
    );
    echo "1.6";
    $context = stream_context_create($opts);
    $returnValue = file_get_contents($url,false,$context);  
  }else{
    echo "2.1";
    //Post New Data
    $newData = json_encode(
      array(
        'id' => $id,
        'type'=> $type
        'value' => $value
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
