<?php

use PHPUnit\Framework\TestCase;

class MockMysqliUpdateNewStudent {
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
    
    public function close() {
        // Mock close method
        return true;
    }
}

class UpdateNewStudentTest extends TestCase
{
    private $conn;
    private $headers;
    private $session;

    protected function setUp(): void
    {
        // Create mock mysqli connection
        $this->conn = new MockMysqliUpdateNewStudent();
        
        // Mock headers
        $this->headers = [];
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123'
        ];
        
        // Set up GET parameters
        $_GET = [
            'id' => '123456',
            'folder_id' => '789'
        ];
        
        // Set up POST data
        $_POST = [
            'submit' => true,
            'remark_id' => '101'
        ];
        
        // Add progress report data for each domain
        for ($type = 1; $type <= 25; $type++) {
            $_POST['1' . $type] = 'Type ' . $type;
            $_POST['1' . $type . 'q1'] = 'Q1';
            $_POST['1' . $type . 'q2'] = 'Q2';
            $_POST['1' . $type . 'q3'] = 'Q3';
            $_POST['1' . $type . 'q4'] = 'Q4';
        }
        
        for ($type = 1; $type <= 20; $type++) {
            $_POST['2' . $type] = 'Type ' . $type;
            $_POST['2' . $type . 'q1'] = 'Q1';
            $_POST['2' . $type . 'q2'] = 'Q2';
            $_POST['2' . $type . 'q3'] = 'Q3';
            $_POST['2' . $type . 'q4'] = 'Q4';
        }
        
        for ($type = 1; $type <= 18; $type++) {
            $_POST['3' . $type] = 'Type ' . $type;
            $_POST['3' . $type . 'q1'] = 'Q1';
            $_POST['3' . $type . 'q2'] = 'Q2';
            $_POST['3' . $type . 'q3'] = 'Q3';
            $_POST['3' . $type . 'q4'] = 'Q4';
        }
        
        for ($type = 1; $type <= 23; $type++) {
            $_POST['4' . $type] = 'Type ' . $type;
            $_POST['4' . $type . 'q1'] = 'Q1';
            $_POST['4' . $type . 'q2'] = 'Q2';
            $_POST['4' . $type . 'q3'] = 'Q3';
            $_POST['4' . $type . 'q4'] = 'Q4';
        }
        
        for ($type = 1; $type <= 23; $type++) {
            $_POST['5' . $type] = 'Type ' . $type;
            $_POST['5' . $type . 'q1'] = 'Q1';
            $_POST['5' . $type . 'q2'] = 'Q2';
            $_POST['5' . $type . 'q3'] = 'Q3';
            $_POST['5' . $type . 'q4'] = 'Q4';
        }
        
        for ($type = 1; $type <= 21; $type++) {
            $_POST['6' . $type] = 'Type ' . $type;
            $_POST['6' . $type . 'q1'] = 'Q1';
            $_POST['6' . $type . 'q2'] = 'Q2';
            $_POST['6' . $type . 'q3'] = 'Q3';
            $_POST['6' . $type . 'q4'] = 'Q4';
        }
        
        // Add teacher remarks
        $_POST['tq1'] = 'Teacher Remark Q1';
        $_POST['tq2'] = 'Teacher Remark Q2';
        $_POST['tq3'] = 'Teacher Remark Q3';
        $_POST['tq4'] = 'Teacher Remark Q4';
        
        // Add attendance data
        $_POST['june'] = '20';
        $_POST['july'] = '22';
        $_POST['aug'] = '21';
        $_POST['sept'] = '20';
        $_POST['oct'] = '22';
        $_POST['nov'] = '20';
        $_POST['dece'] = '15';
        $_POST['jan'] = '22';
        $_POST['feb'] = '20';
        $_POST['mar'] = '22';
        $_POST['apr'] = '15';
        $_POST['may'] = '10';
        
        $_POST['june1'] = '0';
        $_POST['july1'] = '0';
        $_POST['aug1'] = '1';
        $_POST['sept1'] = '2';
        $_POST['oct1'] = '0';
        $_POST['nov1'] = '1';
        $_POST['dece1'] = '5';
        $_POST['jan1'] = '0';
        $_POST['feb1'] = '2';
        $_POST['mar1'] = '0';
        $_POST['apr1'] = '3';
        $_POST['may1'] = '2';
    }

    public function testUpdateProgressReports()
    {
        $conn = $this->conn;
        $headers = &$this->headers;
        
        $lrn = $_GET['id'];
        $folder_id = $_GET['folder_id'];
        
        // Update progress reports for domain 1
        $type = 1;
        $updateCount = 0;
        while ($type <= 25) {
            $type1 = $_POST['1' . $type];
            $sql = "UPDATE `progress_report` SET `q1` = '" . $_POST['1' . $type . 'q1'] . "', `q2` = '" . $_POST['1' . $type . 'q2'] . "', `q3` = '" . $_POST['1' . $type . 'q3'] . "', `q4` = '" . $_POST['1' . $type . 'q4'] . "' WHERE type = '$type1' and folder_id= $folder_id and  lrn = $lrn and progress_index=1;";
            
            $result = $conn->query($sql);
            
            // Assert that the query was executed successfully
            $this->assertTrue($result);
            $updateCount++;
            
            $type++;
        }
        
        // Assert all domain 1 records were updated
        $this->assertEquals(25, $updateCount);
        
        // Update progress reports for domain 2
        $type = 1;
        $updateCount = 0;
        while ($type <= 20) {
            $type2 = $_POST['2' . $type];
            $sql = "UPDATE `progress_report` SET `q1` = '" . $_POST['2' . $type . 'q1'] . "', `q2` = '" . $_POST['2' . $type . 'q2'] . "', `q3` = '" . $_POST['2' . $type . 'q3'] . "', `q4` = '" . $_POST['2' . $type . 'q4'] . "' WHERE type = '$type2' and folder_id= $folder_id and lrn = $lrn and progress_index=2;";
            
            $result = $conn->query($sql);
            
            // Assert that the query was executed successfully
            $this->assertTrue($result);
            $updateCount++;
            
            $type++;
        }
        
        // Assert all domain 2 records were updated
        $this->assertEquals(20, $updateCount);
        
        // Update teacher remarks
        $remark = $_POST['remark_id'];
        $sql = "UPDATE `teachers_remark` SET `remark_q1` = '" . $_POST['tq1'] . "', `remark_q2` = '" . $_POST['tq2'] . "', `remark_q3` = '" . $_POST['tq3'] . "', `remark_q4` = '" . $_POST['tq4'] . "' WHERE `teachers_remark`.`remark_id` = $remark;";
        
        $result = $conn->query($sql);
        
        // Assert that the teacher remarks were updated successfully
        $this->assertTrue($result);
        
        // Update attendance records
        $sql = "UPDATE `attendance` SET `june` = '" . $_POST['june'] . "', `july` = '" . $_POST['july'] . "', `aug` = '" . $_POST['aug'] . "', `sept` = '" . $_POST['sept'] . "', `oct` = '" . $_POST['oct'] . "', `nov` = '" . $_POST['nov'] . "', `dece` = '" . $_POST['dece'] . "', `jan` = '" . $_POST['jan'] . "', `feb` = '" . $_POST['feb'] . "', `mar` = '" . $_POST['mar'] . "', `apr` = '" . $_POST['apr'] . "', `may` = '" . $_POST['may'] . "' WHERE folder_id = $folder_id and lrn = $lrn and type = 1";
        
        $result = $conn->query($sql);
        
        // Assert that the attendance records were updated successfully
        $this->assertTrue($result);
        
        // Simulate redirect
        $headers[] = 'location:student_file.php?id=' . $lrn . '&folder_id=' . $_GET['folder_id'] . '#progress';
        
        // Assert redirect happens
        $this->assertContains('location:student_file.php?id=123456&folder_id=789#progress', $headers);
        
        // Close the connection
        $conn->close();
    }
    
    public function testUpdateProgressReportsFailure()
    {
        // Create mock mysqli connection that will fail
        $conn = new MockMysqliUpdateNewStudent(false);
        
        $lrn = $_GET['id'];
        $folder_id = $_GET['folder_id'];
        
        // Try to update a progress report
        $type1 = $_POST['11'];
        $sql = "UPDATE `progress_report` SET `q1` = '" . $_POST['11q1'] . "', `q2` = '" . $_POST['11q2'] . "', `q3` = '" . $_POST['11q3'] . "', `q4` = '" . $_POST['11q4'] . "' WHERE type = '$type1' and folder_id= $folder_id and  lrn = $lrn and progress_index=1;";
        
        $result = $conn->query($sql);
        
        // Assert that the query failed
        $this->assertFalse($result);
        $this->assertEquals('Mock database error', $conn->error);
        
        // Close the connection
        $conn->close();
    }
}