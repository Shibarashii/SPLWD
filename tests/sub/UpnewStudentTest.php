<?php

use PHPUnit\Framework\TestCase;

class MockMysqliUpnewStudent {
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

class MockMysqliResultUpnewStudent {
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

class UpnewStudentTest extends TestCase
{
    private $conn;
    private $session;
    private $files;

    protected function setUp(): void
    {
        // Create mock mysqli connection
        $this->conn = new MockMysqliUpnewStudent();
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123',
            'school' => 'Test School'
        ];
        
        // Mock $_FILES
        $this->files = [
            'fileToUpload1' => [
                'name' => 'test1.pdf',
                'tmp_name' => '/tmp/test1.pdf',
                'error' => 0,
                'size' => 1024
            ],
            'fileToUpload2' => [
                'name' => 'test2.pdf',
                'tmp_name' => '/tmp/test2.pdf',
                'error' => 0,
                'size' => 1024
            ],
            'fileToUpload3' => [
                'name' => 'test3.pdf',
                'tmp_name' => '/tmp/test3.pdf',
                'error' => 0,
                'size' => 1024
            ],
            'fileToUpload4' => [
                'name' => 'test4.pdf',
                'tmp_name' => '/tmp/test4.pdf',
                'error' => 0,
                'size' => 1024
            ]
        ];
        
        // Set up POST data
        $_POST = [
            'submit' => true,
            'lrn' => '123456',
            'progress_year' => '2025',
            'folder_des' => 'Test Folder',
            'teacher_history' => 'Previous Teacher',
            'date_history' => '2024',
            'teacher' => 'Current Teacher',
            
            // Difficulty data
            'd1' => 'yes',
            'd2' => 'yes',
            'd3' => 'yes',
            'd4' => 'yes',
            'd5' => 'yes',
            'd6' => 'yes',
            'd_other' => 'yes',
            'others' => 'Other difficulties',
            'others_2' => 'Other difficulties 2',
            'medical_diagnos' => 'Medical diagnosis',
            'date_meeting' => '2025-05-19',
            'date_last_iep' => '2024-05-19',
            'purpose' => 'Test purpose',
            'review_date' => '2026-05-19',
            'comment' => 'Test comment',
            'grade' => '5',
            
            // Functional data
            'functional_1' => 'Functional 1',
            'functional_2' => 'Functional 2',
            'functional_3' => 'Functional 3',
            'functional_4' => 'Functional 4',
            'functional_12' => 'Functional 12',
            'functional_22' => 'Functional 22',
            'functional_32' => 'Functional 32',
            'functional_42' => 'Functional 42',
            'functional_13' => 'Functional 13',
            'functional_23' => 'Functional 23',
            'functional_33' => 'Functional 33',
            'functional_43' => 'Functional 43',
            'functional_14' => 'Functional 14',
            'functional_24' => 'Functional 24',
            'functional_34' => 'Functional 34',
            'functional_44' => 'Functional 44',
            'functional_15' => 'Functional 15',
            'functional_25' => 'Functional 25',
            'functional_35' => 'Functional 35',
            'functional_45' => 'Functional 45',
            
            'functional_1_1' => 'Functional 1_1',
            'functional_1_2' => 'Functional 1_2',
            'functional_1_3' => 'Functional 1_3',
            'functional_2_1' => 'Functional 2_1',
            'functional_2_2' => 'Functional 2_2',
            'functional_2_3' => 'Functional 2_3',
            'functional_3_1' => 'Functional 3_1',
            'functional_3_2' => 'Functional 3_2',
            'functional_3_3' => 'Functional 3_3',
            'functional_4_1' => 'Functional 4_1',
            'functional_4_2' => 'Functional 4_2',
            'functional_4_3' => 'Functional 4_3',
            'functional_5_1' => 'Functional 5_1',
            'functional_5_2' => 'Functional 5_2',
            'functional_5_3' => 'Functional 5_3',
            
            // Goals data
            'interest' => 'Interest 1',
            'goal' => 'Goal 1',
            'intervention' => 'Intervention 1',
            'timeline' => 'Timeline 1',
            'individual_responsible' => 'Responsible 1',
            'remarks' => 'Remarks 1',
            'progress' => 'Progress 1',
            
            'interest2' => 'Interest 2',
            'goal2' => 'Goal 2',
            'intervention2' => 'Intervention 2',
            'timeline2' => 'Timeline 2',
            'individual_responsible2' => 'Responsible 2',
            'remarks2' => 'Remarks 2',
            'progress2' => 'Progress 2',
            
            'interest3' => 'Interest 3',
            'goal3' => 'Goal 3',
            'intervention3' => 'Intervention 3',
            'timeline3' => 'Timeline 3',
            'individual_responsible3' => 'Responsible 3',
            'remarks3' => 'Remarks 3',
            'progress3' => 'Progress 3',
            
            'interest4' => 'Interest 4',
            'goal4' => 'Goal 4',
            'intervention4' => 'Intervention 4',
            'timeline4' => 'Timeline 4',
            'individual_responsible4' => 'Responsible 4',
            'remarks4' => 'Remarks 4',
            'progress4' => 'Progress 4',
            
            // Special factors
            'factor_1' => 'yes',
            'factor_2' => 'no',
            'factor_3' => 'yes',
            'comment_3' => 'Comment 3',
            'factor_4' => 'no',
            'comment_4' => 'Comment 4',
            'factor_5' => 'yes',
            'comment_5' => 'Comment 5',
            'factor_6' => 'no',
            'comment_6' => 'Comment 6',
            'factor_7' => 'yes',
            'comment_7' => 'Comment 7',
            'factor_8' => 'no',
            'comment_8' => 'Comment 8',
            'factor_8_type' => 'Braille',
            'factor_9' => 'yes',
            'comment_9' => 'Comment 9',
            
            // Team data
            'if_1' => 'yes',
            'dis_1' => 'yes',
            'psych' => 'Psychologist',
            'nurse' => 'Nurse',
            'therapist' => 'Therapist',
            'guidance' => 'Guidance',
            'other_name' => 'Other Name',
            'principal' => 'Principal',
            
            // Transition data
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
            
            // Student data
            'fname' => 'First',
            'lname' => 'Last',
            'mname' => 'Middle',
            'm_tounge' => 'English',
            'student_code' => 'S123',
            'birth_date' => '2010-01-01',
            'birth_place' => 'Birth Place',
            'gender' => 'Male',
            'address' => '123 Main St',
            'guardian' => 'Guardian Name',
            'work' => 'Guardian Work',
            'guardian_mtounge' => 'English',
            'guardian_contact' => '555-1234',
            'email' => 'student@example.com',
            'school' => 'Test School',
            'status' => 'Active',
            'category' => 'Regular',
            
            // Progress report data
            // Multiple progress report fields would be here
            '11' => 'Progress 1-1',
            '11q1' => 'Q1',
            '11q2' => 'Q2',
            '11q3' => 'Q3',
            '11q4' => 'Q4',
            '11q5' => 'Q5',
            
            // File upload data
            'year1' => '2025',
            'type1' => 'Document',
            'des1' => 'Description 1',
            'year2' => '2025',
            'type2' => 'Document',
            'des2' => 'Description 2',
            'year3' => '2025',
            'type3' => 'Document',
            'des3' => 'Description 3',
            'year4' => '2025',
            'type4' => 'Document',
            'des4' => 'Description 4',
            
            // Teacher remarks
            'tq1' => 'Teacher Remark Q1',
            'tq2' => 'Teacher Remark Q2',
            'tq3' => 'Teacher Remark Q3',
            'tq4' => 'Teacher Remark Q4',
            
            // Attendance data
            'june' => '20',
            'july' => '21',
            'aug' => '22',
            'sept' => '20',
            'oct' => '21',
            'nov' => '20',
            'dece' => '15',
            'jan' => '20',
            'feb' => '18',
            'mar' => '22',
            'april' => '20',
            'may' => '15',
            
            'june1' => '0',
            'july1' => '1',
            'aug1' => '2',
            'sept1' => '0',
            'oct1' => '1',
            'nov1' => '0',
            'dece1' => '3',
            'jan1' => '0',
            'feb1' => '2',
            'mar1' => '0',
            'april1' => '1',
            'may1' => '0'
        ];
        
        // Add progress report fields
        for ($i = 1; $i <= 25; $i++) {
            $_POST['1' . $i] = 'Progress 1-' . $i;
            $_POST['1' . $i . 'q1'] = 'Q1';
            $_POST['1' . $i . 'q2'] = 'Q2';
            $_POST['1' . $i . 'q3'] = 'Q3';
            $_POST['1' . $i . 'q4'] = 'Q4';
            $_POST['1' . $i . 'q5'] = 'Q5';
        }
        
        for ($i = 1; $i <= 20; $i++) {
            $_POST['2' . $i] = 'Progress 2-' . $i;
            $_POST['2' . $i . 'q1'] = 'Q1';
            $_POST['2' . $i . 'q2'] = 'Q2';
            $_POST['2' . $i . 'q3'] = 'Q3';
            $_POST['2' . $i . 'q4'] = 'Q4';
            $_POST['2' . $i . 'q5'] = 'Q5';
        }
        
        for ($i = 1; $i <= 18; $i++) {
            $_POST['3' . $i] = 'Progress 3-' . $i;
            $_POST['3' . $i . 'q1'] = 'Q1';
            $_POST['3' . $i . 'q2'] = 'Q2';
            $_POST['3' . $i . 'q3'] = 'Q3';
            $_POST['3' . $i . 'q4'] = 'Q4';
            $_POST['3' . $i . 'q5'] = 'Q5';
        }
        
        for ($i = 1; $i <= 23; $i++) {
            $_POST['4' . $i] = 'Progress 4-' . $i;
            $_POST['4' . $i . 'q1'] = 'Q1';
            $_POST['4' . $i . 'q2'] = 'Q2';
            $_POST['4' . $i . 'q3'] = 'Q3';
            $_POST['4' . $i . 'q4'] = 'Q4';
            $_POST['4' . $i . 'q5'] = 'Q5';
            
            $_POST['5' . $i] = 'Progress 5-' . $i;
            $_POST['5' . $i . 'q1'] = 'Q1';
            $_POST['5' . $i . 'q2'] = 'Q2';
            $_POST['5' . $i . 'q3'] = 'Q3';
            $_POST['5' . $i . 'q4'] = 'Q4';
            $_POST['5' . $i . 'q5'] = 'Q5';
        }
        
        for ($i = 1; $i <= 21; $i++) {
            $_POST['6' . $i] = 'Progress 6-' . $i;
            $_POST['6' . $i . 'q1'] = 'Q1';
            $_POST['6' . $i . 'q2'] = 'Q2';
            $_POST['6' . $i . 'q3'] = 'Q3';
            $_POST['6' . $i . 'q4'] = 'Q4';
            $_POST['6' . $i . 'q5'] = 'Q5';
        }
    }

    public function testCreateFolder()
    {
        $conn = $this->conn;
        $session = &$this->session;
        
        // Create folder
        $date111 = date('Y-m-d');
        $folder = "INSERT INTO `folder` (`folder_id`, `folder_year`, `lrn`, `teacher`, `date_added`, `description`) VALUES (NULL, '" . $_POST['progress_year'] . "', '" . $_POST['lrn'] . "', '" . $session['teacher_id'] . "', '" . $date111 . "', '" . $_POST['folder_des'] . "');";
        
        $result = $conn->query($folder);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testCreateTeacherHistory()
    {
        $conn = $this->conn;
        
        // Create teacher history
        $date12 = date('Y');
        $folder1 = "INSERT INTO `teacher_history` (`history_id`, `teacher`, `date`, `lrn`) VALUES (NULL, '" . $_POST['teacher_history'] . "', '" . $_POST['date_history'] . "', '" . $_POST['lrn'] . "');";
        
        $result = $conn->query($folder1);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Create current teacher history
        $folder1 = "INSERT INTO `teacher_history` (`history_id`, `teacher`, `date`, `lrn`) VALUES (NULL, '" . $_POST['teacher'] . "', '" . $date12 . "', '" . $_POST['lrn'] . "');";
        
        $result = $conn->query($folder1);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testCreateIEPDifficulty()
    {
        $conn = $this->conn;
        $session = &$this->session;
        
        // Process difficulty data
        $va1 = "";
        $va2 = "";
        $va3 = "";
        $va4 = "";
        $va5 = "";
        $va6 = "";
        $va7 = "";
        
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
        if (isset($_POST['d_other'])) {
            $va7 = $_POST['d_other'];
        }
        
        // Create IEP difficulty
        $sql = "INSERT INTO `iep_difficulty` (`iep_id`, `folder_id`, `teacher_id`, `lrn`, `d_seeing`, `d_hearing`, `d_com`, `d_moving`, `d_concentrating`, `d_remembering`, `others`, `others_2`, `medical_diagnos`, `date_meeting`, `date_last_iep`, `purpose`, `review_date`, `comment`, `grade`, `d_other`) VALUES (NULL, '789', '" . $session['teacher_id'] . "', '" . $_POST['lrn'] . "', '" . $va6 . "', '" . $va1 . "', '" . $va2 . "', '" . $va3 . "', '" . $va4 . "', '" . $va5 . "', '" . $_POST['others'] . "', '" . $_POST['others_2'] . "', '" . $_POST['medical_diagnos'] . "', '" . $_POST['date_meeting'] . "', '" . $_POST['date_last_iep'] . "', '" . $_POST['purpose'] . "', '" . $_POST['review_date'] . "','" . $_POST['comment'] . "','" . $_POST['grade'] . "','" . $va7 . "');";
        
        $result = $conn->query($sql);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testCreateBarriers()
    {
        $conn = $this->conn;
        
        // Create barriers
        $bar1 = "INSERT INTO `iep_barriers` (`barrier_id`, `iep_id`, `folder_id`, `lrn`, `barrier_1`, `barrier_2`, `barrier_3`, `barrier_4`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['functional_1'] . "', '" . $_POST['functional_2'] . "', '" . $_POST['functional_3'] . "', '" . $_POST['functional_4'] . "');";
        $bar2 = "INSERT INTO `iep_barriers` (`barrier_id`, `iep_id`, `folder_id`, `lrn`, `barrier_1`, `barrier_2`, `barrier_3`, `barrier_4`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['functional_12'] . "', '" . $_POST['functional_22'] . "', '" . $_POST['functional_32'] . "', '" . $_POST['functional_42'] . "');";
        $bar3 = "INSERT INTO `iep_barriers` (`barrier_id`, `iep_id`, `folder_id`, `lrn`, `barrier_1`, `barrier_2`, `barrier_3`, `barrier_4`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['functional_13'] . "', '" . $_POST['functional_23'] . "', '" . $_POST['functional_33'] . "', '" . $_POST['functional_43'] . "');";
        $bar4 = "INSERT INTO `iep_barriers` (`barrier_id`, `iep_id`, `folder_id`, `lrn`, `barrier_1`, `barrier_2`, `barrier_3`, `barrier_4`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['functional_14'] . "', '" . $_POST['functional_24'] . "', '" . $_POST['functional_34'] . "', '" . $_POST['functional_44'] . "');";
        $bar5 = "INSERT INTO `iep_barriers` (`barrier_id`, `iep_id`, `folder_id`, `lrn`, `barrier_1`, `barrier_2`, `barrier_3`, `barrier_4`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['functional_15'] . "', '" . $_POST['functional_25'] . "', '" . $_POST['functional_35'] . "', '" . $_POST['functional_45'] . "');";
        
        $result1 = $conn->query($bar1);
        $result2 = $conn->query($bar2);
        $result3 = $conn->query($bar3);
        $result4 = $conn->query($bar4);
        $result5 = $conn->query($bar5);
        
        // Assert that the queries were executed successfully
        $this->assertTrue($result1);
        $this->assertTrue($result2);
        $this->assertTrue($result3);
        $this->assertTrue($result4);
        $this->assertTrue($result5);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testCreateFunctional()
    {
        $conn = $this->conn;
        
        // Create functional
        $sql3 = "INSERT INTO `iep_functional` (`functional_id`, `iep_id`, `folder_id`, `lrn`, `functional_1`, `functional_2`, `functional_3`, `functional_4`, `functional_5`, `functional_1_2`, `functional_1_3`, `functional_2_2`, `functional_2_3`, `functional_3_2`, `functional_3_3`, `functional_4_2`, `functional_4_3`, `functional_5_2`, `functional_5_3`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['functional_1_1'] . "', '" . $_POST['functional_1_2'] . "', '" . $_POST['functional_1_3'] . "', '" . $_POST['functional_2_1'] . "', '" . $_POST['functional_2_2'] . "', '" . $_POST['functional_2_3'] . "', '" . $_POST['functional_3_1'] . "', '" . $_POST['functional_3_2'] . "', '" . $_POST['functional_3_3'] . "', '" . $_POST['functional_4_1'] . "', '" . $_POST['functional_4_2'] . "', '" . $_POST['functional_4_3'] . "', '" . $_POST['functional_5_1'] . "', '" . $_POST['functional_5_2'] . "', '" . $_POST['functional_5_3'] . "');";
        
        $result = $conn->query($sql3);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testCreateGoals()
    {
        $conn = $this->conn;
        
        // Create goals
        $goal1 = "INSERT INTO `iep_goals` (`goal_id`, `iep_id`, `folder_id`, `lrn`, `interest`, `goal`, `intervention`, `timeline`, `individual_responsible`, `remarks`, `progress`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['interest'] . "', '" . $_POST['goal'] . "', '" . $_POST['intervention'] . "', '" . $_POST['timeline'] . "', '" . $_POST['individual_responsible'] . "', '" . $_POST['remarks'] . "', '" . $_POST['progress'] . "');";
        $goal2 = "INSERT INTO `iep_goals` (`goal_id`, `iep_id`, `folder_id`, `lrn`, `interest`, `goal`, `intervention`, `timeline`, `individual_responsible`, `remarks`, `progress`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['interest2'] . "', '" . $_POST['goal2'] . "', '" . $_POST['intervention2'] . "', '" . $_POST['timeline2'] . "', '" . $_POST['individual_responsible2'] . "', '" . $_POST['remarks2'] . "', '" . $_POST['progress2'] . "');";
        $goal3 = "INSERT INTO `iep_goals` (`goal_id`, `iep_id`, `folder_id`, `lrn`, `interest`, `goal`, `intervention`, `timeline`, `individual_responsible`, `remarks`, `progress`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['interest3'] . "', '" . $_POST['goal3'] . "', '" . $_POST['intervention3'] . "', '" . $_POST['timeline3'] . "', '" . $_POST['individual_responsible3'] . "', '" . $_POST['remarks3'] . "', '" . $_POST['progress3'] . "');";
        $goal4 = "INSERT INTO `iep_goals` (`goal_id`, `iep_id`, `folder_id`, `lrn`, `interest`, `goal`, `intervention`, `timeline`, `individual_responsible`, `remarks`, `progress`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['interest4'] . "', '" . $_POST['goal4'] . "', '" . $_POST['intervention4'] . "', '" . $_POST['timeline4'] . "', '" . $_POST['individual_responsible4'] . "', '" . $_POST['remarks4'] . "', '" . $_POST['progress4'] . "');";
        
        $result1 = $conn->query($goal1);
        $result2 = $conn->query($goal2);
        $result3 = $conn->query($goal3);
        $result4 = $conn->query($goal4);
        
        // Assert that the queries were executed successfully
        $this->assertTrue($result1);
        $this->assertTrue($result2);
        $this->assertTrue($result3);
        $this->assertTrue($result4);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testCreateSpecialFactors()
    {
        $conn = $this->conn;
        
        // Create special factors
        $sql5 = "INSERT INTO `iep_special_factor` (`special_factor_id`, `iep_id`, `folder_id`, `lrn`, `factor_1`, `factor_2`, `factor_3`, `comment_3`, `factor_4`, `comment_4`, `factor_5`, `comment_5`, `factor_6`, `comment_6`, `factor_7`, `comment_7`, `factor_8`, `comment_8`, `factor_8_type`, `factor_9`, `comment_9`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['factor_1'] . "', '" . $_POST['factor_2'] . "', '" . $_POST['factor_3'] . "', '" . $_POST['comment_3'] . "', '" . $_POST['factor_4'] . "', '" . $_POST['comment_4'] . "', '" . $_POST['factor_5'] . "', '" . $_POST['comment_5'] . "', '" . $_POST['factor_6'] . "', '" . $_POST['comment_6'] . "', '" . $_POST['factor_7'] . "', '" . $_POST['comment_7'] . "', '" . $_POST['factor_8'] . "', '" . $_POST['comment_8'] . "', '" . $_POST['factor_8_type'] . "', '" . $_POST['factor_9'] . "', '" . $_POST['comment_9'] . "');";
        
        $result = $conn->query($sql5);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testCreateTeam()
    {
        $conn = $this->conn;
        
        // Process team data
        $if = '';
        $dis = '';
        if (isset($_POST['if_1'])) {
            $if = $_POST['if_1'];
        }
        if (isset($_POST['if_2'])) {
            $if = $_POST['if_2'];
        }
        if (isset($_POST['dis_1'])) {
            $dis = $_POST['dis_1'];
        }
        if (isset($_POST['dis_2'])) {
            $dis = $_POST['dis_2'];
        }
        
        // Create team
        $sql6 = "INSERT INTO `iep_team` (`team_id`, `iep_id`, `folder_id`, `lrn`, `psych`, `nurse`, `therapist`, `language`, `if_regular`, `date`, `guidance`, `other_name`, `principal`, `if_1`, `dis_1`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['psych'] . "', '" . $_POST['nurse'] . "', '" . $_POST['therapist'] . "', '', '', '" . $_POST['date_meeting'] . "', '" . $_POST['guidance'] . "', '" . $_POST['other_name'] . "', '" . $_POST['principal'] . "', '" . $if . "', '" . $dis . "');";
        
        $result = $conn->query($sql6);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testCreateTransitions()
    {
        $conn = $this->conn;
        
        // Create transitions
        $trans1 = "INSERT INTO `iep_transition` (`transition_id`, `iep_id`, `folder_id`, `lrn`, `interest`, `work`, `skills`, `individual_responsible`, `remarks`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['transition_interest'] . "', '" . $_POST['work1'] . "', '" . $_POST['skills'] . "', '" . $_POST['individual'] . "', '" . $_POST['transition_remarks'] . "');";
        $trans2 = "INSERT INTO `iep_transition` (`transition_id`, `iep_id`, `folder_id`, `lrn`, `interest`, `work`, `skills`, `individual_responsible`, `remarks`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['transition_interest2'] . "', '" . $_POST['work2'] . "', '" . $_POST['skills2'] . "', '" . $_POST['individual2'] . "', '" . $_POST['transition_remarks2'] . "');";
        $trans3 = "INSERT INTO `iep_transition` (`transition_id`, `iep_id`, `folder_id`, `lrn`, `interest`, `work`, `skills`, `individual_responsible`, `remarks`) VALUES (NULL, '123','789', '" . $_POST['lrn'] . "', '" . $_POST['transition_interest3'] . "', '" . $_POST['work3'] . "', '" . $_POST['skills3'] . "', '" . $_POST['individual3'] . "', '" . $_POST['transition_remarks3'] . "');";
        
        $result1 = $conn->query($trans1);
        $result2 = $conn->query($trans2);
        $result3 = $conn->query($trans3);
        
        // Assert that the queries were executed successfully
        $this->assertTrue($result1);
        $this->assertTrue($result2);
        $this->assertTrue($result3);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testCreateNewStudent()
    {
        $conn = $this->conn;
        $session = &$this->session;
        
        // Hash password
        $pass = $_POST['lrn'];
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        
        // Create new student
        $new = "INSERT INTO `new_student` (`student_id`, `lrn`, `teacher_id`, `fname`, `lname`, `mname`, `m_tounge`, `student_code`, `birth_date`, `birth_place`, `gender`, `address`, `guardian`, `work`, `guardian_mtounge`, `gurdian_contact`, `email`, `school`, `teacher`, `enroll_status`, `password`, `category`) VALUES (NULL, '" . $_POST['lrn'] . "', '" . $session['teacher_id'] . "' ,'" . $_POST['fname'] . "' ,'" . $_POST['lname'] . "','" . $_POST['mname'] . "','" . $_POST['m_tounge'] . "', '" . $_POST['student_code'] . "', '" . $_POST['birth_date'] . "', '" . $_POST['birth_place'] . "', '" . $_POST['gender'] . "', '" . $_POST['address'] . "' ,'" . $_POST['guardian'] . "' ,'" . $_POST['work'] . "', '" . $_POST['guardian_mtounge'] . "', '" . $_POST['guardian_contact'] . "', '" . $_POST['email'] . "', '" . $_POST['school'] . "', '" . $_POST['teacher'] . "','" . $_POST['status'] . "','" . $hashed_pass . "','" . $_POST['category'] . "');";
        
        $result = $conn->query($new);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testCreateProgressReports()
    {
        $conn = $this->conn;
        
        // Test creating progress reports for type 1
        $type = 1;
        $progress = "INSERT INTO `progress_report` (`progress_id`, `folder_id`, `lrn`, `year` , `progress_index`, `type`, `q1`, `q2`, `q3`, `q4` , `q5`) VALUES (NULL,'789' ,'" . $_POST['lrn'] . "','" . $_POST['progress_year'] . "',1, '" . $_POST['1' . $type] . "', '" . $_POST['1' . $type . 'q1'] . "', '" . $_POST['1' . $type . 'q2'] . "', '" . $_POST['1' . $type . 'q3'] . "', '" . $_POST['1' . $type . 'q4'] . "', '" . $_POST['1' . $type . 'q5'] . "');";
        
        $result = $conn->query($progress);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testCreateTeacherRemarks()
    {
        $conn = $this->conn;
        $session = &$this->session;
        
        // Create teacher remarks
        $date3 = date('Y-m-d');
        $remark = "INSERT INTO `teachers_remark` (`remark_id` ,`folder_id`, `year`, `lrn`, `teacher_id`, `remark_q1`, `remark_q2`, `remark_q3`, `remark_q4`, `date`) VALUES (NULL,'789','" . $_POST['progress_year'] . "' ,'" . $_POST['lrn'] . "', '" . $session['teacher_id'] . "', '" . $_POST['tq1'] . "', '" . $_POST['tq2'] . "', '" . $_POST['tq3'] . "', '" . $_POST['tq4'] . "', '" . $date3 . "');";
        
        $result = $conn->query($remark);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testCreateLog()
    {
        $conn = $this->conn;
        $session = &$this->session;
        
        // Create log
        $uploaded = "Uploaded 4 Files";
        $date = date('Y-m-d h:i:sa');
        $sql123 = "INSERT INTO `log` (`log_id`, `date`, `teacher_id`, `action_type`, `details`, `previous`, `updated`, `student_id`, `status`, `school`) VALUES (NULL, '" . $date . "', '" . $session['teacher_id'] . "', 'Added New Student', '" . $uploaded . "', '', '', '" . $_POST['lrn'] . "', '','" . $session['school'] . "');";
        
        $result = $conn->query($sql123);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testCreateAttendance()
    {
        $conn = $this->conn;
        $session = &$this->session;
        
        // Create attendance
        $files3 = "INSERT INTO `attendance` (`attendance_id`, `folder_id`, `lrn`, `teacher_id`, `type`, `june`, `july`, `aug`, `sept`, `oct`, `nov`, `dece`, `jan`, `feb`, `mar`, `apr`, `may`)
             VALUES (NULL, '789', '" . $_POST['lrn'] . "', '" . $session['teacher_id'] . "', 1, '" . $_POST['june'] . "', '" . $_POST['july'] . "', '" . $_POST['aug'] . "', '" . $_POST['sept'] . "', '" . $_POST['oct'] . "', '" . $_POST['nov'] . "', '" . $_POST['dece'] . "', '" . $_POST['jan'] . "', '" . $_POST['feb'] . "', '" . $_POST['mar'] . "', '" . $_POST['april'] . "', '" . $_POST['may'] . "');";
        
        $result = $conn->query($files3);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
        
        // Create attendance type 2
        $files3 = "INSERT INTO `attendance` (`attendance_id`, `folder_id`, `lrn`, `teacher_id`, `type`, `june`, `july`, `aug`, `sept`, `oct`, `nov`, `dece`, `jan`, `feb`, `mar`, `apr`, `may`)
                VALUES (NULL, '789', '" . $_POST['lrn'] . "', '" . $session['teacher_id'] . "', 2, '" . $_POST['june1'] . "', '" . $_POST['july1'] . "', '" . $_POST['aug1'] . "', '" . $_POST['sept1'] . "', '" . $_POST['oct1'] . "', '" . $_POST['nov1'] . "', '" . $_POST['dece1'] . "', '" . $_POST['jan1'] . "', '" . $_POST['feb1'] . "', '" . $_POST['mar1'] . "', '" . $_POST['april1'] . "', '" . $_POST['may1'] . "');";
        
        $result = $conn->query($files3);
        
        // Assert that the query was executed successfully
        $this->assertTrue($result);
        $this->assertEquals(1, $conn->affected_rows);
    }
    
    public function testFailure()
    {
        // Create mock mysqli connection that will fail
        $conn = new MockMysqliUpnewStudent(false);
        $session = &$this->session;
        
        // Try to create folder
        $date111 = date('Y-m-d');
        $folder = "INSERT INTO `folder` (`folder_id`, `folder_year`, `lrn`, `teacher`, `date_added`, `description`) VALUES (NULL, '" . $_POST['progress_year'] . "', '" . $_POST['lrn'] . "', '" . $session['teacher_id'] . "', '" . $date111 . "', '" . $_POST['folder_des'] . "');";
        
        $result = $conn->query($folder);
        
        // Assert that the query failed
        $this->assertFalse($result);
        $this->assertEquals('Mock database error', $conn->error);
    }
}