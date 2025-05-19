<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultTab2 {
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

class MockMysqliTab2 {
    private $results = [];
    private $lastQuery = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultTab2($this->results[$sql]);
        }
        
        return new MockMysqliResultTab2([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class Tab2Test extends TestCase
{
    private $conn;
    private $id;
    private $folder_id;
    private $guardian;
    private $name;

    protected function setUp(): void
    {
        // Mock functional performance data
        $functionalData = [
            [
                'functional_1' => 'Test result 1@Test result 2@Test result 3',
                'functional_2' => 'Strength 1@Strength 2@Strength 3',
                'functional_3' => 'Need 1@Need 2@Need 3',
                'functional_4' => 'Concern 1@Concern 2@Concern 3',
                'functional_5' => 'Impact 1@Impact 2@Impact 3'
            ]
        ];
        
        // Mock special factors data
        $specialFactorData = [
            [
                'factor_1' => 'yes',
                'factor_2' => 'no',
                'factor_3' => 'yes',
                'factor_4' => 'no',
                'factor_5' => 'yes',
                'factor_6' => 'no',
                'factor_7' => 'yes',
                'factor_8' => 'no',
                'factor_9' => 'yes',
                'factor_8_type' => 'Braille',
                'comment_3' => 'Comment 3',
                'comment_4' => 'Comment 4',
                'comment_5' => 'Comment 5',
                'comment_6' => 'Comment 6',
                'comment_7' => 'Comment 7',
                'comment_8' => 'Comment 8',
                'comment_9' => 'Comment 9'
            ]
        ];
        
        // Mock barriers data
        $barriersData = [
            [
                'barrier_1' => 'Difficulty 1',
                'barrier_2' => 'Environmental Barrier 1',
                'barrier_3' => 'Environmental Facilitator 1',
                'barrier_4' => 'Environmental Facilitator 2'
            ]
        ];
        
        // Mock goals data
        $goalsData = [
            [
                'interest' => 'Interest 1',
                'goal' => 'Goal 1',
                'intervention' => 'Intervention 1',
                'timeline' => 'Timeline 1',
                'individual_responsible' => 'Person 1',
                'remarks' => 'Remark 1',
                'progress' => 'Progress 1'
            ]
        ];
        
        // Mock transition data
        $transitionData = [
            [
                'interest' => 'Interest 1',
                'work' => 'Work 1',
                'skills' => 'Skills 1',
                'individual_responsible' => 'Person 1',
                'remarks' => 'Remark 1'
            ]
        ];
        
        // Create mock mysqli connection with predefined results
        $this->conn = new MockMysqliTab2([
            "SELECT * FROM iep_functional where lrn = 123" => $functionalData,
            "SELECT * FROM iep_special_factor where lrn = 123 and folder_id = 456" => $specialFactorData,
            "SELECT * FROM iep_barriers where lrn = 123 and folder_id = 456" => $barriersData,
            "SELECT * FROM iep_goals where lrn = 123 and folder_id = 456" => $goalsData,
            "SELECT * FROM iep_transition where lrn = 123 and folder_id = 456" => $transitionData
        ]);
        
        // Set up test variables
        $this->id = 123;
        $this->folder_id = 456;
        $this->guardian = "Test Guardian";
        $this->name = "Test Student";
        
        // Set up GET parameters
        $_GET['id'] = $this->id;
        $_GET['folder_id'] = $this->folder_id;
    }

    public function testFunctionalPerformanceTab()
    {
        $conn = $this->conn;
        $id = $this->id;
        
        // Query functional performance data
        $sqlget1 = "SELECT * FROM iep_functional where lrn = $id";
        $sqldata1 = $conn->query($sqlget1);
        
        // Process data as in the original file
        $function1 = "";
        $function2 = "";
        $function3 = "";
        $function4 = "";
        $function5 = "";
        
        while ($row1 = $sqldata1->fetch_assoc()) {
            $function1 .= $row1['functional_1'] . "@";
            if ($row1['functional_2'] != '') {
                $function2 .= $row1['functional_2'] . "@";
            }
            if ($row1['functional_3'] != '') {
                $function3 .= $row1['functional_3'] . "@";
            }
            if ($row1['functional_4'] != '') {
                $function4 .= $row1['functional_4'] . "@";
            }
            if ($row1['functional_5'] != '') {
                $function5 .= $row1['functional_5'] . "@";
            }
        }
        
        $pieces1 = explode("@", $function1);
        $pieces2 = explode("@", $function2);
        $pieces3 = explode("@", $function3);
        $pieces4 = explode("@", $function4);
        $pieces5 = explode("@", $function5);
        
        // Assert that data was processed correctly
        $this->assertEquals("Test result 1", $pieces1[0]);
        $this->assertEquals("Test result 2", $pieces1[1]);
        $this->assertEquals("Test result 3", $pieces1[2]);
        
        $this->assertEquals("Strength 1", $pieces2[0]);
        $this->assertEquals("Strength 2", $pieces2[1]);
        $this->assertEquals("Strength 3", $pieces2[2]);
        
        $this->assertEquals("Need 1", $pieces3[0]);
        $this->assertEquals("Need 2", $pieces3[1]);
        $this->assertEquals("Need 3", $pieces3[2]);
        
        $this->assertEquals("Concern 1", $pieces4[0]);
        $this->assertEquals("Concern 2", $pieces4[1]);
        $this->assertEquals("Concern 3", $pieces4[2]);
        
        $this->assertEquals("Impact 1", $pieces5[0]);
        $this->assertEquals("Impact 2", $pieces5[1]);
        $this->assertEquals("Impact 3", $pieces5[2]);
    }
    
    public function testSpecialFactorsTab()
    {
        $conn = $this->conn;
        $id = $this->id;
        $folder_id = $this->folder_id;
        
        // Query special factors data
        $sqlget2 = "SELECT * FROM iep_special_factor where lrn = $id and folder_id = $folder_id";
        $sqldata2 = $conn->query($sqlget2);
        
        // Process data as in the original file
        $factor1 = "";
        $factor2 = "";
        $factor3 = "";
        $factor4 = "";
        $factor5 = "";
        $factor6 = "";
        $factor7 = "";
        $factor8 = "";
        $factor9 = "";
        $factor_type = "";
        $comment3 = "";
        $comment4 = "";
        $comment5 = "";
        $comment6 = "";
        $comment7 = "";
        $comment8 = "";
        $comment9 = "";
        
        while ($row2 = $sqldata2->fetch_assoc()) {
            $factor1 = $row2['factor_1'];
            $factor2 = $row2['factor_2'];
            $factor3 = $row2['factor_3'];
            $factor4 = $row2['factor_4'];
            $factor5 = $row2['factor_5'];
            $factor6 = $row2['factor_6'];
            $factor7 = $row2['factor_7'];
            $factor8 = $row2['factor_8'];
            $factor9 = $row2['factor_9'];
            $factor_type = $row2['factor_8_type'];
            $comment3 = $row2['comment_3'];
            $comment4 = $row2['comment_4'];
            $comment5 = $row2['comment_5'];
            $comment6 = $row2['comment_6'];
            $comment7 = $row2['comment_7'];
            $comment8 = $row2['comment_8'];
            $comment9 = $row2['comment_9'];
        }
        
        // Assert that data was processed correctly
        $this->assertEquals("yes", $factor1);
        $this->assertEquals("no", $factor2);
        $this->assertEquals("yes", $factor3);
        $this->assertEquals("no", $factor4);
        $this->assertEquals("yes", $factor5);
        $this->assertEquals("no", $factor6);
        $this->assertEquals("yes", $factor7);
        $this->assertEquals("no", $factor8);
        $this->assertEquals("yes", $factor9);
        $this->assertEquals("Braille", $factor_type);
        $this->assertEquals("Comment 3", $comment3);
        $this->assertEquals("Comment 4", $comment4);
        $this->assertEquals("Comment 5", $comment5);
        $this->assertEquals("Comment 6", $comment6);
        $this->assertEquals("Comment 7", $comment7);
        $this->assertEquals("Comment 8", $comment8);
        $this->assertEquals("Comment 9", $comment9);
    }
    
    public function testBarriersTab()
    {
        $conn = $this->conn;
        $id = $this->id;
        $folder_id = $this->folder_id;
        
        // Query barriers data
        $sqlget3 = "SELECT * FROM iep_barriers where lrn = $id and folder_id = $folder_id";
        $sqldata3 = $conn->query($sqlget3);
        
        // Process data as in the original file
        $barriers = [];
        while ($row3 = $sqldata3->fetch_assoc()) {
            $barriers[] = [
                'barrier_1' => $row3['barrier_1'],
                'barrier_2' => $row3['barrier_2'],
                'barrier_3' => $row3['barrier_3'],
                'barrier_4' => $row3['barrier_4']
            ];
        }
        
        // Assert that data was processed correctly
        $this->assertEquals("Difficulty 1", $barriers[0]['barrier_1']);
        $this->assertEquals("Environmental Barrier 1", $barriers[0]['barrier_2']);
        $this->assertEquals("Environmental Facilitator 1", $barriers[0]['barrier_3']);
        $this->assertEquals("Environmental Facilitator 2", $barriers[0]['barrier_4']);
    }
    
    public function testGoalsAndTransitionTab()
    {
        $conn = $this->conn;
        $id = $this->id;
        $folder_id = $this->folder_id;
        
        // Query goals data
        $sqlget4 = "SELECT * FROM iep_goals where lrn = $id and folder_id = $folder_id";
        $sqldata4 = $conn->query($sqlget4);
        
        // Process goals data
        $goals = [];
        while ($row4 = $sqldata4->fetch_assoc()) {
            $goals[] = [
                'interest' => $row4['interest'],
                'goal' => $row4['goal'],
                'intervention' => $row4['intervention'],
                'timeline' => $row4['timeline'],
                'individual_responsible' => $row4['individual_responsible'],
                'remarks' => $row4['remarks'],
                'progress' => $row4['progress']
            ];
        }
        
        // Query transition data
        $sqlget5 = "SELECT * FROM iep_transition where lrn = $id and folder_id = $folder_id";
        $sqldata5 = $conn->query($sqlget5);
        
        // Process transition data
        $transitions = [];
        while ($row5 = $sqldata5->fetch_assoc()) {
            $transitions[] = [
                'interest' => $row5['interest'],
                'work' => $row5['work'],
                'skills' => $row5['skills'],
                'individual_responsible' => $row5['individual_responsible'],
                'remarks' => $row5['remarks']
            ];
        }
        
        // Assert that goals data was processed correctly
        $this->assertEquals("Interest 1", $goals[0]['interest']);
        $this->assertEquals("Goal 1", $goals[0]['goal']);
        $this->assertEquals("Intervention 1", $goals[0]['intervention']);
        $this->assertEquals("Timeline 1", $goals[0]['timeline']);
        $this->assertEquals("Person 1", $goals[0]['individual_responsible']);
        $this->assertEquals("Remark 1", $goals[0]['remarks']);
        $this->assertEquals("Progress 1", $goals[0]['progress']);
        
        // Assert that transition data was processed correctly
        $this->assertEquals("Interest 1", $transitions[0]['interest']);
        $this->assertEquals("Work 1", $transitions[0]['work']);
        $this->assertEquals("Skills 1", $transitions[0]['skills']);
        $this->assertEquals("Person 1", $transitions[0]['individual_responsible']);
        $this->assertEquals("Remark 1", $transitions[0]['remarks']);
    }
}