<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultFolders1 {
    private $data;
    private $index = 0;

    public function __construct($data) {
        $this->data = $data;
    }

    public function fetch_assoc() {
        if ($this->index < count($this->data)) {
            return $this->data[$this->index++];
        }
        return null;
    }
}

class MockMysqliFolders1 {
    private $results = [];
    private $lastQuery = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultFolders1($this->results[$sql]);
        }
        
        return new MockMysqliResultFolders1([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class Folders1Test extends TestCase
{
    private $conn;
    private $session;
    private $studentData;
    private $teacherData;

    protected function setUp(): void
    {
        // Mock student data
        $this->studentData = [
            [
                'lrn' => '123456',
                'fname' => 'John',
                'lname' => 'Doe',
                'birth_date' => '2010-01-01',
                'teacher_id' => '1',
                'school' => 'BES',
                'enroll_status' => 'Enrolled'
            ],
            [
                'lrn' => '234567',
                'fname' => 'Jane',
                'lname' => 'Smith',
                'birth_date' => '2011-02-02',
                'teacher_id' => '2',
                'school' => 'GES',
                'enroll_status' => 'Main Streamed'
            ]
        ];
        
        // Mock teacher data
        $this->teacherData = [
            [
                'teacher_id' => '1',
                'fname' => 'Teacher',
                'lname' => 'One'
            ],
            [
                'teacher_id' => '2',
                'fname' => 'Teacher',
                'lname' => 'Two'
            ]
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliFolders1();
        
        // Mock session
        $this->session = [
            'school' => 'BES',
            'teacher_id' => '1'
        ];
    }

    public function testFetchStudentsForSchoolAndTeacher()
    {
        $school = $this->session['school'];
        $teacher = $this->session['teacher_id'];
        
        // Set up mock query results
        $sqlget1 = "SELECT * FROM new_student WHERE school = '$school' AND teacher_id = $teacher";
        $conn = new MockMysqliFolders1([
            $sqlget1 => $this->studentData
        ]);
        
        // Execute query
        $result = $conn->query($sqlget1);
        
        // Collect results
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        
        // Assert correct number of students returned
        $this->assertCount(2, $students);
        
        // Assert student data is correct
        $this->assertEquals('123456', $students[0]['lrn']);
        $this->assertEquals('John', $students[0]['fname']);
        $this->assertEquals('Doe', $students[0]['lname']);
        
        $this->assertEquals('234567', $students[1]['lrn']);
        $this->assertEquals('Jane', $students[1]['fname']);
        $this->assertEquals('Smith', $students[1]['lname']);
    }
    
    public function testFetchTeacherNamesForStudents()
    {
        // Set up mock query results for teacher data
        $teacher_id = '1';
        $sqlget = "SELECT * FROM teachers WHERE teacher_id = $teacher_id";
        $conn = new MockMysqliFolders1([
            $sqlget => [$this->teacherData[0]]
        ]);
        
        // Execute query
        $result = $conn->query($sqlget);
        
        // Get teacher data
        $row = $result->fetch_assoc();
        $teacherName = $row ? $row['fname'] . " " . $row['lname'] : 'Unknown';
        
        // Assert teacher name is correct
        $this->assertEquals('Teacher One', $teacherName);
    }
    
    public function testCalculateStudentAge()
    {
        // Get student birth date
        $birthDate = $this->studentData[0]['birth_date'];
        
        // Calculate age
        $date = date_create($birthDate);
        $interval = $date->diff(new DateTime());
        $age = $interval->y;
        
        // Assert age calculation is correct (this will depend on the current date)
        // For a birth date of 2010-01-01, the age should be the current year minus 2010
        $expectedAge = (int)date('Y') - 2010;
        $this->assertEquals($expectedAge, $age);
    }
}
?>
