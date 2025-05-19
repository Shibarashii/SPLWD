<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultInsertIep {
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

class MockMysqliInsertIep {
    private $results = [];
    private $lastQuery = '';
    private $lastInsertId = 0;
    public $affected_rows = 0;

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultInsertIep($this->results[$sql]);
        }
        
        // For INSERT queries, return true and set affected_rows
        if (strpos($sql, 'INSERT INTO') === 0) {
            $this->lastInsertId++;
            $this->affected_rows = 1;
            return true;
        }
        
        return new MockMysqliResultInsertIep([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
    
    public function getLastInsertId() {
        return $this->lastInsertId;
    }
}

class InsertIepTest extends TestCase
{
    private $conn;
    private $session;
    private $iepData;
    private $headers;

    protected function setUp(): void
    {
        // Mock IEP data
        $this->iepData = [
            [
                'iep_id' => '1',
                'folder_id' => '789',
                'teacher_id' => 'T123',
                'lrn' => '123456',
                'd_seeing' => '1',
                'd_hearing' => '1',
                'd_com' => '1',
                'd_moving' => '1',
                'd_concentrating' => '1',
                'd_remembering' => '1',
                'others' => 'Other difficulties',
                'others_2' => 'Other difficulties 2',
                'medical_diagnos' => 'Medical diagnosis',
                'date_meeting' => '2025-05-19',
                'date_last_iep' => '2024-05-19',
                'purpose' => '1',
                'review_date' => '2026-05-19',
                'comment' => 'Comments',
                'grade' => '1'
            ]
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliInsertIep([
            "SELECT * FROM iep_difficulty order by iep_id desc" => $this->iepData
        ]);
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123'
        ];
        
        // Mock headers
        $this->headers = [];
        
        // Mock GET data
        $_GET = [
            'folder_id' => '789'
        ];
        
        // Mock POST data
        $_POST = [
            'lrn' => '123456',
            'd1' => '1',
            'd2' => '1',
            'd3' => '1',
            'd4' => '1',
            'd5' => '1',
            'd6' => '1',
            'others' => 'Other difficulties',
            'others_2' => 'Other difficulties 2',
            'medical_diagnos' => 'Medical diagnosis',
            'date_meeting' => '2025-05-19',
            'date_last_iep' => '2024-05-19',
            'purpose' => '1',
            'review_date' => '2026-05-19',
            'comment' => 'Comments',
            'grade' => '1',
            'functional_1' => 'Functional 1',
            'functional_2' => 'Functional 2',
            'functional_3' => 'Functional 3',
            'functional_4' => 'Functional 4',
            'functional_12' => 'Functional 1.2',
            'functional_22' => 'Functional 2.2',
            'functional_32' => 'Functional 3.2',
            'functional_42' => 'Functional 4.2',
            'functional_13' => 'Functional 1.3',
            'functional_23' => 'Functional 2.3',
            'functional_33' => 'Functional 3.3',
            'functional_43' => 'Functional 4.3',
            'functional_14' => 'Functional 1.4',
            'functional_24' => 'Functional 2.4',
            'functional_34' => 'Functional 3.4',
            'functional_44' => 'Functional 4.4',
            'functional_15' => 'Functional 1.5',
            'functional_25' => 'Functional 2.5',
            'functional_35' => 'Functional 3.5',
            'functional_45' => 'Functional 4.5',
            'functional_1_1' => 'Functional 1-1',
            'functional_1_2' => 'Functional 1-2',
            'functional_1_3' => 'Functional 1-3',
            'functional_2_1' => 'Functional 2-1',
            'functional_2_2' => 'Functional 2-2',
            'functional_2_3' => 'Functional 2-3',
            'functional_3_1' => 'Functional 3-1',
            'functional_3_2' => 'Functional 3-2',
            'functional_3_3' => 'Functional 3-3',
            'functional_4_1' => 'Functional 4-1',
            'functional_4_2' => 'Functional 4-2',
            'functional_4_3' => 'Functional 4-3',
            'functional_5_1' => 'Functional 5-1',
            'functional_5_2' => 'Functional 5-2',
            'functional_5_3' => 'Functional 5-3',
            'factor_1' => 'yes',
            'factor_2' => 'no',
            'factor_3' => 'yes',
            'comment_3' => 'Comment 3',
            'factor_4' => 'no',
            'comment_4' => 'Comment 4',
            'factor_5' => 'yes',
            'comment_5' => 'Comment 5',
            'factor_6' => 'no',
            'comment_6' => 'Comment 6',
            'factor_7' => 'yes',
            'comment_7' => 'Comment 7',
            'factor_8' => 'no',
            'comment_8' => 'Comment 8',
            'factor_8_type' => 'Braille',
            'factor_9' => 'yes',
            'comment_9' => 'Comment 9',
            'interest' => 'Interest 1',
            'goal' => 'Goal 1',
            'intervention' => 'Intervention 1',
            'timeline' => 'Timeline 1',
            'individual_responsible' => 'Person 1',
            'remarks' => 'Remarks 1',
            'progress' => 'Progress 1',
            'interest2' => 'Interest 2',
            'goal2' => 'Goal 2',
            'intervention2' => 'Intervention 2',
            'timeline2' => 'Timeline 2',
            'individual_responsible2' => 'Person 2',
            'remarks2' => 'Remarks 2',
            'progress2' => 'Progress 2',
            'interest3' => 'Interest 3',
            'goal3' => 'Goal 3',
            'intervention3' => 'Intervention 3',
            'timeline3' => 'Timeline 3',
            'individual_responsible3' => 'Person 3',
            'remarks3' => 'Remarks 3',
            'progress3' => 'Progress 3',
            'interest4' => 'Interest 4',
            'goal4' => 'Goal 4',
            'intervention4' => 'Intervention 4',
            'timeline4' => 'Timeline 4',
            'individual_responsible4' => 'Person 4',
            'remarks4' => 'Remarks 4',
            'progress4' => 'Progress 4',
            'if_1' => '1',
            'dis_1' => '1',
            'psych' => 'Psychologist',
            'nurse' => 'Nurse',
            'therapist' => 'Therapist',
            'guidance' => 'Guidance',
            'other_name' => 'Other Name',
            'principal' => 'Principal',
            'teacher' => 'T123',
            'transition_interest' => 'Transition Interest 1',
            'work' => 'Work 1',
            'skills' => 'Skills 1',
            'individual' => 'Individual 1',
            'transition_remarks' => 'Transition Remarks 1',
            'transition_interest2' => 'Transition Interest 2',
            'work2' => 'Work 2',
            'skills2' => 'Skills 2',
            'individual2' => 'Individual 2',
            'transition_remarks2' => 'Transition Remarks 2',
            'transition_interest3' => 'Transition Interest 3',
            'work3' => 'Work 3',
            'skills3' => 'Skills 3',
            'individual3' => 'Individual 3',
            'transition_remarks3' => 'Transition Remarks 3'
        ];
    }

    public function testInsertIepDifficulty()
    {
        $conn = $this->conn;
        $session = &$this->session;
        
        // Set difficulty values
        $va1 = "";
        $va2 = "";
        $va3 = "";
        $va4 = "";
        $va5 = "";
        $va6 = "";
        
        if (isset($_POST['d1'])) {
            $va1 = $_POST['d1'];
        }
        if (isset($_POST['d2'])) {
            $va2 = $_POST['d2'];
        }
        if (isset($_POST['d3'])) {
            $va3 = $_POST['d3'];
        }
        if (isset($_POST['d4'])) {
            $va4 = $_POST['d4'];
        }
        if (isset($_POST['d5'])) {
            $va5 = $_POST['d5'];
        }
        if (isset($_POST['d6'])) {
            $va6 = $_POST['d6'];
        }
        
        // Insert IEP difficulty record
        $sql = "INSERT INTO `iep_difficulty` (`iep_id`, `folder_id`, `teacher_id`, `lrn`, `d_seeing`, `d_hearing`, `d_com`, `d_moving`, `d_concentrating`, `d_remembering`, `others`, `others_2`, `medical_diagnos`, `date_meeting`, `date_last_iep`, `purpose`, `review_date`, `comment`, `grade`) VALUES (NULL, '" . $_GET['folder_id'] . "', '" . $session['teacher_id'] . "', '" . $_POST['lrn'] . "', '" . $va6 . "', '" . $va1 . "', '" . $va2 . "', '" . $va3 . "', '" . $va4 . "', '" . $va5 . "', '" . $_POST['others'] . "', '" . $_POST['others_2'] . "', '" . $_POST['medical_diagnos'] . "', '" . $_POST['date_meeting'] . "', '" . $_POST['date_last_iep'] . "', '" . $_POST['purpose'] . "', '" . $_POST['review_date'] . "','" . $_POST['comment'] . "','" . $_POST['grade'] . "');";
        
        $result = $conn->query($sql);
        
        // Assert IEP difficulty record was inserted
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Get the IEP ID
        $sqlget11 = "SELECT * FROM iep_difficulty order by iep_id desc";
        $result11 = $conn->query($sqlget11);
        $row31 = $result11->fetch_assoc();
        $id = $row31['iep_id'];
        
        // Assert IEP ID is correct
        $this->assertEquals('1', $id);
    }
    
    public function testInsertIepBarriers()
    {
        $conn = $this->conn;
        
        // Get the IEP ID
        $sqlget11 = "SELECT * FROM iep_difficulty order by iep_id desc";
        $result11 = $conn->query($sqlget11);
        $row31 = $result11->fetch_assoc();
        $id = $row31['iep_id'];
        
        // Insert IEP barriers records
        $bar1 = "INSERT INTO `iep_barriers` (`barrier_id`, `iep_id`, `folder_id`, `lrn`, `barrier_1`, `barrier_2`, `barrier_3`, `barrier_4`) VALUES (NULL, '" . $id . "','" . $_GET['folder_id'] . "', '" . $_POST['lrn'] . "', '" . $_POST['functional_1'] . "', '" . $_POST['functional_2'] . "', '" . $_POST['functional_3'] . "', '" . $_POST['functional_4'] . "');";
        
        $result = $conn->query($bar1);
        
        // Assert IEP barriers record was inserted
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Insert more IEP barriers records
        $bar2 = "INSERT INTO `iep_barriers` (`barrier_id`, `iep_id`, `folder_id`, `lrn`, `barrier_1`, `barrier_2`, `barrier_3`, `barrier_4`) VALUES (NULL, '" . $id . "','" . $_GET['folder_id'] . "', '" . $_POST['lrn'] . "', '" . $_POST['functional_12'] . "', '" . $_POST['functional_22'] . "', '" . $_POST['functional_32'] . "', '" . $_POST['functional_42'] . "');";
        
        $result = $conn->query($bar2);
        
        // Assert IEP barriers record was inserted
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testInsertIepFunctional()
    {
        $conn = $this->conn;
        
        // Get the IEP ID
        $sqlget11 = "SELECT * FROM iep_difficulty order by iep_id desc";
        $result11 = $conn->query($sqlget11);
        $row31 = $result11->fetch_assoc();
        $id = $row31['iep_id'];
        
        // Insert IEP functional record
        if ($_POST['functional_1_1'] != '') {
            $sql3 = "INSERT INTO `iep_functional` (`functional_id`, `iep_id`, `folder_id`, `lrn`, `functional_1`, `functional_2`, `functional_3`, `functional_4`, `functional_5`) VALUES (NULL, '" . $id . "','" . $_GET['folder_id'] . "', '" . $_POST['lrn'] . "', '" . $_POST['functional_1_1'] . "', '', '', '', '');";
            
            $result = $conn->query($sql3);
            
            // Assert IEP functional record was inserted
            $this->assertTrue($result);
            $this->assertEquals(1, $conn->affected_rows);
        }
    }
    
    public function testInsertIepGoals()
    {
        $conn = $this->conn;
        
        // Get the IEP ID
        $sqlget11 = "SELECT * FROM iep_difficulty order by iep_id desc";
        $result11 = $conn->query($sqlget11);
        $row31 = $result11->fetch_assoc();
        $id = $row31['iep_id'];
        
        // Insert IEP goals record
        $goal1 = "INSERT INTO `iep_goals` (`goal_id`, `iep_id`, `folder_id`, `lrn`, `interest`, `goal`, `intervention`, `timeline`, `individual_responsible`, `remarks`, `progress`) VALUES (NULL, '" . $id . "','" . $_GET['folder_id'] . "', '" . $_POST['lrn'] . "', '" . $_POST['interest'] . "', '" . $_POST['goal'] . "', '" . $_POST['intervention'] . "', '" . $_POST['timeline'] . "', '" . $_POST['individual_responsible'] . "', '" . $_POST['remarks'] . "', '" . $_POST['progress'] . "');";
        
        $result = $conn->query($goal1);
        
        // Assert IEP goals record was inserted
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testInsertIepSpecialFactor()
    {
        $conn = $this->conn;
        
        // Get the IEP ID
        $sqlget11 = "SELECT * FROM iep_difficulty order by iep_id desc";
        $result11 = $conn->query($sqlget11);
        $row31 = $result11->fetch_assoc();
        $id = $row31['iep_id'];
        
        // Insert IEP special factor record
        $sql5 = "INSERT INTO `iep_special_factor` (`special_factor_id`, `iep_id`, `folder_id`, `lrn`, `factor_1`, `factor_2`, `factor_3`, `comment_3`, `factor_4`, `comment_4`, `factor_5`, `comment_5`, `factor_6`, `comment_6`, `factor_7`, `comment_7`, `factor_8`, `comment_8`, `factor_8_type`, `factor_9`, `comment_9`) VALUES (NULL, '" . $id . "','" . $_GET['folder_id'] . "', '" . $_POST['lrn'] . "', '" . $_POST['factor_1'] . "', '" . $_POST['factor_2'] . "', '" . $_POST['factor_3'] . "', '" . $_POST['comment_3'] . "', '" . $_POST['factor_4'] . "', '" . $_POST['comment_4'] . "', '" . $_POST['factor_5'] . "', '" . $_POST['comment_5'] . "', '" . $_POST['factor_6'] . "', '" . $_POST['comment_6'] . "', '" . $_POST['factor_7'] . "', '" . $_POST['comment_7'] . "', '" . $_POST['factor_8'] . "', '" . $_POST['comment_8'] . "', '" . $_POST['factor_8_type'] . "', '" . $_POST['factor_9'] . "', '" . $_POST['comment_9'] . "');";
        
        $result = $conn->query($sql5);
        
        // Assert IEP special factor record was inserted
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testInsertIepTeam()
    {
        $conn = $this->conn;
        
        // Get the IEP ID
        $sqlget11 = "SELECT * FROM iep_difficulty order by iep_id desc";
        $result11 = $conn->query($sqlget11);
        $row31 = $result11->fetch_assoc();
        $id = $row31['iep_id'];
        
        // Set if and dis values
        $if = '';
        $dis = '';
        
        if (isset($_POST['if_1'])) {
            $if = $_POST['if_1'];
        }
        if (isset($_POST['if_2'])) {
            $if = $_POST['if_2'];
        }
        if (isset($_POST['dis_1'])) {
            $dis = $_POST['dis_1'];
        }
        if (isset($_POST['dis_2'])) {
            $dis = $_POST['dis_2'];
        }
        
        // Insert IEP team record
        $sql6 = "INSERT INTO `iep_team` (`team_id`, `iep_id`, `folder_id`, `lrn`, `psych`, `nurse`, `therapist`, `language`, `if_regular`, `date`, `guidance`, `other_name`, `principal`, `if_1`, `dis_1`) VALUES (NULL, '" . $id . "','" . $_GET['folder_id'] . "', '" . $_POST['lrn'] . "', '" . $_POST['psych'] . "', '" . $_POST['nurse'] . "', '" . $_POST['therapist'] . "', '', '', '" . $_POST['date_meeting'] . "', '" . $_POST['guidance'] . "', '" . $_POST['other_name'] . "', '" . $_POST['principal'] . "', '" . $if . "', '" . $dis . "');";
        
        $result = $conn->query($sql6);
        
        // Assert IEP team record was inserted
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testInsertIepTransition()
    {
        $conn = $this->conn;
        
        // Get the IEP ID
        $sqlget11 = "SELECT * FROM iep_difficulty order by iep_id desc";
        $result11 = $conn->query($sqlget11);
        $row31 = $result11->fetch_assoc();
        $id = $row31['iep_id'];
        
        // Insert IEP transition record
        $trans1 = "INSERT INTO `iep_transition` (`transition_id`, `iep_id`, `folder_id`, `lrn`, `interest`, `work`, `skills`, `individual_responsible`, `remarks`) VALUES (NULL, '" . $id . "','" . $_GET['folder_id'] . "', '" . $_POST['lrn'] . "', '" . $_POST['transition_interest'] . "', '" . $_POST['work'] . "', '" . $_POST['skills'] . "', '" . $_POST['individual'] . "', '" . $_POST['transition_remarks'] . "');";
        
        $result = $conn->query($trans1);
        
        // Assert IEP transition record was inserted
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Test redirect
        $headers = &$this->headers;
        $headers[] = 'Location:student_file.php?id=' . $_POST['lrn'] . '&folder_id=' . $_GET['folder_id'];
        
        // Assert redirect is correct
        $this->assertContains('Location:student_file.php?id=123456&folder_id=789', $headers);
    }
}
?>
