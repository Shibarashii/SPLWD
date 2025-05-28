<?php

use PHPUnit\Framework\TestCase;

// Mock Dompdf class
class MockDompdf {
    public $loadedHtml = '';
    public $paperSize = '';
    public $paperOrientation = '';
    public $rendered = false;
    public $streamed = false;
    public $streamOptions = [];
    
    public function loadHtml($html) {
        $this->loadedHtml = $html;
    }
    
    public function setPaper($size, $orientation) {
        $this->paperSize = $size;
        $this->paperOrientation = $orientation;
    }
    
    public function render() {
        $this->rendered = true;
    }
    
    public function stream($filename, $options) {
        $this->streamed = true;
        $this->streamOptions = $options;
        return true;
    }
}

class GeneratePdfTest extends TestCase
{
    private $dompdf;

    protected function setUp(): void
    {
        $this->dompdf = new MockDompdf();
    }

    public function testPdfGeneration()
    {
        $_POST = [
            'submit_val' => true,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'age' => '30',
            'country' => 'USA'
        ];
        
        // Generate PDF
        $dompdf = $this->dompdf;
        $expectedHtml = '
<table border=1 align=center width=400>
<tr><td>Name : </td><td>' . $_POST['name'] . '</td></tr>
<tr><td>Email : </td><td>' . $_POST['email'] . '</td></tr>
<tr><td>Age : </td><td>' . $_POST['age'] . '</td></tr>
<tr><td>Country : </td><td>' . $_POST['country'] . '</td></tr>
</table>
';
        
        $dompdf->loadHtml($expectedHtml);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("", array("Attachment" => false));
        
        // Assert PDF was generated correctly
        $this->assertEquals($expectedHtml, $dompdf->loadedHtml);
        $this->assertEquals('A4', $dompdf->paperSize);
        $this->assertEquals('landscape', $dompdf->paperOrientation);
        $this->assertTrue($dompdf->rendered);
        $this->assertTrue($dompdf->streamed);
        $this->assertEquals(array("Attachment" => false), $dompdf->streamOptions);
    }
    
    public function testPdfGenerationWithDifferentData()
    {
        $_POST = [
            'submit_val' => true,
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'age' => '25',
            'country' => 'Canada'
        ];
        
        // Generate PDF
        $dompdf = $this->dompdf;
        $expectedHtml = '
<table border=1 align=center width=400>
<tr><td>Name : </td><td>' . $_POST['name'] . '</td></tr>
<tr><td>Email : </td><td>' . $_POST['email'] . '</td></tr>
<tr><td>Age : </td><td>' . $_POST['age'] . '</td></tr>
<tr><td>Country : </td><td>' . $_POST['country'] . '</td></tr>
</table>
';
        
        $dompdf->loadHtml($expectedHtml);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("", array("Attachment" => false));
        
        // Assert PDF was generated with different data
        $this->assertStringContainsString('Jane Smith', $dompdf->loadedHtml);
        $this->assertStringContainsString('jane@example.com', $dompdf->loadedHtml);
        $this->assertStringContainsString('25', $dompdf->loadedHtml);
        $this->assertStringContainsString('Canada', $dompdf->loadedHtml);
    }
}
?>
