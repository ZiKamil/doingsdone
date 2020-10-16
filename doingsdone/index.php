<?php
require_once("connection.php");

if(!$con){
	print("Error connected: " . mysqli_connect_error());
}else{
	
    session_start();
    if (isset($_GET['SignOut'])){
    	$_SESSION = [];
    	header("Location: /");
    }
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    

	require_once("db.php");
	require_once("helpers.php");


	$title = 'Дела в порядке';
	$contentside='';
	$bodybackground = false;
	$withsidebar = true;
	$welcome = false;
	if(isset($user_id)){
		$projectz = get_project($con, $user_id);
		if (isset($_GET['addTask'])) {
		    require_once ('add.php');
			$title = 'Добавление задачи - Дела в порядке';
		}elseif (isset($_GET['addProject'])) {
		    require_once ('addProject.php');
			$title = 'Добавление проекта - Дела в порядке';
		}else{
	        require_once("smain.php");
		}
 		
 		require_once("scontentside.php");
		$header_side = include_template('header_side.php', [
			'user_name' => get_username($con, $user_id)
		]);

		$footer_button = include_template('footer_button.php');	
	}else{
		$header_side = include_template('unk_header_side.php');
		$footer_button = '';
		if (isset($_GET['Authorization'])) {
		    require_once ('authorization.php');
			$title = 'Авторизация - Дела в порядке';
		}elseif (isset($_GET['Register'])){
	        require_once("register.php");
	        $title = 'Регистрация - Дела в порядке';
		}else {
			$page_content = include_template('guest.php');
			$bodybackground = true;
			$withsidebar = false;
			$welcome = true;
		}
	};

	$layout_content = include_template('layout.php', [
		'content' => $contentside.$page_content,
		'title' => $title,

		'header_side' => $header_side,
		'footer_button' => $footer_button,
		'bodybackground' => $bodybackground,
		'withsidebar' => $withsidebar,
		'welcome' => $welcome
	]);
	
	print($layout_content);
}

