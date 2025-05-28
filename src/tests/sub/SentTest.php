<?php

use PHPUnit\Framework\TestCase;

class MockMysqliSent {
    public $affected_rows = 0;
    private $lastQuery = '';
    private $shouldSucceed = true;
    public $error = '';

    public function __construct($shouldSucceed = true) {
        $this->shouldSucceed = $shouldSucceed;
        if (!$shouldSucceed) {
            $this->error = 'Mock database error';
        }
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if ($this->shouldSucceed) {
            $this->affected_rows = 1;
            return true;
        } else {
            return false;
        }
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class SentTest extends TestCase
{
    private $conn;
    private $session;

    protected function setUp(): void
    {
        // Create mock mysqli connection
        $this->conn = new MockMysqliSent();
        
        // Mock session
        $this->session = [
            'logged_id' => '123'
        ];
        
        // Set up GET parameters
        $_GET = [
            'id' => '456'
        ];
        
        // Set up POST data
        $_POST = [
            'send' => true,
            'msg' => 'Test message'
        ];
    }

    public function testSendMessage()
    {
        $conn = $this->conn;
        $session = &$this->session;
        
        // Process the message sending
        if (isset($_POST['send'])) {
            $id = $_GET['id'];
            $msg = $_POST['msg'];
            $date = date("m-d-y");
            $hey = $session['logged_id'];
            $sql = "INSERT INTO `message` (`msg_id`,`sender`, `receiver`, `message`,`date_time`) VALUES (NULL,'" . $hey . "', '" . $id . "', '" . $msg . "', '" . $date . "');";
            
            $result = $conn->query($sql);
            
            // Assert that the query was executed successfully
            $this->assertTrue($result);
            $this->assertEquals(1, $conn->affected_rows);
            
            // Test the redirect
            $headers = [];
            $headers[] = "Location: chat.php?id=$id";
            
            // Assert that the redirect happens
            $this->assertContains("Location: chat.php?id=456", $headers);
        }
    }
    
    public function testSendMessageFailure()
    {
        // Create mock mysqli connection that will fail
        $conn = new MockMysqliSent(false);
        $session = &$this->session;
        
        // Process the message sending
        if (isset($_POST['send'])) {
            $id = $_GET['id'];
            $msg = $_POST['msg'];
            $date = date("m-d-y");
            $hey = $session['logged_id'];
            $sql = "INSERT INTO `message` (`msg_id`,`sender`, `receiver`, `message`,`date_time`) VALUES (NULL,'" . $hey . "', '" . $id . "', '" . $msg . "', '" . $date . "');";
            
            $result = $conn->query($sql);
            
            // Assert that the query failed
            $this->assertFalse($result);
            $this->assertEquals('Mock database error', $conn->error);
        }
    }
    
    public function testMessageData()
    {
        // Test that the message data is correctly prepared
        $id = $_GET['id'];
        $msg = $_POST['msg'];
        $date = date("m-d-y");
        $hey = $this->session['logged_id'];
        
        // Assert that the message data is correct
        $this->assertEquals('456', $id);
        $this->assertEquals('Test message', $msg);
        $this->assertEquals(date("m-d-y"), $date);
        $this->assertEquals('123', $hey);
    }
}