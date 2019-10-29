<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>

    <meta charset="utf-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Webpals Test</title>

    <!-- Bootstrap Core CSS -->
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    

    <!-- Custom CSS -->
    <link href="./css/sb-admin-2.css" rel="stylesheet">
 
        
    <!-- DataTables CSS -->
    <link href="./vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="./js/angular.min.js"></script>
    <script src="./js/angular-ui-router.min.js"></script>
   
 </head>

<body ng-controller = "MainCtrl" >

    <div id="wrapper">

            <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">Webpals Test </a>
            </div>
            <!-- /.navbar-header -->

            
              <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse collapse">
                    <ul class="nav" id="side-menu">
                        <li><a><strong>Administrator</strong></a></li>
                        <li><a ui-sref="exams"><i class="fa fa-list-alt fa-fw"></i> Courses</a></li>
                        <li><a ui-sref="students"><i class="fa fa-user fa-fw"></i> Students</a> </li>                         
                         <li>
                            <a href="http://webpals.com"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

           <!-- ***************************      Work Zone /page  ******************************************** -->
        <div id="page-wrapper" ui-view style="padding-top: 10px">
            <br>
          
        </div> <!-- /#page-wrapper -->
       </div>
     <!-- /#wrapper -->
     
     
   
    
    <!-- jQuery -->
    <script src="./vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
 <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.0.0/ui-bootstrap-tpls.min.js"></script>
    

    <!-- Custom Theme JavaScript
    <script src="../js/sb-admin-2.js"></script> -->

    <!-- DataTables JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-datatables/0.6.2/angular-datatables.min.js"></script>
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    
 
 <!-- Metis Menu Plugin JavaScript 
    <script src="./vendor/metisMenu/metisMenu.min.js"></script>-->
    
    <!-- /#angulaJS -->
    
    <!--<script src="/js/angular.min.js"></script> <script src="../js/angular-sanitize.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.8/angular-ui-router.min.js"></script> 
    <script src="./vendor/angular-ui-router.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-utils/0.1.1/angular-ui-utils.min.js "></script>
    -->
    <script src="./vendor/validator.min.js"></script>
   
   
     <!-- main script -->
    <script src="js/app.js"></script>
	<!-- controllers -->
	<script src="js/controllers/usersController.js"></script>
	<script src="js/controllers/examsController.js"></script>
	<script src="js/controllers/gradesController.js"></script>
	
	<!-- services -->
	<script src="js/services/examService.js"></script>
	<script src="js/services/userService.js"></script>
	<script src="js/services/gradeService.js"></script>
	<script src="js/services/globalService.js"></script>
   
    
   
<!-- services -->
    <script>
    $(document).ready(function() {
        $('#dataTables-all').DataTable({
            responsive: true
        });
         $('#dataTables-text').DataTable({
            responsive: true
        });
         $('#dataTables-images').DataTable({
            responsive: true
        });
          $('#dataTables-pages').DataTable({
            responsive: true
        });
    });
    </script>

    
</body>

</html>
