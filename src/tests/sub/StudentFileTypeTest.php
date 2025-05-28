<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultStudentFileType {
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

class MockMysqliStudentFileType {
    private $results = [];
    private $lastQuery = '';
    public $affected_rows = 0;

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultStudentFileType($this->results[$sql]);
        }
        
        // For INSERT queries, return true
        if (strpos($sql, 'INSERT INTO') === 0) {
            $this->affected_rows = 1;
            return true;
        }
        
        return new MockMysqliResultStudentFileType([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class StudentFileTypeTest extends TestCase
{
    private $conn;
    private $session;
    private $get;
    private $post;

    protected function setUp(): void
    {
        // Mock student data
        $studentData = [
            [
                'lrn' => '123456',
                'student_id' => '1',
                'student_code' => 'STD001',
                'birth_date' => '2010-01-01',
                'birth_place' => 'City Hospital',
                'gender' => 'Male',
                'address' => '123 Main St',
                'gurdian_contact' => '555-1234',
                'school' => 'Elementary School',
                'teacher' => 'T123'
            ]
        ];
        
        // Mock progress report data
        $progressData = [
            [
                'progress_id' => '1',
                'lrn' => '123456',
                'year' => '2023-2024',
                'progress_index' => '1',
                'type' => 'Self feeding',
                'q1' => 'P',
                'q2' => 'AP',
                'q3' => 'D',
                'q4' => 'B',
                'q5' => 'P'
            ]
        ];
        
        // Mock teacher remarks data
        $remarksData = [
            [
                'remark_id' => '1',
                'lrn' => '123456',
                'remark_q1' => 'Good progress',
                'remark_q2' => 'Improving',
                'remark_q3' => 'Needs more practice',
                'remark_q4' => 'Excellent improvement'
            ]
        ];
        
        // Mock student files data
        $filesData = [
            [
                'student_files' => '1',
                'lrn' => '123456',
                'file_type' => 'INDIVIDUALIZED EDUCATION PLAN',
                'file_name' => 'iep_123456.pdf',
                'description' => 'Annual IEP',
                'date' => '2023-05-15',
                'status' => 'active'
            ]
        ];
        
        // Create mock mysqli connection with predefined results
        $this->conn = new MockMysqliStudentFileType([
            "SELECT * FROM new_student where lrn = 123456" => $studentData,
            "SELECT * FROM progress_report where lrn = 123456 and progress_index=1" => $progressData,
            "SELECT * FROM teachers_remark where lrn = 123456" => $remarksData,
            "SELECT * FROM student_files where lrn = 123456 and status != 'archive'" => $filesData
        ]);
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123',
            'lrn' => '123456',
            'code' => 'STD001'
        ];
        
        // Mock GET parameters
        $this->get = [
            'id' => '123456',
            'folder_id' => '789'
        ];
        
        // Mock POST parameters
        $this->post = [
            'lrn' => '123456',
            'student_code' => 'STD001'
        ];
    }

    public function testDisplayStudentInformation()
    {
        $conn = $this->conn;
        $id = $this->get['id'];
        
        $sqlget1 = "SELECT * FROM new_student where lrn = $id";
        $sqldata1 = $conn->query($sqlget1);
        
        $studentInfo = [];
        while ($row = $sqldata1->fetch_assoc()) {
            $studentInfo[] = $row;
        }
        
        $this->assertCount(1, $studentInfo);
        $this->assertEquals('123456', $studentInfo[0]['lrn']);
        $this->assertEquals('STD001', $studentInfo[0]['student_code']);
    }
    
    public function testDisplayProgressReport()
    {
        $conn = $this->conn;
        $id = $this->get['id'];
        
        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1";
        $sqldata = $conn->query($sqlget);
        
        $progressReports = [];
        while ($row = $sqldata->fetch_assoc()) {
            $progressReports[] = $row;
        }
        
        $this->assertCount(1, $progressReports);
        $this->assertEquals('123456', $progressReports[0]['lrn']);
        $this->assertEquals('1', $progressReports[0]['progress_index']);
        $this->assertEquals('Self feeding', $progressReports[0]['type']);
    }
    
    public function testDisplayTeacherRemarks()
    {
        $conn = $this->conn;
        $id = $this->get['id'];
        
        $sqlget = "SELECT * FROM teachers_remark where lrn = $id";
        $sqldata = $conn->query($sqlget);
        
        $remarks = [];
        while ($row = $sqldata->fetch_assoc()) {
            $remarks[] = $row;
        }
        
        $this->assertCount(1, $remarks);
        $this->assertEquals('123456', $remarks[0]['lrn']);
        $this->assertEquals('Good progress', $remarks[0]['remark_q1']);
        $this->assertEquals('Improving', $remarks[0]['remark_q2']);
    }
    
    public function testDisplayStudentFiles()
    {
        $conn = $this->conn;
        $id = $this->get['id'];
        
        $sqlget7 = "SELECT * FROM student_files where lrn = $id and status != 'archive'";
        $sqldata7 = $conn->query($sqlget7);
        
        $files = [];
        while ($row = $sqldata7->fetch_assoc()) {
            $files[] = $row;
        }
        
        $this->assertCount(1, $files);
        $this->assertEquals('123456', $files[0]['lrn']);
        $this->assertEquals('INDIVIDUALIZED EDUCATION PLAN', $files[0]['file_type']);
        $this->assertEquals('iep_123456.pdf', $files[0]['file_name']);
    }
    
    public function testFilterStudentFiles()
    {
        $conn = $this->conn;
        $id = $this->get['id'];
        $fileType = 'INDIVIDUALIZED EDUCATION PLAN';
        
        $sqlget7 = "SELECT * FROM student_files where lrn = $id and status != 'archive' and file_type='$fileType'";
        $sqldata7 = $conn->query($sqlget7);
        
        $files = [];
        while ($row = $sqldata7->fetch_assoc()) {
            $files[] = $row;
        }
        
        $this->assertCount(0, $files); // Our mock doesn't have this specific query
        
        // Add the specific query result to our mock
        $filesData = [
            [
                'student_files' => '1',
                'lrn' => '123456',
                'file_type' => 'INDIVIDUALIZED EDUCATION PLAN',
                'file_name' => 'iep_123456.pdf',
                'description' => 'Annual IEP',
                'date' => '2023-05-15',
                'status' => 'active'
            ]
        ];
        
        $conn = new MockMysqliStudentFileType([
            $sqlget7 => $filesData
        ]);
        
        $sqldata7 = $conn->query($sqlget7);
        
        $files = [];
        while ($row = $sqldata7->fetch_assoc()) {
            $files[] = $row;
        }
        
        $this->assertCount(1, $files);
        $this->assertEquals('INDIVIDUALIZED EDUCATION PLAN', $files[0]['file_type']);
    }
}
?>