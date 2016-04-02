<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-31
 * Time: 10:59
 */

require_once ("./includes.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $newTeacher = new Teacher();
    $newTeacher->loadFromDb($conn, $_POST['teacherId']);
    $newTeacher->setName($_POST['name']);
    $newTeacher->setSurname($_POST['surname']);
    $newTeacher->setWagePerHour($_POST['wage']);
    $newTeacher->saveToDb($conn);
    header ("Location: show_teacher.php?teacherId={$newTeacher->getId()}");
}

if(isset($_GET['teacherId'])){
    $teacher = new Teacher();
    if ($teacher->loadFromDb($conn, $_GET['teacherId']) === FALSE){
        unset ($teacher);
    }
}

if(isset($teacher)){
    echo("
    <form action='#' method='post'>
        <label>
            Imię:
            <input type='text' name='name' value='{$teacher->getName()}'>
        </label>
        <label>
            Nazwisko:
            <input type='text' name='surname' value='{$teacher->getSurname()}'>
        </label>
        <label>
            Stawka za godzinę:
            <input type='text' name='wage' value='{$teacher->getWagePerHour()}'>
        </label>
        <input type='hidden' name='teacherId' value='{$teacher->getId()}'>
        <input type='submit'>
    </form>
    ");
}else{
    echo("Nie znaleziono wykładowcy...");
}