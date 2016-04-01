<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-30
 * Time: 15:59
 */
class DBConnect
{
    static private $dbName = "test2";
    static private $dbUser = "username";
    static private $dbPassword = "password";
    static private $dbHost = "localhost";

    static public function createConnection(){
        $conn = new mysqli(self::$dbHost,self::$dbUser,self::$dbPassword,self::$dbName);
        if ($conn->connect_errno != 0){
            die($conn->connect_errno);
        }else {
            return $conn;
        }
    }

    private function __construct()
    {

    }
}