<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-31
 * Time: 10:15
 */

require_once ("./includes.php");

if(isset($_GET['studentId'])){
    $student = new Student();
    if ($student->loadFromDb($conn, $_GET['studentId']) === FALSE){
        unset ($student);
    }
}

if(isset($student)){
    echo("<h1>{$student->getName()} {$student->getSurname()}</h1>");
    echo("Chodzi na zajęcia:<br/>");
    $studentClasses = $student->getAllClasses($conn);
    if (count($studentClasses) > 0){
        echo("<ul>");
        foreach($studentClasses as $class){

            echo ("<li>{$class->getName()}: <a href='show_class.php?classId={$class->getId()}'>Zobacz profil</a><br/>
                   Oceny: {$class->listAllMarksOfStudent($conn, $student->getId())}
                   </li>");

        }
        echo("</ul>");
    }else{

        echo("Nie chodzi na żadne zajęcia");
    }
}else{
    echo("Brak wybranego kursanta...");
}