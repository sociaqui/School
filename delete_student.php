<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-31
 * Time: 11:24
 */

require_once ("./includes.php");

if(isset($_GET['studentId'])){
    $student = new Student();
    if ($student->loadFromDb($conn, $_GET['studentId']) === TRUE){
        $student->deleteFromDb($conn);
        header ("Location: show_all_students.php");
    }
}
?>
<h1>Coś poszło nie tak...</h1>
