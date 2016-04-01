<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-31
 * Time: 11:41
 */
class SchoolClass
{

    // Funkcje repozytorium
    static public function GetAllClasses(mysqli $conn){
        $allClasses = [];

        $sql = "SELECT * FROM Classes";

        $result = $conn->query($sql);
        if ($result != FALSE){
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $class = new SchoolClass();
                    $class->id= $row["id"];
                    $class->setName($row["name"]);
                    $class->setDescription($row["description"]);
                    $class->setTeacherId($row["teacher_id"]);
                    $allClasses[]=$class;
                }
            }
        }

        return $allClasses;
    }

    static public function GetAllClassesOfStudent(mysqli $conn, $studentId){
        $allClasses = [];

        $sql = "SELECT Classes.id as id,
                       Classes.name as name,
                       Classes.description as description,
                       Classes.teacher_id as teacher_id
                FROM Classes
                       JOIN students_classes
                       ON Classes.id = students_classes.class_id
                WHERE students_classes.student_id = {$studentId}";

        $result = $conn->query($sql);
        if ($result != FALSE){
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $class = new SchoolClass();
                    $class->id= $row["id"];
                    $class->setName($row["name"]);
                    $class->setDescription($row["description"]);
                    $class->setTeacherId($row["teacher_id"]);
                    $allClasses[]=$class;
                }
            }
        }

        return $allClasses;
    }
    // Koniec funkcji repozytorium

    private $id;
    private $teacherId;
    private $name;
    private $description;

    public function __construct()
    {
        $this->id = -1;
        $this->teacherId = -1;
        $this->name = "";
        $this->description = "";
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTeacherId()
    {
        return $this->teacherId;
    }

    public function setTeacherId($teacherId)
    {
        $this->teacherId = $teacherId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function saveToDb(mysqli $conn)
    {
        if ($this->id === -1) {
            $sql = "INSERT INTO Classes (teacher_id, name, description)
                    VALUES ('{$this->getTeacherId()}',
                            '{$this->getName()}',
                            '{$this->getDescription()}')";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                $this->id = $conn->insert_id;
                return true;
            }
        } else {
            $sql = "UPDATE Classes SET
                      teacher_id = '{$this->getTeacherId()}',
                      name = '{$this->getName()}',
                      description = '{$this->getDescription()}'
                    WHERE id={$this->getId()}";
            $result = $conn->query($sql);
            if ($result != FALSE) {
                return true;
            }
        }
        return false;
    }

    public function loadFromDb(mysqli $conn, $id)
    {

        $sql = "SELECT * FROM Classes WHERE id={$id}";
        $result = $conn->query($sql);
        if ($result != FALSE) {
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->setTeacherId($row['teacher_id']);
                $this->setName($row['name']);
                $this->setDescription($row['description']);
                return true;
            }
        }
        return false;
    }

    public function deleteFromDb(mysqli $conn)
    {

        if ($this->id != -1) {
            $sql = "DELETE FROM Classes WHERE id={$this->id}";
            $result = $conn->query($sql);
            if ($result != FALSE) {
                $this->id = -1;
                $this->teacherId = -1;
                $this->name = "";
                $this->description = "";
                return true;
            }
        }
        return false;
    }

    public function addStudent(mysqli $conn, $studentId){
        if($this->getId() != -1 && $studentId != -1){
            $sql = "INSERT INTO students_classes(student_id, class_id)
                    VALUES ({$studentId},{$this->getId()})";
            $result = $conn->query($sql);
            return $result;
        }
        return FALSE;
    }

    public function removeStudent(mysqli $conn, $studentId){
        if($this->getId() != -1 && $studentId != -1){
            $sql = "DELETE FROM students_classes
                    WHERE student_id = {$studentId} AND class_id={$this->getId()}";
            $result = $conn->query($sql);
            return ($result != FALSE);
        }
        return FALSE;
    }

    public function getAllStudents(mysqli $conn)
    {
        $myStudents = Student::GetAllStudentsFromClass($conn, $this->getId());
        return $myStudents;
    }
}