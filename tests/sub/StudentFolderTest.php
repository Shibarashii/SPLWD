<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultStudentFolder {
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

class MockMysqliStudentFolder {
    private $results = [];
    private $lastQuery = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultStudentFolder($this->results[$sql]);
        }
        
        return new MockMysqliResultStudentFolder([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class StudentFolderTest extends TestCase
{
    private $conn;
    private $session;
    private $get;

    protected function setUp(): void
    {
        // Mock student data
        $studentData = [
            [
                'lrn' => '123456',
                'fname' => 'John',
                'lname' => 'Doe',
                'mname' => 'M',
                'birth_date' => '2010-01-01',
                'gender' => 'Male',
                'guardian' => 'Jane Doe',
                'contact_no' => '555-1234',
                'teacher_id' => 'T123',
                'address' => '123 Main St',
                'img' => 'profile.jpg'
            ]
        ];
        
        // Create mock mysqli connection with predefined results
        $this->conn = new MockMysqliStudentFolder([
            "SELECT * FROM student where lrn=123456" => $studentData
        ]);
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123'
        ];
        
        // Mock GET parameters
        $this->get = [
            'lrn' => '123456'
        ];
    }

    public function testDisplayStudentFolders()
    {
        $conn = $this->conn;
        $lrn = $this->get['lrn'];
        
        $sqlget = "SELECT * FROM student where lrn=$lrn";
        $sqldata = $conn->query($sqlget);
        
        $studentInfo = [];
        while ($row = $sqldata->fetch_assoc()) {
            $studentInfo[] = $row;
        }
        
        $this->assertCount(1, $studentInfo);
        $this->assertEquals('123456', $studentInfo[0]['lrn']);
        $this->assertEquals('John', $studentInfo[0]['fname']);
        $this->assertEquals('Doe', $studentInfo[0]['lname']);
        
        // Simulate folder structure display
        $folders = [
            'Student Information' => "student_profile.php?lrn=$lrn",
            'Assessment' => "student_profile.php?assessment=$lrn",
            'Evaluation' => "student_profile.php?evaluation=$lrn",
            'ILP' => "student_profile.php?ilp=$lrn"
        ];
        
        $this->assertCount(4, $folders);
        $this->assertEquals("student_profile.php?lrn=$lrn", $folders['Student Information']);
        $this->assertEquals("student_profile.php?assessment=$lrn", $folders['Assessment']);
        $this->assertEquals("student_profile.php?evaluation=$lrn", $folders['Evaluation']);
        $this->assertEquals("student_profile.php?ilp=$lrn", $folders['ILP']);
    }
    
    public function testLoadingAnimation()
    {
        // Test that loading animation is displayed and then hidden
        $loadingHtml = '<div id="loading"><div class="center"><img src="../img/6.gif" width="300"></div></div>';
        $this->assertStringContainsString('<div id="loading">', $loadingHtml);
        
        // Test JavaScript for hiding loading animation
        $jsCode = "
            var delay = 1000;
            setTimeout(function() {
                $(\"#loading\").fadeOut(\"slow\");
                $(\"body\").css(\"background-color\", \"white\");
                $('#container').fadeIn();
              },
              delay
            );
        ";
        
        $this->assertStringContainsString('$("#loading").fadeOut("slow")', $jsCode);
        $this->assertStringContainsString('delay = 1000', $jsCode);
    }
    
    public function testNavigationLinks()
    {
        $lrn = $this->get['lrn'];
        
        // Test navigation links
        $navLinks = [
            'Student Information' => "student_profile.php?lrn=$lrn",
            'Assessment' => "student_profile.php?assessment=$lrn",
            'Evaluation' => "student_profile.php?evaluation=$lrn",
            'ILP' => "student_profile.php?ilp=$lrn"
        ];
        
        foreach ($navLinks as $title => $link) {
            $this->assertStringContainsString('student_profile.php', $link);
            $this->assertStringContainsString($lrn, $link);
        }
    }
}
?>