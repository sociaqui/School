<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-31
 * Time: 14:50
 */

require_once ("./src/DBConnect.php");
require_once ("./src/Student.php");
require_once ("./src/SchoolClass.php");
require_once ("./src/Teacher.php");

$conn=DBConnect::createConnection();