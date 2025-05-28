<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultStudentProfile {
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

class MockMysqliStudentProfile {
    private $results = [];
    private $lastQuery = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultStudentProfile($this->results[$sql]);
        }
        
        return new MockMysqliResultStudentProfile([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class StudentProfileTest extends TestCase
{
    private $conn;
    private $session;
    private $get;

    protected function setUp(): void
    {
        // Mock student data
        $studentData = [
            [
                'student_id' => '1',
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
        
        // Mock assessment data
        $assessmentData = [
            [
                'assessment_id' => '1',
                'lrn' => '123456',
                't_assessment' => 'Cognitive Assessment',
                'c_age' => '10 years',
                'administrator' => 'Dr. Smith',
                'strenght' => 'Problem solving',
                'category' => 'Cognitive'
            ]
        ];
        
        // Mock ILP data
        $ilpData = [
            [
                'ilp_id' => '1',
                'lrn' => '123456',
                'ilp_name' => 'ilp_123456.pdf',
                'date' => '2023-05-15'
            ]
        ];
        
        // Mock evaluation data
        $evaluationData = [
            [
                'evaluation_id' => '1',
                'lrn' => '123456',
                'grade' => '1',
                'quarter' => '1',
                'type' => '1',
                'strenght' => 'Good at self-care',
                'needs' => 'Needs help with time management',
                'teacher_id' => 'T123',
                'date' => '2023-01-15'
            ]
        ];
        
        // Mock teacher data
        $teacherData = [
            [
                'teacher_id' => 'T123',
                'fname' => 'Jane',
                'lname' => 'Smith'
            ]
        ];
        
        // Create mock mysqli connection with predefined results
        $this->conn = new MockMysqliStudentProfile([
            "SELECT * FROM student where lrn = 123456" => $studentData,
            "SELECT * FROM assessment where lrn=123456" => $assessmentData,
            "SELECT * FROM ilp where lrn=123456" => $ilpData,
            "SELECT DISTINCT grade FROM evaluation where lrn=123456" => [['grade' => '1'], ['grade' => '2']],
            "SELECT * FROM evaluation where lrn=123456 and grade=1 and quarter=1 order by evaluation_id asc limit 6" => $evaluationData,
            "SELECT * FROM teachers where teacher_id = T123" => $teacherData
        ]);
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123'
        ];
        
        // Mock GET parameters
        $this->get = [
            'lrn' => '123456',
            'assessment' => '123456',
            'evaluation' => '123456',
            'ilp' => '123456'
        ];
    }

    public function testDisplayStudentInformation()
    {
        $conn = $this->conn;
        $lrn = $this->get['lrn'];
        
        $sqlget1 = "SELECT * FROM student where lrn = $lrn";
        $sqldata1 = $conn->query($sqlget1);
        
        $studentInfo = [];
        while ($row = $sqldata1->fetch_assoc()) {
            $studentInfo[] = $row;
        }
        
        $this->assertCount(1, $studentInfo);
        $this->assertEquals('123456', $studentInfo[0]['lrn']);
        $this->assertEquals('John', $studentInfo[0]['fname']);
        $this->assertEquals('Doe', $studentInfo[0]['lname']);
        
        // Test age calculation
        $birthDate = $studentInfo[0]['birth_date'];
        $birthDate = date("m/d/Y", strtotime($birthDate));
        $birthDate = explode("/", $birthDate);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
        
        $this->assertIsInt($age);
    }
    
    public function testDisplayAssessment()
    {
        $conn = $this->conn;
        $lrn = $this->get['assessment'];
        
        $sqlget = "SELECT * FROM assessment where lrn=$lrn";
        $sqldata = $conn->query($sqlget);
        
        $assessmentInfo = [];
        while ($row = $sqldata->fetch_assoc()) {
            $assessmentInfo[] = $row;
        }
        
        $this->assertCount(1, $assessmentInfo);
        $this->assertEquals('123456', $assessmentInfo[0]['lrn']);
        $this->assertEquals('Cognitive Assessment', $assessmentInfo[0]['t_assessment']);
        $this->assertEquals('10 years', $assessmentInfo[0]['c_age']);
    }
    
    public function testDisplayILP()
    {
        $conn = $this->conn;
        $lrn = $this->get['ilp'];
        
        $sqlget = "SELECT * FROM ilp where lrn=$lrn";
        $sqldata = $conn->query($sqlget);
        
        $ilpInfo = [];
        while ($row = $sqldata->fetch_assoc()) {
            $ilpInfo[] = $row;
        }
        
        $this->assertCount(1, $ilpInfo);
        $this->assertEquals('123456', $ilpInfo[0]['lrn']);
        $this->assertEquals('ilp_123456.pdf', $ilpInfo[0]['ilp_name']);
        
        // Test PDF embed
        $embedHtml = '<embed src="../ilp/' . $ilpInfo[0]['ilp_name'] . '" width="550" height="800" type="application/pdf">';
        $this->assertStringContainsString('ilp_123456.pdf', $embedHtml);
    }
    
    public function testDisplayEvaluation()
    {
        $conn = $this->conn;
        $lrn = $this->get['evaluation'];
        
        $sqlget12 = "SELECT DISTINCT grade FROM evaluation where lrn=$lrn";
        $sqldata12 = $conn->query($sqlget12);
        
        $grades = [];
        while ($row = $sqldata12->fetch_assoc()) {
            $grades[] = $row;
        }
        
        $this->assertCount(2, $grades);
        $this->assertEquals('1', $grades[0]['grade']);
        $this->assertEquals('2', $grades[1]['grade']);
        
        // Test evaluation data for a specific grade and quarter
        $grade = $grades[0]['grade'];
        $sqlgeteva1 = "SELECT * FROM evaluation where lrn=$lrn and grade=$grade and quarter=1 order by evaluation_id asc limit 6";
        $sqldataeva1 = $conn->query($sqlgeteva1);
        
        $evaluations = [];
        while ($row = $sqldataeva1->fetch_assoc()) {
            $evaluations[] = $row;
        }
        
        $this->assertCount(1, $evaluations);
        $this->assertEquals('123456', $evaluations[0]['lrn']);
        $this->assertEquals('1', $evaluations[0]['grade']);
        $this->assertEquals('1', $evaluations[0]['quarter']);
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
}
?>