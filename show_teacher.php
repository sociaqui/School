<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-31
 * Time: 10:15
 */

require_once ("./includes.php");

if(isset($_GET['teacherId'])){
    $teacher = new Teacher();
    if ($teacher->loadFromDb($conn, $_GET['teacherId']) === FALSE){
        unset ($teacher);
    }
}

if(isset($teacher)){
    echo("<h1>{$teacher->getName()} {$teacher->getSurname()}</h1>");
    echo("Wykłada przedmioty:<br/>");
    $teacherClasses = $teacher->getAllClasses($conn);
    if (count($teacherClasses) > 0){
        echo("<ul>");
        foreach($teacherClasses as $class){

            echo ("<li>{$class->getName()}: <a href='show_class.php?classId={$class->getId()}'>Zobacz profil</a></li>");

        }
        echo("</ul>");
    }else{

        echo("Nie prowadzi żadnych zajęć");
    }
}else{
    echo("Nie znaleziono wykładowcy...");
}