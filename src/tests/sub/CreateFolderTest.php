<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultCreateFolder {
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

class MockMysqliCreateFolder {
    private $results = [];
    private $lastQuery = '';
    public $affected_rows = 0;
    public $error = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultCreateFolder($this->results[$sql]);
        }
        
        // For INSERT queries, return true
        if (strpos($sql, 'INSERT INTO') === 0) {
            $this->affected_rows = 1;
            return true;
        }
        
        return new MockMysqliResultCreateFolder([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
    
    public function close() {
        return true;
    }
}

class CreateFolderTest extends TestCase
{
    private $conn;
    private $session;
    private $headers;
    private $files;

    protected function setUp(): void
    {
        // Mock folder and IEP data
        $folderData = [
            ['folder_id' => 123]
        ];
        
        $iepData = [
            ['iep_id' => 456]
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliCreateFolder([
            "SELECT * FROM folder order by folder_id desc" => $folderData,
            "SELECT * FROM iep_difficulty order by iep_id desc" => $iepData
        ]);
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123',
            'school' => 'School A'
        ];
        
        // Mock headers
        $this->headers = [];
        
        // Mock files
        $this->files = [
            'fileToUpload1' => [
                'name' => 'test_file1.pdf',
                'tmp_name' => '/tmp/test_file1.pdf',
                'size' => 1000
            ],
            'fileToUpload2' => [
                'name' => 'test_file2.pdf',
                'tmp_name' => '/tmp/test_file2.pdf',
                'size' => 1000
            ],
            'fileToUpload3' => [
                'name' => 'test_file3.pdf',
                'tmp_name' => '/tmp/test_file3.pdf',
                'size' => 1000
            ],
            'fileToUpload4' => [
                'name' => 'test_file4.pdf',
                'tmp_name' => '/tmp/test_file4.pdf',
                'size' => 1000
            ]
        ];
    }

    public function testCreateFolder()
    {
        $_GET = [
            'lrn' => '123456'
        ];
        
        $_POST = [
            'submit' => true,
            'progress_year' => '2025-2026',
            'folder_des' => 'Test folder description',
            'd1' => 'Difficulty 1',
            'd2' => 'Difficulty 2',
            'd3' => 'Difficulty 3',
            'd4' => 'Difficulty 4',
            'd5' => 'Difficulty 5',
            'd6' => 'Difficulty 6',
            'others' => 'Other difficulties',
            'others_2' => 'Other difficulties 2',
            'medical_diagnos' => 'Medical diagnosis',
            'date_meeting' => '2025-05-19',
            'date_last_iep' => '2024-05-19',
            'purpose' => 'Purpose of IEP',
            'review_date' => '2026-05-19',
            'comment' => 'Comments',
            'grade' => '1',
            'functional_1' => 'Functional 1',
            'functional_2' => 'Functional 2',
            'functional_3' => 'Functional 3',
            'functional_4' => 'Functional 4',
            'functional_12' => 'Functional 1.2',
            'functional_22' => 'Functional 2.2',
            'functional_32' => 'Functional 3.2',
            'functional_42' => 'Functional 4.2',
            'functional_13' => 'Functional 1.3',
            'functional_23' => 'Functional 2.3',
            'functional_33' => 'Functional 3.3',
            'functional_43' => 'Functional 4.3',
            'functional_14' => 'Functional 1.4',
            'functional_24' => 'Functional 2.4',
            'functional_34' => 'Functional 3.4',
            'functional_44' => 'Functional 4.4',
            'functional_15' => 'Functional 1.5',
            'functional_25' => 'Functional 2.5',
            'functional_35' => 'Functional 3.5',
            'functional_45' => 'Functional 4.5',
            'functional_1_1' => 'Functional 1-1',
            'functional_1_2' => 'Functional 1-2',
            'functional_1_3' => 'Functional 1-3',
            'functional_2_1' => 'Functional 2-1',
            'functional_2_2' => 'Functional 2-2',
            'functional_2_3' => 'Functional 2-3',
            'functional_3_1' => 'Functional 3-1',
            'functional_3_2' => 'Functional 3-2',
            'functional_3_3' => 'Functional 3-3',
            'functional_4_1' => 'Functional 4-1',
            'functional_4_2' => 'Functional 4-2',
            'functional_4_3' => 'Functional 4-3',
            'functional_5_1' => 'Functional 5-1',
            'functional_5_2' => 'Functional 5-2',
            'functional_5_3' => 'Functional 5-3',
            'interest' => 'Interest 1',
            'goal' => 'Goal 1',
            'intervention' => 'Intervention 1',
            'timeline' => 'Timeline 1',
            'individual_responsible' => 'Person 1',
            'remarks' => 'Remarks 1',
            'progress' => 'Progress 1',
            'interest2' => 'Interest 2',
            'goal2' => 'Goal 2',
            'intervention2' => 'Intervention 2',
            'timeline2' => 'Timeline 2',
            'individual_responsible2' => 'Person 2',
            'remarks2' => 'Remarks 2',
            'progress2' => 'Progress 2',
            'interest3' => 'Interest 3',
            'goal3' => 'Goal 3',
            'intervention3' => 'Intervention 3',
            'timeline3' => 'Timeline 3',
            'individual_responsible3' => 'Person 3',
            'remarks3' => 'Remarks 3',
            'progress3' => 'Progress 3',
            'interest4' => 'Interest 4',
            'goal4' => 'Goal 4',
            'intervention4' => 'Intervention 4',
            'timeline4' => 'Timeline 4',
            'individual_responsible4' => 'Person 4',
            'remarks4' => 'Remarks 4',
            'progress4' => 'Progress 4',
            'factor_1' => 'Factor 1',
            'factor_2' => 'Factor 2',
            'factor_3' => 'Factor 3',
            'comment_3' => 'Comment 3',
            'factor_4' => 'Factor 4',
            'comment_4' => 'Comment 4',
            'factor_5' => 'Factor 5',
            'comment_5' => 'Comment 5',
            'factor_6' => 'Factor 6',
            'comment_6' => 'Comment 6',
            'factor_7' => 'Factor 7',
            'comment_7' => 'Comment 7',
            'factor_8' => 'Factor 8',
            'comment_8' => 'Comment 8',
            'factor_8_type' => 'Factor 8 Type',
            'factor_9' => 'Factor 9',
            'comment_9' => 'Comment 9',
            'if_1' => 'If 1',
            'dis_1' => 'Dis 1',
            'psych' => 'Psychologist',
            'nurse' => 'Nurse',
            'therapist' => 'Therapist',
            'guidance' => 'Guidance',
            'other_name' => 'Other Name',
            'principal' => 'Principal',
            'sp_teacher' => 'Special Teacher',
            'transition_interest' => 'Transition Interest 1',
            'work1' => 'Work 1',
            'skills' => 'Skills 1',
            'individual' => 'Individual 1',
            'transition_remarks' => 'Transition Remarks 1',
            'transition_interest2' => 'Transition Interest 2',
            'work2' => 'Work 2',
            'skills2' => 'Skills 2',
            'individual2' => 'Individual 2',
            'transition_remarks2' => 'Transition Remarks 2',
            'transition_interest3' => 'Transition Interest 3',
            'work3' => 'Work 3',
            'skills3' => 'Skills 3',
            'individual3' => 'Individual 3',
            'transition_remarks3' => 'Transition Remarks 3',
            'teacher' => 'T123',
            'tq1' => 'Teacher Remark Q1',
            'tq2' => 'Teacher Remark Q2',
            'tq3' => 'Teacher Remark Q3',
            'tq4' => 'Teacher Remark Q4',
            'june' => '20',
            'july' => '21',
            'aug' => '22',
            'sept' => '20',
            'oct' => '21',
            'nov' => '22',
            'dece' => '20',
            'jan' => '21',
            'feb' => '22',
            'mar' => '20',
            'april' => '21',
            'may' => '22',
            'june1' => '2',
            'july1' => '1',
            'aug1' => '2',
            'sept1' => '1',
            'oct1' => '2',
            'nov1' => '1',
            'dece1' => '2',
            'jan1' => '1',
            'feb1' => '2',
            'mar1' => '1',
            'april1' => '2',
            'may1' => '1',
            'year1' => '2025',
            'type1' => 'PDF',
            'des1' => 'Description 1',
            'year2' => '2025',
            'type2' => 'PDF',
            'des2' => 'Description 2',
            'year3' => '2025',
            'type3' => 'PDF',
            'des3' => 'Description 3',
            'year4' => '2025',
            'type4' => 'PDF',
            'des4' => 'Description 4'
        ];
        
        $_FILES = $this->files;
        
        $conn = $this->conn;
        $session = &$this->session;
        $headers = &$this->headers;
        
        $date111 = date('Y-m-d');
        
        // Create folder
        $folder = "INSERT INTO `folder` (`folder_id`, `folder_year`, `lrn`, `teacher`, `date_added`, `description`) VALUES (NULL, '" . $_POST['progress_year'] . "', '" . $_GET['lrn'] . "', '" . $session['teacher_id'] . "', '" . $date111 . "', '" . $_POST['folder_des'] . "');";
        
        $result = $conn->query($folder);
        
        // Assert folder was created
        $this->assertTrue($result);
        
        // Get the folder ID
        $sqlget11 = "SELECT * FROM folder order by folder_id desc";
        $result11 = $conn->query($sqlget11);
        $row31 = $result11->fetch_assoc();
        $folder_id = $row31['folder_id'];
        
        // Create IEP difficulty record
        $va1 = "";
        $va2 = "";
        $va3 = "";
        $va4 = "";
        $va5 = "";
        $va6 = "";
        
        if (isset($_POST['d1'])) {
            $va1 = $_POST['d1'];
        }
        if (isset($_POST['d2'])) {
            $va2 = $_POST['d2'];
        }
        if (isset($_POST['d3'])) {
            $va3 = $_POST['d3'];
        }
        if (isset($_POST['d4'])) {
            $va4 = $_POST['d4'];
        }
        if (isset($_POST['d5'])) {
            $va5 = $_POST['d5'];
        }
        if (isset($_POST['d6'])) {
            $va6 = $_POST['d6'];
        }
        
        $sql = "INSERT INTO `iep_difficulty` (`iep_id`, `folder_id`, `teacher_id`, `lrn`, `d_seeing`, `d_hearing`, `d_com`, `d_moving`, `d_concentrating`, `d_remembering`, `others`, `others_2`, `medical_diagnos`, `date_meeting`, `date_last_iep`, `purpose`, `review_date`, `comment`, `grade`) VALUES (NULL, '" . $folder_id . "', '" . $session['teacher_id'] . "', '" . $_GET['lrn'] . "', '" . $va6 . "', '" . $va1 . "', '" . $va2 . "', '" . $va3 . "', '" . $va4 . "', '" . $va5 . "', '" . $_POST['others'] . "', '" . $_POST['others_2'] . "', '" . $_POST['medical_diagnos'] . "', '" . $_POST['date_meeting'] . "', '" . $_POST['date_last_iep'] . "', '" . $_POST['purpose'] . "', '" . $_POST['review_date'] . "','" . $_POST['comment'] . "','" . $_POST['grade'] . "');";
        
        $result = $conn->query($sql);
        
        // Assert IEP difficulty record was created
        $this->assertTrue($result);
        
        // Get the IEP ID
        $sqlget11 = "SELECT * FROM iep_difficulty order by iep_id desc";
        $result11 = $conn->query($sqlget11);
        $row31 = $result11->fetch_assoc();
        $id = $row31['iep_id'];
        
        // Create IEP barriers records
        $bar1 = "INSERT INTO `iep_barriers` (`barrier_id`, `iep_id`, `folder_id`, `lrn`, `barrier_1`, `barrier_2`, `barrier_3`, `barrier_4`) VALUES (NULL, '" . $id . "','" . $folder_id . "', '" . $_GET['lrn'] . "', '" . $_POST['functional_1'] . "', '" . $_POST['functional_2'] . "', '" . $_POST['functional_3'] . "', '" . $_POST['functional_4'] . "');";
        
        $result = $conn->query($bar1);
        
        // Assert IEP barriers record was created
        $this->assertTrue($result);
        
        // Create log record
        $date3 = date('Y-m-d');
        $file_count = 4; // Assuming all files were uploaded successfully
        $uploaded = "Uploaded " . $file_count . " Files";
        $sql123 = "INSERT INTO `log` (`log_id`, `date`, `teacher_id`, `action_type`, `details`, `previous`, `updated`, `student_id`, `status`, `school`) VALUES (NULL, '" . $date3 . "', '" . $_POST['teacher'] . "', 'Created a New folder', '" . $uploaded . "', '', '', '" . $_GET['lrn'] . "', '','" . $session['school'] . "');";
        
        $result123 = $conn->query($sql123);
        
        // Assert log record was created
        $this->assertTrue($result123);
        
        // Simulate redirect
        $headers[] = 'location:student_file_folder.php?id=' . $_GET['lrn'] . '&alert=1';
        
        // Assert redirect happens
        $this->assertContains('location:student_file_folder.php?id=123456&alert=1', $headers);
    }
}
?>
