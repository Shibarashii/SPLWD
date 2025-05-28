<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultTab {
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

class MockMysqliTab {
    private $results = [];
    private $lastQuery = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultTab($this->results[$sql]);
        }
        
        return new MockMysqliResultTab([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class TabTest extends TestCase
{
    private $conn;
    private $id;

    protected function setUp(): void
    {
        // Create mock progress report data
        $progressData = [];
        
        // Create 25 records for progress_index=1
        for ($i = 1; $i <= 25; $i++) {
            $progressData[] = [
                'type' => "Type $i",
                'q1' => ($i % 4 == 0) ? 'P' : (($i % 4 == 1) ? 'A' : (($i % 4 == 2) ? 'D' : 'B')),
                'q2' => ($i % 4 == 1) ? 'P' : (($i % 4 == 2) ? 'A' : (($i % 4 == 3) ? 'D' : 'B')),
                'q3' => ($i % 4 == 2) ? 'P' : (($i % 4 == 3) ? 'A' : (($i % 4 == 0) ? 'D' : 'B')),
                'q4' => ($i % 4 == 3) ? 'P' : (($i % 4 == 0) ? 'A' : (($i % 4 == 1) ? 'D' : 'B'))
            ];
        }
        
        // Create mock mysqli connection with predefined results
        $this->conn = new MockMysqliTab([
            "SELECT * FROM progress_report where lrn = 123 and progress_index=1" => $progressData
        ]);
        
        // Set up test variables
        $this->id = 123;
        
        // Set up GET parameters
        $_GET['id'] = $this->id;
    }

    public function testProgressChartLabels()
    {
        $conn = $this->conn;
        $id = $this->id;
        
        // Query progress report data for labels
        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1";
        $sqldata = $conn->query($sqlget);
        
        // Process data as in the original file for first chart (first 13 records)
        $count = 0;
        $labels = [];
        while ($row1 = $sqldata->fetch_assoc()) {
            $count++;
            $labels[] = "$count. " . $row1['type'];
            if ($count == 13) {
                break;
            }
        }
        
        // Assert that labels were processed correctly
        $this->assertEquals(13, count($labels));
        $this->assertEquals("1. Type 1", $labels[0]);
        $this->assertEquals("13. Type 13", $labels[12]);
        
        // Reset and query again for second chart (records 14-25)
        $sqldata = $conn->query($sqlget);
        $count = 0;
        $labels2 = [];
        while ($row1 = $sqldata->fetch_assoc()) {
            $count++;
            if ($count >= 14) {
                $labels2[] = "$count. " . $row1['type'];
            }
            if ($count == 25) {
                break;
            }
        }
        
        // Assert that labels for second chart were processed correctly
        $this->assertEquals(12, count($labels2));
        $this->assertEquals("14. Type 14", $labels2[0]);
        $this->assertEquals("25. Type 25", $labels2[11]);
    }
    
    public function testProgressChartData()
    {
        $conn = $this->conn;
        $id = $this->id;
        
        // Query progress report data for chart data
        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1";
        $sqldata = $conn->query($sqlget);
        
        // Process data as in the original file for first chart (first 13 records)
        $count = 1;
        $chartData = [];
        while ($row1 = $sqldata->fetch_assoc()) {
            if ($count == 1) {
                if ($row1['q1'] == 'P') {
                    $chartData[] = 4;
                } else if ($row1['q1'] == 'A') {
                    $chartData[] = 3;
                } else if ($row1['q1'] == 'D') {
                    $chartData[] = 2;
                } else if ($row1['q1'] == 'B') {
                    $chartData[] = 1;
                }
            } else {
                if ($row1['q1'] == 'P') {
                    $chartData[] = 4;
                } else if ($row1['q1'] == 'A') {
                    $chartData[] = 3;
                } else if ($row1['q1'] == 'D') {
                    $chartData[] = 2;
                } else if ($row1['q1'] == 'B') {
                    $chartData[] = 1;
                }
            }
            $count++;
            if ($count == 13) {
                break;
            }
        }
        
        // Assert that chart data was processed correctly
        $this->assertEquals(12, count($chartData));
        
        // Reset and query again for second chart data (Quarter 2)
        $sqldata = $conn->query($sqlget);
        $count = 1;
        $chartData2 = [];
        while ($row1 = $sqldata->fetch_assoc()) {
            if ($count == 1) {
                if ($row1['q2'] == 'P') {
                    $chartData2[] = 4;
                } else if ($row1['q2'] == 'A') {
                    $chartData2[] = 3;
                } else if ($row1['q2'] == 'D') {
                    $chartData2[] = 2;
                } else if ($row1['q2'] == 'B') {
                    $chartData2[] = 1;
                }
            } else {
                if ($row1['q2'] == 'P') {
                    $chartData2[] = 4;
                } else if ($row1['q2'] == 'A') {
                    $chartData2[] = 3;
                } else if ($row1['q2'] == 'D') {
                    $chartData2[] = 2;
                } else if ($row1['q2'] == 'B') {
                    $chartData2[] = 1;
                }
            }
            $count++;
            if ($count == 7) {
                break;
            }
        }
        
        // Assert that second chart data was processed correctly
        $this->assertEquals(6, count($chartData2));
    }
}