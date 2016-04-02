<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-30
 * Time: 16:06
 */
require_once ("./includes.php");

/*$student1 = new Student();
$student1->setName('Adam');
$student1->setSurname('Spadam');
$student1->setDateOfBirth('1982/02/02');
$student1->SaveToDb($conn);
var_dump($student1);*/

/*$students = Student::GetAllStudents($conn);
var_dump($students);*/

/*$testClass = new SchoolClass();
$testClass->setTeacherId(1);
$testClass->setName("Fizyka");
$testClass->setDescription("Zajęcia z fizyki");

$testClass->saveToDb($conn);

var_dump($testClass);*/

/*$testClass = new SchoolClass();
$testClass->loadFromDb($conn, 1);
$testClass->setDescription("Inne zajęcia też z biologii");
$testClass->saveToDb($conn);

var_dump($testClass);*/

/*$testClass = new SchoolClass();
$testClass->loadFromDb($conn, 3);
$testClass->deleteFromDb($conn);

var_dump($testClass);*/

/*$newClass = new SchoolClass();
$newClass->loadFromDb($conn,2);

//$newClass->addStudent($conn, 5);
//var_dump($allMyStudents);
//$newClass->removeStudent($conn, $allMyStudents[0]->getId());
$allMyStudents = $newClass->getAllStudents($conn);
var_dump($allMyStudents);*/

/*$testClass = new SchoolClass();
$testClass->loadFromDb($conn, 1);
$testClass->addMark($conn, 1, 'ładne oczy', '5');*/

/*$testClass = new SchoolClass();
$testClass->loadFromDb($conn, 1);
$testMarks=$testClass->listAllMarksOfStudent($conn, 1);
var_dump($testMarks);*/