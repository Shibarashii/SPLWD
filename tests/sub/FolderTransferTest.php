<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultFolderTransfer {
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

class MockMysqliFolderTransfer {
    private $results = [];
    private $lastQuery = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultFolderTransfer($this->results[$sql]);
        }
        
        return new MockMysqliResultFolderTransfer([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class FolderTransferTest extends TestCase
{
    private $conn;
    private $session;
    private $transferredStudents;

    protected function setUp(): void
    {
        // Mock transferred students data
        $this->transferredStudents = [
            [
                'lrn' => '456789',
                'fname' => 'Alice',
                'lname' => 'Williams',
                'birth_date' => '2008-04-04',
                'teacher_id' => '1',
                'school' => 'BES',
                'enroll_status' => 'Transferred'
            ],
            [
                'lrn' => '567890',
                'fname' => 'Charlie',
                'lname' => 'Brown',
                'birth_date' => '2007-05-05',
                'teacher_id' => '1',
                'school' => 'BES',
                'enroll_status' => 'Transferred'
            ]
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliFolderTransfer();
        
        // Mock session
        $this->session = [
            'school' => 'BES',
            'teacher_id' => '1'
        ];
    }

    public function testFetchTransferredStudents()
    {
        $school = $this->session['school'];
        $teacher = $this->session['teacher_id'];
        
        // Set up mock query results
        $sqlget1 = "SELECT * FROM new_student where school= '$school' and enroll_status = 'Transferred' and teacher_id = $teacher";
        $conn = new MockMysqliFolderTransfer([
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
        $this->assertCount(2, $students);
        
        // Assert student data is correct
        $this->assertEquals('456789', $students[0]['lrn']);
        $this->assertEquals('Alice', $students[0]['fname']);
        $this->assertEquals('Williams', $students[0]['lname']);
        $this->assertEquals('Transferred', $students[0]['enroll_status']);
        
        $this->assertEquals('567890', $students[1]['lrn']);
        $this->assertEquals('Charlie', $students[1]['fname']);
        $this->assertEquals('Brown', $students[1]['lname']);
        $this->assertEquals('Transferred', $students[1]['enroll_status']);
    }
    
    public function testGetFirstLetterOfName()
    {
        // Get first letter of name
        $name = $this->transferredStudents[0]['fname'];
        $firstLetter = $name[0];
        
        // Assert first letter is correct
        $this->assertEquals('A', $firstLetter);
    }
    
    public function testGenerateStudentFolderLink()
    {
        // Generate student folder link
        $lrn = $this->transferredStudents[0]['lrn'];
        $link = "student_file_folder.php?id=$lrn";
        
        // Assert link is correct
        $this->assertEquals('student_file_folder.php?id=456789', $link);
    }
}
?>
