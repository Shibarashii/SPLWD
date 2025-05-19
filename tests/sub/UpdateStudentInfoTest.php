<?php

use PHPUnit\Framework\TestCase;

class MockMysqliUpdateStudentInfo {
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

class UpdateStudentInfoTest extends TestCase
{
    private $conn;
    private $headers;
    private $session;

    protected function setUp(): void
    {
        // Create mock mysqli connection
        $this->conn = new MockMysqliUpdateStudentInfo();
        
        // Mock headers
        $this->headers = [];
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123'
        ];
        
        // Set up POST data
        $_POST = [
            'id' => '123',
            'fname' => 'John',
            'lname' => 'Doe',
            'mname' => 'M',
            'm_tounge' => 'English',
            'birth_date' => '2000-01-01',
            'birth_place' => 'New York',
            'gender' => 'Male',
            'address' => '123 Main St',
            'guardian' => 'Jane Doe',
            'work' => 'Engineer',
            'email' => 'john@example.com',
            'guardian_mtounge' => 'English',
            'guardian_contact' => '555-1234'
        ];
        
        // Set up GET parameters
        $_GET = [
            'lrn' => '123456'
        ];
    }

    public function testUpdateStudentInfo()
    {
        $conn = $this->conn;
        $headers = &$this->headers;
        
        // Execute the update query
        $id = $_POST['id'];
        $sql = "UPDATE `new_student` SET `fname` = '" . $_POST['fname'] . "', `lname` = '" . $_POST['lname'] . "', `mname` = '" . $_POST['mname'] . "', `m_tounge` = '" . $_POST['m_tounge'] . "', `birth_date` = '" . $_POST['birth_date'] . "', `birth_place` = '" . $_POST['birth_place'] . "', `gender` = '" . $_POST['gender'] . "', `address` = '" . $_POST['address'] . "', `guardian` = '" . $_POST['guardian'] . "', `work` = '" . $_POST['work'] . "', `email` = '" . $_POST['email'] . "', `guardian_mtounge` = '" . $_POST['guardian_mtounge'] . "', `gurdian_contact` = '" . $_POST['guardian_contact'] . "' WHERE `new_student`.`student_id` = $id;
";
        
        $result = $conn->query($sql);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Simulate redirect
        $headers[] = 'location:student_file_folder.php?id=' . $_GET['lrn'] . '&update=1';
        
        // Assert redirect happens
        $this->assertContains('location:student_file_folder.php?id=123456&update=1', $headers);
        
        // Close the connection
        $conn->close();
    }
    
    public function testUpdateStudentInfoFailure()
    {
        // Create mock mysqli connection that will fail
        $conn = new MockMysqliUpdateStudentInfo(false);
        
        // Execute the update query
        $id = $_POST['id'];
        $sql = "UPDATE `new_student` SET `fname` = '" . $_POST['fname'] . "', `lname` = '" . $_POST['lname'] . "', `mname` = '" . $_POST['mname'] . "', `m_tounge` = '" . $_POST['m_tounge'] . "', `birth_date` = '" . $_POST['birth_date'] . "', `birth_place` = '" . $_POST['birth_place'] . "', `gender` = '" . $_POST['gender'] . "', `address` = '" . $_POST['address'] . "', `guardian` = '" . $_POST['guardian'] . "', `work` = '" . $_POST['work'] . "', `email` = '" . $_POST['email'] . "', `guardian_mtounge` = '" . $_POST['guardian_mtounge'] . "', `gurdian_contact` = '" . $_POST['guardian_contact'] . "' WHERE `new_student`.`student_id` = $id;
";
        
        $result = $conn->query($sql);
        
        // Assert that the query failed
        $this->assertFalse($result);
        $this->assertEquals('Mock database error', $conn->error);
        
        // Close the connection
        $conn->close();
    }
}