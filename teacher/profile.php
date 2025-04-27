<?php
include('../session.php');
include('../connect.php');

// Fetch teacher data
$id = $_SESSION['logged_id'];
$sqlget = "SELECT * FROM teachers WHERE id = $id";
$sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data: ' . mysqli_connect_error());
$row = mysqli_fetch_assoc($sqldata);

// Fetch number of students
$teacher_id = $_SESSION['teacher_id'];
$sql_students = "SELECT * FROM new_student WHERE teacher_id = $teacher_id";
$result_students = mysqli_query($conn, $sql_students);
$student_count = $result_students ? mysqli_num_rows($result_students) : 0;

// Fetch number of files uploaded
$sql_files = "SELECT * FROM student_files WHERE teacher_id = $teacher_id";
$result_files = mysqli_query($conn, $sql_files);
$file_count = $result_files ? mysqli_num_rows($result_files) : 0;

// Fetch latest activity log
$sql_log = "SELECT * FROM log WHERE teacher_id = $teacher_id AND action_type != 'Log in' ORDER BY log_id DESC LIMIT 1";
$sqldata1 = mysqli_query($conn, $sql_log) or die('Error Displaying Data: ' . mysqli_connect_error());
$log_row = mysqli_fetch_assoc($sqldata1);
$latest_activity = $log_row ? $log_row['action_type'] : 'No activity';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Profile</title>
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
            background-color: black;
        }
        .footer {
            position: fixed;
            left: 1px;
            bottom: 0;
            width: 100%;
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
<body>
    <?php include('nav.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0"><strong>Teacher's Profile</strong></h1>
        </div>

        <div>
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row">
                        <div class="card col-md-12 col-xl-3">
                            <p style="color:black; font-size:18px;"><strong>Employee ID: </strong><?php echo htmlspecialchars($row['teacher_id']); ?></p>
                            <p style="color:black; font-size:18px;"><strong>Fullname: </strong><?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?></p>
                            <img class="card-img-top" src="../img/<?php echo htmlspecialchars($row['img']); ?>" onerror="this.src='../img/th.jfif'" id="thumb" alt="Card image cap" style="max-height: 250px;">
                            <div class="card-body">
                                <form action="update_profile.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="fileToUpload1" class="btn btn-primary" style="font-size:13px;">Select Image</label>
                                            <input type="file" style="visibility:hidden;" name="fileToUpload1" id="fileToUpload1" onchange="preview()">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" class="btn btn-primary" style="font-size:13px;" value="Update">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-12 col-xl-5 p-5">
                            <form>
                                <div style="font-size:18px;" class="mb-2 mt-2"><b>Email: </b></div>
                                <div><input style="color:black;" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="<?php echo htmlspecialchars($row['email']); ?>" readonly="readonly"></div>

                                <div style="font-size:18px;" class="mb-2 mt-2"><b>Contact: </b></div>
                                <div><input style="color:black;" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="contact_no" placeholder="<?php echo htmlspecialchars($row['contact_no']); ?>" readonly="readonly"></div>

                                <div style="font-size:18px;" class="mb-2 mt-2"><b>Address: </b></div>
                                <div><input style="color:black;" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="address" placeholder="<?php echo htmlspecialchars($row['address']); ?>" readonly="readonly"></div>

                                <div style="font-size:18px;" class="mb-2 mt-2"><b>Birth Date: </b></div>
                                <div><input style="color:black;" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="birt_date" placeholder="<?php echo htmlspecialchars($row['birth_date']); ?>" readonly="readonly"></div>

                                <button class="button btn btn-primary float-right mt-3" type="button" data-toggle="modal" data-target="#myModal">Update Profile</button>
                            </form>

                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update Info</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="update_teacher.php" method="POST">
                                                <div><b>First Name: </b></div>
                                                <div><input style="color:black;" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="fname" value="<?php echo htmlspecialchars($row['fname']); ?>"></div>

                                                <div><b>Last Name: </b></div>
                                                <div><input style="color:black;" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="lname" value="<?php echo htmlspecialchars($row['lname']); ?>"></div>

                                                <div><b>Middle Name: </b></div>
                                                <div><input style="color:black;" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mname" value="<?php echo htmlspecialchars($row['mname']); ?>"></div>

                                                <div><b>Email: </b></div>
                                                <div><input style="color:black;" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"></div>

                                                <div><b>Contact: </b></div>
                                                <div><input style="color:black;" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="contact_no" value="<?php echo htmlspecialchars($row['contact_no']); ?>"></div>

                                                <div><b>Address: </b></div>
                                                <div><input style="color:black;" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="address" value="<?php echo htmlspecialchars($row['address']); ?>"></div>

                                                <div><b>Birth Date: </b></div>
                                                <div><input style="color:black;" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="birth_date" value="<?php echo htmlspecialchars($row['birth_date']); ?>"></div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xl-3">
                            <!-- Number of Students Handle -->
                            <div class="col-md-12 mb-4">
                                <div class="card border-left-primary shadow h-40 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-small font-weight-bold text-primary text-uppercase mb-2 mt-2">
                                                    Number of Students Handle
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $student_count; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Number of Files Uploaded -->
                            <div class="col-md-12 mb-4">
                                <div class="card border-left-primary shadow h-40 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-small font-weight-bold text-primary text-uppercase mb-2 mt-2">
                                                    Number of Files Uploaded
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $file_count; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Activity Log -->
                            <div class="col-md-12 mb-4">
                                <div class="card border-left-primary shadow h-40 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-small font-weight-bold text-primary text-uppercase mb-2 mt-2">
                                                    Activity Log
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlspecialchars($latest_activity); ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

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

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function preview() {
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
    if (isset($_GET['update_profile'])) {
        echo "<script>swal('Profile updated', 'Your profile is successfully updated', 'success');</script>";
    }
    if (isset($_GET['update_image1'])) {
        echo "<script>swal('Profile picture updated', 'Your profile picture is successfully updated', 'success');</script>";
    }
    if (isset($_GET['update_image'])) {
        echo "<script>swal('Upload Successful', 'Files successfully uploaded', 'success');</script>";
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
</body>
</html>