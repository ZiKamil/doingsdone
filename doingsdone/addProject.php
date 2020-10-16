<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $len =  is_strLen_valide(3, 255, $_POST['name']);
    if (isset($len)) {
        $errors['name'] = $len;
    }elseif (get_try_project($con, $_POST['name'], $user_id)) {
        $errors['name'] = "Имя не уникально!";
    }


    if (!count($errors)) {
        addProject($con, htmlspecialchars($_POST['name']), $user_id);
        header("Location: /");
    }
}

$page_content = include_template('form_project.php',
[
    'errors' => $errors
]);




