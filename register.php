<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Registration - InCaTS</title>

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
	</head>

	<body class="no-skin" ng-app="registration" ng-controller="registrationCtrl">
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">

				<div class="navbar-header pull-left">
					<a href="index.php" class="navbar-brand" style="padding: 0!important;">
						<small>
							<div id="logo-container"><img id="company-logo" src="images/logo-bak.png">Integrated Campus Testing &amp; Scholarship System<img id="company-logo" src="images/logo.png"></div>
						</small>
					</a>
				</div>
				
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
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
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li class="active">
								<i class="ace-icon glyphicon glyphicon-user"></i>
								<a href="register.php">Registration</a>
							</li>
						</ul><!-- /.breadcrumb -->

					</div>

					<div class="page-content" style="margin-top: 30px;">

						<div class="row">
							<div class="col-xs-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">								
							<div class="well well-lg">	
								<form id="frmRegistration" name="views.frmRegistration" novalidate>										
									<div class="form-group">
										<div class="row">
											<div ng-class="{'col-md-4':true, 'has-error': views.frmRegistration.first_name.$touched && views.frmRegistration.first_name.$invalid}">
												<label>First name</label>
												<input type="text" class="form-control" name="first_name" ng-model="applicant.first_name" required>
												<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmRegistration.first_name.$touched && views.frmRegistration.first_name.$invalid"> First name is required </div>
											</div>
											<div ng-class="{'col-md-4':true, 'has-error': views.frmRegistration.middle_name.$touched && views.frmRegistration.middle_name.$invalid}">
												<label>Middle name</label>
												<input type="text" class="form-control" name="middle_name" ng-model="applicant.middle_name" required>
												<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmRegistration.middle_name.$touched && views.frmRegistration.middle_name.$invalid"> Middle name is required </div>
											</div>											
											<div ng-class="{'col-md-4':true, 'has-error': views.frmRegistration.last_name.$touched && views.frmRegistration.last_name.$invalid}">
												<label>Last name</label>
												<input type="text" class="form-control" name="last_name" ng-model="applicant.last_name" required>
												<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmRegistration.last_name.$touched && views.frmRegistration.last_name.$invalid"> Last name is required </div>
											</div>											
										</div>
									</div>									
									<div class="form-group">
										<div class="row">
											<div ng-class="{'col-md-6':true, 'has-error': views.frmRegistration.email.$touched && views.frmRegistration.email.$invalid}">
												<label>Email</label>
												<input type="email" class="form-control" name="email" ng-model="applicant.email" required>
												<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmRegistration.email.$touched && views.frmRegistration.email.$invalid"> Email is required </div>
											</div>
											<div ng-class="{'col-md-6':true, 'has-error': views.frmRegistration.username.$touched && views.frmRegistration.username.$invalid}">
												<label>Username</label>
												<input type="text" class="form-control" name="username" ng-model="applicant.username" required>
												<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmRegistration.username.$touched && views.frmRegistration.username.$invalid"> Username is required </div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">										
											<div ng-class="{'col-md-6':true, 'has-error': views.frmRegistration.password.$touched && views.frmRegistration.password.$invalid}">
												<label>Password</label>
												<input type="password" class="form-control" name="password" ng-model="applicant.password" required>
												<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmRegistration.password.$touched && views.frmRegistration.password.$invalid"> Password is required </div>
											</div>
											<div ng-class="{'col-md-6':true, 'has-error': views.frmRegistration.re_type_password.$touched && views.frmRegistration.re_type_password.$invalid}">
												<label>Re-type password</label>
												<input type="password" class="form-control" name="re_type_password" ng-model="applicant.re_type_password" required>
												<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmRegistration.re_type_password.$touched && views.frmRegistration.re_type_password.$invalid"> Please re-type password </div>
											</div>
										</div>
									</div>								
									<div class="form-group">
										<div id="tButtons" class="row">
											<div class="col-md-12">
												<button class="btn btn-success pull-right" ng-click="submit()">Submit</button>
											</div>
										</div>
									</div>									
								</form>
							</div>
							</div><!-- /.col -->
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
		
		<script src="controllers/register.js"></script>		

	</body>
</html>
