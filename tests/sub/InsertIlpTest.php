<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultInsertIlp {
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

class MockMysqliInsertIlp {
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
            return new MockMysqliResultInsertIlp($this->results[$sql]);
        }
        
        // For INSERT queries, return true and set affected_rows
        if (strpos($sql, 'INSERT INTO') === 0) {
            $this->lastInsertId++;
            $this->affected_rows = 1;
            return true;
        }
        
        return new MockMysqliResultInsertIlp([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
    
    public function getLastInsertId() {
        return $this->lastInsertId;
    }
}

class InsertIlpTest extends TestCase
{
    private $conn;
    private $session;
    private $ilpData;
    private $headers;

    protected function setUp(): void
    {
        // Mock ILP data
        $this->ilpData = [
            [
                'ilp_id' => '1',
                'lrn' => '123456',
                'folder_id' => '789',
                'school_year' => '2025-2026',
                'principal' => 'Principal Name',
                'educ_history' => 'Education History',
                'interview_learner' => 'Interview Notes',
                'strenght_1' => 'Strength 1',
                'need_1' => 'Need 1',
                'strenght_2' => 'Strength 2',
                'need_2' => 'Need 2',
                'strenght_3' => 'Strength 3',
                'need_3' => 'Need 3',
                'strenght_4' => 'Strength 4',
                'need_4' => 'Need 4',
                'strenght_5' => 'Strength 5',
                'need_5' => 'Need 5',
                'strenght_6' => 'Strength 6',
                'need_6' => 'Need 6',
                'strenght_7' => 'Strength 7',
                'need_7' => 'Need 7'
            ]
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliInsertIlp([
            "SELECT * FROM ilp order by ilp_id desc" => $this->ilpData
        ]);
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123'
        ];
        
        // Mock headers
        $this->headers = [];
        
        // Mock GET data
        $_GET = [
            'folder_id' => '789',
            'id' => '123456'
        ];
        
        // Mock POST data
        $_POST = [
            'school_year' => '2025-2026',
            'principal' => 'Principal Name',
            'educ_history' => 'Education History',
            'interview_learner' => 'Interview Notes',
            'strenght1' => 'Strength 1',
            'need1' => 'Need 1',
            'strenght2' => 'Strength 2',
            'need2' => 'Need 2',
            'strenght3' => 'Strength 3',
            'need3' => 'Need 3',
            'strenght4' => 'Strength 4',
            'need4' => 'Need 4',
            'strenght5' => 'Strength 5',
            'need5' => 'Need 5',
            'strenght6' => 'Strength 6',
            'need6' => 'Need 6',
            'strenght7' => 'Strength 7',
            'need7' => 'Need 7',
            'transition1' => 'Transition 1',
            'transition2' => 'Transition 2',
            'transition3' => 'Transition 3',
            'transition4' => 'Transition 4',
            'transition5' => 'Transition 5',
            'type_assessment' => 'Assessment Type',
            'date' => '2025-05-19',
            'chronological_age' => '15',
            'administrator' => 'Administrator Name',
            'result' => 'Assessment Result',
            'date_interview' => '2025-05-20',
            'date_interview_student' => '2025-05-21',
            'priority1' => 'Priority 1',
            'priority2' => 'Priority 2',
            'priority3' => 'Priority 3',
            'priority4' => 'Priority 4',
            'priority5' => 'Priority 5',
            'priority6' => 'Priority 6',
            'priority7' => 'Priority 7'
        ];
    }

    public function testInsertIlp()
    {
        $conn = $this->conn;
        $folder_id = $_GET['folder_id'];
        $lrn = $_GET['id'];
        
        // Insert ILP record
        $sql = "INSERT INTO `ilp` (`ilp_id`, `lrn`, `folder_id`, `school_year`, `principal`, `educ_history`, `interview_learner`, `strenght_1`, `need_1`, `strenght_2`, `need_2`, `strenght_3`, `need_3`, `strenght_4`, `need_4`, `strenght_5`, `need_5`, `strenght_6`, `need_6`, `strenght_7`, `need_7`)
         VALUES (NULL, '" . $lrn . "', '" . $folder_id . "', '" . $_POST['school_year'] . "', '" . $_POST['principal'] . "', '" . $_POST['educ_history'] . "', '" . $_POST['interview_learner'] . "', '" . $_POST['strenght1'] . "', '" . $_POST['need1'] . "', '" . $_POST['strenght2'] . "', '" . $_POST['need2'] . "', '" . $_POST['strenght3'] . "', '" . $_POST['need3'] . "', '" . $_POST['strenght4'] . "', '" . $_POST['need4'] . "', '" . $_POST['strenght5'] . "', '" . $_POST['need5'] . "', '" . $_POST['strenght6'] . "', '" . $_POST['need6'] . "', '" . $_POST['strenght7'] . "', '" . $_POST['need7'] . "');";
        
        $result = $conn->query($sql);
        
        // Assert ILP record was inserted
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Get the ILP ID
        $sqlget11 = "SELECT * FROM ilp order by ilp_id desc";
        $result11 = $conn->query($sqlget11);
        $row31 = $result11->fetch_assoc();
        $id = $row31['ilp_id'];
        
        // Assert ILP ID is correct
        $this->assertEquals('1', $id);
        
        // Insert ILP transition record
        $sql = "INSERT INTO `ilp_transition` (`transition_id`, `ilp_id`, `lrn`, `folder_id`, `transition1`, `transition2`, `transition3`, `transition4`, `transition5`)
        VALUES (NULL, '" . $id . "' , '" . $lrn . "', '" . $folder_id . "', '" . $_POST['transition1'] . "', '" . $_POST['transition2'] . "', '" . $_POST['transition3'] . "', '" . $_POST['transition4'] . "', '" . $_POST['transition5'] . "');";
        
        $result = $conn->query($sql);
        
        // Assert ILP transition record was inserted
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Insert ILP assessment record
        $sql = "INSERT INTO `ilp_assessment` (`assessment_id`, `ilp_id`, `lrn`, `folder_id`, `type_assessment`, `date`, `chronological_age`, `administrator`, `result`, `date_interview`, `date_interview_student`)
        VALUES (NULL, '" . $id . "' , '" . $lrn . "', '" . $folder_id . "', '" . $_POST['type_assessment'] . "', '" . $_POST['date'] . "', '" . $_POST['chronological_age'] . "', '" . $_POST['administrator'] . "', '" . $_POST['result'] . "', '" . $_POST['date_interview'] . "', '" . $_POST['date_interview_student'] . "');";
        
        $result = $conn->query($sql);
        
        // Assert ILP assessment record was inserted
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Insert ILP priority record
        $sql = "INSERT INTO `ilp_priority` (`priority_id`, `ilp_id`, `lrn`, `folder_id`, `priority1`, `priority2`, `priority3`, `priority4`, `priority5`, `priority6`, `priority7`)
         VALUES (NULL, '" . $id . "' , '" . $lrn . "', '" . $folder_id . "', '" . $_POST['priority1'] . "', '" . $_POST['priority2'] . "', '" . $_POST['priority3'] . "', '" . $_POST['priority4'] . "', '" . $_POST['priority5'] . "', '" . $_POST['priority6'] . "', '" . $_POST['priority7'] . "');";
        
        $result = $conn->query($sql);
        
        // Assert ILP priority record was inserted
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Test redirect
        $headers = &$this->headers;
        $headers[] = 'location:student_file.php?id=' . $_GET['id'] . '&folder_id=' . $_GET['folder_id'] . '&addilp=1';
        
        // Assert redirect is correct
        $this->assertContains('location:student_file.php?id=123456&folder_id=789&addilp=1', $headers);
    }
}
?>
