<?php

use PHPUnit\Framework\TestCase;

// Mock PHPMailer class
class MockPHPMailer {
    public $sent = false;
    public $lastEmail = '';
    public $lastSubject = '';
    public $lastBody = '';
    public $isSMTP = false;
    public $Host = '';
    public $Port = 0;
    public $SMTPAuth = false;
    public $SMTPSecure = '';
    public $Username = '';
    public $Password = '';
    public $From = '';
    public $FromName = '';
    public $isHTML = false;
    public $Subject = '';
    public $Body = '';
    
    public function isSMTP() {
        $this->isSMTP = true;
    }
    
    public function setFrom($email, $name) {
        $this->From = $email;
        $this->FromName = $name;
    }
    
    public function addAddress($email) {
        $this->lastEmail = $email;
        return true;
    }
    
    public function isHTML($isHtml) {
        $this->isHTML = $isHtml;
    }
    
    public function send() {
        $this->sent = true;
        return true;
    }
}

class MockMysqliResultForgotPassTest {
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

class MockMysqliFPT {
    private $results = [];

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        if (isset($this->results[$sql])) {
            return new MockMysqliResultForgotPassTest($this->results[$sql]);
        }
        return new MockMysqliResultForgotPassTest([]);
    }
}

class ForgotPasswordTest extends TestCase
{
    private $conn;
    private $session;
    private $mail;

    protected function setUp(): void
    {
        // Mock data for existing and non-existing email
        $existingTeacher = [
            ['id' => 1, 'email' => 'teacher@example.com', 'name' => 'John Doe']
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliFPT([
            "SELECT * FROM teachers WHERE email = 'teacher@example.com'" => $existingTeacher,
            "SELECT * FROM teachers WHERE email = 'nonexistent@example.com'" => []
        ]);
        
        // Create mock PHPMailer
        $this->mail = new MockPHPMailer();
        
        // Mock session
        $this->session = [];
    }

    public function testForgotPasswordWithExistingEmail()
    {
        $_POST = [
            'confirm_email' => true,
            'email' => 'teacher@example.com'
        ];
        
        $session = &$this->session;
        
        // Check if email exists
        $email = $_POST['email'];
        $sql = "SELECT * FROM teachers WHERE email = '$email'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        
        // Assert email exists
        $this->assertNotNull($row);
        
        if ($row) {
            // Generate OTP
            $otp = rand(100000, 999999);
            $session['otp'] = $otp;
            $session['email'] = $email;
            
            // Set up mock mail
            $mail = $this->mail;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'scdstacruz@gmail.com';
            $mail->Password = 'aydsuollcolazzhk';
            $mail->setFrom('qwertyqwerty0937@gmail.com', 'OTP Verification');
            $mail->addAddress($_POST["email"]);
            $mail->isHTML(true);
            $mail->Subject = "Your verification code";
            $mail->Body = "<p>Good Day, <br></p> <h3>Here is your OTP code $otp <br></h3>
                           <br><br>
                           <p>With regards,</p>
                           <b>To our group</b>";
            
            $sent = $mail->send();
            
            // Assert email was sent with OTP
            $this->assertTrue($sent);
            $this->assertEquals('teacher@example.com', $mail->lastEmail);
            $this->assertNotEmpty($session['otp']);
            $this->assertEquals($email, $session['email']);
        }
    }
    
    public function testForgotPasswordWithNonExistentEmail()
    {
        $_POST = [
            'confirm_email' => true,
            'email' => 'nonexistent@example.com'
        ];
        
        // Check if email exists
        $email = $_POST['email'];
        $sql = "SELECT * FROM teachers WHERE email = '$email'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        
        // Assert email doesn't exist
        $this->assertNull($row);
    }
}
?>
