<?php

require_once 'authentication.php';

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Profile - InCaTS</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />

		<link rel="stylesheet" href="assets/css/datepicker.min.css" />		
		
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

	<body class="no-skin" ng-app="profile" ng-controller="profileCtrl">
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.php" class="navbar-brand" style="padding: 0!important;">
						<small>
							<div id="logo-container"><img id="company-logo" src="images/logo.png">Integrated Campus Testing &amp; Scholarship System</div>
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<li class="green" ng-show="notifications.show" notify-user>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important">{{notifications.count}}</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									{{notifications.count}} Notification{{notifications.many}}
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">

										<li ng-repeat="notification in notifications.results">
											<a href="#">
												<i class="btn btn-xs btn-primary fa fa-user"></i>
												{{notification.content}}
											</a>
										</li>

									</ul>
								</li>

							</ul>
						</li>

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<!--<img class="nav-user-photo" src="assets/avatars/avatar2.png" alt="Profile Photo" />-->
								<span class="user-info">
									<small>Welcome,</small>
									{{account.name}}
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="javascript:;" logout-account>
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>
				
				<!--
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="">
						<a href="index.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="active" ng-show="privileges.profile">
						<a href="profile.php">
							<i class="menu-icon glyphicon glyphicon-user"></i>
							<span class="menu-text"> Profile </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="" ng-show="privileges.scholarship_services">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-certificate"></i>
							<span class="menu-text">
								Scholarship Services
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">

							<li class="">
								<a href="applicants.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Applicants
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="grantees.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Scholarship Grantees
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>

				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li class="active">
								<i class="ace-icon glyphicon glyphicon-user"></i>
								<a href="#">Profile</a>
							</li>
						</ul><!-- /.breadcrumb -->

					</div>

					<div class="page-content">						

						<div class="page-header">
							<h1>
								Profile
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									manage profile
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							
								<div class="space-4"></div>
								
								<form class="form-horizontal">
									<div class="tabbable">
										<ul class="nav nav-tabs padding-16">
											<li class="active">
												<a data-toggle="tab" href="#edit-basic">
													<i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
													Basic Info
												</a>
											</li>

											<li>
												<a data-toggle="tab" href="#edit-password">
													<i class="blue ace-icon fa fa-key bigger-125"></i>
													Account Info
												</a>
											</li>
										</ul>

										<div class="tab-content profile-edit-tab-content">
											<div id="edit-basic" class="tab-pane in active">
												<h4 class="header blue bolder smaller">General</h4>

												<div class="row">

													<div class="vspace-12-sm"></div>

													<div class="col-xs-12 col-sm-8">		
														<div class="form-group has-error">
															<label class="col-sm-4 control-label no-padding-right">School ID</label>

															<div class="col-sm-8">
																<input class="col-xs-6 col-sm-6 col-md-8" type="text">
																<div class="help-block inline" style="margin-left: 5px;"> School ID is required </div>																															
															</div>															
														</div>

														<div class="space-4"></div>

														<div class="form-group">
															<label class="col-sm-4 control-label no-padding-right">Name</label>

															<div class="col-sm-8">
																<input class="input-small" type="text" placeholder="First">
																<input class="input-small" type="text" placeholder="Middle">
																<input class="input-small" type="text" placeholder="Last">
															</div>
														</div>
													</div>
												</div>

												<hr />
												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right">Gender</label>

													<div class="col-sm-9">
														<label class="inline">
															<input name="form-field-radio" type="radio" class="ace" />
															<span class="lbl middle"> Male</span>
														</label>

														&nbsp; &nbsp; &nbsp;
														<label class="inline">
															<input name="form-field-radio" type="radio" class="ace" />
															<span class="lbl middle"> Female</span>
														</label>
													</div>
												</div>												
												
												<div class="space-4"></div>
												
												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right" for="form-field-date">Birth Date</label>

													<div class="col-sm-9">
														<div class="input-medium">
															<div class="input-group">
																<input class="input-medium date-picker" id="birthday" type="text" data-date-format="mm/dd/yyyy" value="01/01/2000">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-calendar"></i>
																</span>
															</div>															
														</div>
													</div>
												</div>

												<div class="space-4"></div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right">Age</label>
													<div class="col-sm-4">
														<input class="col-xs-6 col-sm-6 col-md-8" type="text">
													</div>
												</div>
												
												<div class="space"></div>
												<h4 class="header blue bolder smaller">Contact</h4>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right">Address</label>

													<div class="col-sm-9">
														<span class="input-icon input-icon-right">
															<textarea style="width: 190px; height: 100px;"></textarea>
														</span>
													</div>
												</div>												
												
												<div class="space-4"></div>												
												
												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right">Email</label>

													<div class="col-sm-9">
														<span class="input-icon input-icon-right">
															<input type="email">
														</span>
													</div>
												</div>
												
												<div class="space-4"></div>												
												
												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right">Contact No</label>

													<div class="col-sm-9">
														<span class="input-icon input-icon-right">
															<input type="text">
														</span>
													</div>
												</div>												

											</div>

											<div id="edit-password" class="tab-pane">
												<div class="space-10"></div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right">Username</label>

													<div class="col-sm-9">
														<input type="text">
													</div>
												</div>												
												
												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right">Password</label>

													<div class="col-sm-9">
														<input type="password">
													</div>
												</div>

												<div class="space-4"></div>

												<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right">Re-type Password</label>

													<div class="col-sm-9">
														<input type="password">
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-xs-offset-10 col-xs-9 col-sm-offset-10 col-sm-9 col-md-offset-10 col-md-9">
											<button class="btn btn-info" type="button">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Update
											</button>
										</div>
									</div>
								</form>
							
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
		
		<script src="assets/js/bootstrap-datepicker.min.js"></script>		
		
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
		
		<script src="controllers/profile.js"></script>		

	</body>
</html>
