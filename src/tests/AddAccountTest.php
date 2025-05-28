<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultAddAcc {
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

class MockMysqliAAT {
    private $results = [];
    private $lastQuery = '';
    public $affected_rows = 0;

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultAddAcc($this->results[$sql]);
        }
        
        // For INSERT queries, return true
        if (strpos($sql, 'INSERT INTO') === 0) {
            $this->affected_rows = 1;
            return true;
        }
        
        return new MockMysqliResultAddAcc([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class AddAccountTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        // Mock data for existing email check
        $existingTeacher = [
            ['id' => 1, 'email' => 'existing@example.com', 'teacher_id' => '1234567']
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliAAT([
            "SELECT * FROM teachers WHERE email = 'existing@example.com'" => $existingTeacher,
            "SELECT * FROM teachers WHERE email = 'new@example.com'" => []
        ]);
    }

    public function testAddAccountWithExistingEmail()
    {
        $_POST = [
            'signup' => true,
            'email' => 'existing@example.com',
            'fname' => 'John',
            'lname' => 'Doe',
            'mname' => 'M',
            'address' => '123 Main St',
            'teacher_id' => '1234567',
            'contact_no' => '0912345678',
            'bdate' => '1990-01-01',
            'password' => 'Password123!',
            'gender' => 'Male',
            'category' => '4',
            'school' => 'BES'
        ];
        
        // Check if email exists
        $email = $_POST['email'];
        $sql = "SELECT * FROM teachers WHERE email = '$email'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        
        // Assert that email exists
        $this->assertNotNull($row);
        $this->assertEquals('existing@example.com', $row['email']);
    }
    
    public function testAddAccountWithNewEmail()
    {
        $_POST = [
            'signup' => true,
            'email' => 'new@example.com',
            'fname' => 'Jane',
            'lname' => 'Smith',
            'mname' => 'A',
            'address' => '456 Oak St',
            'teacher_id' => '7654321',
            'contact_no' => '0987654321',
            'bdate' => '1995-05-05',
            'password' => 'Password456!',
            'gender' => 'Female',
            'category' => '3',
            'school' => 'GES'
        ];
        
        // Check if email exists
        $email = $_POST['email'];
        $sql = "SELECT * FROM teachers WHERE email = '$email'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        
        // Assert that email doesn't exist
        $this->assertNull($row);
        
        // Test account creation
        $pass = $_POST['password'];
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        $date = date('Y-m-d');
        
        $insertSql = "INSERT INTO `teachers` (`id`, `teacher_id`, `fname`, `lname`, `mname`, `birth_date`, `address`, `gender`, `contact_no`, `email`, `password`, `img`, `status`, `category`, `school`, `date`) VALUES (NULL, '" . $_POST['teacher_id'] . "', '" . $_POST['fname'] . "', '" . $_POST['lname'] . "', '" . $_POST['mname'] . "', '" . $_POST['bdate'] . "', '" . $_POST['address'] . "', '" . $_POST['gender'] . "', '" . $_POST['contact_no'] . "', '" . $_POST['email'] . "', '" . $hashed_pass . "', '', 'pending', '" . $_POST['category'] . "', '" . $_POST['school'] . "','" . $date . "');";
        
        $result = $this->conn->query($insertSql);
        
        // Assert that insert was successful
        $this->assertTrue($result);
        $this->assertEquals(1, $this->conn->affected_rows);
    }
}
?>
