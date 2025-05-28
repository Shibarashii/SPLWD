<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultFolderTable {
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

class MockMysqliFolderTable {
    private $results = [];
    private $lastQuery = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultFolderTable($this->results[$sql]);
        }
        
        return new MockMysqliResultFolderTable([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class FolderTableTest extends TestCase
{
    private $conn;
    private $session;
    private $enrolledStudents;
    private $mainStreamedStudents;
    private $graduatedStudents;
    private $transferredStudents;
    private $teacherData;

    protected function setUp(): void
    {
        // Mock enrolled students data
        $this->enrolledStudents = [
            [
                'lrn' => '123456',
                'fname' => 'John',
                'lname' => 'Doe',
                'birth_date' => '2010-01-01',
                'teacher_id' => '1',
                'school' => 'BES',
                'enroll_status' => 'Enrolled'
            ]
        ];
        
        // Mock main streamed students data
        $this->mainStreamedStudents = [
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
        
        // Mock graduated students data
        $this->graduatedStudents = [
            [
                'lrn' => '345678',
                'fname' => 'Bob',
                'lname' => 'Johnson',
                'birth_date' => '2009-03-03',
                'teacher_id' => '1',
                'school' => 'BES',
                'enroll_status' => 'Graduated'
            ]
        ];
        
        // Mock transferred students data
        $this->transferredStudents = [
            [
                'lrn' => '456789',
                'fname' => 'Alice',
                'lname' => 'Williams',
                'birth_date' => '2008-04-04',
                'teacher_id' => '2',
                'school' => 'GES',
                'enroll_status' => 'Transferred'
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
        $this->conn = new MockMysqliFolderTable();
        
        // Mock session
        $this->session = [
            'school' => 'BES'
        ];
    }

    public function testFetchEnrolledStudents()
    {
        $school = $this->session['school'];
        
        // Set up mock query results
        $sqlget1 = "SELECT * FROM new_student where school= '$school' and enroll_status = 'Enrolled'";
        $conn = new MockMysqliFolderTable([
            $sqlget1 => $this->enrolledStudents
        ]);
        
        // Execute query
        $result = $conn->query($sqlget1);
        
        // Collect results
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        
        // Assert correct number of students returned
        $this->assertCount(1, $students);
        
        // Assert student data is correct
        $this->assertEquals('123456', $students[0]['lrn']);
        $this->assertEquals('John', $students[0]['fname']);
        $this->assertEquals('Doe', $students[0]['lname']);
        $this->assertEquals('Enrolled', $students[0]['enroll_status']);
    }
    
    public function testFetchMainStreamedStudents()
    {
        $school = $this->session['school'];
        
        // Set up mock query results
        $sqlget1 = "SELECT * FROM new_student where school= '$school' and enroll_status = 'Main Streamed'";
        $conn = new MockMysqliFolderTable([
            $sqlget1 => $this->mainStreamedStudents
        ]);
        
        // Execute query
        $result = $conn->query($sqlget1);
        
        // Collect results
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        
        // Assert correct number of students returned
        $this->assertCount(1, $students);
        
        // Assert student data is correct
        $this->assertEquals('234567', $students[0]['lrn']);
        $this->assertEquals('Jane', $students[0]['fname']);
        $this->assertEquals('Smith', $students[0]['lname']);
        $this->assertEquals('Main Streamed', $students[0]['enroll_status']);
    }
    
    public function testFetchGraduatedStudents()
    {
        $school = $this->session['school'];
        
        // Set up mock query results
        $sqlget1 = "SELECT * FROM new_student where school= '$school' and enroll_status = 'Graduated'";
        $conn = new MockMysqliFolderTable([
            $sqlget1 => $this->graduatedStudents
        ]);
        
        // Execute query
        $result = $conn->query($sqlget1);
        
        // Collect results
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        
        // Assert correct number of students returned
        $this->assertCount(1, $students);
        
        // Assert student data is correct
        $this->assertEquals('345678', $students[0]['lrn']);
        $this->assertEquals('Bob', $students[0]['fname']);
        $this->assertEquals('Johnson', $students[0]['lname']);
        $this->assertEquals('Graduated', $students[0]['enroll_status']);
    }
    
    public function testFetchTransferredStudents()
    {
        $school = $this->session['school'];
        
        // Set up mock query results
        $sqlget1 = "SELECT * FROM new_student where school= '$school' and enroll_status = 'Transferred'";
        $conn = new MockMysqliFolderTable([
            $sqlget1 => $this->transferredStudents
        ]);
        
        // Execute query
        $result = $conn->query($sqlget1);
        
        // Collect results
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        
        // Assert correct number of students returned
        $this->assertCount(1, $students);
        
        // Assert student data is correct
        $this->assertEquals('456789', $students[0]['lrn']);
        $this->assertEquals('Alice', $students[0]['fname']);
        $this->assertEquals('Williams', $students[0]['lname']);
        $this->assertEquals('Transferred', $students[0]['enroll_status']);
    }
    
    public function testFetchTeacherData()
    {
        $id = '1';
        
        // Set up mock query results
        $sqlget = "SELECT * FROM teachers where teacher_id=$id";
        $conn = new MockMysqliFolderTable([
            $sqlget => [$this->teacherData[0]]
        ]);
        
        // Execute query
        $result = $conn->query($sqlget);
        
        // Get teacher data
        $row = $result->fetch_assoc();
        
        // Assert teacher data is correct
        $this->assertEquals('1', $row['teacher_id']);
        $this->assertEquals('Teacher', $row['fname']);
        $this->assertEquals('One', $row['lname']);
    }
}
?>
