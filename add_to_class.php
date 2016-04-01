<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-31
 * Time: 15:53
 */

require_once ("./includes.php");

if(isset($_GET['classId']) && isset($_GET['studentId'])){
    $class = new SchoolClass();
    if ($class->loadFromDb($conn, $_GET['classId']) === FALSE){
        unset ($class);
    }
    $student = new Student();
    if ($student->loadFromDb($conn, $_GET['studentId']) === FALSE){
        unset ($student);
    }

    if(isset($class) && isset($student)){
        $class->addStudent($conn, $student->getId());
        header("Location: show_class.php?classId={$class->getId()}");
    }
}
echo("<h1> But these are NOT cannons..... :-( </h1>");