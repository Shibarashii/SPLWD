<?php include('../session.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<?php include('nav.php');?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <div class="col-md-4" align="left">
          <?php

include('../connect.php');
$id = $_GET['id'];
$folder_id = $_GET['folder_id'];
$sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
$sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data'. mysqli_connect_error());
$count=0;
while ($row1 = mysqli_fetch_assoc($sqldata)) {
            $count++;
            $a= "<p>".$count.". ".$row1['type']."</p>";
            echo $a;
                if($count==10){ break; } 
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
$sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data'. mysqli_connect_error());
$count=0;
while ($row1 = mysqli_fetch_assoc($sqldata)) {
                    $count++;  
                    if($count>=11){
                                $a= "<p>".$count.". ".$row1['type']."</p>";
                                echo $a;          
                    }
                    if($count==25){
                    break;
                    } 

                
                    }
?>
          </div>
          <div class="col-md-8">  <canvas id="lineChart4"></canvas></div>
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
$sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data'. mysqli_connect_error());
$count=1;
while ($row1 = mysqli_fetch_assoc($sqldata)) {

        if($count==1){ $a= "'".$count."'"; $count++; echo $a;}
        else{ echo ",'".$count."'"; $count++; }

    if($count==11){ break; } }
?>],
    datasets: [{
      
      label: "Quarter 1",
      data: [<?php

include('../connect.php');
$id = $_GET['id'];
$sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
$sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data'. mysqli_connect_error());
$count=1;
while ($row1 = mysqli_fetch_assoc($sqldata)) {

  if($count==1){
            if($row1['q1']=='P'){ echo 4;  }
            if($row1['q1']=='AP'){ echo 3;  }
            if($row1['q1']=='D'){ echo 2; }
            if($row1['q1']=='B'){ echo 1;  }
        }
        else {
            if($row1['q1']=='P'){ $n=4; echo ",".$n; }
            if($row1['q1']=='AP'){ $n=3; echo ",".$n; }
            if($row1['q1']=='D'){ $n=2; echo ",".$n; }
            if($row1['q1']=='B'){ $n=1; echo ",".$n; } 
        }
        $count++;
    if($count==11){ break; } 
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
$sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data'. mysqli_connect_error());
$count=1;
while ($row1 = mysqli_fetch_assoc($sqldata)) {

  if($count==1){
            if($row1['q2']=='P'){ echo 4; }
            if($row1['q2']=='AP'){ echo 3;  }
            if($row1['q2']=='D'){ echo 2;  }
            if($row1['q2']=='B'){ echo 1;  }
        }
        else {
            if($row1['q2']=='P'){ $n=4; echo ",".$n; }
            if($row1['q2']=='AP'){ $n=3; echo ",".$n; }
            if($row1['q2']=='D'){ $n=2; echo ",".$n; }
            if($row1['q2']=='B'){ $n=1; echo ",".$n; } 
        }
        $count++;
    if($count==11){ break; } 
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
$sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data'. mysqli_connect_error());
$count=1;
while ($row1 = mysqli_fetch_assoc($sqldata)) {

  if($count==1){
            if($row1['q3']=='P'){ echo 4;  }
            if($row1['q3']=='AP'){ echo 3;  }
            if($row1['q3']=='D'){ echo 2; }
            if($row1['q3']=='B'){ echo 1; ; }
        }
        else {
            if($row1['q3']=='P'){ $n=4; echo ",".$n; }
            if($row1['q3']=='AP'){ $n=3; echo ",".$n; }
            if($row1['q3']=='D'){ $n=2; echo ",".$n; }
            if($row1['q3']=='B'){ $n=1; echo ",".$n; } 
        }
        $count++;
    if($count==11){ break; } 
    }
?>],
      backgroundColor: [ '#FF7000',],
      borderColor: [ 'white',],
      borderWidth: 2
    },
    {
      label: "QUARTER 4",
      data: [<?php

include('../connect.php');
$id = $_GET['id'];
$sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
$sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data'. mysqli_connect_error());
$count=1;
while ($row1 = mysqli_fetch_assoc($sqldata)) {

   


        if($count==1){
            if($row1['q4']=='P'){ echo 4; }
            if($row1['q4']=='AP'){ echo 3;  }
            if($row1['q4']=='D'){ echo 2; }
            if($row1['q4']=='B'){ echo 4; }
        }
        else {
            if($row1['q4']=='P'){ $n=4; echo ",".$n;  }
            if($row1['q4']=='AP'){ $n=3; echo ",".$n;  }
            if($row1['q4']=='D'){ $n=2; echo ",".$n;  }
            if($row1['q4']=='B'){ $n=1; echo ",".$n;  }
        }

        $count++;

    if($count==11){ break; } 
    }
?>],
      backgroundColor: [ '#FFBF00',],
      borderColor: ['white',],
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
$sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data'. mysqli_connect_error());
$count=0;
while ($row1 = mysqli_fetch_assoc($sqldata)) {
  $count++;
        if($count==11){ $a= "'".$count."'"; echo $a;}
        else if($count>11){ echo ",'".$count."'";}
   
       
        
}
?>],
    datasets: [{
      label: "Quarter 1",
      data: [<?php

include('../connect.php');
$id = $_GET['id'];
$sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
$sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data'. mysqli_connect_error());
$count=1;
while ($row1 = mysqli_fetch_assoc($sqldata)) {



        if($count==11){
            if($row1['q1']=='P'){ echo 4;  }
            if($row1['q1']=='AP'){ echo 3; }
            if($row1['q1']=='D'){ echo 2; }
            if($row1['q1']=='B'){ echo 1; }
                     }
        else if($count>11){
            if($row1['q1']=='P'){ $n=4; echo ",".$n; }
            if($row1['q1']=='AP'){ $n=3; echo ",".$n; }
            if($row1['q1']=='D'){ $n=2; echo ",".$n; }
            if($row1['q1']=='B'){ $n=1; echo ",".$n; }
                         } 
                         $count++;
        if($count==26){ break; } 
    }
?>],
      backgroundColor: [ '#10A19D',],
      borderColor: ['white',],
      borderWidth: 2
    },

    {
      label: "Quarter 2",
      data: [<?php

include('../connect.php');
$id = $_GET['id'];
$sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
$sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data'. mysqli_connect_error());
$count=1;
while ($row1 = mysqli_fetch_assoc($sqldata)) {



        if($count==11){
            if($row1['q2']=='P'){ echo 4;  }
            if($row1['q2']=='AP'){ echo 3; }
            if($row1['q2']=='D'){ echo 2; }
            if($row1['q2']=='B'){ echo 1; }
                     }
        else if($count>11){
            if($row1['q2']=='P'){ $n=4; echo ",".$n; }
            if($row1['q2']=='AP'){ $n=3; echo ",".$n; }
            if($row1['q2']=='D'){ $n=2; echo ",".$n; }
            if($row1['q2']=='B'){ $n=1; echo ",".$n; }
                         } 
                         $count++;
        if($count==26){ break; } 
    }
?>],
      backgroundColor: [ '#540375',],
      borderColor: ['white',],
      borderWidth: 2
    },

    {
      label: "Quarter 3",
      data: [<?php

include('../connect.php');
$id = $_GET['id'];
$sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
$sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data'. mysqli_connect_error());
$count=1;
while ($row1 = mysqli_fetch_assoc($sqldata)) {



        if($count==11){
            if($row1['q3']=='P'){ echo 4;  }
            if($row1['q3']=='AP'){ echo 3; }
            if($row1['q3']=='D'){ echo 2; }
            if($row1['q3']=='B'){ echo 1; }
                     }
        else if($count>11){
            if($row1['q3']=='P'){ $n=4; echo ",".$n; }
            if($row1['q3']=='AP'){ $n=3; echo ",".$n; }
            if($row1['q3']=='D'){ $n=2; echo ",".$n; }
            if($row1['q3']=='B'){ $n=1; echo ",".$n; }
                         } 
                         $count++;
        if($count==26){ break; } 
    }
?>],
      backgroundColor: [ '#FF7000',],
      borderColor: ['white',],
      borderWidth: 2
    },
    {
      label: "QUARTER 4",
      data: [<?php

include('../connect.php');
$id = $_GET['id'];
$sqlget = "SELECT * FROM progress_report where lrn = $id and progress_index=2 and folder_id = $folder_id";
$sqldata = mysqli_query($conn, $sqlget) or die('Error Displaying Data'. mysqli_connect_error());
$count=1;
while ($row1 = mysqli_fetch_assoc($sqldata)) {

        if($count==11){
            if($row1['q4']=='P'){ echo 4; }
            if($row1['q4']=='AP'){ echo 3;  }
            if($row1['q4']=='D'){ echo 2; }
            if($row1['q4']=='B'){ echo 1; } 
        }
        else if($count > 11){
            if($row1['q4']=='P'){ $n=4; echo ",".$n; }
            if($row1['q4']=='A'){ $n=3; echo ",".$n; }
            if($row1['q4']=='D'){ $n=2; echo ",".$n; }
            if($row1['q4']=='B'){ $n=1; echo ",".$n; }
        }

        $count++;
    if($count==26){ break; } 
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
   
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="a1-tab" data-toggle="tab" href="#aaaaa1" role="tab" aria-controls="a1"
              aria-selected="true">Part I</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="a1-tab" data-toggle="tab" href="#aaaaa2" role="tab" aria-controls="a1"
              aria-selected="false">Part II</a>
          </li>
        </ul>
<!-- tab -->
        <div class="tab-content" id="myTabContent">
        
        <!--aaaaa1-->
          <div class="tab-pane fade show active" id="aaaaaa1" role="tabpanel" aria-labelledby="a1-tab" align="left"> aaaa</div>
        <!--aaaaa1  -->

          <!--aaaaa2-->
          <div class="tab-pane fade" id="aaaaaa2" role="tabpanel" aria-labelledby="a1-tab" align="left"></div>
        <!--aaaaa2  -->
      </div>
      

<!-- tab closing -->

<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModaliep">
  Open modal
</button>

<!-- The Modal -->
<div class="modal" id="myModaliep">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">ADD IEP</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <form action="">
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

<div class="tab-content"id="myTabContent">
    <!-- aa1 -->
<div class="tab-pane fade active show container-fluid" id="aaa1" role="tabpanel" aria-labelledby="home-tab">

<div class="row">

<table class="table">
    <tr>
        <td>Name:</td>
        <td><input type="text" class="form-control"></td>
        <td>Date of Birth:</td>
        <td><input type="date" class="form-control"></td>
        <td>Age:</td>
        <td></td>
    </tr>

    <tr>
        <td>Address:</td>
        <td><input type="date" class="form-control"></td>
    </tr>

    <tr>
        <td>Type of learner: </td>
        <td><input type="text" class="form-control"></td>
        <td>LRN:</td>
        <td><input type="text" class="form-control"></td>
    </tr>
    <tr>
        <td>School year:</td>
        <td><input type="date" class="form-control"></td>
        <td>Adviser:</td>
        <td><input type="text" class="form-control"></td>
    </tr>
    <tr>
        <td>Principal:</td>
        <td><input type="text" class="form-control"></td>
    </tr>
</table>


<p>Record of Assessments</p>

<table class="table">
    <tr>
        <th>Type of Assessments</th>
        <th>Date Administered</th>
        <th>Chronological Age</th>
        <th>Administrator</th>
        <th>Results/Outcome</th>
    </tr>

    <tr>
        <td><input type="text" name="type_assessment" class="form-control"></td>
        <td><input type="date" name="date" class="form-control"></td>
        <td><input type="text" name="chronological_age" class="form-control"></td>
        <td><input type="text" name="administrator" class="form-control"></td>
        <td><input type="text" name="result" class="form-control"></td>
    </tr>
</table>


				
 <p>Attach Records of Assessment</p>

 <strong>Interview with Parents/Guardian</strong>

<p>Name of Parent/Guardian: PARENT A</p>
<p>Contact Number/s: ____________</p>	
<p>	Date of Interview:  September 6, 2021</p>
<p>Developmental and educational History:</p>
<textarea name="educ_history" id="" class="form-control" rows="2"></textarea>                                                       


<strong>Interview with the Learner</strong>

<p>Date of Interview: September 6, 2021</p>
<p>Interests/Hobbies/Talents: Food preparation</p>
<textarea name="interview_learner" id="" class="form-control" rows="2"></textarea> 

<table class="table">
    <tr class="bg-secondary text-white">
        <th>Priority Learning Needs/Intervention</th>
    </tr>
    <tr>
        <td><textarea name="priority1" id="" class="form-control" rows="2"></textarea>  </td>
    </tr>
    <tr>
        <td><textarea name="priority2" id="" class="form-control" rows="2"></textarea>  </td>
    </tr>
    <tr>
        <td><textarea name="priority3" id="" class="form-control" rows="2"></textarea>  </td>
    </tr>
    <tr>
        <td><textarea name="priority4" id="" class="form-control" rows="2"></textarea>  </td>
    </tr>
    <tr>
        <td><textarea name="priority5" id="" class="form-control" rows="2"></textarea>  </td>
    </tr>
    <tr>
        <td><textarea name="priority6" id="" class="form-control" rows="2"></textarea>  </td>
    </tr>
    <tr>
        <td><textarea name="priority7" id="" class="form-control" rows="2"></textarea>  </td>
    </tr>

</table>

</div>
</div>
<!-- aa1 -->

<!-- aa2 -->
<div class="tab-pane fade container-fluid" id="aaa2" role="tabpanel" aria-labelledby="home-tab">

<div class="row">


<p><strong>DAILY LIVING SKILLS DOMAIN:</strong> Present Level of Educational Performance</p>
 <p>Strength/s:</p>
 <textarea name="strenght1" id="" class="form-control" rows="2"></textarea> 
<p>Need/s:</p>
<textarea name="need1" id="" class="form-control" rows="2"></textarea> 


<strong>LANGUAGE DEVELOPMENT DOMAIN: </strong>Present Level of Educational Performance</strong>
<p>Strength/s:</p>
 <textarea name="strenght2" id="" class="form-control" rows="2"></textarea> 
<p>Need/s:</p>
<textarea name="need2" id="" class="form-control" rows="2"></textarea> 

<strong>PSYCHOMOTOR DOMAIN: </strong>Present Level of Educational Performance</strong>
<p>Strength/s:</p>
 <textarea name="strenght3" id="" class="form-control" rows="2"></textarea> 
<p>Need/s:</p>
<textarea name="need3" id="" class="form-control" rows="2"></textarea>    

<strong>COGNITIVE DOMAIN: </strong>Present Level of Educational Performance
<p>Strength/s:</p>
 <textarea name="strenght4" id="" class="form-control" rows="2"></textarea> 
<p>Need/s:</p>
<textarea name="need4" id="" class="form-control" rows="2"></textarea> 

<strong>AESTHETIC AND CREATIVE DOMAIN:</strong> Present Level of Educational Performance
<p>Strength/s:</p>
 <textarea name="strenght5" id="" class="form-control" rows="2"></textarea> 
<p>Need/s:</p>
<textarea name="need5" id="" class="form-control" rows="2"></textarea> 

<strong>BEHAVIORAL DEVELOPMENT: </strong>Present Level of Educational Performance
<p>Strength/s:</p>
 <textarea name="strenght6" id="" class="form-control" rows="2"></textarea> 
<p>Need/s:</p>
<textarea name="need6" id="" class="form-control" rows="2"></textarea> 

<strong>ORIENTATION AND MOBILITY:</strong> Present Level of Educational Performance
<p>Strength/s:</p>
 <textarea name="strenght7" id="" class="form-control" rows="2"></textarea> 
<p>Need/s:</p>
<textarea name="need7" id="" class="form-control" rows="2"></textarea>  
<strong>Transition Package:</strong>
<br>
<label for="">1. </label>
<textarea name="transition1" id="" class="form-control" rows="2"></textarea>  

<label for="">2. </label>
<textarea name="transition1" id="" class="form-control" rows="2"></textarea> 

<label for="">3. </label>
<textarea name="transition1" id="" class="form-control" rows="2"></textarea> 

<label for="">4. </label>
<textarea name="transition1" id="" class="form-control" rows="2"></textarea> 

<label for="">5. </label>
<textarea name="transition1" id="" class="form-control" rows="2"></textarea> 
</div>
</div>
<!-- aa2 -->

</div>



       </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                        <span>Copyright &copy; Your Website 2021</span>
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

    <!-- Logout Modal-->
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>