<?php

/**
 * DW Auth Register Routes / Controllers
 * @version    0.6.0
 * @author     Jonathan Youngblood <jy@hxgf.io>
 */

use Slime\render;
use VPHP\db;



$app->get('/register[/]', function ($req, $res, $args) {
	return render::hbs($req, $res, [
    'layout' => '_layouts/base-guest',
		'template' => 'dw/auth-register',
    'title' => 'Register - ' . $_ENV['SITE_TITLE'],
	]);
});



$app->get('/register/activate/{hash}/{e_hash}[/]', function ($req, $res, $args) {
	$_user = db::find("users", "validate_hash='".$args['hash']."' and email='".base64_decode($args['e_hash'])."'");
	if ($_user['data']){
		db::update("users", [
		  'validate_hash' => NULL
    ], "validate_hash='".$args['hash']."'");
	}
	return render::hbs($req, $res, [
    'layout' => '_layouts/base-guest',
		'template' => 'dw/auth-register-activate',
    'title' => 'Registration Complete - ' . $_ENV['SITE_TITLE'],
    'data' => [
	    'invalid_hash' => !$_user['data'] ? true : false
    ]
	]);
});



$app->post('/auth/register/process[/]', function ($req, $res, $args) {
  $out = [ 'success' => true ];
	if (!$_POST['website'] && $_POST['email'] != ''){
		$hash = uniqid(uniqid());
    $email = trim(strtolower($_POST['email']));
		db::insert("users", [
			'_id' => uniqid(uniqid()),
			'email' => $email,
			'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
			'group_id' => '3',
			'date_created' => date('Y-m-d H:i:s'),
			'screenname' => $_POST['screenname'],
      'url_slug' => \VPHP\x::url_slug($_POST['screenname']),
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
      'ua_header' => $_POST['ua'],
      'ip_address' => \VPHP\x::client_ip(),
			'validate_hash' => $hash
		]);
		\VPHP\x::email_send([
		  'to' => $email,
		  'from' => '"'.$_ENV['SITE_TITLE'].'" <notifications@'.$_ENV['SITE_URL'].'>',
		  'subject' => 'Activate your new account',
		  'message' => "Thanks for registering with ".$_ENV['SITE_TITLE'].".\r\r". "In order to complete your account setup, we will need to verify your email address.\r\r Please click the link below to activate your account:\r\r"."http://".$_ENV['SITE_URL']."/register/activate/".$hash."/".base64_encode($email)
		]);
	}
	return render::json($req, $res, $out);
});