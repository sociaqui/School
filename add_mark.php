<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-04-02
 * Time: 14:59
 */

require_once("./includes.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class = new SchoolClass();
    $class->loadFromDb($conn, $_POST['classId']);
    $class->addMark($conn, $_POST['studentId'], $_POST['description'], $_POST['mark']);
    header("Location: show_class.php?classId={$class->getId()}");
}

if (isset($_GET['classId']) && isset($_GET['studentId'])) {
    $class = new SchoolClass();
    if ($class->loadFromDb($conn, $_GET['classId']) === FALSE) {
        unset ($class);
    }
    $student = new Student();
    if ($student->loadFromDb($conn, $_GET['studentId']) === FALSE) {
        unset ($student);
    }

    if (isset($class) && isset($student)) {
        echo("
        <form action='#' method='post'>
            <label>
                Ocena za:
                <input type='text' name='description' value='np. kolokwium'>
            </label>
            <select name='mark'>
        ");
                for ($i=2;$i<6;$i++){
                    echo ("<option value='{$i}'>{$i}</option>");
                }
        echo("</select>
            <input type='hidden' name='studentId' value='{$student->getId()}'>
            <input type='hidden' name='classId' value='{$class->getId()}'>
            <input type='submit'>
        </form>
        ");

    }else{
        echo("<h1> But these are NOT cannons..... :-( </h1>");
    }
}else{
    echo("<h1> But these are NOT cannons..... :-( </h1>");
}