<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-31
 * Time: 10:04
 */

require_once ("./includes.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $newStudent = new Student();
    $newStudent->setName($_POST['name']);
    $newStudent->setSurname($_POST['surname']);
    $newStudent->setDateOfBirth($_POST['birthDate']);
    $newStudent->saveToDb($conn);
}

$allStudents = Student::GetAllStudents($conn);

echo ("<h1>Kursanci w szkole:</h1>");

if (count($allStudents) === 0){
    echo("Brak kursantów");
}else{
    echo("<ul>");
    foreach($allStudents as $student){
        echo("<li>{$student->getName()} {$student->getSurname()}:
                    <a href='show_student.php?studentId={$student->getId()}'>Zobacz profil</a>
                    <a href='update_student.php?studentId={$student->getId()}'>Zmodyfikuj profil</a>
                    <a href='delete_student.php?studentId={$student->getId()}'>Usuń profil</a></li>");
    }
    echo("</ul>");
}

?>

<h1>Dodaj kursanta:</h1><br/>

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
        Data urodzenia:
        <input type='text' name='birthDate'>
    </label>
    <input type='submit'>
</form>