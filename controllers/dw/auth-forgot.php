<?php



use Slime\render;
use VPHP\db;



$app->get('/forgot[/]', function ($req, $res, $args) {
	return render::hbs($req, $res, [
    'layout' => '_layouts/base-guest',
		'template' => 'dw/auth-forgot',
    'title' => 'Forgot Password - ' . $GLOBALS['site_title'],
	]);
});



$app->get('/forgot/reset/{hash}/{e_hash}[/]', function ($req, $res, $args) {
	$_user = db::find("users", "password_hash='".$args['hash']."' and email='".base64_decode($args['e_hash'])."'");
	return render::hbs($req, $res, [
    'layout' => '_layouts/base-guest',
		'template' => 'dw/auth-forgot-reset',
    'title' => 'Choose a new password - ' . $GLOBALS['site_title'],
		'data' => [
	    'hash' => $args['hash'],
	    'e_hash' => $args['e_hash'],
	    'invalid_hash' => !$_user['data'] ? true : false
    ]
	]);
});



$app->post('/auth/forgot/process[/]', function ($req, $res, $args) {
	$email = strtolower($_POST['email']);
  $out = [];
  $_user = db::find("users", "(email='".$email."' OR screenname='".$email."') AND validate_hash IS NULL");
  if ($_user['data'] && !$_POST['website']){
    $hash = uniqid(uniqid());
    db::update("users", [
      'password_hash' => $hash
    ], "email='".$email."'");
    \VPHP\x::email_send([
      'to' => $email,
      'from' => '"'.$GLOBALS['site_title'].'" <notifications@'.$GLOBALS['site_url'].'>',
      'subject' => 'Reset your password',
      'message' => "Here's the link to reset the password for your account at ".$GLOBALS['site_title'].".\r\r"."http://".$GLOBALS['site_url']."/forgot/reset/".$hash."/".base64_encode($email)
    ]);
    $out = [ 'success' => true ];
  }else{
    $out = [
      'error' => [
        'type' => 'email',
        'message' => "Error: Unregistered email address"
      ],
      'success' => false
    ];
  }
	return render::json($req, $res, $out);
});



$app->post('/auth/forgot/reset/process[/]', function ($req, $res, $args) {
  $out = [ 'success' => true ];
	if (!$_POST['website']){
		db::update("users", [
			'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
			'password_hash' => NULL
    ], "password_hash='".$_POST['hash']."' and email='".base64_decode($_POST['e_hash'])."'");
	}
	return render::json($req, $res, $out);
});
