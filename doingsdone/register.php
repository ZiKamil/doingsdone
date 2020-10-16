<?php
$errors = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    	$len = is_strLen_valide(1, 255, $_POST['email']);
    	if (isset($len)) {
    		$errors['email'] = $len;
    	}elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        	$errors['email'] = 'E-mail введён некорректно';
        }elseif (get_try_user_from_email($con, $_POST['email'])) {
        	$errors['email'] = 'E-mail не уникален';
        }
    
    	$len =  is_strLen_valide(1, 255, $_POST['password']);
    	if (isset($len)) {
        	$errors['password'] = $len;
    	}

    	$len =  is_strLen_valide(1, 255, $_POST['name']);
    	if (isset($len)) {
        	$errors['name'] = $len;
    	}


    if (count($errors)) {
    	$errors['error-message'] = 'Пожалуйста, исправьте ошибки в форме';
    }else{
    	addUser($con, $_POST['name'], $_POST['email'], $_POST['password']);
        header("Location: /");

    }
}

$page_content = include_template('form_register.php',
[	
	'errors' => $errors
]);

