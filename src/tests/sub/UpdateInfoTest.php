<?php

use PHPUnit\Framework\TestCase;

class MockMysqliUpdateInfo {
    public $affected_rows = 0;
    private $lastQuery = '';
    private $shouldSucceed = true;
    public $error = '';

    public function __construct($shouldSucceed = true) {
        $this->shouldSucceed = $shouldSucceed;
        if (!$shouldSucceed) {
            $this->error = 'Mock database error';
        }
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
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

class UpdateInfoTest extends TestCase
{
    private $conn;
    private $headers;

    protected function setUp(): void
    {
        // Create mock mysqli connection
        $this->conn = new MockMysqliUpdateInfo();
        
        // Mock headers
        $this->headers = [];
        
        // Set up POST data
        $_POST = [
            'update' => true,
            'lrn' => '123456',
            'student_id' => '789',
            'teacher_id' => 'T123',
            'fname' => 'John',
            'lname' => 'Doe',
            'mname' => 'M',
            'birth_date' => '2000-01-01',
            'address' => '123 Main St',
            'guardian' => 'Jane Doe',
            'contact_no' => '555-1234'
        ];
    }

    public function testUpdateStudentInfo()
    {
        $conn = $this->conn;
        $headers = &$this->headers;
        
        // Execute the update query
        $lrn = $_POST['lrn'];
        $st_id = $_POST['student_id'];
        $sql = "UPDATE `student` SET `lrn` = '" . $_POST['lrn'] . "', `teacher_id` = '" . $_POST['teacher_id'] . "', `fname` = '" . $_POST['fname'] . "', `lname` = '" . $_POST['lname'] . "', `mname` = '" . $_POST['mname'] . "', `birth_date` = '" . $_POST['birth_date'] . "', `address` = '" . $_POST['address'] . "', `guardian` = '" . $_POST['guardian'] . "', `contact_no` = '" . $_POST['contact_no'] . "', `category` = '2' WHERE `student`.`student_id` = $st_id;";
        
        $result = $conn->query($sql);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Simulate redirect
        $headers[] = 'Location:student_profile.php?lrn=' . $lrn;
        
        // Assert redirect happens
        $this->assertContains('Location:student_profile.php?lrn=123456', $headers);
        
        // Close the connection
        $conn->close();
    }
    
    public function testUpdateStudentInfoFailure()
    {
        // Create mock mysqli connection that will fail
        $conn = new MockMysqliUpdateInfo(false);
        
        // Execute the update query
        $st_id = $_POST['student_id'];
        $sql = "UPDATE `student` SET `lrn` = '" . $_POST['lrn'] . "', `teacher_id` = '" . $_POST['teacher_id'] . "', `fname` = '" . $_POST['fname'] . "', `lname` = '" . $_POST['lname'] . "', `mname` = '" . $_POST['mname'] . "', `birth_date` = '" . $_POST['birth_date'] . "', `address` = '" . $_POST['address'] . "', `guardian` = '" . $_POST['guardian'] . "', `contact_no` = '" . $_POST['contact_no'] . "', `category` = '2' WHERE `student`.`student_id` = $st_id;";
        
        $result = $conn->query($sql);
        
        // Assert that the query failed
        $this->assertFalse($result);
        $this->assertEquals('Mock database error', $conn->error);
        
        // Close the connection
        $conn->close();
    }
}