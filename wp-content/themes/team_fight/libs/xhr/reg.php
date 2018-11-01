<?php 
include 'includes.php';
$response = array("html"=>"","errorFill"=>"false","errorEmail"=>"false");

if(isset($_POST['submit'])) {

	$sup_form_select = $_POST['sup_type'];
	$sup_email = $_POST['sup_email'];
	$sup_question = $_POST['sup_question'];

	if (	empty($sup_form_select) 
		|| 	empty($sup_email) 
		|| 	empty(trim($sup_question))) 
	{	
		// '.$sup_form_select.'<br>'.$sup_email.'<br>'.$sup_question.'
		$response['html'] = 'Заполните все поля<br>';
		$response['errorFill'] = 'true';
	} if (!filter_var($sup_email, FILTER_VALIDATE_EMAIL)) {
		$response['html'] .= 'Введите правильный email';
		$response['errorEmail'] = 'true';
	} if (	$response['errorFill'] == 'false' 
		&& 	$response['errorEmail'] == 'false') {

		$to = "fedorenkoalex23@gmail.com, fedorenkoalex23@mail.ru";
		$subject = $sup_form_select;
		$message = "
		<html>
		<head>
		<title>".$sup_form_select."</title>
		</head>
		<body>
		<p>Steamid: ".$steamid."</p>
		<p>Email: ".$sup_email."</p>
		<p>Message: ".str_replace("\n.", "\n..", trim($sup_question))."</p>
		</body>
		</html>
		";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// More headers
		$headers .= 'From: <'.$sup_email.'>' . "\r\n";
		$headers .= 'Cc: myboss@example.com' . "\r\n";

		mail($to,$subject,$message,$headers);
		$response['html'] .= 'Ваш запрос был успешно отправлен';

	}

	echo json_encode($response);

} else {
	$response['html'] .= 'Возникла ошибка';
	echo json_encode($response);
}
