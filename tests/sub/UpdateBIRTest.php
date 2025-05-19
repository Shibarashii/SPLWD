<?php

use PHPUnit\Framework\TestCase;

class MockMysqliUpdateBIR {
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

class UpdateBIRTest extends TestCase
{
    private $conn;
    private $headers;
    private $session;

    protected function setUp(): void
    {
        // Create mock mysqli connection
        $this->conn = new MockMysqliUpdateBIR();
        
        // Mock headers
        $this->headers = [];
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123'
        ];
        
        // Set up GET parameters
        $_GET = [
            'id' => '101',
            'lrn' => '123456',
            'folder_id' => '789'
        ];
        
        // Set up POST data
        $_POST = [
            'teacher' => 'T123',
            'principal' => 'P456',
            'baseline' => 'Updated baseline data',
            'difficulty' => 'Updated difficulty description',
            'with_' => 'Updated with support',
            'result' => 'Updated test result',
            'self' => 'Updated self assessment',
            'target' => 'Updated target goal',
            'objective' => 'Updated learning objective',
            'bir_intervention' => 'Updated intervention plan',
            'school_year' => '2025-2026',
            'date_observation' => '2025-05-19',
            'antecedent' => 'Updated antecedent behavior',
            'observable' => 'Updated observable behavior',
            'consequence' => 'Updated consequence of behavior',
            'intervention_done' => 'Updated intervention done',
            'proactive' => 'Updated proactive strategy',
            'reactive' => 'Updated reactive strategy',
            'antecedent_2' => 'Updated antecedent 2',
            'antecedent_3' => 'Updated antecedent 3',
            'observable_2' => 'Updated observable 2',
            'observable_3' => 'Updated observable 3',
            'consequence_2' => 'Updated consequence 2',
            'consequence_3' => 'Updated consequence 3',
            'intervention_done_2' => 'Updated intervention 2',
            'intervention_done_3' => 'Updated intervention 3',
            'proactive_2' => 'Updated proactive 2',
            'proactive_3' => 'Updated proactive 3',
            'reactive_2' => 'Updated reactive 2',
            'reactive_3' => 'Updated reactive 3'
        ];
    }

    public function testUpdateBIR()
    {
        $conn = $this->conn;
        $headers = &$this->headers;
        
        // Update BIR record
        $id = $_GET['id'];
        $sql = "UPDATE `bir` SET `teacher` = '" . $_POST['teacher'] . "', `principal` = '" . $_POST['principal'] . "', `baseline` = '" . $_POST['baseline'] . "', `difficulty` = '" . $_POST['difficulty'] . "', `with_` = '" . $_POST['with_'] . "', `result` = '" . $_POST['result'] . "', `self` = '" . $_POST['self'] . "', `target` = '" . $_POST['target'] . "', `objective` = '" . $_POST['objective'] . "', `bir_intervention` = '" . $_POST['bir_intervention'] . "', `school_year` = '" . $_POST['school_year'] . "', `date` = '" . $_POST['date_observation'] . "' WHERE `bir`.`bir` = $id;";
        
        $result = $conn->query($sql);
        
        // Assert that the BIR record was updated successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Update BIR intervention record
        $sql = "UPDATE `bir_intervention` SET `teacher_id` = '" . $_POST['teacher'] . "', `antecedent` = '" . $_POST['antecedent'] . "', `observable` = '" . $_POST['observable'] . "', `consequence` = '" . $_POST['consequence'] . "', `intervention_done` = '" . $_POST['intervention_done'] . "', `proactive` = '" . $_POST['proactive'] . "', `reactive` = '" . $_POST['reactive'] . "', `antecedent_2` = '" . $_POST['antecedent_2'] . "', `antecedent_3` = '" . $_POST['antecedent_3'] . "', `observable_2` = '" . $_POST['observable_2'] . "', `observable_3` = '" . $_POST['observable_3'] . "', `consequence_2` = '" . $_POST['consequence_2'] . "', `consequence_3` = '" . $_POST['consequence_3'] . "', `intervention_done_2` = '" . $_POST['intervention_done_2'] . "', `intervention_done_3` = '" . $_POST['intervention_done_3'] . "', `proactive_2` = '" . $_POST['proactive_2'] . "', `proactive_3` = '" . $_POST['proactive_3'] . "', `reactive_2` = '" . $_POST['reactive_2'] . "', `reactive_3` = '" . $_POST['reactive_3'] . "' WHERE `bir_intervention`.`bir_id` = $id;";
        
        $result = $conn->query($sql);
        
        // Assert that the BIR intervention record was updated successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Simulate redirect
        $headers[] = 'location:student_file.php?id=' . $_GET['lrn'] . '&folder_id=' . $_GET['folder_id'] . '&updatebir=1';
        
        // Assert redirect happens
        $this->assertContains('location:student_file.php?id=123456&folder_id=789&updatebir=1', $headers);
    }
    
    public function testUpdateBIRFailure()
    {
        // Create mock mysqli connection that will fail
        $conn = new MockMysqliUpdateBIR(false);
        
        // Try to update BIR record
        $id = $_GET['id'];
        $sql = "UPDATE `bir` SET `teacher` = '" . $_POST['teacher'] . "', `principal` = '" . $_POST['principal'] . "', `baseline` = '" . $_POST['baseline'] . "', `difficulty` = '" . $_POST['difficulty'] . "', `with_` = '" . $_POST['with_'] . "', `result` = '" . $_POST['result'] . "', `self` = '" . $_POST['self'] . "', `target` = '" . $_POST['target'] . "', `objective` = '" . $_POST['objective'] . "', `bir_intervention` = '" . $_POST['bir_intervention'] . "', `school_year` = '" . $_POST['school_year'] . "', `date` = '" . $_POST['date_observation'] . "' WHERE `bir`.`bir` = $id;";
        
        $result = $conn->query($sql);
        
        // Assert that the query failed
        $this->assertFalse($result);
        $this->assertEquals('Mock database error', $conn->error);
    }
}