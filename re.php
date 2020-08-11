<?php
$ch = curl_init();
 
// TODO - Define your SafetyNet Secret in the below line
$secretKey = '6Lf8z0sUAAAAAP80KqD1U-3e7M_JlOrgWSms5XDd';


$captcha = isset($_POST['recaptcha-response']) && !empty($_POST['recaptcha-response']) ? $_POST['recaptcha-response']: '';

$captcha = '6Lf8z0sUAAAAAP80KqD1U';
 
curl_setopt_array($ch, [
    CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => [
        'secret' => $secretKey,
        'response' => $captcha,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ],
    CURLOPT_RETURNTRANSFER => true
]);
 
$output = curl_exec($ch);

print_r($output);die("==");
curl_close($ch);
 
$json = json_decode($output);




$res = array();
 
if($json->success){
    $res['success'] = true;
    $res['message'] = 'Captcha verified successfully!';
}else{
    $res['success'] = false;
    $res['message'] = 'Failed to verify captcha!';
}
 
echo json_encode($res);
?>