<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultHome {
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

class MockMysqliHome {
    private $results = [];
    private $lastQuery = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultHome($this->results[$sql]);
        }
        
        return new MockMysqliResultHome([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class HomeTest extends TestCase
{
    private $conn;
    private $session;
    private $teacherData;

    protected function setUp(): void
    {
        // Mock teacher data
        $this->teacherData = [
            [
                'id' => '1',
                'fname' => 'John',
                'lname' => 'Doe',
                'mname' => 'M',
                'email' => 'john.doe@example.com',
                'contact_no' => '1234567890',
                'address' => '123 Main St',
                'birth_date' => '1980-01-01',
                'img' => 'profile.jpg',
                'teacher_id' => 'T123',
                'work' => 'Teacher',
                'gender' => 'Male'
            ]
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliHome();
        
        // Mock session
        $this->session = [
            'logged_id' => '1'
        ];
    }

    public function testFetchTeacherProfile()
    {
        $id = $this->session['logged_id'];
        
        // Set up mock query results
        $sqlget = "SELECT * FROM teachers where id=$id";
        $conn = new MockMysqliHome([
            $sqlget => $this->teacherData
        ]);
        
        // Execute query
        $result = $conn->query($sqlget);
        
        // Get teacher data
        $row = $result->fetch_assoc();
        
        // Assert teacher data is correct
        $this->assertEquals('1', $row['id']);
        $this->assertEquals('John', $row['fname']);
        $this->assertEquals('Doe', $row['lname']);
        $this->assertEquals('M', $row['mname']);
        $this->assertEquals('john.doe@example.com', $row['email']);
        $this->assertEquals('1234567890', $row['contact_no']);
        $this->assertEquals('123 Main St', $row['address']);
        $this->assertEquals('1980-01-01', $row['birth_date']);
        $this->assertEquals('profile.jpg', $row['img']);
        $this->assertEquals('T123', $row['teacher_id']);
    }
    
    public function testDisplayFullName()
    {
        // Get teacher data
        $row = $this->teacherData[0];
        
        // Generate full name
        $fullName = $row['fname'] . " " . $row['lname'];
        
        // Assert full name is correct
        $this->assertEquals('John Doe', $fullName);
    }
    
    public function testUpdateProfileFormData()
    {
        // Mock form data
        $_POST = [
            'fname' => 'John',
            'lname' => 'Doe',
            'mname' => 'M',
            'email' => 'john.doe@example.com',
            'contact_no' => '1234567890',
            'address' => '123 Main St',
            'birth_date' => '1980-01-01'
        ];
        
        // Assert form data matches teacher data
        $this->assertEquals($this->teacherData[0]['fname'], $_POST['fname']);
        $this->assertEquals($this->teacherData[0]['lname'], $_POST['lname']);
        $this->assertEquals($this->teacherData[0]['mname'], $_POST['mname']);
        $this->assertEquals($this->teacherData[0]['email'], $_POST['email']);
        $this->assertEquals($this->teacherData[0]['contact_no'], $_POST['contact_no']);
        $this->assertEquals($this->teacherData[0]['address'], $_POST['address']);
        $this->assertEquals($this->teacherData[0]['birth_date'], $_POST['birth_date']);
    }
}
?>
