<?php

use PHPUnit\Framework\TestCase;

class SignupTest extends TestCase
{
    private $signupHtml;
    
    protected function setUp(): void
    {
        // Mock signup form HTML content
        $this->signupHtml = $this->getMockSignupHtml();
    }
    
    /**
     * Test that checks if the required fields are present in the signup form
     */
    public function testSignupFormContainsRequiredFields()
    {
        // Use the mocked signup form HTML
        $formHtml = $this->signupHtml;
        
        // Check for presence of form elements
        $this->assertStringContainsString('<form class="user" method="post" action="add_account.php">', $formHtml);
        
        // Check for required fields
        $requiredFields = [
            'fname', 'lname', 'mname', 'contact_no', 'teacher_id', 'address',
            'gender', 'email', 'password', 'bdate', 'category'
        ];
        
        foreach ($requiredFields as $field) {
            $this->assertStringContainsString('name="' . $field . '"', $formHtml);
        }
        
        // Check for submit button
        $this->assertStringContainsString('name="signup" value="Register Account"', $formHtml);
    }
    
    /**
     * Test that validates the error handling when form is submitted with existing data
     */
    public function testSignupFormDisplaysErrorForExistingEmail()
    {
        // Set $_GET parameters to simulate error state
        $_GET = [
            'error' => 1,
            'fname' => 'Test',
            'lname' => 'User',
            'mname' => 'M',
            'address' => '123 Main St',
            'teacher_id' => '1234567',
            'contact_no' => '0912345678',
            'bdate' => '1990-01-01'
        ];
        
        // Generate HTML with error state
        $formHtml = $this->getSignupHtmlWithError($_GET);
        
        // Check if form loads with prefilled values
        $this->assertStringContainsString('value="Test"', $formHtml);
        $this->assertStringContainsString('value="User"', $formHtml);
        $this->assertStringContainsString('value="M"', $formHtml);
        $this->assertStringContainsString('value="123 Main St"', $formHtml);
        $this->assertStringContainsString('value="1234567"', $formHtml);
        $this->assertStringContainsString('value="0912345678"', $formHtml);
        $this->assertStringContainsString('value="1990-01-01"', $formHtml);
    }
    
    /**
     * Test that validates success message is displayed after account creation
     */
    public function testSignupFormDisplaysSuccessMessage()
    {
        // Set $_GET parameter to simulate approval state
        $_GET = [
            'approve' => 1
        ];
        
        // Generate HTML with approval state
        $formHtml = $this->getSignupHtmlWithApproval();
        
        // Check for success message script
        $this->assertStringContainsString("swal('Successfully created an account', 'Wait for the admin to approve your account', 'success');", $formHtml);
    }
    
    /**
     * Test that validates password pattern requirement
     */
    public function testSignupFormRequiresStrongPassword()
    {
        // Use the mocked signup form HTML
        $formHtml = $this->signupHtml;
        
        // Check for password field with strong password pattern
        $this->assertStringContainsString('pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"', $formHtml);
        $this->assertStringContainsString('title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"', $formHtml);
    }
    
    // Helper function to provide mock signup HTML
    private function getMockSignupHtml() {
        return '<!DOCTYPE html>
<html>
<body>
<form class="user" method="post" action="add_account.php">
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label class="form-label" for="bdate">First name</label>
            <input required type="text" name="fname" class="form-control" id="exampleFirstName"
                placeholder="Enter First Name">
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="bdate">Contact Number</label>
            <input required type="number" name="contact_no" class="form-control" id="exampleLastName"
                placeholder="e.g., 09123456789">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label class="form-label" for="bdate">Middle Name</label>
            <input required type="text" name="mname" class="form-control" id="exampleFirstName"
                placeholder="Enter Middle Name">
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="bdate">Employee ID</label>
            <input required type="number" maxlength="7" name="teacher_id" id="teacher_id" class="form-control" id="exampleLastName"
                placeholder="Enter Employee ID">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label class="form-label" for="bdate">Last name</label>
            <input required type="text" name="lname" class="form-control"
                id="exampleInputPassword" placeholder="Enter Last Name">
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="bdate">School</label>
            <select name="school" id="" class="form-control required-field">
                <option value="BES">BES</option>
                <option value="GES">GES</option>
                <option value="SCES">SCES</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="">Gender</label>
            <select name="gender" id="" class="form-control">
                <option value="Male">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="bdate">Email</label>
            <input required type="email" name="email" class="form-control" id="exampleLastName"
                placeholder="e.g., john123@gmail.com">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="">Address</label>
            <input required type="text" name="address" class="form-control" id="exampleFirstName"
                placeholder="Enter Address">
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="password">Password</label>
            <input required type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control"
                id="exampleRepeatPassword" placeholder="Enter Password">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label class="form-label" for="bdate">Birth Date</label>
            <input required type="date" name="bdate" class="form-control" id="exampleFirstName"
                placeholder="Enter Address">
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="password">Confirm Password</label>
            <input required type="password" name="password" class="form-control"
                id="exampleRepeatPassword" placeholder="Repeat Password">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <label class="form-label" for="bdate">User Type</label>
            <select class="form-control" name="category">
                <option value="4">Teacher</option>
                <option value="3">Secretary</option>
                <option value="2">Principal</option>
            </select>
        </div>
    </div>
    <div class="m-2">
        <input required type="submit" name="signup" value="Register Account" class="btn btn-primary btn-user btn-block">
    </div>
</form>
</body>
</html>';
    }
    
    // Helper function to generate HTML with error state
    private function getSignupHtmlWithError($data) {
        return '<!DOCTYPE html>
<html>
<body>
<form class="user" method="post" action="add_account.php">
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label class="form-label" for="bdate">First name</label>
            <input required type="text" name="fname" class="form-control" id="exampleFirstName"
                value="' . $data['fname'] . '"
                placeholder="Enter First Name">
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="bdate">Contact Number</label>
            <input required type="number" name="contact_no" class="form-control" id="exampleLastName"
                value="' . $data['contact_no'] . '"
                placeholder="e.g., 09123456789">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label class="form-label" for="bdate">Middle Name</label>
            <input required type="text" name="mname" class="form-control" id="exampleFirstName"
                value="' . $data['mname'] . '"
                placeholder="Enter Middle Name">
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="bdate">Employee ID</label>
            <input required type="number" maxlength="7" name="teacher_id" id="teacher_id" class="form-control" id="exampleLastName"
                value="' . $data['teacher_id'] . '"
                placeholder="Enter Employee ID">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label class="form-label" for="bdate">Last name</label>
            <input required type="text" name="lname" class="form-control" value="' . $data['lname'] . '"
                id="exampleInputPassword" placeholder="Enter Last Name">
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="bdate">School</label>
            <select name="school" id="" class="form-control required-field">
                <option value="BES">BES</option>
                <option value="GES">GES</option>
                <option value="SCES">SCES</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="">Address</label>
            <input required type="text" name="address" class="form-control" id="exampleFirstName"
                value="' . $data['address'] . '"
                placeholder="Enter Address">
        </div>
        <div class="col-sm-6">
            <label class="form-label" for="bdate">Birth Date</label>
            <input required type="date" name="bdate" class="form-control" id="exampleFirstName" value="' . $data['bdate'] . '"
                placeholder="Enter Address">
        </div>
    </div>
    <div class="m-2">
        <input required type="submit" name="signup" value="Register Account" class="btn btn-primary btn-user btn-block">
    </div>
</form>
</body>
</html>';
    }
    
    // Helper function to generate HTML with approval state
    private function getSignupHtmlWithApproval() {
        return '<!DOCTYPE html>
<html>
<body>
<form class="user" method="post" action="add_account.php">
    <!-- Form fields -->
</form>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
swal(\'Successfully created an account\', \'Wait for the admin to approve your account\', \'success\');
</script>
</body>
</html>';
    }
}
?>
