<?php


$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$len = is_strLen_valide(1, 255, $_POST['email']);
	if (isset($len)) {
		$errors['email'] = $len;
	}elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    	$errors['email'] = 'E-mail введён некорректно';
    }

	$len =  is_strLen_valide(1, 255, $_POST['password']);
	if (isset($len)) {
    	$errors['password'] = $len;
	}

    if (!count($errors)) {
    	if (!get_try_user_from_email($con, $_POST['email'])) {
        	$errors['email'] = 'Учетная запись с таким E-mail не найдена';	
    	}else{
    		$iduser = get_user_id($con, $_POST['email'], $_POST['password']);
    		if(isset($iduser)){
				$_SESSION['user_id'] = $iduser;
				header("Location: /");
    		}else{
    			$errors['password'] = 'Введен не верный пароль';
    		}
    	}
    }
}

$page_content = include_template('form_authorization.php',
[	
	'errors' => $errors
]);

