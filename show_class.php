<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-31
 * Time: 15:12
 */

require_once ("./includes.php");

if(isset($_GET['classId'])){
    $class = new SchoolClass();
    if ($class->loadFromDb($conn, $_GET['classId']) === FALSE){
        unset ($class);
    }
}

if(isset($class)){
    echo("<h1>{$class->getName()}</h1><br/>");
    echo("<p>{$class->getDescription()}</p><br/>");
    echo("<p>Główny wykładowca: {$class->getMyTeacher($conn)->getName()} {$class->getMyTeacher($conn)->getSurname()}</p><br/>");

    echo("<h1>Kursanci:</h1>");
    $classStudents = $class->getAllStudents($conn);
    if(count($classStudents) === 0){
        echo ("Nikt nie jest zapisany...<br/>");
    }else{
        echo("<ul>");
        foreach ($classStudents as $student){
            echo ("<li>
                   {$student->getName()} {$student->getSurname()}
                   <a href='remove_from_class.php?classId={$class->getId()}&studentId={$student->getId()}'>Usuń z kursu</a>
                   <a href='add_mark.php?classId={$class->getId()}&studentId={$student->getId()}'>Dodaj ocenę</a>
                   <br/>
                   Oceny: {$class->listAllMarksOfStudent($conn, $student->getId())}
                   </li>");
        }
        echo("</ul>");
    }

    echo("<h1>Studenci nie biorący udziału w kursie:</h1>");
    $otherStudents = Student::GetAllStudentsNotInClass($conn,$class->getId());
    if(count($otherStudents) === 0){
        echo ("Wszyscy są zapisani...<br/>");
    }else{
        echo("<ul>");
        foreach ($otherStudents as $student){
            echo ("<li>
                   {$student->getName()} {$student->getSurname()}
                   <a href='add_to_class.php?classId={$class->getId()}&studentId={$student->getId()}'>Dodaj do kursu</a>
                   </li>");
        }
        echo("</ul>");
    }

}else{
    echo("<h1> But these are NOT cannons..... :-( </h1>");
}