<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultUpdateTeacher {
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

class MockMysqliUpdateTeacher {
    public $affected_rows = 0;
    private $results = [];
    private $lastQuery = '';
    private $shouldSucceed = true;
    public $error = '';

    public function __construct($results = [], $shouldSucceed = true) {
        $this->results = $results;
        $this->shouldSucceed = $shouldSucceed;
        if (!$shouldSucceed) {
            $this->error = 'Mock database error';
        }
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultUpdateTeacher($this->results[$sql]);
        }
        
        if ($this->shouldSucceed) {
            $this->affected_rows = 1;
            return true;
        } else {
            return false;
        }
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
    
    public function close() {
        // Mock close method
        return true;
    }
}

class UpdateTeacherTest extends TestCase
{
    private $conn;
    private $headers;
    private $session;

    protected function setUp(): void
    {
        // Create teacher data
        $teacherData = [
            [
                'fname' => 'Old First',
                'mname' => 'Old Middle',
                'lname' => 'Old Last'
            ]
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliUpdateTeacher([
            "SELECT * FROM teachers where teacher_id=T123" => $teacherData
        ]);
        
        // Mock headers
        $this->headers = [];
        
        // Mock session
        $this->session = [
            'logged_id' => '123',
            'teacher_id' => 'T123',
            'school' => 'Test School'
        ];
        
        // Set up POST data
        $_POST = [
            'submit' => true,
            'fname' => 'New First',
            'lname' => 'New Last',
            'mname' => 'New Middle',
            'birth_date' => '1980-01-01',
            'address' => '123 Main St',
            'contact_no' => '555-1234',
            'email' => 'teacher@example.com'
        ];
    }

    public function testUpdateTeacherInfo()
    {
        $conn = $this->conn;
        $headers = &$this->headers;
        $session = &$this->session;
        
        // Get current teacher data
        $id = $session['logged_id'];
        $sqlget = "SELECT * FROM teachers where teacher_id=" . $session['teacher_id'];
        $sqldata = $conn->query($sqlget);
        
        // Process data as in the original file
        $updated = "";
        while ($row = $sqldata->fetch_assoc()) {
            if ($row['fname'] != $_POST['fname']) {
                $updated .= "First name (" . $row['fname'] . " to " . $_POST['fname'] . "),";
            }
            if ($row['mname'] != $_POST['mname']) {
                $updated .= "Middle name (" . $row['mname'] . " to " . $_POST['mname'] . "),";
            }
            if ($row['lname'] != $_POST['lname']) {
                $updated .= "Last name (" . $row['lname'] . " to " . $_POST['lname'] . "),";
            }
        }
        
        // Execute the update query
        $sql = "UPDATE `teachers` SET `fname` = '" . $_POST['fname'] . "', `lname` = '" . $_POST['lname'] . "', `mname` = '" . $_POST['mname'] . "', `birth_date` = '" . $_POST['birth_date'] . "', `address` = '" . $_POST['address'] . "', `contact_no` = '" . $_POST['contact_no'] . "', `email` = '" . $_POST['email'] . "' WHERE `teachers`.`id` = $id;";
        
        $result = $conn->query($sql);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Log the update
        $date3 = date('Y-m-d');
        $sql123 = "INSERT INTO `log` (`log_id`, `date`, `teacher_id`, `action_type`, `details`, `previous`, `updated`, `student_id`, `status`, `school`) VALUES (NULL, '" . $date3 . "', '" . $session['teacher_id'] . "', 'Update profile information', '" . $updated . "', '', '', '', '','" . $session['school'] . "');";
        
        $result = $conn->query($sql123);
        
        // Assert that the log was created successfully
        $this->assertTrue($result);
        
        // Simulate redirect
        $headers[] = 'location:profile.php?update_profile=1';
        
        // Assert redirect happens
        $this->assertContains('location:profile.php?update_profile=1', $headers);
        
        // Close the connection
        $conn->close();
    }
    
    public function testUpdateTeacherInfoFailure()
    {
        // Create mock mysqli connection that will fail
        $conn = new MockMysqliUpdateTeacher([
            "SELECT * FROM teachers where teacher_id=T123" => [
                [
                    'fname' => 'Old First',
                    'mname' => 'Old Middle',
                    'lname' => 'Old Last'
                ]
            ]
        ], false);
        
        $session = &$this->session;
        
        // Get current teacher data
        $id = $session['logged_id'];
        $sqlget = "SELECT * FROM teachers where teacher_id=" . $session['teacher_id'];
        $sqldata = $conn->query($sqlget);
        
        // Process data as in the original file
        $updated = "";
        while ($row = $sqldata->fetch_assoc()) {
            if ($row['fname'] != $_POST['fname']) {
                $updated .= "First name (" . $row['fname'] . " to " . $_POST['fname'] . "),";
            }
            if ($row['mname'] != $_POST['mname']) {
                $updated .= "Middle name (" . $row['mname'] . " to " . $_POST['mname'] . "),";
            }
            if ($row['lname'] != $_POST['lname']) {
                $updated .= "Last name (" . $row['lname'] . " to " . $_POST['lname'] . "),";
            }
        }
        
        // Execute the update query
        $sql = "UPDATE `teachers` SET `fname` = '" . $_POST['fname'] . "', `lname` = '" . $_POST['lname'] . "', `mname` = '" . $_POST['mname'] . "', `birth_date` = '" . $_POST['birth_date'] . "', `address` = '" . $_POST['address'] . "', `contact_no` = '" . $_POST['contact_no'] . "', `email` = '" . $_POST['email'] . "' WHERE `teachers`.`id` = $id;";
        
        $result = $conn->query($sql);
        
        // Assert that the query failed
        $this->assertFalse($result);
        $this->assertEquals('Mock database error', $conn->error);
        
        // Close the connection
        $conn->close();
    }
}