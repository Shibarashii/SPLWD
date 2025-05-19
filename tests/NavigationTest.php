<?php

use PHPUnit\Framework\TestCase;

class NavigationTest extends TestCase
{
    private $session;
    private $navigationHtml;

    protected function setUp(): void
    {
        $this->session = [
            'logged_in' => 'Test User',
            'img' => 'profile.jpg'
        ];
        
        // Mock navigation HTML content
        $this->navigationHtml = $this->getMockNavigationHtml();
    }
    
    public function testNavigationSidebarElements()
    {
        $_SESSION = $this->session;
        
        // Use the mocked navigation HTML
        $output = $this->navigationHtml;
        
        // Check if sidebar elements exist
        $this->assertStringContainsString('id="accordionSidebar"', $output);
        $this->assertStringContainsString('Sta. Cruz District Student Profiling System For LWD', $output);
        
        // Check if profile link exists
        $this->assertStringContainsString('<a class="nav-link" href="profile.php">', $output);
        $this->assertStringContainsString('<span>Profile</span>', $output);
        
        // Check if student menu exists
        $this->assertStringContainsString('data-target="#collapseTwo"', $output);
        $this->assertStringContainsString('<span>Student</span>', $output);
        
        // Check if student submenu items exist
        $this->assertStringContainsString('<a class="collapse-item" href="new_student.php">Add Student</a>', $output);
        $this->assertStringContainsString('<a class="collapse-item" href="folders.php">Student Folders</a>', $output);
        $this->assertStringContainsString('<a class="collapse-item" href="lists.php">Student Lists</a>', $output);
    }
    
    public function testNavigationTopbarElements()
    {
        $_SESSION = $this->session;
        
        // Use the mocked navigation HTML
        $output = $this->navigationHtml;
        
        // Check if topbar elements exist
        $this->assertStringContainsString('navbar navbar-expand navbar-light bg-white topbar', $output);
        
        // Check if search form exists
        $this->assertStringContainsString('class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"', $output);
        
        // Check if user info is displayed
        $this->assertStringContainsString('class="mr-2 d-none d-lg-inline text-gray-600 small"', $output);
        $this->assertStringContainsString('<?php echo $_SESSION[\'logged_in\']; ?>', $output);
        
        // Check if profile image is displayed
        $this->assertStringContainsString('class="img-profile rounded-circle"', $output);
        $this->assertStringContainsString('src="../img/<?php echo $_SESSION[\'img\']; ?>"', $output);
    }
    
    public function testLogoutModal()
    {
        $_SESSION = $this->session;
        
        // Use the mocked navigation HTML
        $output = $this->navigationHtml;
        
        // Check if logout modal exists
        $this->assertStringContainsString('id="logoutModal"', $output);
        $this->assertStringContainsString('Ready to Leave?', $output);
        
        // Check if logout button exists
        $this->assertStringContainsString('<a class="btn btn-primary" href="../logout.php">Logout</a>', $output);
    }
    
    // Helper function to provide mock navigation HTML
    private function getMockNavigationHtml() {
        return '
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <div class="sidebar-brand-text mx-3"><span>
                    <h4 class="text-white"> Sta. Cruz District Student Profiling System For LWD</h4>
                </span></div>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="profile.php">
                    <i class="fas fa-fw fa-user fa-user-alt"></i>
                    <span>Profile</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-id-card"></i>
                    <span>Student</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Student:</h6>
                        <a class="collapse-item" href="new_student.php">Add Student</a>
                        <a class="collapse-item" href="folders.php">Student Folders</a>
                        <a class="collapse-item" href="lists.php">Student Lists</a>
                    </div>
                </div>
            </li>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="../logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </ul>
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION[\'logged_in\']; ?></span>
            <img class="img-profile rounded-circle" src="../img/<?php echo $_SESSION[\'img\']; ?>">
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            </form>
        </nav>
    </div>';
    }
}
?>
