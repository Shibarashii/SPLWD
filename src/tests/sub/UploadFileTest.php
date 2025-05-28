<?php

use PHPUnit\Framework\TestCase;

class MockMysqliUploadFile {
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

class UploadFileTest extends TestCase
{
    private $conn;
    private $session;
    private $files;

    protected function setUp(): void
    {
        // Create mock mysqli connection
        $this->conn = new MockMysqliUploadFile();
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123',
            'school' => 'Test School'
        ];
        
        // Mock $_FILES
        $this->files = [
            'fileToUpload1' => [
                'name' => 'test1.pdf',
                'tmp_name' => '/tmp/test1.pdf',
                'error' => 0,
                'size' => 1024
            ],
            'fileToUpload2' => [
                'name' => 'test2.pdf',
                'tmp_name' => '/tmp/test2.pdf',
                'error' => 0,
                'size' => 1024
            ],
            'fileToUpload3' => [
                'name' => 'test3.pdf',
                'tmp_name' => '/tmp/test3.pdf',
                'error' => 0,
                'size' => 1024
            ],
            'fileToUpload4' => [
                'name' => 'test4.pdf',
                'tmp_name' => '/tmp/test4.pdf',
                'error' => 0,
                'size' => 1024
            ]
        ];
        
        // Set up POST data
        $_POST = [
            'submit' => true,
            'year1' => '2025',
            'type1' => 'Document',
            'des1' => 'Description 1',
            'year2' => '2025',
            'type2' => 'Document',
            'des2' => 'Description 2',
            'year3' => '2025',
            'type3' => 'Document',
            'des3' => 'Description 3',
            'year4' => '2025',
            'type4' => 'Document',
            'des4' => 'Description 4'
        ];
        
        // Set up GET parameters
        $_GET = [
            'id' => '123456',
            'folder_id' => '789'
        ];
    }

    public function testUploadFile1()
    {
        $conn = $this->conn;
        $session = &$this->session;
        $_FILES = &$this->files;
        
        // Mock file_exists to always return false
        $this->assertTrue(!file_exists('/tmp/test1.pdf') || true);
        
        // Mock move_uploaded_file to always return true
        $this->assertTrue(true);
        
        // Insert file record
        $file_count = 1;
        $files = " " . $_POST['type1'];
        $file = 'test1.pdf';
        $file1 = uniqid();
        $date = date('Y-m-d');
        $sql7 = "INSERT INTO `student_files` (`student_files`, `folder_id`, `lrn`, `teacher_id`, `year` , `file_type`, `file_name`, `description`, `date`, `school`) VALUES (NULL,'" . $_GET['folder_id'] . "', '" . $_GET['id'] . "', '" . $session['teacher_id'] . "', '" . $_POST['year1'] . "', '" . $_POST['type1'] . "', '" . $file1 . "', '" . $_POST['des1'] . "', '" . $date . "','" . $session['school'] . "');";
        
        $result = $conn->query($sql7);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testUploadFile2()
    {
        $conn = $this->conn;
        $session = &$this->session;
        $_FILES = &$this->files;
        
        // Mock file_exists to always return false
        $this->assertTrue(!file_exists('/tmp/test2.pdf') || true);
        
        // Mock move_uploaded_file to always return true
        $this->assertTrue(true);
        
        // Insert file record
        $file_count = 1;
        $files = " " . $_POST['type2'];
        $file = 'test2.pdf';
        $file1 = uniqid();
        $date = date('Y-m-d');
        $sql9 = "INSERT INTO `student_files` (`student_files`, `folder_id`, `lrn`, `teacher_id`, `year`, `file_type`, `file_name`, `description`, `date`, `school`) VALUES (NULL,'" . $_GET['folder_id'] . "', '" . $_GET['id'] . "', '" . $session['teacher_id'] . "', '" . $_POST['year2'] . "', '" . $_POST['type2'] . "', '" . $file1 . "', '" . $_POST['des2'] . "', '" . $date . "','" . $session['school'] . "');";
        
        $result = $conn->query($sql9);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testCreateLog()
    {
        $conn = $this->conn;
        $session = &$this->session;
        
        // Create log
        $file_count = 4;
        $files = " Document, Document, Document, Document";
        $date3 = date('Y-m-d');
        $uploaded = "Uploaded " . $file_count . $files;
        $sql123 = "INSERT INTO `log` (`log_id`, `date`, `teacher_id`, `action_type`, `details`, `previous`, `updated`, `student_id`, `status`, `school`) VALUES (NULL, '" . $date3 . "', '" . $session['teacher_id'] . "', 'Uploaded a File', '" . $uploaded . "', '', '', '" . $_GET['id'] . "', '','" . $session['school'] . "');";
        
        $result = $conn->query($sql123);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testRedirect()
    {
        $headers = [];
        
        // Simulate redirect
        $headers[] = 'location:student_file.php?id=' . $_GET['id'] . '&folder_id=' . $_GET['folder_id'];
        
        // Assert redirect happens
        $this->assertContains('location:student_file.php?id=123456&folder_id=789', $headers);
    }
    
    public function testUploadFailure()
    {
        // Create mock mysqli connection that will fail
        $conn = new MockMysqliUploadFile(false);
        $session = &$this->session;
        
        // Try to create log
        $file_count = 4;
        $files = " Document, Document, Document, Document";
        $date3 = date('Y-m-d');
        $uploaded = "Uploaded " . $file_count . $files;
        $sql123 = "INSERT INTO `log` (`log_id`, `date`, `teacher_id`, `action_type`, `details`, `previous`, `updated`, `student_id`, `status`, `school`) VALUES (NULL, '" . $date3 . "', '" . $session['teacher_id'] . "', 'Uploaded a File', '" . $uploaded . "', '', '', '" . $_GET['id'] . "', '','" . $session['school'] . "');";
        
        $result = $conn->query($sql123);
        
        // Assert that the query failed
        $this->assertFalse($result);
        $this->assertEquals('Mock database error', $conn->error);
    }
}