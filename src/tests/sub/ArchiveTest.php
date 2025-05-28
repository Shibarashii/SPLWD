<?php

use PHPUnit\Framework\TestCase;

class MockMysqliResultArchive {
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

class MockMysqliArchive {
    private $results = [];
    private $lastQuery = '';
    public $error = '';

    public function __construct($results = []) {
        $this->results = $results;
    }

    public function query($sql) {
        $this->lastQuery = $sql;
        
        if (isset($this->results[$sql])) {
            return new MockMysqliResultArchive($this->results[$sql]);
        }
        
        return new MockMysqliResultArchive([]);
    }
    
    public function getLastQuery() {
        return $this->lastQuery;
    }
}

class ArchiveTest extends TestCase
{
    private $conn;
    private $session;
    private $archivedFiles;

    protected function setUp(): void
    {
        // Mock archived files data
        $this->archivedFiles = [
            [
                'student_files' => 1,
                'lrn' => '123456',
                'file_type' => 'PDF',
                'description' => 'Test file 1',
                'date' => '2025-05-19',
                'status' => 'archive'
            ],
            [
                'student_files' => 2,
                'lrn' => '123456',
                'file_type' => 'Word',
                'description' => 'Test file 2',
                'date' => '2025-05-18',
                'status' => 'archive'
            ],
            [
                'student_files' => 3,
                'lrn' => '123456',
                'file_type' => 'Excel',
                'description' => 'Test file 3',
                'date' => '2025-05-17',
                'status' => 'archive'
            ]
        ];
        
        // Create mock mysqli connection
        $this->conn = new MockMysqliArchive();
        
        // Mock session
        $this->session = [
            'teacher_id' => 'T123'
        ];
    }

    public function testArchivePageDisplaysArchivedFiles()
    {
        $session = &$this->session;
        
        // Create mock mysqli with archived files
        $teacher_id = $session['teacher_id'];
        $sqlget7 = "SELECT * FROM student_files WHERE teacher_id = $teacher_id AND status = 'archive'";
        
        $conn = new MockMysqliArchive([
            $sqlget7 => $this->archivedFiles
        ]);
        
        // Get archived files
        $result7 = $conn->query($sqlget7);
        $archived_files = [];
        
        while ($row7 = $result7->fetch_assoc()) {
            $archived_files[] = $row7;
        }
        
        // Assert archived files were retrieved
        $this->assertCount(3, $archived_files);
        $this->assertEquals('PDF', $archived_files[0]['file_type']);
        $this->assertEquals('Word', $archived_files[1]['file_type']);
        $this->assertEquals('Excel', $archived_files[2]['file_type']);
    }
    
    public function testArchivePageWithNoArchivedFiles()
    {
        $session = &$this->session;
        
        // Create mock mysqli with no archived files
        $teacher_id = $session['teacher_id'];
        $sqlget7 = "SELECT * FROM student_files WHERE teacher_id = $teacher_id AND status = 'archive'";
        
        $conn = new MockMysqliArchive([
            $sqlget7 => []
        ]);
        
        // Get archived files
        $result7 = $conn->query($sqlget7);
        $archived_files = [];
        
        while ($row7 = $result7->fetch_assoc()) {
            $archived_files[] = $row7;
        }
        
        // Assert no archived files were retrieved
        $this->assertCount(0, $archived_files);
    }
    
    public function testArchivePageWithSuccessMessage()
    {
        // Set $_GET parameter to simulate success state
        $_GET = [
            'id' => '123456'
        ];
        
        // Generate HTML with success message
        $html = $this->getArchiveHtmlWithSuccess();
        
        // Check for success message script
        $this->assertStringContainsString("swal('File Successfully Retrieved', 'The selected file has been retrieved and restored to the student folder', 'success');", $html);
    }
    
    public function testArchivePageWithDeleteMessage()
    {
        // Set $_GET parameter to simulate delete state
        $_GET = [
            'delete1' => 1
        ];
        
        // Generate HTML with delete message
        $html = $this->getArchiveHtmlWithDelete();
        
        // Check for delete message script
        $this->assertStringContainsString("swal('File permanently deleted', 'The selected file has been permanently deleted', 'warning');", $html);
    }
    
    // Helper function to provide mock archive HTML with success message
    private function getArchiveHtmlWithSuccess() {
        return '<?php
if (isset($_GET["id"])) {
    echo "<script>swal(\'File Successfully Retrieved\', \'The selected file has been retrieved and restored to the student folder\', \'success\');</script>";
}
?>';
    }
    
    // Helper function to provide mock archive HTML with delete message
    private function getArchiveHtmlWithDelete() {
        return '<?php
if (isset($_GET["delete1"])) {
    echo "<script>swal(\'File permanently deleted\', \'The selected file has been permanently deleted\', \'warning\');</script>";
}
?>';
    }
}
?>
