<?php
include('../session.php');
include('../connect.php');

// Fetch school and teacher ID from session
$school = $_SESSION['school'];
$teacher = $_SESSION['teacher_id'];

// Fetch students for each category
$categories = [
    'Enrolled' => [],
    'Main Streamed' => [],
    'Graduated' => [],
    'Transferred' => []
];

foreach ($categories as $status => &$students) {
    $sqlget1 = "SELECT * FROM new_student WHERE school = '$school' AND enroll_status = '$status' AND teacher_id = $teacher";
    $sqldata1 = mysqli_query($conn, $sqlget1) or die('Error Displaying Data: ' . mysqli_connect_error());
    while ($row3 = mysqli_fetch_assoc($sqldata1)) {
        $students[] = $row3;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Student Folders</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://www.favicon.cc/favicon/121/664/favicon.png">
    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Inline CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .footer {
            position: fixed;
            left: 1px;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
        select.selectList {
            width: 35px;
        }
        .tab-content {
            text-align: center;
        }
    </style>
</head>
<body id="page-top">
    <?php include('nav.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 mb-0"><strong>Student Folders of <?php echo htmlspecialchars($_SESSION['school']); ?></strong></h2>
        </div>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle mb-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Folder View
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="folders1.php">Table View</a>
            </div>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Enrolled</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="progress-tab" data-toggle="tab" href="#iep" role="tab" aria-controls="progress" aria-selected="false">Main Streamed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="progress-tab" data-toggle="tab" href="#progress" role="tab" aria-controls="progress" aria-selected="false">Graduated</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Transferred</a>
            </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content" id="myTabContent">
            <!-- Enrolled Students -->
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h3 class="m-4" style="color:black; font-weight:bold;">Enrolled Students</h3>
                <div class="row">
                    <?php foreach ($categories['Enrolled'] as $row3): ?>
                        <div class="col-md-2" align="center" style="color:black;">
                            <?php
                            $name = $row3['fname'];
                            echo htmlspecialchars($name[0] . ". " . $row3['lname']);
                            ?>
                            <a href="student_file_folder.php?id=<?php echo htmlspecialchars($row3['lrn']); ?>">
                                <img class="img-fluid" src="../img/folder.png" alt="">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Main Streamed Students -->
            <div class="tab-pane fade" id="iep" role="tabpanel" aria-labelledby="progress-tab">
                <h3 class="m-4" style="color:black; font-weight:bold;">Main Streamed Students</h3>
                <div class="row">
                    <?php foreach ($categories['Main Streamed'] as $row3): ?>
                        <div class="col-md-2" align="center" style="color:black;">
                            <?php
                            $name = $row3['fname'];
                            echo htmlspecialchars($name[0] . ". " . $row3['lname']);
                            ?>
                            <a href="student_file_folder.php?id=<?php echo htmlspecialchars($row3['lrn']); ?>">
                                <img class="img-fluid" src="../img/folder.png" alt="">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Graduated Students -->
            <div class="tab-pane fade" id="progress" role="tabpanel" aria-labelledby="progress-tab">
                <h3 class="m-4" style="color:black; font-weight:bold;">Graduated Students</h3>
                <div class="row">
                    <?php foreach ($categories['Graduated'] as $row3): ?>
                        <div class="col-md-2" align="center" style="color:black;">
                            <?php
                            $name = $row3['fname'];
                            echo htmlspecialchars($name[0] . ". " . $row3['lname']);
                            ?>
                            <a href="student_file_folder.php?id=<?php echo htmlspecialchars($row3['lrn']); ?>">
                                <img class="img-fluid" src="../img/folder.png" alt="">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Transferred Students -->
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h3 class="m-4" style="color:black; font-weight:bold;">Transferred Students</h3>
                <div class="row">
                    <?php foreach ($categories['Transferred'] as $row3): ?>
                        <div class="col-md-2" align="center" style="color:black;">
                            <?php
                            $name = $row3['fname'];
                            echo htmlspecialchars($name[0] . ". " . $row3['lname']);
                            ?>
                            <a href="student_file_folder.php?id=<?php echo htmlspecialchars($row3['lrn']); ?>">
                                <img class="img-fluid" src="../img/folder.png" alt="">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright © VoxDroid 2025 <br><a href="https://www.github.com/VoxDroid">github.com/VoxDroid</a></span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
     
    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript -->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages -->
    <script src="../js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php
    if (isset($_GET['id'])) {
        echo "<script>swal('New Student Added', 'New Student successfully Added', 'success');</script>";
    }
    ?>
</body>
</html>