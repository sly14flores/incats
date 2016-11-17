<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Integrated Campus Testing &amp; Scholarship System</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		
		<link rel="stylesheet" href="css/carousel.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		
		<!-- inline styles related to this page -->
		
		<link rel="stylesheet" href="css/style.css">		
		<link rel="icon" href="favicon.ico">

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		
		<style type="text/css">
		
			.main-container, .page-content {
				background-color: #f3fced!important;
			}
			
			.page-content {

			}
			
			.public-dashboard {
				background-color: #fafcf9;
				padding: 25px;
			}
			
			.post {
				margin-bottom: 25px;
			}
		
		</style>
		
	</head>

	<body class="no-skin" ng-app="index" ng-controller="indexCtrl">
		<div id="navbar" class="navbar navbar-default navbar-fixed-top">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">

				<div class="navbar-header pull-left">
					<a href="index.php" class="navbar-brand" style="padding: 0!important;">
						<small>
							<div id="logo-container"><img id="company-logo" src="images/logo.png">Integrated Campus Testing &amp; Scholarship System</div>
						</small>
					</a>
				</div>
				
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue"></li>					
						<li class="light-blue"><a href="javascript:;" ng-click="signup()">Sign Up</a></li>
						<li class="light-blue"><a href="javascript:;" ng-click="login()">Login</a></li>						
					</ul>
				</div>			

			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-content">
				<div class="main-content-inner">
			
			<!-- carousel -->
			<section class="section-white">
			  <div class="container">

				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner">
					<div class="item active">
					  <img src="images/carousel-dmmmsu.jpg" alt="...">
					  <div class="carousel-caption">
						<h2>Heading</h2>
					  </div>
					</div>
					<div class="item">
					  <img src="images/carousel-dmmmsu.jpg" alt="...">
					  <div class="carousel-caption">
						<h2>Heading</h2>
					  </div>
					</div>
				  </div>

				  <!-- Controls -->
				  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				  </a>
				  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				  </a>
				</div>

			  </div>
			</section>
			<!-- end carousel -->			
					
					<div class="page-content">
					
						<div class="container">
						<div class="row">
						
						<div class="col-md-4 col-lg-4">
						
							<h2>List of Scholarship Programs</h2>
							<hr>

							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							  <div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
								  <h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									{{views.program1_key}}
									</a>
								  </h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								  <div class="panel-body">
									<ul>
										<li ng-repeat="(key, value) in views.scholarship_program_select[views.program1_value]">{{key}}</li>									
									</ul>
								  </div>
								</div>
							  </div>
							  <div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingTwo">
								  <h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									{{views.program2_key}}
									</a>
								  </h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
									<ul>
										<li ng-repeat="(key, value) in views.scholarship_program_select[views.program2_value]">{{key}}</li>									
									</ul>
								</div>
							  </div>
							</div>									

										
						</div>
						
						<div class="col-md-8 col-lg-8">
						
							<div class="public-dashboard">
							<div class="post">
							
								<div class="widget-box widget-color-blue ui-sortable-handle" style="opacity: 1;">
									<div class="widget-header">
										<h5 class="widget-title bigger lighter">
											<i class="ace-icon fa fa-table"></i>
											Events
										</h5>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<p class="alert alert-info" ng-repeat="event in events">
												<strong>{{event.heading}}</strong><br>
												{{event.content}}
												<br><small>Posted on: {{event.event_date}}</small>
											</p>
										</div>
									</div>
								</div>						
							
							</div>							
							<div class="post">
							
								<div class="widget-box widget-color-orange ui-sortable-handle" style="opacity: 1;">
									<div class="widget-header">
										<h5 class="widget-title bigger lighter">
											<i class="ace-icon glyphicon glyphicon-list-alt"></i>									
											Announcements
										</h5>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<p class="alert alert-info" ng-repeat="announcement in announcements">
												<strong>{{announcement.heading}}</strong><br>
												{{announcement.content}}
												<br><small>Posted on: {{announcement.announcement_date}}</small>												
											</p>											
										</div>
									</div>
								</div>
								
							</div>
							</div>
							
						</div>
						
						</div>						
						</div><!-- /.row -->						
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">InCaTS</span>
							Integrated Campus Testing &amp; Scholarship System &copy; 2016-2017
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<script src="angularjs/angular.min.js"></script>		
		
		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery.2.1.1.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/jquery.easypiechart.min.js"></script>
		<script src="assets/js/jquery.sparkline.min.js"></script>
		<script src="assets/js/jquery.flot.min.js"></script>
		<script src="assets/js/jquery.flot.pie.min.js"></script>
		<script src="assets/js/jquery.flot.resize.min.js"></script>

		<script src="assets/js/bootbox.min.js"></script>		
		
		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<script src="jquery/jquery.blockUI.js"></script>
		<script src="bootstrap-notify-3.1.3/bootstrap-notify.min.js"></script>
		
		<script src="modules/block-ui.js"></script>
		<script src="modules/bootstrap-notify.js"></script>
		<script src="modules/bootstrap-modal.js"></script>
		<script src="modules/account.js"></script>
		<script src="modules/notifications.js"></script>
		<script src="modules/global.js"></script>
		<script src="modules/dashboard.js"></script>
		
		<script src="controllers/dashboard.js"></script>			
		<script src="controllers/index.js"></script>


	</body>
</html>
