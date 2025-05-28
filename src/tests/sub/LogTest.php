<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultLog {
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

class MockMysqliLog {
    private $results = [];
    private $lastQuery = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultLog($this->results[$sql]);
        }
        
        return new MockMysqliResultLog([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class LogTest extends TestCase
{
    private $conn;
    private $session;
    private $logData;
    private $teacherData;
    private $studentData;

    protected function setUp(): void
    {
        // Mock log data
        $this->logData = [
            [
                'log_id' => '1',
                'date' => '2025-05-19',
                'teacher_id' => '1',
                'action_type' => 'Add new Student',
                'details' => 'Added student John Doe',
                'previous' => 'N/A',
                'updated' => 'N/A',
                'student_id' => '123456',
                'status' => 'archive',
                'school' => 'BES'
            ],
            [
                'log_id' => '2',
                'date' => '2025-05-18',
                'teacher_id' => '1',
                'action_type' => 'Update Student',
                'details' => 'Updated student Jane Smith',
                'previous' => 'Old Data',
                'updated' => 'New Data',
                'student_id' => '234567',
                'status' => '',
                'school' => 'BES'
            ]
        ];
        
        // Mock teacher data
        $this->teacherData = [
            [
                'teacher_id' => '1',
                'fname' => 'Teacher',
                'lname' => 'One',
                'img' => 'teacher1.jpg'
            ],
            [
                'teacher_id' => '2',
                'fname' => 'Teacher',
                'lname' => 'Two',
                'img' => 'teacher2.jpg'
            ]
        ];
        
        // Mock student data
        $this->studentData = [
            [
                'lrn' => '123456',
                'fname' => 'John',
                'lname' => 'Doe'
            ],
            [
                'lrn' => '234567',
                'fname' => 'Jane',
                'lname' => 'Smith'
            ]
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliLog();
        
        // Mock session
        $this->session = [
            'teacher_id' => '1'
        ];
    }

    public function testFetchLogEntries()
    {
        $teacher_id = $this->session['teacher_id'];
        
        // Set up mock query results
        $sqlget1 = "SELECT * FROM log WHERE teacher_id = $teacher_id ORDER BY log_id DESC";
        $conn = new MockMysqliLog([
            $sqlget1 => $this->logData
        ]);
        
        // Execute query
        $result = $conn->query($sqlget1);
        
        // Collect results
        $logs = [];
        while ($row = $result->fetch_assoc()) {
            $logs[] = $row;
        }
        
        // Assert correct number of logs returned
        $this->assertCount(2, $logs);
        
        // Assert log data is correct
        $this->assertEquals('1', $logs[0]['log_id']);
        $this->assertEquals('2025-05-19', $logs[0]['date']);
        $this->assertEquals('Add new Student', $logs[0]['action_type']);
        $this->assertEquals('Added student John Doe', $logs[0]['details']);
        
        $this->assertEquals('2', $logs[1]['log_id']);
        $this->assertEquals('2025-05-18', $logs[1]['date']);
        $this->assertEquals('Update Student', $logs[1]['action_type']);
        $this->assertEquals('Updated student Jane Smith', $logs[1]['details']);
    }
    
    public function testFetchTeacherNames()
    {
        // Set up mock query results for teacher data
        $teacher_id = '1';
        $sqlget = "SELECT * FROM teachers WHERE teacher_id = $teacher_id";
        $conn = new MockMysqliLog([
            $sqlget => [$this->teacherData[0]]
        ]);
        
        // Execute query
        $result = $conn->query($sqlget);
        
        // Get teacher data
        $row = $result->fetch_assoc();
        $teacherName = $row ? [
            'name' => $row['fname'] . " " . $row['lname'],
            'img' => $row['img']
        ] : ['name' => 'Unknown', 'img' => 'th.jfif'];
        
        // Assert teacher name is correct
        $this->assertEquals('Teacher One', $teacherName['name']);
        $this->assertEquals('teacher1.jpg', $teacherName['img']);
    }
    
    public function testFetchStudentNames()
    {
        // Set up mock query results for student data
        $student_id = '123456';
        $sqlget = "SELECT * FROM new_student WHERE lrn = $student_id";
        $conn = new MockMysqliLog([
            $sqlget => [$this->studentData[0]]
        ]);
        
        // Execute query
        $result = $conn->query($sqlget);
        
        // Get student data
        $row = $result->fetch_assoc();
        $studentName = $row ? $row['fname'] . " " . $row['lname'] : 'Unknown';
        
        // Assert student name is correct
        $this->assertEquals('John Doe', $studentName);
    }
}
?>
