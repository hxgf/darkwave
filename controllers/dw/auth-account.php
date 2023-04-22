<?php



use Slime\render;
use VPHP\db;



$app->get('/account[/]', function ($req, $res, $args) {
	$user_data = db::find("users", "_id='".$GLOBALS['user_id']."'");
	return render::hbs($req, $res, [
    'layout' => '_layouts/base',
		'template' => 'dw/auth-account',
    'title' => 'Account - ' . $GLOBALS['site_title'],
    'data' => [
	    'data' => $user_data['data'][0]
    ]
	]);
});



$app->post('/account/save[/]', function ($req, $res, $args) {
  if (!isset($GLOBALS['user_id'])){
    return render::json($req, $res, [
      'error_code' => 401,
      'error_message' => 'You are not authorized to use this resource.'
    ], 401);
  }else{
    $form = [];
    parse_str($_POST['form'],$form);
    $input = [
      'email' => strtolower($form['email']),
      'url_slug' => \VPHP\x::url_slug($form['screenname']),
      'screenname' => $form['screenname'],
      'first_name' => $form['first_name'],
      'last_name' => $form['last_name'],
		  'date_updated' => date('Y-m-d H:i:s')
    ];
    if ($form['password']){
      $input['password'] = password_hash($form['password'], PASSWORD_BCRYPT);
    }
    db::update("users", $input, "_id='".$GLOBALS['user_id']."'");
    $user_id = $GLOBALS['user_id'];

    // fixit photo uploads
    // fixit make component functions & move to dw.php

    // if ($form['file_1']){
    // 	if ($form['file_1'] == 'DELETE'){
    // 		$user = db::find("users", "_id='".$user_id."'");
    // 		if ($user['data'][0]['avatar_small'] != '/images/users/avatar-default-s.png'){
    // 			unlink($_SERVER['DOCUMENT_ROOT'] . $user['data'][0]['avatar_small']);
    // 			unlink($_SERVER['DOCUMENT_ROOT'] . $user['data'][0]['avatar_medium']);
    // 			unlink($_SERVER['DOCUMENT_ROOT'] . $user['data'][0]['avatar_large']);
    // 			unlink($_SERVER['DOCUMENT_ROOT'] . $user['data'][0]['avatar_original']);
    // 		}
    // 		$photo_input = [
    // 			'avatar_small' => '/images/users/avatar-default-s.png',
    // 			'avatar_medium' => '/images/users/avatar-default-m.png',
    // 			'avatar_large' => '/images/users/avatar-default-l.png',
    // 			'avatar_original' => '/images/users/avatar-default-o.png',
    //     ];
    // 	}else{
    // 		$user = db::find("users", "_id='".$user_id."'");
    // 		if ($user['data'][0]['avatar_small'] && $user['data'][0]['avatar_small'] != '/images/users/avatar-default-s.png'){
    // 			unlink($_SERVER['DOCUMENT_ROOT'] . $user['data'][0]['avatar_small']);
    // 			unlink($_SERVER['DOCUMENT_ROOT'] . $user['data'][0]['avatar_medium']);
    // 			unlink($_SERVER['DOCUMENT_ROOT'] . $user['data'][0]['avatar_large']);
    // 			unlink($_SERVER['DOCUMENT_ROOT'] . $user['data'][0]['avatar_original']);
    // 		}
    // 		$filename = $form['file_1'];
    // 		$ext = strtolower(pathinfo($_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $filename, PATHINFO_EXTENSION));
    // 		$filename_clean = explode('||-||', str_replace('.'.$ext, '', $filename));
    //     $source = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $filename;
    // 		$filename_small = $user_id . '-' . $filename_clean[1] . '-s.' . $ext;
    // 		$filename_medium = $user_id . '-' . $filename_clean[1] . '-m.' . $ext;
    // 		$filename_large = $user_id . '-' . $filename_clean[1] . '-l.' . $ext;
    // 		$filename_original = $user_id . '-' . $filename_clean[1] . '-o.' . $ext;
    // 		list($photo_width, $photo_height) = getimagesize($source);
    // 		$sq = new phMagick($source, $_SERVER['DOCUMENT_ROOT'].'/images/users/'.$filename_small);
    // 		$sq->resizeExactly(300,300);
    // 		if ($photo_width > 800){
    // 			$md = new phMagick($source, $_SERVER['DOCUMENT_ROOT'].'/images/users/'.$filename_medium);
    // 			$md->resize(800, 0);
    // 		}else{
    // 			copy($source, $_SERVER['DOCUMENT_ROOT'].'/images/users/'.$filename_medium);
    // 		}
    // 		if ($photo_width > 1024){
    // 			$ld = new phMagick($source, $_SERVER['DOCUMENT_ROOT'].'/images/users/'.$filename_large);
    // 			$ld->resize(1024, 0);
    // 		}else{
    // 			copy($source, $_SERVER['DOCUMENT_ROOT'].'/images/users/'.$filename_large);
    // 		}
    // 		copy($source, $_SERVER['DOCUMENT_ROOT'].'/images/users/'.$filename_original);
    // 		unlink($source);
    // 		$photo_input = [
    // 			'avatar_small' => '/images/users/' . $filename_small,
    // 			'avatar_medium' => '/images/users/' . $filename_medium,
    // 			'avatar_large' => '/images/users/' . $filename_large,
    // 			'avatar_original' => '/images/users/' . $filename_original,
    //     ];
    // 	}
    // 	db::update("users", $photo_input, "_id='".$user_id."'");
    // }


    $_user = db::find("users", "_id = '".$GLOBALS['user_id']."'");
    $user = $_user['data'][0];

    return render::json($req, $res, [
      'success' => true,
      'input' => $input,
      'form' => $form,
      'form_string' => $_POST['form'],
      'user_id' => $GLOBALS['user_id'],
      'token' => \Darkwave\dw::generate_jwt($user)
    ]);
  }
});