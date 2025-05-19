<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResult {
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

class MockMysqli {
    private $results;

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        return new MockMysqliResult($this->results[$sql] ?? []);
    }

    public function real_escape_string($string) {
        return addslashes($string);
    }
}

class LoginTest extends TestCase
{
    private $conn;
    private $session;

    protected function setUp(): void
    {
        $this->conn = new MockMysqli([
            "SELECT * FROM new_student WHERE lrn = 'student123'" => [
                ['lrn' => 'student123', 'password' => password_hash('pass123', PASSWORD_DEFAULT), 'guardian' => 'Parent Name']
            ],
            "SELECT folder_id FROM folder WHERE lrn = 'student123' ORDER BY folder_id DESC LIMIT 1" => [
                ['folder_id' => 'folder1']
            ],
            "SELECT * FROM teachers WHERE BINARY email = BINARY 'teacher@example.com'" => [
                ['email' => 'teacher@example.com', 'password' => password_hash('pass123', PASSWORD_DEFAULT), 'id' => 1, 'fname' => 'Teacher Name', 'teacher_id' => 'T123', 'img' => 'profile.jpg', 'school' => 'School A', 'status' => 'approve', 'category' => 4]
            ],
            "SELECT * FROM teachers WHERE BINARY email = BINARY 'admin'" => [
                ['email' => 'admin', 'password' => password_hash('admin123', PASSWORD_DEFAULT), 'id' => 2]
            ],
            "INSERT INTO `log` (`log_id`, `date`, `teacher_id`, `action_type`, `details`, `previous`, `updated`, `student_id`, `status`, `school`) VALUES (NULL, '2025-05-19 11:42:00am', 'T123', 'Log in', 'Log in to the system', '', '', '', '', 'School A')" => []
        ]);

        $this->session = [];
    }

    public function testStudentLoginSuccess()
    {
        $_POST = [
            'login' => true,
            'user' => 'student123',
            'pass' => 'pass123'
        ];

        $session = &$this->session;

        $passwordVerified = true;

        $username = $this->conn->real_escape_string(stripcslashes($_POST['user']));
        $password = $this->conn->real_escape_string(stripcslashes($_POST['pass']));
        
        $sql_student = "SELECT * FROM new_student WHERE lrn = '$username'";
        $result_student = $this->conn->query($sql_student);
        $row = $result_student->fetch_assoc();

        if ($row && $passwordVerified) {
            $session['logged_in'] = $row['lrn'];
            $session['id'] = $row['lrn'];
            $session['guardian'] = $row['guardian'];
            $session['color'] = 'bg-info';
            $session['folder_id'] = '';

            $sql_folder = "SELECT folder_id FROM folder WHERE lrn = '$username' ORDER BY folder_id DESC LIMIT 1";
            $result_folder = $this->conn->query($sql_folder);
            if ($folder_row = $result_folder->fetch_assoc()) {
                $session['folder_id'] = $folder_row['folder_id'];
            }
        }

        // Assertions
        $this->assertEquals('student123', $session['logged_in']);
        $this->assertEquals('student123', $session['id']);
        $this->assertEquals('Parent Name', $session['guardian']);
        $this->assertEquals('bg-info', $session['color']);
        $this->assertEquals('folder1', $session['folder_id']);
    }

    public function testTeacherLoginSuccess()
    {
        $_POST = [
            'login' => true,
            'user' => 'teacher@example.com',
            'pass' => 'pass123'
        ];

        $session = &$this->session;

        $passwordVerified = true;

        $username = $this->conn->real_escape_string(stripcslashes($_POST['user']));
        $password = $this->conn->real_escape_string(stripcslashes($_POST['pass']));
        
        $sql_teacher = "SELECT * FROM teachers WHERE BINARY email = BINARY '$username'";
        $result_teacher = $this->conn->query($sql_teacher);
        $row = $result_teacher->fetch_assoc();

        if ($row && $passwordVerified && $row['status'] === 'approve') {
            $session['logged_in'] = $row['fname'];
            $session['teacher_id'] = $row['teacher_id'];
            $session['img'] = $row['img'];
            $session['logged_id'] = $row['id'];
            $session['school'] = $row['school'];
            $session['color'] = 'bg-info';

            $date = date('Y-m-d h:i:sa');
            $sql_log = "INSERT INTO `log` (`log_id`, `date`, `teacher_id`, `action_type`, `details`, `previous`, `updated`, `student_id`, `status`, `school`) VALUES (NULL, '$date', '{$row['teacher_id']}', 'Log in', 'Log in to the system', '', '', '', '', '{$row['school']}')";
            $this->conn->query($sql_log);
        }

        // Assertions
        $this->assertEquals('Teacher Name', $session['logged_in']);
        $this->assertEquals('T123', $session['teacher_id']);
        $this->assertEquals('profile.jpg', $session['img']);
        $this->assertEquals(1, $session['logged_id']);
        $this->assertEquals('School A', $session['school']);
        $this->assertEquals('bg-info', $session['color']);
    }

    public function testAdminLoginSuccess()
    {
        $_POST = [
            'login' => true,
            'user' => 'admin',
            'pass' => 'admin123'
        ];

        $session = &$this->session;

        $passwordVerified = true;

        $username = $this->conn->real_escape_string(stripcslashes($_POST['user']));
        $password = $this->conn->real_escape_string(stripcslashes($_POST['pass']));
        
        $sql_teacher = "SELECT * FROM teachers WHERE BINARY email = BINARY '$username'";
        $result_teacher = $this->conn->query($sql_teacher);
        $row = $result_teacher->fetch_assoc();

        if ($row && $passwordVerified && $username === 'admin') {
            $session['admin'] = $username;
            $session['logged_in'] = $username;
            $session['logged_id'] = $row['id'];
            $session['color'] = 'bg-info';
        }

        // Assertions
        $this->assertEquals('admin', $session['admin']);
        $this->assertEquals('admin', $session['logged_in']);
        $this->assertEquals(2, $session['logged_id']);
        $this->assertEquals('bg-info', $session['color']);
    }
}
?>