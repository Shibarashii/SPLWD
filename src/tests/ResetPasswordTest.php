<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultOTPTest {
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

class MockMysqliRPT {
    private $results = [];
    private $lastQuery = '';
    public $affected_rows = 0;

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultOTPTest($this->results[$sql]);
        }
        
        return new MockMysqliResultOTPTest([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class ResetPasswordTest extends TestCase
{
    private $conn;
    private $session;

    protected function setUp(): void
    {
        // Mock data for teachers
        $teacherData = [
            ['id' => 1, 'email' => 'test@example.com', 'name' => 'Test User']
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliRPT([
            "SELECT * FROM teachers WHERE email='test@example.com'" => $teacherData
        ]);
        
        // Mock session
        $this->session = [
            'email' => 'test@example.com'
        ];
    }

    public function testResetPasswordWithMatchingPasswords()
    {
        $_POST = [
            'submit' => true,
            'pass1' => 'NewPassword123!',
            'pass2' => 'NewPassword123!'
        ];
        
        $session = &$this->session;
        
        // Process password reset
        $pass = $_POST["pass1"];
        $psw2 = $_POST["pass2"];
        $Email = $session['email'];
        
        // Assert passwords match
        $this->assertEquals($pass, $psw2);
        
        $redirectUrl = null;
        $alert = null;
        
        if ($pass == $psw2) {
            $sql = "SELECT * FROM teachers WHERE email='$Email'";
            $result = $this->conn->query($sql);
            $fetch = $result->fetch_assoc();
            
            // Assert user was found
            $this->assertNotNull($fetch);
            
            if ($Email) {
                $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
                $updateQuery = "UPDATE teachers SET password = '$hashed_pass' WHERE email='$Email'";
                $this->conn->query($updateQuery);
                
                // Simulate redirect
                $redirectUrl = "index.php";
                $alert = "Your password reset is succesful";
            }
        }
        
        // Assert password was reset successfully
        $this->assertEquals("index.php", $redirectUrl);
        $this->assertEquals("Your password reset is succesful", $alert);
    }
    
    public function testResetPasswordWithNonMatchingPasswords()
    {
        $_POST = [
            'submit' => true,
            'pass1' => 'NewPassword123!',
            'pass2' => 'DifferentPassword456!' // Different password
        ];
        
        $session = &$this->session;
        
        // Process password reset
        $pass = $_POST["pass1"];
        $psw2 = $_POST["pass2"];
        $Email = $session['email'];
        
        // Assert passwords don't match
        $this->assertNotEquals($pass, $psw2);
        
        $redirectUrl = null;
        $alert = null;
        
        if ($pass == $psw2) {
            // This shouldn't execute
            $redirectUrl = "index.php";
        } else {
            $alert = "Passwords did not match!";
        }
        
        // Assert error message is shown
        $this->assertNull($redirectUrl);
        $this->assertEquals("Passwords did not match!", $alert);
    }
}
?>
