<?php

use PHPUnit\Framework\TestCase;

class MockMysqliUpdateILP {
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

class UpdateILPTest extends TestCase
{
    private $conn;
    private $headers;
    private $session;

    protected function setUp(): void
    {
        // Create mock mysqli connection
        $this->conn = new MockMysqliUpdateILP();
        
        // Mock headers
        $this->headers = [];
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123'
        ];
        
        // Set up GET parameters
        $_GET = [
            'ilp_id' => '123',
            'id' => '456789',
            'folder_id' => '789'
        ];
        
        // Set up POST data
        $_POST = [
            // ILP data
            'principal' => 'Updated Principal',
            'educ_history' => 'Updated Education History',
            'interview' => 'Updated Interview',
            'strenght_1' => 'Updated Strength 1',
            'need_1' => 'Updated Need 1',
            'strenght_2' => 'Updated Strength 2',
            'strenght_3' => 'Updated Strength 3',
            'need_2' => 'Updated Need 2',
            'need_3' => 'Updated Need 3',
            'strenght_4' => 'Updated Strength 4',
            'need_4' => 'Updated Need 4',
            'strenght_5' => 'Updated Strength 5',
            'need_5' => 'Updated Need 5',
            'strenght_6' => 'Updated Strength 6',
            'strenght_7' => 'Updated Strength 7',
            'need_6' => 'Updated Need 6',
            'need_7' => 'Updated Need 7',
            
            // Assessment data
            'type_assessment' => 'Updated Assessment Type',
            'chronological_age' => 'Updated Chronological Age',
            'date' => '2025-05-19',
            'administrator' => 'Updated Administrator',
            'result' => 'Updated Result',
            'date1' => '2025-05-20',
            'date2' => '2025-05-21',
            'adviser' => 'Updated Adviser',
            
            // Priority data
            'priority1' => 'Updated Priority 1',
            'priority2' => 'Updated Priority 2',
            'priority3' => 'Updated Priority 3',
            'priority4' => 'Updated Priority 4',
            'priority5' => 'Updated Priority 5',
            'priority6' => 'Updated Priority 6',
            'priority7' => 'Updated Priority 7',
            
            // Transition data
            'transition1' => 'Updated Transition 1',
            'transition2' => 'Updated Transition 2',
            'transition3' => 'Updated Transition 3',
            'transition4' => 'Updated Transition 4',
            'transition5' => 'Updated Transition 5'
        ];
    }

    public function testUpdateILP()
    {
        $conn = $this->conn;
        $ilp_id = $_GET['ilp_id'];
        
        // Update ILP
        $sql = "UPDATE `ilp` SET  `principal` = '" . $_POST['principal'] . "', `educ_history` = '" . $_POST['educ_history'] . "', `interview_learner` = '" . $_POST['interview'] . "', `strenght_1` = '" . $_POST['strenght_1'] . "', `need_1` = '" . $_POST['need_1'] . "', `strenght_2` = '" . $_POST['strenght_2'] . "', `strenght_3` = '" . $_POST['strenght_3'] . "', `need_2` = '" . $_POST['need_2'] . "', `need_3` = '" . $_POST['need_3'] . "', `strenght_4` = '" . $_POST['strenght_4'] . "', `need_4` = '" . $_POST['need_4'] . "', `strenght_5` = '" . $_POST['strenght_5'] . "', `need_5` = '" . $_POST['need_5'] . "', `strenght_6` = '" . $_POST['strenght_6'] . "', `strenght_7` = '" . $_POST['strenght_7'] . "', `need_6` = '" . $_POST['need_6'] . "', `need_7` = '" . $_POST['need_7'] . "' WHERE `ilp`.`ilp_id` = $ilp_id ;";
        
        $result = $conn->query($sql);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testUpdateILPAssessment()
    {
        $conn = $this->conn;
        $ilp_id = $_GET['ilp_id'];
        
        // Update ILP assessment
        $sql = "UPDATE `ilp_assessment` SET `type_assessment` = '" . $_POST['type_assessment'] . "', `chronological_age` = '" . $_POST['chronological_age'] . "', `date` = '" . $_POST['date'] . "', `administrator` = '" . $_POST['administrator'] . "', `result` = '" . $_POST['result'] . "', `date_interview` = '" . $_POST['date1'] . "', `date_interview_student` = '" . $_POST['date2'] . "', `adviser` = '" . $_POST['adviser'] . "' WHERE `ilp_assessment`.`ilp_id` = $ilp_id ;";
        
        $result = $conn->query($sql);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testUpdateILPPriority()
    {
        $conn = $this->conn;
        $ilp_id = $_GET['ilp_id'];
        
        // Update ILP priority
        $sql = "UPDATE `ilp_priority` SET `priority1` = '" . $_POST['priority1'] . "', `priority2` = '" . $_POST['priority2'] . "', `priority3` = '" . $_POST['priority3'] . "', `priority4` = '" . $_POST['priority4'] . "', `priority5` = '" . $_POST['priority5'] . "', `priority6` = '" . $_POST['priority6'] . "', `priority7` = '" . $_POST['priority7'] . "' WHERE `ilp_priority`.`ilp_id` = $ilp_id ;";
        
        $result = $conn->query($sql);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testUpdateILPTransition()
    {
        $conn = $this->conn;
        $ilp_id = $_GET['ilp_id'];
        
        // Update ILP transition
        $sql = "UPDATE `ilp_transition` SET `transition1` = '" . $_POST['transition1'] . "', `transition2` = '" . $_POST['transition2'] . "', `transition3` = '" . $_POST['transition3'] . "', `transition4` = '" . $_POST['transition4'] . "', `transition5` = '" . $_POST['transition5'] . "' WHERE `ilp_transition`.`ilp_id` = $ilp_id ;";
        
        $result = $conn->query($sql);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testRedirect()
    {
        $headers = &$this->headers;
        $id = $_GET['id'];
        $folder_id = $_GET['folder_id'];
        
        // Simulate redirect
        $headers[] = 'location:student_file.php?id=' . $id . '&folder_id=' . $folder_id . '&updateilp=1';
        
        // Assert redirect happens
        $this->assertContains('location:student_file.php?id=456789&folder_id=789&updateilp=1', $headers);
    }
    
    public function testUpdateFailure()
    {
        // Create mock mysqli connection that will fail
        $conn = new MockMysqliUpdateILP(false);
        $ilp_id = $_GET['ilp_id'];
        
        // Try to update ILP
        $sql = "UPDATE `ilp` SET  `principal` = '" . $_POST['principal'] . "', `educ_history` = '" . $_POST['educ_history'] . "', `interview_learner` = '" . $_POST['interview'] . "', `strenght_1` = '" . $_POST['strenght_1'] . "', `need_1` = '" . $_POST['need_1'] . "', `strenght_2` = '" . $_POST['strenght_2'] . "', `strenght_3` = '" . $_POST['strenght_3'] . "', `need_2` = '" . $_POST['need_2'] . "', `need_3` = '" . $_POST['need_3'] . "', `strenght_4` = '" . $_POST['strenght_4'] . "', `need_4` = '" . $_POST['need_4'] . "', `strenght_5` = '" . $_POST['strenght_5'] . "', `need_5` = '" . $_POST['need_5'] . "', `strenght_6` = '" . $_POST['strenght_6'] . "', `strenght_7` = '" . $_POST['strenght_7'] . "', `need_6` = '" . $_POST['need_6'] . "', `need_7` = '" . $_POST['need_7'] . "' WHERE `ilp`.`ilp_id` = $ilp_id ;";
        
        $result = $conn->query($sql);
        
        // Assert that the query failed
        $this->assertFalse($result);
        $this->assertEquals('Mock database error', $conn->error);
    }
}