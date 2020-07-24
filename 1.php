<?php
function request($url, $token = null, $data = null, $pin = null, $otpsetpin = null, $uuid = null){
$header[] = "Host: api.gojekapi.com";
$header[] = "User-Agent: okhttp/3.10.0";
$header[] = "Accept: application/json";
$header[] = "Accept-Language: id-ID";
$header[] = "Content-Type: application/json; charset=UTF-8";
$header[] = "X-AppVersion: 3.46.1";
$header[] = "X-UniqueId: ".time()."57".mt_rand(1000,9999);
$header[] = "Connection: keep-alive";
$header[] = "X-User-Locale: id_ID";
$header[] = "X-Location: -0.92".mt_rand(00000000,99999999).",100.38".mt_rand(00000000,99999999);
if ($pin):
$header[] = "pin: $pin";
    endif;
if ($token):
$header[] = "Authorization: Bearer $token";
endif;
if ($otpsetpin):
$header[] = "otp: $otpsetpin";
endif;
if ($uuid):
$header[] = "User-uuid: $uuid";
endif;
$c = curl_init("https://api.gojekapi.com".$url);
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    if ($data):
    curl_setopt($c, CURLOPT_POSTFIELDS, $data);
    curl_setopt($c, CURLOPT_POST, true);
    endif;
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_HEADER, true);
    curl_setopt($c, CURLOPT_HTTPHEADER, $header);
    $response = curl_exec($c);
    $httpcode = curl_getinfo($c);
    if (!$httpcode)
        return false;
    else {
        $header = substr($response, 0, curl_getinfo($c, CURLINFO_HEADER_SIZE));
        $body   = substr($response, curl_getinfo($c, CURLINFO_HEADER_SIZE));
    }
    $json = json_decode($body, true);
    return $body;
}
function save($filename, $content)
{
    $save = fopen($filename, "a");
    fputs($save, "$content\r\n");
    fclose($save);
}
function nama()
    {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $ex = curl_exec($ch);
    // $rand = json_decode($rnd_get, true);
    preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
    return $name[2][mt_rand(0, 14) ];
    }
function getStr($a,$b,$c){
	$a = @explode($a,$c)[1];
	return @explode($b,$a)[0];
}
function getStr1($a,$b,$c,$d){
        $a = @explode($a,$c)[$d];
        return @explode($b,$a)[0];
}
function color($color = "default" , $text)
    {
        $arrayColor = array(
            'grey'      => '1;30',
            'red'       => '1;31',
            'green'     => '1;32',
            'yellow'    => '1;33',
            'blue'      => '1;34',
            'purple'    => '1;35',
            'nevy'      => '1;36',
            'white'     => '1;0',
        );  
        return "\033[".$arrayColor[$color]."m".$text."\033[0m";
    }
function fetch_value($str,$find_start,$find_end) {
	$start = @strpos($str,$find_start);
	if ($start === false) {
		return "";
	}
	$length = strlen($find_start);
	$end    = strpos(substr($str,$start +$length),$find_end);
	return trim(substr($str,$start +$length,$end));
}
?>
<?php
date_default_timezone_set('Asia/Jakarta');
echo"\n";
echo color("red","[×]──────────────────────────────────────────[×]\n");
echo color("yellow","[×]                PERAK LOSS                [×]\n");
echo color("green","[×]    Tanggal : ".date('[d-m-Y] [H:i:s]')."     [×]\n");
echo color("red","[×]──────────────────────────────────────────[×]\n");
function change(){
        $nama = nama();
        $email = str_replace(" ", "", $nama) . mt_rand(00000000, 99999999);
        ulang:
        echo color("green","[×]        Kode Nomor 628XXXXXXXXXXX         [×]\n");
        echo color("blue","[•] Nomor : ");
        $no = trim(fgets(STDIN));
        echo color("red","[×]──────────────────────────────────────────[×]\n");
        $data = '{"email":"'.$email.'@gmail.com","name":"'.$nama.'","phone":"+'.$no.'","signed_up_country":"ID"}';
        $register = request("/v5/customers", null, $data);
        if(strpos($register, '"otp_token"')){
        $otptoken = getStr('"otp_token":"','"',$register);
        echo color("green","[✓] Kode verifikasi sudah di kirim")."\n";
        otp:
        echo color("blue","[?] Otp: ");
        $otp = trim(fgets(STDIN));
        $data1 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $otptoken . '"},"client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e"}';
        $verif = request("/v5/customers/phone/verify", null, $data1);
        if(strpos($verif, '"access_token"')){
        echo color("green","[+] Berhasil mendaftar");
        echo"\n";
        echo color("red","[×]──────────────────────────────────────────[×]\n");
        echo color("red","[×]──────────────────────────────────────────[×]\n");
        $token = getStr('"access_token":"','"',$verif);
        $uuid = getStr('"resource_owner_id":',',',$verif);
        echo "\n".color("green","[+] Token: ".$token."\n\n");
        save("token.txt",$token);
         echo "\n".color("blue","[?] Mau set pin?: y/n ");
         $pilih1 = trim(fgets(STDIN));
         if($pilih1 == "y" || $pilih1 == ""){
         //if($pilih1 == "y" && strpos($no, "628")){
         echo color("green","[✓] PIN ANDA = 225588 ")."\n";
         $data2 = '{"pin":"225588"}';
         $getotpsetpin = request("/wallet/pin", $token, $data2, null, null, $uuid);
         echo "\n".color("red","[?] Otp Set Pin : ");
         $otpsetpin = trim(fgets(STDIN));
         $verifotpsetpin = request("/wallet/pin", $token, $data2, null, $otpsetpin, $uuid);
         echo $verifotpsetpin;
         }else if($pilih1 == "n" || $pilih1 == "N"){
         goto bb;
         die();
         }
         bb:
        echo "\n".color("blue","[?] Klaim Voucher 20 V1 ? : y/n ");
        $pilih1 = trim(fgets(STDIN));
        if($pilih1 == "y" || $pilih1 == ""){
        echo color("red","[+] Token: ");
        $token = trim(fgets(STDIN));
        echo "\n".color("yellow","[!] Please wait");
        for($a=1;$a<=3;$a++){
        echo color("yellow",".");
        sleep(20);
        }
        $code1 = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"COBAGOFOOD0607"}');
        $message = fetch_value($code1,'"message":"','"');
        if(strpos($code1, 'Promo kamu sudah bisa dipakai')){
        echo "\n".color("green","[+] Message: ".$message);
        goto gocad;
        }else{
        echo "\n".color("red","[-] Message: ".$message);
        gocad:
        }
        goto ceek;
        }else if($pilih1 == "n" || $pilih1 == "N"){
        ceek:
        ?>
	<?php
function request2($url, $token = null, $data = null, $pin = null, $otpsetpin = null, $uuid = null){
$header[] = "Host: api.gojekapi.com";
$header[] = "User-Agent: okhttp/3.10.0";
$header[] = "Accept: application/json";
$header[] = "Accept-Language: id-ID";
$header[] = "Content-Type: application/json; charset=UTF-8";
$header[] = "X-AppVersion: 3.46.1";
$header[] = "X-UniqueId: ".time()."57".mt_rand(1000,9999);
$header[] = "Connection: keep-alive";
$header[] = "X-User-Locale: id_ID";
$header[] = "X-Location: -6.59".mt_rand(00000000,99999999).",106.80".mt_rand(00000000,99999999);
if ($pin):
$header[] = "pin: $pin";
    endif;
if ($token):
$header[] = "Authorization: Bearer $token";
endif;
if ($otpsetpin):
$header[] = "otp: $otpsetpin";
endif;
if ($uuid):
$header[] = "User-uuid: $uuid";
endif;
$c = curl_init("https://api.gojekapi.com".$url);
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    if ($data):
    curl_setopt($c, CURLOPT_POSTFIELDS, $data);
    curl_setopt($c, CURLOPT_POST, true);
    endif;
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_HEADER, true);
    curl_setopt($c, CURLOPT_HTTPHEADER, $header);
    $response = curl_exec($c);
    $httpcode = curl_getinfo($c);
    if (!$httpcode)
        return false;
    else {
        $header = substr($response, 0, curl_getinfo($c, CURLINFO_HEADER_SIZE));
        $body   = substr($response, curl_getinfo($c, CURLINFO_HEADER_SIZE));
    }
    $json = json_decode($body, true);
    return $body;
}
function save2($filename, $content)
{
    $save = fopen($filename, "a");
    fputs($save, "$content\r\n");
    fclose($save);
}
function nama2()
    {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $ex = curl_exec($ch);
    // $rand = json_decode($rnd_get, true);
    preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
    return $name[2][mt_rand(0, 14) ];
    }
function getStr2($a,$b,$c){
	$a = @explode($a,$c)[1];
	return @explode($b,$a)[0];
}
function getStr3($a,$b,$c,$d){
        $a = @explode($a,$c)[$d];
        return @explode($b,$a)[0];
}
function color2($color = "default" , $text)
    {
        $arrayColor = array(
            'grey'      => '1;30',
            'red'       => '1;31',
            'green'     => '1;32',
            'yellow'    => '1;33',
            'blue'      => '1;34',
            'purple'    => '1;35',
            'nevy'      => '1;36',
            'white'     => '1;0',
        );  
        return "\033[".$arrayColor[$color]."m".$text."\033[0m";
    }
function fetch_value2($str,$find_start,$find_end) {
	$start = @strpos($str,$find_start);
	if ($start === false) {
		return "";
	}
	$length = strlen($find_start);
	$end    = strpos(substr($str,$start +$length),$find_end);
	return trim(substr($str,$start +$length,$end));
}
?>
<?php
date_default_timezone_set('Asia/Jakarta');
        echo "\n".color("blue","[?] Klaim Voucher 15 V1 ? : y/n ");
        $pilih1 = trim(fgets(STDIN));
        if($pilih1 == "y" || $pilih1 == ""){
        echo color("red","[+] Token: ");
        $token = trim(fgets(STDIN));
        echo "\n".color("yellow","[!] Please wait");
        for($a=1;$a<=3;$a++){
        echo color("yellow",".");
        sleep(20);
        }
        $code1 = request2('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"PESANGOFOOD0607"}');
        $message = fetch_value($code1,'"message":"','"');
        if(strpos($code1, 'Promo kamu sudah bisa dipakai')){
        echo "\n".color("green","[+] Message: ".$message);
        goto gocar;
        }else{
        echo "\n".color("red","[-] Message: ".$message);
        gocar:
         }
        goto cekk;
        }else if($pilih1 == "n" || $pilih1 == "N"){
        cekk:
        ?>
	<?php
function request3($url, $token = null, $data = null, $pin = null, $otpsetpin = null, $uuid = null){
$header[] = "Host: api.gojekapi.com";
$header[] = "User-Agent: okhttp/3.10.0";
$header[] = "Accept: application/json";
$header[] = "Accept-Language: id-ID";
$header[] = "Content-Type: application/json; charset=UTF-8";
$header[] = "X-AppVersion: 3.46.1";
$header[] = "X-UniqueId: ".time()."57".mt_rand(1000,9999);
$header[] = "Connection: keep-alive";
$header[] = "X-User-Locale: id_ID";
$header[] = "X-Location: -5.15".mt_rand(00000000,99999999).",119.43".mt_rand(00000000,99999999);
if ($pin):
$header[] = "pin: $pin";
    endif;
if ($token):
$header[] = "Authorization: Bearer $token";
endif;
if ($otpsetpin):
$header[] = "otp: $otpsetpin";
endif;
if ($uuid):
$header[] = "User-uuid: $uuid";
endif;
$c = curl_init("https://api.gojekapi.com".$url);
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    if ($data):
    curl_setopt($c, CURLOPT_POSTFIELDS, $data);
    curl_setopt($c, CURLOPT_POST, true);
    endif;
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_HEADER, true);
    curl_setopt($c, CURLOPT_HTTPHEADER, $header);
    $response = curl_exec($c);
    $httpcode = curl_getinfo($c);
    if (!$httpcode)
        return false;
    else {
        $header = substr($response, 0, curl_getinfo($c, CURLINFO_HEADER_SIZE));
        $body   = substr($response, curl_getinfo($c, CURLINFO_HEADER_SIZE));
    }
    $json = json_decode($body, true);
    return $body;
}
function save3($filename, $content)
{
    $save = fopen($filename, "a");
    fputs($save, "$content\r\n");
    fclose($save);
}
function nama3()
    {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $ex = curl_exec($ch);
    // $rand = json_decode($rnd_get, true);
    preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
    return $name[2][mt_rand(0, 14) ];
    }
function getStr4($a,$b,$c){
	$a = @explode($a,$c)[1];
	return @explode($b,$a)[0];
}
function getStr5($a,$b,$c,$d){
        $a = @explode($a,$c)[$d];
        return @explode($b,$a)[0];
}
function color3($color = "default" , $text)
    {
        $arrayColor = array(
            'grey'      => '1;30',
            'red'       => '1;31',
            'green'     => '1;32',
            'yellow'    => '1;33',
            'blue'      => '1;34',
            'purple'    => '1;35',
            'nevy'      => '1;36',
            'white'     => '1;0',
        );  
        return "\033[".$arrayColor[$color]."m".$text."\033[0m";
    }
function fetch_value3($str,$find_start,$find_end) {
	$start = @strpos($str,$find_start);
	if ($start === false) {
		return "";
	}
	$length = strlen($find_start);
	$end    = strpos(substr($str,$start +$length),$find_end);
	return trim(substr($str,$start +$length,$end));
}
?>
<?php
date_default_timezone_set('Asia/Jakarta');
        echo "\n".color("blue","[?] Klaim Voucher 20 V2 ? : y/n ");
        $pilih1 = trim(fgets(STDIN));
        if($pilih1 == "y" || $pilih1 == ""){
        echo color("red","[+] Token: ");
        $token = trim(fgets(STDIN));
        echo "\n".color("yellow","[!] Please wait");
        for($a=1;$a<=3;$a++){
        echo color("yellow",".");
        sleep(20);
        }
        $code1 = request3('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"COBAGOFOOD0607"}');
        $message = fetch_value($code1,'"message":"','"');
        if(strpos($code1, 'Promo kamu sudah bisa dipakai')){
        echo "\n".color("green","[+] Message: ".$message);
        goto goca;
        }else{
        echo "\n".color("red","[-] Message: ".$message);
        goca:
         }
        goto cek;
        }else if($pilih1 == "n" || $pilih1 == "N"){
        cek:
        ?>
	<?php
function request4($url, $token = null, $data = null, $pin = null, $otpsetpin = null, $uuid = null){
$header[] = "Host: api.gojekapi.com";
$header[] = "User-Agent: okhttp/3.10.0";
$header[] = "Accept: application/json";
$header[] = "Accept-Language: id-ID";
$header[] = "Content-Type: application/json; charset=UTF-8";
$header[] = "X-AppVersion: 3.46.1";
$header[] = "X-UniqueId: ".time()."57".mt_rand(1000,9999);
$header[] = "Connection: keep-alive";
$header[] = "X-User-Locale: id_ID";
$header[] = "X-Location: -0.49".mt_rand(00000000,99999999).",117.14".mt_rand(00000000,99999999);
if ($pin):
$header[] = "pin: $pin";
    endif;
if ($token):
$header[] = "Authorization: Bearer $token";
endif;
if ($otpsetpin):
$header[] = "otp: $otpsetpin";
endif;
if ($uuid):
$header[] = "User-uuid: $uuid";
endif;
$c = curl_init("https://api.gojekapi.com".$url);
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    if ($data):
    curl_setopt($c, CURLOPT_POSTFIELDS, $data);
    curl_setopt($c, CURLOPT_POST, true);
    endif;
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_HEADER, true);
    curl_setopt($c, CURLOPT_HTTPHEADER, $header);
    $response = curl_exec($c);
    $httpcode = curl_getinfo($c);
    if (!$httpcode)
        return false;
    else {
        $header = substr($response, 0, curl_getinfo($c, CURLINFO_HEADER_SIZE));
        $body   = substr($response, curl_getinfo($c, CURLINFO_HEADER_SIZE));
    }
    $json = json_decode($body, true);
    return $body;
}
function save4($filename, $content)
{
    $save = fopen($filename, "a");
    fputs($save, "$content\r\n");
    fclose($save);
}
function nama4()
    {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $ex = curl_exec($ch);
    // $rand = json_decode($rnd_get, true);
    preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
    return $name[2][mt_rand(0, 14) ];
    }
function getStr6($a,$b,$c){
	$a = @explode($a,$c)[1];
	return @explode($b,$a)[0];
}
function getStr7($a,$b,$c,$d){
        $a = @explode($a,$c)[$d];
        return @explode($b,$a)[0];
}
function color4($color = "default" , $text)
    {
        $arrayColor = array(
            'grey'      => '1;30',
            'red'       => '1;31',
            'green'     => '1;32',
            'yellow'    => '1;33',
            'blue'      => '1;34',
            'purple'    => '1;35',
            'nevy'      => '1;36',
            'white'     => '1;0',
        );  
        return "\033[".$arrayColor[$color]."m".$text."\033[0m";
    }
function fetch_value4($str,$find_start,$find_end) {
	$start = @strpos($str,$find_start);
	if ($start === false) {
		return "";
	}
	$length = strlen($find_start);
	$end    = strpos(substr($str,$start +$length),$find_end);
	return trim(substr($str,$start +$length,$end));
}
?>
<?php
date_default_timezone_set('Asia/Jakarta');
        echo "\n".color("blue","[?] Klaim Voucher 15 V2 ? : y/n ");
        $pilih1 = trim(fgets(STDIN));
        if($pilih1 == "y" || $pilih1 == ""){
        echo color("red","[+] Token: ");
        $token = trim(fgets(STDIN));
        echo "\n".color("yellow","[!] Please wait");
        for($a=1;$a<=3;$a++){
        echo color("yellow",".");
        sleep(20);
        }
        $code1 = request4('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"PESANGOFOOD0607"}');
        $message = fetch_value($code1,'"message":"','"');
        if(strpos($code1, 'Promo kamu sudah bisa dipakai')){
        echo "\n".color("green","[+] Message: ".$message);
        goto gca;
        }else{
        echo "\n".color("red","[-] Message: ".$message);
        gca:
         }
        goto cekkk;
        }else if($pilih1 == "n" || $pilih1 == "N"){
        cekkk:
        sleep(3);
        $cekvoucher = request4('/gopoints/v3/wallet/vouchers?limit=10&page=1', $token);
        $total = fetch_value($cekvoucher,'"total_vouchers":',',');
        $voucher3 = getStr1('"title":"','",',$cekvoucher,"3");
        $voucher1 = getStr1('"title":"','",',$cekvoucher,"1");
        $voucher2 = getStr1('"title":"','",',$cekvoucher,"2");
        $voucher4 = getStr1('"title":"','",',$cekvoucher,"4");
        $voucher5 = getStr1('"title":"','",',$cekvoucher,"5");
        $voucher6 = getStr1('"title":"','",',$cekvoucher,"6");
        echo"\n";
        echo "\n".color("blue","[!] Total voucher ".$total." : ");
        echo "\n".color("red","                     1. ".$voucher1);
        echo "\n".color("red","                     2. ".$voucher2);
        echo "\n".color("yellow","                     3. ".$voucher3);
        echo "\n".color("yellow","                     4. ".$voucher4);
        echo "\n".color("green","                     5. ".$voucher5);
        echo "\n".color("green","                     6. ".$voucher6);
        echo"\n";
        $expired1 = getStr1('"expiry_date":"','"',$cekvoucher,'1');
        $expired2 = getStr1('"expiry_date":"','"',$cekvoucher,'2');
        $expired3 = getStr1('"expiry_date":"','"',$cekvoucher,'3');
        $expired4 = getStr1('"expiry_date":"','"',$cekvoucher,'4');
        $expired5 = getStr1('"expiry_date":"','"',$cekvoucher,'5');
        $expired6 = getStr1('"expiry_date":"','"',$cekvoucher,'6');
         echo "\n".color("blue","[?] Mau set pin?: y/n ");
         $pilih1 = trim(fgets(STDIN));
         if($pilih1 == "y" || $pilih1 == ""){
         //if($pilih1 == "y" && strpos($no, "628")){
         echo color("green","[✓] PIN ANDA = 225588 ")."\n";
         $data2 = '{"pin":"225588"}';
         $getotpsetpin = request("/wallet/pin", $token, $data2, null, null, $uuid);
         echo "\n".color("red","[?] Otp Set Pin : ");
         $otpsetpin = trim(fgets(STDIN));
         $verifotpsetpin = request("/wallet/pin", $token, $data2, null, $otpsetpin, $uuid);
         echo $verifotpsetpin;
         }else if($pilih1 == "n" || $pilih1 == "N"){
         die();
         }else{
         echo color("red","-] GAGAL!!!\n");
         }
         }
         }
         }
         }
         }else{
         echo color("red","[×]──────────────────────────────────────────[×]\n");
         echo color("green","[-]         Otp yang anda input salah        [×]\n");
         echo color("green","[!]          Silahkan input kembali          [×]\n");
         echo color("red","[×]──────────────────────────────────────────[×]\n");
         goto otp;
         }
         }else{
         echo color("green","[×]      NOMOR SUDAH TERDAFTAR/SALAH !!!     [×]\n");
         echo color("red","[×]──────────────────────────────────────────[×]\n");
         goto ulang;
  }
 }
 echo change()."\n";
