<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-31
 * Time: 11:24
 */

require_once ("./includes.php");

if(isset($_GET['teacherId'])){
    $teacher = new Teacher();
    if ($teacher->loadFromDb($conn, $_GET['teacherId']) === TRUE){
        $teacher->deleteFromDb($conn);
        header ("Location: show_all_teachers.php");
    }
}
?>
<h1>Coś poszło nie tak...</h1>
