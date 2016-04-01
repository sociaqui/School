<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-31
 * Time: 10:59
 */

require_once ("./includes.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $newStudent = new Student();
    $newStudent->loadFromDb($conn, $_POST['studentId']);
    $newStudent->setName($_POST['name']);
    $newStudent->setSurname($_POST['surname']);
    $newStudent->setDateOfBirth($_POST['birthDate']);
    $newStudent->saveToDb($conn);
    header ("Location: show_student.php?studentId={$newStudent->getId()}");
}

if(isset($_GET['studentId'])){
    $student = new Student();
    if ($student->loadFromDb($conn, $_GET['studentId']) === FALSE){
        unset ($student);
    }
}

if(isset($student)){
    echo("
    <form action='#' method='post'>
        <label>
            Imię:
            <input type='text' name='name' value='{$student->getName()}'>
        </label>
        <label>
            Nazwisko:
            <input type='text' name='surname' value='{$student->getSurname()}'>
        </label>
        <label>
            Data urodzenia:
            <input type='text' name='birthDate' value='{$student->getDateOfBirth()}'>
        </label>
        <input type='hidden' name='studentId' value='{$student->getId()}'>
        <input type='submit'>
    </form>
    ");
}else{
    echo("Brak wybranego kursanta...");
}