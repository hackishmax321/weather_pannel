<?php 
	$_SESSION['Username'] = 0;
	session_start();

	if(isset($_SESSION['Username'])){
    $url=null;
    $level = 0;
    if($_SESSION['Role']=="Admin"){
      $level = 4;
    } else if($_SESSION['Role']=="Staff"){
      $level = 2;
    } else if($_SESSION['Role']=="Member"){
      $level = 1;
    }
    
  }
	


	if(isset($_GET['logout'])){
		$_SESSION = array();
		session_destroy();
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

  <title>DMS | WeatherALPHA</title>

  <!--================================================= Site Icon ===================================================================-->
  <link rel="icon" type="image/png" href="images/icon/test.png">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


  <!--=================================FontAwesome Icons=============================================--> 
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!--================================Weather Plugin Fonts============================================--> 
  <link href="https://fonts.googleapis.com/css?family=Quicksand|Raleway&display=swap" rel="stylesheet">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/sb-custom.css" rel="stylesheet">

  <!-- The core Firebase JS SDK is always required and must be listed first -->
  <script src="https://www.gstatic.com/firebasejs/7.3.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.3.0/firebase-firestore.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.3.0/firebase-analytics.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-storage.js"></script>      
  <script src="https://www.gstatic.com/firebasejs/3.1.0/firebase-database.js"></script>

  <!--==========================================================JQuery=================================================================-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!--===================================TensorFlow Libries=============================================--> 
  <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.0.0/dist/tf.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/p5@0.10.2/lib/p5.js"></script>
  

  <style>

          .pannel {
                position: relative;
                width:90vh;
                height: 100%;
                
                display: flex;
                padding: 20px;
                font-family: 'Raleway', sans-serif;
                
            }

            .window {
                background-color: aquamarine;
                flex: 1;
                border-radius: 10px 10px;
                max-height: 65vh;
                display: flex;
                justify-content: center;
                justify-items: center;
                text-align: center;
                border: 1px ridge #fff;
                
                
            }

            .temp {
                font-size: 70px;
                font-family: 'Quicksand', sans-serif;
                font-weight: bold;
                margin: 0;
                
            }

            /* Card Styles */
            .long-card {
              flex-wrap: wrap;
              
            }

            #card-lg {
              width: 77vw;
              display: flex;
              flex-direction: row
            }

            #card-lg .batch {
              margin: 10px 20px;
              text-align: center;
              width: 150px;
              
            }

            .batch-add {
              border: 5px dashed blue;
              border-radius: 20px;
            }

            .batch p {
              line-height: 5.5px;
            }

            .user-add {
              font-size: 30px;
              font-weight: 600;
              margin-bottom: 20px;
            }

            .upload-sect {
              margin: 10px 20px;
              margin-bottom: 40px;
              width: 100%;
              padding: 10px 20px;
              background-color: azure;
              border:  2px ridge rgb(207, 207, 207);
              box-shadow: 0px 0px 30px rgb(182, 182, 182) inset;
              border-radius: 10px;

            }

            .drop-zone {
              margin: auto;
              margin-top: 20px;
              margin-bottom: 14px;
              padding: 20px;
              height: 280px;
              width: 70vw;
              border: 2px dashed rgb(139, 139, 139);
              border-radius: 10px;
              color: rgb(139, 139, 139);
            }
            .over {
              color: black;
              border-color: black;
            }

            .droped {
              background-color: rgba(15, 39, 179, 0.9);
              color: white;
            }

            .drop-zone i {
              font-size: 100px;
            }

            .bar {
              width: 100%;
              background: #eee;
              padding: 3px;
              box-shadow: inset 0px 1px 3px rgba(0, 0, 0, .2);
              box-sizing: border-box;
              border-radius:  5px;
            }

            .bar-fill {
              height: 20px;
              display: block;
              background: cornflowerblue;
              width: 0%;
              border-radius: 4px;
              transition: .8s;
            }

            .bar-fill-text {
              color: rgb(250, 249, 249);
              width: 100%;
              margin:auto;
            }

            .upload-results {
              margin: 10px 20px;
            }

            .result-list {
              position: relative;
            }

            .result-list a {
              float: left;
            }

            .result-list span {
              float: right;
            }

            

  </style>

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">Observation Panel</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0 custom-bar">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger">9+</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-danger">7</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <!-- <i class="fas fa-user-circle fa-fw"></i> -->
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="map.php">
          <i class="fas fa-map-marked-alt"></i>
          <span>Map</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="weather_report.php">
        <i class="fas fa-umbrella"></i>
          <span>Weather Pannel</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="dm_list.php">
        <i class="fas fa-house-damage"></i>
          <span>Disaster Management</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="announcement.php">
        <i class="fas fa-bullhorn"></i>
          <span>Announcement</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Society:</h6>
          <a class="dropdown-item" href="articles.php">Articles</a>
          <a class="dropdown-item" href="404.html">Feedback</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Other Pages:</h6>
          <a class="dropdown-item" href="404.html">Terms and Coditions</a>
          
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mails.php">
        <i class="fas fa-mail-bulk"></i>
          <span>Mail Box</span></a>
      </li>
      
      <div class="user">
          
          <a class="nav-link" href="<?php if($level==4) { echo 'admin_panel.php';} else echo 'user_profile.php'?>" >
            <i class="fas fa-user-circle"></i><br>
            <span><?php if(isset($_SESSION['Username'])) { echo $_SESSION['Username'];} else echo "NO USER"?></span></a>
            <br>
            <small>[  <?php echo $_SESSION['Role']; ?>  ]</small><br>
            <p>Cooperate with us to do better!</p>
          <button data-toggle="modal" data-target="#logoutModal">LOGOUT</button>
          
      </div>
      
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="dm_list.php">Disaster Management</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        
        <!--Main Map panel-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Major Tasks</div>
          <div class="card-body flex-panel">

            <!-- User Profile Settings -->
            <section class="content-area">
              <div class="header">
                <h1>System Details</h1>
                <p>Description is not Available right now.</p>
              </div>
              <div class="cards">
                <div class="col-md-4 inline-card">
                  <div class="card">
                    <div class="user-img"></div>
                    <span class="user-name" id="topic">Name</span>
                    <span class="user-role" id="cat"><small>Category</small></span>
      
                    <hr>
      
                    <div class="col-md-12">
                      <b><span class="user-status">System Status: <span class="secondary-color" id="status">Active</span></span></b>
                    </div>
      
                    <div class="col-md-10 left-text">
                      <span class="user-data">Creator:<span id="create"></span><br>
                      <span class="user-data">Email:<span id="sum"></span></span><br>
                      <span class="user-data">Contact No:<span id="sum"></span></span>
                    </div>
      
                  </div>
                </div>
                
                <div class="col-md-4 inline-card">
                  <div class="card">
                    <h1>Brief</h1>
                    <p id="contain-text">Progress Description</p>
                    
      
                    <div class="col-md-2">
                      <span class="lines"Line 01></span>
                    </div>
      
                    <div class="col-md-2">
                      <span class="lines"Line 01></span>
                      <span class="lines"Line 02></span>
                      <span class="time">Time</span>
                    </div>
      
                  </div>
    
                  <div class="card">
                    <h1>Title</h1>
                    <p>Progress Description</p>
                    <span>[DATE]</span>
      
                    <div class="col-md-2">
                      <span class="lines"Line 01></span>
                    </div>
      
                    <div class="col-md-2">
                      <span class="lines"Line 01></span>
                      <span class="lines"Line 02></span>
                      <span class="time">Time</span>
                    </div>
      
                  </div>
                </div>
    
                <div class="col-md-3 inline-card">
                  <div class="card">
                    <h1>Status List</h1>
                    <p>Progress Description</p>
                    <span>[DATE]</span>
      
                    <div class="col-md-2">
                      <span class="lines"Line 01></span>
                    </div>
      
                    <div class="col-md-10 left-text">
                      <span class="lines">Line 01</span>
                      <span class="lines">Line 02</span>
                      <hr>
                      <span class="lines"><b>Add New   </b><i class="fas fa-plus-circle"></i></span>
                      <span class="time">Time</span>
                    </div>
      
                  </div>
                </div>
                
              </div>
            </section>
            

          </div>
          
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Major Tasks</div>
          <div class="card-body flex-panel">

            <!-- User Profile Settings -->
            <section class="content-area">
              <div class="header">
                <h1>Members'Details</h1>
                <p>Description is not Available right now.</p>
              </div>
              <center>
                <a class="btn btn-dark" id="btn_add" href="#" onclick="groupVindow(getUrlVars()['dms'])">ADD</a>
              </center>
              <div class="cards long-card">
                <div class="col-md-4 inline-card">
                  <div class="card" id="card-lg">
                    <!-- <div class="batch">
                      <div class="user-img"></div>
                      <span class="user-name">VIGO</span><br>
                      <span class="user-role"><small>Role</small></span>
                      <p>Simple Details<br>
                      <p>Contact Information<br>
                      <p>Email address</p>
                      <button class="btn btn-primary">Message</button>
                    </div> -->
  
                  </div>
                </div>
                
                
              </div>
            </section>
            

          </div>
          
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
        
        <!-- Area Chart Example-->
    
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
              Water Level Effect
          </div>
            <div class="card-body flex-panel">  
              <div class="form-sect">

                <div class="input-contain">
                  <h2>Method of System Launch</h2>
                  <p>Select the operational mode of this System.</p>
                  <div class="form-group">
                      <label>Zone</label>
                      <input type="text" id="zone" class="form-control">
                      <span></span>
                      
                  </div>

                  <div class="form-group">
                      <label>Type</label>
                      <select id="cat" class="form-control" >
                        <option value="Emergency">Emergency</option>
                        <option value="Encounter">Encounter</option>
                        <option value="Building">Building</option>
                      </select>
                      <span></span><br>
                      <small class="text-danger" > Enter a valid Username</small>
                  </div>

                  <div class="form-group">
                      <label>Descriptiion</label>
                      <textarea id="desc" class="form-control"></textarea>
                      <span></span>
                      <small class="text-danger" > Password is Invalid</small>
                  </div>


                  <div class="form-group">
                      <button class="btn btn-success"  id="btnmarkerSub" >SUBMIT</button>
                    
                  </div>

              </div>
              
            </div>
            <div class="graph-contain">
              
            </div>

          
        </div>

        
          
        <!-- Time settings -->
          <div class="card-footer small text-muted" >Updated yesterday at 11:59 PM</div>
        </div>

        <div class="card mb-3" id="up-sect">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
              Upload Document
          </div>
          <div class="card-body flex-panel">  
              
              <section class="content-area">
                <div class="header">
                  <h1>Upload Research Documents</h1>
                  <p>Description is not Available right now.</p>
                </div>
                <div class="cards long-card">
                  <div class="col-md-4 inline-card">
                    <div class="card" id="card-lg">
                      
                      <div class="upload-sect">
                        <div class="up-content">
                          <p>Drag into this loaction</p>
                          <form method="POST" action="./php/upload.php" enctype="multipart/form-data">
                            <input type="file" name="files[]" id="upload-file" multiple>
                            <input type="submit" class="btn btn-success" id="upload-btn" value="UPLOAD">
                          </form>
                        </div>
                        
                        <div class="drop-zone">
                          <h3>DROP YOUR FILE HERE!</h3>
                          <p>JPEG, PNG, PDF, DOC are allowed to upload.</p>
                          <i class="fas fa-file-upload"></i>
                        </div>

                        <div class="bar">
                          <div class="bar-fill" id="bar-fill">
                            <div class="bar-fill-text" id="bar-fill-text">0%</div>
                          </div>
                        </div>

                        <div class="upload-results">
                          <h4>Uploaded Files</h4>
                          <div class="result-list">
                            <a href="#"><label>File 01</label></a><span>Successed</span><br><hr>
                            <a href="#"><label>File 01</label></a><span>Successed</span><br><hr>
                          </div>
                        </div>
                        
                        
                      </div>
                    </div>
                  </div>
                  
                  
                </div>
              </section>

          </div>

        
          
        <!-- Time settings -->
          <div class="card-footer small text-muted" >Updated yesterday at 11:59 PM</div>
        </div>

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
              Uploaded Documents
          </div>
          <div class="card-body flex-panel">  
              
              <section class="content-area">
                <div class="header" >
                  <h1>Uploaded Research Documents</h1>
                  <p>You can download following documents!</p>
                </div>
                <div class="cards long-card">
                  <div class="col-md-4 inline-card">
                    <div class="card" id="card-lg">
                      
                      <div class="upload-sect">
                        <div class="upload-results">
                          
                          <div class="result-list" id="docs-list">
                            <!-- <a href="#"><label>File 01</label></a><span>Successed</span><br><hr>
                            <a href="#"><label>File 01</label></a><span>Successed</span><br><hr> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  
                </div>
              </section>

          </div>

        
          
        <!-- Time settings -->
          <div class="card-footer small text-muted" >Updated yesterday at 11:59 PM</div>
        </div>
        
        <!-- Upload Plugin Settings -->
        <script src="./js/ajax/upload.js"></script>
        <script src="./js/plugins/upload_drop.js"></script>

        <!-- Firebase API Settings -->
        <script src="js/firebase/init_fire.js"></script>
        <script src="js/firebase/article_crud.js"></script>
        <script src="js/firebase/dm_crud.js"></script>

        <script>

          var user = "<?php if(isset($_SESSION['Username'])) { echo $_SESSION['Username'];} else echo 'NO USER'?>";

          $('.drop-zone').on("dragenter dragstart dragend dragleave dragover drag drop", function (e) {
              e.preventDefault();
          });

          // Init FireStre
          initFirestore();

          function getUrlVars() {
              var vars = {};
              var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                  vars[key] = value;
              });
              return vars;
          }

          function groupVindow(url){
            window.location.href = "member_choose.html?dms="+url;
          }

          
          
          displayDMFire(getUrlVars()["dms"], user);
          
          setTimeout(displayUser(document.getElementById("create").innerText), 20000);

          displayGroupMembers(getUrlVars()["dms"]);

          showFiles(getUrlVars()["dms"]);

        </script>
      
      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">

          <div class="copyright text-center my-auto">

            <!--display time-->


            <script>
            function startTime() {
              var today = new Date();
              var h = today.getHours();
              var m = today.getMinutes();
              var s = today.getSeconds();
              m = checkTime(m);
              s = checkTime(s);
              document.getElementById('txt').innerHTML =
              h + ":" + m + ":" + s;
              var t = setTimeout(startTime, 500);
            }
            function checkTime(i) {
              if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
              return i;
            }
            </script>


            <body onload="startTime()">

            <div id="txt"></div>


            <span>Copyright © weather alpha</span>
          </div>
        </div>
      </footer>

    </div>


    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
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



  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <!-- <script src="js/demo/chart-area-demo.js"></script> -->

</body>

</html>
