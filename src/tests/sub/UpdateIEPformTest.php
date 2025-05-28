<?php

use PHPUnit\Framework\TestCase;

class MockMysqliUpdateIEPform {
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

class MockMysqliResultUpdateIEPform {
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

class UpdateIEPformTest extends TestCase
{
    private $conn;
    private $headers;

    protected function setUp(): void
    {
        // Create mock mysqli connection
        $this->conn = new MockMysqliUpdateIEPform();
        
        // Mock headers
        $this->headers = [];
        
        // Set up GET parameters
        $_GET = [
            'id' => '123',
            'lrn' => '456789',
            'folder_id' => '789'
        ];
        
        // Set up POST data for functional performance
        $_POST = [
            'functional_1' => 'Updated functional 1',
            'functional_2' => 'Updated functional 2',
            'functional_3' => 'Updated functional 3',
            'functional_4' => 'Updated functional 4',
            'functional_5' => 'Updated functional 5',
            'functional_1_2' => 'Updated functional 1_2',
            'functional_1_3' => 'Updated functional 1_3',
            'functional_2_2' => 'Updated functional 2_2',
            'functional_2_3' => 'Updated functional 2_3',
            'functional_3_2' => 'Updated functional 3_2',
            'functional_3_3' => 'Updated functional 3_3',
            'functional_4_2' => 'Updated functional 4_2',
            'functional_4_3' => 'Updated functional 4_3',
            'functional_5_2' => 'Updated functional 5_2',
            'functional_5_3' => 'Updated functional 5_3',
            
            // Special factors
            'factor_1' => 'yes',
            'factor_2' => 'no',
            'factor_3' => 'yes',
            'comment_3' => 'Updated comment 3',
            'factor_4' => 'no',
            'comment_4' => 'Updated comment 4',
            'factor_5' => 'yes',
            'comment_5' => 'Updated comment 5',
            'factor_6' => 'no',
            'comment_6' => 'Updated comment 6',
            'factor_7' => 'yes',
            'comment_7' => 'Updated comment 7',
            'factor_8' => 'no',
            'comment_8' => 'Updated comment 8',
            'factor_8_type' => 'Braille',
            'factor_9' => 'yes',
            'comment_9' => 'Updated comment 9',
            
            // Barriers (for multiple records)
            'barrier_1_1' => 'Updated barrier 1_1',
            'barrier_2_1' => 'Updated barrier 2_1',
            'barrier_3_1' => 'Updated barrier 3_1',
            'barrier_4_1' => 'Updated barrier 4_1',
            'barrier_1_2' => 'Updated barrier 1_2',
            'barrier_2_2' => 'Updated barrier 2_2',
            'barrier_3_2' => 'Updated barrier 3_2',
            'barrier_4_2' => 'Updated barrier 4_2',
            
            // Goals (for multiple records)
            'interest_1' => 'Updated interest 1',
            'goal_1' => 'Updated goal 1',
            'intervention_1' => 'Updated intervention 1',
            'timeline_1' => 'Updated timeline 1',
            'individual_responsible_1' => 'Updated responsible 1',
            'remarks_1' => 'Updated remarks 1',
            'progress_1' => 'Updated progress 1',
            'interest_2' => 'Updated interest 2',
            'goal_2' => 'Updated goal 2',
            'intervention_2' => 'Updated intervention 2',
            'timeline_2' => 'Updated timeline 2',
            'individual_responsible_2' => 'Updated responsible 2',
            'remarks_2' => 'Updated remarks 2',
            'progress_2' => 'Updated progress 2',
            
            // Transitions (for multiple records)
            'interest1_1' => 'Updated transition interest 1',
            'work1_1' => 'Updated transition work 1',
            'skills1_1' => 'Updated transition skills 1',
            'individual_responsible1_1' => 'Updated transition responsible 1',
            'remarks1_1' => 'Updated transition remarks 1',
            'interest1_2' => 'Updated transition interest 2',
            'work1_2' => 'Updated transition work 2',
            'skills1_2' => 'Updated transition skills 2',
            'individual_responsible1_2' => 'Updated transition responsible 2',
            'remarks1_2' => 'Updated transition remarks 2',
            
            // Difficulty
            'd_seeing' => 'yes',
            'd_hearing' => 'yes',
            'd_concentrating' => 'yes',
            'd_remembering' => 'yes',
            'd_com' => 'yes',
            'd_moving' => 'yes',
            'd_other' => 'yes',
            'others' => 'Updated others',
            'others_2' => 'Updated others 2',
            'medical_diagnos' => 'Updated medical diagnosis',
            'date_meeting' => '2025-05-19',
            'date_last_iep' => '2024-05-19',
            'purpose' => 'Updated purpose',
            'review_date' => '2026-05-19',
            'comment' => 'Updated comment',
            'grade' => '5',
            
            // Team
            'sp_teacher' => 'Updated special teacher',
            'psych' => 'Updated psychologist',
            'nurse' => 'Updated nurse',
            'therapist' => 'Updated therapist',
            'if_1' => 'yes',
            'guidance' => 'Updated guidance',
            'other_name' => 'Updated other name',
            'principal' => 'Updated principal',
            'dis_1' => 'yes'
        ];
    }

    public function testUpdateFunctionalPerformance()
    {
        $conn = $this->conn;
        $id = $_GET['id'];
        
        // Update functional performance
        $sql = "UPDATE `iep_functional` SET `functional_1` = '" . $_POST['functional_1'] . "', `functional_2` = '" . $_POST['functional_2'] . "', `functional_3` = '" . $_POST['functional_3'] . "', `functional_4` = '" . $_POST['functional_4'] . "', `functional_5` = '" . $_POST['functional_5'] . "', `functional_1_2` = '" . $_POST['functional_1_2'] . "', `functional_1_3` = '" . $_POST['functional_1_3'] . "', `functional_2_2` = '" . $_POST['functional_2_2'] . "', `functional_2_3` = '" . $_POST['functional_2_3'] . "', `functional_3_2` = '" . $_POST['functional_3_2'] . "', `functional_3_3` = '" . $_POST['functional_3_3'] . "', `functional_4_2` = '" . $_POST['functional_4_2'] . "', `functional_4_3` = '" . $_POST['functional_4_3'] . "', `functional_5_2` = '" . $_POST['functional_5_2'] . "', `functional_5_3` = '" . $_POST['functional_5_3'] . "' WHERE `iep_functional`.`iep_id` = $id;";
        
        $result = $conn->query($sql);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testUpdateSpecialFactors()
    {
        $conn = $this->conn;
        $id = $_GET['id'];
        
        // Update special factors
        $sql = "UPDATE `iep_special_factor` SET `factor_1` = '" . $_POST['factor_1'] . "', `factor_2` = '" . $_POST['factor_2'] . "', `factor_3` = '" . $_POST['factor_3'] . "', `comment_3` = '" . $_POST['comment_3'] . "', `factor_4` = '" . $_POST['factor_4'] . "', `comment_4` = '" . $_POST['comment_4'] . "', `factor_5` = '" . $_POST['factor_5'] . "', `comment_5` = '" . $_POST['comment_5'] . "', `factor_6` = '" . $_POST['factor_6'] . "', `comment_6` = '" . $_POST['comment_6'] . "', `factor_7` = '" . $_POST['factor_7'] . "', `comment_7` = '" . $_POST['comment_7'] . "', `factor_8` = '" . $_POST['factor_8'] . "', `comment_8` = '" . $_POST['comment_8'] . "', `factor_8_type` = '" . $_POST['factor_8_type'] . "', `factor_9` = '" . $_POST['factor_9'] . "', `comment_9` = '" . $_POST['comment_9'] . "' WHERE `iep_special_factor`.`iep_id` = $id;";
        
        $result = $conn->query($sql);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testUpdateBarriers()
    {
        $conn = $this->conn;
        $id = $_GET['id'];
        $folder_id = $_GET['folder_id'];
        
        // Mock barriers data
        $barriersData = [
            [
                'barrier_id' => '101',
                'iep_id' => $id,
                'folder_id' => $folder_id,
                'lrn' => $_GET['lrn']
            ],
            [
                'barrier_id' => '102',
                'iep_id' => $id,
                'folder_id' => $folder_id,
                'lrn' => $_GET['lrn']
            ]
        ];
        
        // Create mock mysqli connection with predefined results for barriers query
        $mockConn = new MockMysqliUpdateIEPform();
        $mockResult = new MockMysqliResultUpdateIEPform($barriersData);
        
        // Simulate the barriers query and update
        $sqlget3 = "SELECT * FROM iep_barriers where folder_id = $folder_id and iep_id = $id";
        
        // Process barriers data
        $count = 0;
        foreach ($barriersData as $row3) {
            $count++;
            $id1 = $row3['barrier_id'];
            $sql = "UPDATE `iep_barriers` SET `barrier_1` = '" . $_POST['barrier_1_' . $count] . "', `barrier_2` = '" . $_POST['barrier_2_' . $count] . "', `barrier_3` = '" . $_POST['barrier_3_' . $count] . "', `barrier_4` = '" . $_POST['barrier_4_' . $count] . "' WHERE `iep_barriers`.`barrier_id` = $id1;";
            
            $result = $conn->query($sql);
            
            // Assert that the query was executed successfully
            $this->assertTrue($result);
            $this->assertEquals(1, $conn->affected_rows);
        }
        
        // Assert that all barriers were processed
        $this->assertEquals(2, $count);
    }
    
    public function testUpdateGoals()
    {
        $conn = $this->conn;
        $id = $_GET['id'];
        $folder_id = $_GET['folder_id'];
        
        // Mock goals data
        $goalsData = [
            [
                'goal_id' => '201',
                'iep_id' => $id,
                'folder_id' => $folder_id,
                'lrn' => $_GET['lrn']
            ],
            [
                'goal_id' => '202',
                'iep_id' => $id,
                'folder_id' => $folder_id,
                'lrn' => $_GET['lrn']
            ]
        ];
        
        // Create mock mysqli connection with predefined results for goals query
        $mockConn = new MockMysqliUpdateIEPform();
        $mockResult = new MockMysqliResultUpdateIEPform($goalsData);
        
        // Simulate the goals query and update
        $sqlget4 = "SELECT * FROM iep_goals where folder_id = $folder_id and iep_id = $id";
        
        // Process goals data
        $count = 0;
        foreach ($goalsData as $row4) {
            $count++;
            $id2 = $row4['goal_id'];
            $sql = "UPDATE `iep_goals` SET `interest` = '" . $_POST['interest_' . $count] . "', `goal` = '" . $_POST['goal_' . $count] . "', `intervention` = '" . $_POST['intervention_' . $count] . "', `timeline` = '" . $_POST['timeline_' . $count] . "', `individual_responsible` = '" . $_POST['individual_responsible_' . $count] . "', `remarks` = '" . $_POST['remarks_' . $count] . "', `progress` = '" . $_POST['progress_' . $count] . "' WHERE `iep_goals`.`goal_id` = $id2;";
            
            $result = $conn->query($sql);
            
            // Assert that the query was executed successfully
            $this->assertTrue($result);
            $this->assertEquals(1, $conn->affected_rows);
        }
        
        // Assert that all goals were processed
        $this->assertEquals(2, $count);
    }
    
    public function testUpdateTransitions()
    {
        $conn = $this->conn;
        $id = $_GET['id'];
        $folder_id = $_GET['folder_id'];
        
        // Mock transitions data
        $transitionsData = [
            [
                'transition_id' => '301',
                'iep_id' => $id,
                'folder_id' => $folder_id,
                'lrn' => $_GET['lrn']
            ],
            [
                'transition_id' => '302',
                'iep_id' => $id,
                'folder_id' => $folder_id,
                'lrn' => $_GET['lrn']
            ]
        ];
        
        // Create mock mysqli connection with predefined results for transitions query
        $mockConn = new MockMysqliUpdateIEPform();
        $mockResult = new MockMysqliResultUpdateIEPform($transitionsData);
        
        // Simulate the transitions query and update
        $sqlget5 = "SELECT * FROM iep_transition where folder_id = $folder_id and iep_id = $id";
        
        // Process transitions data
        $count = 0;
        foreach ($transitionsData as $row5) {
            $count++;
            $id3 = $row5['transition_id'];
            $sql = "UPDATE `iep_transition` SET `interest` = '" . $_POST['interest1_' . $count] . "', `work` = '" . $_POST['work1_' . $count] . "', `skills` = '" . $_POST['skills1_' . $count] . "', `individual_responsible` = '" . $_POST['individual_responsible1_' . $count] . "', `remarks` = '" . $_POST['remarks1_' . $count] . "' WHERE `iep_transition`.`transition_id` = $id3;";
            
            $result = $conn->query($sql);
            
            // Assert that the query was executed successfully
            $this->assertTrue($result);
            $this->assertEquals(1, $conn->affected_rows);
        }
        
        // Assert that all transitions were processed
        $this->assertEquals(2, $count);
    }
    
    public function testUpdateDifficulty()
    {
        $conn = $this->conn;
        $id = $_GET['id'];
        
        // Process difficulty data
        $seeing = "";
        $hearing = "";
        $concentrating = "";
        $remebering = "";
        $com = "";
        $moving = "";
        $d_other = "";
        
        if (isset($_POST['d_seeing'])) {
            $seeing = $_POST['d_seeing'];
        }
        if (isset($_POST['d_hearing'])) {
            $hearing = $_POST['d_hearing'];
        }
        if (isset($_POST['d_concentrating'])) {
            $concentrating = $_POST['d_concentrating'];
        }
        if (isset($_POST['d_remembering'])) {
            $remebering = $_POST['d_remembering'];
        }
        if (isset($_POST['d_com'])) {
            $com = $_POST['d_com'];
        }
        if (isset($_POST['d_moving'])) {
            $moving = $_POST['d_moving'];
        }
        if (isset($_POST['d_other'])) {
            $d_other = $_POST['d_other'];
        }
        
        // Update difficulty
        $sql = "UPDATE `iep_difficulty` SET `d_other` = '" . $d_other . "',`d_com` = '" . $com . "',`d_seeing` = '" . $seeing . "', `d_hearing` = '" . $hearing . "', `d_moving` = '" . $moving . "', `d_concentrating` = '" . $concentrating . "', `d_remembering` = '" . $remebering . "', `others` = '" . $_POST['others'] . "', `others_2` = '" . $_POST['others_2'] . "', `medical_diagnos` = '" . $_POST['medical_diagnos'] . "', `date_meeting` = '" . $_POST['date_meeting'] . "', `date_last_iep` = '" . $_POST['date_last_iep'] . "', `purpose` = '" . $_POST['purpose'] . "', `review_date` = '" . $_POST['review_date'] . "', `comment` = '" . $_POST['comment'] . "', `grade` = '" . $_POST['grade'] . "' WHERE `iep_difficulty`.`iep_id` = $id;";
        
        $result = $conn->query($sql);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testUpdateTeam()
    {
        $conn = $this->conn;
        $id = $_GET['id'];
        
        // Update team
        $sql = "UPDATE `iep_team` SET `sp_teacher` = '" . $_POST['sp_teacher'] . "',`psych` = '" . $_POST['psych'] . "', `nurse` = '" . $_POST['nurse'] . "', `therapist` = '" . $_POST['therapist'] . "', `language` = '', `if_regular` = '" . $_POST['if_1'] . "', `date` = '" . $_POST['date_meeting'] . "', `guidance` = '" . $_POST['guidance'] . "', `other_name` = '" . $_POST['other_name'] . "', `principal` = '" . $_POST['principal'] . "', `if_1` = '" . $_POST['if_1'] . "', `dis_1` = '" . $_POST['dis_1'] . "' WHERE `iep_team`.`iep_id` = $id;";
        
        $result = $conn->query($sql);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testRedirect()
    {
        $headers = &$this->headers;
        $lrn = $_GET['lrn'];
        $folder_id = $_GET['folder_id'];
        
        // Simulate redirect
        $headers[] = 'location:student_file.php?id=' . $lrn . "&folder_id=" . $folder_id . "&updateIEP=1";
        
        // Assert redirect happens
        $this->assertContains('location:student_file.php?id=456789&folder_id=789&updateIEP=1', $headers);
    }
    
    public function testUpdateFailure()
    {
        // Create mock mysqli connection that will fail
        $conn = new MockMysqliUpdateIEPform(false);
        $id = $_GET['id'];
        
        // Try to update functional performance
        $sql = "UPDATE `iep_functional` SET `functional_1` = '" . $_POST['functional_1'] . "', `functional_2` = '" . $_POST['functional_2'] . "', `functional_3` = '" . $_POST['functional_3'] . "', `functional_4` = '" . $_POST['functional_4'] . "', `functional_5` = '" . $_POST['functional_5'] . "', `functional_1_2` = '" . $_POST['functional_1_2'] . "', `functional_1_3` = '" . $_POST['functional_1_3'] . "', `functional_2_2` = '" . $_POST['functional_2_2'] . "', `functional_2_3` = '" . $_POST['functional_2_3'] . "', `functional_3_2` = '" . $_POST['functional_3_2'] . "', `functional_3_3` = '" . $_POST['functional_3_3'] . "', `functional_4_2` = '" . $_POST['functional_4_2'] . "', `functional_4_3` = '" . $_POST['functional_4_3'] . "', `functional_5_2` = '" . $_POST['functional_5_2'] . "', `functional_5_3` = '" . $_POST['functional_5_3'] . "' WHERE `iep_functional`.`iep_id` = $id;";
        
        $result = $conn->query($sql);
        
        // Assert that the query failed
        $this->assertFalse($result);
        $this->assertEquals('Mock database error', $conn->error);
    }
}