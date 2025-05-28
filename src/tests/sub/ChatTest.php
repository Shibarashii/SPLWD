<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultChat {
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

class MockMysqliChat {
    private $results = [];
    private $lastQuery = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultChat($this->results[$sql]);
        }
        
        return new MockMysqliResultChat([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class ChatTest extends TestCase
{
    private $conn;
    private $session;
    private $teacherData;
    private $messageData;

    protected function setUp(): void
    {
        // Mock teacher data
        $this->teacherData = [
            [
                'id' => 1,
                'fname' => 'John',
                'lname' => 'Doe',
                'img' => 'profile1.jpg'
            ],
            [
                'id' => 2,
                'fname' => 'Jane',
                'lname' => 'Smith',
                'img' => 'profile2.jpg'
            ],
            [
                'id' => 3,
                'fname' => 'Bob',
                'lname' => 'Johnson',
                'img' => 'profile3.jpg'
            ]
        ];
        
        // Mock message data
        $this->messageData = [
            [
                'message_id' => 1,
                'sender' => 1,
                'receiver' => 2,
                'message' => 'Hello Jane!',
                'date' => '2025-05-19 10:00:00'
            ],
            [
                'message_id' => 2,
                'sender' => 2,
                'receiver' => 1,
                'message' => 'Hi John!',
                'date' => '2025-05-19 10:01:00'
            ],
            [
                'message_id' => 3,
                'sender' => 1,
                'receiver' => 2,
                'message' => 'How are you?',
                'date' => '2025-05-19 10:02:00'
            ],
            [
                'message_id' => 4,
                'sender' => 2,
                'receiver' => 1,
                'message' => 'I\'m good, thanks!',
                'date' => '2025-05-19 10:03:00'
            ]
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliChat();
        
        // Mock session
        $this->session = [
            'logged_id' => 1,
            'logged_in' => 'John Doe',
            'img' => 'profile1.jpg'
        ];
    }

    public function testChatPageDisplaysTeacherList()
    {
        $conn = new MockMysqliChat([
            "SELECT * FROM teachers" => $this->teacherData
        ]);
        
        // Get teachers
        $sqlget = "SELECT * FROM teachers";
        $result = $conn->query($sqlget);
        $teachers = [];
        
        while ($row = $result->fetch_assoc()) {
            $teachers[] = $row;
        }
        
        // Assert teachers were retrieved
        $this->assertCount(3, $teachers);
        $this->assertEquals('John', $teachers[0]['fname']);
        $this->assertEquals('Jane', $teachers[1]['fname']);
        $this->assertEquals('Bob', $teachers[2]['fname']);
    }
    
    public function testChatPageDisplaysSelectedTeacher()
    {
        $_GET = [
            'id' => 2
        ];
        
        $conn = new MockMysqliChat([
            "SELECT * FROM teachers where id =2 " => [$this->teacherData[1]]
        ]);
        
        // Get selected teacher
        $id = $_GET['id'];
        $sqlget = "SELECT * FROM teachers where id =$id ";
        $result = $conn->query($sqlget);
        $selectedTeacher = null;
        
        while ($row = $result->fetch_assoc()) {
            $selectedTeacher = $row;
        }
        
        // Assert selected teacher was retrieved
        $this->assertNotNull($selectedTeacher);
        $this->assertEquals('Jane', $selectedTeacher['fname']);
        $this->assertEquals('Smith', $selectedTeacher['lname']);
    }
    
    public function testChatPageDisplaysMessages()
    {
        $_GET = [
            'id' => 2
        ];
        
        $session = &$this->session;
        
        $conn = new MockMysqliChat([
            "SELECT * FROM message" => $this->messageData
        ]);
        
        // Get messages
        $sqlget1 = "SELECT * FROM message";
        $result1 = $conn->query($sqlget1);
        $messages = [];
        
        while ($row1 = $result1->fetch_assoc()) {
            if (($row1['sender'] == $session['logged_id'] && $row1['receiver'] == $_GET['id']) ||
                ($row1['sender'] == $_GET['id'] && $row1['receiver'] == $session['logged_id'])) {
                $messages[] = $row1;
            }
        }
        
        // Assert messages were retrieved
        $this->assertCount(4, $messages);
        $this->assertEquals('Hello Jane!', $messages[0]['message']);
        $this->assertEquals('Hi John!', $messages[1]['message']);
        $this->assertEquals('How are you?', $messages[2]['message']);
        $this->assertEquals('I\'m good, thanks!', $messages[3]['message']);
    }
    
    public function testChatPageWithNoMessages()
    {
        $_GET = [
            'id' => 3
        ];
        
        $session = &$this->session;
        
        $conn = new MockMysqliChat([
            "SELECT * FROM message" => $this->messageData
        ]);
        
        // Get messages
        $sqlget1 = "SELECT * FROM message";
        $result1 = $conn->query($sqlget1);
        $messages = [];
        
        while ($row1 = $result1->fetch_assoc()) {
            if (($row1['sender'] == $session['logged_id'] && $row1['receiver'] == $_GET['id']) ||
                ($row1['sender'] == $_GET['id'] && $row1['receiver'] == $session['logged_id'])) {
                $messages[] = $row1;
            }
        }
        
        // Assert no messages were retrieved
        $this->assertCount(0, $messages);
    }
}
?>
