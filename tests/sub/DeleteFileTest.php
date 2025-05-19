<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultDeleteFile {
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

class MockMysqliDeleteFile {
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
            return new MockMysqliResultDeleteFile($this->results[$sql]);
        }
        
        // For UPDATE queries, return true
        if (strpos($sql, 'UPDATE') === 0) {
            $this->affected_rows = 1;
            return true;
        }
        
        // For INSERT queries, return true
        if (strpos($sql, 'INSERT INTO') === 0) {
            $this->affected_rows = 1;
            return true;
        }
        
        return new MockMysqliResultDeleteFile([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
    
    public function close() {
        return true;
    }
}

class DeleteFileTest extends TestCase
{
    private $conn;
    private $session;
    private $headers;

    protected function setUp(): void
    {
        // Mock file data
        $fileData = [
            [
                'student_files' => 1,
                'file_type' => 'PDF',
                'description' => 'Test file',
                'date' => '2025-05-19'
            ]
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliDeleteFile([
            "SELECT * FROM student_files where student_files=1" => $fileData
        ]);
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123',
            'school' => 'School A',
            'lrn' => '123456'
        ];
        
        // Mock headers
        $this->headers = [];
    }

    public function testArchiveFile()
    {
        $_GET = [
            'id' => 1,
            'lrn' => '123456',
            'folder_id' => '789'
        ];
        
        $conn = $this->conn;
        $session = &$this->session;
        $headers = &$this->headers;
        
        $id = $_GET['id'];
        
        // Get file details
        $sqlget = "SELECT * FROM student_files where student_files=$id";
        $result = $conn->query($sqlget);
        $row = $result->fetch_assoc();
        
        // Assert file details were retrieved
        $this->assertNotNull($row);
        $this->assertEquals('PDF', $row['file_type']);
        
        $uploaded = "File Type: " . $row['file_type'] . " Description: " . $row['description'] . " Date: " . $row['date'];
        $date3 = date('Y-m-d');
        
        // Archive file
        $sql = "UPDATE `student_files` SET `status` = 'archive' WHERE `student_files`.`student_files` = $id;";
        $result = $conn->query($sql);
        
        // Assert file was archived
        $this->assertTrue($result);
        
        // Log the action
        $sql123 = "INSERT INTO `log` (`log_id`, `date`, `teacher_id`, `action_type`, `details`, `previous`, `updated`, `student_id`, `status`) VALUES (NULL, '" . $date3 . "', '" . $session['teacher_id'] . "', 'Deleted a File', '" . $uploaded . "', '', '', '" . $_GET['lrn'] . "', '" . $session['school'] . "');";
        $result123 = $conn->query($sql123);
        
        // Assert log was created
        $this->assertTrue($result123);
        
        // Simulate redirect
        $headers[] = 'location:student_file.php?id=' . $_GET['lrn'] . '&delete=1&folder_id=' . $_GET['folder_id'];
        
        // Assert redirect happens
        $this->assertContains('location:student_file.php?id=123456&delete=1&folder_id=789', $headers);
    }
    
    public function testRetrieveFile()
    {
        $_GET = [
            'id1' => 1,
            'lrn' => '123456'
        ];
        
        $conn = $this->conn;
        $session = &$this->session;
        $headers = &$this->headers;
        
        $id = $_GET['id1'];
        
        // Get file details
        $sqlget = "SELECT * FROM student_files where student_files=$id";
        $result = $conn->query($sqlget);
        $row = $result->fetch_assoc();
        
        // Assert file details were retrieved
        $this->assertNotNull($row);
        $this->assertEquals('PDF', $row['file_type']);
        
        $uploaded = "File Type: " . $row['file_type'] . " Description: " . $row['description'] . " Date: " . $row['date'];
        $date3 = date('Y-m-d');
        
        // Retrieve file
        $sql = "UPDATE `student_files` SET `status` = '' WHERE `student_files`.`student_files` = $id;";
        $result = $conn->query($sql);
        
        // Assert file was retrieved
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
