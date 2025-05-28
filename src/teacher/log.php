<?php
include('../session.php');
include('../connect.php');

// Fetch log entries for the teacher
$teacher_id = $_SESSION['teacher_id'];
$sqlget1 = "SELECT * FROM log WHERE teacher_id = $teacher_id ORDER BY log_id DESC";
$sqldata1 = mysqli_query($conn, $sqlget1) or die('Error Displaying Data: ' . mysqli_connect_error());
$logs = [];
while ($row2 = mysqli_fetch_assoc($sqldata1)) {
    $logs[] = $row2;
}

// Fetch teacher and student names for each log entry
$teacher_names = [];
$student_names = [];
foreach ($logs as $log) {
    // Fetch teacher name
    $teacher_id = $log['teacher_id'];
    if (!isset($teacher_names[$teacher_id])) {
        $sqlget = "SELECT * FROM teachers WHERE teacher_id = $teacher_id";
        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data: ' . mysqli_connect_error());
        $row = mysqli_fetch_assoc($sqldata);
        $teacher_names[$teacher_id] = $row ? [
            'name' => $row['fname'] . " " . $row['lname'],
            'img' => $row['img']
        ] : ['name' => 'Unknown', 'img' => 'th.jfif'];
    }

    // Fetch student name
    $student_id = $log['student_id'];
    if ($student_id && !isset($student_names[$student_id])) {
        $sqlget = "SELECT * FROM new_student WHERE lrn = $student_id";
        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data: ' . mysqli_connect_error());
        $row = mysqli_fetch_assoc($sqldata);
        $student_names[$student_id] = $row ? $row['fname'] . " " . $row['lname'] : 'Unknown';
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
            text-align: center;
        }
        .card {
            margin: 1rem auto;
            padding: 1rem;
        }
        .card-body {
            padding: 1.5rem;
        }
    </style>
</head>
<body id="page-top">
    <?php include('nav.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 mb-0 text-gray-800"><strong>Log History</strong></h2>
        </div>

        <div>
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Teacher</th>
                                <th>Action Type</th>
                                <th>Details</th>
                                <th>Student</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($logs as $row2): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex flex-row">
                                            <img class="img-profile rounded-circle mr-2" style="width:40px;" onerror="this.src='../img/th.jfif'" src="../img/<?php echo htmlspecialchars($teacher_names[$row2['teacher_id']]['img']); ?>" alt="">
                                            <p><?php echo htmlspecialchars($teacher_names[$row2['teacher_id']]['name']); ?></p>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($row2['action_type']); ?></td>
                                    <td><?php echo htmlspecialchars($row2['details']); ?></td>
                                    <td><?php echo htmlspecialchars($student_names[$row2['student_id']] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($row2['date']); ?></td>
                                </tr>

                                <!-- Decline Modal -->
                                <div class="modal fade" id="e<?php echo $row2['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Decline account?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" align="right">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                <a href="update_status.php?id=<?php echo $row2['id']; ?>" class="btn btn-danger">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Approve Modal -->
                                <div class="modal fade" id="a<?php echo $row2['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Approve account?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" align="right">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                <a href="update_status.php?id1=<?php echo $row2['id']; ?>" class="btn btn-success">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Teacher</th>
                                <th>Action Type</th>
                                <th>Details</th>
                                <th>Student</th>
                                <th>Date</th>
                            </tr>
                        </tfoot>
                    </table>
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
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
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