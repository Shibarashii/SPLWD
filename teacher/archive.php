<?php
include('../session.php');
include('../connect.php');

// Fetch archived files for the teacher
$teacher_id = $_SESSION['teacher_id'];
$sqlget7 = "SELECT * FROM student_files WHERE teacher_id = $teacher_id AND status = 'archive'";
$sqldata7 = mysqli_query($conn, $sqlget7) or die('Error Displaying Data: ' . mysqli_connect_error());
$archived_files = [];
while ($row7 = mysqli_fetch_assoc($sqldata7)) {
    $archived_files[] = $row7;
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
            background-color: #212529; /* Matching bg-dark class */
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
        .container .row .col-md-3 {
            position: relative;
            margin: 1rem 0;
        }
        .container .row .col-md-3 p {
            color: black;
        }
        .container .row .col-md-3 img {
            display: block;
            cursor: pointer;
        }
        .container .row .col-md-3 .fas {
            cursor: pointer;
        }
    </style>
</head>
<body id="page-top" class="bg-dark">
    <?php include('nav.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 mb-0 text-gray-800"><strong>Archive Files</strong></h2>
        </div>

        <div class="container">
            <div class="row">
                <?php foreach ($archived_files as $row7): ?>
                    <div class="col-md-3" align="center">
                        <p style="color:black;"><?php echo htmlspecialchars($row7['file_type']); ?></p>
                        <img type="button" class="img-fluid" src="../img/pdf.png" width="100" alt="" data-toggle="tooltip" data-placement="left" title="Click on the Recycle icon to retrieve files">
                        <a type="button" data-toggle="modal" data-target="#e<?php echo $row7['student_files']; ?>">
                            <i class="fas fa-trash" style="color:red; position: absolute; margin-left:-20px; margin-top: -42px;"></i>
                        </a>
                        <a type="button" data-toggle="modal" data-target="#a<?php echo $row7['student_files']; ?>">
                            <i class="fas fa-recycle" style="color:green; position: absolute; margin-left:10px; margin-top: -40px;"></i>
                        </a>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="e<?php echo $row7['student_files']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to permanently Delete this File?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" align="right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                        <a href="delete.php?id=<?php echo $row7['student_files']; ?>" class="btn btn-danger">YES</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Retrieve Modal -->
                        <div class="modal fade" id="a<?php echo $row7['student_files']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are You Sure You Want to Retrieve This File?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" align="right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                        <a href="delete_file.php?id1=<?php echo $row7['student_files']; ?>&lrn=<?php echo $row7['lrn']; ?>" class="btn btn-success">YES</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php
    if (isset($_GET['id'])) {
        echo "<script>swal('File Successfully Retrieved', 'The selected file has been retrieved and restored to the student folder', 'success');</script>";
    }
    if (isset($_GET['delete1'])) {
        echo "<script>swal('File permanently deleted', 'The selected file has been permanently deleted', 'warning');</script>";
    }
    ?>

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

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>
</html>