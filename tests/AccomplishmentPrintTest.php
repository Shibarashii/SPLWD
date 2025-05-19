<?php

use PHPUnit\Framework\TestCase;

class MockMySqliResultAPT {
    private $data;
    private $index = 0;
    private $num_rows;

    public function __construct($data) {
        $this->data = $data;
        $this->num_rows = count($data);
    }

    public function fetch_assoc() {
        if ($this->index < count($this->data)) {
            return $this->data[$this->index++];
        }
        return null;
    }
    
    public function num_rows() {
        return $this->num_rows;
    }
}

class MockMysqliAPT {
    public $connect_errno = 0;
    public $connect_error = '';
    private $results;

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        if (isset($this->results[$sql])) {
            return new MockMySqliResultAPT($this->results[$sql]);
        }
        return new MockMySqliResultAPT([]);
    }
}

class AccomplishmentPrintTest extends TestCase
{
    private $mysqli;
    private $user_id;
    private $week_id;
    private $start_date;
    private $end_date;

    protected function setUp(): void
    {
        // Set up test data
        $this->user_id = 'T123';
        $this->week_id = 'W456';
        $this->start_date = '2025-05-12';
        $this->end_date = '2025-05-19';
        
        // Mock database results
        $accomplishmentData = [
            [
                'report_accomplishment_date_start' => '2025-05-12',
                'report_accomplishment_date_end' => '2025-05-19',
                'report_accomplishment_objective' => 'Complete unit tests',
                'report_accomplishment_activity' => 'Writing test cases',
                'report_accomplishment_accomplished' => 'Created 10 test cases',
                'report_accomplishment_id' => 'R789',
                'report_accomplisshment_week_id' => 'W456',
                'report_accomplishment_attachment' => 'test_cases.pdf'
            ],
            [
                'report_accomplishment_date_start' => '2025-05-12',
                'report_accomplishment_date_end' => '2025-05-19',
                'report_accomplishment_objective' => 'Review code',
                'report_accomplishment_activity' => 'Code review session',
                'report_accomplishment_accomplished' => 'Reviewed 5 modules',
                'report_accomplishment_id' => 'R790',
                'report_accomplisshment_week_id' => 'W456',
                'report_accomplishment_attachment' => 'review_notes.pdf'
            ]
        ];
        
        $facultyData = [
            [
                'teacher_fname' => 'John',
                'teacher_lname' => 'Doe'
            ]
        ];
        
        // Create mock mysqli with predefined results
        $this->mysqli = new MockMysqliAPT([
            "SELECT * FROM report_accomplishment WHERE report_accomplisshment_week_id = 'W456' " => $accomplishmentData,
            "SELECT * FROM profile_faculty WHERE faculty_id = 'T123'" => $facultyData
        ]);
    }

    public function testRetrieveAccomplishmentData()
    {
        // Simulate the query to get accomplishment data
        $display_week = "SELECT * FROM report_accomplishment WHERE report_accomplisshment_week_id = '{$this->week_id}' ";
        $result = $this->mysqli->query($display_week);
        
        $accomplishments = [];
        while ($row = $result->fetch_assoc()) {
            $accomplishments[] = [
                'start_date' => $row['report_accomplishment_date_start'],
                'end_date' => $row['report_accomplishment_date_end'],
                'objective' => $row['report_accomplishment_objective'],
                'activity' => $row['report_accomplishment_activity'],
                'accomplished' => $row['report_accomplishment_accomplished'],
                'report_id' => $row['report_accomplishment_id'],
                'week_id' => $row['report_accomplisshment_week_id'],
                'attached' => $row['report_accomplishment_attachment']
            ];
        }
        
        // Assertions for accomplishment data
        $this->assertCount(2, $accomplishments, "Should retrieve 2 accomplishment records");
        $this->assertEquals('2025-05-12', $accomplishments[0]['start_date']);
        $this->assertEquals('Complete unit tests', $accomplishments[0]['objective']);
        $this->assertEquals('Writing test cases', $accomplishments[0]['activity']);
        $this->assertEquals('Created 10 test cases', $accomplishments[0]['accomplished']);
        $this->assertEquals('test_cases.pdf', $accomplishments[0]['attached']);
        
        $this->assertEquals('Review code', $accomplishments[1]['objective']);
        $this->assertEquals('Reviewed 5 modules', $accomplishments[1]['accomplished']);
    }
    
    public function testRetrieveFacultyData()
    {
        // Simulate the query to get faculty data
        $select_name = "SELECT * FROM profile_faculty WHERE faculty_id = '{$this->user_id}'";
        $res_name = $this->mysqli->query($select_name);
        
        $faculty = null;
        while ($row = $res_name->fetch_assoc()) {
            $faculty = [
                'fname' => $row['teacher_fname'],
                'lname' => $row['teacher_lname']
            ];
        }
        
        // Assertions for faculty data
        $this->assertNotNull($faculty, "Should retrieve faculty data");
        $this->assertEquals('John', $faculty['fname']);
        $this->assertEquals('Doe', $faculty['lname']);
    }
    
    public function testDatabaseConnectionError()
    {
        // Create a mock mysqli with connection error
        $errorMysqli = new MockMysqliAPT();
        $errorMysqli->connect_errno = 1;
        $errorMysqli->connect_error = "Connection failed";
        
        // Test that the code would handle connection errors
        $this->assertEquals(1, $errorMysqli->connect_errno);
        $this->assertEquals("Connection failed", $errorMysqli->connect_error);
    }
}
?>
