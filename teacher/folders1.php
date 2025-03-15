<?php
include('../session.php');
include('../connect.php');

// Fetch school and teacher ID from session
$school = $_SESSION['school'];
$teacher = $_SESSION['teacher_id'];

// Fetch all students for the school and teacher
$sqlget1 = "SELECT * FROM new_student WHERE school = '$school' AND teacher_id = $teacher";
$sqldata1 = mysqli_query($conn, $sqlget1) or die('Error Displaying Data: ' . mysqli_connect_error());
$students = [];
while ($row3 = mysqli_fetch_assoc($sqldata1)) {
    $students[] = $row3;
}

// Fetch teacher names for each student
$teacher_names = [];
foreach ($students as $student) {
    $teacher_id = $student['teacher_id'];
    if (!isset($teacher_names[$teacher_id])) {
        $sqlget = "SELECT * FROM teachers WHERE teacher_id = $teacher_id";
        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data: ' . mysqli_connect_error());
        $row = mysqli_fetch_assoc($sqldata);
        $teacher_names[$teacher_id] = $row ? $row['fname'] . " " . $row['lname'] : 'Unknown';
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
    <title>Log History</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://www.favicon.cc/favicon/121/664/favicon.png">
    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Inline CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .table th, .table td {
            color: black;
        }
    </style>
</head>
<body id="page-top">
    <?php include('nav.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 mb-0 text-gray-800"><strong>Students of <?php echo htmlspecialchars($_SESSION['school']); ?></strong></h2>
        </div>

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle mb-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Table View
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="folders.php">Folder View</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table id="example111" class="table" style="width:100%;">
                    <thead>
                        <tr>
                            <th style="color:black;">LRN</th>
                            <th style="color:black;">Student Name</th>
                            <th style="color:black;">Age</th>
                            <th style="color:black;">Teacher</th>
                            <th style="color:black;">School</th>
                            <th style="color:black;">Status</th>
                            <th style="color:black;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $row3): ?>
                            <tr>
                                <td style="color:black;"><?php echo htmlspecialchars($row3['lrn']); ?></td>
                                <td style="color:black;"><?php echo htmlspecialchars($row3['fname'] . " " . $row3['lname']); ?></td>
                                <td style="color:black;">
                                    <?php
                                    $date = date_create($row3['birth_date']);
                                    $interval = $date->diff(new DateTime);
                                    echo $interval->y;
                                    ?>
                                </td>
                                <td style="color:black;"><?php echo htmlspecialchars($teacher_names[$row3['teacher_id']]); ?></td>
                                <td style="color:black;"><?php echo htmlspecialchars($row3['school']); ?></td>
                                <td style="color:black;"><?php echo htmlspecialchars($row3['enroll_status']); ?></td>
                                <td style="color:black;">
                                    <a class="btn btn-success" href="student_file_folder.php?id=<?php echo htmlspecialchars($row3['lrn']); ?>">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="color:black;">LRN</th>
                            <th style="color:black;">Student Name</th>
                            <th style="color:black;">Age</th>
                            <th style="color:black;">Teacher</th>
                            <th style="color:black;">School</th>
                            <th style="color:black;">Status</th>
                            <th style="color:black;">Action</th>
                        </tr>
                    </tfoot>
                </table>
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
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example111').DataTable();
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#example222').DataTable();
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#example333').DataTable();
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#example444').DataTable();
        });
    </script>

    <?php
    if (isset($_GET['id'])) {
        echo "<script>swal('User Account Declined', 'The selected Account has been declined!', 'warning');</script>";
    }
    if (isset($_GET['id1'])) {
        echo "<script>swal('Account has been approved', 'The selected Account has been approved', 'success');</script>";
    }
    ?>
</body>
</html>