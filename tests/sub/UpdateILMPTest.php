<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultUpdateILMP {
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

class MockMysqliUpdateILMP {
    public $affected_rows = 0;
    private $lastQuery = '';
    private $shouldSucceed = true;
    public $error = '';
    private $data;

    public function __construct($data = [], $shouldSucceed = true) {
        $this->shouldSucceed = $shouldSucceed;
        $this->data = $data;
        if (!$shouldSucceed) {
            $this->error = 'Mock database error';
        }
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (strpos($sql, 'SELECT') === 0) {
            // Always return a valid result object for SELECT queries
            return new MockMysqliResultUpdateILMP($this->data);
        } else if ($this->shouldSucceed) {
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

class UpdateILMPTest extends TestCase
{
    private $conn;
    private $headers;

    protected function setUp(): void
    {
        // Create ILMP data
        $ilmpData = [
            [
                'ilmpID' => '101',
                'learning_area' => 'Old Learning Area 1',
                'learner_need' => 'Old Learner Need 1',
                'intervention' => 'Old Intervention 1',
                'monitoring_date' => '2024-01-01',
                'insignificant' => 'Old Insignificant 1',
                'significant' => 'Old Significant 1',
                'mastery' => 'Old Mastery 1'
            ],
            [
                'ilmpID' => '102',
                'learning_area' => 'Old Learning Area 2',
                'learner_need' => 'Old Learner Need 2',
                'intervention' => 'Old Intervention 2',
                'monitoring_date' => '2024-01-02',
                'insignificant' => 'Old Insignificant 2',
                'significant' => 'Old Significant 2',
                'mastery' => 'Old Mastery 2'
            ]
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliUpdateILMP($ilmpData);
        
        // Mock headers
        $this->headers = [];
        
        // Set up GET parameters
        $_GET = [
            'id' => '123',
            'lrn' => '456789',
            'folder_id' => '789'
        ];
        
        // Set up POST data
        $_POST = [
            'learning_area1' => 'Updated Learning Area 1',
            'learner_need1' => 'Updated Learner Need 1',
            'intervention1' => 'Updated Intervention 1',
            'monitoring_date1' => '2025-05-19',
            'insignificant1' => 'Updated Insignificant 1',
            'significant1' => 'Updated Significant 1',
            'mastery1' => 'Updated Mastery 1',
            
            'learning_area2' => 'Updated Learning Area 2',
            'learner_need2' => 'Updated Learner Need 2',
            'intervention2' => 'Updated Intervention 2',
            'monitoring_date2' => '2025-05-20',
            'insignificant2' => 'Updated Insignificant 2',
            'significant2' => 'Updated Significant 2',
            'mastery2' => 'Updated Mastery 2'
        ];
    }

    public function testUpdateILMP()
    {
        $conn = $this->conn;
        $ilmp_id = $_GET['id'];
        
        // Get ILMP data
        $sqlilmp = "SELECT * FROM ilmp where ilmp_id = $ilmp_id";
        $sqldatailmp = $conn->query($sqlilmp);
        
        // Process ILMP data
        $cnt = 1;
        while ($ilmp = $sqldatailmp->fetch_assoc()) {
            $id = $ilmp['ilmpID'];
            $sql = "UPDATE `ilmp` SET `learning_area` = '" . $_POST['learning_area' . $cnt] . "', `learner_need` = '" . $_POST['learner_need' . $cnt] . "', `intervention` = '" . $_POST['intervention' . $cnt] . "', `monitoring_date` = '" . $_POST['monitoring_date' . $cnt] . "', `insignificant` = '" . $_POST['insignificant' . $cnt] . "',
 `significant` = '" . $_POST['significant' . $cnt] . "', `mastery` = '" . $_POST['mastery' . $cnt] . "' WHERE `ilmp`.`ilmpID` = $id;";
            
            $result = $conn->query($sql);
            
            // Assert that the query was executed successfully
            $this->assertTrue($result);
            $this->assertEquals(1, $conn->affected_rows);
            
            $cnt++;
        }
        
        // Assert that all ILMP records were processed
        $this->assertEquals(3, $cnt);
    }
    
    public function testRedirect()
    {
        $headers = &$this->headers;
        $lrn = $_GET['lrn'];
        $folder_id = $_GET['folder_id'];
        
        // Simulate redirect
        $headers[] = 'location:student_file.php?folder_id=' . $folder_id . "&id=" . $lrn . '&ilmpupdate=1';
        
        // Assert redirect happens
        $this->assertContains('location:student_file.php?folder_id=789&id=456789&ilmpupdate=1', $headers);
    }
    
    public function testUpdateFailure()
    {
        // Create mock mysqli connection that will fail
        $conn = new MockMysqliUpdateILMP([
            [
                'ilmpID' => '101',
                'learning_area' => 'Old Learning Area 1',
                'learner_need' => 'Old Learner Need 1',
                'intervention' => 'Old Intervention 1',
                'monitoring_date' => '2024-01-01',
                'insignificant' => 'Old Insignificant 1',
                'significant' => 'Old Significant 1',
                'mastery' => 'Old Mastery 1'
            ]
        ], false);
        
        $ilmp_id = $_GET['id'];
        
        // Get ILMP data
        $sqlilmp = "SELECT * FROM ilmp where ilmp_id = $ilmp_id";
        $sqldatailmp = $conn->query($sqlilmp);
        
        // Process ILMP data
        $cnt = 1;
        while ($ilmp = $sqldatailmp->fetch_assoc()) {
            $id = $ilmp['ilmpID'];
            $sql = "UPDATE `ilmp` SET `learning_area` = '" . $_POST['learning_area' . $cnt] . "', `learner_need` = '" . $_POST['learner_need' . $cnt] . "', `intervention` = '" . $_POST['intervention' . $cnt] . "', `monitoring_date` = '" . $_POST['monitoring_date' . $cnt] . "', `insignificant` = '" . $_POST['insignificant' . $cnt] . "',
 `significant` = '" . $_POST['significant' . $cnt] . "', `mastery` = '" . $_POST['mastery' . $cnt] . "' WHERE `ilmp`.`ilmpID` = $id;";
            
            $result = $conn->query($sql);
            
            // Assert that the query failed
            $this->assertFalse($result);
            $this->assertEquals('Mock database error', $conn->error);
            
            $cnt++;
        }
    }
}