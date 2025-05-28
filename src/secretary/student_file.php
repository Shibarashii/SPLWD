<?php include('../session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Student File</title>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<style>
  select.selectList {
    width: 35px;
  }
</style>
<style>
  .footer {
    position: fixed;
    left: 1;
    bottom: 0;
    width: 100%;
    text-align: center;
  }
</style>
<style>
  img.sticky {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    width: 500px;
  }
</style>
<body id="page-top">
  <?php include('nav.php'); ?>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center  mb-4">
      <a href="student_file_folder.php?id=<?php echo $_GET['id']; ?>&folder_id=<?php echo $_GET['folder_id']; ?>" class="btn btn-primary mr-3" data-toggle="tooltip" data-placement="top" title="Back to student folders"><i class="fas fa-arrow-left "></i></a>
      <h1 class="h3 mb-0" style="color:black; font-weight:bold;">Student File</h1>
    </div>
    <div class="row">
      <div class="col-md-2 border vh-100">
        <img src="../img/student.png" class="img-fluid" alt="">
        <?php
        include('../connect.php');
        $id = $_GET['id'];
        $address = "";
        $name = "";
        $birth_date = "";
        $guardian = "";
        $guardian_contact = "";
        $category = "";
        $work_ = "";
        $grade = "";
        $gender = "";
        $folder_id = $_GET['folder_id'];
        $sqlget = "SELECT * FROM new_student where lrn = $id";
        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
        while ($row = mysqli_fetch_assoc($sqldata)) {
          $address = $row['address'];
          $birth_date = $row['birth_date'];
          $guardian = $row['guardian'];
          $guardian_contact = $row['gurdian_contact'];
          $category = $row['category'];
          $work_ = $row['work'];
          $gender = $row['gender'];
        ?>
          <h5 style="color:black;"><strong>Name : </strong><?php $name = $row['fname'] . " " . $row['lname'];
                                                            echo $row['fname'] . " " . $row['lname']; ?></h5>
          <h5 style="color:black;"><strong>Category : </strong><?php echo $row['category']; ?></h5>
          <h5 style="color:black;"><strong>Status : </strong><?php echo $row['enroll_status']; ?></h5>
        <?php }
        $folder_id = $_GET['folder_id'];
        $sqlgetgrade = "SELECT * FROM iep_difficulty where lrn = $id and folder_id = $folder_id";
        $sqldatagrade = mysqli_query($conn, $sqlgetgrade) or die('Error Displaying Data' . mysqli_connect_error());
        while ($gradeee = mysqli_fetch_assoc($sqldatagrade)) {
          $grade = $gradeee['grade'];
        }
        ?>
      </div>
      <div class="col-md-10">
        <!-- tab items-->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
              aria-selected="true">Student Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="progress-tab" data-toggle="tab" href="#iep" role="tab" aria-controls="progress"
              aria-selected="false">IEP</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="progress-tab" data-toggle="tab" href="#progresschart" role="tab" aria-controls="progress"
              aria-selected="false">Progress Chart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="progress-tab" data-toggle="tab" href="#progress" role="tab" aria-controls="progress"
              aria-selected="false">Progress Report</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
              aria-selected="false">Student files</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#form" role="tab" aria-controls="profile"
              aria-selected="false">Forms</a>
          </li>
        </ul>
        <!-- tab items close-->
        <!-- tab content-->
        <div class="tab-content" align="center" id="myTabContent">
          <!-- progress chart -->
          <div class="tab-pane fade" id="progresschart" role="tabpanel" aria-labelledby="progress-tab">
            <h4 class="mt-3" style="color:black; font-weight:bold;">Progress Chart</h4>
            <ul class="nav nav-tabs ml-2" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#aa1" role="tab" aria-controls="home"
                  aria-selected="true">DAILY LIVING SKILLS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="progress-tab" data-toggle="tab" href="#aa2" role="tab" aria-controls="progress"
                  aria-selected="false">SOCIO-EMOTIONAL</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="progress-tab" data-toggle="tab" href="#aa3" role="tab" aria-controls="progress"
                  aria-selected="false">LANGUAGE DEVELOPMENT</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#aa4" role="tab" aria-controls="profile"
                  aria-selected="false">PYSCHOMOTOR</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="progress-tab" data-toggle="tab" href="#aa5" role="tab" aria-controls="progress"
                  aria-selected="false">COGNITIVE</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#aa6" role="tab" aria-controls="profile"
                  aria-selected="false">BEHAVIORAL DEVELOPMENT</a>
              </li>
            </ul>
            <div class="tab-content" align="center" id="myTabContent">
              <!-- aa2 -->
              <div class="tab-pane fade container-fluid" align="center" id="aa2" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <!-- chart1 -->
                  <div class="col-md-12 border">
                    <div class="row">
                      <!-- label -->
                      <div class="col-md-4" align="left">
                        <?php
                        include('../connect.php');
                        $id = $_GET['id'];
                        $folder_id = $_GET['folder_id'];
                        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
                        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                        $count = 0;
                        while ($row1 = mysqli_fetch_assoc($sqldata)) {
                          $count++;
                          $a = "<p style='color:black;'>" . $count . ". " . $row1['type'] . "</p>";
                          echo $a;
                          if ($count == 10) {
                            break;
                          }
                        }
                        ?>
                      </div>
                      <!-- label -->
                      <div class="col-md-8"><canvas id="lineChart3"></canvas></div>
                    </div>
                  </div>
                  <!-- chart1 -->
                  <!-- chart2 -->
                  <div class="col-md-12 border" align="left">
                    <div class="row">
                      <div class="col-md-4">
                        <?php
                        include('../connect.php');
                        $id = $_GET['id'];
                        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
                        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                        $count = 0;
                        while ($row1 = mysqli_fetch_assoc($sqldata)) {
                          $count++;
                          if ($count >= 11) {
                            $a = "<p style='color:black;'>" . $count . ". " . $row1['type'] . "</p>";
                            echo $a;
                          }
                          if ($count == 25) {
                            break;
                          }
                        }
                        ?>
                      </div>
                      <div class="col-md-8"> <canvas id="lineChart4"></canvas></div>
                    </div>
                  </div>
                  <!-- chart2 -->
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>
                  //line
                  var ctxL = document.getElementById("lineChart3").getContext('2d');
                  var myLineChart = new Chart(ctxL, {
                    type: 'bar',
                    data: {
                      labels: [<?php
                                include('../connect.php');
                                $id = $_GET['id'];
                                $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
                                $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                $count = 1;
                                while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                  if ($count == 1) {
                                    $a = "'" . $count . "'";
                                    $count++;
                                    echo $a;
                                  } else {
                                    echo ",'" . $count . "'";
                                    $count++;
                                  }
                                  if ($count == 11) {
                                    break;
                                  }
                                }
                                ?>],
                      datasets: [{
                          label: "Quarter 1",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q1'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q1'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#10A19D',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 2",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q2'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q2'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#540375',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 3",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q3'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        echo 1;;
                                      }
                                    } else {
                                      if ($row1['q3'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FF7000', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "QUARTER 4",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q4'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q4'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FFBF00', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        }
                      ]
                    },
                    options: {
                      responsive: true
                    }
                  });
                </script>
                <script>
                  //line
                  var ctxL = document.getElementById("lineChart4").getContext('2d');
                  var myLineChart = new Chart(ctxL, {
                    type: 'bar',
                    data: {
                      labels: [<?php
                                include('../connect.php');
                                $id = $_GET['id'];
                                $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
                                $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                $count = 0;
                                while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                  $count++;
                                  if ($count == 11) {
                                    $a = "'" . $count . "'";
                                    echo $a;
                                  } else if ($count > 11) {
                                    echo ",'" . $count . "'";
                                  }
                                }
                                ?>],
                      datasets: [{
                          label: "Quarter 1",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q1'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q1'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#10A19D', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 2",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q2'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q2'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#540375', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 3",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q3'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q3'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FF7000', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "QUARTER 4",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q4'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q4'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'A') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#FFBF00',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        }
                      ]
                    },
                    options: {
                      responsive: true
                    }
                  });
                </script>
              </div>
              <!--aa2 -->
              <!-- aa3 -->
              <div class="tab-pane fade container-fluid" align="center" id="aa3" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <!-- chart1 -->
                  <div class="col-md-12 border">
                    <div class="row">
                      <!-- label -->
                      <div class="col-md-4" align="left">
                        <?php
                        include('../connect.php');
                        $id = $_GET['id'];
                        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=3 and folder_id = $folder_id";
                        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                        $count = 0;
                        while ($row1 = mysqli_fetch_assoc($sqldata)) {
                          $count++;
                          $a = "<p style='color:black;'>" . $count . ". " . $row1['type'] . "</p>";
                          echo $a;
                          if ($count == 10) {
                            break;
                          }
                        }
                        ?>
                      </div>
                      <!-- label -->
                      <div class="col-md-8"><canvas id="lineChart5"></canvas></div>
                    </div>
                  </div>
                  <!-- chart1 -->
                  <!-- chart2 -->
                  <div class="col-md-12 border" align="left">
                    <div class="row">
                      <div class="col-md-4">
                        <?php
                        include('../connect.php');
                        $id = $_GET['id'];
                        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=3 and folder_id = $folder_id";
                        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                        $count = 0;
                        while ($row1 = mysqli_fetch_assoc($sqldata)) {
                          $count++;
                          if ($count >= 10) {
                            $a = "<p style='color:black;'>" . $count . ". " . $row1['type'] . "</p>";
                            echo $a;
                          }
                          if ($count == 25) {
                            break;
                          }
                        }
                        ?>
                      </div>
                      <div class="col-md-8"> <canvas id="lineChart6"></canvas></div>
                    </div>
                  </div>
                  <!-- chart2 -->
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>
                  //line
                  var ctxL = document.getElementById("lineChart5").getContext('2d');
                  var myLineChart = new Chart(ctxL, {
                    type: 'bar',
                    data: {
                      labels: [<?php
                                include('../connect.php');
                                $id = $_GET['id'];
                                $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=3 and folder_id = $folder_id";
                                $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                $count = 1;
                                while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                  if ($count == 1) {
                                    $a = "'" . $count . "'";
                                    $count++;
                                    echo $a;
                                  } else {
                                    echo ",'" . $count . "'";
                                    $count++;
                                  }
                                  if ($count == 10) {
                                    break;
                                  }
                                }
                                ?>],
                      datasets: [{
                          label: "Quarter 1",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=3 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q1'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q1'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 10) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#10A19D',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 2",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=3 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q2'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q2'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 10) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#540375',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 3",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=3 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q3'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        echo 1;;
                                      }
                                    } else {
                                      if ($row1['q3'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 10) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FF7000', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "QUARTER 4",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=3 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q4'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        echo 4;
                                      }
                                    } else {
                                      if ($row1['q4'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 10) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FFBF00', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        }
                      ]
                    },
                    options: {
                      responsive: true
                    }
                  });
                </script>
                <script>
                  //line
                  var ctxL = document.getElementById("lineChart6").getContext('2d');
                  var myLineChart = new Chart(ctxL, {
                    type: 'bar',
                    data: {
                      labels: [<?php
                                include('../connect.php');
                                $id = $_GET['id'];
                                $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=3 and folder_id = $folder_id";
                                $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                $count = 0;
                                while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                  $count++;
                                  if ($count == 10) {
                                    $a = "'" . $count . "'";
                                    echo $a;
                                  } else if ($count > 10) {
                                    echo ",'" . $count . "'";
                                  }
                                }
                                ?>],
                      datasets: [{
                          label: "Quarter 1",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=3 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 10) {
                                      if ($row1['q1'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 10) {
                                      if ($row1['q1'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#10A19D', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 2",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=3 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 10) {
                                      if ($row1['q2'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 10) {
                                      if ($row1['q2'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#540375', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 3",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=3 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 10) {
                                      if ($row1['q3'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 10) {
                                      if ($row1['q3'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FF7000', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "QUARTER 4",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=3 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 10) {
                                      if ($row1['q4'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 10) {
                                      if ($row1['q4'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'A') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#FFBF00',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        }
                      ]
                    },
                    options: {
                      responsive: true
                    }
                  });
                </script>
              </div>
              <!--aa3 -->
              <!-- aa4 -->
              <div class="tab-pane fade container-fluid" align="center" id="aa4" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <!-- chart1 -->
                  <div class="col-md-12 border">
                    <div class="row">
                      <!-- label -->
                      <div class="col-md-4" align="left">
                        <?php
                        include('../connect.php');
                        $id = $_GET['id'];
                        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=4 and folder_id = $folder_id";
                        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                        $count = 0;
                        while ($row1 = mysqli_fetch_assoc($sqldata)) {
                          $count++;
                          $a = "<p style='color:black;'>" . $count . ". " . $row1['type'] . "</p>";
                          echo $a;
                          if ($count == 10) {
                            break;
                          }
                        }
                        ?>
                      </div>
                      <!-- label -->
                      <div class="col-md-8"><canvas id="lineChart7"></canvas></div>
                    </div>
                  </div>
                  <!-- chart1 -->
                  <!-- chart2 -->
                  <div class="col-md-12 border" align="left">
                    <div class="row">
                      <div class="col-md-4">
                        <?php
                        include('../connect.php');
                        $id = $_GET['id'];
                        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=4 and folder_id = $folder_id";
                        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                        $count = 0;
                        while ($row1 = mysqli_fetch_assoc($sqldata)) {
                          $count++;
                          if ($count >= 11) {
                            $a = "<p style='color:black;'>" . $count . ". " . $row1['type'] . "</p>";
                            echo $a;
                          }
                          if ($count == 25) {
                            break;
                          }
                        }
                        ?>
                      </div>
                      <div class="col-md-8"> <canvas id="lineChart8"></canvas></div>
                    </div>
                  </div>
                  <!-- chart2 -->
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>
                  //line
                  var ctxL = document.getElementById("lineChart7").getContext('2d');
                  var myLineChart = new Chart(ctxL, {
                    type: 'bar',
                    data: {
                      labels: [<?php
                                include('../connect.php');
                                $id = $_GET['id'];
                                $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=4 and folder_id = $folder_id";
                                $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                $count = 1;
                                while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                  if ($count == 1) {
                                    $a = "'" . $count . "'";
                                    $count++;
                                    echo $a;
                                  } else {
                                    echo ",'" . $count . "'";
                                    $count++;
                                  }
                                  if ($count == 11) {
                                    break;
                                  }
                                }
                                ?>],
                      datasets: [{
                          label: "Quarter 1",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=4 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q1'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q1'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#10A19D',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 2",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=4 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q2'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q2'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#540375',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 3",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=4 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q3'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        echo 1;;
                                      }
                                    } else {
                                      if ($row1['q3'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FF7000', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "QUARTER 4",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=4 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q4'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q4'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FFBF00', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        }
                      ]
                    },
                    options: {
                      responsive: true
                    }
                  });
                </script>
                <script>
                  //line
                  var ctxL = document.getElementById("lineChart8").getContext('2d');
                  var myLineChart = new Chart(ctxL, {
                    type: 'bar',
                    data: {
                      labels: [<?php
                                include('../connect.php');
                                $id = $_GET['id'];
                                $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=4 and folder_id = $folder_id";
                                $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                $count = 0;
                                while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                  $count++;
                                  if ($count == 11) {
                                    $a = "'" . $count . "'";
                                    echo $a;
                                  } else if ($count > 11) {
                                    echo ",'" . $count . "'";
                                  }
                                }
                                ?>],
                      datasets: [{
                          label: "Quarter 1",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=4 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q1'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q1'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#10A19D', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 2",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=4 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q2'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q2'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#540375', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 3",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=4 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q3'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q3'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FF7000', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "QUARTER 4",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=4 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q4'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q4'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'A') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#FFBF00',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        }
                      ]
                    },
                    options: {
                      responsive: true
                    }
                  });
                </script>
              </div>
              <!--aa4 -->
              <!-- aa5 -->
              <div class="tab-pane fade container-fluid" align="center" id="aa5" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <!-- chart1 -->
                  <div class="col-md-12 border">
                    <div class="row">
                      <!-- label -->
                      <div class="col-md-4" align="left">
                        <?php
                        include('../connect.php');
                        $id = $_GET['id'];
                        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=5 and folder_id = $folder_id";
                        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                        $count = 0;
                        while ($row1 = mysqli_fetch_assoc($sqldata)) {
                          $count++;
                          $a = "<p style='color:black;'>" . $count . ". " . $row1['type'] . "</p>";
                          echo $a;
                          if ($count == 10) {
                            break;
                          }
                        }
                        ?>
                      </div>
                      <!-- label -->
                      <div class="col-md-8"><canvas id="lineChart9"></canvas></div>
                    </div>
                  </div>
                  <!-- chart1 -->
                  <!-- chart2 -->
                  <div class="col-md-12 border" align="left">
                    <div class="row">
                      <div class="col-md-4">
                        <?php
                        include('../connect.php');
                        $id = $_GET['id'];
                        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=5";
                        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                        $count = 0;
                        while ($row1 = mysqli_fetch_assoc($sqldata)) {
                          $count++;
                          if ($count >= 11) {
                            $a = "<p style='color:black;'>" . $count . ". " . $row1['type'] . "</p>";
                            echo $a;
                          }
                          if ($count == 25) {
                            break;
                          }
                        }
                        ?>
                      </div>
                      <div class="col-md-8"> <canvas id="lineChart10"></canvas></div>
                    </div>
                  </div>
                  <!-- chart2 -->
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>
                  //line
                  var ctxL = document.getElementById("lineChart9").getContext('2d');
                  var myLineChart = new Chart(ctxL, {
                    type: 'bar',
                    data: {
                      labels: [<?php
                                include('../connect.php');
                                $id = $_GET['id'];
                                $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=5 and folder_id = $folder_id";
                                $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                $count = 1;
                                while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                  if ($count == 1) {
                                    $a = "'" . $count . "'";
                                    $count++;
                                    echo $a;
                                  } else {
                                    echo ",'" . $count . "'";
                                    $count++;
                                  }
                                  if ($count == 11) {
                                    break;
                                  }
                                }
                                ?>],
                      datasets: [{
                          label: "Quarter 1",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=5 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q1'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q1'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#10A19D',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 2",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=5 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q2'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q2'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#540375',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 3",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=5 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q3'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        echo 1;;
                                      }
                                    } else {
                                      if ($row1['q3'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FF7000', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "QUARTER 4",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=5 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q4'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        echo 4;
                                      }
                                    } else {
                                      if ($row1['q4'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FFBF00', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        }
                      ]
                    },
                    options: {
                      responsive: true
                    }
                  });
                </script>
                <script>
                  //line
                  var ctxL = document.getElementById("lineChart10").getContext('2d');
                  var myLineChart = new Chart(ctxL, {
                    type: 'bar',
                    data: {
                      labels: [<?php
                                include('../connect.php');
                                $id = $_GET['id'];
                                $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=5 and folder_id = $folder_id";
                                $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                $count = 0;
                                while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                  $count++;
                                  if ($count == 11) {
                                    $a = "'" . $count . "'";
                                    echo $a;
                                  } else if ($count > 11) {
                                    echo ",'" . $count . "'";
                                  }
                                }
                                ?>],
                      datasets: [{
                          label: "Quarter 1",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=5 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q1'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q1'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#10A19D', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 2",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=5 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q2'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q2'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#540375', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 3",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=5 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q3'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q3'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FF7000', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "QUARTER 4",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=5 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q4'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q4'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'A') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#FFBF00',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        }
                      ]
                    },
                    options: {
                      responsive: true
                    }
                  });
                </script>
              </div>
              <!--aa5 -->
              <!-- aa6 -->
              <div class="tab-pane fade container-fluid" align="center" id="aa6" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <!-- chart1 -->
                  <div class="col-md-12 border">
                    <div class="row">
                      <!-- label -->
                      <div class="col-md-4" align="left">
                        <?php
                        include('../connect.php');
                        $id = $_GET['id'];
                        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=6 and folder_id = $folder_id";
                        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                        $count = 0;
                        while ($row1 = mysqli_fetch_assoc($sqldata)) {
                          $count++;
                          $a = "<p style='color:black;'>" . $count . ". " . $row1['type'] . "</p>";
                          echo $a;
                          if ($count == 10) {
                            break;
                          }
                        }
                        ?>
                      </div>
                      <!-- label -->
                      <div class="col-md-8"><canvas id="lineChart12"></canvas></div>
                    </div>
                  </div>
                  <!-- chart1 -->
                  <!-- chart2 -->
                  <div class="col-md-12 border" align="left">
                    <div class="row">
                      <div class="col-md-4">
                        <?php
                        include('../connect.php');
                        $id = $_GET['id'];
                        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=6";
                        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                        $count = 0;
                        while ($row1 = mysqli_fetch_assoc($sqldata)) {
                          $count++;
                          if ($count >= 11) {
                            $a = "<p style='color:black;'>" . $count . ". " . $row1['type'] . "</p>";
                            echo $a;
                          }
                          if ($count == 25) {
                            break;
                          }
                        }
                        ?>
                      </div>
                      <div class="col-md-8"> <canvas id="lineChart13"></canvas></div>
                    </div>
                  </div>
                  <!-- chart2 -->
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>
                  //line
                  var ctxL = document.getElementById("lineChart12").getContext('2d');
                  var myLineChart = new Chart(ctxL, {
                    type: 'bar',
                    data: {
                      labels: [<?php
                                include('../connect.php');
                                $id = $_GET['id'];
                                $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=6 and folder_id = $folder_id";
                                $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                $count = 1;
                                while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                  if ($count == 1) {
                                    $a = "'" . $count . "'";
                                    $count++;
                                    echo $a;
                                  } else {
                                    echo ",'" . $count . "'";
                                    $count++;
                                  }
                                  if ($count == 11) {
                                    break;
                                  }
                                }
                                ?>],
                      datasets: [{
                          label: "Quarter 1",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=6 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q1'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q1'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#10A19D',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 2",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=6 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q2'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q2'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#540375',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 3",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=6 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q3'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        echo 1;;
                                      }
                                    } else {
                                      if ($row1['q3'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FF7000', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "QUARTER 4",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=6 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q4'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q4'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 11) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FFBF00', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        }
                      ]
                    },
                    options: {
                      responsive: true
                    }
                  });
                </script>
                <script>
                  //line
                  var ctxL = document.getElementById("lineChart13").getContext('2d');
                  var myLineChart = new Chart(ctxL, {
                    type: 'bar',
                    data: {
                      labels: [<?php
                                include('../connect.php');
                                $id = $_GET['id'];
                                $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=6 and folder_id = $folder_id";
                                $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                $count = 0;
                                while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                  $count++;
                                  if ($count == 11) {
                                    $a = "'" . $count . "'";
                                    echo $a;
                                  } else if ($count > 11) {
                                    echo ",'" . $count . "'";
                                  }
                                }
                                ?>],
                      datasets: [{
                          label: "Quarter 1",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=6 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q1'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q1'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#10A19D', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 2",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=6 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q2'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q2'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#540375', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 3",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=6 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q3'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q3'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FF7000', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "QUARTER 4",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=6 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 11) {
                                      if ($row1['q4'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 11) {
                                      if ($row1['q4'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'A') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#FFBF00',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        }
                      ]
                    },
                    options: {
                      responsive: true
                    }
                  });
                </script>
              </div>
              <!--aa6 -->
              <div class="tab-pane fade show active container-fluid" align="center" id="aa1" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <!-- chart1 -->
                  <div class="col-md-12 border">
                    <div class="row">
                      <!-- label -->
                      <div class="col-md-4" align="left">
                        <?php
                        include('../connect.php');
                        $id = $_GET['id'];
                        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1 and folder_id = $folder_id";
                        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                        $count = 0;
                        while ($row1 = mysqli_fetch_assoc($sqldata)) {
                          $count++;
                          $a = "<p style='color:black;'>" . $count . ". " . $row1['type'] . "</p>";
                          echo $a;
                          if ($count == 13) {
                            break;
                          }
                        }
                        ?>
                      </div>
                      <!-- label -->
                      <div class="col-md-8"><canvas id="lineChart"></canvas></div>
                    </div>
                  </div>
                  <!-- chart1 -->
                  <!-- chart2 -->
                  <div class="col-md-12 border" align="left">
                    <div class="row">
                      <div class="col-md-4">
                        <?php
                        include('../connect.php');
                        $id = $_GET['id'];
                        $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1 and folder_id = $folder_id";
                        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                        $count = 0;
                        while ($row1 = mysqli_fetch_assoc($sqldata)) {
                          $count++;
                          if ($count >= 14) {
                            $a = "<p style='color:black;'>" . $count . ". " . $row1['type'] . "</p>";
                            echo $a;
                          }
                          if ($count == 25) {
                            break;
                          }
                        }
                        ?>
                      </div>
                      <div class="col-md-8"> <canvas id="lineChart1"></canvas></div>
                    </div>
                  </div>
                  <!-- chart2 -->
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>
                  //line
                  var ctxL = document.getElementById("lineChart").getContext('2d');
                  var myLineChart = new Chart(ctxL, {
                    type: 'bar',
                    data: {
                      labels: [<?php
                                include('../connect.php');
                                $id = $_GET['id'];
                                $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1 and folder_id = $folder_id";
                                $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                $count = 1;
                                while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                  if ($count == 1) {
                                    $a = "'" . $count . "'";
                                    $count++;
                                    echo $a;
                                  } else {
                                    echo ",'" . $count . "'";
                                    $count++;
                                  }
                                  if ($count == 14) {
                                    break;
                                  }
                                }
                                ?>],
                      datasets: [{
                          label: "Quarter 1",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q1'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q1'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 14) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#10A19D',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 2",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q2'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q2'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 14) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#540375',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 3",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q3'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        echo 1;;
                                      }
                                    } else {
                                      if ($row1['q3'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 14) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FF7000', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "QUARTER 4",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 1) {
                                      if ($row1['q4'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        echo 1;
                                      }
                                    } else {
                                      if ($row1['q4'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 14) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FFBF00', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        }
                      ]
                    },
                    options: {
                      responsive: true
                    }
                  });
                </script>
                <script>
                  //line
                  var ctxL = document.getElementById("lineChart1").getContext('2d');
                  var myLineChart = new Chart(ctxL, {
                    type: 'bar',
                    data: {
                      labels: [<?php
                                include('../connect.php');
                                $id = $_GET['id'];
                                $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1 and folder_id = $folder_id";
                                $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                $count = 0;
                                while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                  $count++;
                                  if ($count == 14) {
                                    $a = "'" . $count . "'";
                                    echo $a;
                                  } else if ($count > 14) {
                                    echo ",'" . $count . "'";
                                  }
                                  if ($count == 25) {
                                    break;
                                  }
                                }
                                ?>],
                      datasets: [{
                          label: "Quarter 1",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 14) {
                                      if ($row1['q1'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 14) {
                                      if ($row1['q1'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#10A19D', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 2",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 14) {
                                      if ($row1['q2'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 14) {
                                      if ($row1['q2'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q2'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#540375', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "Quarter 3",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 14) {
                                      if ($row1['q3'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q1'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 14) {
                                      if ($row1['q3'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'AP') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: ['#FF7000', ],
                          borderColor: ['white', ],
                          borderWidth: 2
                        },
                        {
                          label: "QUARTER 4",
                          data: [<?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1 and folder_id = $folder_id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  $count = 1;
                                  while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                    if ($count == 14) {
                                      if ($row1['q4'] == 'P') {
                                        echo 4;
                                      }
                                      if ($row1['q4'] == 'AP') {
                                        echo 3;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        echo 2;
                                      }
                                      if ($row1['q3'] == 'B') {
                                        echo 1;
                                      }
                                    } else if ($count > 14) {
                                      if ($row1['q4'] == 'P') {
                                        $n = 4;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'A') {
                                        $n = 3;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'D') {
                                        $n = 2;
                                        echo "," . $n;
                                      }
                                      if ($row1['q4'] == 'B') {
                                        $n = 1;
                                        echo "," . $n;
                                      }
                                    }
                                    $count++;
                                    if ($count == 26) {
                                      break;
                                    }
                                  }
                                  ?>],
                          backgroundColor: [
                            '#FFBF00',
                          ],
                          borderColor: [
                            'white',
                          ],
                          borderWidth: 2
                        }
                      ]
                    },
                    options: {
                      responsive: true
                    }
                  });
                </script>
              </div>
            </div>
          </div>
          <!-- progress chart -->
          <!-- forms -->
          <div class="tab-pane fade" id="form" role="tabpanel" aria-labelledby="progress-tab">
            <h3 class="mt-3" style="color:black; font-weight:bold;">Learners with Disabilities Forms</h3>
            <div class="row">
              <div class="col-md-12">
                <div class="dropdown m-3 float-right">
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addiep">Add IEP</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addilp">Add ILP</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addilmp">Add ILMP</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addbir">Add BIR</a>
                  </div>
                </div>
              </div>
              <!-- Modal ILMP-->
              <div class="modal fade" id="addilmp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Add ILMP</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="addILMP.php?folder_id=<?php echo $_GET['folder_id']; ?>&lrn=<?php echo $_GET['id']; ?>" method="POST">
                        <div class="row">
                          <div class="col-md-12">
                            <h3>INDIVIDUAL LEARNING MONITORING PLAN</h3>
                            <table class="table table-bordered">
                              <tr>
                                <td style="color:black;" colspan="8">Learner's name: <?php echo $name; ?></td>
                              </tr>
                              <tr>
                                <td style="color:black;" colspan="8">Grade level: <?php echo $grade; ?></td>
                              </tr>
                              <tr>
                                <th style="color:black;" rowspan="2" style="text-align:center;">Learning Area</th>
                                <th style="color:black;" rowspan="2" style="text-align:center;">Learner’s Needs</th>
                                <th style="color:black;" rowspan="2" style="text-align:center;">Intervention Strategies Provided</th>
                                <th style="color:black;" rowspan="2" style="text-align:center;">Monitoring Date</th>
                                <th style="color:black;" colspan="3" style="text-align:center;">Learner’s Status</th>
                              </tr>
                              <tr style="text-align:center;">
                                <th style="color:black;">Insignificant Progress</th>
                                <th style="color:black;">Significant Progress</th>
                                <th style="color:black;">Mastery</th>
                              </tr>
                              <tr>
                                <td style="color:black;"><textarea name="learning_area" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><textarea name="learner_need" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><textarea name="intervention" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><input style="color:black;" type="date" name="monitoring_date" id="" class="form-control"></td>
                                <td style="color:black;"><textarea name="insignificant" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><textarea name="significant" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><textarea name="mastery" id="" class="form-control"></textarea></td>
                              </tr>
                              <tr>
                                <td style="color:black;"><textarea name="learning_area2" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><textarea name="learner_need2" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><textarea name="intervention2" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><input style="color:black;" type="date" name="monitoring_date2" id="" class="form-control"></td>
                                <td style="color:black;"><textarea name="insignificant2" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><textarea name="significant2" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><textarea name="mastery2" id="" class="form-control"></textarea></td>
                              </tr>
                              <tr>
                                <td style="color:black;"><textarea name="learning_area3" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><textarea name="learner_need3" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><textarea name="intervention3" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><input style="color:black;" type="date" name="monitoring_date3" id="" class="form-control"></td>
                                <td style="color:black;"><textarea name="insignificant3" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><textarea name="significant3" id="" class="form-control"></textarea></td>
                                <td style="color:black;"><textarea name="mastery3" id="" class="form-control"></textarea></td>
                              </tr>
                              <tr>
                                <th style="color:black;" rowspan="3">Intervention Status</th>
                                <td style="color:black;" colspan="6"><input style="color:black;" type="checkbox" name="c_1"> Learner is not making significant progress in a timely manner. Intervention strategies need to be revised.</td>
                              </tr>
                              <tr>
                                <td style="color:black;" colspan="6"><input style="color:black;" type="checkbox" name="c_2"> Learner is making significant progress. Continue with the learning plan. </td>
                              </tr>
                              <tr>
                                <td style="color:black;" colspan="6"><input style="color:black;" type="checkbox" name="c_3"> Learner has reached mastery of the competencies in learning plan. </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Add ILMP</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- modal ILMP -->
              <!-- Modal BIR-->
              <div class="modal fade" id="addbir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Add ILMP</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" align="center" style="color:black;">
                      <form action="addBIR.php?folder_id=<?php echo $_GET['folder_id']; ?>&lrn=<?php echo $_GET['id']; ?>" method="POST">
                        <div class="row">
                          <h2 style="text-align:center">BEHAVIOR INTERVENTION REPORT (BIR)</h2>
                          <table class="table table-borderless" style="text-align:center;">
                            <tr>
                              <td style="color:black;">
                                <div class="d-flex justify-content-center">
                                  <p style="color:black;"> School year:</p> <input style="color:black;" type="number" style="width:150px;" class="form-control ml-3" name="school_year">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="color:black;">
                                <div class="d-flex justify-content-center">
                                  <p style="color:black;"> Date of Observation:</p> <input style="color:black;" type="date" style="width:150px;" class="form-control ml-3" name="date_observation">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="color:black;">
                                <div class="d-flex justify-content-left">
                                  <p style="color:black;"> Name of Learners: _____<u><?php echo $name; ?></u>_______ </p>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="color:black;">
                                <div class="d-flex justify-content-left">
                                  <p style="color:black;"> Learner’s Reference Number : _____<u><?php echo $_GET['id']; ?></u>_______ </p>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="color:black;">
                                <div class="d-flex justify-content-left">
                                  <p style="color:black;"> Date of Birth : _____<u><?php echo $birth_date; ?></u>_______ </p>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="color:black;">
                                <div class="d-flex justify-content-left">
                                  <p style="color:black;"> Age of Learner: ____<u> <?php
                                                                                    $date = date_create($birth_date);
                                                                                    $interval = $date->diff(new DateTime);
                                                                                    echo $interval->y;
                                                                                    ?></u>_____ Gender: _____<u><?php echo $gender; ?></u>_______ : </p>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="color:black;">Baseline Data: (refer to the SF9 or Anecdotal Record) <input style="color:black;" type="text" class="form-control" name="baseline"></td>
                            </tr>
                            <tr>
                              <td style="color:black;">Difficulty/Disability of the Learners:<input style="color:black;" type="text" class="form-control" name="difficulty"></td>
                            </tr>
                            <tr style="text-align:left">
                              <td style="color:black;">Check the appropriate box:</td>
                            </tr>
                            <tr>
                              <td style="color:black;">
                                <div class="d-flex justify-content-start">
                                  <div><input style="color:black;" type="radio" value="1" checked style="width:50px;" name="with_"></div>
                                  <div>
                                    <p style="color:black;">With Medical Assessment</p>
                                  </div>
                                  <div>
                                    <p class="ml-5"> Results & Findings:</p>
                                  </div>
                                  <div><textarea type="text" name="result" class="form-control ml-3" style="width:650px;"></textarea></div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="color:black;">
                                <div class="d-flex justify-content-start">
                                  <div><input style="color:black;" type="radio" value="2" style="width:50px;" name="with_"></div>
                                  <div>
                                    <p style="color:black;">Without Medical Assessment</p>
                                  </div>
                              </td>
                            </tr>
                            <tr style="text-align:left">
                              <td style="color:black;">Educational Placement of LSEN:</td>
                            </tr>
                            <tr>
                              <td style="color:black;">
                                <div class="d-flex justify-content-start">
                                  <div><input style="color:black;" type="radio" value="1" style="width:50px;" checked name="self"></div>
                                  <div>
                                    <p style="color:black;">Self contained</p>
                                  </div>
                                  <div><input style="color:black;" type="radio" value="2" style="width:50px;" name="self"></div>
                                  <div>
                                    <p style="color:black;">Inclusion</p>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr style="text-align:left">
                              <td style="color:black;">
                                <p style="color:black;"> Parents: ___________<u><?php echo $guardian; ?></u>____________ </p>
                                <p style="color:black;"> Contact: _________<u><?php echo $guardian_contact; ?></u>___________ </p>
                                <div class="d-flex justify-content-start">
                                  <p style="color:black;"> work: _________<u><?php echo $work_; ?></u>____________ </p>
                                  <p style="color:black;"> Home: __________<u><?php echo $address; ?></u>__________ </p>
                                </div>
                              </td>
                            </tr>
                          </table>
                          <table class="table table-bordered">
                            <tr>
                              <th style="color:black;" colspan="4">BEHAVIOR MANIFESTATION & INTERVENTION</th>
                            </tr>
                            <tr>
                              <td style="color:black;"></td>
                              <td style="color:black;">At Home</td>
                              <td style="color:black;">In School</td>
                              <td style="color:black;">Other Settings</td>
                            </tr>
                            <tr>
                              <td style="color:black;">Antecedent/ Prior Behavior
                                (Triggers/Signals)</td>
                              <td style="color:black;"><textarea name="antecedent" id="" class="form-control"></textarea></td>
                              <td style="color:black;"><textarea name="antecedent_2" id="" class="form-control"></textarea></td>
                              <td style="color:black;"><textarea name="antecedent_3" id="" class="form-control"></textarea></td>
                            </tr>
                            <tr>
                              <td style="color:black;">Observable Behavior</td>
                              <td style="color:black;"><textarea name="observable" id="" class="form-control"></textarea></td>
                              <td style="color:black;"><textarea name="observable_2" id="" class="form-control"></textarea></td>
                              <td style="color:black;"><textarea name="observable_3" id="" class="form-control"></textarea></td>
                            </tr>
                            <tr>
                              <td style="color:black;">Result/ Consequence of Behavior</td>
                              <td style="color:black;"><textarea name="consequence" id="" class="form-control"></textarea></td>
                              <td style="color:black;"><textarea name="consequence_2" id="" class="form-control"></textarea></td>
                              <td style="color:black;"><textarea name="consequence_3" id="" class="form-control"></textarea></td>
                            </tr>
                            <tr>
                              <td style="color:black;">
                                Intervention Done</td>
                              <td style="color:black;"><textarea name="intervention_done" id="" class="form-control"></textarea></td>
                              <td style="color:black;"><textarea name="intervention_done_2" id="" class="form-control"></textarea></td>
                              <td style="color:black;"><textarea name="intervention_done_3" id="" class="form-control"></textarea></td>
                            </tr>
                            <tr>
                              <td style="color:black;">
                                Proactive Strategies for Prevention</td>
                              <td style="color:black;"><textarea name="proactive" id="" class="form-control"></textarea></td>
                              <td style="color:black;"><textarea name="proactive_2" id="" class="form-control"></textarea></td>
                              <td style="color:black;"><textarea name="proactive_3" id="" class="form-control"></textarea></td>
                            </tr>
                            <tr>
                              <td style="color:black;">
                                Reactive Strategies for Immediate Intervention</td>
                              <td style="color:black;"><textarea name="reactive" id="" class="form-control"></textarea></td>
                              <td style="color:black;"><textarea name="reactive_2" id="" class="form-control"></textarea></td>
                              <td style="color:black;"><textarea name="reactive_3" id="" class="form-control"></textarea></td>
                            </tr>
                          </table>
                          <br><br><br>
                          <table class="table table-bordered">
                            <tr>
                              <td style="color:black;">
                                <p style="color:black;"> Targeted Behavior (Behavior to be decreased)</p>
                                <textarea name="target" id="" class="form-control"></textarea>
                              </td>
                            </tr>
                            <tr>
                              <td style="color:black;">
                                <p style="color:black;"> Specific Objectives:</p>
                                <textarea name="objective" id="" class="form-control"></textarea>
                              </td>
                            </tr>
                            <tr>
                              <td style="color:black;">
                                <p style="color:black;"> Basic Intervention Report:</p>
                                <textarea name="bir_intervention" id="" class="form-control"></textarea>
                              </td>
                            </tr>
                          </table>
                          <table class="table table-borderless">
                            <tr>
                              <td style="color:black;">
                                <div class="d-flex justify-content-center">
                                  <div>
                                    <p class="mr-1">Prepared by:</p>
                                  </div>
                                  <div><input style="color:black;" type="text" class="form-control" name="teacher" style="width:300px">
                                    <p class="ml-5"> Name of Teacher </p>
                                  </div>
                                  <div>
                                    <p class="mr-2 ml-5">Conformed:</p>
                                  </div>
                                  <div><input style="color:black;" type="text" class="form-control" value="<?php echo $guardian; ?>" readonly style="width:300px">
                                    <p class="ml-5">Parent/Guardian</p>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td style="color:black;">
                                <div class="d-flex justify-content-center">
                                  <div>
                                    <p style="color:black;">Noted:</p>
                                  </div>
                                  <div><input style="color:black;" type="text" class="form-control" name="principal" style="width:300px">
                                    <p class="ml-5">Name of Principal/School Head</p>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- modal BIR -->
              <!-- add ilp -->
              <div class="modal fade" id="addilp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Add ILP</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="insert_ilp.php?id=<?php echo $_GET['id']; ?>&folder_id=<?php echo $_GET['folder_id']; ?>" method="post">
                        <h3>INDIVIDUAL LEARNER’S PROFILE</h3>
                        <ul class="nav nav-tabs ml-2" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#aaa1" role="tab" aria-controls="home"
                              aria-selected="true">Part I</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="progress-tab" data-toggle="tab" href="#aaa2" role="tab" aria-controls="progress"
                              aria-selected="false">Part II</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                          <!-- aa1 -->
                          <div class="tab-pane fade active show container-fluid" id="aaa1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                              <table class="table table-sm">
                                <tr>
                                  <td style="color:black;">Name:<u><?php echo $name; ?></td>
                                  <td style="color:black;">Date of Birth: <u><?php echo $birth_date; ?></td>
                                  <td style="color:black;">Age: <u> <?php
                                                                    $date = date_create($birth_date);
                                                                    $interval = $date->diff(new DateTime);
                                                                    echo $interval->y;
                                                                    ?></u></td>
                                  <td style="color:black;"></td>
                                </tr>
                                <tr>
                                  <td style="color:black;">Address: <u><?php echo $address; ?></u></td>
                                </tr>
                                <tr>
                                  <td style="color:black;">Type of learner: <u><?php echo $category; ?></u></td>
                                  <td style="color:black;">LRN: <u><?php echo $_GET['id']; ?></td>
                                </tr>
                                <tr>
                                  <td style="color:black;">School year:</td>
                                  <td style="color:black;"><input style="color:black;" type="date" class="form-control" name="school_year"></td>
                                  <td style="color:black;">Adviser:</td>
                                  <td style="color:black;"><input style="color:black;" type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                  <td style="color:black;">Principal:</td>
                                  <td style="color:black;"><input style="color:black;" type="text" class="form-control" name="principal"></td>
                                </tr>
                              </table>
                              <p style="color:black;">Record of Assessments</p>
                              <table class="table table-sm">
                                <tr class="bg-secondary text-white">
                                  <th style="color:black;">Type of Assessments</th>
                                  <th style="color:black;">Date Administered</th>
                                  <th style="color:black;">Chronological Age</th>
                                  <th style="color:black;">Administrator</th>
                                  <th style="color:black;">Results/Outcome</th>
                                </tr>
                                <tr>
                                  <td style="color:black;"><input style="color:black;" type="text" name="type_assessment" class="form-control"></td>
                                  <td style="color:black;"><input style="color:black;" type="date" name="date" class="form-control"></td>
                                  <td style="color:black;"><input style="color:black;" type="text" name="chronological_age" class="form-control"></td>
                                  <td style="color:black;"><input style="color:black;" type="text" name="administrator" class="form-control"></td>
                                  <td style="color:black;"><input style="color:black;" type="text" name="result" class="form-control"></td>
                                </tr>
                              </table>
                              <table class="table table-sm">
                                <tr class="bg-secondary text-white">
                                  <td style="color:black;"> <strong>Interview with Parents/Guardian</strong></td>
                                </tr>
                                <tr>
                                  <td style="color:black;">
                                    <p style="color:black;">Name of Parent/Guardian: <u><?php echo $guardian; ?></u></p>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="color:black;">
                                    <p style="color:black;">Contact Number/s: <u><?php echo $guardian_contact; ?></u></p>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="color:black;">
                                    <div class="row">
                                      <div class="col-md-3">Date of Interview:</div>
                                      <div class="col-md-3"><input style="color:black;" type="date" name="date_interview" class="form-control"></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="color:black;">
                                    <p style="color:black;">Developmental and educational History:</p>
                                    <textarea name="educ_history" id="" class="form-control" rows="2"></textarea>
                                  </td>
                                </tr>
                                <tr class="bg-secondary text-white">
                                  <td style="color:black;">
                                    <strong>Interview with the Learner</strong>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="color:black;">
                                    <div class="row">
                                      <div class="col-md-3">Date of Interview:</div>
                                      <div class="col-md-3"><input style="color:black;" type="date" name="date_interview_student" class="form-control"></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="color:black;">
                                    <p style="color:black;">Interests/Hobbies/Talents: Food preparation</p>
                                    <textarea name="interview_learner" id="" class="form-control" rows="2"></textarea>
                                  </td>
                                </tr>
                              </table>
                              <table class="table table-sm">
                                <tr class="bg-secondary text-white">
                                  <th style="color:black;">Priority Learning Needs/Intervention</th>
                                </tr>
                                <tr>
                                  <td style="color:black;"><textarea name="priority1" id="" class="form-control" rows="2"></textarea> </td>
                                </tr>
                                <tr>
                                  <td style="color:black;"><textarea name="priority2" id="" class="form-control" rows="2"></textarea> </td>
                                </tr>
                                <tr>
                                  <td style="color:black;"><textarea name="priority3" id="" class="form-control" rows="2"></textarea> </td>
                                </tr>
                                <tr>
                                  <td style="color:black;"><textarea name="priority4" id="" class="form-control" rows="2"></textarea> </td>
                                </tr>
                                <tr>
                                  <td style="color:black;"><textarea name="priority5" id="" class="form-control" rows="2"></textarea> </td>
                                </tr>
                                <tr>
                                  <td style="color:black;"><textarea name="priority6" id="" class="form-control" rows="2"></textarea> </td>
                                </tr>
                                <tr>
                                  <td style="color:black;"><textarea name="priority7" id="" class="form-control" rows="2"></textarea> </td>
                                </tr>
                              </table>
                            </div>
                          </div>
                          <!-- aa1 -->
                          <!-- aa2 -->
                          <div class="tab-pane fade container-fluid" id="aaa2" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                              <p style="color:black;"><strong>DAILY LIVING SKILLS DOMAIN:</strong> Present Level of Educational Performance</p>
                              <p style="color:black;">Strength/s:</p>
                              <textarea name="strenght1" id="" class="form-control" rows="2"></textarea>
                              <p style="color:black;">Need/s:</p>
                              <textarea name="need1" id="" class="form-control" rows="2"></textarea>
                              <strong>LANGUAGE DEVELOPMENT DOMAIN: </strong>Present Level of Educational Performance</strong>
                              <p style="color:black;">Strength/s:</p>
                              <textarea name="strenght2" id="" class="form-control" rows="2"></textarea>
                              <p style="color:black;">Need/s:</p>
                              <textarea name="need2" id="" class="form-control" rows="2"></textarea>
                              <strong>PSYCHOMOTOR DOMAIN: </strong>Present Level of Educational Performance</strong>
                              <p style="color:black;">Strength/s:</p>
                              <textarea name="strenght3" id="" class="form-control" rows="2"></textarea>
                              <p style="color:black;">Need/s:</p>
                              <textarea name="need3" id="" class="form-control" rows="2"></textarea>
                              <strong>COGNITIVE DOMAIN: </strong>Present Level of Educational Performance
                              <p style="color:black;">Strength/s:</p>
                              <textarea name="strenght4" id="" class="form-control" rows="2"></textarea>
                              <p style="color:black;">Need/s:</p>
                              <textarea name="need4" id="" class="form-control" rows="2"></textarea>
                              <strong>AESTHETIC AND CREATIVE DOMAIN:</strong> Present Level of Educational Performance
                              <p style="color:black;">Strength/s:</p>
                              <textarea name="strenght5" id="" class="form-control" rows="2"></textarea>
                              <p style="color:black;">Need/s:</p>
                              <textarea name="need5" id="" class="form-control" rows="2"></textarea>
                              <strong>BEHAVIORAL DEVELOPMENT: </strong>Present Level of Educational Performance
                              <p style="color:black;">Strength/s:</p>
                              <textarea name="strenght6" id="" class="form-control" rows="2"></textarea>
                              <p style="color:black;">Need/s:</p>
                              <textarea name="need6" id="" class="form-control" rows="2"></textarea>
                              <strong>ORIENTATION AND MOBILITY:</strong> Present Level of Educational Performance
                              <p style="color:black;">Strength/s:</p>
                              <textarea name="strenght7" id="" class="form-control" rows="2"></textarea>
                              <p style="color:black;">Need/s:</p>
                              <textarea name="need7" id="" class="form-control" rows="2"></textarea>
                              <strong>Transition Package:</strong>
                              <br>
                              <label for="">1. </label>
                              <textarea name="transition1" id="" class="form-control" rows="2"></textarea>
                              <label for="">2. </label>
                              <textarea name="transition2" id="" class="form-control" rows="2"></textarea>
                              <label for="">3. </label>
                              <textarea name="transition3" id="" class="form-control" rows="2"></textarea>
                              <label for="">4. </label>
                              <textarea name="transition4" id="" class="form-control" rows="2"></textarea>
                              <label for="">5. </label>
                              <textarea name="transition5" id="" class="form-control" rows="2"></textarea>
                            </div>
                          </div>
                          <!-- aa2 -->
                        </div>
                    </div>
                    <div class="modal-footer">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- add ilp modal end -->
              <!-- add iep modal -->
              <div class="modal fade" id="addiep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Add IEP</h5>
                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="insert_iep.php?id=<?php echo $_GET['id']; ?>&folder_id=<?php echo $_GET['folder_id']; ?>" method="post">
                        <div class="container-fluid">
                          <h3 class="mt-3" style="color:black; font-weight:bold;">Individualized Education Plan</h3>
                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="a1-tab" data-toggle="tab" href="#a11" role="tab" aria-controls="a1"
                                aria-selected="true">Information</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="a1-tab" data-toggle="tab" href="#a61" role="tab" aria-controls="a1"
                                aria-selected="true">IEP Team</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="a1-tab" data-toggle="tab" href="#a71" role="tab" aria-controls="a1"
                                aria-selected="true">Functional Performance</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#a21" role="tab" aria-controls="profile"
                                aria-selected="false">Consideration</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#a31" role="tab" aria-controls="contact"
                                aria-selected="false">Barriers</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#a41" role="tab" aria-controls="contact"
                                aria-selected="false">Goals && Transition</a>
                            </li>
                          </ul>
                          <div class="tab-content" id="myTabContent">
                            <!--information-->
                            <div class="tab-pane fade show active" id="a11" role="tabpanel" aria-labelledby="a1-tab" align="left">
                              A. PERSONAL INFORMATION
                              <div class="row border">
                                <!--info-->
                                <div class="col-md-5 border" style="color:black;">
                                  LEARNER/PARENT INFORMATION
                                  <table class="table">
                                    <?php
                                    include('../connect.php');
                                    $id = $_GET['id'];
                                    $sqlget11 = "SELECT * FROM new_student where lrn = $id";
                                    $sqldata11 = mysqli_query($conn, $sqlget11) or die('Error Displaying Data' . mysqli_connect_error());
                                    while ($row31 = mysqli_fetch_assoc($sqldata11)) {
                                    ?>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>LEARNER: </strong> <?php $category = $row31['category'];
                                                                                              echo " " . $row31['fname'] . " " . $row31['mname'] . " " . $row31['lname'];
                                                                                              $name = " " . $row31['fname'] . " " . $row31['mname'] . " " . $row31['lname']; ?></p>
                                        </td>
                                        <input style="color:black;" type="hidden" name="lrn" value="<?php echo $row31['lrn']; ?>">
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Gender:</strong> <?php echo " " . $row31['gender']; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Birth Date:</strong><?php echo " " . $row31['birth_date']; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Grade/Level:</strong> <select name="grade" id="" class="form-control">
                                              <option value="1">I</option>
                                              <option value="2">II</option>
                                              <option value="3">III</option>
                                              <option value="4">IV</option>
                                              <option value="5">V</option>
                                              <option value="6">VI</option>
                                            </select> </p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>LRN:</strong><?php echo " " . $row31['lrn']; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Current School:</strong><?php echo " " . $row31['school']; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Address of School:</strong><?php $address = $row31['address'];
                                                                                                      $_SESSION['address'] = $row31['address'];
                                                                                                      echo " " . $row31['school']; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Mother Tongue Spoken:</strong><?php echo " " . $row31['m_tounge']; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Address:</strong><?php echo " " . $row31['address']; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Gender:</strong><?php echo " " . $row31['gender']; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Parent/Guardian/Caregiver:</strong><?php echo " " . $row31['guardian'];
                                                                                                              $guardian = $row31['guardian']; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Work & Workplace:</strong><?php echo " " . $row31['work']; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Landline/Cell Phone No.:</strong><?php $contact = $row31['gurdian_contact'];
                                                                                                            echo " " . $row31['gurdian_contact']; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Email:</strong><?php echo " " . $row31['email']; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Mother Tongue Spoken:</strong><?php echo " " . $row31['guardian_mtounge']; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Interpreter or other Accomodations Needed:</strong><br><textarea name="others_2" class="form-control"></textarea></p>
                                        </td>
                                      </tr>
                                    <?php } ?>
                                  </table>
                                </div>
                                <!--info-->
                                <!--difficulty-->
                                <div class="col-md-3 border" align="left" style="color:black;">
                                  DIFFICULTIES (Select most relevant):
                                  <p style="color:black;"><input style="color:black;" type="checkbox" name="d6" value="1"> Difficulty in Seeing</p>
                                  <p style="color:black;"><input style="color:black;" type="checkbox" name="d1" value="1"> Difficulty in Hearing</p>
                                  <p style="color:black;"><input style="color:black;" type="checkbox" name="d2" value="1"> Difficulty in Communicating</p>
                                  <p style="color:black;"><input style="color:black;" type="checkbox" name="d3" value="1"> Difficulty in Moving/Walking</p>
                                  <p style="color:black;"><input style="color:black;" type="checkbox" name="d4" value="1"> Difficulty in Concentrating/Paying
                                    Attention </p>
                                  <p style="color:black;"><input style="color:black;" type="checkbox" name="d5" value="1"> Difficulty in Remembering/
                                    Understanding</p>
                                  <p style="color:black;">Other (please specify) <br><textarea name="others" id="" cols="25" rows="3"></textarea></p>
                                  <p style="color:black;"> Medical diagnosis(if yes, Indicate) <br><textarea name="medical_diagnos" id="" cols="25" rows="3"></textarea></p>
                                </div>
                                <!--difficulty-->
                                <!--meeting-->
                                <div class="col-md-4 border" align="left" style="color:black;">
                                  MEETING INFORMATION:
                                  <p style="color:black;">DATE OF MEETING <input style="color:black;" type="date" name="date_meeting"></p>
                                  <p style="color:black;">DATE OF LAST IEP<input style="color:black;" type="date" name="date_last_iep"></p>
                                  <strong>PURPOSE OF MEETING:</strong>
                                  <p style="color:black;"><input style="color:black;" type="radio" name="purpose" value="1"> Interim IEP</p>
                                  <p style="color:black;"><input style="color:black;" type="radio" name="purpose" value="2"> Initial IEP</p>
                                  <p style="color:black;"><input style="color:black;" type="radio" name="purpose" value="3"> Term IEP</p>
                                  <p style="color:black;"><input style="color:black;" type="radio" name="purpose" value="4"> IEP Following 3-Yr, Reevaluation</p>
                                  <p style="color:black;"><input style="color:black;" type="radio" name="purpose" value="5"> Revision to IEP Date <input style="color:black;" type="date" name="review_date"></p>
                                  <p style="color:black;"><input style="color:black;" type="radio" name="purpose" value="6"> Exit/Graduation</p>
                                  <p style="color:black;"> IEP Revision Without a Meeting At the request of </p>
                                  <p style="color:black;"> <input style="color:black;" type="radio" name="purpose" value="7">Parent</p>
                                  <p style="color:black;"> <input style="color:black;" type="radio" name="purpose" value="8">School</p>
                                  <p style="color:black;">IEP Review Date</p>
                                  <p style="color:black;">COMMENTS:<br><textarea name="comment" id="" cols="30" rows="3"></textarea></p>
                                </div>
                              </div>
                            </div>
                            <!--information-->
                            <!--team-->
                            <div class="tab-pane fade" id="a71" role="tabpanel" aria-labelledby="a1-tab" align="left">
                              <div class="row">
                                I. PRESENT LEVELS OF ACADEMIC ACHIEVEMENT AND FUNCTIONAL PERFORMANCE
                                <table class="table table-bordered">
                                  <tr class="bg-secondary text-white">
                                    <th style="color:black;">Result of initial or most recent evaluation of school and division assessments:</th>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_1_1"></textarea> </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_1_2"></textarea> </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_1_3"></textarea> </td>
                                  </tr>
                                  <tr class="bg-secondary text-white">
                                    <th style="color:black;">Description of academic, developmental and/or functional strengths:</th>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_2_1"></textarea> </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_2_2"></textarea> </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_2_3"></textarea> </td>
                                  </tr>
                                  <tr class="bg-secondary text-white">
                                    <th style="color:black;">Description of academic, developmental and/or functional needs:</th>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_3_1"></textarea> </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_3_2"></textarea> </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_3_3"></textarea> </td>
                                  </tr>
                                  <tr class="bg-secondary text-white">
                                    <th style="color:black;">Parental concerns regarding their child’s education:</th>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_4_1"></textarea> </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_4_2"></textarea> </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_4_3"></textarea> </td>
                                  </tr>
                                  <tr class="bg-secondary text-white">
                                    <th style="color:black;">Impact of the disability on involvement and progress in the general education curriculum (for preschool, how the disability affects participation in appropriate activities).</th>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_5_1"></textarea> </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_5_2"></textarea> </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;"> <textarea class="form-control" name="functional_5_3"></textarea> </td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                            <!--team-->
                            <!--functional-->
                            <div class="tab-pane fade" id="a61" role="tabpanel" aria-labelledby="a6-tab" align="left">
                              IEP TEAM MEMBERS IN ATTENDANCE
                              <div class="row">
                                <table class="table">
                                  <tr>
                                    <td style="color:black;">Parent/Guardian/Caregiver: <strong> <?php echo $guardian; ?> </strong></td>
                                    <td style="color:black;">School Psychologist: <input style="color:black;" type="text" class="form-control" name="psych"></td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;">Learner: <strong> <?php echo $name; ?></strong> </td>
                                    <td style="color:black;">Guidance Counselor/Designate: <input style="color:black;" type="text" class="form-control" name="guidance"></td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;">Principal/School Head: <input style="color:black;" type="text" class="form-control" name="principal"></td>
                                    <td style="color:black;">School Nurse : <input style="color:black;" type="text" class="form-control" name="nurse"></td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;">Other (name and role) : <input style="color:black;" class="form-control" name="other_name" type="text"></td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;">Special Education Teacher : <input style="color:black;" class="form-control" name="teacher" type="text"></td>
                                    <td style="color:black;">Therapist/Pathologist/Specialist : <input style="color:black;" class="form-control" name="therapist" type="text"></td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;" colspan="2">*Learner must be invited when transition is discussed
                                      **The IEP learn must include at least one regular education teacher of the learner (if the learner is or may be participating in the regular education environment
                                    </td>
                                  </tr>
                                  <tr align="center">
                                    <td style="color:black;" colspan="2">_____<u> <?php echo $guardian; ?></u>_____<br>Signature over Printed Name of Parent/Guardian/Caregiver
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;" rowspan="2" colspan="2">
                                      <p style="color:black;"><input style="color:black;" type="checkbox" value="1" name="if_1"> Not Applicable (learner will not be 18 within one year</p>
                                      <p style="color:black;"><input style="color:black;" type="checkbox" value="2" name="if_2">The learner has been informed of his/her rights under law and advised of the transfer of rights at age 18</p>
                                      <p style="color:black;">Distribution:</p>
                                      <p style="color:black;"><input style="color:black;" type="checkbox" value="1" name="dis_1"> Learner’s Folder</p>
                                      <p style="color:black;"> <input style="color:black;" type="checkbox" value="1" name="dis_2"> Parent/Guardian/Caregiver/ Ed Special Education/Receiving Teacher</p>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                            <!--functional-->
                            <!--factors-->
                            <div class="tab-pane fade" id="a21" role="tabpanel" aria-labelledby="profile-tab">
                              <div class="row">
                                <!--CONSIDERATION OF SPECIAL FACTORS-->
                                <div class="col-md-12" align="left">
                                  II. CONSIDERATION OF SPECIAL FACTORS
                                  <table class="table">
                                    <tr>
                                      <td style="color:black;" colspan="2">
                                        <p style="color:black;">a.)Does the learner have difficulty relating with people which impede his/her learning or the learning of other? </p>
                                      </td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_1" value="yes">Yes</td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_1" value="no">No</td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="2">
                                        <p style="color:black;">b.)if yes, consider the appropriateness of developing a Behavior Intervention Plan. Behavior Intervention Plan developed? Refer to Behavior InterventionPlan for additional information.</p>
                                      </td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_2" value="yes">Yes</td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_2" value="no">No</td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="2">
                                        <p style="color:black;">Does the leaner have difficulty in Moving/ Walking?
                                          If yes, consider the mobility needs as related to IEP and describe below.
                                        </p>
                                      </td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_3" value="yes">Yes</td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_3" value="no">No</td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="4"><textarea name="comment_3" id="" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="2">
                                        <p style="color:black;">Does the learner have difficulty in seeing or with blindness/visual impairment?
                                          If yes, provide for instruction in Braille and the use of Braille, unless the IEP Team determines that instruction in Braille is not appropriate for the learner after an
                                          evaluation of the learner’s reading and writing skills, needs, and appropriate reading and wrting media, including evaluation of future needs for instruction in Braille
                                          or the use of Braille. Describe below.
                                        </p>
                                      </td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_4" value="yes">Yes</td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_4" value="no">No</td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="4"><textarea name="comment_4" id="" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="2">
                                        <p style="color:black;">Does the learner have difficulty in communicating?
                                          If yes, consider the communication needs and describe below.
                                        </p>
                                      </td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_5" value="yes">Yes</td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_5" value="no">No</td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="4"><textarea name="comment_5" id="" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="2">
                                        <p style="color:black;">Does the learner have difficulty in concentrating/paying attention?
                                          If yes, consider the understanding needs and describe below.
                                        </p>
                                      </td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_6" value="yes">Yes</td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_6" value="no">No</td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="4"><textarea name="comment_6" id="" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="2">
                                        <p style="color:black;"><strong>Does the learner have difficulty in hearing or Is the learner deaf or hard of hearing?</strong>
                                          If yes, consider and describe the learner’s language and communication needs, opportunities for direct communication with peers and professional personnel in the
                                          learner’s language and communication mode, academic level and full range of needs, including opportunities for direct instruction in the learner’s language and
                                          communication mode. Describe communication needs below.
                                        </p>
                                      </td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_7" value="yes">Yes</td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_7" value="no">No</td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="4"><textarea name="comment_7" id="" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="2">
                                        <p style="color:black;"><strong>Does the learner need assistive technology devices or services?</strong>
                                          If yes, describe the type of assistive technology and how it is used. If no, describe how the learner’s needs are being met in deficit areas
                                        </p>
                                      </td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_8" value="yes">Yes</td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_8" value="no">No</td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="4"><textarea name="comment_8" id="" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="2">
                                        <p style="color:black;"><strong>Does the learner require alternative format for instructional materials?</strong>
                                          If yes, specify format(s) of materials required below.
                                        </p>
                                      </td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_9" value="yes">Yes</td>
                                      <td style="color:black;"><input style="color:black;" type="radio" name="factor_9" value="no">No</td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="4"><input style="color:black;" type="radio" name="factor_8_type" value="Braille"> Braille
                                        <input style="color:black;" type="radio" name="factor_8_type" value="Large Type"> Large Type
                                        <input style="color:black;" type="radio" name="factor_8_type" value="Auditory"> Auditory
                                        <input style="color:black;" type="radio" name="factor_8_type" value="Electronic text"> Electronic text
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="4"><textarea name="comment_9" id="" class="form-control"></textarea></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>
                            <!--factors-->
                            <!--abrriers-->
                            <div class="tab-pane fade" id="a31" role="tabpanel" aria-labelledby="contact-tab">
                              <div class="row">
                                <!--B.	DIFFICULTIES, BARRIERS AND ENABLING SUPPORTS-->
                                <div class="col-md-12" align="left">
                                  B. DIFFICULTIES, BARRIERS AND ENABLING SUPPORTS
                                  <table class="table table-bordered">
                                    <tr class="bg-secondary text-white">
                                      <th style="color:black;">DIFFICULTY (enter all areas of difficulty)</th>
                                      <th style="color:black;">ENVIRONMENTAL BARRIERS (describe each factor restricting participation)</th>
                                      <th style="color:black;">ENVIRONMENTAL FACILITATORS (describe each factor enabling participation in response to barriers) </th>
                                      <th style="color:black;">ENVIRONMENTAL FACILITATORS (describe each factor enabling participation in response to barriers)</th>
                                    </tr>
                                    <tr>
                                      <td style="color:black;"><textarea name="functional_1" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_2" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_3" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_4" id="" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;"><textarea name="functional_12" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_22" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_32" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_42" id="" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;"><textarea name="functional_13" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_23" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_33" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_43" id="" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;"><textarea name="functional_14" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_24" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_34" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_44" id="" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;"><textarea name="functional_15" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_25" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_35" id="" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea name="functional_45" id="" class="form-control"></textarea></td>
                                    </tr>
                                  </table>
                                  Selection of Barriers and Qualifiers for Environmental Barriers and Facilitators (taken from ICF)
                                  <table class="table table-bordered">
                                    <tr class="bg-secondary text-white">
                                      <th style="color:black;">DIFFICULTIES (select all relevant categories)</th>
                                      <th style="color:black;">Qualifiers for Environmental Barriers</th>
                                      <th style="color:black;">Qualifiers for Environmental Facilitators</th>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" rowspan="6">
                                        <p style="color:black;"> • Seeing </p>
                                        <p style="color:black;"> • Hearing </p>
                                        <p style="color:black;"> • Communicating </p>
                                        <p style="color:black;"> • Moving/Walking </p>
                                        <p style="color:black;"> • Concentrating/Paying Attention </p>
                                        <p style="color:black;"> • Remembering/understanding </p>
                                      </td>
                                      <td style="color:black;" rowspan="6">
                                        <p style="color:black;"> 0 No barrier </p>
                                        <p style="color:black;"> 1 Mild barrier </p>
                                        <p style="color:black;"> 2 Moderate barrier </p>
                                        <p style="color:black;"> 3 Severe barrier </p>
                                        <p style="color:black;"> 4 Complete barrier </p>
                                        <p style="color:black;"> 8 Barrier, not specified </p>
                                        <p style="color:black;"> 9 Not Applicable </p>
                                      </td>
                                      <td style="color:black;" rowspan="6">
                                        <p style="color:black;"> +1 Mild facilatator </p>
                                        <p style="color:black;"> +2 Moderate facilatator </p>
                                        <p style="color:black;"> +3 Substantial facilatator </p>
                                        <p style="color:black;"> +4 Complete facilatator </p>
                                        <p style="color:black;"> +8 Facilitator, not specified </p>
                                        <p style="color:black;"> +9 Not Applicable </p>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                                <!--B.	DIFFICULTIES, BARRIERS AND ENABLING SUPPORTS-->
                              </div>
                            </div>
                            <!--abrriers-->
                            <!--goal-->
                            <div class="tab-pane fade" id="a41" role="tabpanel" aria-labelledby="contact-tab">
                              <div class="row">
                                <!--B.	Goals-->
                                <div class="col-md-12" align="left">
                                  C. STUDENT GOALS
                                  <p style="color:black;"> To support identification of learner goals, also confirm:</p>
                                  <p style="color:black;"> • What opprtunites are available at the school to support learner goals?</p>
                                  <p style="color:black;"> • What are the student interest areas?</p>
                                  <p style="color:black;"> • What disability-specific skills does the learner need to develop to support their participation/ attainment of goals?</p>
                                  <p style="color:black;"> Goals –(eg.-Skills to improve participation in education or daily living skills. Goals should be SMART (Strategic, Measurable, Achievable, Realistic, and Time-bound)</p>
                                  <table class="table table-bordered">
                                    <tr class="bg-secondary text-white">
                                      <th style="color:black;">INTEREST</th>
                                      <th style="color:black;">GOAL</th>
                                      <th style="color:black;">INTERVENTIONS</th>
                                      <th style="color:black;">TIMELINE</th>
                                      <th style="color:black;">INDIVIDUALS RESPONSIBLE</th>
                                      <th style="color:black;">REMARKS </th>
                                      <th style="color:black;">PROGRESS/
                                        NEXT STEPS</th>
                                    </tr>
                                    <tr>
                                      <td style="color:black;"><textarea type="text" name="interest" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="goal" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="intervention" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="timeline" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="individual_responsible" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="remarks" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="progress" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;"><textarea type="text" name="interest2" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="goal2" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="intervention2" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="timeline2" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="individual_responsible2" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="remarks2" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="progress2" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;"><textarea type="text" name="interest3" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="goal3" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="intervention3" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="timeline3" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="individual_responsible3" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="remarks3" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="progress3" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;"><textarea type="text" name="interest4" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="goal4" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="intervention4" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="timeline4" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="individual_responsible4" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="remarks4" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="progress4" class="form-control"></textarea></td>
                                    </tr>
                                  </table>
                                  D. STUDENT TRANSITION
                                  <p style="color:black;">This section is for learners exiting the school environment and transitioning into work.</p>
                                  <table class="table table-bordered">
                                    <tr class="bg-secondary text-white">
                                      <th style="color:black;">INTEREST</th>
                                      <th style="color:black;">WORK OPPORTUNITIES</th>
                                      <th style="color:black;">INTERVENTIONS/
                                        TRANSITION SKILLS
                                      </th>
                                      <th style="color:black;">INDIVIDUALS RESPONSIBLE</th>
                                      <th style="color:black;">REMARKS</th>
                                    </tr>
                                    <tr>
                                      <td style="color:black;"><textarea type="text" name="transition_interest" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="work" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="skills" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="individual" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="transition_remarks" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;"><textarea type="text" name="transition_interest2" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="work2" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="skills2" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="individual2" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="transition_remarks2" class="form-control"></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;"><textarea type="text" name="transition_interest3" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="work3" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="skills3" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="individual3" class="form-control"></textarea></td>
                                      <td style="color:black;"><textarea type="text" name="transition_remarks3" class="form-control"></textarea></td>
                                    </tr>
                                  </table>
                                </div>
                                <!--B.	Goals-->
                                <div class="col-md-12">
                                  <p style="color:black;">IEP IMPLEMENTATION</p>
                                  ______________________ As the parent I agree with the components of this IEP, I understand that its provisions will be implemented as soon as possible after the IEP goes into effect.
                                  _____________________ As the parent, I disagree will or part of this IEP, I Understand that the School must provide me with written notice if any intent to implement this IEP. If I wish to prevent the implementation of this IEP, I must submit a written request for a due process hearing to school principal.
                                  <table class="table">
                                    <tr>
                                      <td style="color:black;" colspan="3" align="center">
                                        <p style="color:black;"><br>________<?php echo $guardian; ?>_______</p>
                                        <p style="color:black;">Parent’s Signature</p>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;">
                                        <p style="color:black;">_________________________________</p>
                                        <p style="color:black;">Special Education Teacher</p>
                                      </td>
                                      <td style="color:black;">
                                        <p style="color:black;">_________________________________</p>
                                        <p style="color:black;">Regular/Receiving Teacher <br>(if LSEN is in Inclusion)<br>Regular/Receiving Teacher</p>
                                      </td>
                                      <td style="color:black;">
                                        <p style="color:black;">________________________________<br>Principal/School Head</p>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;">
                                        <p style="color:black;">_________________________________<br>Learner (if applicable)</p>
                                      </td>
                                      <td style="color:black;">
                                        <p style="color:black;">_________________________________<br>Guidance Counselor/SPED Coordinator</p>
                                      </td>
                                      <td style="color:black;">
                                        <p style="color:black;">_________________________________<br>Psychologist/Other Specialist</p>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>
                            <!--goal-->
                          </div>
                          <!--CONSIDERATION OF SPECIAL FACTORS-->
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <ul class="nav nav-tabs ml-2" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#aaaa1" role="tab" aria-controls="home"
                  aria-selected="true">IEP</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="progress-tab" data-toggle="tab" href="#aaaa2" role="tab" aria-controls="progress"
                  aria-selected="false">ILP</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="progress-tab" data-toggle="tab" href="#ilmpview" role="tab" aria-controls="progress"
                  aria-selected="false">ILMP</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="progress-tab" data-toggle="tab" href="#birview" role="tab" aria-controls="progress"
                  aria-selected="false">BIR</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade container-fluid" id="birview" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <?php
                  $id = $_GET['id'];
                  $folder_id = $_GET['folder_id'];
                  $sqlbir = "SELECT * FROM bir where lrn = $id and folder_id = $folder_id";
                  $sqldatabir = mysqli_query($conn, $sqlbir) or die('Error Displaying Data' . mysqli_connect_error());
                  while ($rowbir = mysqli_fetch_assoc($sqldatabir)) {
                    $bir = $rowbir['bir'];
                  ?>
                    <div class="col-md-2" align="center">
                      <?php echo "BIR of " . $rowbir['date']; ?>
                      <a data-toggle="modal" data-target="#birview<?php echo $bir; ?>"> <img width="100" class="img-fluid" src="../img/bir.png" alt=""></a>
                    </div>
                    <!-- Modal BIR-->
                    <div class="modal fade" id="birview<?php echo $bir; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Add ILMP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body" align="center">
                            <a class="btn btn-success float-right mb-2" href="printBIR.php?bir_id=<?php echo $bir; ?>&lrn=<?php echo $_GET['id']; ?>&folder_id=<?php echo $_GET['folder_id']; ?>" target="_blank"> <i class="fas fa-print"></i> Print</a>
                            <form action="updateBIR.php?folder_id=<?php echo $_GET['folder_id']; ?>&lrn=<?php echo $_GET['id']; ?>&id=<?php echo $bir; ?>" method="POST">
                              <div class="row">
                                <h2 style="text-align:center">BEHAVIOR INTERVENTION REPORT (BIR)</h2>
                                <table class="table table-borderless" style="text-align:center;">
                                  <tr>
                                    <td style="color:black;">
                                      <div class="d-flex justify-content-center">
                                        <p style="color:black;"> School year:</p> <input style="color:black;" type="number" value="<?php echo $rowbir['school_year']; ?>" style="width:150px;" class="form-control ml-3" name="school_year">
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;">
                                      <div class="d-flex justify-content-center">
                                        <p style="color:black;"> Date of Observation:</p> <input style="color:black;" type="date" value="<?php echo $rowbir['date']; ?>" style="width:150px;" class="form-control ml-3" name="date_observation">
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;">
                                      <div class="d-flex justify-content-left">
                                        <p style="color:black;"> Name of Learners: _____<u><?php echo $name; ?></u>_______ </p>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;">
                                      <div class="d-flex justify-content-left">
                                        <p style="color:black;"> Learner’s Reference Number : _____<u><?php echo $_GET['id']; ?></u>_______ </p>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;">
                                      <div class="d-flex justify-content-left">
                                        <p style="color:black;"> Date of Birth : _____<u><?php echo $birth_date; ?></u>_______ </p>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;">
                                      <div class="d-flex justify-content-left">
                                        <p style="color:black;"> Age of Learner: ____<u> <?php
                                                                                          $date = date_create($birth_date);
                                                                                          $interval = $date->diff(new DateTime);
                                                                                          echo $interval->y;
                                                                                          ?></u>_____ Gender: _____<u><?php echo $gender; ?></u>_______ : </p>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;">Baseline Data: (refer to the SF9 or Anecdotal Record) <input style="color:black;" type="text" class="form-control" value="<?php echo $rowbir['baseline']; ?>" name="baseline"></td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;">Difficulty/Disability of the Learners:<input style="color:black;" type="text" class="form-control" value="<?php echo $rowbir['difficulty']; ?>" name="difficulty"></td>
                                  </tr>
                                  <tr style="text-align:left">
                                    <td style="color:black;">Check the appropriate box:</td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;">
                                      <div class="d-flex justify-content-start">
                                        <div><input style="color:black;" type="radio" value="1" <?php if ($rowbir['with_'] == '1') {
                                                                                                  echo 'checked';
                                                                                                } ?> style="width:50px;" name="with_"></div>
                                        <div>
                                          <p style="color:black;">With Medical Assessment</p>
                                        </div>
                                        <div>
                                          <p class="ml-5"> Results & Findings:</p>
                                        </div>
                                        <div><textarea type="text" name="result" class="form-control ml-3" style="width:650px;"><?php echo $rowbir['result']; ?></textarea></div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;">
                                      <div class="d-flex justify-content-start">
                                        <div><input style="color:black;" type="radio" <?php if ($rowbir['with_'] == '2') {
                                                                                        echo 'checked';
                                                                                      } ?> value="2" style="width:50px;" name="with_"></div>
                                        <div>
                                          <p style="color:black;">Without Medical Assessment</p>
                                        </div>
                                    </td>
                                  </tr>
                                  <tr style="text-align:left">
                                    <td style="color:black;">Educational Placement of LSEN:</td>
                                  </tr>
                                  <tr>
                                    <td style="color:black;">
                                      <div class="d-flex justify-content-start">
                                        <div><input style="color:black;" type="radio" value="1" style="width:50px;" <?php if ($rowbir['self'] == '1') {
                                                                                                                      echo 'checked';
                                                                                                                    } ?> name="self"></div>
                                        <div>
                                          <p style="color:black;">Self contained</p>
                                        </div>
                                        <div><input style="color:black;" type="radio" value="2" style="width:50px;" <?php if ($rowbir['self'] == '2') {
                                                                                                                      echo 'checked';
                                                                                                                    } ?> name="self"></div>
                                        <div>
                                          <p style="color:black;">Inclusion</p>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr style="text-align:left">
                                    <td style="color:black;">
                                      <p style="color:black;"> Parents: ___________<u><?php echo $guardian; ?></u>____________ </p>
                                      <p style="color:black;"> Contact: _________<u><?php echo $guardian_contact; ?></u>___________ </p>
                                      <div class="d-flex justify-content-start">
                                        <p style="color:black;"> work: _________<u><?php echo $work_; ?></u>____________ </p>
                                        <p style="color:black;"> Home: __________<u><?php echo $address; ?></u>__________ </p>
                                      </div>
                                    </td>
                                  </tr>
                                </table>
                                <?php
                                $sqlbir1 = "SELECT * FROM bir_intervention where bir_id = $bir ";
                                $sqldatabir1 = mysqli_query($conn, $sqlbir1) or die('Error Displaying Data' . mysqli_connect_error());
                                while ($rowbir1 = mysqli_fetch_assoc($sqldatabir1)) {
                                ?>
                                  <table class="table table-bordered">
                                    <tr>
                                      <th style="color:black;" colspan="4">BEHAVIOR MANIFESTATION & INTERVENTION</th>
                                    </tr>
                                    <tr>
                                      <td style="color:black;"></td>
                                      <td style="color:black;">At Home</td>
                                      <td style="color:black;">In School</td>
                                      <td style="color:black;">Other Settings</td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;">Antecedent/ Prior Behavior
                                        (Triggers/Signals)</td>
                                      <td style="color:black;"><textarea name="antecedent" id="" class="form-control"><?php echo $rowbir1['antecedent']; ?></textarea></td>
                                      <td style="color:black;"><textarea name="antecedent_2" id="" class="form-control"><?php echo $rowbir1['antecedent_2']; ?></textarea></td>
                                      <td style="color:black;"><textarea name="antecedent_3" id="" class="form-control"><?php echo $rowbir1['antecedent_3']; ?></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;">Observable Behavior</td>
                                      <td style="color:black;"><textarea name="observable" id="" class="form-control"><?php echo $rowbir1['observable']; ?></textarea></td>
                                      <td style="color:black;"><textarea name="observable_2" id="" class="form-control"><?php echo $rowbir1['observable_2']; ?></textarea></td>
                                      <td style="color:black;"><textarea name="observable_3" id="" class="form-control"><?php echo $rowbir1['observable_3']; ?></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;">Result/ Consequence of Behavior</td>
                                      <td style="color:black;"><textarea name="consequence" id="" class="form-control"><?php echo $rowbir1['consequence']; ?></textarea></td>
                                      <td style="color:black;"><textarea name="consequence_2" id="" class="form-control"><?php echo $rowbir1['consequence_2']; ?></textarea></td>
                                      <td style="color:black;"><textarea name="consequence_3" id="" class="form-control"><?php echo $rowbir1['consequence_3']; ?></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;">
                                        Intervention Done</td>
                                      <td style="color:black;"><textarea name="intervention_done" id="" class="form-control"><?php echo $rowbir1['intervention_done']; ?></textarea></td>
                                      <td style="color:black;"><textarea name="intervention_done_2" id="" class="form-control"><?php echo $rowbir1['intervention_done_2']; ?></textarea></td>
                                      <td style="color:black;"><textarea name="intervention_done_3" id="" class="form-control"><?php echo $rowbir1['intervention_done_3']; ?></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;">
                                        Proactive Strategies for Prevention</td>
                                      <td style="color:black;"><textarea name="proactive" id="" class="form-control"><?php echo $rowbir1['proactive']; ?></textarea></td>
                                      <td style="color:black;"><textarea name="proactive_2" id="" class="form-control"><?php echo $rowbir1['proactive_2']; ?></textarea></td>
                                      <td style="color:black;"><textarea name="proactive_3" id="" class="form-control"><?php echo $rowbir1['proactive_3']; ?></textarea></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;">
                                        Reactive Strategies for Immediate Intervention</td>
                                      <td style="color:black;"><textarea name="reactive" id="" class="form-control"><?php echo $rowbir1['reactive']; ?></textarea></td>
                                      <td style="color:black;"><textarea name="reactive_2" id="" class="form-control"><?php echo $rowbir1['reactive_2']; ?></textarea></td>
                                      <td style="color:black;"><textarea name="reactive_3" id="" class="form-control"><?php echo $rowbir1['reactive_3']; ?></textarea></td>
                                    </tr>
                                  <?php } ?>
                                  </table>
                                  <br><br><br>
                                  <table class="table table-bordered">
                                    <tr>
                                      <td style="color:black;">
                                        <p style="color:black;"> Targeted Behavior (Behavior to be decreased)</p>
                                        <textarea name="target" id="" class="form-control"><?php echo $rowbir['target']; ?></textarea>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;">
                                        <p style="color:black;"> Specific Objectives:</p>
                                        <textarea name="objective" id="" class="form-control"><?php echo $rowbir['objective']; ?></textarea>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;">
                                        <p style="color:black;"> Basic Intervention Report:</p>
                                        <textarea name="bir_intervention" id="" class="form-control"><?php echo $rowbir['bir_intervention']; ?></textarea>
                                      </td>
                                    </tr>
                                  </table>
                                  <table class="table table-borderless">
                                    <tr>
                                      <td style="color:black;">
                                        <div class="d-flex justify-content-center">
                                          <div>
                                            <p class="mr-1">Prepared by:</p>
                                          </div>
                                          <div><input style="color:black;" type="text" class="form-control" value="<?php echo $rowbir['teacher']; ?>" name="teacher" style="width:300px">
                                            <p class="ml-5"> Name of Teacher </p>
                                          </div>
                                          <div>
                                            <p class="mr-2 ml-5">Conformed:</p>
                                          </div>
                                          <div><input style="color:black;" type="text" class="form-control" value="<?php echo $guardian; ?>" readonly style="width:300px">
                                            <p class="ml-5">Parent/Guardian</p>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;">
                                        <div class="d-flex justify-content-center">
                                          <div>
                                            <p style="color:black;">Noted:</p>
                                          </div>
                                          <div><input style="color:black;" type="text" class="form-control" value="<?php echo $rowbir['principal']; ?>" name="principal" style="width:300px">
                                            <p class="ml-5">Name of Principal/School Head</p>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                  </table>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- modal BIR -->
                  <?php } ?>
                </div>
              </div>
              <!-- ilmp view -->
              <div class="tab-pane fade container-fluid" id="ilmpview" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <?php
                  $ilmp_id = "";
                  $c_1 = "";
                  $c_2 = "";
                  $c_3 = "";
                  $id1 = $_GET['id'];
                  $sqldif = "SELECT * FROM ilmp_group where lrn = $id1 and folder_id = $folder_id";
                  $sqldatadif = mysqli_query($conn, $sqldif) or die('Error Displaying Data' . mysqli_connect_error());
                  while ($rowdif = mysqli_fetch_assoc($sqldatadif)) {
                    $ilmp_id = $rowdif['ilmp_group_id'];
                    $c_1 = $rowdif['c_1'];
                    $c_2 = $rowdif['c_2'];
                    $c_3 = $rowdif['c_3'];
                  ?>
                    <div class="col-md-2" align="center">
                      <?php echo "ILMP of " . $rowdif['ilmp_date']; ?>
                      <a data-toggle="modal" data-target="#ilmpview<?php echo $ilmp_id; ?>"> <img width="100" class="img-fluid" src="../img/ilmp.png" alt=""></a>
                    </div>
                    <!-- Modal ILMP-->
                    <div class="modal fade" id="ilmpview<?php echo $ilmp_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Add ILMP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="updateILMP.php?id=<?php echo $ilmp_id; ?>&lrn=<?php echo $_GET['id']; ?>&folder_id=<?php echo $_GET['folder_id']; ?>" method="POST">
                              <div class="row">
                                <div class="col-md-12">
                                  <h3>INDIVIDUAL LEARNING MONITORING PLAN</h3>
                                  <a class="btn btn-success float-right mb-2" href="printILMP.php?ilmp_id=<?php echo $ilmp_id; ?>&lrn=<?php echo $_GET['id']; ?>&folder_id=<?php echo $_GET['folder_id']; ?>" target="_blank"> <i class="fas fa-print"></i> Print</a>
                                  <table class="table table-bordered">
                                    <tr>
                                      <td style="color:black;" colspan="8">Learner's name: <?php echo $name; ?></td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="8">Grade level: <?php echo $grade; ?></td>
                                    </tr>
                                    <tr>
                                      <th style="color:black;" rowspan="2" style="text-align:center;">Learning Area</th>
                                      <th style="color:black;" rowspan="2" style="text-align:center;">Learner’s Needs</th>
                                      <th style="color:black;" rowspan="2" style="text-align:center;">Intervention Strategies Provided</th>
                                      <th style="color:black;" rowspan="2" style="text-align:center;">Monitoring Date</th>
                                      <th style="color:black;" colspan="3" style="text-align:center;">Learner’s Status</th>
                                    </tr>
                                    <tr style="text-align:center;">
                                      <th style="color:black;">Insignificant Progress</th>
                                      <th style="color:black;">Significant Progress</th>
                                      <th style="color:black;">Mastery</th>
                                    </tr>
                                    <?php
                                    $cnt = 1;
                                    $sqlilmp = "SELECT * FROM ilmp where ilmp_id = $ilmp_id";
                                    $sqldatailmp = mysqli_query($conn, $sqlilmp) or die('Error Displaying Data' . mysqli_connect_error());
                                    while ($ilmp = mysqli_fetch_assoc($sqldatailmp)) {
                                    ?>
                                      <tr>
                                        <td style="color:black;"><textarea name="learning_area<?php echo $cnt; ?>" id="" class="form-control"><?php echo $ilmp['learning_area']; ?></textarea></td>
                                        <td style="color:black;"><textarea name="learner_need<?php echo $cnt; ?>" id="" class="form-control"><?php echo $ilmp['learner_need']; ?></textarea></td>
                                        <td style="color:black;"><textarea name="intervention<?php echo $cnt; ?>" id="" class="form-control"><?php echo $ilmp['intervention']; ?></textarea></td>
                                        <td style="color:black;"><input style="color:black;" type="date" name="monitoring_date<?php echo $cnt; ?>" id="" value="<?php echo $ilmp['monitoring_date']; ?>" class="form-control"></td>
                                        <td style="color:black;"><textarea name="insignificant<?php echo $cnt; ?>" id="" class="form-control"><?php echo $ilmp['insignificant']; ?></textarea></td>
                                        <td style="color:black;"><textarea name="significant<?php echo $cnt; ?>" id="" class="form-control"><?php echo $ilmp['significant']; ?></textarea></td>
                                        <td style="color:black;"><textarea name="mastery<?php echo $cnt; ?>" id="" class="form-control"><?php echo $ilmp['mastery']; ?></textarea></td>
                                      </tr>
                                    <?php
                                      $cnt++;
                                    } ?>
                                    <tr>
                                      <th style="color:black;" rowspan="3">Intervention Status</th>
                                      <td style="color:black;" colspan="6"><input style="color:black;" type="checkbox" <?php if ($c_1 != '') {
                                                                                                                          echo 'checked';
                                                                                                                        } ?> name="c_1"> Learner is not making significant progress in a timely manner. Intervention strategies need to be revised.</td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="6"><input style="color:black;" type="checkbox" <?php if ($c_2 != '') {
                                                                                                                          echo 'checked';
                                                                                                                        } ?> name="c_2"> Learner is making significant progress. Continue with the learning plan. </td>
                                    </tr>
                                    <tr>
                                      <td style="color:black;" colspan="6"><input style="color:black;" type="checkbox" <?php if ($c_3 != '') {
                                                                                                                          echo 'checked';
                                                                                                                        } ?> name="c_3"> Learner has reached mastery of the competencies in learning plan. </td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- modal ILMP -->
                  <?php } ?>
                </div>
              </div>
              <!-- ilmp view -->
              <!-- aaaa1 -->
              <div class="tab-pane fade active show container-fluid" id="aaaa1" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <?php
                  $id1 = $_GET['id'];
                  $sqldif = "SELECT * FROM iep_difficulty where lrn = $id1 and folder_id = $folder_id";
                  $sqldatadif = mysqli_query($conn, $sqldif) or die('Error Displaying Data' . mysqli_connect_error());
                  while ($rowdif = mysqli_fetch_assoc($sqldatadif)) {
                    $iid = $rowdif['iep_id'];
                  ?>
                    <div class="col-md-2" align="center">
                      <?php echo "IEP of " . $rowdif['date_meeting']; ?>
                      <a data-toggle="modal" data-target="#example1<?php echo $iid; ?>"> <img width="100" class="img-fluid" src="../img/iep.png" alt=""></a>
                    </div>
                    <!-- Modal iep update -->
                    <div class="modal fade" id="example1<?php echo $iid; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Update IEP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <a class="btn btn-success float-right" href="printIEP.php?iep_id=<?php echo $iid; ?>&lrn=<?php echo $id1; ?>&folder_id=<?php echo $_GET['folder_id']; ?>" target="_blank"> <i class="fas fa-print"></i> Print</a>
                            <form action="updateIEPform.php?id=<?php echo $iid; ?>&folder_id=<?php echo $_GET['folder_id']; ?>&lrn=<?php echo $_GET['id']; ?>" method="POST">
                              <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="a1-tab" data-toggle="tab" href="#infoUpdate" role="tab" aria-controls="a1"
                                    aria-selected="true">Information</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="a1-tab" data-toggle="tab" href="#ateamUpdate" role="tab" aria-controls="a1"
                                    aria-selected="true">Team</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="a1-tab" data-toggle="tab" href="#functionUpdate" role="tab" aria-controls="a1"
                                    aria-selected="true">Functional Performance</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#considerationUpdate" role="tab" aria-controls="profile"
                                    aria-selected="false">Consideration</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#barrierUpdate" role="tab" aria-controls="contact"
                                    aria-selected="false">Barriers</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#goalUpdate" role="tab" aria-controls="contact"
                                    aria-selected="false">Goals && Transition</a>
                                </li>
                              </ul>
                              <div class="tab-content" id="myTabContent">
                                <!--team-->
                                <div class="tab-pane fade" id="functionUpdate" role="tabpanel" aria-labelledby="a1-tab" align="left">
                                  <div class="row">
                                    <h5 style="color:black;" class="mt-4"> I. PRESENT LEVELS OF ACADEMIC ACHIEVEMENT AND FUNCTIONAL PERFORMANCE</h5>
                                    <table class="table table-bordered">
                                      <tr class="bg-secondary text-white">
                                        <th style="color:black;">Result of initial or most recent evaluation of school and division assessments:</th>
                                      </tr>
                                      <?php
                                      $function1 = "";
                                      $function2 = "";
                                      $function3 = "";
                                      $function4 = "";
                                      $function5 = "";
                                      $function1_2 = "";
                                      $function2_2 = "";
                                      $function3_2 = "";
                                      $function4_2 = "";
                                      $function5_2 = "";
                                      $function1_3 = "";
                                      $function2_3 = "";
                                      $function3_3 = "";
                                      $function4_3 = "";
                                      $function5_3 = "";
                                      include('../connect.php');
                                      $id1 = $_GET['id'];
                                      $f_id = $_GET['folder_id'];
                                      $sqlget1 = "SELECT * FROM iep_functional where lrn = $id1 and folder_id = $f_id and iep_id = $iid";
                                      $sqldata1 = mysqli_query($conn, $sqlget1) or die('Error Displaying Data' . mysqli_connect_error());
                                      while ($row1 = mysqli_fetch_assoc($sqldata1)) {
                                        $function1 = $row1['functional_1'];
                                        $function2 = $row1['functional_2'];
                                        $function3 = $row1['functional_3'];
                                        $function4 = $row1['functional_4'];
                                        $function5 = $row1['functional_5'];
                                        $function1_2 = $row1['functional_1_2'];
                                        $function2_2 = $row1['functional_2_2'];
                                        $function3_2 = $row1['functional_3_2'];
                                        $function4_2 = $row1['functional_4_2'];
                                        $function5_2 = $row1['functional_5_2'];
                                        $function1_3 = $row1['functional_1_3'];
                                        $function2_3 = $row1['functional_2_3'];
                                        $function3_3 = $row1['functional_3_3'];
                                        $function4_3 = $row1['functional_4_3'];
                                        $function5_3 = $row1['functional_5_3'];
                                      ?>
                                      <?php }
                                      ?>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_1" class="form-control" id="" cols="30" rows="2"><?php echo  $function1; ?></textarea> </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_1_2" class="form-control" id="" cols="30" rows="2"><?php echo  $function1_2; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_1_3" class="form-control" id="" cols="30" rows="2"><?php echo  $function1_3; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr class="bg-secondary text-white">
                                        <th style="color:black;">Description of academic, developmental and/or functional strengths:</th>
                                      </tr>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_2" class="form-control" id="" cols="30" rows="2"><?php echo  $function2; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_2_2" class="form-control" id="" cols="30" rows="2"><?php echo  $function2_2; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_2_3" class="form-control" id="" cols="30" rows="2"><?php echo  $function2_3; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr class="bg-secondary text-white">
                                        <th style="color:black;">Description of academic, developmental and/or functional needs:</th>
                                      </tr>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_3" class="form-control" id="" cols="30" rows="2"><?php echo  $function3; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_3_2" class="form-control" id="" cols="30" rows="2"><?php echo  $function3_2; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_3_3" class="form-control" id="" cols="30" rows="2"><?php echo  $function3_3; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr class="bg-secondary text-white">
                                        <th style="color:black;">Parental concerns regarding their child’s education:</th>
                                      </tr>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_4" class="form-control" id="" cols="30" rows="2"><?php echo  $function4; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_4_2" class="form-control" id="" cols="30" rows="2"><?php echo  $function4_2; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_4_3" class="form-control" id="" cols="30" rows="2"><?php echo  $function4_3; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr class="bg-secondary text-white">
                                        <th style="color:black;">Impact of the disability on involvement and progress in the general education curriculum (for preschool, how the disability affects participation in appropriate activities).</th>
                                      </tr>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_5" class="form-control" id="" cols="30" rows="2"><?php echo  $function5; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_5_2" class="form-control" id="" cols="30" rows="2"><?php echo  $function5_2; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;"> <textarea name="functional_5_3" class="form-control" id="" cols="30" rows="2"><?php echo  $function5_3; ?></textarea></p>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                                <!--team-->
                                <!--functional-->
                                <div class="tab-pane fade" id="a6update" role="tabpanel" aria-labelledby="a6-tab" align="left">
                                  IEP TEAM MEMBERS IN ATTENDANCE
                                  <div class="row">
                                    <table class="table">
                                      <tr>
                                        <td style="color:black;">Parent/Guardian/Caregiver: <strong> <?php echo $guardian; ?> </strong></td>
                                        <td style="color:black;">School Psychologist: <input style="color:black;" type="text" class="form-control" name="psych"></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">Learner: <strong> <?php echo $name; ?></strong> </td>
                                        <td style="color:black;">Guidance Counselor/Designate: <input style="color:black;" type="text" class="form-control" name="guidance"></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">Principal/School Head: <input style="color:black;" type="text" class="form-control" name="principal"></td>
                                        <td style="color:black;">School Nurse : <input style="color:black;" type="text" class="form-control" name="nurse"></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">Other (name and role) : <input style="color:black;" class="form-control" name="other_name" type="text"></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">Special Education Teacher : <input style="color:black;" class="form-control" name="teacher" type="text"></td>
                                        <td style="color:black;">Therapist/Pathologist/Specialist : <input style="color:black;" class="form-control" name="therapist" type="text"></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;" colspan="2">*Learner must be invited when transition is discussed
                                          **The IEP learn must include at least one regular education teacher of the learner (if the learner is or may be participating in the regular education environment
                                        </td>
                                      </tr>
                                      <tr align="center">
                                        <td style="color:black;" colspan="2">_____<u> <?php echo $guardian; ?></u>_____<br>Signature over Printed Name of Parent/Guardian/Caregiver
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;" rowspan="2" colspan="2">
                                          <p style="color:black;"><input style="color:black;" type="checkbox" value="1" name="if_1"> Not Applicable (learner will not be 18 within one year</p>
                                          <p style="color:black;"><input style="color:black;" type="checkbox" value="2" name="if_2">The learner has been informed of his/her rights under law and advised of the transfer of rights at age 18</p>
                                          <p style="color:black;">Distribution:</p>
                                          <p style="color:black;"><input style="color:black;" type="checkbox" value="1" name="dis_1"> Learner’s Folder</p>
                                          <p style="color:black;"> <input style="color:black;" type="checkbox" value="1" name="dis_2"> Parent/Guardian/Caregiver/ Ed Special Education/Receiving Teacher</p>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                                <!--functional-->
                                <!--factors-->
                                <div class="tab-pane fade" id="considerationUpdate" role="tabpanel" aria-labelledby="profile-tab">
                                  <div class="row">
                                    <!--CONSIDERATION OF SPECIAL FACTORS-->
                                    <div class="col-md-12" align="left">
                                      <h5 style="color:black;" class="mt-4">II. CONSIDERATION OF SPECIAL FACTORS</h5>
                                      <?php
                                      $factor1 = "";
                                      $factor2 = "";
                                      $factor3 = "";
                                      $factor4 = "";
                                      $factor5 = "";
                                      $factor6 = "";
                                      $factor7 = "";
                                      $factor8 = "";
                                      $factor9 = "";
                                      $factor_type = "";
                                      $comment1 = "";
                                      $comment2 = "";
                                      $comment3 = "";
                                      $comment4 = "";
                                      $comment5 = "";
                                      $comment6 = "";
                                      $comment7 = "";
                                      $comment8 = "";
                                      $comment9 = "";
                                      include('../connect.php');
                                      $id1 = $_GET['id'];
                                      $folder_id = $_GET['folder_id'];
                                      $sqlget2 = "SELECT * FROM iep_special_factor where lrn = $id1 and folder_id = $folder_id and iep_id = $iid";
                                      $sqldata2 = mysqli_query($conn, $sqlget2) or die('Error Displaying Data' . mysqli_connect_error());
                                      while ($row2 = mysqli_fetch_assoc($sqldata2)) {
                                        $factor1 = $row2['factor_1'];
                                        $factor2 =  $row2['factor_2'];
                                        $factor3 =  $row2['factor_3'];
                                        $factor4 =  $row2['factor_4'];
                                        $factor5 =  $row2['factor_5'];
                                        $factor6 =  $row2['factor_6'];
                                        $factor7 =  $row2['factor_7'];
                                        $factor8 =  $row2['factor_8'];
                                        $factor9 =  $row2['factor_9'];
                                        $factor_type = $row2['factor_8_type'];
                                        $comment3 = $row2['comment_3'];
                                        $comment4 = $row2['comment_4'];
                                        $comment5 = $row2['comment_5'];
                                        $comment6 = $row2['comment_6'];
                                        $comment7 = $row2['comment_7'];
                                        $comment8 = $row2['comment_8'];
                                        $comment9 = $row2['comment_9'];
                                      ?>
                                      <?php }
                                      ?>
                                      <table class="table">
                                        <tr>
                                          <td style="color:black;" colspan="2">
                                            <p style="color:black;">a.)Does the learner have difficulty relating with people which impede his/her learning or the learning of other? </p>
                                          </td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor1 == 'yes') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_1" value="yes">Yes</td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor1 == 'no') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_1" value="no">No</td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="2">
                                            <p style="color:black;">b.)if yes, consider the appropriateness of developing a Behavior Intervention Plan. Behavior Intervention Plan developed? Refer to Behavior InterventionPlan for additional information.</p>
                                          </td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor2 == 'yes') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_2" value="yes">Yes</td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor2 == 'no') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_2" value="no">No</td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="2">
                                            <p style="color:black;">Does the leaner have difficulty in Moving/ Walking?
                                              If yes, consider the mobility needs as related to IEP and describe below.
                                            </p>
                                          </td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor3 == 'yes') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_3" value="yes">Yes</td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor3 == 'no') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_3" value="no">No</td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="4"><textarea name="comment_3" class="form-control" id="" cols="30" rows="2"><?php echo $comment3; ?></textarea> </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="2">
                                            <p style="color:black;">Does the learner have difficulty in seeing or with blindness/visual impairment?
                                              If yes, provide for instruction in Braille and the use of Braille, unless the IEP Team determines that instruction in Braille is not appropriate for the learner after an
                                              evaluation of the learner’s reading and writing skills, needs, and appropriate reading and wrting media, including evaluation of future needs for instruction in Braille
                                              or the use of Braille. Describe below.
                                            </p>
                                          </td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor4 == 'yes') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_4" value="yes">Yes</td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor4 == 'no') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_4" value="no">No</td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="4"><textarea name="comment_4" class="form-control" id="" cols="30" rows="2"><?php echo $comment4; ?></textarea> </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="2">
                                            <p style="color:black;">Does the learner have difficulty in communicating?
                                              If yes, consider the communication needs and describe below.
                                            </p>
                                          </td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor5 == 'yes') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_5" value="yes">Yes</td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor5 == 'no') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_5" value="no">No</td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="4"><textarea name="comment_5" class="form-control" id="" cols="30" rows="2"><?php echo $comment5; ?></textarea> </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="2">
                                            <p style="color:black;">Does the learner have difficulty in concentrating/paying attention?
                                              If yes, consider the understanding needs and describe below.
                                            </p>
                                          </td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor6 == 'yes') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_6" value="yes">Yes</td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor6 == 'no') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_6" value="no">No</td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="4"><textarea name="comment_6" class="form-control" id="" cols="30" rows="2"><?php echo $comment6; ?></textarea> </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="2">
                                            <p style="color:black;">Does the learner have difficulty in hearing or Is the learner deaf or hard of hearing?</strong>
                                              If yes, consider and describe the learner’s language and communication needs, opportunities for direct communication with peers and professional personnel in the
                                              learner’s language and communication mode, academic level and full range of needs, including opportunities for direct instruction in the learner’s language and
                                              communication mode. Describe communication needs below.
                                            </p>
                                          </td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor7 == 'yes') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_7" value="yes">Yes</td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor7 == 'no') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_7" value="no">No</td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="4"><textarea name="comment_7" class="form-control" id="" cols="30" rows="2"><?php echo $comment7; ?></textarea> </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="2">
                                            <p style="color:black;">Does the learner need assistive technology devices or services?</strong>
                                              If yes, describe the type of assistive technology and how it is used. If no, describe how the learner’s needs are being met in deficit areas
                                            </p>
                                          </td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor8 == 'yes') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_8" value="yes">Yes</td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor8 == 'no') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_8" value="no">No</td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="4"><textarea name="comment_8" class="form-control" id="" cols="30" rows="2"><?php echo $comment8; ?></textarea> </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="2">
                                            <p style="color:black;">Does the learner require alternative format for instructional materials?</strong>
                                              If yes, specify format(s) of materials required below.
                                            </p>
                                          </td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor9 == 'yes') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_9" value="yes">Yes</td>
                                          <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor9 == 'no') {
                                                                                                              echo 'checked';
                                                                                                            } ?> name="factor_9" value="no">No</td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="4"><input style="color:black;" type="radio" <?php if ($factor_type == 'Braille') {
                                                                                                                          echo 'checked';
                                                                                                                        } ?> name="factor_8_type" value="Braille"> Braille
                                            <input style="color:black;" type="radio" name="factor_8_type" <?php if ($factor_type == 'Large Type') {
                                                                                                            echo 'checked';
                                                                                                          } ?> value="Large Type"> Large Type
                                            <input style="color:black;" type="radio" name="factor_8_type" <?php if ($factor_type == 'Auditory') {
                                                                                                            echo 'checked';
                                                                                                          } ?> value="Auditory"> Auditory
                                            <input style="color:black;" type="radio" name="factor_8_type" <?php if ($factor_type == 'Electronic text') {
                                                                                                            echo 'checked';
                                                                                                          } ?> value="Electronic text"> Electronic text
                                          </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" colspan="4"><textarea name="comment_9" class="form-control" id="" cols="30" rows="2"><?php echo $comment9; ?></textarea> </td>
                                        </tr>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                                <!--factors-->
                                <!--abrriers-->
                                <div class="tab-pane fade" id="barrierUpdate" role="tabpanel" aria-labelledby="contact-tab">
                                  <div class="row">
                                    <!--B.	DIFFICULTIES, BARRIERS AND ENABLING SUPPORTS-->
                                    <div class="col-md-12" align="left">
                                      <h5 style="color:black;" class="mt-4"> B. DIFFICULTIES, BARRIERS AND ENABLING SUPPORTS</h5>
                                      <table class="table table-bordered">
                                        <tr class="bg-secondary text-white">
                                          <th style="color:black;">DIFFICULTY (enter all areas of difficulty)</th>
                                          <th style="color:black;">ENVIRONMENTAL BARRIERS (describe each factor restricting participation)</th>
                                          <th style="color:black;">ENVIRONMENTAL FACILITATORS (describe each factor enabling participation in response to barriers) </th>
                                          <th style="color:black;">ENVIRONMENTAL FACILITATORS (describe each factor enabling participation in response to barriers)</th>
                                        </tr>
                                        <?php
                                        include('../connect.php');
                                        $id1 = $_GET['id'];
                                        $count = 0;
                                        $folder_id = $_GET['folder_id'];
                                        $sqlget3 = "SELECT * FROM iep_barriers where lrn = $id1 and folder_id = $folder_id and iep_id = $iid";
                                        $sqldata3 = mysqli_query($conn, $sqlget3) or die('Error Displaying Data' . mysqli_connect_error());
                                        while ($row3 = mysqli_fetch_assoc($sqldata3)) {
                                          $count++;
                                        ?>
                                          <tr>
                                            <td style="color:black;"><textarea name="barrier_1_<?php echo $count; ?>" id="" class="form-control" cols="30" rows="3"><?php echo $row3['barrier_1']; ?> </textarea></td>
                                            <td style="color:black;"><textarea name="barrier_2_<?php echo $count; ?>" id="" class="form-control" cols="30" rows="3"><?php echo $row3['barrier_2']; ?></textarea></td>
                                            <td style="color:black;"><textarea name="barrier_3_<?php echo $count; ?>" id="" class="form-control" cols="30" rows="3"><?php echo $row3['barrier_3']; ?></textarea></td>
                                            <td style="color:black;"><textarea name="barrier_4_<?php echo $count; ?>" id="" class="form-control" cols="30" rows="3"><?php echo $row3['barrier_4']; ?></textarea></td>
                                          </tr>
                                        <?php }
                                        ?>
                                      </table>
                                      Selection of Barriers and Qualifiers for Environmental Barriers and Facilitators (taken from ICF)
                                      <table class="table table-bordered">
                                        <tr class="bg-secondary text-white">
                                          <th style="color:black;">DIFFICULTIES (select all relevant categories)</th>
                                          <th style="color:black;">Qualifiers for Environmental Barriers</th>
                                          <th style="color:black;">Qualifiers for Environmental Facilitators</th>
                                        </tr>
                                        <tr>
                                          <td style="color:black;" rowspan="6">
                                            <p style="color:black;"> • Seeing </p>
                                            <p style="color:black;"> • Hearing </p>
                                            <p style="color:black;"> • Communicating </p>
                                            <p style="color:black;"> • Moving/Walking </p>
                                            <p style="color:black;"> • Concentrating/Paying Attention </p>
                                            <p style="color:black;"> • Remembering/understanding </p>
                                          </td>
                                          <td style="color:black;" rowspan="6">
                                            <p style="color:black;"> 0 No barrier </p>
                                            <p style="color:black;"> 1 Mild barrier </p>
                                            <p style="color:black;"> 2 Moderate barrier </p>
                                            <p style="color:black;"> 3 Severe barrier </p>
                                            <p style="color:black;"> 4 Complete barrier </p>
                                            <p style="color:black;"> 8 Barrier, not specified </p>
                                            <p style="color:black;"> 9 Not Applicable </p>
                                          </td>
                                          <td style="color:black;" rowspan="6">
                                            <p style="color:black;"> +1 Mild facilatator </p>
                                            <p style="color:black;"> +2 Moderate facilatator </p>
                                            <p style="color:black;"> +3 Substantial facilatator </p>
                                            <p style="color:black;"> +4 Complete facilatator </p>
                                            <p style="color:black;"> +8 Facilitator, not specified </p>
                                            <p style="color:black;"> +9 Not Applicable </p>
                                          </td>
                                        </tr>
                                      </table>
                                    </div>
                                    <!--B.	DIFFICULTIES, BARRIERS AND ENABLING SUPPORTS-->
                                  </div>
                                </div>
                                <!--abrriers-->
                                <!-- iepinfoupdate -->
                                <div class="tab-pane active show" id="infoUpdate" role="tabpanel" aria-labelledby="a1-tab" align="left">
                                  <h5 style="color:black;" class="mt-4"> A. PERSONAL INFORMATION </h5>
                                  <?php
                                  $d_seeing = '';
                                  $d_hearing = '';
                                  $d_moving = '';
                                  $d_concentrating = '';
                                  $d_remembering = '';
                                  $d_others = '';
                                  $others = '';
                                  $others_2 = '';
                                  $medical_diagnos = '';
                                  $date_meeting = '';
                                  $date_last_iep = '';
                                  $purpose = '';
                                  $review_date = '';
                                  $comment = '';
                                  $grade = '';
                                  include('../connect.php');
                                  $id1 = $_GET['id'];
                                  $sqldif1 = "SELECT * FROM iep_difficulty where lrn = $id1 and folder_id = $folder_id and iep_id = $iid";
                                  $sqldatadif1 = mysqli_query($conn, $sqldif1) or die('Error Displaying Data' . mysqli_connect_error());
                                  while ($rowdif1 = mysqli_fetch_assoc($sqldatadif1)) {
                                    $d_seeing = $rowdif1['d_seeing'];
                                    $d_hearing = $rowdif1['d_hearing'];
                                    $d_moving = $rowdif1['d_moving'];
                                    $d_com = $rowdif1['d_com'];
                                    $d_concentrating = $rowdif1['d_concentrating'];
                                    $d_remembering = $rowdif1['d_remembering'];
                                    $d_others = $rowdif1['d_other'];
                                    $others = $rowdif1['others'];
                                    $others_2 = $rowdif1['others_2'];
                                    $medical_diagnos = $rowdif1['medical_diagnos'];
                                    $date_meeting = $rowdif1['date_meeting'];
                                    $date_last_iep = $rowdif1['date_last_iep'];
                                    $purpose = $rowdif1['purpose'];
                                    $review_date = $rowdif1['review_date'];
                                    $comment = $rowdif1['comment'];
                                    $grade = $rowdif1['grade'];
                                  }
                                  ?>
                                  <div class="row border">
                                    <!--info-->
                                    <div class="col-md-3 border">
                                      <table class="table">
                                        <tr>
                                          <td style="color:black;">
                                            <p style="color:black;"><strong>Grade/Level:</strong> <select name="grade" class="form-control" id="">
                                                <option value="<?php echo $grade; ?>"><?php echo $grade; ?></option>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                                <option value="VI">VI</option>
                                              </select> </p>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;">
                                            <p style="color:black;"><strong>Interpreter or other Accomodations Needed:</strong><br><textarea name="others_2" class="form-control"><?php echo $others_2; ?></textarea></p>
                                          </td>
                                        </tr>
                                      </table>
                                    </div>
                                    <!--info-->
                                    <!--difficulty-->
                                    <div class="col-md-4 border" align="left" style="color:black;">
                                      DIFFICULTIES (Select most relevant):
                                      <p style="color:black;"><input style="color:black;" name="d_seeing" type="checkbox" <?php if ($d_seeing != '') {
                                                                                                                            echo 'checked';
                                                                                                                          }  ?> value="1"> Difficulty in Seeing</p>
                                      <p style="color:black;"><input style="color:black;" name="d_hearing" <?php if ($d_hearing != '') {
                                                                                                              echo 'checked';
                                                                                                            }  ?> type="checkbox" value="1"> Difficulty in Hearing</p>
                                      <p style="color:black;"><input style="color:black;" name="d_com" type="checkbox" <?php if ($d_com != '') {
                                                                                                                          echo 'checked';
                                                                                                                        }  ?> value="1"> Difficulty in Communicating</p>
                                      <p style="color:black;"><input style="color:black;" name="d_moving" type="checkbox" <?php if ($d_moving != '') {
                                                                                                                            echo 'checked';
                                                                                                                          }  ?> value="1"> Difficulty in Moving/Walking</p>
                                      <p style="color:black;"><input style="color:black;" type="checkbox" name="d_concentrating" <?php if ($d_concentrating != '') {
                                                                                                                                    echo 'checked';
                                                                                                                                  }  ?> value="1"> Difficulty in Concentrating/Paying
                                        Attention </p>
                                      <p style="color:black;"><input style="color:black;" type="checkbox" name="d_remembering" <?php if ($d_remembering != '') {
                                                                                                                                  echo 'checked';
                                                                                                                                }  ?> value="1"> Difficulty in Remembering/
                                        Understanding</p>
                                      <p style="color:black;"><input style="color:black;" type="checkbox" name="d_other" <?php if ($d_others != '') {
                                                                                                                            echo 'checked';
                                                                                                                          }  ?> value="1">Other (please specify) <br><textarea name="others" id="" cols="25" rows="3"><?php echo $others; ?></textarea></p>
                                      <p style="color:black;"> Medical diagnosis(if yes, Indicate) <br><textarea name="medical_diagnos" id="" cols="25" rows="3"><?php echo $medical_diagnos; ?></textarea></p>
                                    </div>
                                    <!--difficulty-->
                                    <!--meeting-->
                                    <div class="col-md-5 border" align="left" style="color:black;">
                                      MEETING INFORMATION:
                                      <p style="color:black;">DATE OF MEETING <input style="color:black;" value="<?php echo $date_meeting; ?>" type="date" name="date_meeting"></p>
                                      <p style="color:black;">DATE OF LAST IEP<input style="color:black;" value="<?php echo $date_last_iep; ?>" type="date" name="date_last_iep"></p>
                                      <strong>PURPOSE OF MEETING:</strong>
                                      <p style="color:black;"><input style="color:black;" name="purpose" <?php if ($purpose == '1') {
                                                                                                            echo 'checked';
                                                                                                          }  ?> type="radio" value="1"> Interim IEP</p>
                                      <p style="color:black;"><input style="color:black;" name="purpose" <?php if ($purpose == '2') {
                                                                                                            echo 'checked';
                                                                                                          }  ?> type="radio" value="2"> Initial IEP</p>
                                      <p style="color:black;"><input style="color:black;" name="purpose" <?php if ($purpose == '3') {
                                                                                                            echo 'checked';
                                                                                                          }   ?> type="radio" value="3"> Term IEP</p>
                                      <p style="color:black;"><input style="color:black;" name="purpose" <?php if ($purpose == '4') {
                                                                                                            echo 'checked';
                                                                                                          }  ?> type="radio" value="4"> IEP Following 3-Yr, Reevaluation</p>
                                      <p style="color:black;"><input style="color:black;" name="purpose" <?php if ($purpose == '5') {
                                                                                                            echo 'checked';
                                                                                                          }  ?> type="radio" value="5"> Revision to IEP Date <input style="color:black;" value="<?php echo $review_date; ?>" type="date" name="review_date"></p>
                                      <p style="color:black;"><input style="color:black;" name="purpose" <?php if ($purpose == '6') {
                                                                                                            echo 'checked';
                                                                                                          }  ?> type="radio" value="6"> Exit/Graduation</p>
                                      <p style="color:black;"> IEP Revision Without a Meeting At the request of </p>
                                      <p style="color:black;"> <input style="color:black;" name="purpose" <?php if ($purpose == '7') {
                                                                                                            echo 'checked';
                                                                                                          }  ?> type="radio" value="7">Parent</p>
                                      <p style="color:black;"> <input style="color:black;" name="purpose" type="radio" <?php if ($purpose == '8') {
                                                                                                                          echo 'checked';
                                                                                                                        } ?> value="8">School</p>
                                      <p style="color:black;">IEP Review Date</p>
                                      <p style="color:black;">COMMENTS:<br><textarea name="comment" id="" cols="30" rows="3"><?php echo $comment;  ?></textarea></p>
                                    </div>
                                  </div>
                                </div>
                                <!-- iepinfo -->
                                <!-- iepteamupdate -->
                                <div class="tab-pane fade " id="ateamUpdate" role="tabpanel" aria-labelledby="a1-tab" align="left">
                                  IEP TEAM MEMBERS IN ATTENDANCE
                                  <?php
                                  $psych = '';
                                  $nurse = '';
                                  $therapist = '';
                                  $language = '';
                                  $if_regular = '';
                                  $date = '';
                                  $guidance = '';
                                  $other_name = '';
                                  $rincipal = '';
                                  $if_1 = '';
                                  $dis_1 = '';
                                  include('../connect.php');
                                  $id1 = $_GET['id'];
                                  $sqlteam = "SELECT * FROM iep_team where lrn = $id1 and folder_id = $folder_id and iep_id = $iid";
                                  $sqldatateam = mysqli_query($conn, $sqlteam) or die('Error Displaying Data' . mysqli_connect_error());
                                  while ($rowdif11 = mysqli_fetch_assoc($sqldatateam)) {
                                    $psych = $rowdif11['psych'];
                                    $nurse = $rowdif11['nurse'];
                                    $therapist = $rowdif11['therapist'];
                                    $language = $rowdif11['language'];
                                    $if_regular = $rowdif11['if_regular'];
                                    $date = $rowdif11['date'];
                                    $guidance = $rowdif11['guidance'];
                                    $other_name = $rowdif11['other_name'];
                                    $rincipal = $rowdif11['principal'];
                                    $if_1 = $rowdif11['if_1'];
                                    $dis_1 = $rowdif11['dis_1'];
                                    $sp_teacher = $rowdif11['sp_teacher'];
                                  }
                                  ?>
                                  <div class="row">
                                    <table class="table">
                                      <tr>
                                        <td style="color:black;">School Psychologist: <input style="color:black;" name="psych" type="text" value="<?php echo $psych; ?>" class="form-control"></td>
                                        <td style="color:black;">Guidance Counselor/Designate: <input style="color:black;" name="guidance" type="text" value="<?php echo $guidance; ?>" class="form-control"></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">Principal/School Head: <input style="color:black;" type="text" name="principal" value="<?php echo $rincipal; ?>" class="form-control"></td>
                                        <td style="color:black;">School Nurse : <input style="color:black;" type="text" name="nurse" class="form-control" value="<?php echo $nurse; ?>" y></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">Other (name and role) : <input style="color:black;" name="other_name" class="form-control" value="<?php echo $other_name; ?>" type="text"></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">Special Education Teacher :
                                          <select name="sp_teacher" class="form-control" id="">
                                            <option value="<?php echo $sp_teacher; ?>"><?php echo $sp_teacher; ?></option>
                                            <?php
                                            include('../connect.php');
                                            $sqlget = "SELECT * FROM teachers where email != 'admin' and category = 4";
                                            $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                            while ($row = mysqli_fetch_assoc($sqldata)) { ?>
                                              <option value="<?php echo $row['fname'] . " " . $row['lname']; ?>"><?php echo $row['fname'] . " " . $row['lname']; ?></option>
                                            <?php } ?>
                                          </select>
                                        </td>
                                        <td style="color:black;">Therapist/Pathologist/Specialist : <input style="color:black;" name="therapist" class="form-control" value="<?php echo $therapist; ?>" type="text"></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;" colspan="2">*Learner must be invited when transition is discussed
                                          **The IEP learn must include at least one regular education teacher of the learner (if the learner is or may be participating in the regular education environment
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;" rowspan="2" colspan="2">
                                          <p style="color:black;"><input style="color:black;" type="radio" name="if_1" <?php if ($if_1 == '1') {
                                                                                                                          echo 'checked';
                                                                                                                        } ?> value="1"> Not Applicable (learner will not be 18 within one year</p>
                                          <p style="color:black;"><input style="color:black;" type="radio" name="if_1" <?php if ($if_1 == '2') {
                                                                                                                          echo 'checked';
                                                                                                                        } ?> value="2">The learner has been informed of his/her rights under law and advised of the transfer of rights at age 18</p>
                                          <p style="color:black;">Distribution:</p>
                                          <p style="color:black;"><input style="color:black;" type="radio" name="dis_1" <?php if ($dis_1 == '1') {
                                                                                                                          echo 'checked';
                                                                                                                        } ?> value="1"> Learner’s Folder</p>
                                          <p style="color:black;"> <input style="color:black;" type="radio" name="dis_1" <?php if ($dis_1 == '2') {
                                                                                                                            echo 'checked';
                                                                                                                          } ?> value="2"> Parent/Guardian/Caregiver/ Ed Special Education/Receiving Teacher</p>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                                <!-- iepteam -->
                                <!--goal-->
                                <div class="tab-pane fade" id="goalUpdate" role="tabpanel" aria-labelledby="contact-tab">
                                  <div class="row">
                                    <!--B.	Goals-->
                                    <div class="col-md-12" align="left">
                                      <h5 style="color:black;" class="mt-4">C. STUDENT GOALS</h5>
                                      <p style="color:black;"> To support identification of learner goals, also confirm:</p>
                                      <p style="color:black;"> • What opprtunites are available at the school to support learner goals?</p>
                                      <p style="color:black;"> • What are the student interest areas?</p>
                                      <p style="color:black;"> • What disability-specific skills does the learner need to develop to support their participation/ attainment of goals?</p>
                                      <p style="color:black;"> Goals –(eg.-Skills to improve participation in education or daily living skills. Goals should be SMART (Strategic, Measurable, Achievable, Realistic, and Time-bound)</p>
                                      <table class="table table-bordered">
                                        <tr class="bg-secondary text-white">
                                          <th style="color:black;">INTEREST</th>
                                          <th style="color:black;">GOAL</th>
                                          <th style="color:black;">INTERVENTIONS</th>
                                          <th style="color:black;">TIMELINE</th>
                                          <th style="color:black;">INDIVIDUALS RESPONSIBLE</th>
                                          <th style="color:black;">REMARKS </th>
                                          <th style="color:black;">PROGRESS/
                                            NEXT STEPS</th>
                                        </tr>
                                        <?php
                                        include('../connect.php');
                                        $id1 = $_GET['id'];
                                        $folder_id = $_GET['folder_id'];
                                        $count = 0;
                                        $sqlget4 = "SELECT * FROM iep_goals where lrn = $id1 and folder_id = $folder_id and iep_id = $iid";
                                        $sqldata4 = mysqli_query($conn, $sqlget4) or die('Error Displaying Data' . mysqli_connect_error());
                                        while ($row4 = mysqli_fetch_assoc($sqldata4)) {
                                          $count++;
                                        ?>
                                          <tr>
                                            <td style="color:black;"><textarea name="interest_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row4['interest']; ?></textarea></td>
                                            <td style="color:black;"><textarea name="goal_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row4['goal']; ?></textarea></td>
                                            <td style="color:black;"><textarea name="intervention_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row4['intervention']; ?></textarea></td>
                                            <td style="color:black;"><textarea name="timeline_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row4['timeline']; ?></textarea></td>
                                            <td style="color:black;"><textarea name="individual_responsible_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row4['individual_responsible']; ?></textarea></td>
                                            <td style="color:black;"><textarea name="remarks_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row4['remarks']; ?></textarea></td>
                                            <td style="color:black;"><textarea name="progress_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row4['progress']; ?></textarea></td>
                                          </tr>
                                        <?php }
                                        ?>
                                      </table>
                                      <h5 style="color:black;" class="mt-4">D. STUDENT TRANSITION</h5>
                                      <p style="color:black;">This section is for learners exiting the school environment and transitioning into work.</p>
                                      <table class="table table-bordered">
                                        <tr class="bg-secondary text-white">
                                          <th style="color:black;">INTEREST</th>
                                          <th style="color:black;">WORK OPPORTUNITIES</th>
                                          <th style="color:black;">INTERVENTIONS/
                                            TRANSITION SKILLS
                                          </th>
                                          <th style="color:black;">INDIVIDUALS RESPONSIBLE</th>
                                          <th style="color:black;">REMARKS</th>
                                        </tr>
                                        <?php
                                        include('../connect.php');
                                        $id1 = $_GET['id'];
                                        $folder_id = $_GET['folder_id'];
                                        $count = 0;
                                        $sqlget5 = "SELECT * FROM iep_transition where lrn = $id1 and folder_id = $folder_id and iep_id = $iid";
                                        $sqldata5 = mysqli_query($conn, $sqlget5) or die('Error Displaying Data' . mysqli_connect_error());
                                        while ($row5 = mysqli_fetch_assoc($sqldata5)) {
                                          $count++;
                                        ?>
                                          <tr>
                                            <td style="color:black;"><textarea name="interest1_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row5['interest']; ?></textarea></td>
                                            <td style="color:black;"><textarea name="work1_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row5['work']; ?></textarea></td>
                                            <td style="color:black;"><textarea name="skills1_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row5['skills']; ?></textarea></td>
                                            <td style="color:black;"><textarea name="individual_responsible1_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row5['individual_responsible']; ?></textarea></td>
                                            <td style="color:black;"><textarea name="remarks1_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row5['remarks']; ?></textarea></td>
                                          </tr>
                                        <?php }
                                        ?>
                                      </table>
                                    </div>
                                    <!--B.	Goals-->
                                  </div>
                                </div>
                                <!--goal-->
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal iep update -->
                  <?php } ?>
                </div>
              </div>
              <!-- aaaa1 -->
              <!-- aaaa2 -->
              <div class="tab-pane fade container-fluid" id="aaaa2" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                  <?php
                  $id1 = $_GET['id'];
                  $sqlilp = "SELECT * FROM ilp where lrn = $id1";
                  $sqldatailp = mysqli_query($conn, $sqlilp) or die('Error Displaying Data' . mysqli_connect_error());
                  while ($rowilp = mysqli_fetch_assoc($sqldatailp)) {
                    $ilp_id = $rowilp['ilp_id'];
                  ?>
                    <div class="col-md-2" align="center">
                      <?php echo "ILP of " . $rowilp['school_year']; ?>
                      <a data-toggle="modal" data-target="#ilp<?php echo $rowilp['ilp_id'] ?>"> <img width="100" class="img-fluid" src="../img/ilp.png" alt=""></a>
                    </div>
                    <!-- ilp view Modal -->
                    <div class="modal" id="ilp<?php echo $rowilp['ilp_id']; ?>">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">ILP of <?php echo $rowilp['school_year'] ?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <!-- Modal body -->
                          <div class="modal-body">
                            <div class="col-md-12">
                              <a class="btn btn-success float-right" href="printILP.php?ilp_id=<?php echo $rowilp['ilp_id']; ?>&lrn=<?php echo $id1; ?>&folder_id=<?php echo $_GET['folder_id']; ?>" target="_blank"> <i class="fas fa-print"></i> Print</a>
                            </div>
                            <!-- row -->
                            <ul class="nav nav-tabs ml-2" id="myTab" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#aaaaa1<?php echo $rowilp['ilp_id'] ?>" role="tab" aria-controls="home"
                                  aria-selected="true">Part I</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="progress-tab" data-toggle="tab" href="#aaaaa2<?php echo $rowilp['ilp_id'] ?>" role="tab" aria-controls="progress"
                                  aria-selected="false">Part II</a>
                              </li>
                            </ul>
                            <form action="updateILP.php?ilp_id=<?php echo $rowilp['ilp_id']; ?>&folder_id=<?php echo $_GET['folder_id']; ?>&id=<?php echo $_GET['id']; ?>" method="post">
                              <div class="tab-content" id="myTabContent">
                                <!-- aaaaa1 -->
                                <div class="tab-pane fade active show container-fluid" id="aaaaa1<?php echo $rowilp['ilp_id'] ?>" role="tabpanel" aria-labelledby="home-tab">
                                  <div class="row">
                                    <!-- content -->
                                    <table class="table table-borderless">
                                      <tr>
                                        <td style="color:black;">Name:<u><?php echo $name; ?></td>
                                        <td style="color:black;">Date of Birth: <u><?php echo $birth_date; ?></td>
                                        <td style="color:black;">Age: <u> <?php
                                                                          $date = date_create($birth_date);
                                                                          $interval = $date->diff(new DateTime);
                                                                          echo $interval->y;
                                                                          ?></u></td>
                                        <td style="color:black;"></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">Address: <u><?php echo $address; ?></u></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">Type of learner: <u><?php echo $category; ?></u></td>
                                        <td style="color:black;">LRN: <u><?php echo $_GET['id']; ?></td>
                                      </tr>
                                      <?php
                                      $sqlilp1 = "SELECT * FROM ilp_assessment where ilp_id = $ilp_id";
                                      $sqldatailp1 = mysqli_query($conn, $sqlilp1) or die('Error Displaying Data' . mysqli_connect_error());
                                      while ($rowilp1 = mysqli_fetch_assoc($sqldatailp1)) {
                                        $adviser = $rowilp1['adviser'];
                                      }
                                      ?>
                                      <tr>
                                        <td style="color:black;"><strong>Principal:</strong><input type="text" name="principal" class="form-control" value="<?php echo $rowilp['principal']; ?>"></td>
                                        <td style="color:black;"><strong>Adviser:</strong><input type="text" class="form-control" name="adviser" value="<?php echo $adviser; ?>"></td>
                                      </tr>
                                    </table>
                                    <p style="color:black;">Record of assessment</p>
                                    <table class="table table-bordered">
                                      <?php
                                      $sqlilp1 = "SELECT * FROM ilp_assessment where ilp_id = $ilp_id";
                                      $sqldatailp1 = mysqli_query($conn, $sqlilp1) or die('Error Displaying Data' . mysqli_connect_error());
                                      while ($rowilp1 = mysqli_fetch_assoc($sqldatailp1)) {
                                      ?>
                                        <tr class="bg-secondary text-white">
                                          <th style="color:black;">Type of Assessments</th>
                                          <th style="color:black;">Date Administered</th>
                                          <th style="color:black;">Chronological Age</th>
                                          <th style="color:black;">Administrator</th>
                                          <th style="color:black;">Results/Outcome</th>
                                        </tr>
                                        <tr>
                                          <td style="color:black;"><?php $date1 = $rowilp1['date_interview']; ?> <input type="text" name="type_assessment" class="form-control" value="<?php echo $rowilp1['type_assessment']; ?>"></td>
                                          <td style="color:black;"><?php $date2 = $rowilp1['date_interview_student']; ?><input type="date" name="date" class="form-control" value="<?php echo $rowilp1['date']; ?>"></td>
                                          <td style="color:black;"><input type="number" name="chronological_age" class="form-control" value="<?php echo $rowilp1['chronological_age']; ?>"></td>
                                          <td style="color:black;"><input type="text" name="administrator" class="form-control" value="<?php echo $rowilp1['administrator']; ?>"></td>
                                          <td style="color:black;"><input type="text" name="result" class="form-control" value="<?php echo $rowilp1['result']; ?>"></td>
                                          <?php $admin_ilp = $rowilp1['administrator']; ?>
                                          <?php $result = $rowilp1['result']; ?>
                                        </tr>
                                      <?php break;
                                      } ?>
                                    </table>
                                    <table class="table">
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Interview with Parents/Guardian</strong></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">Date Interview: <input type="date" name="date1" class="form-control" value="<?php echo $date1; ?>"> </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;">Developmental and educational History:</p>
                                          <textarea name="educ_history" id="" class="form-control" rows="2"><?php echo $rowilp['educ_history']; ?></textarea>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;">Name of Parent/Guardian: <?php echo $guardian; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;">Contact Number: <?php echo $contact; ?></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Interview with the Learner</strong></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">Date Interview: <input type="date" name="date2" class="form-control" value="<?php echo $date2; ?>"></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">Interests/Hobbies/Talents: Food preparation: <input type="text" name="interview" class="form-control" value="<?php echo $rowilp['interview_learner']; ?>">
                                        </td>
                                      </tr>
                                    </table>
                                    <table class="table table-sm">
                                      <tr class="bg-secondary text-white">
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>DAILY LIVING SKILLS DOMAIN:</strong> Present Level of Educational Performance</p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Strength/s: </strong> <textarea name="strenght_1" id="" class="form-control"><?php echo $rowilp['strenght_1']; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Need/s: </strong><textarea name="need_1" id="" class="form-control"><?php echo $rowilp['need_1']; ?></textarea> </p>
                                        </td>
                                      </tr>
                                      <tr class="bg-secondary text-white">
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>LANGUAGE DEVELOPMENT DOMAIN: :</strong> Present Level of Educational Performance</p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Strength/s: </strong> <textarea name="strenght_2" id="" class="form-control"><?php echo $rowilp['strenght_2']; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Need/s: </strong><textarea name="need_2" id="" class="form-control"><?php echo $rowilp['need_2']; ?></textarea> </p>
                                        </td>
                                      </tr>
                                      <tr class="bg-secondary text-white">
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>PSYCHOMOTOR DOMAIN:</strong> Present Level of Educational Performance</p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Strength/s: </strong> <textarea name="strenght_3" id="" class="form-control"><?php echo $rowilp['strenght_3']; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Need/s: </strong><textarea name="need_3" id="" class="form-control"><?php echo $rowilp['need_3']; ?></textarea> </p>
                                        </td>
                                      </tr>
                                      <tr class="bg-secondary text-white">
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>COGNITIVE DOMAIN:</strong> Present Level of Educational Performance</p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Strength/s: </strong> <textarea name="strenght_4" id="" class="form-control"><?php echo $rowilp['strenght_4']; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Need/s: </strong><textarea name="need_4" id="" class="form-control"><?php echo $rowilp['need_4']; ?></textarea> </p>
                                        </td>
                                      </tr>
                                      <tr class="bg-secondary text-white">
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>AESTHETIC AND CREATIVE DOMAIN:</strong> Present Level of Educational Performance</p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Strength/s: </strong> <textarea name="strenght_5" id="" class="form-control"><?php echo $rowilp['strenght_5']; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Need/s: </strong><textarea name="need_5" id="" class="form-control"><?php echo $rowilp['need_5']; ?></textarea> </p>
                                        </td>
                                      </tr>
                                      <tr class="bg-secondary text-white">
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>BEHAVIORAL DEVELOPMENT:</strong> Present Level of Educational Performance</p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Strength/s: </strong> <textarea name="strenght_6" id="" class="form-control"><?php echo $rowilp['strenght_6']; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Need/s: </strong><textarea name="need_6" id="" class="form-control"><?php echo $rowilp['need_6']; ?></textarea> </p>
                                        </td>
                                      </tr>
                                      <tr class="bg-secondary text-white">
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>ORIENTATION AND MOBILITY:</strong> Present Level of Educational Performance</p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Strength/s: </strong> <textarea name="strenght_7" id="" class="form-control"><?php echo $rowilp['strenght_7']; ?></textarea></p>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">
                                          <p style="color:black;"><strong>Need/s: </strong><textarea name="need_7" id="" class="form-control"><?php echo $rowilp['need_7']; ?></textarea> </p>
                                        </td>
                                      </tr>
                                    </table>
                                    <!-- content ng aaaaa1 -->
                                  </div>
                                </div>
                                <!-- aaaaa1 -->
                                <!-- aaaaa2 -->
                                <div class="tab-pane fade container-fluid" id="aaaaa2<?php echo $rowilp['ilp_id'] ?>" role="tabpanel" aria-labelledby="home-tab">
                                  <div class="row">
                                    <!-- content -->
                                    <table class="table">
                                      <tr class="bg-secondary text-white">
                                        <th style="color:black;"><strong>Priority Learning Needs/Intervention</strong></th>
                                      </tr>
                                      <?php
                                      $sqlprio = "SELECT * FROM ilp_priority where ilp_id = $ilp_id";
                                      $sqldataprio = mysqli_query($conn, $sqlprio) or die('Error Displaying Data' . mysqli_connect_error());
                                      while ($rowprio = mysqli_fetch_assoc($sqldataprio)) {
                                      ?>
                                        <tr>
                                          <td style="color:black;">1. <textarea name="priority1" id="" class="form-control"><?php echo $rowprio['priority1']; ?></textarea> </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;">2.<textarea name="priority2" id="" class="form-control"><?php echo $rowprio['priority2']; ?></textarea> </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;">3. <textarea name="priority3" id="" class="form-control"><?php echo $rowprio['priority3']; ?></textarea> </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;">4.<textarea name="priority4" id="" class="form-control"> <?php echo $rowprio['priority4']; ?></textarea></td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;">5. <textarea name="priority5" id="" class="form-control"><?php echo $rowprio['priority5']; ?></textarea> </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;">6. <textarea name="priority6" id="" class="form-control"><?php echo $rowprio['priority6']; ?></textarea> </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;">7. <textarea name="priority7" id="" class="form-control"><?php echo $rowprio['priority7']; ?></textarea> </td>
                                        </tr>
                                      <?php break;
                                      } ?>
                                    </table>
                                    <table class="table">
                                      <tr class="bg-secondary text-white">
                                        <th style="color:black;"><strong>Transition Package:</strong></th>
                                        <?php
                                        $sqltrans = "SELECT * FROM ilp_transition where ilp_id = $ilp_id";
                                        $sqldatatrans = mysqli_query($conn, $sqltrans) or die('Error Displaying Data' . mysqli_connect_error());
                                        while ($rowtrans = mysqli_fetch_assoc($sqldatatrans)) {
                                        ?>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">1. <textarea name="transition1" id="" class="form-control"><?php echo $rowtrans['transition1']; ?></textarea></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">2. <textarea name="transition2" id="" class="form-control"><?php echo $rowtrans['transition2']; ?></textarea></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">3. <textarea name="transition3" id="" class="form-control"><?php echo $rowtrans['transition3']; ?></textarea></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">4. <textarea name="transition4" id="" class="form-control"><?php echo $rowtrans['transition4']; ?></textarea></td>
                                      </tr>
                                      <tr>
                                        <td style="color:black;">5. <textarea name="transition5" id="" class="form-control"><?php echo $rowtrans['transition5']; ?></textarea></td>
                                      </tr>
                                    <?php break;
                                        } ?>
                                    </table>
                                    <!-- content -->
                                  </div>
                                </div>
                                <!-- aaaaa2 -->
                              </div>
                          </div>
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- ilp view modal -->
                  <?php } ?>
                </div>
              </div>
              <!-- aaaa2 -->
            </div>
          </div>
          <!-- forms -->
          <div class="tab-pane fade" id="iep" role="tabpanel" aria-labelledby="progress-tab">
            <h3 class="mt-3" style="color:black; font-weight:bold;">Individualized Educational Plan</h3>
            <!-- Button trigger modal -->
            <div class="col-md-12 mb-5">
            </div>
            <!-- Modal iep update -->
            <div class="modal fade" id="iepupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Update IEP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php
                    $iep_id = "";
                    $id1 = $_GET['id'];
                    $sqldif1 = "SELECT * FROM iep_difficulty where lrn = $id1 and folder_id = $f_id and iep_id = $iid";
                    $sqldatadif1 = mysqli_query($conn, $sqldif1) or die('Error Displaying Data' . mysqli_connect_error());
                    while ($rowdif1 = mysqli_fetch_assoc($sqldatadif1)) {
                      $iep_id = $rowdif1['iep_id'];
                    }
                    ?>
                    <form action="updateIEP.php?id=<?php echo $iep_id; ?>&folder_id=<?php echo $_GET['folder_id']; ?>&lrn=<?php echo $_GET['id']; ?>" method="POST">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="a1-tab" data-toggle="tab" href="#a1info1" role="tab" aria-controls="a1"
                            aria-selected="true">Information</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="a1-tab" data-toggle="tab" href="#a1team1" role="tab" aria-controls="a1"
                            aria-selected="true">Team</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="a1-tab" data-toggle="tab" href="#a7update" role="tab" aria-controls="a1"
                            aria-selected="true">Functional Performance</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#a2update" role="tab" aria-controls="profile"
                            aria-selected="false">Consideration</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#a3update" role="tab" aria-controls="contact"
                            aria-selected="false">Barriers</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#a4update" role="tab" aria-controls="contact"
                            aria-selected="false">Goals && Transition</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <!--team-->
                        <div class="tab-pane fade" id="a7update" role="tabpanel" aria-labelledby="a1-tab" align="left">
                          <div class="row">
                            <h5 style="color:black;" class="mt-4"> I. PRESENT LEVELS OF ACADEMIC ACHIEVEMENT AND FUNCTIONAL PERFORMANCE</h5>
                            <table class="table table-bordered">
                              <tr class="bg-secondary text-white">
                                <th style="color:black;">Result of initial or most recent evaluation of school and division assessments:</th>
                              </tr>
                              <?php
                              $function1 = "";
                              $function2 = "";
                              $function3 = "";
                              $function4 = "";
                              $function5 = "";
                              $function1_2 = "";
                              $function2_2 = "";
                              $function3_2 = "";
                              $function4_2 = "";
                              $function5_2 = "";
                              $function1_3 = "";
                              $function2_3 = "";
                              $function3_3 = "";
                              $function4_3 = "";
                              $function5_3 = "";
                              include('../connect.php');
                              $id1 = $_GET['id'];
                              $f_id = $_GET['folder_id'];
                              $sqlget1 = "SELECT * FROM iep_functional where lrn = $id1 and folder_id = $f_id and iep_id = $iep_id";
                              $sqldata1 = mysqli_query($conn, $sqlget1) or die('Error Displaying Data' . mysqli_connect_error());
                              while ($row1 = mysqli_fetch_assoc($sqldata1)) {
                                $function1 = $row1['functional_1'];
                                $function2 = $row1['functional_2'];
                                $function3 = $row1['functional_3'];
                                $function4 = $row1['functional_4'];
                                $function5 = $row1['functional_5'];
                                $function1_2 = $row1['functional_1_2'];
                                $function2_2 = $row1['functional_2_2'];
                                $function3_2 = $row1['functional_3_2'];
                                $function4_2 = $row1['functional_4_2'];
                                $function5_2 = $row1['functional_5_2'];
                                $function1_3 = $row1['functional_1_3'];
                                $function2_3 = $row1['functional_2_3'];
                                $function3_3 = $row1['functional_3_3'];
                                $function4_3 = $row1['functional_4_3'];
                                $function5_3 = $row1['functional_5_3'];
                              ?>
                              <?php }
                              ?>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_1" class="form-control" id="" cols="30" rows="2"><?php echo  $function1; ?></textarea> </td>
                              </tr>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_1_2" class="form-control" id="" cols="30" rows="2"><?php echo  $function1_2; ?></textarea></p>
                                </td>
                              </tr>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_1_3" class="form-control" id="" cols="30" rows="2"><?php echo  $function1_3; ?></textarea></p>
                                </td>
                              </tr>
                              <tr class="bg-secondary text-white">
                                <th style="color:black;">Description of academic, developmental and/or functional strengths:</th>
                              </tr>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_2" class="form-control" id="" cols="30" rows="2"><?php echo  $function2; ?></textarea></p>
                                </td>
                              </tr>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_2_2" class="form-control" id="" cols="30" rows="2"><?php echo  $function2_2; ?></textarea></p>
                                </td>
                              </tr>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_2_3" class="form-control" id="" cols="30" rows="2"><?php echo  $function2_3; ?></textarea></p>
                                </td>
                              </tr>
                              <tr class="bg-secondary text-white">
                                <th style="color:black;">Description of academic, developmental and/or functional needs:</th>
                              </tr>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_3" class="form-control" id="" cols="30" rows="2"><?php echo  $function3; ?></textarea></p>
                                </td>
                              </tr>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_3_2" class="form-control" id="" cols="30" rows="2"><?php echo  $function3_2; ?></textarea></p>
                                </td>
                              </tr>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_3_3" class="form-control" id="" cols="30" rows="2"><?php echo  $function3_3; ?></textarea></p>
                                </td>
                              </tr>
                              <tr class="bg-secondary text-white">
                                <th style="color:black;">Parental concerns regarding their child’s education:</th>
                              </tr>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_4" class="form-control" id="" cols="30" rows="2"><?php echo  $function4; ?></textarea></p>
                                </td>
                              </tr>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_4_2" class="form-control" id="" cols="30" rows="2"><?php echo  $function4_2; ?></textarea></p>
                                </td>
                              </tr>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_4_3" class="form-control" id="" cols="30" rows="2"><?php echo  $function4_3; ?></textarea></p>
                                </td>
                              </tr>
                              <tr class="bg-secondary text-white">
                                <th style="color:black;">Impact of the disability on involvement and progress in the general education curriculum (for preschool, how the disability affects participation in appropriate activities).</th>
                              </tr>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_5" class="form-control" id="" cols="30" rows="2"><?php echo  $function5; ?></textarea></p>
                                </td>
                              </tr>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_5_2" class="form-control" id="" cols="30" rows="2"><?php echo  $function5_2; ?></textarea></p>
                                </td>
                              </tr>
                              <tr>
                                <td style="color:black;"> <textarea name="functional_5_3" class="form-control" id="" cols="30" rows="2"><?php echo  $function5_3; ?></textarea></p>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <!--team-->
                        <!--functional-->
                        <div class="tab-pane fade" id="a6update" role="tabpanel" aria-labelledby="a6-tab" align="left">
                          IEP TEAM MEMBERS IN ATTENDANCE
                          <div class="row">
                            <table class="table">
                              <tr>
                                <td style="color:black;">Parent/Guardian/Caregiver: <strong> <?php echo $guardian; ?> </strong></td>
                                <td style="color:black;">School Psychologist: <input style="color:black;" type="text" class="form-control" name="psych"></td>
                              </tr>
                              <tr>
                                <td style="color:black;">Learner: <strong> <?php echo $name; ?></strong> </td>
                                <td style="color:black;">Guidance Counselor/Designate: <input style="color:black;" type="text" class="form-control" name="guidance"></td>
                              </tr>
                              <tr>
                                <td style="color:black;">Principal/School Head: <input style="color:black;" type="text" class="form-control" name="principal"></td>
                                <td style="color:black;">School Nurse : <input style="color:black;" type="text" class="form-control" name="nurse"></td>
                              </tr>
                              <tr>
                                <td style="color:black;">Other (name and role) : <input style="color:black;" class="form-control" name="other_name" type="text"></td>
                              </tr>
                              <tr>
                                <td style="color:black;">Special Education Teacher : <input style="color:black;" class="form-control" name="teacher" type="text"></td>
                                <td style="color:black;">Therapist/Pathologist/Specialist : <input style="color:black;" class="form-control" name="therapist" type="text"></td>
                              </tr>
                              <tr>
                                <td style="color:black;" colspan="2">*Learner must be invited when transition is discussed
                                  **The IEP learn must include at least one regular education teacher of the learner (if the learner is or may be participating in the regular education environment
                                </td>
                              </tr>
                              <tr align="center">
                                <td style="color:black;" colspan="2">_____<u> <?php echo $guardian; ?></u>_____<br>Signature over Printed Name of Parent/Guardian/Caregiver
                                </td>
                              </tr>
                              <tr>
                                <td style="color:black;" rowspan="2" colspan="2">
                                  <p style="color:black;"><input style="color:black;" type="checkbox" value="1" name="if_1"> Not Applicable (learner will not be 18 within one year</p>
                                  <p style="color:black;"><input style="color:black;" type="checkbox" value="2" name="if_2">The learner has been informed of his/her rights under law and advised of the transfer of rights at age 18</p>
                                  <p style="color:black;">Distribution:</p>
                                  <p style="color:black;"><input style="color:black;" type="checkbox" value="1" name="dis_1"> Learner’s Folder</p>
                                  <p style="color:black;"> <input style="color:black;" type="checkbox" value="1" name="dis_2"> Parent/Guardian/Caregiver/ Ed Special Education/Receiving Teacher</p>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <!--functional-->
                        <!--factors-->
                        <div class="tab-pane fade" id="a2update" role="tabpanel" aria-labelledby="profile-tab">
                          <div class="row">
                            <!--CONSIDERATION OF SPECIAL FACTORS-->
                            <div class="col-md-12" align="left">
                              <h5 style="color:black;" class="mt-4">II. CONSIDERATION OF SPECIAL FACTORS</h5>
                              <?php
                              $factor1 = "";
                              $factor2 = "";
                              $factor3 = "";
                              $factor4 = "";
                              $factor5 = "";
                              $factor6 = "";
                              $factor7 = "";
                              $factor8 = "";
                              $factor9 = "";
                              $factor_type = "";
                              $comment1 = "";
                              $comment2 = "";
                              $comment3 = "";
                              $comment4 = "";
                              $comment5 = "";
                              $comment6 = "";
                              $comment7 = "";
                              $comment8 = "";
                              $comment9 = "";
                              include('../connect.php');
                              $id1 = $_GET['id'];
                              $folder_id = $_GET['folder_id'];
                              $sqlget2 = "SELECT * FROM iep_special_factor where lrn = $id and folder_id = $folder_id and iep_id = $iep_id";
                              $sqldata2 = mysqli_query($conn, $sqlget2) or die('Error Displaying Data' . mysqli_connect_error());
                              while ($row2 = mysqli_fetch_assoc($sqldata2)) {
                                $factor1 = $row2['factor_1'];
                                $factor2 =  $row2['factor_2'];
                                $factor3 =  $row2['factor_3'];
                                $factor4 =  $row2['factor_4'];
                                $factor5 =  $row2['factor_5'];
                                $factor6 =  $row2['factor_6'];
                                $factor7 =  $row2['factor_7'];
                                $factor8 =  $row2['factor_8'];
                                $factor9 =  $row2['factor_9'];
                                $factor_type = $row2['factor_8_type'];
                                $comment3 = $row2['comment_3'];
                                $comment4 = $row2['comment_4'];
                                $comment5 = $row2['comment_5'];
                                $comment6 = $row2['comment_6'];
                                $comment7 = $row2['comment_7'];
                                $comment8 = $row2['comment_8'];
                                $comment9 = $row2['comment_9'];
                              ?>
                              <?php }
                              ?>
                              <table class="table">
                                <tr>
                                  <td style="color:black;" colspan="2">
                                    <p style="color:black;">a.)Does the learner have difficulty relating with people which impede his/her learning or the learning of other? </p>
                                  </td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor1 == 'yes') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_1" value="yes">Yes</td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor1 == 'no') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_1" value="no">No</td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="2">
                                    <p style="color:black;">b.)if yes, consider the appropriateness of developing a Behavior Intervention Plan. Behavior Intervention Plan developed? Refer to Behavior InterventionPlan for additional information.</p>
                                  </td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor2 == 'yes') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_2" value="yes">Yes</td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor2 == 'no') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_2" value="no">No</td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="2">
                                    <p style="color:black;">Does the leaner have difficulty in Moving/ Walking?
                                      If yes, consider the mobility needs as related to IEP and describe below.
                                    </p>
                                  </td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor3 == 'yes') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_3" value="yes">Yes</td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor3 == 'no') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_3" value="no">No</td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="4"><textarea name="comment_3" class="form-control" id="" cols="30" rows="2"><?php echo $comment3; ?></textarea> </td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="2">
                                    <p style="color:black;">Does the learner have difficulty in seeing or with blindness/visual impairment?
                                      If yes, provide for instruction in Braille and the use of Braille, unless the IEP Team determines that instruction in Braille is not appropriate for the learner after an
                                      evaluation of the learner’s reading and writing skills, needs, and appropriate reading and wrting media, including evaluation of future needs for instruction in Braille
                                      or the use of Braille. Describe below.
                                    </p>
                                  </td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor4 == 'yes') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_4" value="yes">Yes</td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor4 == 'no') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_4" value="no">No</td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="4"><textarea name="comment_4" class="form-control" id="" cols="30" rows="2"><?php echo $comment4; ?></textarea> </td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="2">
                                    <p style="color:black;">Does the learner have difficulty in communicating?
                                      If yes, consider the communication needs and describe below.
                                    </p>
                                  </td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor5 == 'yes') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_5" value="yes">Yes</td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor5 == 'no') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_5" value="no">No</td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="4"><textarea name="comment_5" class="form-control" id="" cols="30" rows="2"><?php echo $comment5; ?></textarea> </td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="2">
                                    <p style="color:black;">Does the learner have difficulty in concentrating/paying attention?
                                      If yes, consider the understanding needs and describe below.
                                    </p>
                                  </td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor6 == 'yes') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_6" value="yes">Yes</td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor6 == 'no') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_6" value="no">No</td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="4"><textarea name="comment_6" class="form-control" id="" cols="30" rows="2"><?php echo $comment6; ?></textarea> </td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="2">
                                    <p style="color:black;">Does the learner have difficulty in hearing or Is the learner deaf or hard of hearing?</strong>
                                      If yes, consider and describe the learner’s language and communication needs, opportunities for direct communication with peers and professional personnel in the
                                      learner’s language and communication mode, academic level and full range of needs, including opportunities for direct instruction in the learner’s language and
                                      communication mode. Describe communication needs below.
                                    </p>
                                  </td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor7 == 'yes') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_7" value="yes">Yes</td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor7 == 'no') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_7" value="no">No</td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="4"><textarea name="comment_7" class="form-control" id="" cols="30" rows="2"><?php echo $comment7; ?></textarea> </td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="2">
                                    <p style="color:black;">Does the learner need assistive technology devices or services?</strong>
                                      If yes, describe the type of assistive technology and how it is used. If no, describe how the learner’s needs are being met in deficit areas
                                    </p>
                                  </td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor8 == 'yes') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_8" value="yes">Yes</td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor8 == 'no') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_8" value="no">No</td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="4"><textarea name="comment_8" class="form-control" id="" cols="30" rows="2"><?php echo $comment8; ?></textarea> </td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="2">
                                    <p style="color:black;">Does the learner require alternative format for instructional materials?</strong>
                                      If yes, specify format(s) of materials required below.
                                    </p>
                                  </td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor9 == 'yes') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_9" value="yes">Yes</td>
                                  <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor9 == 'no') {
                                                                                                      echo 'checked';
                                                                                                    } ?> name="factor_9" value="no">No</td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="4"><input style="color:black;" type="radio" <?php if ($factor_type == 'Braille') {
                                                                                                                  echo 'checked';
                                                                                                                } ?> name="factor_8_type" value="Braille"> Braille
                                    <input style="color:black;" type="radio" name="factor_8_type" <?php if ($factor_type == 'Large Type') {
                                                                                                    echo 'checked';
                                                                                                  } ?> value="Large Type"> Large Type
                                    <input style="color:black;" type="radio" name="factor_8_type" <?php if ($factor_type == 'Auditory') {
                                                                                                    echo 'checked';
                                                                                                  } ?> value="Auditory"> Auditory
                                    <input style="color:black;" type="radio" name="factor_8_type" <?php if ($factor_type == 'Electronic text') {
                                                                                                    echo 'checked';
                                                                                                  } ?> value="Electronic text"> Electronic text
                                  </td>
                                </tr>
                                <tr>
                                  <td style="color:black;" colspan="4"><textarea name="comment_9" class="form-control" id="" cols="30" rows="2"><?php echo $comment9; ?></textarea> </td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                        <!--factors-->
                        <!--abrriers-->
                        <div class="tab-pane fade" id="a3update" role="tabpanel" aria-labelledby="contact-tab">
                          <div class="row">
                            <!--B.	DIFFICULTIES, BARRIERS AND ENABLING SUPPORTS-->
                            <div class="col-md-12" align="left">
                              <h5 style="color:black;" class="mt-4"> B. DIFFICULTIES, BARRIERS AND ENABLING SUPPORTS</h5>
                              <table class="table table-bordered">
                                <tr class="bg-secondary text-white">
                                  <th style="color:black;">DIFFICULTY (enter all areas of difficulty)</th>
                                  <th style="color:black;">ENVIRONMENTAL BARRIERS (describe each factor restricting participation)</th>
                                  <th style="color:black;">ENVIRONMENTAL FACILITATORS (describe each factor enabling participation in response to barriers) </th>
                                  <th style="color:black;">ENVIRONMENTAL FACILITATORS (describe each factor enabling participation in response to barriers)</th>
                                </tr>
                                <?php
                                include('../connect.php');
                                $id1 = $_GET['id'];
                                $count = 0;
                                $folder_id = $_GET['folder_id'];
                                $sqlget3 = "SELECT * FROM iep_barriers where lrn = $id and folder_id = $folder_id and iep_id = $iep_id";
                                $sqldata3 = mysqli_query($conn, $sqlget3) or die('Error Displaying Data' . mysqli_connect_error());
                                while ($row3 = mysqli_fetch_assoc($sqldata3)) {
                                  $count++;
                                ?>
                                  <tr>
                                    <td style="color:black;"><textarea name="barrier_1_<?php echo $count; ?>" id="" class="form-control" cols="30" rows="3"><?php echo $row3['barrier_1']; ?> </textarea></td>
                                    <td style="color:black;"><textarea name="barrier_2_<?php echo $count; ?>" id="" class="form-control" cols="30" rows="3"><?php echo $row3['barrier_2']; ?></textarea></td>
                                    <td style="color:black;"><textarea name="barrier_3_<?php echo $count; ?>" id="" class="form-control" cols="30" rows="3"><?php echo $row3['barrier_3']; ?></textarea></td>
                                    <td style="color:black;"><textarea name="barrier_4_<?php echo $count; ?>" id="" class="form-control" cols="30" rows="3"><?php echo $row3['barrier_4']; ?></textarea></td>
                                  </tr>
                                <?php }
                                ?>
                              </table>
                              Selection of Barriers and Qualifiers for Environmental Barriers and Facilitators (taken from ICF)
                              <table class="table table-bordered">
                                <tr class="bg-secondary text-white">
                                  <th style="color:black;">DIFFICULTIES (select all relevant categories)</th>
                                  <th style="color:black;">Qualifiers for Environmental Barriers</th>
                                  <th style="color:black;">Qualifiers for Environmental Facilitators</th>
                                </tr>
                                <tr>
                                  <td style="color:black;" rowspan="6">
                                    <p style="color:black;"> • Seeing </p>
                                    <p style="color:black;"> • Hearing </p>
                                    <p style="color:black;"> • Communicating </p>
                                    <p style="color:black;"> • Moving/Walking </p>
                                    <p style="color:black;"> • Concentrating/Paying Attention </p>
                                    <p style="color:black;"> • Remembering/understanding </p>
                                  </td>
                                  <td style="color:black;" rowspan="6">
                                    <p style="color:black;"> 0 No barrier </p>
                                    <p style="color:black;"> 1 Mild barrier </p>
                                    <p style="color:black;"> 2 Moderate barrier </p>
                                    <p style="color:black;"> 3 Severe barrier </p>
                                    <p style="color:black;"> 4 Complete barrier </p>
                                    <p style="color:black;"> 8 Barrier, not specified </p>
                                    <p style="color:black;"> 9 Not Applicable </p>
                                  </td>
                                  <td style="color:black;" rowspan="6">
                                    <p style="color:black;"> +1 Mild facilatator </p>
                                    <p style="color:black;"> +2 Moderate facilatator </p>
                                    <p style="color:black;"> +3 Substantial facilatator </p>
                                    <p style="color:black;"> +4 Complete facilatator </p>
                                    <p style="color:black;"> +8 Facilitator, not specified </p>
                                    <p style="color:black;"> +9 Not Applicable </p>
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <!--B.	DIFFICULTIES, BARRIERS AND ENABLING SUPPORTS-->
                          </div>
                        </div>
                        <!--abrriers-->
                        <!-- iepinfoupdate -->
                        <div class="tab-pane active show" id="a1info1" role="tabpanel" aria-labelledby="a1-tab" align="left">
                          <h5 style="color:black;" class="mt-4"> A. PERSONAL INFORMATION </h5>
                          <?php
                          $d_seeing = '';
                          $d_hearing = '';
                          $d_moving = '';
                          $d_concentrating = '';
                          $d_remembering = '';
                          $d_others = '';
                          $others = '';
                          $others_2 = '';
                          $medical_diagnos = '';
                          $date_meeting = '';
                          $date_last_iep = '';
                          $purpose = '';
                          $review_date = '';
                          $comment = '';
                          $grade = '';
                          include('../connect.php');
                          $id1 = $_GET['id'];
                          $sqldif1 = "SELECT * FROM iep_difficulty where lrn = $id1 and folder_id = $folder_id and iep_id = $iep_id";
                          $sqldatadif1 = mysqli_query($conn, $sqldif1) or die('Error Displaying Data' . mysqli_connect_error());
                          while ($rowdif1 = mysqli_fetch_assoc($sqldatadif1)) {
                            $d_seeing = $rowdif1['d_seeing'];
                            $d_hearing = $rowdif1['d_hearing'];
                            $d_moving = $rowdif1['d_moving'];
                            $d_com = $rowdif1['d_com'];
                            $d_concentrating = $rowdif1['d_concentrating'];
                            $d_remembering = $rowdif1['d_remembering'];
                            $d_others = $rowdif1['d_other'];
                            $others = $rowdif1['others'];
                            $others_2 = $rowdif1['others_2'];
                            $medical_diagnos = $rowdif1['medical_diagnos'];
                            $date_meeting = $rowdif1['date_meeting'];
                            $date_last_iep = $rowdif1['date_last_iep'];
                            $purpose = $rowdif1['purpose'];
                            $review_date = $rowdif1['review_date'];
                            $comment = $rowdif1['comment'];
                            $grade = $rowdif1['grade'];
                          }
                          ?>
                          <div class="row border">
                            <!--info-->
                            <div class="col-md-3 border">
                              <table class="table">
                                <tr>
                                  <td style="color:black;">
                                    <p style="color:black;"><strong>Grade/Level:</strong> <select name="grade" class="form-control" id="">
                                        <option value="<?php echo $grade; ?>"><?php echo $grade; ?></option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="VI">VI</option>
                                      </select> </p>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="color:black;">
                                    <p style="color:black;"><strong>Interpreter or other Accomodations Needed:</strong><br><textarea name="others_2" class="form-control"><?php echo $others_2; ?></textarea></p>
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <!--info-->
                            <!--difficulty-->
                            <div class="col-md-4 border" align="left" style="color:black;">
                              DIFFICULTIES (Select most relevant):
                              <p style="color:black;"><input style="color:black;" name="d_seeing" type="checkbox" <?php if ($d_seeing != '') {
                                                                                                                    echo 'checked';
                                                                                                                  }  ?> value="1"> Difficulty in Seeing</p>
                              <p style="color:black;"><input style="color:black;" name="d_hearing" <?php if ($d_hearing != '') {
                                                                                                      echo 'checked';
                                                                                                    }  ?> type="checkbox" value="1"> Difficulty in Hearing</p>
                              <p style="color:black;"><input style="color:black;" name="d_com" type="checkbox" <?php if ($d_com != '') {
                                                                                                                  echo 'checked';
                                                                                                                }  ?> value="1"> Difficulty in Communicating</p>
                              <p style="color:black;"><input style="color:black;" name="d_moving" type="checkbox" <?php if ($d_moving != '') {
                                                                                                                    echo 'checked';
                                                                                                                  }  ?> value="1"> Difficulty in Moving/Walking</p>
                              <p style="color:black;"><input style="color:black;" type="checkbox" name="d_concentrating" <?php if ($d_concentrating != '') {
                                                                                                                            echo 'checked';
                                                                                                                          }  ?> value="1"> Difficulty in Concentrating/Paying
                                Attention </p>
                              <p style="color:black;"><input style="color:black;" type="checkbox" name="d_remembering" <?php if ($d_remembering != '') {
                                                                                                                          echo 'checked';
                                                                                                                        }  ?> value="1"> Difficulty in Remembering/
                                Understanding</p>
                              <p style="color:black;"><input style="color:black;" type="checkbox" name="d_other" <?php if ($d_others != '') {
                                                                                                                    echo 'checked';
                                                                                                                  }  ?> value="1">Other (please specify) <br><textarea name="others" id="" cols="25" rows="3"><?php echo $others; ?></textarea></p>
                              <p style="color:black;"> Medical diagnosis(if yes, Indicate) <br><textarea name="medical_diagnos" id="" cols="25" rows="3"><?php echo $medical_diagnos; ?></textarea></p>
                            </div>
                            <!--difficulty-->
                            <!--meeting-->
                            <div class="col-md-5 border" align="left" style="color:black;">
                              MEETING INFORMATION:
                              <p style="color:black;">DATE OF MEETING <input style="color:black;" value="<?php echo $date_meeting; ?>" type="date" name="date_meeting"></p>
                              <p style="color:black;">DATE OF LAST IEP<input style="color:black;" value="<?php echo $date_last_iep; ?>" type="date" name="date_last_iep"></p>
                              <strong>PURPOSE OF MEETING:</strong>
                              <p style="color:black;"><input style="color:black;" name="purpose" <?php if ($purpose == '1') {
                                                                                                    echo 'checked';
                                                                                                  }  ?> type="radio" value="1"> Interim IEP</p>
                              <p style="color:black;"><input style="color:black;" name="purpose" <?php if ($purpose == '2') {
                                                                                                    echo 'checked';
                                                                                                  }  ?> type="radio" value="2"> Initial IEP</p>
                              <p style="color:black;"><input style="color:black;" name="purpose" <?php if ($purpose == '3') {
                                                                                                    echo 'checked';
                                                                                                  }   ?> type="radio" value="3"> Term IEP</p>
                              <p style="color:black;"><input style="color:black;" name="purpose" <?php if ($purpose == '4') {
                                                                                                    echo 'checked';
                                                                                                  }  ?> type="radio" value="4"> IEP Following 3-Yr, Reevaluation</p>
                              <p style="color:black;"><input style="color:black;" name="purpose" <?php if ($purpose == '5') {
                                                                                                    echo 'checked';
                                                                                                  }  ?> type="radio" value="5"> Revision to IEP Date <input style="color:black;" value="<?php echo $review_date; ?>" type="date" name="review_date"></p>
                              <p style="color:black;"><input style="color:black;" name="purpose" <?php if ($purpose == '6') {
                                                                                                    echo 'checked';
                                                                                                  }  ?> type="radio" value="6"> Exit/Graduation</p>
                              <p style="color:black;"> IEP Revision Without a Meeting At the request of </p>
                              <p style="color:black;"> <input style="color:black;" name="purpose" <?php if ($purpose == '7') {
                                                                                                    echo 'checked';
                                                                                                  }  ?> type="radio" value="7">Parent</p>
                              <p style="color:black;"> <input style="color:black;" name="purpose" type="radio" <?php if ($purpose == '8') {
                                                                                                                  echo 'checked';
                                                                                                                } ?> value="8">School</p>
                              <p style="color:black;">IEP Review Date</p>
                              <p style="color:black;">COMMENTS:<br><textarea name="comment" id="" cols="30" rows="3"><?php echo $comment;  ?></textarea></p>
                            </div>
                          </div>
                        </div>
                        <!-- iepinfo -->
                        <!-- iepteamupdate -->
                        <div class="tab-pane fade " id="a1team1" role="tabpanel" aria-labelledby="a1-tab" align="left">
                          IEP TEAM MEMBERS IN ATTENDANCE
                          <?php
                          $psych = '';
                          $nurse = '';
                          $therapist = '';
                          $language = '';
                          $if_regular = '';
                          $date = '';
                          $guidance = '';
                          $other_name = '';
                          $rincipal = '';
                          $if_1 = '';
                          $dis_1 = '';
                          include('../connect.php');
                          $id1 = $_GET['id'];
                          $sqlteam = "SELECT * FROM iep_team where lrn = $id1 and folder_id = $folder_id and iep_id = $iep_id";
                          $sqldatateam = mysqli_query($conn, $sqlteam) or die('Error Displaying Data' . mysqli_connect_error());
                          while ($rowdif11 = mysqli_fetch_assoc($sqldatateam)) {
                            $psych = $rowdif11['psych'];
                            $nurse = $rowdif11['nurse'];
                            $therapist = $rowdif11['therapist'];
                            $language = $rowdif11['language'];
                            $if_regular = $rowdif11['if_regular'];
                            $date = $rowdif11['date'];
                            $guidance = $rowdif11['guidance'];
                            $other_name = $rowdif11['other_name'];
                            $rincipal = $rowdif11['principal'];
                            $if_1 = $rowdif11['if_1'];
                            $dis_1 = $rowdif11['dis_1'];
                            $sp_teacher = $rowdif11['sp_teacher'];
                          }
                          ?>
                          <div class="row">
                            <table class="table">
                              <tr>
                                <td style="color:black;">School Psychologist: <input style="color:black;" name="psych" type="text" value="<?php echo $psych; ?>" class="form-control"></td>
                                <td style="color:black;">Guidance Counselor/Designate: <input style="color:black;" name="guidance" type="text" value="<?php echo $guidance; ?>" class="form-control"></td>
                              </tr>
                              <tr>
                                <td style="color:black;">Principal/School Head: <input style="color:black;" type="text" name="principal" value="<?php echo $rincipal; ?>" class="form-control"></td>
                                <td style="color:black;">School Nurse : <input style="color:black;" type="text" name="nurse" class="form-control" value="<?php echo $nurse; ?>" y></td>
                              </tr>
                              <tr>
                                <td style="color:black;">Other (name and role) : <input style="color:black;" name="other_name" class="form-control" value="<?php echo $other_name; ?>" type="text"></td>
                              </tr>
                              <tr>
                                <td style="color:black;">Special Education Teacher :
                                  <select name="sp_teacher" class="form-control" id="">
                                    <option value="<?php echo $sp_teacher; ?>"><?php echo $sp_teacher; ?></option>
                                    <?php
                                    include('../connect.php');
                                    $sqlget = "SELECT * FROM teachers where email != 'admin' and category = 4";
                                    $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                    while ($row = mysqli_fetch_assoc($sqldata)) { ?>
                                      <option value="<?php echo $row['fname'] . " " . $row['lname']; ?>"><?php echo $row['fname'] . " " . $row['lname']; ?></option>
                                    <?php } ?>
                                  </select>
                                </td>
                                <td style="color:black;">Therapist/Pathologist/Specialist : <input style="color:black;" name="therapist" class="form-control" value="<?php echo $therapist; ?>" type="text"></td>
                              </tr>
                              <tr>
                                <td style="color:black;" colspan="2">*Learner must be invited when transition is discussed
                                  **The IEP learn must include at least one regular education teacher of the learner (if the learner is or may be participating in the regular education environment
                                </td>
                              </tr>
                              <tr>
                                <td style="color:black;" rowspan="2" colspan="2">
                                  <p style="color:black;"><input style="color:black;" type="radio" name="if_1" <?php if ($if_1 == '1') {
                                                                                                                  echo 'checked';
                                                                                                                } ?> value="1"> Not Applicable (learner will not be 18 within one year</p>
                                  <p style="color:black;"><input style="color:black;" type="radio" name="if_1" <?php if ($if_1 == '2') {
                                                                                                                  echo 'checked';
                                                                                                                } ?> value="2">The learner has been informed of his/her rights under law and advised of the transfer of rights at age 18</p>
                                  <p style="color:black;">Distribution:</p>
                                  <p style="color:black;"><input style="color:black;" type="radio" name="dis_1" <?php if ($dis_1 == '1') {
                                                                                                                  echo 'checked';
                                                                                                                } ?> value="1"> Learner’s Folder</p>
                                  <p style="color:black;"> <input style="color:black;" type="radio" name="dis_1" <?php if ($dis_1 == '2') {
                                                                                                                    echo 'checked';
                                                                                                                  } ?> value="2"> Parent/Guardian/Caregiver/ Ed Special Education/Receiving Teacher</p>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <!-- iepteam -->
                        <!--goal-->
                        <div class="tab-pane fade" id="a4update" role="tabpanel" aria-labelledby="contact-tab">
                          <div class="row">
                            <!--B.	Goals-->
                            <div class="col-md-12" align="left">
                              <h5 style="color:black;" class="mt-4">C. STUDENT GOALS</h5>
                              <p style="color:black;"> To support identification of learner goals, also confirm:</p>
                              <p style="color:black;"> • What opprtunites are available at the school to support learner goals?</p>
                              <p style="color:black;"> • What are the student interest areas?</p>
                              <p style="color:black;"> • What disability-specific skills does the learner need to develop to support their participation/ attainment of goals?</p>
                              <p style="color:black;"> Goals –(eg.-Skills to improve participation in education or daily living skills. Goals should be SMART (Strategic, Measurable, Achievable, Realistic, and Time-bound)</p>
                              <table class="table table-bordered">
                                <tr class="bg-secondary text-white">
                                  <th style="color:black;">INTEREST</th>
                                  <th style="color:black;">GOAL</th>
                                  <th style="color:black;">INTERVENTIONS</th>
                                  <th style="color:black;">TIMELINE</th>
                                  <th style="color:black;">INDIVIDUALS RESPONSIBLE</th>
                                  <th style="color:black;">REMARKS </th>
                                  <th style="color:black;">PROGRESS/
                                    NEXT STEPS</th>
                                </tr>
                                <?php
                                include('../connect.php');
                                $id1 = $_GET['id'];
                                $folder_id = $_GET['folder_id'];
                                $count = 0;
                                $sqlget4 = "SELECT * FROM iep_goals where lrn = $id and folder_id = $folder_id and iep_id = $iep_id";
                                $sqldata4 = mysqli_query($conn, $sqlget4) or die('Error Displaying Data' . mysqli_connect_error());
                                while ($row4 = mysqli_fetch_assoc($sqldata4)) {
                                  $count++;
                                ?>
                                  <tr>
                                    <td style="color:black;"><textarea name="interest_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row4['interest']; ?></textarea></td>
                                    <td style="color:black;"><textarea name="goal_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row4['goal']; ?></textarea></td>
                                    <td style="color:black;"><textarea name="intervention_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row4['intervention']; ?></textarea></td>
                                    <td style="color:black;"><textarea name="timeline_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row4['timeline']; ?></textarea></td>
                                    <td style="color:black;"><textarea name="individual_responsible_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row4['individual_responsible']; ?></textarea></td>
                                    <td style="color:black;"><textarea name="remarks_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row4['remarks']; ?></textarea></td>
                                    <td style="color:black;"><textarea name="progress_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row4['progress']; ?></textarea></td>
                                  </tr>
                                <?php }
                                ?>
                              </table>
                              <h5 style="color:black;" class="mt-4">D. STUDENT TRANSITION</h5>
                              <p style="color:black;">This section is for learners exiting the school environment and transitioning into work.</p>
                              <table class="table table-bordered">
                                <tr class="bg-secondary text-white">
                                  <th style="color:black;">INTEREST</th>
                                  <th style="color:black;">WORK OPPORTUNITIES</th>
                                  <th style="color:black;">INTERVENTIONS/
                                    TRANSITION SKILLS
                                  </th>
                                  <th style="color:black;">INDIVIDUALS RESPONSIBLE</th>
                                  <th style="color:black;">REMARKS</th>
                                </tr>
                                <?php
                                include('../connect.php');
                                $id1 = $_GET['id'];
                                $folder_id = $_GET['folder_id'];
                                $count = 0;
                                $sqlget5 = "SELECT * FROM iep_transition where lrn = $id and folder_id = $folder_id and iep_id = $iep_id";
                                $sqldata5 = mysqli_query($conn, $sqlget5) or die('Error Displaying Data' . mysqli_connect_error());
                                while ($row5 = mysqli_fetch_assoc($sqldata5)) {
                                  $count++;
                                ?>
                                  <tr>
                                    <td style="color:black;"><textarea name="interest1_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row5['interest']; ?></textarea></td>
                                    <td style="color:black;"><textarea name="work1_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row5['work']; ?></textarea></td>
                                    <td style="color:black;"><textarea name="skills1_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row5['skills']; ?></textarea></td>
                                    <td style="color:black;"><textarea name="individual_responsible1_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row5['individual_responsible']; ?></textarea></td>
                                    <td style="color:black;"><textarea name="remarks1_<?php echo $count; ?>" class="form-control" id="" cols="30" rows="3"><?php echo $row5['remarks']; ?></textarea></td>
                                  </tr>
                                <?php }
                                ?>
                              </table>
                            </div>
                            <!--B.	Goals-->
                          </div>
                        </div>
                        <!--goal-->
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal iep update -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="a1-tab" data-toggle="tab" href="#a1info" role="tab" aria-controls="a1"
                  aria-selected="true">Information</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="a1-tab" data-toggle="tab" href="#a6team" role="tab" aria-controls="a1"
                  aria-selected="true">IEP Team</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="a1-tab" data-toggle="tab" href="#a7" role="tab" aria-controls="a1"
                  aria-selected="true">Functional Performance</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#a2" role="tab" aria-controls="profile"
                  aria-selected="false">Consideration</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#a3" role="tab" aria-controls="contact"
                  aria-selected="false">Barriers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#a4" role="tab" aria-controls="contact"
                  aria-selected="false">Goals && Transition</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <!-- iepinfo -->
              <div class="tab-pane active show" id="a1info" role="tabpanel" aria-labelledby="a1-tab" align="left">
                <h5 style="color:black;" class="mt-4"> A. PERSONAL INFORMATION </h5>
                <?php
                $d_seeing = '';
                $d_hearing = '';
                $d_moving = '';
                $d_concentrating = '';
                $d_remembering = '';
                $others = '';
                $others_2 = '';
                $medical_diagnos = '';
                $date_meeting = '';
                $date_last_iep = '';
                $purpose = '';
                $review_date = '';
                $comment = '';
                $grade = '';
                include('../connect.php');
                $iep_id = "";
                $id1 = $_GET['id'];
                $sqldif1 = "SELECT * FROM iep_difficulty where lrn = $id1 and folder_id = $f_id and iep_id = $iid";
                $sqldatadif1 = mysqli_query($conn, $sqldif1) or die('Error Displaying Data' . mysqli_connect_error());
                while ($rowdif1 = mysqli_fetch_assoc($sqldatadif1)) {
                  $d_seeing = $rowdif1['d_seeing'];
                  $d_hearing = $rowdif1['d_hearing'];
                  $d_moving = $rowdif1['d_moving'];
                  $d_com = $rowdif1['d_com'];
                  $d_concentrating = $rowdif1['d_concentrating'];
                  $d_remembering = $rowdif1['d_remembering'];
                  $others = $rowdif1['others'];
                  $others_2 = $rowdif1['others_2'];
                  $medical_diagnos = $rowdif1['medical_diagnos'];
                  $date_meeting = $rowdif1['date_meeting'];
                  $date_last_iep = $rowdif1['date_last_iep'];
                  $purpose = $rowdif1['purpose'];
                  $review_date = $rowdif1['review_date'];
                  $comment = $rowdif1['comment'];
                  $grade = $rowdif1['grade'];
                }
                ?>
                <div class="row border">
                  <!--info-->
                  <div class="col-md-3 border">
                    <table class="table">
                      <tr>
                        <td style="color:black;">
                          <p style="color:black;"><strong>Grade/Level:</strong> <input style="color:black;" readonly type="text" class="form-control" value="<?php echo $grade; ?>"> </p>
                        </td>
                      </tr>
                      <tr>
                        <td style="color:black;">
                          <p style="color:black;"><strong>Interpreter or other Accomodations Needed:</strong><br><textarea disabled name="others_2" class="form-control"><?php echo $others_2; ?></textarea></p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!--info-->
                  <!--difficulty-->
                  <div class="col-md-4 border" align="left" style="color:black;">
                    DIFFICULTIES (Select most relevant):
                    <p style="color:black;"><input style="color:black;" type="checkbox" <?php if ($d_seeing != '') {
                                                                                          echo 'checked';
                                                                                        } else {
                                                                                          echo 'disabled';
                                                                                        } ?> name="d_seeing" value="1"> Difficulty in Seeing</p>
                    <p style="color:black;"><input style="color:black;" <?php if ($d_hearing != '') {
                                                                          echo 'checked';
                                                                        } else {
                                                                          echo 'disabled';
                                                                        } ?> type="checkbox" name="d_hearing" value="1"> Difficulty in Hearing</p>
                    <p style="color:black;"><input style="color:black;" type="checkbox" <?php if ($d_com != '') {
                                                                                          echo 'checked';
                                                                                        } else {
                                                                                          echo 'disabled';
                                                                                        } ?> name="d_com" value="1"> Difficulty in Communicating</p>
                    <p style="color:black;"><input style="color:black;" type="checkbox" <?php if ($d_moving != '') {
                                                                                          echo 'checked';
                                                                                        } else {
                                                                                          echo 'disabled';
                                                                                        } ?> name="d_moving" value="1"> Difficulty in Moving/Walking</p>
                    <p style="color:black;"><input style="color:black;" type="checkbox" <?php if ($d_concentrating != '') {
                                                                                          echo 'checked';
                                                                                        } else {
                                                                                          echo 'disabled';
                                                                                        } ?> name="d_concentrating" value="1"> Difficulty in Concentrating/Paying
                      Attention </p>
                    <p style="color:black;"><input style="color:black;" type="checkbox" <?php if ($d_remembering != '') {
                                                                                          echo 'checked';
                                                                                        } else {
                                                                                          echo 'disabled';
                                                                                        } ?> name="d_remembering" value="1"> Difficulty in Remembering/
                      Understanding</p>
                    <p style="color:black;"><input style="color:black;" type="checkbox" <?php if ($d_remembering != '') {
                                                                                          echo 'checked';
                                                                                        } else {
                                                                                          echo 'disabled';
                                                                                        } ?> name="d_other" value="1">Other (please specify) <br><textarea disabled name="others" id="" cols="25" rows="3"><?php echo $others; ?></textarea></p>
                    <p style="color:black;"> Medical diagnosis(if yes, Indicate) <br><textarea disabled name="medical_diagnos" id="" cols="25" rows="3"><?php echo $medical_diagnos; ?></textarea></p>
                  </div>
                  <!--difficulty-->
                  <!--meeting-->
                  <div class="col-md-5 border" align="left" style="color:black;">
                    MEETING INFORMATION:
                    <p style="color:black;">DATE OF MEETING <input style="color:black;" value="<?php echo $date_meeting; ?>" readonly type="date" name="date_meeting"></p>
                    <p style="color:black;">DATE OF LAST IEP<input style="color:black;" value="<?php echo $date_last_iep; ?>" readonly type="date" name="date_last_iep"></p>
                    <strong>PURPOSE OF MEETING:</strong>
                    <p style="color:black;"><input style="color:black;" <?php if ($purpose == '1') {
                                                                          echo 'checked';
                                                                        } else {
                                                                          echo 'disabled';
                                                                        } ?> type="radio" name="purpose" value="1"> Interim IEP</p>
                    <p style="color:black;"><input style="color:black;" <?php if ($purpose == '2') {
                                                                          echo 'checked';
                                                                        } else {
                                                                          echo 'disabled';
                                                                        } ?> type="radio" name="purpose" value="2"> Initial IEP</p>
                    <p style="color:black;"><input style="color:black;" <?php if ($purpose == '3') {
                                                                          echo 'checked';
                                                                        } else {
                                                                          echo 'disabled';
                                                                        } ?> type="radio" name="purpose" value="3"> Term IEP</p>
                    <p style="color:black;"><input style="color:black;" <?php if ($purpose == '4') {
                                                                          echo 'checked';
                                                                        } else {
                                                                          echo 'disabled';
                                                                        } ?> type="radio" name="purpose" value="4"> IEP Following 3-Yr, Reevaluation</p>
                    <p style="color:black;"><input style="color:black;" <?php if ($purpose == '5') {
                                                                          echo 'checked';
                                                                        } else {
                                                                          echo 'disabled';
                                                                        } ?> type="radio" name="purpose" value="5"> Revision to IEP Date <input style="color:black;" value="<?php echo $review_date; ?>" readonly type="date" name="review_date"></p>
                    <p style="color:black;"><input style="color:black;" <?php if ($purpose == '6') {
                                                                          echo 'checked';
                                                                        } else {
                                                                          echo 'disabled';
                                                                        } ?> type="radio" name="purpose" value="6"> Exit/Graduation</p>
                    <p style="color:black;"> IEP Revision Without a Meeting At the request of </p>
                    <p style="color:black;"> <input style="color:black;" <?php if ($purpose == '7') {
                                                                            echo 'checked';
                                                                          } else {
                                                                            echo 'disabled';
                                                                          } ?> type="radio" name="purpose" value="7">Parent</p>
                    <p style="color:black;"> <input style="color:black;" type="radio" <?php if ($purpose == '8') {
                                                                                        echo 'checked';
                                                                                      } else {
                                                                                        echo 'disabled';
                                                                                      } ?> name="purpose" value="8">School</p>
                    <p style="color:black;">IEP Review Date</p>
                    <p style="color:black;">COMMENTS:<br><textarea disabled name="comment" id="" cols="30" rows="3"><?php echo $comment;  ?></textarea></p>
                  </div>
                </div>
              </div>
              <!-- iepinfo -->
              <!-- iepteam -->
              <div class="tab-pane fade " id="a6team" role="tabpanel" aria-labelledby="a1-tab" align="left">
                IEP TEAM MEMBERS IN ATTENDANCE
                <?php
                $psych = '';
                $nurse = '';
                $therapist = '';
                $language = '';
                $if_regular = '';
                $date = '';
                $guidance = '';
                $other_name = '';
                $rincipal = '';
                $if_1 = '';
                $dis_1 = '';
                include('../connect.php');
                $iep_id = "";
                $id1 = $_GET['id'];
                $sqlteam = "SELECT * FROM iep_team where lrn = $id1 and folder_id = $f_id and iep_id = $iid";
                $sqldatateam = mysqli_query($conn, $sqlteam) or die('Error Displaying Data' . mysqli_connect_error());
                while ($rowdif11 = mysqli_fetch_assoc($sqldatateam)) {
                  $psych = $rowdif11['psych'];
                  $nurse = $rowdif11['nurse'];
                  $therapist = $rowdif11['therapist'];
                  $language = $rowdif11['language'];
                  $if_regular = $rowdif11['if_regular'];
                  $date = $rowdif11['date'];
                  $guidance = $rowdif11['guidance'];
                  $other_name = $rowdif11['other_name'];
                  $rincipal = $rowdif11['principal'];
                  $if_1 = $rowdif11['if_1'];
                  $dis_1 = $rowdif11['dis_1'];
                  $sp_teacher = $rowdif11['sp_teacher'];
                }
                ?>
                <div class="row">
                  <table class="table">
                    <tr>
                      <td style="color:black;">School Psychologist: <input style="color:black;" type="text" value="<?php echo $psych; ?>" readonly class="form-control" name="psych"></td>
                      <td style="color:black;">Guidance Counselor/Designate: <input style="color:black;" type="text" value="<?php echo $guidance; ?>" readonly class="form-control" name="guidance"></td>
                    </tr>
                    <tr>
                      <td style="color:black;">Principal/School Head: <input style="color:black;" type="text" value="<?php echo $rincipal; ?>" readonly class="form-control" name="principal"></td>
                      <td style="color:black;">School Nurse : <input style="color:black;" type="text" class="form-control" value="<?php echo $nurse; ?>" readonly name="nurse"></td>
                    </tr>
                    <tr>
                      <td style="color:black;">Other (name and role) : <input style="color:black;" class="form-control" value="<?php echo $other_name; ?>" readonly name="other_name" type="text"></td>
                    </tr>
                    <tr>
                      <td style="color:black;">Special Education Teacher : <input style="color:black;" class="form-control" value="<?php echo $sp_teacher; ?>" readonly name="sp_teacher" type="text"></td>
                      <td style="color:black;">Therapist/Pathologist/Specialist : <input style="color:black;" class="form-control" value="<?php echo $therapist; ?>" readonly name="therapist" type="text"></td>
                    </tr>
                    <tr>
                      <td style="color:black;" colspan="2">*Learner must be invited when transition is discussed
                        **The IEP learn must include at least one regular education teacher of the learner (if the learner is or may be participating in the regular education environment
                      </td>
                    </tr>
                    <tr>
                      <td style="color:black;" rowspan="2" colspan="2">
                        <p style="color:black;"><input style="color:black;" type="checkbox" <?php if ($if_1 == '1') {
                                                                                              echo 'checked';
                                                                                            } else {
                                                                                              echo 'disabled';
                                                                                            } ?> value="1" name="if_1"> Not Applicable (learner will not be 18 within one year</p>
                        <p style="color:black;"><input style="color:black;" type="checkbox" <?php if ($if_1 == '2') {
                                                                                              echo 'checked';
                                                                                            } else {
                                                                                              echo 'disabled';
                                                                                            } ?> value="2" name="if_2">The learner has been informed of his/her rights under law and advised of the transfer of rights at age 18</p>
                        <p style="color:black;">Distribution:</p>
                        <p style="color:black;"><input style="color:black;" type="checkbox" <?php if ($dis_1 == '1') {
                                                                                              echo 'checked';
                                                                                            } else {
                                                                                              echo 'disabled';
                                                                                            } ?> value="1" name="dis_1"> Learner’s Folder</p>
                        <p style="color:black;"> <input style="color:black;" type="checkbox" <?php if ($dis_1 == '2') {
                                                                                                echo 'checked';
                                                                                              } else {
                                                                                                echo 'disabled';
                                                                                              } ?> value="1" name="dis_2"> Parent/Guardian/Caregiver/ Ed Special Education/Receiving Teacher</p>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- iepteam -->
              <!--team-->
              <div class="tab-pane fade " id="a7" role="tabpanel" aria-labelledby="a1-tab" align="left">
                <div class="row">
                  <h5 style="color:black;" class="mt-4"> I. PRESENT LEVELS OF ACADEMIC ACHIEVEMENT AND FUNCTIONAL PERFORMANCE</h5>
                  <table class="table table-bordered">
                    <tr class="bg-secondary text-white">
                      <th style="color:black;">Result of initial or most recent evaluation of school and division assessments:</th>
                    </tr>
                    <?php
                    $function1 = "";
                    $function2 = "";
                    $function3 = "";
                    $function4 = "";
                    $function5 = "";
                    $function1_2 = "";
                    $function2_2 = "";
                    $function3_2 = "";
                    $function4_2 = "";
                    $function5_2 = "";
                    $function1_3 = "";
                    $function2_3 = "";
                    $function3_3 = "";
                    $function4_3 = "";
                    $function5_3 = "";
                    include('../connect.php');
                    $iep_id = "";
                    $id1 = $_GET['id'];
                    $sqldif1 = "SELECT * FROM iep_difficulty where lrn = $id1 and folder_id = $f_id and iep_id = $iid";
                    $sqldatadif1 = mysqli_query($conn, $sqldif1) or die('Error Displaying Data' . mysqli_connect_error());
                    while ($rowdif1 = mysqli_fetch_assoc($sqldatadif1)) {
                      $iep_id = $rowdif1['iep_id'];
                    }
                    $id1 = $_GET['id'];
                    $f_id = $_GET['folder_id'];
                    $sqlget1 = "SELECT * FROM iep_functional where lrn = $id1 and folder_id = $f_id and iep_id = $iep_id";
                    $sqldata1 = mysqli_query($conn, $sqlget1) or die('Error Displaying Data' . mysqli_connect_error());
                    while ($row1 = mysqli_fetch_assoc($sqldata1)) {
                      $function1 = $row1['functional_1'];
                      $function2 = $row1['functional_2'];
                      $function3 = $row1['functional_3'];
                      $function4 = $row1['functional_4'];
                      $function5 = $row1['functional_5'];
                      $function1_2 = $row1['functional_1_2'];
                      $function2_2 = $row1['functional_2_2'];
                      $function3_2 = $row1['functional_3_2'];
                      $function4_2 = $row1['functional_4_2'];
                      $function5_2 = $row1['functional_5_2'];
                      $function1_3 = $row1['functional_1_3'];
                      $function2_3 = $row1['functional_2_3'];
                      $function3_3 = $row1['functional_3_3'];
                      $function4_3 = $row1['functional_4_3'];
                      $function5_3 = $row1['functional_5_3'];
                    ?>
                    <?php }
                    ?>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo  $function1; ?></strong></p>
                      </td>
                    </tr>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo  $function1_2; ?></strong> </p>
                      </td>
                    </tr>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo $function1_3; ?></strong> </p>
                      </td>
                    </tr>
                    <tr class="bg-secondary text-white">
                      <th style="color:black;">Description of academic, developmental and/or functional strengths:</th>
                    </tr>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo  $function2; ?></strong> </p>
                      </td>
                    </tr>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo  $function2_2; ?></strong></p>
                      </td>
                    </tr>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo  $function2_3; ?></strong></p>
                      </td>
                    </tr>
                    <tr class="bg-secondary text-white">
                      <th style="color:black;">Description of academic, developmental and/or functional needs:</th>
                    </tr>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo  $function3; ?></strong></p>
                      </td>
                    </tr>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo  $function3_2; ?></strong></p>
                      </td>
                    </tr>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo  $function3_3; ?></strong></p>
                      </td>
                    </tr>
                    <tr class="bg-secondary text-white">
                      <th style="color:black;">Parental concerns regarding their child’s education:</th>
                    </tr>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo $function4; ?></strong></p>
                      </td>
                    </tr>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo  $function4_2; ?></strong></p>
                      </td>
                    </tr>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo  $function4_3; ?></strong></p>
                      </td>
                    </tr>
                    <tr class="bg-secondary text-white">
                      <th style="color:black;">Impact of the disability on involvement and progress in the general education curriculum (for preschool, how the disability affects participation in appropriate activities).</th>
                    </tr>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo  $function5; ?></strong></p>
                      </td>
                    </tr>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo  $function5_2; ?></strong></p>
                      </td>
                    </tr>
                    <tr>
                      <td style="color:black;">
                        <p style="color:black;"><strong> <?php echo  $function5_3; ?></strong></p>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <!--team-->
              <!--functional-->
              <div class="tab-pane fade" id="a6" role="tabpanel" aria-labelledby="a6-tab" align="left">
                IEP TEAM MEMBERS IN ATTENDANCE
                <div class="row">
                  <table class="table">
                    <tr>
                      <td style="color:black;">Parent/Guardian/Caregiver: <strong> <?php echo $guardian; ?> </strong></td>
                      <td style="color:black;">School Psychologist: <input style="color:black;" type="text" class="form-control" name="psych"></td>
                    </tr>
                    <tr>
                      <td style="color:black;">Learner: <strong> <?php echo $name; ?></strong> </td>
                      <td style="color:black;">Guidance Counselor/Designate: <input style="color:black;" type="text" class="form-control" name="guidance"></td>
                    </tr>
                    <tr>
                      <td style="color:black;">Principal/School Head: <input style="color:black;" type="text" class="form-control" name="principal"></td>
                      <td style="color:black;">School Nurse : <input style="color:black;" type="text" class="form-control" name="nurse"></td>
                    </tr>
                    <tr>
                      <td style="color:black;">Other (name and role) : <input style="color:black;" class="form-control" name="other_name" type="text"></td>
                    </tr>
                    <tr>
                      <td style="color:black;">Special Education Teacher : <input style="color:black;" class="form-control" name="teacher" type="text"></td>
                      <td style="color:black;">Therapist/Pathologist/Specialist : <input style="color:black;" class="form-control" name="therapist" type="text"></td>
                    </tr>
                    <tr>
                      <td style="color:black;" colspan="2">*Learner must be invited when transition is discussed
                        **The IEP learn must include at least one regular education teacher of the learner (if the learner is or may be participating in the regular education environment
                      </td>
                    </tr>
                    <tr align="center">
                      <td style="color:black;" colspan="2">_____<u> <?php echo $guardian; ?></u>_____<br>Signature over Printed Name of Parent/Guardian/Caregiver
                      </td>
                    </tr>
                    <tr>
                      <td style="color:black;" rowspan="2" colspan="2">
                        <p style="color:black;"><input style="color:black;" type="checkbox" value="1" name="if_1"> Not Applicable (learner will not be 18 within one year</p>
                        <p style="color:black;"><input style="color:black;" type="checkbox" value="2" name="if_2">The learner has been informed of his/her rights under law and advised of the transfer of rights at age 18</p>
                        <p style="color:black;">Distribution:</p>
                        <p style="color:black;"><input style="color:black;" type="checkbox" value="1" name="dis_1"> Learner’s Folder</p>
                        <p style="color:black;"> <input style="color:black;" type="checkbox" value="1" name="dis_2"> Parent/Guardian/Caregiver/ Ed Special Education/Receiving Teacher</p>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <!--functional-->
              <!--factors-->
              <div class="tab-pane fade" id="a2" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
                  <!--CONSIDERATION OF SPECIAL FACTORS-->
                  <div class="col-md-12" align="left">
                    <h5 style="color:black;" class="mt-4">II. CONSIDERATION OF SPECIAL FACTORS</h5>
                    <?php
                    $factor1 = "";
                    $factor2 = "";
                    $factor3 = "";
                    $factor4 = "";
                    $factor5 = "";
                    $factor6 = "";
                    $factor7 = "";
                    $factor8 = "";
                    $factor9 = "";
                    $factor_type = "";
                    $comment1 = "";
                    $comment2 = "";
                    $comment3 = "";
                    $comment4 = "";
                    $comment5 = "";
                    $comment6 = "";
                    $comment7 = "";
                    $comment8 = "";
                    $comment9 = "";
                    include('../connect.php');
                    $id1 = $_GET['id'];
                    $folder_id = $_GET['folder_id'];
                    $sqlget2 = "SELECT * FROM iep_special_factor where lrn = $id and folder_id = $folder_id and iep_id = $iep_id";
                    $sqldata2 = mysqli_query($conn, $sqlget2) or die('Error Displaying Data' . mysqli_connect_error());
                    while ($row2 = mysqli_fetch_assoc($sqldata2)) {
                      $factor1 = $row2['factor_1'];
                      $factor2 =  $row2['factor_2'];
                      $factor3 =  $row2['factor_3'];
                      $factor4 =  $row2['factor_4'];
                      $factor5 =  $row2['factor_5'];
                      $factor6 =  $row2['factor_6'];
                      $factor7 =  $row2['factor_7'];
                      $factor8 =  $row2['factor_8'];
                      $factor9 =  $row2['factor_9'];
                      $factor_type = $row2['factor_8_type'];
                      $comment3 = $row2['comment_3'];
                      $comment4 = $row2['comment_4'];
                      $comment5 = $row2['comment_5'];
                      $comment6 = $row2['comment_6'];
                      $comment7 = $row2['comment_7'];
                      $comment8 = $row2['comment_8'];
                      $comment9 = $row2['comment_9'];
                    ?>
                    <?php }
                    ?>
                    <table class="table">
                      <tr>
                        <td style="color:black;" colspan="2">
                          <p style="color:black;">a.)Does the learner have difficulty relating with people which impede his/her learning or the learning of other? </p>
                        </td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor1 == 'yes') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_1" value="yes">Yes</td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor1 == 'no') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_1" value="no">No</td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="2">
                          <p style="color:black;">b.)if yes, consider the appropriateness of developing a Behavior Intervention Plan. Behavior Intervention Plan developed? Refer to Behavior InterventionPlan for additional information.</p>
                        </td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor2 == 'yes') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_2" value="yes">Yes</td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor2 == 'no') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_2" value="no">No</td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="2">
                          <p style="color:black;">Does the leaner have difficulty in Moving/ Walking?
                            If yes, consider the mobility needs as related to IEP and describe below.
                          </p>
                        </td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor3 == 'yes') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_3" value="yes">Yes</td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor3 == 'no') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_3" value="no">No</td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="4">
                          <p style="color:black;"><?php echo $comment3; ?></p>
                        </td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="2">
                          <p style="color:black;">Does the learner have difficulty in seeing or with blindness/visual impairment?
                            If yes, provide for instruction in Braille and the use of Braille, unless the IEP Team determines that instruction in Braille is not appropriate for the learner after an
                            evaluation of the learner’s reading and writing skills, needs, and appropriate reading and wrting media, including evaluation of future needs for instruction in Braille
                            or the use of Braille. Describe below.
                          </p>
                        </td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor4 == 'yes') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_4" value="yes">Yes</td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor4 == 'no') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_4" value="no">No</td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="4">
                          <p style="color:black;"><?php echo $comment4; ?></p>
                        </td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="2">
                          <p style="color:black;">Does the learner have difficulty in communicating?
                            If yes, consider the communication needs and describe below.
                          </p>
                        </td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor5 == 'yes') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_5" value="yes">Yes</td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor5 == 'no') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_5" value="no">No</td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="4">
                          <p style="color:black;"><?php echo $comment5; ?></p>
                        </td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="2">
                          <p style="color:black;">Does the learner have difficulty in concentrating/paying attention?
                            If yes, consider the understanding needs and describe below.
                          </p>
                        </td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor6 == 'yes') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_6" value="yes">Yes</td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor6 == 'no') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_6" value="no">No</td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="4">
                          <p style="color:black;"><?php echo $comment6; ?></p>
                        </td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="2">
                          <p style="color:black;">Does the learner have difficulty in hearing or Is the learner deaf or hard of hearing?</strong>
                            If yes, consider and describe the learner’s language and communication needs, opportunities for direct communication with peers and professional personnel in the
                            learner’s language and communication mode, academic level and full range of needs, including opportunities for direct instruction in the learner’s language and
                            communication mode. Describe communication needs below.
                          </p>
                        </td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor7 == 'yes') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_7" value="yes">Yes</td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor7 == 'no') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_7" value="no">No</td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="4">
                          <p style="color:black;"><?php echo $comment7; ?></p>
                        </td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="2">
                          <p style="color:black;">Does the learner need assistive technology devices or services?</strong>
                            If yes, describe the type of assistive technology and how it is used. If no, describe how the learner’s needs are being met in deficit areas
                          </p>
                        </td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor8 == 'yes') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_8" value="yes">Yes</td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor8 == 'no') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_8" value="no">No</td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="4">
                          <p style="color:black;"><?php echo $comment8; ?></p>
                        </td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="2">
                          <p style="color:black;">Does the learner require alternative format for instructional materials?</strong>
                            If yes, specify format(s) of materials required below.
                          </p>
                        </td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor9 == 'yes') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_9" value="yes">Yes</td>
                        <td style="color:black;"><input style="color:black;" type="radio" <?php if ($factor9 == 'no') {
                                                                                            echo 'checked';
                                                                                          } ?> disabled name="factor_9" value="no">No</td>
                      </tr>
                      <tr>
                        <td style="color:black;" colspan="4"><input style="color:black;" type="radio" <?php if ($factor_type == 'Braille') {
                                                                                                        echo 'checked';
                                                                                                      } ?> name="factor_8_type" value="Braille"> Braille
                          <input style="color:black;" type="radio" name="factor_8_type" <?php if ($factor_type == 'Large Type') {
                                                                                          echo 'checked';
                                                                                        } ?> value="Large Type"> Large Type
                          <input style="color:black;" type="radio" name="factor_8_type" <?php if ($factor_type == 'Auditory') {
                                                                                          echo 'checked';
                                                                                        } ?> value="Auditory"> Auditory
                          <input style="color:black;" type="radio" name="factor_8_type" <?php if ($factor_type == 'Electronic text') {
                                                                                          echo 'checked';
                                                                                        } ?> value="Electronic text"> Electronic text
                        </td>
                      </tr>
                      <tr>
                        <td style="color:black;">
                          <p style="color:black;"><?php echo $comment9; ?></p>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <!--factors-->
              <!--abrriers-->
              <div class="tab-pane fade" id="a3" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                  <!--B.	DIFFICULTIES, BARRIERS AND ENABLING SUPPORTS-->
                  <div class="col-md-12" align="left">
                    <h5 style="color:black;" class="mt-4"> B. DIFFICULTIES, BARRIERS AND ENABLING SUPPORTS</h5>
                    <table class="table table-bordered">
                      <tr class="bg-secondary text-white">
                        <th style="color:black;">DIFFICULTY (enter all areas of difficulty)</th>
                        <th style="color:black;">ENVIRONMENTAL BARRIERS (describe each factor restricting participation)</th>
                        <th style="color:black;">ENVIRONMENTAL FACILITATORS (describe each factor enabling participation in response to barriers) </th>
                        <th style="color:black;">ENVIRONMENTAL FACILITATORS (describe each factor enabling participation in response to barriers)</th>
                      </tr>
                      <?php
                      include('../connect.php');
                      $id1 = $_GET['id'];
                      $folder_id = $_GET['folder_id'];
                      $sqlget3 = "SELECT * FROM iep_barriers where lrn = $id and folder_id = $folder_id and iep_id = $iep_id";
                      $sqldata3 = mysqli_query($conn, $sqlget3) or die('Error Displaying Data' . mysqli_connect_error());
                      while ($row3 = mysqli_fetch_assoc($sqldata3)) {
                      ?>
                        <tr>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row3['barrier_1']; ?></p>
                          </td>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row3['barrier_2']; ?></p>
                          </td>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row3['barrier_3']; ?></p>
                          </td>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row3['barrier_4']; ?></p>
                          </td>
                        </tr>
                      <?php }
                      ?>
                    </table>
                    Selection of Barriers and Qualifiers for Environmental Barriers and Facilitators (taken from ICF)
                    <table class="table table-bordered">
                      <tr class="bg-secondary text-white">
                        <th style="color:black;">DIFFICULTIES (select all relevant categories)</th>
                        <th style="color:black;">Qualifiers for Environmental Barriers</th>
                        <th style="color:black;">Qualifiers for Environmental Facilitators</th>
                      </tr>
                      <tr>
                        <td style="color:black;" rowspan="6">
                          <p style="color:black;"> • Seeing </p>
                          <p style="color:black;"> • Hearing </p>
                          <p style="color:black;"> • Communicating </p>
                          <p style="color:black;"> • Moving/Walking </p>
                          <p style="color:black;"> • Concentrating/Paying Attention </p>
                          <p style="color:black;"> • Remembering/understanding </p>
                        </td>
                        <td style="color:black;" rowspan="6">
                          <p style="color:black;"> 0 No barrier </p>
                          <p style="color:black;"> 1 Mild barrier </p>
                          <p style="color:black;"> 2 Moderate barrier </p>
                          <p style="color:black;"> 3 Severe barrier </p>
                          <p style="color:black;"> 4 Complete barrier </p>
                          <p style="color:black;"> 8 Barrier, not specified </p>
                          <p style="color:black;"> 9 Not Applicable </p>
                        </td>
                        <td style="color:black;" rowspan="6">
                          <p style="color:black;"> +1 Mild facilatator </p>
                          <p style="color:black;"> +2 Moderate facilatator </p>
                          <p style="color:black;"> +3 Substantial facilatator </p>
                          <p style="color:black;"> +4 Complete facilatator </p>
                          <p style="color:black;"> +8 Facilitator, not specified </p>
                          <p style="color:black;"> +9 Not Applicable </p>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!--B.	DIFFICULTIES, BARRIERS AND ENABLING SUPPORTS-->
                </div>
              </div>
              <!--abrriers-->
              <!--goal-->
              <div class="tab-pane fade" id="a4" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                  <!--B.	Goals-->
                  <div class="col-md-12" align="left">
                    <h5 style="color:black;" class="mt-4">C. STUDENT GOALS</h5>
                    <p style="color:black;"> To support identification of learner goals, also confirm:</p>
                    <p style="color:black;"> • What opprtunites are available at the school to support learner goals?</p>
                    <p style="color:black;"> • What are the student interest areas?</p>
                    <p style="color:black;"> • What disability-specific skills does the learner need to develop to support their participation/ attainment of goals?</p>
                    <p style="color:black;"> Goals –(eg.-Skills to improve participation in education or daily living skills. Goals should be SMART (Strategic, Measurable, Achievable, Realistic, and Time-bound)</p>
                    <table class="table table-bordered">
                      <tr class="bg-secondary text-white">
                        <th style="color:black;">INTEREST</th>
                        <th style="color:black;">GOAL</th>
                        <th style="color:black;">INTERVENTIONS</th>
                        <th style="color:black;">TIMELINE</th>
                        <th style="color:black;">INDIVIDUALS RESPONSIBLE</th>
                        <th style="color:black;">REMARKS </th>
                        <th style="color:black;">PROGRESS/
                          NEXT STEPS</th>
                      </tr>
                      <?php
                      include('../connect.php');
                      $id1 = $_GET['id'];
                      $folder_id = $_GET['folder_id'];
                      $sqlget4 = "SELECT * FROM iep_goals where lrn = $id and folder_id = $folder_id and iep_id = $iep_id";
                      $sqldata4 = mysqli_query($conn, $sqlget4) or die('Error Displaying Data' . mysqli_connect_error());
                      while ($row4 = mysqli_fetch_assoc($sqldata4)) {
                      ?>
                        <tr>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row4['interest']; ?></p>
                          </td>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row4['goal']; ?></p>
                          </td>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row4['intervention']; ?></p>
                          </td>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row4['timeline']; ?></p>
                          </td>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row4['individual_responsible']; ?></p>
                          </td>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row4['remarks']; ?></p>
                          </td>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row4['progress']; ?></p>
                          </td>
                        </tr>
                      <?php }
                      ?>
                    </table>
                    <h5 style="color:black;" class="mt-4">D. STUDENT TRANSITION</h5>
                    <p style="color:black;">This section is for learners exiting the school environment and transitioning into work.</p>
                    <table class="table table-bordered">
                      <tr class="bg-secondary text-white">
                        <th style="color:black;">INTEREST</th>
                        <th style="color:black;">WORK OPPORTUNITIES</th>
                        <th style="color:black;">INTERVENTIONS/
                          TRANSITION SKILLS
                        </th>
                        <th style="color:black;">INDIVIDUALS RESPONSIBLE</th>
                        <th style="color:black;">REMARKS</th>
                      </tr>
                      <?php
                      include('../connect.php');
                      $id1 = $_GET['id'];
                      $folder_id = $_GET['folder_id'];
                      $sqlget5 = "SELECT * FROM iep_transition where lrn = $id and folder_id = $folder_id and iep_id = $iep_id";
                      $sqldata5 = mysqli_query($conn, $sqlget5) or die('Error Displaying Data' . mysqli_connect_error());
                      while ($row5 = mysqli_fetch_assoc($sqldata5)) {
                      ?>
                        <tr>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row5['interest']; ?></p>
                          </td>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row5['work']; ?></p>
                          </td>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row5['skills']; ?></p>
                          </td>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row5['individual_responsible']; ?></p>
                          </td>
                          <td style="color:black;">
                            <p style="color:black;"><?php echo $row5['remarks']; ?></p>
                          </td>
                        </tr>
                      <?php }
                      ?>
                    </table>
                  </div>
                  <!--B.	Goals-->
                </div>
              </div>
              <!--goal-->
            </div>
            <!--end of  Modal -->
          </div>
          <!--/IEP tab-->
          <!--information tab-->
          <div class="tab-pane fade show active container-fluid" align="center" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h3 class="mt-3" style="color:black; font-weight:bold;">Student Information</h3>
            <div class="row">
            </div>
            <?php
            include('../connect.php');
            $id = $_GET['id'];
            $sqlget = "SELECT * FROM new_student where lrn = $id";
            $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
            while ($row = mysqli_fetch_assoc($sqldata)) {
            ?>
              <!-- Modal update info-->
              <div class="modal fade" id="exampleModalinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Update Student Information</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="update_student_info1.php?lrn=<?php echo $_GET['id']; ?>&folder_id=<?php echo $_GET['folder_id']; ?>" method="POST">
                        <div class="row">
                          <div class="col-md-6">
                            <table align="left" class="table table-bordered">
                              <tr>
                                <td style="color:black;">LRN:</td>
                                <td style="color:black;"><input style="color:black;" type="number" name="lrn" class="form-control" value="<?php echo $row['lrn']; ?>" readonly> </td>
                                <input style="color:black;" type="hidden" value="<?php echo $row['student_id']; ?>" name="id">
                              </tr>
                              <tr>
                                <td style="color:black;">Category: </td>
                                <td style="color:black;"><input style="color:black;" type="text" name="category" class="form-control" value="<?php echo $row['category']; ?>" readonly></td>
                              </tr>
                              <tr>
                                <td style="color:black;">Status: </td>
                                <td style="color:black;"> <input style="color:black;" type="text" name="enroll_status" class="form-control" value="<?php echo $row['enroll_status']; ?>" readonly> </td>
                              </tr>
                              <tr>
                                <td style="color:black;">First Name:</td>
                                <td style="color:black;">
                                  <input style="color:black;" type="text" name="fname" class="form-control" value="<?php echo $row['fname']; ?>">
                                  <input style="color:black;" type="hidden" name="student_code" class="form-control" placeholder="Student Code">
                                </td>
                              </tr>
                              <tr>
                                <td style="color:black;">Last Name:</td>
                                <td style="color:black;">
                                  <input style="color:black;" type="text" name="lname" class="form-control" value="<?php echo $row['lname']; ?>">
                              </tr>
                              <tr>
                                <td style="color:black;">Middle Name:</td>
                                <td style="color:black;">
                                  <input style="color:black;" type="text" name="mname" class="form-control" value="<?php echo $row['mname']; ?>">
                              </tr>
                              <tr>
                                <td style="color:black;">Birth Date:</td>
                                <td style="color:black;"><input style="color:black;" type="date" name="birth_date" class="form-control" value="<?php echo $row['birth_date']; ?>"></td>
                              </tr>
                              <tr>
                                <td style="color:black;">Birth Place:</td>
                                <td style="color:black;"><input style="color:black;" type="text" name="birth_place" class="form-control" value="<?php echo $row['birth_place']; ?>"></td>
                              </tr>
                              <tr>
                                <td style="color:black;">Gender:</td>
                                <td style="color:black;"><input style="color:black;" type="text" name="gender" class="form-control" value="<?php echo $row['gender']; ?>"></td>
                              </tr>
                              <tr>
                                <td style="color:black;">Address:</td>
                                <td style="color:black;"><input style="color:black;" type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>">
                              </tr>
                              <tr>
                                <td style="color:black;">School:</td>
                                <td style="color:black;"> <input style="color:black;" type="text" class="form-control" value="<?php echo $_SESSION['school']; ?>" name="school" readonly></td>
                              </tr>
                              <tr>
                                <td style="color:black;">Teacher:</td>
                                <td style="color:black;"><input style="color:black;" type="text" name="teacher" class="form-control" value="<?php echo $row['teacher']; ?>" readonly></td>
                              <tr>
                                <td style="color:black;">Mother Tounge:</td>
                                <td style="color:black;"><input style="color:black;" type="text" name="m_tounge" class="form-control" value="<?php echo $row['m_tounge']; ?>"></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-md-6 bg-light">
                            <table class="table table-bordered">
                              <tr>
                                <td style="color:black;">Guardian Name:</td>
                                <td style="color:black;">
                                  <input style="color:black;" type="text" name="guardian" class="form-control" value="<?php echo $row['guardian']; ?>">
                              </tr>
                              <tr>
                                <td style="color:black;">Guardian Occupation:</td>
                                <td style="color:black;">
                                  <input style="color:black;" type="text" name="work" class="form-control" value="<?php echo $row['work']; ?>">
                              </tr>
                              <tr>
                                <td style="color:black;">Guardian Contact:</td>
                                <td style="color:black;"><input style="color:black;" type="text" name="guardian_contact" class="form-control" value="<?php echo $row['gurdian_contact']; ?>"></td>
                              </tr>
                              <tr>
                                <td style="color:black;">Guardian email:</td>
                                <td style="color:black;">
                                  <input style="color:black;" type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                              </tr>
                              <tr>
                                <td style="color:black;">Guardian Mother Tounge:</td>
                                <td style="color:black;">
                                  <input style="color:black;" type="text" name="guardian_mtounge" class="form-control" value="<?php echo $row['guardian_mtounge']; ?>">
                              </tr>
                            </table>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            <div class="col-md-12 bg-light p-3">
              <div class="row">
                <?php
                include('../connect.php');
                $id = $_GET['id'];
                $sqlget1 = "SELECT * FROM new_student where lrn = $id";
                $sqldata1 = mysqli_query($conn, $sqlget1) or die('Error Displaying Data' . mysqli_connect_error());
                while ($row3 = mysqli_fetch_assoc($sqldata1)) {
                ?>
                  <div class="col-md-6">
                    <table align="left" class="table table-bordered">
                      <tr>
                        <td style="color:black;">LRN:</td>
                        <td style="color:black;"><input style="color:black;" type="number" name="lrn" class="form-control" value="<?php echo $row3['lrn']; ?>" disabled placeholder="Student LRN"></td>
                      </tr>
                      <tr>
                        <td style="color:black;">First Name:</td>
                        <td style="color:black;">
                          <input style="color:black;" type="text" name="fname" class="form-control" value="<?php echo $row3['fname']; ?>" disabled placeholder="First Name">
                          <input style="color:black;" type="hidden" name="student_code" class="form-control" placeholder="Student Code">
                        </td>
                      </tr>
                      <tr>
                        <td style="color:black;">Last Name:</td>
                        <td style="color:black;">
                          <input style="color:black;" type="text" name="lname" value="<?php echo $row3['lname']; ?>" disabled class="form-control" placeholder="Last Name">
                        </td>
                      </tr>
                      <tr>
                        <td style="color:black;">Middle Name:</td>
                        <td style="color:black;">
                          <input style="color:black;" type="text" name="mname" value="<?php echo $row3['mname']; ?>" disabled class="form-control" placeholder="Middle Name">
                        </td>
                      </tr>
                      <tr>
                        <td style="color:black;">Birth Date:</td>
                        <td style="color:black;"><input style="color:black;" type="date" name="birth_date" value="<?php echo $row3['birth_date']; ?>" disabled class="form-control" placeholder="Student Birth date"></td>
                      </tr>
                      <tr>
                        <td style="color:black;">Birth Place:</td>
                        <td style="color:black;"><input style="color:black;" type="text" name="birth_place" value="<?php echo $row3['birth_place']; ?>" disabled class="form-control" placeholder="Student Birth Place"></td>
                      </tr>
                      <tr>
                        <td style="color:black;">Gender:</td>
                        <td style="color:black;"><input style="color:black;" type="text" name="gender" value="<?php echo $row3['gender']; ?>" disabled class="form-control" placeholder="Student Birth Place"></td>
                      </tr>
                      <tr>
                        <td style="color:black;">Address:</td>
                        <td style="color:black;"><input style="color:black;" type="text" name="address" value="<?php echo $row3['address']; ?>" disabled class="form-control" placeholder="Student Birth Place"></td>
                      </tr>
                      <tr>
                        <td style="color:black;">School:</td>
                        <td style="color:black;"> <input style="color:black;" type="text" class="form-control" value="<?php echo $_SESSION['school']; ?>" disabled name="school" disabled></td>
                      </tr>
                      <tr>
                        <td style="color:black;">Teacher:</td>
                        <td style="color:black;"><input style="color:black;" type="text" name="teacher" value="<?php echo $row3['teacher']; ?>" disabled class="form-control" placeholder="Student Birth Place"></td>
                      </tr>
                      <tr>
                        <td style="color:black;">Mother Tounge:</td>
                        <td style="color:black;"><input style="color:black;" type="text" name="m_tounge" class="form-control" value="<?php echo $row3['m_tounge']; ?>" disabled placeholder="Mother Tounge"></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6 bg-light">
                    <table class="table table-bordered">
                      <tr>
                        <td style="color:black;">Guardian Name:</td>
                        <td style="color:black;">
                          <input style="color:black;" type="text" name="guardian" value="<?php echo $row3['guardian']; ?>" disabled class="form-control" placeholder="Guardian Name">
                        </td>
                      </tr>
                      <tr>
                        <td style="color:black;">Guardian Occupation:</td>
                        <td style="color:black;">
                          <input style="color:black;" type="text" name="work" value="<?php echo $row3['work']; ?>" disabled class="form-control" placeholder="Guardian Occupation">
                        </td>
                      </tr>
                      <tr>
                        <td style="color:black;">Guardian Contact:</td>
                        <td style="color:black;"><input style="color:black;" type="text" name="guardian_contact" value="<?php echo $row3['gurdian_contact']; ?>" disabled class="form-control" placeholder="Guardian Contact"></td>
                      </tr>
                      <tr>
                        <td style="color:black;">Guardian email:</td>
                        <td style="color:black;">
                          <input style="color:black;" type="email" name="email" value="<?php echo $row3['email']; ?>" disabled class="form-control" placeholder="Guardian Email">
                        </td>
                      </tr>
                      <tr>
                        <td style="color:black;">Guardian Mother Tounge:</td>
                        <td style="color:black;">
                          <input style="color:black;" type="text" name="guardian_mtounge" value="<?php echo $row3['guardian_mtounge']; ?>" disabled class="form-control" placeholder="Guardian Mother Tounge">
                        </td>
                      </tr>
                    </table>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <!--information tab-->
          <!--Assessent tab-->
          <div class="tab-pane fade vh-100" id="progress" role="tabpanel" aria-labelledby="progress-tab">
            <h4 class="mt-3" style="color:black; font-weight:bold;">Progress Report </h4>
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12"> <a class="btn btn-success float-right m-2" href="printprogress.php?iep_id=<?php echo $iid; ?>&lrn=<?php echo $id1; ?>&folder_id=<?php echo $_GET['folder_id']; ?>" target="_blank"> <i class="fas fa-print"></i> Print</a> </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Update progress Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="container-fluid">
                          <form action="update_new_student.php?id=<?php echo $_GET['id'] ?>&folder_id=<?php echo $_GET['folder_id'] ?>" method="post" enctype="multipart/form-data">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#aaaaaaa1" role="tab" aria-controls="home"
                                  aria-selected="true">Daily Living & Socio</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="progress-tab" data-toggle="tab" href="#aaaaaaa2" role="tab" aria-controls="progress"
                                  aria-selected="false">Language & Psychomotor</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#aaaaaaa3" role="tab" aria-controls="profile"
                                  aria-selected="false">Cognitive & Behavioral</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#aaaaaaa4" role="tab" aria-controls="profile"
                                  aria-selected="false">Teachers & Parents Remark</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#attendance" role="tab" aria-controls="profile"
                                  aria-selected="false">Attendance</a>
                              </li>
                            </ul>
                            <div class="tab-content" align="center" id="myTabContent">
                              <!--information tab-->
                              <!-- attendace -->
                              <div class="tab-pane fade" align="center" id="attendance" role="tabpanel" aria-labelledby="home-tab">
                                <h3 style="text-align:center;">Attendance</h3>
                                <div class="row mt-3">
                                  <?php
                                  include('../connect.php');
                                  $id = $_GET['id'];
                                  $Jun = "";
                                  $Jul = "";
                                  $Aug = "";
                                  $Sep = "";
                                  $Oct = "";
                                  $Nov = "";
                                  $Dece = "";
                                  $Jan = "";
                                  $Jan = "";
                                  $Feb = "";
                                  $Mar = "";
                                  $Apr = "";
                                  $May = "";
                                  $Jun1 = "";
                                  $Jul1 = "";
                                  $Aug1 = "";
                                  $Sep1 = "";
                                  $Oct1 = "";
                                  $Nov1 = "";
                                  $Dece1 = "";
                                  $Jan1 = "";
                                  $Jan1 = "";
                                  $Feb1 = "";
                                  $Mar1 = "";
                                  $Apr1 = "";
                                  $May1 = "";
                                  $folder_id = $_GET['folder_id'];
                                  $sqlget = "SELECT * FROM attendance where folder_id = $folder_id and  lrn = $id";
                                  $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                  while ($row = mysqli_fetch_assoc($sqldata)) {
                                    if ($row['type'] == 1) {
                                      $Jun = $row['june'];
                                      $Jul = $row['july'];
                                      $Aug = $row['aug'];
                                      $Sep = $row['sept'];
                                      $Oct = $row['oct'];
                                      $Nov = $row['nov'];
                                      $Dece = $row['dece'];
                                      $Jan = $row['jan'];
                                      $Feb = $row['feb'];
                                      $Mar = $row['mar'];
                                      $Apr = $row['apr'];
                                      $May = $row['may'];
                                    }
                                    if ($row['type'] == 2) {
                                      $Jun1 = $row['june'];
                                      $Jul1 = $row['july'];
                                      $Aug1 = $row['aug'];
                                      $Sep1 = $row['sept'];
                                      $Oct1 = $row['oct'];
                                      $Nov1 = $row['nov'];
                                      $Dece1 = $row['dece'];
                                      $Jan1 = $row['jan'];
                                      $Feb1 = $row['feb'];
                                      $Mar1 = $row['mar'];
                                      $Apr1 = $row['apr'];
                                      $May1 = $row['may'];
                                    }
                                  }
                                  ?>
                                  <table class="table table-bordered">
                                    <tr>
                                      <th style="color:black;">Attendance</th>
                                      <td style="color:black;">Jun</td>
                                      <td style="color:black;">Jul</td>
                                      <td style="color:black;">Aug</td>
                                      <td style="color:black;">Sep</td>
                                      <td style="color:black;">Oct</td>
                                      <td style="color:black;">Nov</td>
                                      <td style="color:black;">Dece</td>
                                      <td style="color:black;">Jan</td>
                                      <td style="color:black;">Feb</td>
                                      <td style="color:black;">Mar</td>
                                      <td style="color:black;">Apr</td>
                                      <td style="color:black;">May</td>
                                    </tr>
                                    <tr>
                                      <th style="color:black;">No. of School Days</th>
                                      <td style="color:black;"><input style="color:black;" name="june" type="number" value="<?php echo $Jun; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="july" type="number" value="<?php echo $Jul; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="aug" type="number" value="<?php echo $Jun; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="sept" type="number" value="<?php echo $Sep; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="oct" type="number" value="<?php echo $Oct; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="nov" type="number" value="<?php echo $Nov; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="dece" type="number" value="<?php echo $Dece; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="jan" type="number" value="<?php echo $Jan; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="feb" type="number" value="<?php echo $Feb; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="mar" type="number" value="<?php echo $Mar; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="apr" type="number" value="<?php echo $Apr; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="may" type="number" value="<?php echo $May; ?>" style="width:43px;"> </td>
                                    </tr>
                                    <tr>
                                      <th style="color:black;">No. of School Days Present</th>
                                      <td style="color:black;"><input style="color:black;" name="june1" type="number" value="<?php echo $Jun1; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="july1" type="number" value="<?php echo $Jul1; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="aug1" type="number" value="<?php echo $Jun1; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="sept1" type="number" value="<?php echo $Sep1; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="oct1" type="number" value="<?php echo $Oct1; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="nov1" type="number" value="<?php echo $Nov1; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="dece1" type="number" value="<?php echo $Dece1; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="jan1" type="number" value="<?php echo $Jan1; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="feb1" type="number" value="<?php echo $Feb1; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="mar1" type="number" value="<?php echo $Mar1; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="apr1" type="number" value="<?php echo $Apr1; ?>" style="width:43px;"> </td>
                                      <td style="color:black;"><input style="color:black;" name="may1" type="number" value="<?php echo $May1; ?>" style="width:43px;"> </td>
                                    </tr>
                                    <tr>
                                      <th style="color:black;">No. of School Days Absent</th>
                                      <td style="color:black;"><?php echo $Jun - $Jun1; ?></td>
                                      <td style="color:black;"><?php echo $Jul - $Jul1; ?></td>
                                      <td style="color:black;"><?php echo $Aug - $Aug1; ?></td>
                                      <td style="color:black;"><?php echo $Sep - $Sep1; ?></td>
                                      <td style="color:black;"><?php echo $Oct - $Oct1; ?></td>
                                      <td style="color:black;"><?php echo $Nov - $Nov1; ?></td>
                                      <td style="color:black;"><?php echo $Dece - $Dece1; ?></td>
                                      <td style="color:black;"><?php echo $Jan - $Jan1; ?></td>
                                      <td style="color:black;"><?php echo $Feb - $Feb1; ?></td>
                                      <td style="color:black;"><?php echo $Mar - $Mar1; ?></td>
                                      <td style="color:black;"><?php echo $Apr - $Apr1; ?></td>
                                      <td style="color:black;"><?php echo $May - $May1; ?></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              <!-- attendance -->
                              <!-- aaaaaaa1 -->
                              <div class="tab-pane fade show active" align="center" id="aaaaaaa1" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                  <div class="col-md-3"></div>
                                  <div class="col-md-6"><img src="../img/legend.jpg" class="img-fluid"> </div>
                                  <!--first-->
                                  <div class="col-md-6">
                                    <table class="table table-bordered">
                                      <tr>
                                        <th style="color:black;" rowspan="2">LEARNING AREAS</th>
                                        <th style="color:black;" colspan="4">Periodic Rating</th>
                                        <th style="color:black;" rowspan="2">final rating</th>
                                      </tr>
                                      <tr>
                                        <th style="color:black;">1</th>
                                        <th style="color:black;">2</th>
                                        <th style="color:black;">3</th>
                                        <th style="color:black;">4</th>
                                      </tr>
                                      <tr align="center">
                                        <th style="color:black;" colspan="6">Daily Living Skill Domain</th>
                                      </tr>
                                      <tr>
                                        <th style="color:black;" colspan="6">Self feeding</th>
                                      </tr>
                                      <?php
                                      include('../connect.php');
                                      $id = $_GET['id'];
                                      $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1 and folder_id =  $folder_id";
                                      $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                                      $count = 1;
                                      while ($row1 = mysqli_fetch_assoc($sqldata)) {
                                        if ($count == 26) {
                                          break;
                                        }
                                      ?>
                                        <tr>
                                          <td style="color:black;"><?php echo $row1['type']; ?> </td><input style="color:black;" type="hidden" name="1<?php echo $count; ?>" value="<?php echo $row1['type']; ?>">
                                          <td style="color:black;">
                                            <?php if ($row1['q1'] == '') { ?>
                                              <select class="selectList" name="1<?php echo $count; ?>q1" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row1['q1'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="1<?php echo $count; ?>q1" value="<?php echo $row1['q1']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row1['q2'] == '') { ?>
                                              <select class="selectList" name="1<?php echo $count; ?>q2" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row1['q2'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="1<?php echo $count; ?>q2" value="<?php echo $row1['q2']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row1['q3'] == '') { ?>
                                              <select class="selectList" name="1<?php echo $count; ?>q3" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row1['q3'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="1<?php echo $count; ?>q3" value="<?php echo $row1['q3']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row1['q4'] == '') { ?>
                                              <select class="selectList" name="1<?php echo $count; ?>q4" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row1['q4'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="1<?php echo $count; ?>q4" value="<?php echo $row1['q4']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row1['q5'] == '') { ?>
                                              <select class="selectList" name="1<?php echo $count; ?>q5" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row1['q5'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="1<?php echo $count; ?>q5" value="<?php echo $row1['q5']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                        </tr>
                                      <?php
                                        $count++;
                                      } ?>
                                    </table>
                                  </div>
                                  <!--first-->
                                  <!--SECOND-->
                                  <div class="col-md-6">
                                    <table class="table table-bordered">
                                      <tr>
                                        <th style="color:black;" rowspan="2">LEARNING AREAS</th>
                                        <th style="color:black;" colspan="4">Periodic Rating</th>
                                        <th style="color:black;" rowspan="2">final rating</th>
                                      </tr>
                                      <tr>
                                        <th style="color:black;">1</th>
                                        <th style="color:black;">2</th>
                                        <th style="color:black;">3</th>
                                        <th style="color:black;">4</th>
                                      </tr>
                                      <tr align="center">
                                        <th style="color:black;" colspan="6">SOCIO-EMOTIONAL DOMAIN</th>
                                      </tr>
                                      <?php
                                      include('../connect.php');
                                      $id2 = $_GET['id'];
                                      $sqlget2 = "SELECT * FROM progress_report where lrn = $id2 and progress_index=2 and folder_id =  $folder_id";
                                      $sqldata2 = mysqli_query($conn, $sqlget2) or die('Error Displaying Data' . mysqli_connect_error());
                                      $count = 1;
                                      while ($row2 = mysqli_fetch_assoc($sqldata2)) {
                                        if ($count == 21) {
                                          break;
                                        }
                                      ?>
                                        <tr>
                                          <td style="color:black;"><?php echo $row2['type']; ?> </td><input style="color:black;" type="hidden" name="2<?php echo $count; ?>" value="<?php echo $row2['type']; ?>">
                                          <td style="color:black;">
                                            <?php if ($row2['q1'] == '') { ?>
                                              <select class="selectList" name="2<?php echo $count; ?>q1" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row2['q1'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="2<?php echo $count; ?>q1" value="<?php echo $row2['q1']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row2['q2'] == '') { ?>
                                              <select class="selectList" name="2<?php echo $count; ?>q2" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row2['q2'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="2<?php echo $count; ?>q2" value="<?php echo $row2['q2']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row2['q3'] == '') { ?>
                                              <select class="selectList" name="2<?php echo $count; ?>q3" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row2['q3'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="2<?php echo $count; ?>q3" value="<?php echo $row2['q3']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row2['q4'] == '') { ?>
                                              <select class="selectList" name="2<?php echo $count; ?>q4" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row2['q4'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="2<?php echo $count; ?>q4" value="<?php echo $row2['q4']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row2['q5'] == '') { ?>
                                              <select class="selectList" name="2<?php echo $count; ?>q5" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row2['q5'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="2<?php echo $count; ?>q5" value="<?php echo $row2['q5']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                        </tr>
                                      <?php
                                        $count++;
                                      } ?>
                                    </table>
                                  </div>
                                  <!--SECOND-->
                                </div>
                              </div>
                              <!-- aaaaaaa1 -->
                              <!-- aaaaaaa2 -->
                              <div class="tab-pane fade" align="center" id="aaaaaaa2" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                  <div class="col-md-3"></div>
                                  <div class="col-md-6"><img src="../img/legend.jpg" class="img-fluid"> </div>
                                  <!--THIRD-->
                                  <div class="col-md-6">
                                    <table class="table table-bordered">
                                      <tr>
                                        <th style="color:black;" rowspan="2">LEARNING AREAS</th>
                                        <th style="color:black;" colspan="4">Periodic Rating</th>
                                        <th style="color:black;" rowspan="2">final rating</th>
                                      </tr>
                                      <tr>
                                        <th style="color:black;">1</th>
                                        <th style="color:black;">2</th>
                                        <th style="color:black;">3</th>
                                        <th style="color:black;">4</th>
                                      </tr>
                                      <tr align="center">
                                        <th style="color:black;" colspan="6">LANGUAGE DEVELOPMENT</th>
                                      </tr>
                                      <tr>
                                        <th style="color:black;">LISTENING</th>
                                      </tr>
                                      <?php
                                      include('../connect.php');
                                      $id2 = $_GET['id'];
                                      $sqlget3 = "SELECT * FROM progress_report where lrn = $id2 and progress_index=3 and folder_id =  $folder_id";
                                      $sqldata3 = mysqli_query($conn, $sqlget3) or die('Error Displaying Data' . mysqli_connect_error());
                                      $count = 1;
                                      while ($row13 = mysqli_fetch_assoc($sqldata3)) {
                                        if ($count == 19) {
                                          break;
                                        }
                                      ?>
                                        <tr>
                                          <td style="color:black;"><?php echo $row13['type']; ?> </td><input style="color:black;" type="hidden" name="3<?php echo $count; ?>" value="<?php echo $row13['type']; ?>">
                                          <td style="color:black;">
                                            <?php if ($row13['q1'] == '') { ?>
                                              <select class="selectList" name="3<?php echo $count; ?>q1" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row13['q1'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="3<?php echo $count; ?>q1" value="<?php echo $row13['q1']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row13['q2'] == '') { ?>
                                              <select class="selectList" name="3<?php echo $count; ?>q2" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row13['q2'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="3<?php echo $count; ?>q2" value="<?php echo $row13['q2']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row13['q3'] == '') { ?>
                                              <select class="selectList" name="3<?php echo $count; ?>q3" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row13['q3'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="3<?php echo $count; ?>q3" value="<?php echo $row13['q3']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row13['q4'] == '') { ?>
                                              <select class="selectList" name="3<?php echo $count; ?>q4" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row13['q4'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="3<?php echo $count; ?>q4" value="<?php echo $row13['q4']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row13['q5'] == '') { ?>
                                              <select class="selectList" name="3<?php echo $count; ?>q5" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row13['q5'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="3<?php echo $count; ?>q5" value="<?php echo $row13['q5']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                        </tr>
                                      <?php
                                        $count++;
                                      } ?>
                                    </table>
                                  </div>
                                  <!--THIRD-->
                                  <!--FOURTH-->
                                  <div class="col-md-6">
                                    <table class="table table-bordered">
                                      <tr>
                                        <th style="color:black;" rowspan="2">LEARNING AREAS</th>
                                        <th style="color:black;" colspan="4">Periodic Rating</th>
                                        <th style="color:black;" rowspan="2">final rating</th>
                                      </tr>
                                      <tr>
                                        <th style="color:black;">1</th>
                                        <th style="color:black;">2</th>
                                        <th style="color:black;">3</th>
                                        <th style="color:black;">4</th>
                                      </tr>
                                      <tr align="center">
                                        <th style="color:black;" colspan="6">PYSCHOMOTOR DOMAIN</th>
                                      </tr>
                                      <?php
                                      include('../connect.php');
                                      $id2 = $_GET['id'];
                                      $sqlget4 = "SELECT * FROM progress_report where lrn = $id2 and progress_index=4 and folder_id =  $folder_id";
                                      $sqldata4 = mysqli_query($conn, $sqlget4) or die('Error Displaying Data' . mysqli_connect_error());
                                      $count = 1;
                                      while ($row4 = mysqli_fetch_assoc($sqldata4)) {
                                        if ($count == 24) {
                                          break;
                                        }
                                      ?>
                                        <tr>
                                          <td style="color:black;"><?php echo $row4['type']; ?> </td><input style="color:black;" type="hidden" name="4<?php echo $count; ?>" value="<?php echo $row4['type']; ?>">
                                          <td style="color:black;">
                                            <?php if ($row4['q1'] == '') { ?>
                                              <select class="selectList" name="4<?php echo $count; ?>q1" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row4['q1'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="4<?php echo $count; ?>q1" value="<?php echo $row4['q1']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row4['q2'] == '') { ?>
                                              <select class="selectList" name="4<?php echo $count; ?>q2" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row4['q2'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="4<?php echo $count; ?>q2" value="<?php echo $row4['q2']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row4['q3'] == '') { ?>
                                              <select class="selectList" name="4<?php echo $count; ?>q3" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row4['q3'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="4<?php echo $count; ?>q3" value="<?php echo $row4['q3']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row4['q4'] == '') { ?>
                                              <select class="selectList" name="4<?php echo $count; ?>q4" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row4['q4'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="4<?php echo $count; ?>q4" value="<?php echo $row4['q4']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row4['q5'] == '') { ?>
                                              <select class="selectList" name="4<?php echo $count; ?>q5" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row4['q5'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="4<?php echo $count; ?>q5" value="<?php echo $row4['q5']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                        </tr>
                                      <?php
                                        $count++;
                                      } ?>
                                    </table>
                                  </div>
                                  <!--FOURTH-->
                                </div>
                              </div>
                              <!-- aaaaaaa2 -->
                              <!-- aaaaaaa3 -->
                              <div class="tab-pane fade" align="center" id="aaaaaaa3" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                  <div class="col-md-3"></div>
                                  <div class="col-md-6"><img src="../img/legend.jpg" class="img-fluid"> </div>
                                  <!--FIFTH-->
                                  <div class="col-md-6">
                                    <table class="table table-bordered">
                                      <tr>
                                        <th style="color:black;" rowspan="2">LEARNING AREAS</th>
                                        <th style="color:black;" colspan="4">Periodic Rating</th>
                                        <th style="color:black;" rowspan="2">final rating</th>
                                      </tr>
                                      <tr>
                                        <th style="color:black;">1</th>
                                        <th style="color:black;">2</th>
                                        <th style="color:black;">3</th>
                                        <th style="color:black;">4</th>
                                      </tr>
                                      <tr align="center">
                                        <th style="color:black;" colspan="6">PCOGNITIVE DOMAIN</th>
                                      </tr>
                                      <?php
                                      include('../connect.php');
                                      $id2 = $_GET['id'];
                                      $sqlget5 = "SELECT * FROM progress_report where lrn = $id2 and progress_index=5 and folder_id =  $folder_id";
                                      $sqldata5 = mysqli_query($conn, $sqlget5) or die('Error Displaying Data' . mysqli_connect_error());
                                      $count = 1;
                                      while ($row5 = mysqli_fetch_assoc($sqldata5)) {
                                        if ($count == 24) {
                                          break;
                                        }
                                      ?>
                                        <tr>
                                          <td style="color:black;"><?php echo $row5['type']; ?> <input style="color:black;" type="hidden" name="5<?php echo $count; ?>" value="<?php echo $row5['type']; ?>">
                                          <td style="color:black;">
                                            <?php if ($row5['q1'] == '') { ?>
                                              <select class="selectList" name="5<?php echo $count; ?>q1" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row5['q1'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="5<?php echo $count; ?>q1" value="<?php echo $row5['q1']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row5['q2'] == '') { ?>
                                              <select class="selectList" name="5<?php echo $count; ?>q2" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row5['q2'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="5<?php echo $count; ?>q2" value="<?php echo $row5['q2']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row5['q3'] == '') { ?>
                                              <select class="selectList" name="5<?php echo $count; ?>q3" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row5['q3'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="5<?php echo $count; ?>q3" value="<?php echo $row5['q3']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row5['q4'] == '') { ?>
                                              <select class="selectList" name="5<?php echo $count; ?>q4" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row5['q4'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="5<?php echo $count; ?>q4" value="<?php echo $row5['q4']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row5['q5'] == '') { ?>
                                              <select class="selectList" name="5<?php echo $count; ?>q5" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row5['q5'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="5<?php echo $count; ?>q5" value="<?php echo $row5['q5']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                        </tr>
                                      <?php
                                        $count++;
                                      } ?>
                                    </table>
                                  </div>
                                  <!--FIFTH-->
                                  <!--SIX-->
                                  <div class="col-md-6">
                                    <table class="table table-bordered">
                                      <tr>
                                        <th style="color:black;" rowspan="2">LEARNING AREAS</th>
                                        <th style="color:black;" colspan="4">Periodic Rating</th>
                                        <th style="color:black;" rowspan="2">final rating</th>
                                      </tr>
                                      <tr>
                                        <th style="color:black;">1</th>
                                        <th style="color:black;">2</th>
                                        <th style="color:black;">3</th>
                                        <th style="color:black;">4</th>
                                      </tr>
                                      <tr align="center">
                                        <th style="color:black;" colspan="6">BEHAVIORAL DEVELOPMENT</th>
                                      </tr>
                                      <?php
                                      include('../connect.php');
                                      $id2 = $_GET['id'];
                                      $sqlget6 = "SELECT * FROM progress_report where lrn = $id2 and progress_index=6 and folder_id =  $folder_id";
                                      $sqldata6 = mysqli_query($conn, $sqlget6) or die('Error Displaying Data' . mysqli_connect_error());
                                      $count = 1;
                                      while ($row6 = mysqli_fetch_assoc($sqldata6)) {
                                        if ($count == 24) {
                                          break;
                                        }
                                      ?>
                                        <tr>
                                          <td style="color:black;"><?php echo $row6['type']; ?> </td><input style="color:black;" type="hidden" name="6<?php echo $count; ?>" value="<?php echo $row6['type']; ?>">
                                          <td style="color:black;">
                                            <?php if ($row6['q1'] == '') { ?>
                                              <select class="selectList" name="6<?php echo $count; ?>q1" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row6['q1'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="6<?php echo $count; ?>q1" value="<?php echo $row6['q1']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row6['q2'] == '') { ?>
                                              <select class="selectList" name="6<?php echo $count; ?>q2" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row6['q2'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="6<?php echo $count; ?>q2" value="<?php echo $row6['q2']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row6['q3'] == '') { ?>
                                              <select class="selectList" name="6<?php echo $count; ?>q3" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row6['q3'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="6<?php echo $count; ?>q3" value="<?php echo $row6['q3']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row6['q4'] == '') { ?>
                                              <select class="selectList" name="6<?php echo $count; ?>q4" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row6['q4'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="6<?php echo $count; ?>q4" value="<?php echo $row6['q4']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                          <td style="color:black;">
                                            <?php if ($row6['q5'] == '') { ?>
                                              <select class="selectList" name="6<?php echo $count; ?>q5" id="">
                                                <option value=""><i class="bi bi-caret-down-fill"></i></option>
                                                <option value="P">P</option>
                                                <option value="AP">AP</option>
                                                <option value="D">D</option>
                                                <option value="B">B</option>
                                                <option value="NO/NA">NO/NA</option>
                                              </select>
                                            <?php } else {
                                              echo $row6['q5'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="6<?php echo $count; ?>q5" value="<?php echo $row6['q5']; ?>">
                                            <?php
                                            } ?>
                                          </td>
                                        </tr>
                                      <?php
                                        $count++;
                                      } ?>
                                    </table>
                                  </div>
                                  <!--SIXTH-->
                                </div>
                              </div>
                              <!-- aaaaaaa3 -->
                              <!-- aaaaaaa4 -->
                              <div class="tab-pane fade" align="center" id="aaaaaaa4" role="tabpanel" aria-labelledby="home-tab">
                                <h3 align="center">TEACHERS REMARK</h3>
                                <div class="row">
                                  <!--teacher remarks-->
                                  <div class="col-md-2"></div>
                                  <div class="col-md-8 ">
                                    <table class="table table-bordered">
                                      <tr>
                                        <th style="color:black;">QUARTER</th>
                                        <th style="color:black;">REMARKS</th>
                                      </tr>
                                      <?php
                                      include('../connect.php');
                                      $id2 = $_GET['id'];
                                      $folder_id = $_GET['folder_id'];
                                      $sqlget51 = "SELECT * FROM teachers_remark where lrn = $id2 and folder_id =  $folder_id";
                                      $sqldata51 = mysqli_query($conn, $sqlget51) or die('Error Displaying Data' . mysqli_connect_error());
                                      while ($row51 = mysqli_fetch_assoc($sqldata51)) {
                                      ?>
                                        <input style="color:black;" type="hidden" class="form-control" name="remark_id" value="<?php echo $row51['remark_id']; ?>">
                                        <tr>
                                          <td style="color:black;">1st</td>
                                          <td style="color:black;"> <?php if ($row51['remark_q1'] == '') { ?>
                                              <input style="color:black;" type="text" class="form-control" name="tq1" id="">
                                            <?php } else {
                                                                      echo $row51['remark_q1'];
                                            ?> <input style="color:black;" type="hidden" name="tq1" value="<?php echo $row51['remark_q1']; ?>">
                                            <?php } ?>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;">2nd</td>
                                          <td style="color:black;"><?php if ($row51['remark_q2'] == '') { ?>
                                              <input style="color:black;" class="form-control" type="text" name="tq2" id="">
                                            <?php } else {
                                                                      echo $row51['remark_q2'];
                                            ?><input style="color:black;" type="hidden" name="tq2" value="<?php echo $row51['remark_q2']; ?>">
                                            <?php } ?>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;">3rd</td>
                                          <td style="color:black;"><?php if ($row51['remark_q3'] == '') { ?>
                                              <input style="color:black;" class="form-control" type="text" name="tq3" id="">
                                            <?php } else {
                                                                      echo $row51['remark_q3'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="tq3" value="<?php echo $row51['remark_q3']; ?>">
                                            <?php }
                                            ?>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td style="color:black;">4th</td>
                                          <td style="color:black;"><?php if ($row51['remark_q4'] == '') { ?>
                                              <input style="color:black;" type="text" class="form-control" name="tq4" id="">
                                            <?php } else {
                                                                      echo $row51['remark_q4'];
                                            ?>
                                              <input style="color:black;" type="hidden" name="tq4" value="<?php echo $row51['remark_q4']; ?>">
                                            <?php
                                                                    }
                                            ?>
                                          </td>
                                        </tr>
                                    </table>
                                  <?php } ?>
                                  </div>
                                  <!--teacher remarks-->
                                </div>
                                <!-- aaaaaaa4 -->
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12" align="center">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#aaaaaa1" role="tab" aria-controls="home"
                        aria-selected="true">Daily Living & Socio</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="progress-tab" data-toggle="tab" href="#aaaaaa2" role="tab" aria-controls="progress"
                        aria-selected="false">Language & Psychomotor</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#aaaaaa3" role="tab" aria-controls="profile"
                        aria-selected="false">Cognitive & Behavioral</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#aaaaaa4" role="tab" aria-controls="profile"
                        aria-selected="false">Teachers & Parents Remark</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#attendance1" role="tab" aria-controls="profile"
                        aria-selected="false">Attendance</a>
                    </li>
                  </ul>
                  <div class="tab-content container-fluid" align="center" id="myTabContent">
                    <!--information tab-->
                    <!-- attendace1 -->
                    <div class="tab-pane fade" align="center" id="attendance1" role="tabpanel" aria-labelledby="home-tab">
                      <h3 align="center">Attendance</h3>
                      <div class="row mt-3">
                        <?php
                        include('../connect.php');
                        $id = $_GET['id'];
                        $Jun = "";
                        $Jul = "";
                        $Aug = "";
                        $Sep = "";
                        $Oct = "";
                        $Nov = "";
                        $Dece = "";
                        $Jan = "";
                        $Jan = "";
                        $Feb = "";
                        $Mar = "";
                        $Apr = "";
                        $May = "";
                        $Jun1 = "";
                        $Jul1 = "";
                        $Aug1 = "";
                        $Sep1 = "";
                        $Oct1 = "";
                        $Nov1 = "";
                        $Dece1 = "";
                        $Jan1 = "";
                        $Jan1 = "";
                        $Feb1 = "";
                        $Mar1 = "";
                        $Apr1 = "";
                        $May1 = "";
                        $folder_id = $_GET['folder_id'];
                        $sqlget = "SELECT * FROM attendance where folder_id = $folder_id and  lrn = $id";
                        $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                        while ($row = mysqli_fetch_assoc($sqldata)) {
                          if ($row['type'] == 1) {
                            $Jun = $row['june'];
                            $Jul = $row['july'];
                            $Aug = $row['aug'];
                            $Sep = $row['sept'];
                            $Oct = $row['oct'];
                            $Nov = $row['nov'];
                            $Dece = $row['dece'];
                            $Jan = $row['jan'];
                            $Feb = $row['feb'];
                            $Mar = $row['mar'];
                            $Apr = $row['apr'];
                            $May = $row['may'];
                          }
                          if ($row['type'] == 2) {
                            $Jun1 = $row['june'];
                            $Jul1 = $row['july'];
                            $Aug1 = $row['aug'];
                            $Sep1 = $row['sept'];
                            $Oct1 = $row['oct'];
                            $Nov1 = $row['nov'];
                            $Dece1 = $row['dece'];
                            $Jan1 = $row['jan'];
                            $Feb1 = $row['feb'];
                            $Mar1 = $row['mar'];
                            $Apr1 = $row['apr'];
                            $May1 = $row['may'];
                          }
                        }
                        ?>
                        <table class="table table-bordered">
                          <tr>
                            <th style="color:black;">Attendance</th>
                            <td style="color:black;">Jun</td>
                            <td style="color:black;">Jul</td>
                            <td style="color:black;">Aug</td>
                            <td style="color:black;">Sep</td>
                            <td style="color:black;">Oct</td>
                            <td style="color:black;">Nov</td>
                            <td style="color:black;">Dece</td>
                            <td style="color:black;">Jan</td>
                            <td style="color:black;">Jan</td>
                            <td style="color:black;">Feb</td>
                            <td style="color:black;">Mar</td>
                            <td style="color:black;">Apr</td>
                            <td style="color:black;">May</td>
                          </tr>
                          <tr>
                            <th style="color:black;">No. of School Days</th>
                            <td style="color:black;"><?php echo $Jun; ?></td>
                            <td style="color:black;"><?php echo $Jul; ?></td>
                            <td style="color:black;"><?php echo $Aug; ?></td>
                            <td style="color:black;"><?php echo $Sep; ?></td>
                            <td style="color:black;"><?php echo $Oct; ?></td>
                            <td style="color:black;"><?php echo $Sep; ?></td>
                            <td style="color:black;"><?php echo $Nov; ?></td>
                            <td style="color:black;"><?php echo $Dece; ?></td>
                            <td style="color:black;"><?php echo $Jan; ?></td>
                            <td style="color:black;"><?php echo $Feb; ?></td>
                            <td style="color:black;"><?php echo $Mar; ?></td>
                            <td style="color:black;"><?php echo $Apr; ?></td>
                            <td style="color:black;"><?php echo $May; ?></td>
                          </tr>
                          <tr>
                            <th style="color:black;">No. of School Days Present</th>
                            <td style="color:black;"><?php echo $Jun1; ?></td>
                            <td style="color:black;"><?php echo $Jul1; ?></td>
                            <td style="color:black;"><?php echo $Aug1; ?></td>
                            <td style="color:black;"><?php echo $Sep1; ?></td>
                            <td style="color:black;"><?php echo $Oct1; ?></td>
                            <td style="color:black;"><?php echo $Sep1; ?></td>
                            <td style="color:black;"><?php echo $Nov1; ?></td>
                            <td style="color:black;"><?php echo $Dece1; ?></td>
                            <td style="color:black;"><?php echo $Jan1; ?></td>
                            <td style="color:black;"><?php echo $Feb1; ?></td>
                            <td style="color:black;"><?php echo $Mar1; ?></td>
                            <td style="color:black;"><?php echo $Apr1; ?></td>
                            <td style="color:black;"><?php echo $May1; ?></td>
                          </tr>
                          <tr>
                            <th style="color:black;">No. of School Days Absent</th>
                            <td style="color:black;"><?php echo $Jun - $Jun1; ?></td>
                            <td style="color:black;"><?php echo $Jul - $Jul1; ?></td>
                            <td style="color:black;"><?php echo $Aug - $Aug1; ?></td>
                            <td style="color:black;"><?php echo $Sep - $Sep1; ?></td>
                            <td style="color:black;"><?php echo $Oct - $Oct1; ?></td>
                            <td style="color:black;"><?php echo $Sep - $Sep1; ?></td>
                            <td style="color:black;"><?php echo $Nov - $Nov1; ?></td>
                            <td style="color:black;"><?php echo $Dece - $Dece1; ?></td>
                            <td style="color:black;"><?php echo $Jan - $Jan1; ?></td>
                            <td style="color:black;"><?php echo $Feb - $Feb1; ?></td>
                            <td style="color:black;"><?php echo $Mar - $Mar; ?></td>
                            <td style="color:black;"><?php echo $Apr - $Apr1; ?></td>
                            <td style="color:black;"><?php echo $May - $May; ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <!-- attendance -->
                    <!-- aaaaaa1 -->
                    <div class="tab-pane fade show active" align="center" id="aaaaaa1" role="tabpanel" aria-labelledby="home-tab">
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6"><img src="../img/legend.jpg" class="img-fluid"> </div>
                        <!--first-->
                        <div class="col-md-6">
                          <table class="table table-bordered">
                            <tr>
                              <th style="color:black;" rowspan="2">LEARNING AREAS</th>
                              <th style="color:black;" colspan="4">Periodic Rating</th>
                              <th style="color:black;" rowspan="2">final rating</th>
                            </tr>
                            <tr>
                              <th style="color:black;">1</th>
                              <th style="color:black;">2</th>
                              <th style="color:black;">3</th>
                              <th style="color:black;">4</th>
                            </tr>
                            <tr align="center">
                              <th style="color:black;" colspan="6">Daily Living Skill Domain</th>
                            </tr>
                            <tr>
                              <th style="color:black;" colspan="6">Self feeding</th>
                            </tr>
                            <?php
                            include('../connect.php');
                            $id = $_GET['id'];
                            $sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=1 and folder_id =  $folder_id";
                            $sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data' . mysqli_connect_error());
                            $count = 1;
                            while ($row1 = mysqli_fetch_assoc($sqldata)) {
                              if ($count == 26) {
                                break;
                              }
                            ?>
                              <tr>
                                <td style="color:black;"><?php echo $row1['type']; ?> </td><input style="color:black;" type="hidden" name="1<?php echo $count; ?>" value="<?php echo $row1['type']; ?>">
                                <td style="color:black;">
                                  <?php if ($row1['q1'] == '') { ?>
                                  <?php } else {
                                    echo $row1['q1'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="1<?php echo $count; ?>q1" value="<?php echo $row1['q1']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row1['q2'] == '') { ?>
                                  <?php } else {
                                    echo $row1['q2'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="1<?php echo $count; ?>q2" value="<?php echo $row1['q2']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row1['q3'] == '') { ?>
                                  <?php } else {
                                    echo $row1['q3'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="1<?php echo $count; ?>q3" value="<?php echo $row1['q3']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row1['q4'] == '') { ?>
                                  <?php } else {
                                    echo $row1['q4'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="1<?php echo $count; ?>q4" value="<?php echo $row1['q4']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row1['q5'] == '') { ?>
                                  <?php } else {
                                    echo $row1['q5'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="1<?php echo $count; ?>q5" value="<?php echo $row1['q5']; ?>">
                                  <?php
                                  } ?>
                                </td>
                              </tr>
                            <?php
                              $count++;
                            } ?>
                          </table>
                        </div>
                        <!--first-->
                        <!--SECOND-->
                        <div class="col-md-6">
                          <table class="table table-bordered">
                            <tr>
                              <th style="color:black;" rowspan="2">LEARNING AREAS</th>
                              <th style="color:black;" colspan="4">Periodic Rating</th>
                              <th style="color:black;" rowspan="2">final rating</th>
                            </tr>
                            <tr>
                              <th style="color:black;">1</th>
                              <th style="color:black;">2</th>
                              <th style="color:black;">3</th>
                              <th style="color:black;">4</th>
                            </tr>
                            <tr align="center">
                              <th style="color:black;" colspan="6">SOCIO-EMOTIONAL DOMAIN</th>
                            </tr>
                            <?php
                            include('../connect.php');
                            $id2 = $_GET['id'];
                            $sqlget2 = "SELECT * FROM progress_report where lrn = $id2 and progress_index=2 and folder_id =  $folder_id";
                            $sqldata2 = mysqli_query($conn, $sqlget2) or die('Error Displaying Data' . mysqli_connect_error());
                            $count = 1;
                            while ($row2 = mysqli_fetch_assoc($sqldata2)) {
                              if ($count == 21) {
                                break;
                              }
                            ?>
                              <tr>
                                <td style="color:black;"><?php echo $row2['type']; ?> </td><input style="color:black;" type="hidden" name="2<?php echo $count; ?>" value="<?php echo $row2['type']; ?>">
                                <td style="color:black;">
                                  <?php if ($row2['q1'] == '') { ?>
                                  <?php } else {
                                    echo $row2['q1'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="2<?php echo $count; ?>q1" value="<?php echo $row2['q1']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row2['q2'] == '') { ?>
                                  <?php } else {
                                    echo $row2['q2'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="2<?php echo $count; ?>q2" value="<?php echo $row2['q2']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row2['q3'] == '') { ?>
                                  <?php } else {
                                    echo $row2['q3'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="2<?php echo $count; ?>q3" value="<?php echo $row2['q3']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row2['q4'] == '') { ?>
                                  <?php } else {
                                    echo $row2['q4'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="2<?php echo $count; ?>q4" value="<?php echo $row2['q4']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row2['q5'] == '') { ?>
                                  <?php } else {
                                    echo $row2['q5'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="2<?php echo $count; ?>q5" value="<?php echo $row2['q5']; ?>">
                                  <?php
                                  } ?>
                                </td>
                              </tr>
                            <?php
                              $count++;
                            } ?>
                          </table>
                        </div>
                        <!--SECOND-->
                      </div>
                    </div>
                    <!-- aaaaaa1 -->
                    <!-- aaaaaa2 -->
                    <div class="tab-pane fade" align="center" id="aaaaaa2" role="tabpanel" aria-labelledby="home-tab">
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6"><img src="../img/legend.jpg" class="img-fluid"> </div>
                        <!--THIRD-->
                        <div class="col-md-6">
                          <table class="table table-bordered">
                            <tr>
                              <th style="color:black;" rowspan="2">LEARNING AREAS</th>
                              <th style="color:black;" colspan="4">Periodic Rating</th>
                              <th style="color:black;" rowspan="2">final rating</th>
                            </tr>
                            <tr>
                              <th style="color:black;">1</th>
                              <th style="color:black;">2</th>
                              <th style="color:black;">3</th>
                              <th style="color:black;">4</th>
                            </tr>
                            <tr align="center">
                              <th style="color:black;" colspan="6">LANGUAGE DEVELOPMENT</th>
                            </tr>
                            <tr>
                              <th style="color:black;">LISTENING</th>
                            </tr>
                            <?php
                            include('../connect.php');
                            $id2 = $_GET['id'];
                            $sqlget3 = "SELECT * FROM progress_report where lrn = $id2 and progress_index=3 and folder_id =  $folder_id";
                            $sqldata3 = mysqli_query($conn, $sqlget3) or die('Error Displaying Data' . mysqli_connect_error());
                            $count = 1;
                            while ($row13 = mysqli_fetch_assoc($sqldata3)) {
                              if ($count == 19) {
                                break;
                              }
                            ?>
                              <tr>
                                <td style="color:black;"><?php echo $row13['type']; ?> </td><input style="color:black;" type="hidden" name="3<?php echo $count; ?>" value="<?php echo $row13['type']; ?>">
                                <td style="color:black;">
                                  <?php if ($row13['q1'] == '') { ?>
                                  <?php } else {
                                    echo $row13['q1'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="3<?php echo $count; ?>q1" value="<?php echo $row13['q1']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row13['q2'] == '') { ?>
                                  <?php } else {
                                    echo $row13['q2'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="3<?php echo $count; ?>q2" value="<?php echo $row13['q2']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row13['q3'] == '') { ?>
                                  <?php } else {
                                    echo $row13['q3'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="3<?php echo $count; ?>q3" value="<?php echo $row13['q3']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row13['q4'] == '') { ?>
                                  <?php } else {
                                    echo $row13['q4'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="3<?php echo $count; ?>q4" value="<?php echo $row13['q4']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row13['q5'] == '') { ?>
                                  <?php } else {
                                    echo $row13['q5'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="3<?php echo $count; ?>q5" value="<?php echo $row13['q5']; ?>">
                                  <?php
                                  } ?>
                                </td>
                              </tr>
                            <?php
                              $count++;
                            } ?>
                          </table>
                        </div>
                        <!--THIRD-->
                        <!--FOURTH-->
                        <div class="col-md-6">
                          <table class="table table-bordered">
                            <tr>
                              <th style="color:black;" rowspan="2">LEARNING AREAS</th>
                              <th style="color:black;" colspan="4">Periodic Rating</th>
                              <th style="color:black;" rowspan="2">final rating</th>
                            </tr>
                            <tr>
                              <th style="color:black;">1</th>
                              <th style="color:black;">2</th>
                              <th style="color:black;">3</th>
                              <th style="color:black;">4</th>
                            </tr>
                            <tr align="center">
                              <th style="color:black;" colspan="6">PYSCHOMOTOR DOMAIN</th>
                            </tr>
                            <?php
                            include('../connect.php');
                            $id2 = $_GET['id'];
                            $sqlget4 = "SELECT * FROM progress_report where lrn = $id2 and progress_index=4 and folder_id =  $folder_id";
                            $sqldata4 = mysqli_query($conn, $sqlget4) or die('Error Displaying Data' . mysqli_connect_error());
                            $count = 1;
                            while ($row4 = mysqli_fetch_assoc($sqldata4)) {
                              if ($count == 24) {
                                break;
                              }
                            ?>
                              <tr>
                                <td style="color:black;"><?php echo $row4['type']; ?> </td><input style="color:black;" type="hidden" name="4<?php echo $count; ?>" value="<?php echo $row4['type']; ?>">
                                <td style="color:black;">
                                  <?php if ($row4['q1'] == '') { ?>
                                  <?php } else {
                                    echo $row4['q1'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="4<?php echo $count; ?>q1" value="<?php echo $row4['q1']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row4['q2'] == '') { ?>
                                  <?php } else {
                                    echo $row4['q2'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="4<?php echo $count; ?>q2" value="<?php echo $row4['q2']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row4['q3'] == '') { ?>
                                  <?php } else {
                                    echo $row4['q3'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="4<?php echo $count; ?>q3" value="<?php echo $row4['q3']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row4['q4'] == '') { ?>
                                  <?php } else {
                                    echo $row4['q4'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="4<?php echo $count; ?>q4" value="<?php echo $row4['q4']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row4['q5'] == '') { ?>
                                  <?php } else {
                                    echo $row4['q5'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="4<?php echo $count; ?>q5" value="<?php echo $row4['q5']; ?>">
                                  <?php
                                  } ?>
                                </td>
                              </tr>
                            <?php
                              $count++;
                            } ?>
                          </table>
                        </div>
                        <!--FOURTH-->
                      </div>
                    </div>
                    <!-- aaaaaa2 -->
                    <!-- aaaaaa3 -->
                    <div class="tab-pane fade" align="center" id="aaaaaa3" role="tabpanel" aria-labelledby="home-tab">
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6"><img src="../img/legend.jpg" class="img-fluid"> </div>
                        <!--FIFTH-->
                        <div class="col-md-6">
                          <table class="table table-bordered">
                            <tr>
                              <th style="color:black;" rowspan="2">LEARNING AREAS</th>
                              <th style="color:black;" colspan="4">Periodic Rating</th>
                              <th style="color:black;" rowspan="2">final rating</th>
                            </tr>
                            <tr>
                              <th style="color:black;">1</th>
                              <th style="color:black;">2</th>
                              <th style="color:black;">3</th>
                              <th style="color:black;">4</th>
                            </tr>
                            <tr align="center">
                              <th style="color:black;" colspan="6">PCOGNITIVE DOMAIN</th>
                            </tr>
                            <?php
                            include('../connect.php');
                            $id2 = $_GET['id'];
                            $sqlget5 = "SELECT * FROM progress_report where lrn = $id2 and progress_index=5 and folder_id =  $folder_id";
                            $sqldata5 = mysqli_query($conn, $sqlget5) or die('Error Displaying Data' . mysqli_connect_error());
                            $count = 1;
                            while ($row5 = mysqli_fetch_assoc($sqldata5)) {
                              if ($count == 24) {
                                break;
                              }
                            ?>
                              <tr>
                                <td style="color:black;"><?php echo $row5['type']; ?> <input style="color:black;" type="hidden" name="5<?php echo $count; ?>" value="<?php echo $row5['type']; ?>">
                                <td style="color:black;">
                                  <?php if ($row5['q1'] == '') { ?>
                                  <?php } else {
                                    echo $row5['q1'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="5<?php echo $count; ?>q1" value="<?php echo $row5['q1']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row5['q2'] == '') { ?>
                                  <?php } else {
                                    echo $row5['q2'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="5<?php echo $count; ?>q2" value="<?php echo $row5['q2']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row5['q3'] == '') { ?>
                                  <?php } else {
                                    echo $row5['q3'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="5<?php echo $count; ?>q3" value="<?php echo $row5['q3']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row5['q4'] == '') { ?>
                                  <?php } else {
                                    echo $row5['q4'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="5<?php echo $count; ?>q4" value="<?php echo $row5['q4']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row5['q5'] == '') { ?>
                                  <?php } else {
                                    echo $row5['q5'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="5<?php echo $count; ?>q5" value="<?php echo $row5['q5']; ?>">
                                  <?php
                                  } ?>
                                </td>
                              </tr>
                            <?php
                              $count++;
                            } ?>
                          </table>
                        </div>
                        <!--FIFTH-->
                        <!--SIX-->
                        <div class="col-md-6">
                          <table class="table table-bordered">
                            <tr>
                              <th style="color:black;" rowspan="2">LEARNING AREAS</th>
                              <th style="color:black;" colspan="4">Periodic Rating</th>
                              <th style="color:black;" rowspan="2">final rating</th>
                            </tr>
                            <tr>
                              <th style="color:black;">1</th>
                              <th style="color:black;">2</th>
                              <th style="color:black;">3</th>
                              <th style="color:black;">4</th>
                            </tr>
                            <tr align="center">
                              <th style="color:black;" colspan="6">BEHAVIORAL DEVELOPMENT</th>
                            </tr>
                            <?php
                            include('../connect.php');
                            $id2 = $_GET['id'];
                            $sqlget6 = "SELECT * FROM progress_report where lrn = $id2 and progress_index=6 and folder_id =  $folder_id";
                            $sqldata6 = mysqli_query($conn, $sqlget6) or die('Error Displaying Data' . mysqli_connect_error());
                            $count = 1;
                            while ($row6 = mysqli_fetch_assoc($sqldata6)) {
                              if ($count == 24) {
                                break;
                              }
                            ?>
                              <tr>
                                <td style="color:black;"><?php echo $row6['type']; ?> </td><input style="color:black;" type="hidden" name="6<?php echo $count; ?>" value="<?php echo $row6['type']; ?>">
                                <td style="color:black;">
                                  <?php if ($row6['q1'] == '') { ?>
                                  <?php } else {
                                    echo $row6['q1'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="6<?php echo $count; ?>q1" value="<?php echo $row6['q1']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row6['q2'] == '') { ?>
                                  <?php } else {
                                    echo $row6['q2'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="6<?php echo $count; ?>q2" value="<?php echo $row6['q2']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row6['q3'] == '') { ?>
                                  <?php } else {
                                    echo $row6['q3'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="6<?php echo $count; ?>q3" value="<?php echo $row6['q3']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row6['q4'] == '') { ?>
                                  <?php } else {
                                    echo $row6['q4'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="6<?php echo $count; ?>q4" value="<?php echo $row6['q4']; ?>">
                                  <?php
                                  } ?>
                                </td>
                                <td style="color:black;">
                                  <?php if ($row6['q5'] == '') { ?>
                                  <?php } else {
                                    echo $row6['q5'];
                                  ?>
                                    <input style="color:black;" type="hidden" name="6<?php echo $count; ?>q5" value="<?php echo $row6['q5']; ?>">
                                  <?php
                                  } ?>
                                </td>
                              </tr>
                            <?php
                              $count++;
                            } ?>
                          </table>
                        </div>
                        <!--SIXTH-->
                      </div>
                    </div>
                    <!-- aaaaaa3 -->
                    <!-- aaaaaa4 -->
                    <div class="tab-pane fade" align="center" id="aaaaaa4" role="tabpanel" aria-labelledby="home-tab">
                      <h3>Teachers and Parents Remark</h3>
                      <div class="row">
                        <div class="col-md-6">
                          <table class="table" style="text-align:center;">
                            <tr>
                              <th style="color:black;">QUARTER</th>
                              <th style="color:black;">REMARKS</th>
                            </tr>
                            <?php
                            $id123 = $_GET['id'];
                            $sqlget123 = "SELECT * FROM teachers_remark where lrn = $id123 and folder_id =  $folder_id";
                            $sqldata123 = mysqli_query($conn, $sqlget123) or die('Error Displaying Data' . mysqli_connect_error());
                            while ($row123 = mysqli_fetch_assoc($sqldata123)) {
                            ?>
                              <input style="color:black;" type="hidden" name="remark_id" value="<?php echo $row123['remark_id']; ?>">
                              <tr>
                                <td style="color:black;">1st</td>
                                <td style="color:black;"><?php echo $row123['remark_q1']; ?></td>
                              </tr>
                              <tr>
                                <td style="color:black;">2nd</td>
                                <td style="color:black;"><?php echo $row123['remark_q2']; ?></td>
                              </tr>
                              <tr>
                                <td style="color:black;">3rd</td>
                                <td style="color:black;"><?php echo $row123['remark_q3']; ?></td>
                              </tr>
                              <tr>
                                <td style="color:black;">4th</td>
                                <td style="color:black;"><?php echo $row123['remark_q4']; ?></td>
                              </tr>
                            <?php } ?>
                          </table>
                        </div>
                        <div class="col-md-6">
                          <table class="table" style="text-align:center;">
                            <tr>
                              <th style="color:black;">Date</th>
                              <th style="color:black;">Parent Observation</th>
                            </tr>
                            <?php
                            $id123 = $_GET['id'];
                            $sqlgetobs = "SELECT * FROM parent_observation where lrn = $id123 ";
                            $sqldataobs = mysqli_query($conn, $sqlgetobs) or die('Error Displaying Data' . mysqli_connect_error());
                            while ($rowobs = mysqli_fetch_assoc($sqldataobs)) {
                            ?>
                              <tr>
                                <td style="color:black;"><?php echo $rowobs['date']; ?></td>
                                <td style="color:black;"><?php echo $rowobs['observation'];  ?></td>
                              </tr>
                            <?php } ?>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- aaaaaa4 -->
                </div>
              </div>
            </div>
          </div>
          <!--Assessment tab-->
          <!--Assessent tab-->
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h3 class="mt-3" style="color:black; font-weight:bold;">Student File</h3>
            <div class="container">
              <div class="row">
                <!-- Button trigger modal -->
                <div class="col-md-12"></div>
                <!-- Modal -->
                <div class="modal fade" id="a111" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Upload Student File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="upload_file.php?id=<?php echo $_GET['id']; ?>&folder_id=<?php echo $_GET['folder_id']; ?>" method="POST" enctype="multipart/form-data">
                          <table class="table p-3">
                            <tr>
                              <th style="color:black;">File type</th>
                              <th style="color:black;">Year</th>
                              <th style="color:black;">Description</th>
                              <th style="color:black;">Action</th>
                            </tr>
                            <tr>
                              <td style="color:black;">INDIVIDUALIZED EDUCATION PLAN</td><input style="color:black;" type="hidden" value="INDIVIDUALIZED EDUCATION PLAN" name="type1"></td>
                              <td style="color:black;"><input style="color:black;" type="number" class="form-control" name="year1" max="2030" min="2010"></td>
                              <td style="color:black;"><input style="color:black;" type="text" name="des1" class="form-control"></td>
                              <td style="color:black;">
                                <input style="color:black;" id="uploadPDF11" onchange="showname11()" type="file" name="fileToUpload1" />
                              </td>
                            </tr>
                            <tr>
                              <td style="color:black;">INDIVIDUAL LEARNERS PLAN</td><input style="color:black;" type="hidden" value="INDIVIDUAL LEARNERS PLAN" name="type2"></td>
                              <td style="color:black;"><input style="color:black;" type="number" class="form-control" name="year2" max="2030" min="2010"></td>
                              <td style="color:black;"><input style="color:black;" type="text" name="des2" class="form-control"></td>
                              <td style="color:black;">
                                <input style="color:black;" id="uploadPDF22" onchange="showname22()" type="file" name="fileToUpload2" />
                              </td>
                            </tr>
                            <tr>
                              <td style="color:black;">INDIVIDUAL LEARNING MONITORING PLAN</td><input style="color:black;" type="hidden" value="INDIVIDUAL LEARNING MONITORING PLAN" name="type3"></td>
                              <td style="color:black;"><input style="color:black;" type="number" class="form-control" name="year3" max="2030" min="2010"></td>
                              <td style="color:black;"><input style="color:black;" type="text" name="des3" class="form-control"></td>
                              <td style="color:black;">
                                <input style="color:black;" id="uploadPDF33" onchange="showname33()" type="file" name="fileToUpload3" />
                              </td>
                            </tr>
                            <tr>
                              <td style="color:black;">BEHAVIOR INTERVENTION REPORT</td><input style="color:black;" type="hidden" value="BEHAVIOR INTERVENTION REPORT" name="type4"></td>
                              <td style="color:black;"><input style="color:black;" type="number" class="form-control" name="year4" max="2030" min="2010"></td>
                              <td style="color:black;"><input style="color:black;" type="text" name="des4" class="form-control"></td>
                              <td style="color:black;">
                                <input style="color:black;" id="uploadPDF44" onchange="showname44()" type="file" name="fileToUpload4" />
                              </td>
                            </tr>
                            <tr>
                              <td style="color:black;" colspan="3"></td>
                            </tr>
                          </table>
                      </div>
                      <div class="modal-footer">
                        <input style="color:black;" type="submit" value="Upload" class="btn btn-primary float-right" name="submit">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                include('../connect.php');
                $id2 = $_GET['id'];
                $sqlget7 = "SELECT * FROM student_files where lrn = $id2 and status != 'archive' ";
                $sqldata7 = mysqli_query($conn, $sqlget7) or die('Error Displaying Data' . mysqli_connect_error());
                while ($row7 = mysqli_fetch_assoc($sqldata7)) {
                ?>
                  <div class="col-md-3" align="center" style="position: relative; ">
                    <p style="color:black;"><?php echo $row7['file_type']; ?></p>
                    <img class="img-fluid" src="../img/pdf.png" width="100" alt="" style="display: block;" data-toggle="tooltip" data-placement="left" title="<?php echo $row7['description'] . '-' . $row7['date']; ?>">
                    <a type="button" data-toggle="modal" data-target="#e<?php echo $row7['student_files']; ?>"><i class='fas fa-archive' style='color:red; position: absolute; margin-left:-20px; margin-top: -42px;'></i></a> <a href="../ilp/<?php echo $row7['file_name'] ?>" target="_blank"><i class='fas fa-eye' style='color:green; position: absolute; margin-left:10px; margin-top: -25px;'></i></a>
                    <!-- Button trigger modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="e<?php echo $row7['student_files']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Are you sure you want to Archive this File</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body" align="right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                            <a href="delete_file.php?id=<?php echo $row7['student_files']; ?>&folder_id=<?php echo $_GET['folder_id']; ?>&lrn=<?php echo $_GET['id']; ?> " class="btn btn-danger">YES</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <!--Assessment tab-->
        </div>
        <!--tab content -->
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
  </div>
  <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    function showname11() {
      var name = document.getElementById('uploadPDF11');
      const input = document.getElementById('uploadPDF11');
      let text = (name.files.item(0).name);
      var arr2 = [<?php
                  include('../connect.php');
                  $count = 1;
                  $school = $_SESSION['school'];
                  $teacher = $_SESSION['teacher_id'];
                  $sqlget1 = "SELECT * FROM student_files";
                  $sqldata1 = mysqli_query($conn, $sqlget1) or die('Error Displaying Data' . mysqli_connect_error());
                  while ($row3 = mysqli_fetch_assoc($sqldata1)) {
                    if ($count == 1) {
                      echo '"' . $row3['doc'] . '"';
                    } else if ($count > 1) {
                      echo ',"' . $row3['doc'] . '"';
                    }
                    $count++;
                  }
                  ?>];
      if (arr2.indexOf(text) !== -1) {
        swal('File Already Exist', 'File already exist in the system', 'warning');
        input.value = "";
        return false;
      }
    };
  </script>
  <script>
    function showname22() {
      var name = document.getElementById('uploadPDF22');
      const input = document.getElementById('uploadPDF22');
      let text = (name.files.item(0).name);
      var arr2 = [<?php
                  include('../connect.php');
                  $count = 1;
                  $school = $_SESSION['school'];
                  $teacher = $_SESSION['teacher_id'];
                  $sqlget1 = "SELECT * FROM student_files";
                  $sqldata1 = mysqli_query($conn, $sqlget1) or die('Error Displaying Data' . mysqli_connect_error());
                  while ($row3 = mysqli_fetch_assoc($sqldata1)) {
                    if ($count == 1) {
                      echo '"' . $row3['doc'] . '"';
                    } else if ($count > 1) {
                      echo ',"' . $row3['doc'] . '"';
                    }
                    $count++;
                  }
                  ?>];
      if (arr2.indexOf(text) !== -1) {
        swal('File Already Exist', 'File already exist in the system', 'warning');
        input.value = "";
        return false;
      }
    };
  </script>
  <script>
    function showname33() {
      var name = document.getElementById('uploadPDF33');
      const input = document.getElementById('uploadPDF33');
      let text = (name.files.item(0).name);
      var arr2 = [<?php
                  include('../connect.php');
                  $count = 1;
                  $school = $_SESSION['school'];
                  $teacher = $_SESSION['teacher_id'];
                  $sqlget1 = "SELECT * FROM student_files";
                  $sqldata1 = mysqli_query($conn, $sqlget1) or die('Error Displaying Data' . mysqli_connect_error());
                  while ($row3 = mysqli_fetch_assoc($sqldata1)) {
                    if ($count == 1) {
                      echo '"' . $row3['doc'] . '"';
                    } else if ($count > 1) {
                      echo ',"' . $row3['doc'] . '"';
                    }
                    $count++;
                  }
                  ?>];
      if (arr2.indexOf(text) !== -1) {
        swal('LRN Already Exist', 'File already exist in the system', 'warning');
        input.value = "";
        return false;
      }
    };
  </script>
  <script>
    function showname44() {
      var name = document.getElementById('uploadPDF44');
      const input = document.getElementById('uploadPDF44');
      let text = (name.files.item(0).name);
      var arr2 = [<?php
                  include('../connect.php');
                  $count = 1;
                  $school = $_SESSION['school'];
                  $teacher = $_SESSION['teacher_id'];
                  $sqlget1 = "SELECT * FROM student_files";
                  $sqldata1 = mysqli_query($conn, $sqlget1) or die('Error Displaying Data' . mysqli_connect_error());
                  while ($row3 = mysqli_fetch_assoc($sqldata1)) {
                    if ($count == 1) {
                      echo '"' . $row3['doc'] . '"';
                    } else if ($count > 1) {
                      echo ',"' . $row3['doc'] . '"';
                    }
                    $count++;
                  }
                  ?>];
      if (arr2.indexOf(text) !== -1) {
        swal('File Already Exist', 'File already exist in the system', 'warning');
        input.value = "";
        return false;
      }
    };
  </script>
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>
  <script>
    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <?php
  if (isset($_GET['delete'])) {
    echo "<script>swal('File has been deleted', 'The selected file has been deleted and moved to the student archive files', 'info');</script>";
  }
  ?>
  <?php
  if (isset($_GET['updateIEP'])) {
    echo "<script>swal('IEP has Been Updated', 'The IEP file successfully updated', 'success');</script>";
  }
  ?>
  <?php
  if (isset($_GET['ilp'])) {
    echo "<script>swal('Add ILMP Successful', 'ILMP successfully added to student', 'success');</script>";
  }
  ?>
  <?php
  if (isset($_GET['ilmpupdate'])) {
    echo "<script>swal('ILMP has Been Updated', 'The ILMP file successfully updated', 'success');</script>";
  }
  ?>
  <?php
  if (isset($_GET['addilp'])) {
    echo "<script>swal('Add ILP Successful', 'ILP successfully added to student', 'success');</script>";
  }
  ?>
  <?php
  if (isset($_GET['upload1'])) {
    echo "<script>swal('Upload File Successful', 'Upload file successfully added to student file', 'success');</script>";
  }
  ?>
</body>
</html>