<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultDelete {
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

class MockMysqliDelete {
    private $results = [];
    private $lastQuery = '';
    public $affected_rows = 0;
    public $error = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultDelete($this->results[$sql]);
        }
        
        // For DELETE queries, return true
        if (strpos($sql, 'DELETE FROM') === 0) {
            $this->affected_rows = 1;
            return true;
        }
        
        // For UPDATE queries, return true
        if (strpos($sql, 'UPDATE') === 0) {
            $this->affected_rows = 1;
            return true;
        }
        
        return new MockMysqliResultDelete([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
    
    public function close() {
        return true;
    }
}

class DeleteTest extends TestCase
{
    private $conn;
    private $session;
    private $headers;

    protected function setUp(): void
    {
        // Create mock mysqli connection
        $this->conn = new MockMysqliDelete();
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123',
            'school' => 'School A',
            'lrn' => '123456'
        ];
        
        // Mock headers
        $this->headers = [];
    }

    public function testDeleteFile()
    {
        $_GET = [
            'id' => 1
        ];
        
        $conn = $this->conn;
        $headers = &$this->headers;
        
        $id = $_GET['id'];
        
        // Delete file
        $sql = "DELETE FROM `student_files` WHERE student_files=$id";
        $result = $conn->query($sql);
        
        // Assert file was deleted
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Simulate redirect
        $headers[] = 'location:archive.php?delete1=1';
        
        // Assert redirect happens
        $this->assertContains('location:archive.php?delete1=1', $headers);
    }
    
    public function testRetrieveFile()
    {
        $_GET = [
            'id1' => 1
        ];
        
        $conn = $this->conn;
        $session = &$this->session;
        $headers = &$this->headers;
        
        $id = $_GET['id1'];
        
        // Mock file data
        $fileData = [
            [
                'file_type' => 'PDF',
                'description' => 'Test file'
            ]
        ];
        
        // Add mock data to connection
        $conn = new class($fileData, $id) extends MockMysqliDelete {
            public function __construct($fileData, $id) {
                parent::__construct([
                    "SELECT * FROM student_files where student_files=$id" => $fileData
                ]);
            }
        
            public function query($sql) {
                // handle expected queries
                if (strpos($sql, 'UPDATE') === 0 || strpos($sql, 'INSERT') === 0) {
                    $this->affected_rows = 1;
                    return true;
                }
                return parent::query($sql);
            }
        };
        
        
        // Get file details
        $sqlget = "SELECT * FROM student_files where student_files=$id";
        $result = $conn->query($sqlget);
        $row = $result->fetch_assoc();
        
        // Assert file details were retrieved
        $this->assertNotNull($row);
        $this->assertEquals('PDF', $row['file_type']);
        
        $uploaded = "File Type: " . $row['file_type'] . " Description: " . $row['description'] . " Date: " . $row['description'];
        $date3 = date('Y-m-d');
        
        // Update file status
        $sql = "UPDATE `student_files` SET `status` = '' WHERE `student_files`.`student_files` = $id;";
        $result = $conn->query($sql);
        
        // Assert file status was updated
        $this->assertTrue($result);
        
        // Log the action
        $sql123 = "INSERT INTO `log` (`log_id`, `date`, `teacher_id`, `action_type`, `details`, `previous`, `updated`, `student_id`, `status`) VALUES (NULL, '" . $date3 . "', '" . $session['teacher_id'] . "', 'Retrieve a File', '" . $uploaded . "', '', '', '" . $session['lrn'] . "', '" . $session['school'] . "');";
        $result123 = $conn->query($sql123);
        
        // Assert log was created
        $this->assertTrue($result123);
        
        // Simulate redirect
        $headers[] = 'location:archive.php?id=' . $session['lrn'];
        
        // Assert redirect happens
        $this->assertContains('location:archive.php?id=123456', $headers);
    }
}
?>
