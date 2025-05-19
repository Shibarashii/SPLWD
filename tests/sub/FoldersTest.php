<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultFolders {
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

class MockMysqliFolders {
    private $results = [];
    private $lastQuery = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultFolders($this->results[$sql]);
        }
        
        return new MockMysqliResultFolders([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class FoldersTest extends TestCase
{
    private $conn;
    private $session;
    private $studentCategories;

    protected function setUp(): void
    {
        // Mock student categories
        $this->studentCategories = [
            'Enrolled' => [
                [
                    'lrn' => '123456',
                    'fname' => 'John',
                    'lname' => 'Doe',
                    'birth_date' => '2010-01-01',
                    'teacher_id' => '1',
                    'school' => 'BES',
                    'enroll_status' => 'Enrolled'
                ]
            ],
            'Main Streamed' => [
                [
                    'lrn' => '234567',
                    'fname' => 'Jane',
                    'lname' => 'Smith',
                    'birth_date' => '2011-02-02',
                    'teacher_id' => '1',
                    'school' => 'BES',
                    'enroll_status' => 'Main Streamed'
                ]
            ],
            'Graduated' => [
                [
                    'lrn' => '345678',
                    'fname' => 'Bob',
                    'lname' => 'Johnson',
                    'birth_date' => '2009-03-03',
                    'teacher_id' => '1',
                    'school' => 'BES',
                    'enroll_status' => 'Graduated'
                ]
            ],
            'Transferred' => [
                [
                    'lrn' => '456789',
                    'fname' => 'Alice',
                    'lname' => 'Williams',
                    'birth_date' => '2008-04-04',
                    'teacher_id' => '1',
                    'school' => 'BES',
                    'enroll_status' => 'Transferred'
                ]
            ]
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliFolders();
        
        // Mock session
        $this->session = [
            'school' => 'BES',
            'teacher_id' => '1'
        ];
    }

    public function testFetchStudentsByCategory()
    {
        $school = $this->session['school'];
        $teacher = $this->session['teacher_id'];
        
        // Test each category
        foreach ($this->studentCategories as $status => $expectedStudents) {
            // Set up mock query results
            $sqlget1 = "SELECT * FROM new_student WHERE school = '$school' AND enroll_status = '$status' AND teacher_id = $teacher";
            $conn = new MockMysqliFolders([
                $sqlget1 => $expectedStudents
            ]);
            
            // Execute query
            $result = $conn->query($sqlget1);
            
            // Collect results
            $students = [];
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
            
            // Assert correct number of students returned
            $this->assertCount(count($expectedStudents), $students);
            
            // Assert student data is correct
            foreach ($students as $index => $student) {
                $this->assertEquals($expectedStudents[$index]['lrn'], $student['lrn']);
                $this->assertEquals($expectedStudents[$index]['fname'], $student['fname']);
                $this->assertEquals($expectedStudents[$index]['lname'], $student['lname']);
                $this->assertEquals($expectedStudents[$index]['enroll_status'], $student['enroll_status']);
            }
        }
    }
    
    public function testGetFirstLetterAndLastName()
    {
        // Get student data
        $student = $this->studentCategories['Enrolled'][0];
        
        // Get first letter of first name and last name
        $name = $student['fname'];
        $firstLetter = $name[0];
        $lastName = $student['lname'];
        $displayName = $firstLetter . ". " . $lastName;
        
        // Assert display name is correct
        $this->assertEquals('J. Doe', $displayName);
    }
    
    public function testGenerateStudentFolderLink()
    {
        // Get student data
        $student = $this->studentCategories['Enrolled'][0];
        
        // Generate student folder link
        $lrn = $student['lrn'];
        $link = "student_file_folder.php?id=$lrn";
        
        // Assert link is correct
        $this->assertEquals('student_file_folder.php?id=123456', $link);
    }
}
?>
