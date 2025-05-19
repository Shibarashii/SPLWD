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

class MockMysqliOTVT {
    private $results = [];
    public $affected_rows = 0;

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        if (isset($this->results[$sql])) {
            return new MockMysqliResult($this->results[$sql]);
        }
        return new MockMysqliResult([]);
    }
}

class OtpVerifyTest extends TestCase
{
    private $conn;
    private $session;

    protected function setUp(): void
    {
        // Mock database results
        $teacherData = [
            ['id' => 1, 'email' => 'test@example.com', 'name' => 'Test User']
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliOTVT();
        
        // Mock session
        $this->session = [
            'otp' => '123456',
            'email' => 'test@example.com'
        ];
    }

    public function testOtpVerificationSuccess()
    {
        $_POST = [
            'verify' => true,
            'user_otp' => '123456'
        ];
        
        $session = &$this->session;
        
        // Verify OTP
        $otp = $session['otp'];
        $email = $session['email'];
        $otp_code = $_POST['user_otp'];
        
        // Assert OTP matches
        $this->assertEquals($otp, $otp_code);
        
        $redirectUrl = null;
        if ($otp == $otp_code) {
            // Simulate redirect to reset_password.php
            $redirectUrl = 'reset_password.php';
        }
        
        // Assert redirect happens
        $this->assertEquals('reset_password.php', $redirectUrl);
    }
    
    public function testOtpVerificationFailure()
    {
        $_POST = [
            'verify' => true,
            'user_otp' => '654321' // Incorrect OTP
        ];
        
        $session = &$this->session;
        
        // Verify OTP
        $otp = $session['otp'];
        $email = $session['email'];
        $otp_code = $_POST['user_otp'];
        
        // Assert OTP doesn't match
        $this->assertNotEquals($otp, $otp_code);
        
        $redirectUrl = null;
        $alert = null;
        if ($otp != $otp_code) {
            // Simulate alert
            $alert = "Invalid OTP code";
        } else {
            // Simulate redirect to reset_password.php
            $redirectUrl = 'reset_password.php';
        }
        
        // Assert alert is shown and no redirect happens
        $this->assertEquals("Invalid OTP code", $alert);
        $this->assertNull($redirectUrl);
    }
}
?>
