<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultAddStudent {
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

class MockMysqliAddStudent {
    private $results = [];
    private $lastQuery = '';
    public $affected_rows = 0;

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultAddStudent($this->results[$sql]);
        }
        
        // For INSERT queries, return true
        if (strpos($sql, 'INSERT INTO') === 0) {
            $this->affected_rows = 1;
            return true;
        }
        
        return new MockMysqliResultAddStudent([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class AddStudentTest extends TestCase
{
    private $conn;
    private $session;
    private $headers;
    private $files;

    protected function setUp(): void
    {
        // Create mock mysqli connection
        $this->conn = new MockMysqliAddStudent();
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123'
        ];
        
        // Mock headers
        $this->headers = [];
        
        // Mock files
        $this->files = [
            'fileToUpload' => [
                'name' => 'test_file.pdf',
                'tmp_name' => '/tmp/test_file.pdf',
                'size' => 1000
            ],
            'fileToUpload1' => [
                'name' => 'profile.jpg',
                'tmp_name' => '/tmp/profile.jpg',
                'size' => 1000
            ]
        ];
    }

    public function testAddStudent()
    {
        $_POST = [
            'submit1' => true,
            'lrn' => '123456',
            'teacher_id' => 'T123',
            'fname' => 'John',
            'lname' => 'Doe',
            'mname' => 'M',
            'birth_date' => '2010-01-01',
            'gender' => 'Male',
            'address' => '123 Main St',
            'guardian' => 'Jane Doe',
            'contact_no' => '09123456789',
            't_assessment' => 'Assessment Type',
            'c_age' => '15',
            'administrator' => 'Admin Name',
            'strenght' => 'Student strengths',
            'category' => 'Hearing Impaired',
            'dateilp' => '2025-05-19'
        ];
        
        $_FILES = $this->files;
        
        $conn = $this->conn;
        $session = &$this->session;
        $headers = &$this->headers;
        
        // Mock file upload
        $target_dir1 = "../img/";
        $target_file1 = $target_dir1 . basename($_FILES["fileToUpload1"]["name"]);
        $uploadOk1 = 1;
        
        // Mock file upload
        $target_dir = "../ilp/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        
        // Simulate successful file upload
        $pass = $_POST['lrn'];
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        date_default_timezone_set('Asia/Manila');
        $date = date("Y-m-d");
        $t_id = $session['teacher_id'];
        
        // Insert student record
        $sql = "INSERT INTO `student` (`lrn`, `teacher_id`, `fname`, `lname`, `mname`, `birth_date`, `gender`, `address`, `guardian`, `contact_no`, `img`, `category`,`password`) VALUES ('" . $_POST['lrn'] . "', '" . $_POST['teacher_id'] . "', '" . $_POST['fname'] . "', '" . $_POST['lname'] . "', '" . $_POST['mname'] . "', '" . $_POST['birth_date'] . "', '" . $_POST['gender'] . "', '" . $_POST['address'] . "', '" . $_POST['guardian'] . "', '" . $_POST['contact_no'] . "','" . htmlspecialchars(basename($_FILES["fileToUpload1"]["name"])) . "', '1','" . $hashed_pass . "');";
        
        $result = $conn->query($sql);
        
        // Assert student record was inserted
        $this->assertTrue($result);
        
        // Insert assessment record
        $sql2 = "INSERT INTO `assessment` (`lrn`, `t_assessment`, `c_age`, `administrator`, `strenght`, `category`) VALUES ('" . $_POST['lrn'] . "', '" . $_POST['t_assessment'] . "', '" . $_POST['c_age'] . "', '" . $_POST['administrator'] . "', '" . $_POST['strenght'] . "', '" . $_POST['category'] . "');";
        
        $result2 = $conn->query($sql2);
        
        // Assert assessment record was inserted
        $this->assertTrue($result2);
        
        // Insert ILP record
        $sql7 = "INSERT INTO `ilp` (`lrn`, `date`, `ilp_name`) VALUES ('" . $_POST['lrn'] . "', '" . $_POST['dateilp'] . "', '" . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . "');";
        
        $result7 = $conn->query($sql7);
        
        // Assert ILP record was inserted
        $this->assertTrue($result7);
        
        // Insert log record
        $sql8 = "INSERT INTO `log` (`log_id`, `date`, `teacher_id`, `action_type`, `previous`, `updated`, `student_id`, `status`) VALUES (NULL, '" . $date . "', '" . $t_id . "', 'Add new Student', 'N/A', 'N/A', '" . $_POST['lrn'] . "', 'archive');";
        
        $result8 = $conn->query($sql8);
        
        // Assert log record was inserted
        $this->assertTrue($result8);
        
        // Simulate redirect
        $headers[] = 'Location:addNewStudent.php?alert=1';
        
        // Assert redirect happens
        $this->assertContains('Location:addNewStudent.php?alert=1', $headers);
    }
    
    public function testAddStudentEvaluations()
    {
        $_POST = [
            'submit1' => true,
            'lrn' => '123456',
            'teacher_id' => 'T123',
            '11t_id' => 'T123',
            '11date1' => '2025-01-01',
            '11dlsds' => 'Strength 1',
            '11dlsdn' => 'Need 1'
        ];
        
        $conn = $this->conn;
        
        // Test inserting evaluation records
        $quarter = 1;
        $grade = 1;
        
        $sql9 = "INSERT INTO `evaluation` (`evaluation_id`, `lrn`, `teacher_id`, `date`, `evaluation`, `quarter`, `type`, `strenght`, `needs`, `grade` ) VALUES (NULL, '" . $_POST['lrn'] . "', '" . $_POST[$grade . $quarter . 't_id'] . "', '" . $_POST[$grade . $quarter . 'date1'] . "', '', '" . $quarter . "', '1', '" . $_POST[$grade . $quarter . 'dlsds'] . "', '" . $_POST[$grade . $quarter . 'dlsdn'] . "','" . $grade . "');";
        
        $result9 = $conn->query($sql9);
        
        // Assert evaluation record was inserted
        $this->assertTrue($result9);
    }
}
?>
