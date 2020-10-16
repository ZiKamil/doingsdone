<?php

//Получение проекта
function get_project($con, $user_id) {
    $sql = "SELECT ID, Name, Author, (SELECT COUNT(*) FROM `task` WHERE `Project` = `project`.ID) AS `Quantity`  FROM `project` WHERE `Author` = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', intval($user_id));
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $projectz  = mysqli_fetch_all($res, MYSQLI_ASSOC);
    return $projectz;
}

//Получение задач
function get_tasks($con, $user_id) {
    $sql = "SELECT * FROM `task` WHERE `Author` = ? ORDER BY ID DESC";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', intval($user_id));
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $taskz = mysqli_fetch_all($res, MYSQLI_ASSOC);
    return $taskz;
}

//Получение id проекта по его названию
function get_id_from_project($con, $user_id, $prjnm) {
    $sql = "SELECT ID FROM `project` WHERE `Author` = ? AND `Name` = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'is', intval($user_id), strval($prjnm));
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $idprj = mysqli_fetch_assoc($res);
    return $idprj['ID'] ?? null;
}


function get_username($con, $user_id) {
    $sql = "SELECT Name FROM `user` WHERE `ID` = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', intval($user_id));
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $idprj = mysqli_fetch_assoc($res);
    return $idprj['Name'] ?? null;
}

//Получение задач по id проекта
function get_tasks_from_search($con, $user_id, $SearchByTasks, $idprj = null) {
    if(isset($idprj)){
        $sql =  "SELECT * FROM `task` WHERE `Author` = ? AND `Project` = ? AND MATCH(`Name`) AGAINST(?) ORDER BY ID DESC";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'iis', intval($user_id), intval($idprj), strval($SearchByTasks));
    }else{
        $sql =  "SELECT * FROM `task` WHERE `Author` = ? AND MATCH(`Name`) AGAINST(?) ORDER BY ID DESC";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'is', intval($user_id), strval($SearchByTasks));
    }

    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $taskz = mysqli_fetch_all($res, MYSQLI_ASSOC);
    return $taskz;
}

//Получение задач по поиску
function get_tasks_from_id($con, $user_id, $idprj) {
    $sql =  "SELECT * FROM `task` WHERE `Author` = ? AND `Project` = ? ORDER BY ID DESC";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', intval($user_id), intval($idprj));
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $taskz = mysqli_fetch_all($res, MYSQLI_ASSOC);
    return $taskz;
}

//Получение id user
function get_user_id($con, $email, $password) {
    $sql =  "SELECT `Password` FROM `user` WHERE `Email` = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 's', strval($email));
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $passworduser = mysqli_fetch_assoc($res);

    $hashpassworduser = $passworduser['Password'];

    if (password_verify(strval($password), $hashpassworduser)) {
        $sql =  "SELECT `ID` FROM `user` WHERE `Email` = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 's', strval($email));
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $iduser = mysqli_fetch_assoc($res);
        return $iduser['ID'] ?? null;
    }
    else {
        return null;
    }
}

//Проверка реальности ид проекта
function get_try_project_from_id($con, $user_id, $idprj) {
    $sql = "SELECT EXISTS(SELECT * FROM `project` WHERE `Author` = ? AND `ID` = ?) AS `EXIST`";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', intval($user_id), intval($idprj));
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $idprj = mysqli_fetch_assoc($res);
    return $idprj['EXIST'] !== 0 ? true : false;
}

//Проверка уникальности email
function get_try_user_from_email($con, $email) {
    $sql = "SELECT EXISTS(SELECT * FROM `user` WHERE `Email` = ?) AS `EXIST`";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 's', strval($email));
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $idprj = mysqli_fetch_assoc($res);
    return $idprj['EXIST'] !== 0 ? true : false;
}


//add задач
function addTask($con, $name, $file = null, $date_c = null, $user_id, $proj) {
    $sql = "INSERT INTO `task` ( `Completed`, `Name`, `File`, `DateOfCompletion`, `Author`, `Project`) VALUES ( 0, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'sssii', $name, $file, $date_c, $user_id, $proj);
    mysqli_stmt_execute($stmt);
}

//add user
function addUser($con, $name, $email, $password) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `user` ( `Email`, `Name`, `Password`) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'sss', $email, $name, $passwordHash);
    mysqli_stmt_execute($stmt);
}

//add проект
function addProject($con, $name, $user_id) {
    $sql = "INSERT INTO `project` ( `Name`, `Author`) VALUES (?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $name, $user_id);
    mysqli_stmt_execute($stmt);
}

//Проверка уникальности проект
function get_try_project($con, $name, $user_id) {
    $sql = "SELECT EXISTS(SELECT * FROM `project` WHERE `Name` = ? AND `Author` = ?) AS `EXIST`";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $name, $user_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $idprj = mysqli_fetch_assoc($res);
    return $idprj['EXIST'] !== 0 ? true : false;
}


//Завершить задачу
function setCheckedTask($con, $task, $user_id, $chk = 1) {
    $sql = "UPDATE `task` SET `Completed` = ? WHERE `ID` = ? AND `Author` = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'iii', $chk, $task, $user_id);
    mysqli_stmt_execute($stmt);
}