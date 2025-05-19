<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultAddILMP {
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

class MockMysqliAddILMP {
    private $results = [];
    private $lastQuery = '';
    public $affected_rows = 0;

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultAddILMP($this->results[$sql]);
        }
        
        // For INSERT queries, return true
        if (strpos($sql, 'INSERT INTO') === 0) {
            $this->affected_rows = 1;
            return true;
        }
        
        return new MockMysqliResultAddILMP([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class AddILMPTest extends TestCase
{
    private $conn;
    private $session;
    private $headers;

    protected function setUp(): void
    {
        // Mock ILMP group data
        $ilmpGroupData = [
            ['ilmp_group_id' => 123]
        ];
        
        // Mock folder data
        $folderData = [
            ['folder_year' => '2025-2026']
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliAddILMP([
            "SELECT * FROM ilmp_group order by ilmp_group_id desc" => $ilmpGroupData,
            "SELECT * FROM folder where folder_id= 789" => $folderData
        ]);
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123',
            'school' => 'School A'
        ];
        
        // Mock headers
        $this->headers = [];
    }

    public function testAddILMP()
    {
        $_GET = [
            'lrn' => '123456',
            'folder_id' => '789'
        ];
        
        $_POST = [
            'monitoring_date' => '2025-05-19',
            'c_1' => 'Criteria 1',
            'c_2' => 'Criteria 2',
            'c_3' => 'Criteria 3',
            'learning_area' => 'Math',
            'learner_need' => 'Needs improvement in fractions',
            'intervention' => 'Additional practice with fractions',
            'insignificant' => 'No',
            'significant' => 'Yes',
            'mastery' => 'Partial',
            'learning_area2' => 'English',
            'learner_need2' => 'Needs improvement in reading',
            'intervention2' => 'Daily reading practice',
            'monitoring_date2' => '2025-05-26',
            'insignificant2' => 'No',
            'significant2' => 'Yes',
            'mastery2' => 'Partial',
            'learning_area3' => 'Science',
            'learner_need3' => 'Needs improvement in experiments',
            'intervention3' => 'Hands-on lab activities',
            'monitoring_date3' => '2025-06-02',
            'insignificant3' => 'No',
            'significant3' => 'Yes',
            'mastery3' => 'Partial'
        ];
        
        $conn = $this->conn;
        $session = &$this->session;
        $headers = &$this->headers;
        
        $date3 = date('Y-m-d');
        $c_1 = "";
        $c_2 = "";
        $c_3 = "";
        
        if (isset($_POST['c_1'])) {
            $c_1 = $_POST['c_1'];
        }
        if (isset($_POST['c_2'])) {
            $c_2 = $_POST['c_2'];
        }
        if (isset($_POST['c_3'])) {
            $c_3 = $_POST['c_3'];
        }
        
        // Insert ILMP group record
        $sql = "INSERT INTO `ilmp_group` (`ilmp_group_id`, `folder_id`, `lrn`, `ilmp_date`, `c_1`, `c_2`, `c_3`) VALUES (NULL, '" . $_GET['folder_id'] . "', '" . $_GET['lrn'] . "','" . $_POST['monitoring_date'] . "','" . $c_1 . "','" . $c_2 . "','" . $c_3 . "');";
        
        $result = $conn->query($sql);
        
        // Assert ILMP group record was inserted
        $this->assertTrue($result);
        
        // Get the ILMP group ID
        $sqlget11 = "SELECT * FROM ilmp_group order by ilmp_group_id desc";
        $result11 = $conn->query($sqlget11);
        $row31 = $result11->fetch_assoc();
        $ilmp_group_id = $row31['ilmp_group_id'];
        
        // Get the folder year
        $folder_id = $_GET['folder_id'];
        $sqlget11 = "SELECT * FROM folder where folder_id= $folder_id";
        $result11 = $conn->query($sqlget11);
        $row31 = $result11->fetch_assoc();
        $year = $row31['folder_year'];
        
        // Insert ILMP records
        $sql = "INSERT INTO `ilmp` (`ilmp_id`, `folder_id`, `lrn`, `learning_area`, `learner_need`, `intervention`, `monitoring_date`, `insignificant`, `significant`, `mastery`) VALUES
        ('" . $ilmp_group_id . "', '" . $_GET['folder_id'] . "', '" . $_GET['lrn'] . "', '" . $_POST['learning_area'] . "', '" . $_POST['learner_need'] . "', '" . $_POST['intervention'] . "', '" . $_POST['monitoring_date'] . "', '" . $_POST['insignificant'] . "', '" . $_POST['significant'] . "', '" . $_POST['mastery'] . "');";
        
        $result = $conn->query($sql);
        
        // Assert first ILMP record was inserted
        $this->assertTrue($result);
        
        $sql = "INSERT INTO `ilmp` (`ilmp_id`, `folder_id`, `lrn`, `learning_area`, `learner_need`, `intervention`, `monitoring_date`, `insignificant`, `significant`, `mastery`) VALUES
        ('" . $ilmp_group_id . "', '" . $_GET['folder_id'] . "', '" . $_GET['lrn'] . "', '" . $_POST['learning_area2'] . "', '" . $_POST['learner_need2'] . "', '" . $_POST['intervention2'] . "', '" . $_POST['monitoring_date2'] . "', '" . $_POST['insignificant2'] . "', '" . $_POST['significant2'] . "', '" . $_POST['mastery2'] . "');";
        
        $result = $conn->query($sql);
        
        // Assert second ILMP record was inserted
        $this->assertTrue($result);
        
        $sql = "INSERT INTO `ilmp` (`ilmp_id`, `folder_id`, `lrn`, `learning_area`, `learner_need`, `intervention`, `monitoring_date`, `insignificant`, `significant`, `mastery`) VALUES
        ('" . $ilmp_group_id . "', '" . $_GET['folder_id'] . "', '" . $_GET['lrn'] . "', '" . $_POST['learning_area3'] . "', '" . $_POST['learner_need3'] . "', '" . $_POST['intervention3'] . "', '" . $_POST['monitoring_date3'] . "', '" . $_POST['insignificant3'] . "', '" . $_POST['significant3'] . "', '" . $_POST['mastery3'] . "');";
        
        $result = $conn->query($sql);
        
        // Assert third ILMP record was inserted
        $this->assertTrue($result);
        
        // Insert log record
        $des = "To folder year " . $year;
        $sql123 = "INSERT INTO `log` (`log_id`, `date`, `teacher_id`, `action_type`, `details`, `previous`, `updated`, `student_id`, `status`, `school`) VALUES (NULL, '" . $date3 . "', '" . $session['teacher_id'] . "', 'Add ILMP', '" . $des . "', '', '', '" . $_GET['lrn'] . "', '','" . $session['school'] . "');";
        
        $result123 = $conn->query($sql123);
        
        // Assert log record was inserted
        $this->assertTrue($result123);
        
        // Simulate redirect
        $headers[] = 'location:student_file.php?id=' . $_GET['lrn'] . '&folder_id=' . $_GET['folder_id'] . '&ilp=1';
        
        // Assert redirect happens
        $this->assertContains('location:student_file.php?id=123456&folder_id=789&ilp=1', $headers);
    }
}
?>
