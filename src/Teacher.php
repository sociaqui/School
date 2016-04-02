<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-04-01
 * Time: 11:13
 */
class Teacher
{
    // Funkcje repozytorium
    static public function GetAllTeachers(mysqli $conn)
    {
        $allTeachers = [];

        $sql = "SELECT * FROM Teachers";

        $result = $conn->query($sql);
        if ($result != FALSE) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $teacher = new Teacher();
                    $teacher->id = $row["id"];
                    $teacher->setName($row["name"]);
                    $teacher->setSurname($row["surname"]);
                    $teacher->setWagePerHour($row["wage_per_hour"]);
                    $allTeachers[] = $teacher;
                }
            }
        }

        return $allTeachers;
    }

    static public function GetClassTeacher(mysqli $conn, $teacherId)
    {

        $teacher = new Teacher();
        $teacher->setName("Nie");
        $teacher->setSurname("przypisano");

        $sql = "SELECT * FROM Teachers
                WHERE id = {$teacherId}";

        $result = $conn->query($sql);
        if ($result != FALSE) {
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $teacher->id = $row["id"];
                $teacher->setName($row["name"]);
                $teacher->setSurname($row["surname"]);
                $teacher->setWagePerHour($row["wage_per_hour"]);
            }
        }

        return $teacher;
    }
    // Koniec funkcji repozytorium

    private $id;
    private $name;
    private $surname;
    private $wagePerHour;

    public function __construct()
    {
        $this->id = -1;
        $this->name = "";
        $this->surname = "";
        $this->wagePerHour = 0.00;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getWagePerHour()
    {
        return $this->wagePerHour;
    }

    public function setWagePerHour($wagePerHour)
    {
        $this->wagePerHour = $wagePerHour;
    }

    public function saveToDb(mysqli $conn)
    {
        if ($this->id === -1) {
            $sql = "INSERT INTO Teachers (name, surname, wage_per_hour)
                    VALUES ('{$this->getName()}',
                            '{$this->getSurname()}',
                            '{$this->getWagePerHour()}')";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                $this->id = $conn->insert_id;
                return true;
            }
        } else {
            $sql = "UPDATE Teachers SET
                      name = '{$this->getName()}',
                      surname = '{$this->getSurname()}',
                      birth_date = '{$this->getWagePerHour()}'
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

        $sql = "SELECT * FROM Teachers WHERE id={$id}";
        $result = $conn->query($sql);
        if ($result != FALSE) {
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->setName($row['name']);
                $this->setSurname($row['surname']);
                $this->setWagePerHour($row['wage_per_hour']);
                return true;
            }
        }
        return false;
    }

    public function deleteFromDb(mysqli $conn)
    {

        if ($this->id != -1) {
            $sql = "DELETE FROM Teachers WHERE id={$this->id}";
            $result = $conn->query($sql);
            if ($result != FALSE) {
                $this->id = -1;
                $this->name = "";
                $this->surname = "";
                $this->wagePerHour = 0.00;
                return true;
            }
        }
        return false;
    }

    public function getAllClasses(mysqli $conn)
    {

        $myClasses = SchoolClass::GetAllClassesOfTeacher($conn, $this->getId());

        return $myClasses;
    }


}