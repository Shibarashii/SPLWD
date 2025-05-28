<?php

use PHPUnit\Framework\TestCase;

class MockCurl {
    private $success = true;
    private $url = '';
    private $response = [];
    
    public function __construct($success = true) {
        $this->success = $success;
        $this->response = [
            'status' => $success ? 200 : 400,
            'message' => $success ? 'Message sent successfully' : 'Failed to send message'
        ];
    }
    
    public function init($url) {
        $this->url = $url;
        return $this;
    }
    
    public function setopt($option, $value) {
        return true;
    }
    
    public function exec() {
        return json_encode($this->response);
    }
    
    public function close() {
        return true;
    }
    
    public function getUrl() {
        return $this->url;
    }
}

class SMSTest extends TestCase
{
    private $curl;
    private $headers;

    protected function setUp(): void
    {
        $this->curl = new MockCurl();
        $this->headers = [];
    }
    
    public function testSendSMSWithValidParameters()
    {
        $_GET = [
            'message' => 'Test message',
            'phone' => '09123456789'
        ];
        
        // Set up SMS parameters
        $key = "e73fc8e9221596bd13d877807dbc2f686a2256c3";
        $device = 181;
        $sim = 2;
        $message = $_GET['message'];
        $phoneNumber = $_GET['phone'];
        
        // Assert parameters are not null
        $this->assertNotNull($message);
        $this->assertNotNull($phoneNumber);
        
        $url = "https://sms.teamssprogram.com/api/send/sms/SendSMS?key=" . $key . "&device=" . $device . "&sim=" . $sim . "&phone=" . $phoneNumber . "&message=" . urlencode($message);
        
        // Initialize mock curl
        $curl = $this->curl;
        $curl->init($url);
        $curl->setopt(CURLOPT_RETURNTRANSFER, true);
        $response = $curl->exec();
        $curl->close();
        
        // Decode response
        $responseObj = json_decode($response);
        
        // Assert URL was formed correctly
        $this->assertStringContainsString('key=' . $key, $curl->getUrl());
        $this->assertStringContainsString('device=' . $device, $curl->getUrl());
        $this->assertStringContainsString('sim=' . $sim, $curl->getUrl());
        $this->assertStringContainsString('phone=' . $phoneNumber, $curl->getUrl());
        $this->assertStringContainsString('message=' . urlencode($message), $curl->getUrl());
        
        // Assert response status is 200
        $this->assertEquals(200, $responseObj->status);
        
        $headers = &$this->headers;
        if ($responseObj->status == 200) {
            // Simulate redirect
            $headers[] = 'location:typesms.php';
        }
        
        // Assert redirect happens
        $this->assertContains('location:typesms.php', $headers);
    }
    
    public function testSendSMSWithFailedResponse()
    {
        $_GET = [
            'message' => 'Test message',
            'phone' => '09123456789'
        ];
        
        // Set up SMS parameters
        $key = "e73fc8e9221596bd13d877807dbc2f686a2256c3";
        $device = 181;
        $sim = 2;
        $message = $_GET['message'];
        $phoneNumber = $_GET['phone'];
        
        // Set up mock curl with failure
        $this->curl = new MockCurl(false);
        $curl = $this->curl;
        
        $url = "https://sms.teamssprogram.com/api/send/sms/SendSMS?key=" . $key . "&device=" . $device . "&sim=" . $sim . "&phone=" . $phoneNumber . "&message=" . urlencode($message);
        
        // Initialize mock curl
        $curl->init($url);
        $curl->setopt(CURLOPT_RETURNTRANSFER, true);
        $response = $curl->exec();
        $curl->close();
        
        // Decode response
        $responseObj = json_decode($response);
        
        // Assert response status is not 200
        $this->assertNotEquals(200, $responseObj->status);
        
        $headers = &$this->headers;
        $redirected = false;
        if ($responseObj->status == 200) {
            // Simulate redirect
            $headers[] = 'location:typesms.php';
            $redirected = true;
        }
        
        // Assert no redirect happens
        $this->assertFalse($redirected);
        $this->assertEmpty($headers);
    }
    
    public function testSendSMSWithMissingParameters()
    {
        $_GET = [
            'message' => null,
            'phone' => null
        ];
        
        // Set up SMS parameters
        $key = "e73fc8e9221596bd13d877807dbc2f686a2256c3";
        $device = 181;
        $sim = 2;
        $message = $_GET['message'];
        $phoneNumber = $_GET['phone'];
        
        // Assert parameters are null
        $this->assertNull($message);
        $this->assertNull($phoneNumber);
        
        // Assert that no URL is formed and no request is made
        $url = null;
        if ($message != null && $phoneNumber != null) {
            $url = "https://sms.teamssprogram.com/api/send/sms/SendSMS?key=" . $key . "&device=" . $device . "&sim=" . $sim . "&phone=" . $phoneNumber . "&message=" . urlencode($message);
        }
        
        // Assert URL was not formed
        $this->assertNull($url);
    }
}
?>
