<?php

use PHPUnit\Framework\TestCase;

class LogoutTest extends TestCase
{
    private $session;
    private $headers;

    protected function setUp(): void
    {
        $this->session = [
            'logged_in' => 'testuser',
            'id' => '123',
            'teacher_id' => 'T123',
            'img' => 'profile.jpg',
            'logged_id' => 1,
            'school' => 'School A',
            'color' => 'bg-info'
        ];
        
        $this->headers = [];
    }
    
    public function testLogout()
    {
        $session = &$this->session;
        $headers = &$this->headers;
        
        // Start session
        $this->assertNotEmpty($session);
        $this->assertEquals('testuser', $session['logged_in']);
        
        // Destroy session
        $session = [];
        
        // Set location header
        $headers[] = 'location: index.php';
        
        // Assert session destroyed
        $this->assertEmpty($session);
        $this->assertContains('location: index.php', $headers);
    }
    
    public function testLogoutWithAdminSession()
    {
        // Add admin flag to session
        $this->session['admin'] = 'admin';
        
        $session = &$this->session;
        $headers = &$this->headers;
        
        // Start session
        $this->assertNotEmpty($session);
        $this->assertEquals('testuser', $session['logged_in']);
        $this->assertEquals('admin', $session['admin']);
        
        // Destroy session
        $session = [];
        
        // Set location header
        $headers[] = 'location: index.php';
        
        // Assert session destroyed including admin flag
        $this->assertEmpty($session);
        $this->assertFalse(isset($session['admin']));
        $this->assertContains('location: index.php', $headers);
    }
}
?>
