<?php
$errors = [];
$proj_v =  isset($_GET['project']) ? $_GET['project'] : null;

if(empty( $_POST['project']) && $proj_v != null){
    $pr_s = get_id_from_project($con, $user_id, $proj_v);
    if($pr_s){
        $_POST['project'] = htmlspecialchars($pr_s);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $len =  is_strLen_valide(3, 255, $_POST['name']);
    if (isset($len)) {
        $errors['name'] = $len;
    }


    if (empty($_POST['project'])) {
        $errors['project'] = 'Поле проекта не заполнено';
    }elseif (!get_try_project_from_id($con, $user_id, intval($_POST['project']))) {
        $errors['project'] = 'Выбраного проекта не существует';
    }

    if (!empty($_POST['date'])) {
        if (!is_date_valid($_POST['date']) ) {
            $errors['date'] = 'Введите корректную дату по формату ГГГГ-ММ-ДД';
        }else if(strtotime("today") > strtotime($_POST['date'])){
            $errors['date'] = 'Введенная дата не может быть меньше текущей';
        }
    }


    if (isset($_FILES)){
     if($_FILES['file']['error'] == 0 && $_FILES['file']['size'] > 2097152) {
        $errors['file'] = 'Превышен максимальный вес файла в 2МБ';
     }
    }


    if (!count($errors)) {

        $file_ur = null;
        if (isset($_FILES) && $_FILES['file']['error']==0) {

                $file_name = $_FILES['file']['name'];
                // $file_path = __DIR__ . '/uploads/';
                // $file_url = 'uploads/'. $file_name;
                //Код проверки и создания папки пользователя для личного удобства удаления
                $dir_url = 'uploads/user'.$user_id.'/';
                $file_url = $dir_url.$file_name;
                if(!file_exists ($dir_url)){
                    mkdir($dir_url);
                }

                $a = move_uploaded_file($_FILES['file']['tmp_name'], $file_url);

        }
        addTask($con, strval($_POST['name']), empty($file_url) ? null : strval($file_url),
            empty($_POST['date']) ? null : strval($_POST['date']),
            intval($user_id), intval($_POST['project']));
        header("Location: /index.php?project=".$projectz[array_search($_POST['project'], array_column($projectz, "ID"))]['Name']);

    }
}

$page_content = include_template('form_task.php',
    [
        'projectz' => $projectz,
        'errors' => $errors
]);




