<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-31
 * Time: 14:56
 */

require_once ("./includes.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $newClass = new SchoolClass();
    $newClass->setName($_POST['name']);
    $newClass->setDescription($_POST['description']);
    $newClass->setTeacherId($_POST['teacher']);
    $newClass->saveToDb($conn);
}

$allClasses = SchoolClass::GetAllClasses($conn);

echo("<h1>Wszystkie kursy:</h1><br/>");
echo("<ul>");
foreach($allClasses as $class){
    echo("<li>
            {$class->getName()}
            <a href='show_class.php?classId={$class->getId()}'>Zobacz profil klasy</a>
          </li>");
}
echo("</ul>");
?>

<h1>Dodaj kurs:</h1><br/>

<form action='#' method='post'>
    <label>
        Teacher responsible for class:
        <input type='text' name='teacher'>
    </label>
    <label>
        Class name:
        <input type='text' name='name'>
    </label>
    <label>
        Class description:
        <input type='text' name='description'>
    </label>
    <input type='submit'>
</form>