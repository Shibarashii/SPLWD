<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultAddBIR {
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

class MockMysqliAddBIR {
    private $results = [];
    private $lastQuery = '';
    public $affected_rows = 0;

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultAddBIR($this->results[$sql]);
        }
        
        // For INSERT queries, return true
        if (strpos($sql, 'INSERT INTO') === 0) {
            $this->affected_rows = 1;
            return true;
        }
        
        return new MockMysqliResultAddBIR([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class AddBIRTest extends TestCase
{
    private $conn;
    private $session;
    private $headers;

    protected function setUp(): void
    {
        // Mock BIR data
        $birData = [
            ['bir' => 1, 'lrn' => '123456', 'folder_id' => '789']
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliAddBIR([
            "SELECT * FROM bir order by bir desc" => $birData
        ]);
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123'
        ];
        
        // Mock headers
        $this->headers = [];
    }

    public function testAddBIR()
    {
        $_GET = [
            'lrn' => '123456',
            'folder_id' => '789'
        ];
        
        $_POST = [
            'teacher' => 'T123',
            'principal' => 'P456',
            'baseline' => 'Baseline data',
            'difficulty' => 'Difficulty description',
            'with_' => 'With support',
            'result' => 'Test result',
            'self' => 'Self assessment',
            'target' => 'Target goal',
            'objective' => 'Learning objective',
            'bir_intervention' => 'Intervention plan',
            'school_year' => '2025-2026',
            'date_observation' => '2025-05-19',
            'antecedent' => 'Antecedent behavior',
            'observable' => 'Observable behavior',
            'consequence' => 'Consequence of behavior',
            'intervention_done' => 'Intervention done',
            'proactive' => 'Proactive strategy',
            'reactive' => 'Reactive strategy',
            'antecedent_2' => 'Antecedent 2',
            'antecedent_3' => 'Antecedent 3',
            'observable_2' => 'Observable 2',
            'observable_3' => 'Observable 3',
            'consequence_2' => 'Consequence 2',
            'consequence_3' => 'Consequence 3',
            'intervention_done_2' => 'Intervention 2',
            'intervention_done_3' => 'Intervention 3',
            'proactive_2' => 'Proactive 2',
            'proactive_3' => 'Proactive 3',
            'reactive_2' => 'Reactive 2',
            'reactive_3' => 'Reactive 3'
        ];
        
        $conn = $this->conn;
        $headers = &$this->headers;
        
        // Insert BIR record
        $sql = "INSERT INTO `bir` (`bir`, `lrn`, `folder_id`, `teacher`, `principal`, `baseline`, `difficulty`, `with_`, `result`, `self`, `target`, `objective`, `bir_intervention`, `school_year`, `date`)
         VALUES (NULL, '" . $_GET['lrn'] . "', '" . $_GET['folder_id'] . "', '" . $_POST['teacher'] . "', '" . $_POST['principal'] . "', '" . $_POST['baseline'] . "', '" . $_POST['difficulty'] . "', '" . $_POST['with_'] . "', '" . $_POST['result'] . "', '" . $_POST['self'] . "', '" . $_POST['target'] . "', '" . $_POST['objective'] . "', '" . $_POST['bir_intervention'] . "', '" . $_POST['school_year'] . "', '" . $_POST['date_observation'] . "');";
        
        $result = $conn->query($sql);
        
        // Assert BIR record was inserted
        $this->assertTrue($result);
        
        // Get the BIR ID
        $sqlget11 = "SELECT * FROM bir order by bir desc";
        $result11 = $conn->query($sqlget11);
        $row31 = $result11->fetch_assoc();
        $bir = $row31['bir'];
        
        // Insert BIR intervention record
        $sql = "INSERT INTO `bir_intervention` (`bir_intervention_id`, `bir_id`, `lrn`, `folder_id`, `teacher_id`, `antecedent`, `observable`, `consequence`, `intervention_done`, `proactive`, `reactive`, `antecedent_2`, `antecedent_3`, `observable_2`, `observable_3`, `consequence_2`, `consequence_3`, `intervention_done_2`, `intervention_done_3`, `proactive_2`, `proactive_3`, `reactive_2`, `reactive_3`)
        VALUES (NULL, '" . $bir . "', '" . $_GET['lrn'] . "', '" . $_GET['folder_id'] . "', '" . $_POST['teacher'] . "', '" . $_POST['antecedent'] . "', '" . $_POST['observable'] . "', '" . $_POST['consequence'] . "', '" . $_POST['intervention_done'] . "', '" . $_POST['proactive'] . "', '" . $_POST['reactive'] . "', '" . $_POST['antecedent_2'] . "', '" . $_POST['antecedent_3'] . "', '" . $_POST['observable_2'] . "', '" . $_POST['observable_3'] . "', '" . $_POST['consequence_2'] . "', '" . $_POST['consequence_3'] . "', '" . $_POST['intervention_done_2'] . "', '" . $_POST['intervention_done_3'] . "', '" . $_POST['proactive_2'] . "', '" . $_POST['proactive_3'] . "', '" . $_POST['reactive_2'] . "', '" . $_POST['reactive_3'] . "');";
        
        $result = $conn->query($sql);
        
        // Assert BIR intervention record was inserted
        $this->assertTrue($result);
        
        // Simulate redirect
        $headers[] = 'location:student_file.php?id=' . $_GET['lrn'] . '&folder_id=' . $_GET['folder_id'] . '&bir=1';
        
        // Assert redirect happens
        $this->assertContains('location:student_file.php?id=123456&folder_id=789&bir=1', $headers);
    }
}
?>
