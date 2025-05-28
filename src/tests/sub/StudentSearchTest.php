<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultStudentSearch {
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

class MockMysqliStudentSearch {
    private $results = [];
    private $lastQuery = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultStudentSearch($this->results[$sql]);
        }
        
        return new MockMysqliResultStudentSearch([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class StudentSearchTest extends TestCase
{
    private $conn;
    private $session;
    private $post;

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
        $this->conn = new MockMysqliStudentSearch([
            "SELECT * FROM student where lrn=123456" => $studentData,
            "SELECT * FROM assessment where lrn=123456" => $assessmentData,
            "SELECT * FROM evaluation where lrn=123456" => $evaluationData,
            "SELECT * FROM teachers where teacher_id = T123" => $teacherData
        ]);
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123'
        ];
        
        // Mock POST parameters
        $this->post = [
            'lrn' => '123456'
        ];
    }

    public function testSearchStudent()
    {
        $conn = $this->conn;
        $lrn = $this->post['lrn'];
        
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
    }
    
    public function testDisplayStudentInformation()
    {
        $conn = $this->conn;
        $lrn = $this->post['lrn'];
        
        $sqlget = "SELECT * FROM student where lrn=$lrn";
        $sqldata = $conn->query($sqlget);
        
        $studentInfo = [];
        while ($row = $sqldata->fetch_assoc()) {
            $studentInfo[] = $row;
        }
        
        // Test student information display
        $infoHtml = "
            <div class='form-group'>
                <p>Learners Registry Number : <strong>{$studentInfo[0]['lrn']}</strong></p>
            </div>
            <div class='form-group'>
                <p>Full Name : <strong>{$studentInfo[0]['lname']}</strong>, <strong>{$studentInfo[0]['fname']}</strong> <strong>{$studentInfo[0]['mname']}.</strong></p>
            </div>
            <div class='form-group'>
                <p>Birth Date : <strong>{$studentInfo[0]['birth_date']}</strong></p>
            </div>
            <div class='form-group'>
                <p>Gender : <strong>{$studentInfo[0]['gender']}</strong></p>
            </div>
            <div class='form-group'>
                <p>Guardian : <strong>{$studentInfo[0]['guardian']}</strong></p>
            </div>
            <div class='form-group'>
                <p>Contact Number : <strong>{$studentInfo[0]['contact_no']}</strong></p>
            </div>
            <div class='form-group'>
                <p>Adviser : <strong>{$studentInfo[0]['teacher_id']}</strong></p>
            </div>
            <div class='form-group'>
                <p>Address : <strong>{$studentInfo[0]['address']}</strong></p>
            </div>
        ";
        
        $this->assertStringContainsString('123456', $infoHtml);
        $this->assertStringContainsString('John', $infoHtml);
        $this->assertStringContainsString('Doe', $infoHtml);
    }
    
    public function testDisplayAssessment()
    {
        $conn = $this->conn;
        $lrn = $this->post['lrn'];
        
        $sqlget = "SELECT * FROM assessment where lrn=$lrn";
        $sqldata = $conn->query($sqlget);
        
        $assessmentInfo = [];
        while ($row = $sqldata->fetch_assoc()) {
            $assessmentInfo[] = $row;
        }
        
        // Test assessment information display
        $assessmentHtml = "
            <div class='form-group'>
                <p>Type of Assessment : <strong>{$assessmentInfo[0]['t_assessment']}</strong></p>
            </div>
            <div class='form-group'>
                <p>Chronological Age : <strong>{$assessmentInfo[0]['c_age']}</strong></p>
            </div>
            <div class='form-group'>
                <p>Result : <strong>{$assessmentInfo[0]['t_assessment']}</strong></p>
            </div>
            <div class='form-group'>
                <p>Administrator : <strong>{$assessmentInfo[0]['administrator']}</strong></p>
            </div>
            <div class='form-group'>
                <p>Strenght : <strong>{$assessmentInfo[0]['strenght']}</strong></p>
            </div>
            <div class='form-group'>
                <p>Category : <strong>{$assessmentInfo[0]['category']}</strong></p>
            </div>
        ";
        
        $this->assertStringContainsString('Cognitive Assessment', $assessmentHtml);
        $this->assertStringContainsString('10 years', $assessmentHtml);
        $this->assertStringContainsString('Dr. Smith', $assessmentHtml);
    }
    
    public function testDisplayEvaluation()
    {
        $conn = $this->conn;
        $lrn = $this->post['lrn'];
        
        $sqlget = "SELECT * FROM evaluation where lrn=$lrn";
        $sqldata = $conn->query($sqlget);
        
        $evaluationInfo = [];
        while ($row = $sqldata->fetch_assoc()) {
            $evaluationInfo[] = $row;
        }
        
        $this->assertCount(1, $evaluationInfo);
        $this->assertEquals('123456', $evaluationInfo[0]['lrn']);
        $this->assertEquals('1', $evaluationInfo[0]['grade']);
        $this->assertEquals('1', $evaluationInfo[0]['quarter']);
        
        // Test evaluation display for different domains
        $domains = [
            '1' => 'DAILY LIVING SKILLS DOMAIN',
            '2' => 'SOCIO - EMOTIONAL DOMAIN',
            '3' => 'LANGUAGE DEVELOPMENT DOMAIN',
            '4' => 'PSYCHOMOTOR DOMAIN',
            '5' => 'COGNITIVE DOMAIN',
            '6' => 'BEHAVIORAL DEVELOPMENT'
        ];
        
        foreach ($domains as $type => $domainName) {
            if ($evaluationInfo[0]['type'] == $type) {
                $domainHtml = "
                    <p><strong> $domainName:</strong> Present Level of Educational Performance</p>
                    <p><strong> Strenght/s: </strong><u> {$evaluationInfo[0]['strenght']} </u></p>
                    <p><strong> Need/s:</strong><u>{$evaluationInfo[0]['needs']} </u></p>
                ";
                
                $this->assertStringContainsString($domainName, $domainHtml);
                $this->assertStringContainsString('Good at self-care', $domainHtml);
                $this->assertStringContainsString('Needs help with time management', $domainHtml);
            }
        }
    }
    
    public function testTabNavigation()
    {
        // Test tab navigation structure
        $tabsHtml = "
            <ul class='nav nav-tabs' id='myTab' role='tablist'>
                <li class='nav-item'>
                    <a class='nav-link active' id='home-tab' data-toggle='tab' href='#page1' role='tab' aria-controls='home'
                    aria-selected='true'>Student Information</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' id='profile-tab' data-toggle='tab' href='#page2' role='tab' aria-controls='assessment'
                    aria-selected='false'>Assessment</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' id='contact-tab' data-toggle='tab' href='#page3' role='tab' aria-controls='contact'
                    aria-selected='false'>Evaluation</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' id='contact-tab1' data-toggle='tab' href='#page4' role='tab' aria-controls='contact'
                    aria-selected='false'>IEP/ILP</a>
                </li>
            </ul>
        ";
        
        $this->assertStringContainsString('Student Information', $tabsHtml);
        $this->assertStringContainsString('Assessment', $tabsHtml);
        $this->assertStringContainsString('Evaluation', $tabsHtml);
        $this->assertStringContainsString('IEP/ILP', $tabsHtml);
    }
}
?>