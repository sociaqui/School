<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-31
 * Time: 10:04
 */

require_once ("./includes.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $newTeacher = new Teacher();
    $newTeacher->setName($_POST['name']);
    $newTeacher->setSurname($_POST['surname']);
    $newTeacher->setWagePerHour($_POST['wage']);
    $newTeacher->saveToDb($conn);
}

$allTeachers = Teacher::GetAllTeachers($conn);

echo ("<h1>Wykładowcy w szkole:</h1>");

if (count($allTeachers) === 0){
    echo("Brak wykładowców");
}else{
    echo("<ul>");
    foreach($allTeachers as $teacher){
        echo("<li>{$teacher->getName()} {$teacher->getSurname()}:
                    <a href='show_teacher.php?teacherId={$teacher->getId()}'>Zobacz profil</a>
                    <a href='update_teacher.php?teacherId={$teacher->getId()}'>Zmodyfikuj profil</a>
                    <a href='delete_teacher.php?teacherId={$teacher->getId()}'>Usuń profil</a></li>");
    }
    echo("</ul>");
}

?>

<h1>Dodaj wykładowcę:</h1><br/>

<form action='#' method='post'>
    <label>
        Imię:
        <input type='text' name='name'>
    </label>
    <label>
        Nazwisko:
        <input type='text' name='surname'>
    </label>
    <label>
        Stawka za godzinę:
        <input type='text' name='wage'>
    </label>
    <input type='submit'>
</form>