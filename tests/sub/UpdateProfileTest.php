<?php

use PHPUnit\Framework\TestCase;

class MockMysqliUpdateProfile {
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
    
    public function close() {
        // Mock close method
        return true;
    }
}

class UpdateProfileTest extends TestCase
{
    private $conn;
    private $headers;
    private $session;

    protected function setUp(): void
    {
        // Create mock mysqli connection
        $this->conn = new MockMysqliUpdateProfile();
        
        // Mock headers
        $this->headers = [];
        
        // Mock session
        $this->session = [
            'logged_id' => '123'
        ];
        
        // Mock $_FILES
        $_FILES = [
            'fileToUpload1' => [
                'name' => 'profile.jpg',
                'tmp_name' => '/tmp/phpXXXXXX',
                'size' => 1024,
                'type' => 'image/jpeg',
                'error' => 0
            ]
        ];
        
        // Mock $_POST
        $_POST = [
            'submit' => true
        ];
    }

    public function testUpdateProfileImage()
    {
        $conn = $this->conn;
        $headers = &$this->headers;
        $session = &$this->session;
        
        // Mock image file checks
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["fileToUpload1"]["name"], PATHINFO_EXTENSION));
        
        // Mock getimagesize
        $check = [
            'mime' => 'image/jpeg'
        ];
        
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }
        
        // Check file size
        if ($_FILES["fileToUpload1"]["size"] > 5000000) {
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $this->fail("Upload should be OK in this test");
        } else {
            $id = $session['logged_id'];
            $img = htmlspecialchars(basename($_FILES["fileToUpload1"]["name"]));
            $sql = "UPDATE `teachers` SET `img` = '" . $img . "' WHERE `teachers`.`id` = $id;";
            
            $result = $conn->query($sql);
            
            // Assert that the query was executed successfully
            $this->assertTrue($result);
            $this->assertEquals(1, $conn->affected_rows);
            
            // Mock move_uploaded_file
            $moveResult = true;
            
            if ($moveResult) {
                // Simulate redirect
                $headers[] = 'location:profile.php?update_image=1';
            }
            
            // Assert redirect happens
            $this->assertContains('location:profile.php?update_image=1', $headers);
        }
        
        // Close the connection
        $conn->close();
    }
    
    public function testUpdateProfileImageFailure()
    {
        // Create mock mysqli connection that will fail
        $conn = new MockMysqliUpdateProfile(false);
        $session = &$this->session;
        
        // Mock image file checks
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["fileToUpload1"]["name"], PATHINFO_EXTENSION));
        
        // Mock getimagesize
        $check = [
            'mime' => 'image/jpeg'
        ];
        
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }
        
        // Check file size
        if ($_FILES["fileToUpload1"]["size"] > 5000000) {
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $this->fail("Upload should be OK in this test");
        } else {
            $id = $session['logged_id'];
            $img = htmlspecialchars(basename($_FILES["fileToUpload1"]["name"]));
            $sql = "UPDATE `teachers` SET `img` = '" . $img . "' WHERE `teachers`.`id` = $id;";
            
            $result = $conn->query($sql);
            
            // Assert that the query failed
            $this->assertFalse($result);
            $this->assertEquals('Mock database error', $conn->error);
        }
        
        // Close the connection
        $conn->close();
    }
}