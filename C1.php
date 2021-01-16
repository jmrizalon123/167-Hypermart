<?php
require_once ('controllers\authController.php');
  if (!isset($_SESSION['id'])){
    header('location: login.php');
  exit ();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="icon" type="image/png" href="images\167 Hypermart Logo 2b.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main2.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/loader.css">
    <title>167 Hypermart | form</title>
</head>  
<body onload="myFunction()">
            
    
    <style>
        .limiter{
            background-repeat: no-repeat;
            background-size: cover;
            width: 100%;
            height: 100%;
            margin-bottom: -300px;
             
        }
        .wrap-login100 input{
            border-style: solid;
        }
        .wrap-login100 label{
            font-size: 14px;
        }
        .form-row span{
            font-size: 13px;
        }
    </style>
    <div class="limiter" id="myDiv" style = "display:none;">
        <nav class="mb-1 navbar navbar-expand-lg navbar-dark primary-color">
            <a class="navbar-brand" href="#"><img src="images/167 Hypermart Logo 2b.png" alt="" width="120px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                <a class="nav-link" href="#" style = "color: black;">
                    <span class="sr-only">(current)</span>
                </a>
                </li>
                </li>
            </ul>
            </div>
        </nav>
        <br>
        <div class="container-login100">
            <div class="wrap-login100 animated bounceIn z-depth-1" style=" border-radius: 0px;">
            <form method="post">
                <div class="tabcontent" name="formhide" id="content1">
                    <div class="login100-form-logo" style="text-align: center; margin-top: -50px; display: none;">
                        <img src="images/167 Hypermart Logo 2b.png" alt="" style="width: 180px;">
                    </div>
                    <div class="login100-form-title p-b-3 p-t-3" style="margin-top: -20px; margin-bottom: 20px; font-size:16px;">
                        basic information
                    </div>

                <?php if (count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                    <li>
                    <?php echo $error; ?>
                    </li>
                    <?php endforeach;?>
                </div>
                <?php endif;?>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputfname">Firstname:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" onkeyup="firstname()">
                        <span id="SPname" style="display: none;"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputlastname">Lastname:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" onkeyup="lastname()">
                        <span id="SPlname" style="display: none;"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputmiddlename">Middlename:</label>
                        <input type="text"class="form-control" id="middlename" name="middlename" onkeyup="middlename()">
                        <span id="SPMname"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputage">Age:</label>
                        <input type="number"class="form-control" id="age" name="age" onkeyup="age()">
                        <span id="SPage"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputgender">Gender:</label>
                        <select id="gender" name="gender" class="form-control" onclick="gender()">
                            <option></option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                        <span id="SPgender"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputGender">Contact Number:</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" onkeyup="contact_number()">
                        <span id="SPcp"></span>
                    </div>
                    
                    
                    </div>

                    <div class="form-group" style="display: none;">
                        <label for="inputstore">Store Visited:</label>
                        <input type="text" class="form-control" id="Store_Visited" name="Store_Visited" value="(C1) Hypermart Antipolo">
                        <span id="SPstoreVisited"></span>
                    </div>

                    <div class="form-group" style="display: none;">
                        <label for="inputAddress">Email Address:</label>
                        <input type="email" class="form-control disabled" id="email" name="email" value="<?php echo $_SESSION['email']?>" onkeyup="email()">
                        <span id="SPemail"></span>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Permanent Address:</label>
                        <input type="text" class="form-control" id="address2" name="address2" onkeyup="address2()">
                        <span id="SPaddress2"></span>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputCity">Current Address: City/Municipality:</label>
                        <select id="city_municipality" name="city_municipality" class="form-control"style="text-transform: uppercase" onclick = "city_municipality()">
                            <option selected>Select...</option>
                            <option>Caloocan City</option>
                            <option>Las Piñas City</option>
                            <option>Manila City</option>
                            <option>Makati City</option>
                            <option>Malabon City</option>
                            <option>Mandaluyong City</option>
                            <option>Marikina City</option>
                            <option>Muntinlupa City</option>
                            <option>Navotas City</option>
                            <option>Parañaque City</option>
                            <option>Pasay City</option>
                            <option>Pasig City</option>
                            <option>Quezon City</option>
                            <option>San Juan City</option>
                            <option>Taguig City</option>
                            <option>Valenzuela City</option>
                        </select>
                        <span id="SPcity"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">Barangay:</label>
                            <input type="text" class="form-control" id="barangay" name="barangay" onkeyup="barangay()">
                            <span id="SPbarangay"></span>
                        </div>
                        <div class="form-group col-md-2">
                            Zip:<a href="https://en.wikipedia.org/wiki/List_of_ZIP_codes_in_the_Philippines"> click here</a>
                            <input type="text" class="form-control" id="zip" name="zip" onkeyup="zip()">
                            <span id="SPzip"></span>
                        </div>

                        <div class="form-group col-md-6">
                        <label for="inputlastname"><b>Currently working in 167 Hypermart?</b></label>
                        <!-- Default inline 2-->
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="defaultInline2" name="inlineDefaultRadiosExample"checked>
                            <label class="custom-control-label" for="defaultInline2"><b>NO</b></label>
                            </div>

                            <!-- Default inline 3-->
                            <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="defaultInline3" name="inlineDefaultRadiosExample">
                            <label class="custom-control-label" for="defaultInline3" value="YES"><b>YES</b></label>
                            </div>

                        </div>
                        <div class="form-group col-md-6 animated fadeIn" id="storeEMP" style="display: none;">
                            <label for="inputCity">Store Code</label>
                            <select id="storecode" name="store_code" class="form-control"style="text-transform: uppercase" onclick = "storecode()">
                                <option selected>Select...</option>
                                <option>167 Hypermart (Head Oficce)</option>
                                <option>C1</option>
                                <option>C2</option>
                                <option>C4</option>
                                <option>C5</option>
                                <option>C6</option>
                                <option>C7</option>
                                <option>C8</option>
                                <option>C9</option>
                                <option>C10</option>
                                <option>C12</option>
                                <option>C13</option>
                                <option>C14</option>
                                <option>C15</option>
                                <option>C16</option>
                                <option>C17</option>
                                <option>C18</option>

                                <option>C19</option>
                                <option>C20</option>
                                <option>C21</option>
                                <option>C22</option>
                                <option>C23</option>
                                <option>C24</option>
                                <option>C26</option>
                                <option>C27</option>
                                <option>C28</option>
                                <option>C29</option>
                                <option>C30</option>
                                <option>C31</option>
                                <option>C32</option>
                                <option>C33</option>
                                <option>C34</option>
                                <option>C35</option>

                                <option>C36</option>
                                <option>C37</option>
                                <option>C38</option>
                                <option>C39</option>
                                <option>C40</option>
                                <option>C41</option>
                                <option>C42</option>
                                <option>C43</option>
                                <option>C44</option>
                                <option>C45</option>
                                <option>C46</option>
                                <option>C47</option>
                                <option>C48</option>
                                <option>C49</option>
                                <option>C50</option>
                                <option>C51</option>
                                
                                <option>C52</option>
                                <option>C53</option>
                                <option>C54</option>
                                <option>C55</option>
                                <option>D01</option>
                            </select>
                            <span id="SPstore" style="display: none;"></span>
                        </div>
                        <div class="form-group col-md-12 animated fadeIn" id="storeEMP2" style="display: none;">
                            <label for="inputAddress2">Store Name:</label>
                            <input type="text" class="form-control" id="store_name" name="store_name" style="text-transform: uppercase;">
                            <span id="SPstore_name"></span>
                        </div>                       
                    </div> 
                        <button type="button" name="btn-submit" class="btn btn-info btn-rounded my-1 waves-effect" id="next" onclick="next()">Next</button> 
                </div>
                    

                    <div class="form-group" style="display:none;" id="content2">
                        <div class="login100-form-logo" style="text-align: center; margin-top: -50px; display: none;">
                            <img src="images/167 Hypermart Logo 2b.png" alt="" style="width: 180px;">
                        </div>
                        <br><br>
                        <div class="login100-form-title p-b-3 p-t-3" style="margin-top: -20px; margin-bottom: 20px; font-size:16px;">
                            Update your quarantine status
                        </div>
                        
                        <label for="are_you_currently_on_strict_quarantine">1. Are you currently on Strict Quarantine?</label><br>
                        <select id="q1" name="are_you_currently_on_strict_quarantine" class="form-control"style="text-transform: uppercase" onkeyup="q1()">
                            <option></option>
                            <option>YES</option>
                            <option>NO</option>
                        </select>
                        <span id="SPq1"></span>

                        <div class="form-group animated fadeIn" id="show1" style= "margin-top: 10px; display: none;">
                                    <label for="inputyes">2. Specify the date range of quarantine. </label>

                                    <p style = "margin-top: 10px">Start Date:</p>
                                    <input type="date" name="start_date" id="start_date" class="form-control">

                                    <p style = "margin-top: 10px">End Date:</p>
                                    <input type="date" name="end_date" id="end_date" class="form-control">

                                    <p style = "margin-top: 10px">3. Having a close contact with anyone during Quarantine period.?</p>
                                    <select id="close_contact" name="close_contact" class="form-control">
                                        <option selected></option>
                                        <option>YES</option>
                                        <option>NO</option>
                                    </select>

                                    <p style = "margin-top: 10px">4. Having a close contact with anyone who is identified as COVID19 Positive, a PUI or PUM.?</p>
                                    <select id="positive_contact" name="positive_contact" class="form-control">
                                        <option selected></option>
                                        <option>YES</option>
                                        <option>NO</option>
                                    </select>

                                    <p style = "margin-top: 10px">5. Quarantine Facility</p>
                                    <select id="quarantine_facility" name="quarantine_facility" class="form-control">
                                        <option selected></option>
                                        <option>Home</option>
                                        <option>Hospital</option>
                                        <option>Quarantine Facility</option>    
                                    </select>
                                    
                                    <label for="loacation" style = "margin-top: 10px">6. Quarantine Address</label>
                                    <input type="text" name="quarantine_address" id="quarantine_address" class="form-control">
                                    <br>
                        </div><br>
                        <button type="button" name="next2" id="next2" class="btn btn-info btn-rounded my-1 waves-effect" onclick="next2()">Next</button>
                    </div>
                        
                    <div class="form" id="form" style= "display: none;">
                        <div class="login100-form-logo" style="text-align: center; margin-top: -50px; display: none;">
                            <img src="images/167 Hypermart Logo 2b.png" alt="" style="width: 180px;">
                        </div>
                        <br><br>
                        <div class="login100-form-title p-b-3 p-t-3" style="margin-top: -20px; margin-bottom: 20px; font-size:16px;">
                            Add Rapid test Result
                        </div>

                            <label for="rapid_test">2. Have you undergo rapid testing.?</label><br>
                            <select id="rapid_testing" name="rapid_testing" class="form-control" onclick="rapid_testing()">
                                <option></option>
                                <option>YES</option>
                                <option>NO</option>
                            </select>
                            <span id="SPrapid_testing"></span>

                            <br>
                            <div class="form-group animated fadeIn" style="display: none" id="yes">
                                <label for="inputyes">Test Result.?</label>
                                <select id="test_result" name="test_result" class="form-control">
                                    <option selected></option>
                                    <option>Positive</option>
                                    <option>Negative</option>
                                    <option>Not yet result</option>
                                </select>
                                <br>
                                <label for="Date">Date</label>
                                <input type="date" name="test_date" id="test_date" class="form-control">
                            
                                <br>
                                <label for="loacation">Location held.?</label>
                                <input type="text" name="test_location" id="test_location" class="form-control">
                                <br>
                            </div>
                            <button type="button" name="next3" id="next3" class="btn btn-info btn-rounded my-1 waves-effect" onclick="next3()">Next</button>
                            
                    
                    </div>

                        <div class="form2" id = "form2" style = "display:none;">
                            <div class="login100-form-logo" style="text-align: center; margin-top: -50px;">
                                <img src="images/167 Hypermart Logo 2b.png" alt="" style="width: 180px;">
                            </div>
                            <br><br>
                            <div class="login100-form-title p-b-3 p-t-3" style="margin-top: -20px; margin-bottom: 20px; font-size:16px;">
                                Add Swab test Result
                            </div>
                            
                            <label for="rapid_test">3. Have you undergo Swab Testing.?</label><br>
                            <select id="swab_testing" name="swab_testing" class="form-control" oninput="swab_testing()">
                                <option></option>
                                <option>YES</option>
                                <option>NO</option>
                            </select>
                            <span id="SPswab_testing"></span>

                            <br>
                            <div class="form-group animated fadeIn" style="display: none" id="swab">
                                <label for="inputyes">Swab Result.?</label>
                                <select id="swab_result" name="swab_result" class="form-control">
                                    <option selected></option>
                                    <option>Positive</option>
                                    <option>Negative</option>
                                    <option>Not yet result</option>
                                </select>
                                <br>
                                <label for="Date">Swab Date</label>
                                <input type="date" name="swab_date" id="swab_date" class="form-control">
                            
                                <br>
                                <label for="loacation">Swab place</label>
                                <input type="text" name="swab_place" id="swab_place" class="form-control">
                                <br>
                            </div>
                            <button type="button" name="next4" id="next4" class="btn btn-info btn-rounded my-1 waves-effect">Next</button>
                        
                        </div>

                        <div class="form3" id = "form3" style="display:none;">
                            <div class="login100-form-logo" style="text-align: center; margin-top: -50px; display: none;">
                                <img src="images/167 Hypermart Logo 2b.png" alt="" style="width: 180px;">
                            </div>
                            <br><br>
                            <div class="login100-form-title p-b-3 p-t-3" style="margin-top: -20px; margin-bottom: 20px; font-size:16px;">
                                Symptoms
                            </div>
                            
                            <label for="rapid_test">4. Temperature:</label><br>
                            <input type="text" class="form-control" name="temperature" id="temperature">
                            <span id="SPtemperature"></span>

                            <br>
                                <fieldset>
                                <h6><b>SYMPTOMS</b></h6><br>
                                <div class="form-check" class="text-center">
                                    <input class="form-check-input" type="checkbox" value="Shortness of breath or difficulty breathing" id="defaultCheck1" name="check_list[]">
                                    <label class="form-check-label" for="defaultCheck1" style="margin-left: 40px;">
                                    1. Shortness of breath or difficulty breathing
                                    </label>
                                </div>
                                <div class="form-check" class="text-center">
                                    <input class="form-check-input" type="checkbox" value="Repeated shaking with chills" id="defaultCheck2" name="check_list[]">
                                    <label class="form-check-label" for="defaultCheck2" style="margin-left: 40px;">
                                    2. Repeated shaking with chills
                                    </label>
                                </div>
                                <div class="form-check" class="text-center">
                                    <input class="form-check-input" type="checkbox" value="New loss of taste or smell" id="defaultCheck3" name = "check_list[]">
                                    <label class="form-check-label" for="defaultCheck3" style="margin-left: 40px;">
                                    3. New loss of taste or smell
                                    </label>
                                </div>
                                <div class="form-check" class="text-center">
                                    <input class="form-check-input" type="checkbox" value="Fever" id="defaultCheck4" name = "check_list[]">
                                    <label class="form-check-label" for="defaultCheck4" style="margin-left: 40px;">
                                    4. Fever
                                    </label>
                                </div>
                                <div class="form-check" class="text-center">
                                    <input class="form-check-input" type="checkbox" value="Cough" id="defaultCheck5" name = "check_list[]">
                                    <label class="form-check-label" for="defaultCheck5" style="margin-left: 40px;">
                                    5. Cough
                                    </label>
                                </div>

                                <div class="form-check" class="text-center">
                                    <input class="form-check-input" type="checkbox" value="Muscle pain" id="defaultCheck6" name = "check_list[]">
                                    <label class="form-check-label" for="defaultCheck6" style="margin-left: 40px;">
                                    6. Muscle pain
                                    </label>
                                </div>

                                <div class="form-check" class="text-center">
                                    <input class="form-check-input" type="checkbox" value="Chills" id="defaultCheck7" name = "check_list[]">
                                    <label class="form-check-label" for="defaultCheck7" style="margin-left: 40px;">
                                    7. Chills
                                    </label>
                                </div>

                                <div class="form-check" class="text-center">
                                    <input class="form-check-input" type="checkbox" value="Headache" id="defaultCheck8" name = "check_list[]">
                                    <label class="form-check-label" for="defaultCheck8" style="margin-left: 40px;">
                                    8. Headache
                                    </label>
                                </div>
                                <div class="form-check" class="text-center">
                                    <input class="form-check-input" type="checkbox" value="Sore throat" id="defaultCheck9" name = "check_list[]">
                                    <label class="form-check-label" for="defaultCheck9" style="margin-left: 40px;">
                                    9. Sore throat
                                    </label>
                                </div>

                                
                                <br>
                                </fieldset>
                                <label for="symptoms">Other Symptoms:</label>
                                <input type="text" name="other_symptoms" id="other_symptoms" class="form-control">
                                
                                <br>
                                <button type="submit" name="submitdata" id="next5" class="btn btn-info btn-rounded my-1 waves-effect">Finish</button>
                        </div>
                     </form>
                     <hr>
                     <small class="text-muted">© 2020 Copyright: 167 Hypermart</small>
                </div>
            </div>
        </div>
        
        <div id="loader-wrapper">
			<div id="loader"></div>
		</div>
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
          
    <script>
        
        document.getElementById("next").onclick = function() {
            if (firstname.value == ""){
                document.getElementById("SPname").innerHTML = "Firstname is required *";
                document.getElementById("SPname").style.display ="block";
                document.getElementById("SPname").style.color="red";
               // return false;
            }
            
            if (lastname.value ==""){
                document.getElementById("SPlname").innerHTML="Lastname is required *";
                document.getElementById("SPlname").style.display ="block";
                document.getElementById("SPlname").style.color="red";
               // return false;
            }

            if (middlename.value ==""){
                document.getElementById("SPMname").innerHTML = "Middlename is required *";
                document.getElementById("SPMname").style.diplay = "block";
                document.getElementById("SPMname").style.color = "red";
               // return false;
            }

            if (age.value ==""){
                document.getElementById("SPage").innerHTML = "Age is required *";
                document.getElementById("SPage").style.display = "block";
                document.getElementById("SPage").style.color = "red";
               // return false;
            }

            if (gender.value ==""){
                document.getElementById("SPgender").innerHTML = "Gender is required *";
                document.getElementById("SPgender").style.display = "block";
                document.getElementById("SPgender").style.color = "red";
                //return false;
            }else{
                document.getElementById("SPgender").style.diplay = "none";
            }

            if (contact_number.value ==""){
                document.getElementById("SPcp").innerHTML = "Contact number is required *";
                document.getElementById("SPcp").style.display = "block";
                document.getElementById("SPcp").style.color = "red";
                //return false;           
                }

            if (email.value ==""){
                document.getElementById("SPemail").innerHTML = "Email is required *";
                document.getElementById("SPemail").style.display = "block";
                document.getElementById("SPemail").style.color = "red";
                //return false;
            }
            
            if (address2.value == ""){
                document.getElementById("SPaddress2").innerHTML = "Address is required *";
                document.getElementById("SPaddress2").style.display = "block";
                document.getElementById("SPaddress2").style.color = "red";
               // return false;
            }

            if (city_municipality.value === "Select..."){
                document.getElementById("SPcity").innerHTML = "City/Municipality is required *";
                document.getElementById("SPcity").style.display = "block";
                document.getElementById("SPcity").style.color = "red";
                //return false;
            }else{
                document.getElementById("SPcity").style.display = "none";
            }

            if (barangay.value == ""){
                document.getElementById("SPbarangay").innerHTML = "Barangay is required *";
                document.getElementById("SPbarangay").style.display = "block";
                document.getElementById("SPbarangay").style.color = "red";
               // return false;
            }

            if (zip.value == ""){
                document.getElementById("SPzip").innerHTML = "Zip is required *";
                document.getElementById("SPzip").style.display = "block";
                document.getElementById("SPzip").style.color = "red";
                return false;
            }else{
                document.getElementById("next").style.color = "green" ;
                document.getElementById("next").innerHTML = "Please wait...";
                var load;
                load = setTimeout(showPage, 3000);
                function showPage() {
                document.getElementById("content1").style.display = "none";
                document.getElementById("content2").style.display = "block";
                return true;
                }
            }
        }

        document.getElementById("next2").onclick = function (){
            if(q1.value == ""){
            document.getElementById("SPq1").innerHTML = "Field is required *";
            document.getElementById("SPq1").style.display = "block";
            document.getElementById("SPq1").style.color = "red";
            return false;
            }else{
                document.getElementById("next2").style.color = "green" ;
                document.getElementById("next2").innerHTML = "Please wait...";
                var load;
                load = setTimeout(showPage, 3000);
                function showPage() {
                document.getElementById("form").style.display = "block";
                document.getElementById("content2").style.display = "none";
                return true;

                }
            }
        }

        document.getElementById("q1").oninput = function() {
            if(q1.value == ""){
            document.getElementById("SPq1").innerHTML = "Field is required *";
            document.getElementById("SPq1").style.display = "block";
            document.getElementById("SPq1").style.color = "red";
            document.getElementById("show1").style.display = "none";
            }
            if (q1.value =="YES"){
                document.getElementById("show1").style.display = "block";
            }
            
            if (q1.value =="NO"){
                document.getElementById("show1").style.display = "none";
            } 
            
            else{
                document.getElementById("SPq1").style.display = "none";
                return true;
            }
        }
        document.getElementById("next3").onclick = function () {
            if (rapid_testing.value == ""){
                document.getElementById("SPrapid_testing").innerHTML = "Fields is required *";
                document.getElementById("SPrapid_testing").style.display = "block";
                document.getElementById("SPrapid_testing").style.color = "red";
                document.getElementById("yes").style.display = "none";
                return false;
            }else{
                document.getElementById("next3").style.color = "green" ;
                document.getElementById("next3").innerHTML = "Please wait...";
                var load;
                load = setTimeout(showPage, 3000);
                function showPage() {
                document.getElementById("form2").style.display = "block";
                document.getElementById("form").style.display = "none";
                return true;
                }
            }
        }
        document.getElementById("rapid_testing").oninput = function (){
            if (rapid_testing.value == ""){
                document.getElementById("SPrapid_testing").innerHTML = "Fields is required *";
                document.getElementById("SPrapid_testing").style.display = "block";
                document.getElementById("SPrapid_testing").style.color = "red";
                document.getElementById("yes").style.display = "none";
                return false;
            }
            if (rapid_testing.value == "YES"){
                document.getElementById("SPrapid_testing").style.display = "none";
                document.getElementById("yes").style.display = "block";
                return true;
            }

            if (rapid_testing.value == "NO"){
                document.getElementById("SPrapid_testing").style.display = "none";
                document.getElementById("yes").style.display = "none";
                return true;
            }
        }


        document.getElementById("next4").onclick = function () {
            if (swab_testing.value == ""){
                document.getElementById("SPswab_testing").innerHTML = "Fields is required *";
                document.getElementById("SPswab_testing").style.display = "block";
                document.getElementById("SPswab_testing").style.color = "red";
                document.getElementById("swab").style.display = "none";

            }else{
                document.getElementById("next4").style.color = "green" ;
                document.getElementById("next4").innerHTML = "Please wait...";
                var load;
                load = setTimeout(showPage, 3000);
                function showPage() {
                document.getElementById("form2").style.display = "none";
                document.getElementById("form3").style.display = "block";
                }
            }
        }

        document.getElementById("swab_testing").oninput = function (){
            if (swab_testing.value == ""){
                document.getElementById("SPswab_testing").innerHTML = "Fields is required *";
                document.getElementById("SPswab_testing").style.display = "block";
                document.getElementById("SPswab_testing").style.color = "red";
                document.getElementById("swab").style.display = "none";

            }
            if (swab_testing.value == "YES"){
                document.getElementById("SPswab_testing").style.display = "none";
                document.getElementById("swab").style.display = "block";
            }

            if (swab_testing.value == "NO"){
                document.getElementById("SPswab_testing").style.display = "none";
                document.getElementById("swab").style.display = "none";
            }
        }

        document.getElementById("next5").onclick = function () {
            if (temperature.value ==""){
                document.getElementById("SPtemperature").innerHTML = "Temperature is required";
                document.getElementById("SPtemperature").style.display = "block";
                document.getElementById("SPtemperature").style.color = "red";
                return false;
            }else{
                document.getElemenById("SPtemperature").style.display = "none";
                return true;
            }
        }

        document.getElementById("temperature").oninput = function () {
            if (temperature.value ==""){
                document.getElementById("SPtemperature").innerHTML = "Temperature is required";
                document.getElementById("SPtemperature").style.display = "block";
                document.getElementById("SPtemperature").style.color = "red";
            }else{
                document.getElementById("SPtemperature").style.display = "none";
                return true;
            }
        }


        //Function for onkeyup event!

        document.getElementById("firstname").onkeyup = function() {
            var number = /^[0-9]+$/;

            if(firstname.value ===""){
                document.getElementById("SPname").style.display ="block";
                document.getElementById("SPname").style.color ="red";
                document.getElementById("SPname").innerHTML = "Firstname is required";
                return false;
            }
            else if (firstname.value.match(number)){
                document.getElementById("SPname").style.display ="block";
                document.getElementById("SPname").style.color ="red";
                document.getElementById("SPname").innerHTML = "Input must be character only";

            }else{
                document.getElementById("SPname").style.display = "none";
                return true;
            }
        }

        document.getElementById("lastname").onkeyup = function() {
            if (lastname.value >0){
                document.getElementById("SPlname").style.display ="block";
                document.getElementById("SPlname").style.color ="red";
                document.getElementById("SPlname").innerHTML = "Input must be character only";
                
            }else if(lastname.value ===""){
                document.getElementById("SPlname").style.display ="block";
                document.getElementById("SPlname").style.color ="red";
                document.getElementById("SPlname").innerHTML = "Lastname is required";
                return false;
            }else{
                document.getElementById("SPlname").style.display = "none";
                return true;
            }
        }

        document.getElementById("middlename").onkeyup = function() {
            if (middlename.value >0){
                document.getElementById("SPMname").style.display ="block";
                document.getElementById("SPMname").style.color ="red";
                document.getElementById("SPMname").innerHTML = "Input must be character only";
                
            }else if(middlename.value ===""){
                document.getElementById("SPMname").style.display ="block";
                document.getElementById("SPMname").style.color ="red";
                document.getElementById("SPMname").innerHTML = "Middle is required";
                return false;
            }else{
                document.getElementById("SPMname").style.display = "none";
                return true;
            }
        }

        document.getElementById("middlename").onkeyup = function() {
            if (middlename.value >0){
                document.getElementById("SPMname").style.display ="block";
                document.getElementById("SPMname").style.color ="red";
                document.getElementById("SPMname").innerHTML = "Input must be character only";
                
            }else if(middlename.value ===""){
                document.getElementById("SPMname").style.display ="block";
                document.getElementById("SPMname").style.color ="red";
                document.getElementById("SPMname").innerHTML = "Middle is required";
                return false;
            }else{
                document.getElementById("SPMname").style.display = "none";
                return true;
            }
        }

        document.getElementById("age").onkeyup = function() {
            if (age.value >100){
                document.getElementById("SPage").style.display ="block";
                document.getElementById("SPage").style.color ="red";
                document.getElementById("SPage").innerHTML = "Too old, Please input as your desire age!";
                
            }else if(age.value ===""){
                document.getElementById("SPage").style.display ="block";
                document.getElementById("SPage").style.color ="red";
                document.getElementById("SPage").innerHTML = "Age is required *";
               return false;   
            }else{
                document.getElementById("SPage").style.display = "none";
                return true;
            }
        }

        document.getElementById("gender").onclick = function () {
            if (gender.value ==="Select"){
            document.getElementById("SPgender").innerHTML = "Gender is required *";
            document.getElementById("SPgender").style.display = "block";
            document.getElementById("SPgender").style.color = "red";
            return false;
        }else{
            document.getElementById("SPgender").style.display = "none";
            return true;
        }
        }

        document.getElementById("contact_number").onkeyup = function() {
            if (contact_number.value ==""){
                document.getElementById("SPcp").style.display ="block";
                document.getElementById("SPcp").style.color ="red";
                document.getElementById("SPcp").innerHTML = "Contact number is required!";
                return false;
            }else{
                document.getElementById("SPcp").style.display = "none";
                return true;
            }
        }

        document.getElementById("email").onkeyup = function () {
            var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (email.value ==""){
                document.getElementById("SPemail").innerHTML = "Email is required *";
                document.getElementById("SPemail").style.display = "block";
                document.getElementById("SPemail").style.color = "red";
            }
            else if (email.value.match(pattern)){
                document.getElementById("SPemail").style.display = "none";
                return true;

            }else{
                document.getElementById("SPemail").innerHTML = "Please provide a valid email address *";
                document.getElementById("SPemail").style.display = "block";
                document.getElementById("SPemail").style.color = "red";
                return false;
            }

        }

        document.getElementById("address2").onkeyup = function() {
            if (address2.value ===""){
                document.getElementById("SPaddress2").style.display ="block";
                document.getElementById("SPaddress2").style.color ="red";
                document.getElementById("SPaddress2").innerHTML = "Address is required!";
                return false;
            }else{
                document.getElementById("SPaddress2").style.display = "none";
                return true;
            }
        }

        document.getElementById("city_municipality").oninput = function () {
            if (city_municipality.value === "Select..."){
                document.getElementById("SPcity").innerHTML = "City/Municipality is required *";
                document.getElementById("SPcity").style.display = "block";
                document.getElementById("SPcity").style.color = "red";
                //return false;
            }else{
                document.getElementById("SPcity").style.display = "none";
            }
        }

        document.getElementById("barangay").onkeyup = function() {
            if (barangay.value ===""){
                document.getElementById("SPbarangay").style.display ="block";
                document.getElementById("SPbarangay").style.color ="red";
                document.getElementById("SPbarangay").innerHTML = "Barangay is required!";
                return false;
                
            }else{
                document.getElementById("SPbarangay").style.display = "none";
                return true;
            }
        }

        document.getElementById("zip").onkeyup = function() {
            var numbers = /^[0-9]+$/;

            if (zip.value ===""){
                document.getElementById("SPzip").style.display ="block";
                document.getElementById("SPzip").style.color ="red";
                document.getElementById("SPzip").innerHTML = "Zip is required!";
                
            }
            else if (!zip.value.match(numbers)){
                document.getElementById("SPzip").innerHTML = "Input value numeric only *";
                document.getElementById("SPzip").style.display = "block";
                document.getElementById("SPzip").style.display = "red";
            }
            else{
                document.getElementById("SPzip").style.display = "none";
                return true;
            }
        }

        document.getElementById("defaultInline3").onclick = function () {
            if (defaultInline3.checked){
                document.getElementById("storeEMP").style.display = "block";
                document.getElementById("storeEMP2").style.display = "block";
            }
        }
        document.getElementById("defaultInline2").onclick = function () {
            if (defaultInline2.checked){
                document.getElementById("storeEMP").style.display = "none";
                document.getElementById("storecode").value = "";
                document.getElementById("store_name").value = "";
                document.getElementById("storeEMP2").style.display = "none";
            }
        }

        document.getElementById("storecode").oninput = function () {
            if (storecode.value == "C1"){
                document.getElementById("store_name").value = "167 Hypermart Antipolo";
            }else if (storecode.value == "C2"){
                document.getElementById("store_name").value = "Super1 Antipolo";
            }else if (storecode.value == "C4"){
                document.getElementById("store_name").value = "167 Hypermart Los Banos";
            }else if (storecode.value == "C5"){
                document.getElementById("store_name").value = "167 Hypermart Marikina";
            }else if (storecode.value == "C6"){
                document.getElementById("store_name").value = "Unigo Marikina";
            }else if (storecode.value == "C7"){
                document.getElementById("store_name").value = "167 SC Pasig";
            }else if (storecode.value == "C8"){
                document.getElementById("store_name").value = "PLAIN Pasig";
            }else if (storecode.value == "C9"){
                document.getElementById("store_name").value = "PLAIN Pasig";
            }else if (storecode.value == "C10"){
                document.getElementById("store_name").value = "167 Tanay";
            }else if (storecode.value == "C12"){
                document.getElementById("store_name").value = "Plain Montalban";
            }else if (storecode.value == "C13"){
                document.getElementById("store_name").value = "167 Hypermart San Pablo Laguna";
            }else if (storecode.value == "C14"){
                document.getElementById("store_name").value = "167 Hypermart San Pablo Laguna";
            }else if (storecode.value == "C15"){
                document.getElementById("store_name").value = "167 Hypermart San Fernando";
            }else if (storecode.value == "C16"){
                document.getElementById("store_name").value = "167 SC San Angeles";
            }else if (storecode.value == "C17"){
                document.getElementById("store_name").value = "167 Hypermart Olongapo";
            }else if (storecode.value == "C18"){
                document.getElementById("store_name").value = "167 Hypermart GMA Cavite";
            }else if (storecode.value == "C19"){
                document.getElementById("store_name").value = "167 Hypermart Tanuan";
            }else if (storecode.value == "C20"){
                document.getElementById("store_name").value = "Divimart Taytay";
            }else if (storecode.value == "C21"){
                document.getElementById("store_name").value = "Divimart Pasig";
            }else if (storecode.value == "C22"){
                document.getElementById("store_name").value = "167 Hypermart Pangasinan";
            }else if (storecode.value == "C23"){
                document.getElementById("store_name").value = "U-Mart Cavite";
            }else if (storecode.value == "C24"){
                document.getElementById("store_name").value = "Divimart Angat";
            }else if (storecode.value == "C26"){
                document.getElementById("store_name").value = "167 SC Tarlac";
            }else if (storecode.value == "C27"){
                document.getElementById("store_name").value = "Divimart Guguinto";
            }else if (storecode.value == "C28"){
                document.getElementById("store_name").value = "Divimart Cavite";
            }else if (storecode.value == "C29"){
                document.getElementById("store_name").value = "Divimart Bacoor 2";
            }else if (storecode.value == "C30"){
                document.getElementById("store_name").value = "Divimart Taytay";
            }else if (storecode.value == "C31"){
                document.getElementById("store_name").value = "Divimart San Miguel";
            }else if (storecode.value == "C32"){
                document.getElementById("store_name").value = "Divimart Bacoor 1";
            }else if (storecode.value == "C33"){
                document.getElementById("store_name").value = "167 SC Tarlac";
            }else if (storecode.value == "C34"){
                document.getElementById("store_name").value = "167 Hypermart Cainta";
            }else if (storecode.value == "C35"){
                document.getElementById("store_name").value = "Divimart Subic";
            }else if (storecode.value == "C36"){
                document.getElementById("store_name").value = "167 WE-HOME BATAAN";
            }else if (storecode.value == "C37"){
                document.getElementById("store_name").value = "E-HOME TRECE MARTIRES";
            }else if (storecode.value == "C38"){
                document.getElementById("store_name").value = "Divimart Tarlac";
            }else if (storecode.value == "C39"){
                document.getElementById("store_name").value = "Divimart Trece, Cavite";
            }else if (storecode.value == "C40"){
                document.getElementById("store_name").value = "167 SC Laguna";
            }else if (storecode.value == "C41"){
                document.getElementById("store_name").value = "Divimart Antipolo-E";
            }else if (storecode.value == "C42"){
                document.getElementById("store_name").value = "Divimart San Pablo, Laguna";
            }else if (storecode.value == "C43"){
                document.getElementById("store_name").value = "WE-HOME VALENZUELA";
            }else if (storecode.value == "C44"){
                document.getElementById("store_name").value = "Divimart Cubao";
            }else if (storecode.value == "C45"){
                document.getElementById("store_name").value = "167 Hypemart Butuan";
            }else if (storecode.value == "C46"){
                document.getElementById("store_name").value = "167 SC Cavite";
            }else if (storecode.value == "C47"){
                document.getElementById("store_name").value = "Dvimart Los Banos";
            }else if (storecode.value == "C48"){
                document.getElementById("store_name").value = "167 SHOPPERS MART CALAMBA";
            }else if (storecode.value == "C49"){
                document.getElementById("store_name").value = "Dvimart SanIdefonsob, Bulacan";
            }else if (storecode.value == "C50"){
                document.getElementById("store_name").value = "Dvimart Baliwag, Bulacan";
            }else if (storecode.value == "C51"){
                document.getElementById("store_name").value = "167 SHOPPERS MART Zambales";
            }else if (storecode.value == "C52"){
                document.getElementById("store_name").value = "U-MART Zambales";
            }else if (storecode.value == "C53"){
                document.getElementById("store_name").value = "167 SHOPPERS MART Zambales";
            }else if (storecode.value == "C54"){
                document.getElementById("store_name").value = "U-Mart Zambales";
            }else if (storecode.value == "C55"){
                document.getElementById("store_name").value = "Divimart Manila";
            }else if (storecode.value == "D01"){
                document.getElementById("store_name").value = "Online Manila";
            }else if (storecode.value == "Select..."){
                document.getElementById("store_name").value = "";
            }
            
        }

    </script>

        
</body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <script src="js/main.js"></script>
    <script src="js/fontawesome.js"></script>
    <script src="js/fontawesome.min.js"></script>

</html>