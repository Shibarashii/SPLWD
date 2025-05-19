<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultAddProgressReport {
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

class MockMysqliAddProgressReport {
    private $results = [];
    private $lastQuery = '';
    public $affected_rows = 0;

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultAddProgressReport($this->results[$sql]);
        }
        
        // For INSERT queries, return true
        if (strpos($sql, 'INSERT INTO') === 0) {
            $this->affected_rows = 1;
            return true;
        }
        
        return new MockMysqliResultAddProgressReport([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class AddProgressReportTest extends TestCase
{
    private $conn;
    private $session;

    protected function setUp(): void
    {
        // Create mock mysqli connection
        $this->conn = new MockMysqliAddProgressReport();
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123'
        ];
    }

    public function testAddProgressReport()
    {
        $_POST = [
            'submit' => true,
            'lrn' => '123456',
            'progress_year' => '2025-2026',
            '11' => 'Domain 1.1',
            '11q1' => 'Q1 Rating',
            '11q2' => 'Q2 Rating',
            '11q3' => 'Q3 Rating',
            '11q4' => 'Q4 Rating',
            '21' => 'Domain 2.1',
            '21q1' => 'Q1 Rating',
            '21q2' => 'Q2 Rating',
            '21q3' => 'Q3 Rating',
            '21q4' => 'Q4 Rating',
            '31' => 'Domain 3.1',
            '31q1' => 'Q1 Rating',
            '31q2' => 'Q2 Rating',
            '31q3' => 'Q3 Rating',
            '31q4' => 'Q4 Rating',
            '41' => 'Domain 4.1',
            '41q1' => 'Q1 Rating',
            '41q2' => 'Q2 Rating',
            '41q3' => 'Q3 Rating',
            '41q4' => 'Q4 Rating',
            '51' => 'Domain 5.1',
            '51q1' => 'Q1 Rating',
            '51q2' => 'Q2 Rating',
            '51q3' => 'Q3 Rating',
            '51q4' => 'Q4 Rating',
            '61' => 'Domain 6.1',
            '61q1' => 'Q1 Rating',
            '61q2' => 'Q2 Rating',
            '61q3' => 'Q3 Rating',
            '61q4' => 'Q4 Rating'
        ];
        
        $conn = $this->conn;
        
        // Test inserting progress report records for domain type 1
        $type = 1;
        $sql = "INSERT INTO `progress_report` (`progress_id`, `lrn`, `year` , `progress_index`, `type`, `q1`, `q2`, `q3`, `q4`) VALUES (NULL, '" . $_POST['lrn'] . "','" . $_POST['progress_year'] . "',1, '" . $_POST['1' . $type] . "', '" . $_POST['1' . $type . 'q1'] . "', '" . $_POST['1' . $type . 'q2'] . "', '" . $_POST['1' . $type . 'q3'] . "', '" . $_POST['1' . $type . 'q4'] . "');";
        
        $result = $conn->query($sql);
        
        // Assert progress report record was inserted
        $this->assertTrue($result);
        
        // Test inserting progress report records for domain type 2
        $type = 1;
        $sql1 = "INSERT INTO `progress_report` (`progress_id`, `lrn`, `year`, `progress_index`, `type`, `q1`, `q2`, `q3`, `q4`) VALUES (NULL, '" . $_POST['lrn'] . "','" . $_POST['progress_year'] . "',2, '" . $_POST['2' . $type] . "', '" . $_POST['2' . $type . 'q1'] . "', '" . $_POST['2' . $type . 'q2'] . "', '" . $_POST['2' . $type . 'q3'] . "', '" . $_POST['2' . $type . 'q4'] . "');";
        
        $result1 = $conn->query($sql1);
        
        // Assert progress report record was inserted
        $this->assertTrue($result1);
        
        // Test inserting progress report records for domain type 3
        $type = 1;
        $sql2 = "INSERT INTO `progress_report` (`progress_id`, `lrn`, `year`, `progress_index`, `type`, `q1`, `q2`, `q3`, `q4`) VALUES (NULL, '" . $_POST['lrn'] . "','" . $_POST['progress_year'] . "',3, '" . $_POST['3' . $type] . "', '" . $_POST['3' . $type . 'q1'] . "', '" . $_POST['3' . $type . 'q2'] . "', '" . $_POST['3' . $type . 'q3'] . "', '" . $_POST['3' . $type . 'q4'] . "');";
        
        $result2 = $conn->query($sql2);
        
        // Assert progress report record was inserted
        $this->assertTrue($result2);
        
        // Test inserting progress report records for domain type 4
        $type = 1;
        $sql3 = "INSERT INTO `progress_report` (`progress_id`, `lrn`, `year`, `progress_index`, `type`, `q1`, `q2`, `q3`, `q4`) VALUES (NULL, '" . $_POST['lrn'] . "','" . $_POST['progress_year'] . "', 4,'" . $_POST['4' . $type] . "', '" . $_POST['4' . $type . 'q1'] . "', '" . $_POST['4' . $type . 'q2'] . "', '" . $_POST['4' . $type . 'q3'] . "', '" . $_POST['4' . $type . 'q4'] . "');";
        
        $result3 = $conn->query($sql3);
        
        // Assert progress report record was inserted
        $this->assertTrue($result3);
        
        // Test inserting progress report records for domain type 5
        $type = 1;
        $sql4 = "INSERT INTO `progress_report` (`progress_id`, `lrn`, `year`, `progress_index`, `type`, `q1`, `q2`, `q3`, `q4`) VALUES (NULL, '" . $_POST['lrn'] . "','" . $_POST['progress_year'] . "',5, '" . $_POST['5' . $type] . "', '" . $_POST['5' . $type . 'q1'] . "', '" . $_POST['5' . $type . 'q2'] . "', '" . $_POST['5' . $type . 'q3'] . "', '" . $_POST['5' . $type . 'q4'] . "');";
        
        $result4 = $conn->query($sql4);
        
        // Assert progress report record was inserted
        $this->assertTrue($result4);
        
        // Test inserting progress report records for domain type 6
        $type = 1;
        $sql5 = "INSERT INTO `progress_report` (`progress_id`, `lrn`, `year`, `progress_index`, `type`, `q1`, `q2`, `q3`, `q4`) VALUES (NULL, '" . $_POST['lrn'] . "','" . $_POST['progress_year'] . "',6, '" . $_POST['6' . $type] . "', '" . $_POST['6' . $type . 'q1'] . "', '" . $_POST['6' . $type . 'q2'] . "', '" . $_POST['6' . $type . 'q3'] . "', '" . $_POST['6' . $type . 'q4'] . "');";
        
        $result5 = $conn->query($sql5);
        
        // Assert progress report record was inserted
        $this->assertTrue($result5);
    }
    
    public function testAddMultipleProgressReports()
    {
        $_POST = [
            'submit' => true,
            'lrn' => '123456',
            'progress_year' => '2025-2026'
        ];
        
        $conn = $this->conn;
        
        // Add test data for multiple domains
        for ($i = 1; $i <= 25; $i++) {
            $_POST['1' . $i] = 'Domain 1.' . $i;
            $_POST['1' . $i . 'q1'] = 'Q1 Rating';
            $_POST['1' . $i . 'q2'] = 'Q2 Rating';
            $_POST['1' . $i . 'q3'] = 'Q3 Rating';
            $_POST['1' . $i . 'q4'] = 'Q4 Rating';
        }
        
        // Test inserting multiple progress report records
        $type = 1;
        $insertCount = 0;
        
        while ($type <= 25) {
            $sql = "INSERT INTO `progress_report` (`progress_id`, `lrn`, `year` , `progress_index`, `type`, `q1`, `q2`, `q3`, `q4`) VALUES (NULL, '" . $_POST['lrn'] . "','" . $_POST['progress_year'] . "',1, '" . $_POST['1' . $type] . "', '" . $_POST['1' . $type . 'q1'] . "', '" . $_POST['1' . $type . 'q2'] . "', '" . $_POST['1' . $type . 'q3'] . "', '" . $_POST['1' . $type . 'q4'] . "');";
            
            $result = $conn->query($sql);
            
            // Assert progress report record was inserted
            $this->assertTrue($result);
            $insertCount++;
            
            $type++;
        }
        
        // Assert all records were inserted
        $this->assertEquals(25, $insertCount);
    }
}
?>
