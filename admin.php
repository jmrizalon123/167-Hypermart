<?php
require('controllers\admin_controller.php');
require('config.php');
if (!isset($_SESSION['id'])){
    header('location: admin_login');
    exit ();
  }

  if(isset($_POST['submit']))
  {
      $myInput = $_POST['myInput'];
      $query = "SELECT * FROM `client_data` WHERE CONCAT(`id`, `fname`, `lname`, `email`) LIKE '%".$myInput."%'";
      $search_result = filterTable($query);
  }
  else{
      $query = "SELECT * FROM `client_data`";
      $search_result = filterTable($query);
  }

  function filterTable($query)
  {
      $connect = mysqli_connect("localhost", "root", "", "divimart");
      $filter_Result = mysqli_query($connect, $query);
      return $filter_Result;
  }
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="images\167 Hypermart Logo 2b.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>167 Hypermart | Admin panel</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/loader.css">
</head>
<body onload="myFunction()">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div id="myDiv" style="display:none;" class="animated fadeIn">
        <nav class="mb-1 navbar navbar-expand-lg navbar-dark primary-color" style= "width: 100%;">
          <a class="navbar-brand" href="#"><img src="images/167 Hypermart Logo 2b.png" alt="" width="150px"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
            aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="basicExampleNav">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            </ul>
            <form class="form-inline" method="POST" action="admin">
              <div class="md-form my-0">
                <input class="form-control mr-sm-2" type="text" name="myInput" id="myInput" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary" name="submit" type="submit" id="submit" data-toggle="tooltip" data-placement="top" title="Search: ID, firstname, Lastname, Email" style= "padding: 10px;"><i class="fas fa-search"></i> Search</button>
                <a href="admin?logout=2" class="btn btn-danger" style= "padding: 10px;"><i class="fas fa-sign-out-alt"></i> Logout</a>
                <a href="" style="color:#ffff;">User: <?php echo $_SESSION['username']; ?></a>
              </div>
            </form>
          </div>
      </nav>
        <div class="container-fluid" id="exportContent">
              <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header">
                          <i class="fas fa-file-export"></i> Export File
                        </div>
                        <div class="card-body tex-center">
                          <button class="btn aqua-gradient" id="excel" type="button"onclick="exportTableToExcel('table', '167 Hypermart-data')" style= "width: 95%; padding: 10px;"><i class="fas fa-file-excel"></i> MS EXCEL</button>
                          <button class="btn peach-gradient" id="excel" type="button" style= "width: 95%; padding: 10px;" onclick="Export2Doc('exportContent', '167 Hypermart Data');"><i class="far fa-file-word"></i> MS WORD</button>
                          <button class="btn purple-gradient" id="btnExport" type="button" style= "width: 95%; padding: 10px;" onclick="Export()"><i class="far fa-file-pdf"></i> PDF</button>
                          <button class="btn blue-gradient" id="printme" name="printme" type="button" style= "width: 95%; padding: 10px;"><i class="fas fa-print"></i> PRINT</button>
                          <hr class="my-2">
                        </div>
                    </div>  
                    <br>
                    <div class="card">
                        <div class="card-header">
                          <i class="fas fa-qrcode"></i> Attendance Report
                        </div>
                        <div class="card-body tex-center">
                          <div class="roll">
                            <table style="margin-top: 0px" class="table">
                              <thead class="text-center">
                                <th><b style="font-size: 100%;"> No: </b></th>
                                <th><b style="font-size: 100%;"> Username </b></th>
                                <th><b style="font-size: 100%;"> PLACE VISITED </b></th>
                                <th><b style="font-size: 100%;"> DATE </b></th>                         
                              </thead>
                                <?php
                                  $count=1;
                                  $email="";
                                  $email = $_SESSION['email'];
                                  $sql_query="SELECT * FROM place_visited ORDER BY id ASC;";
                                  $result = mysqli_query($con,$sql_query);
                                  while($row = mysqli_fetch_assoc($result)) { ?>
                                  <tr>
                                  <td class="text-left" style="font-size: 100%;"><?php echo $row["id"]; ?></td>
                                  <td class="text-left" style="font-size: 100%;"><?php echo $row["username"]; ?></td>
                                  <td class="text-left" style="font-size: 100%;"><?php echo $row["place_visited"]; ?></td>
                                  <td class="text-left" style="font-size: 100%;"><?php echo $row["date_visited"]; ?></td>
                                  </tr>
                                <?php $count++; } ?>
                            </table>
                          </div>
                        </div>
                    </div>
                  </div>

                  <div class="col-sm-9" style="margin-top: 15px;">
                  <div class="card">
                  <div class="alert alert-danger alert-dismissible animated zoomIn fade show" role="alert" id="errmessage" style = "display: none;">
                  <div class="row">
                    <div class="col-sm">
                      <strong>Notice!</strong> Fields is required!
                    </div> 
                    <div class="col-sm">
                    <strong>Filter search: </strong> ID, Firstname, Lastname, and Email
                  </div>
                  </div>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
                      <div class="card-header">
                      <i class="fas fa-table"></i> Client Data
                      </div>
                      <div class="card-body">
                          <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table style="border-collapse:collapse; margin-top: -100px;" class="table table-bordered table-striped mb-0" id="table">
                                <thead>
                                  <tr></tr>
                                </thead>
                                <tbody id="myTable">
                                        <strong><?php  while($row = mysqli_fetch_array($search_result)):?>
                                      <?php $count=1;
                                        $sql_query="Select * from client_data ORDER BY id desc;";
                                        $result = mysqli_query($con,$sql_query);
                                        while($row = mysqli_fetch_assoc($result)) { ?></strong>
                                        <tr>
                                        <th scope= "col"><strong>ID</strong></th>
                                        <td><?php echo $count; ?></td>
                                        <tr>
                                          <th scope= "col"><strong>1. Fullname</strong></th>
                                          <td><strong><?php echo $row["fname"]; echo", "; echo $row["lname"]; echo", "; echo $row["middlename"] ?></strong></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>2. Contact Number</strong></th>
                                          <td><?php echo $row["contact_number"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>3. Email</strong></th>
                                          <td><?php echo $row["email"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>4. Are you currently on strict quarantine?</strong></th>
                                          <td><?php echo $row["are_you_currently_on_strict_quarantine"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>5. Quarantine date started?</strong></th>
                                          <td><?php echo $row["start_date"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>6. Quarantine date end?</strong></th>
                                          <td><?php echo $row["end_date"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>7. Do you have a close contact with anyone during your Quarantine Period?</strong></th>
                                          <td><?php echo $row["close_contact"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>8. Have you been in close contact with anyone who is identified as COVID19 Positive, a PUI or PUM?</strong></th>
                                          <td><?php echo $row["positive_contact"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>9. Place of Quarantine facility?</strong></th>
                                          <td><?php echo $row["quarantine_facility"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>10. Quarantine address?</strong></th>
                                          <td><?php echo $row["quarantine_address"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>11. Have you undergo Rapid Testing?</strong></th>
                                          <td><?php echo $row["rapid_testing"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>12. What is the Test Result?</strong></th>
                                          <td><?php echo $row["test_result"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>13. What is the date of Testing?</strong></th>
                                          <td><?php echo $row["test_date"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>14. Place of Test?</strong></th>
                                          <td><?php echo $row["test_location"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>15. Have you undergo Swab Testing?</strong></th>
                                          <td><?php echo $row["swab_testing"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>16. What is the test result?</strong></th>
                                          <td><?php echo $row["swab_result"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>17. Date of Swab Testing?</strong></th>
                                          <td><?php echo $row["swab_date"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>18. Swab Test location?</strong></th>
                                          <td><?php echo $row["swab_place"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>19. Temperature?</strong></th>
                                          <td><?php echo $row["temperature"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>20. Symptoms?</strong></th>
                                          <td><?php echo $row["symptoms"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>21. Other Symptoms?</strong></th>
                                          <td><?php echo $row["other_symptoms"]; ?></td>
                                        </tr>
                                        <tr>
                                          <th scope= "col"><strong>22. Date of COVID19 survey</strong></th>
                                          <td><?php echo $row["date_created"]; ?></td>
                                        </tr>
                                        <br>
                                        <?php $count++;} endwhile; ?>
                                  </tbody>
                              </table>
                            </div>
                      </div>
                    </div>  
                  </div>
              </div>
        </div>
        <style>
        .roll{
            height: 400px;
            overflow-y: auto;
            }

        .my-custom-scrollbar {
          position: relative;
          height: 700px;
          overflow: auto;
          }
          .table-wrapper-scroll-y {
          display: block;
          }
        </style>
            <div class="card-footer text-muted" style="font-size: 13px; width: 100%;">
                © 2020 Copyright: 167 Hypermart
            </div>
    </div>
    
    <div id="loader-wrapper">
			<div id="loader"></div>
		</div>
  </div>
    <style>
    tbody th{
      width: 50%;
    }
    tbody td{
      text-align: center;
    }
        .form-row{
            margin-bottom: 20px;
        }
        .container{

        }
        table thead tr{
            font-size: 13px;
            font-family: century gothic;
            font-weight: bolder;
        }
        table tbody tr{
            font-size: 13px;
            font-family: century gothic;
        }
        #myDiv a{
            font-family: century gothic;
        }
        
        * {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}


.topnav .search-container {
  float: right;
  margin-top: 40px;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  

  }
  #printme{
      width: 100%;
      position: relative;
      padding: 10px;
  }
}

    </style>
    <script>
      document.getElementById("submit").onclick = function () {
        if (myInput.value == ""){
          document.getElementById("errmessage").style.display = "block";
          return false;
        }else{
          document.getElementById("errmessage").style.display = "none";
          return true;

        }
      }
    </script>
    <script>
          $('#printme').click(function(){
            var printT = document.getElementById('table');
            var prt = window.open("", "", "width=900, height=700");
            prt.document.write(printT.outerHTML);
            prt.document.close();
            prt.focus();
            prt.print();
            prt.close();
          })
    </script>

    <script>
        var myVar;

        function myFunction() {
        myVar = setTimeout(showPage, 2000);
        }

        function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("myDiv").style.display = "block";
        }
    </script>

</body>
        <script src = "MD/js/bootstrap.min.js"></script>
        <script src = "js/excel_export.js"></script>
        <script src = "js/export_pdf.js"></script>
        <script src = "js/word_export.js"></script>
        <script src = "MD/js/bootstrap.js"></script>
        <script src = "MD/js/jquery.min.js"></script>
        <script src = "MD/js/mdb.min.js"></script>
        <script src = "MD/js/mdb.js"></script>
        <script src="js/fontawesome.js"></script>
        <script src="js/fontawesome.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="vendor/animsition/js/animsition.min.js"></script>
        <script src="vendor/select2/select2.min.js"></script>
        <script src="vendor/daterangepicker/moment.min.js"></script>
          
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
</html>