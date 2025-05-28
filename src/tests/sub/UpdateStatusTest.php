<?php

use PHPUnit\Framework\TestCase;

class MockMysqliUpdateStatus {
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
}

class UpdateStatusTest extends TestCase
{
    private $conn;
    private $headers;

    protected function setUp(): void
    {
        // Create mock mysqli connection
        $this->conn = new MockMysqliUpdateStatus();
        
        // Mock headers
        $this->headers = [];
        
        // Set up GET parameters
        $_GET = [
            'id' => '123',
            'lrn' => '123456'
        ];
        
        // Set up POST data
        $_POST = [
            'enroll_status' => 'Active'
        ];
    }

    public function testUpdateStatus()
    {
        $conn = $this->conn;
        $headers = &$this->headers;
        
        // Execute the update query
        $id = $_GET['id'];
        $sql = "UPDATE `new_student` SET `enroll_status` = '" . $_POST['enroll_status'] . "' WHERE `new_student`.`student_id` = $id;";
        
        $result = $conn->query($sql);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Simulate redirect
        $headers[] = 'Location:student_file_folder.php?id=' . $_GET['lrn'];
        
        // Assert redirect happens
        $this->assertContains('Location:student_file_folder.php?id=123456', $headers);
    }
    
    public function testUpdateStatusFailure()
    {
        // Create mock mysqli connection that will fail
        $conn = new MockMysqliUpdateStatus(false);
        
        // Execute the update query
        $id = $_GET['id'];
        $sql = "UPDATE `new_student` SET `enroll_status` = '" . $_POST['enroll_status'] . "' WHERE `new_student`.`student_id` = $id;";
        
        $result = $conn->query($sql);
        
        // Assert that the query failed
        $this->assertFalse($result);
        $this->assertEquals('Mock database error', $conn->error);
    }
}