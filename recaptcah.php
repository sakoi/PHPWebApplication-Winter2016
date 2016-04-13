

//recaptcha validation

//variables
$secret = "6LcPmgQTAAAAAD2XQXfomdwCcyxkQ-x7mJLoGQqz"; //key from google called secret
$response = $_POST['g-recaptcha-responce'];

//contact google's curl library and do a hidden post to google
$ch = curl_init();//initalize
curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//type of request POST -may be optional-
curl_setopt($ch, CURLOPT_POST, true);

//array with post values
$post_data = array();
$post_data['secret'] = $secret;
$post_data['response'] = $response;
//send array
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

//execute
$results = curl_exec($ch);
curl_close($ch);


//take googles json object to php array
$result_array = json_decode($result, true);

if($result_array['success'] == 'false'){ //some said they got false to work without quotes. i got it to work with quotes.
echo 'Recaptcha response is required';
$ok = false;
}