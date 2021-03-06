<?php

require_once 'authentication.php';

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Dashboard - InCaTS</title>

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
		
		<style type="text/css">
			
			.public-dashboard {
				background-color: #fafcf9;
				padding: 25px;
			}
			
			.post {
				margin-bottom: 25px;
			}
			
			.tools button {
				margin-right: 10px;
			}
		
		</style>		
		
	</head>

	<body class="no-skin" ng-app="dashboard" ng-controller="dashboardCtrl" lock-screen>
		<div id="navbar" class="navbar navbar-default navbar-fixed-top">
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
					<a href="dashboard.php" class="navbar-brand" style="padding: 0!important;">
						<small>
							<div id="logo-container"><img id="company-logo" src="images/logo-bak.png">Integrated Campus Testing &amp; Scholarship System<img id="company-logo" src="images/logo.png"></div>
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<li class="green" ng-show="notifications.show" notify-user>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important" ng-show="notifications.showCount">{{notifications.count}}</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									{{notifications.count}} Notification{{notifications.many}}
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">

										<li ng-repeat="notification in notifications.results">
											<a href="javascript:;" ng-click="dismiss(notification.id)">
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
								<li ng-show="privileges.settings">
									<a href="javascript:;" settings>
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

				<ul class="nav nav-list">
					<li class="active">
						<a href="dashboard.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="" ng-show="privileges.testing">
						<a href="testing.php">
							<i class="menu-icon glyphicon glyphicon-book"></i>
							<span class="menu-text"> Testing Result </span>
						</a>

						<b class="arrow"></b>
					</li>					
					<li class="" ng-show="privileges.profile">
						<a href="profile.php">
							<i class="menu-icon glyphicon glyphicon-user"></i>
							<span class="menu-text"> Profile </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="" ng-show="privileges.scholarship">
						<a href="scholarship.php">
							<i class="menu-icon fa fa-certificate"></i>
							<span class="menu-text"> Scholarship </span>
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
							
							<li class="">
								<a href="renewal.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Renewal
								</a>

								<b class="arrow"></b>
							</li>							

						</ul>
					</li>
					<li class="" ng-show="privileges.reports">
						<a href="reports.php">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> Reports </span>
						</a>

						<b class="arrow"></b>
					</li>					
					<li class="" ng-show="privileges.account">
						<a href="accounts.php">
							<i class="menu-icon glyphicon glyphicon-user"></i>
							<span class="menu-text"> Accounts </span>
						</a>

						<b class="arrow"></b>
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
								<i class="ace-icon fa fa-tachometer"></i>
								<a href="#">Dashboard</a>
							</li>
						</ul><!-- /.breadcrumb -->

					</div>

					<div class="page-content">						

						<div class="page-header">
							<h1>
								Dashboard
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									events &amp; announcements
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">							
							<div class="public-dashboard">
							<div class="tools" ng-show="privileges.event_announcement_btns">
								<button class="btn btn-info" add-event>Add Event</button><button class="btn btn-info" add-announcement>Add Announcement</button><button class="btn btn-info" add-memo>Upload Memo</button>
								<hr>
							</div>
							<div class="post" ng-show="privileges.event_announcement_btns" pt-results>
							
								<div class="widget-box ui-sortable-handle" style="opacity: 1;">
									<div class="widget-header">
										<h5 class="widget-title bigger lighter">
											<i class="ace-icon glyphicon glyphicon-list-alt"></i>
											Personality Test Results
										</h5>
									</div>

									<div class="widget-body">
										<div class="widget-main">
										<table id="simple-table" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Student ID</th>
													<th>Fullname</th>
													<!--<th>Rating</th>-->
												</tr>
											</thead>

											<tbody>
												<tr ng-repeat="pt in pts">
													<td>{{pt.student_id}}</td>
													<td>{{pt.full_name}}</td>
													<!--<td>{{pt.rating}}</td>-->
												</tr>												
											</tbody>
										</table>
										</div>
									</div>
								</div>
								
							</div>
							<div class="post" ng-show="privileges.event_announcement_btns" cat-results>
							
								<div class="widget-box ui-sortable-handle" style="opacity: 1;">
									<div class="widget-header">
										<h5 class="widget-title bigger lighter">
											<i class="ace-icon glyphicon glyphicon-list-alt"></i>
											College Aptitude Test Results
										</h5>
									</div>

									<div class="widget-body">
										<div class="widget-main">
										<table id="simple-table" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Student ID</th>
													<th>Fullname</th>
													<th>Rating</th>
												</tr>
											</thead>

											<tbody>
												<tr ng-repeat="cat in cats">
													<td>{{cat.student_id}}</td>
													<td>{{cat.full_name}}</td>
													<td>{{cat.rating}}</td>
												</tr>												
											</tbody>
										</table>
										</div>
									</div>
								</div>
								
							</div>								
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
												<button type="button" class="close" ng-click="delEvent(event.id)" ng-show="privileges.event_announcement_btns">
													<i class="ace-icon fa fa-times"></i>
												</button>												
												<button type="button" class="close" ng-click="editEvent(event.id)" ng-show="privileges.event_announcement_btns" style="margin-right: 5px !important;">
													<i class="ace-icon fa fa-edit"></i>
												</button>
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
												<button type="button" class="close" ng-click="delAnnouncement(announcement.id)" ng-show="privileges.event_announcement_btns">
													<i class="ace-icon fa fa-times"></i>
												</button>												
												<button type="button" class="close" ng-click="editAnnouncement(announcement.id)" ng-show="privileges.event_announcement_btns" style="margin-right: 5px !important;">
													<i class="ace-icon fa fa-edit"></i>
												</button>											
												<strong>{{announcement.heading}}</strong><br>
												{{announcement.content}}
												<br><small>Posted on: {{announcement.announcement_date}}</small>												
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
											Memos
										</h5>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<p class="alert alert-info" ng-repeat="memo in memos">										
												<button type="button" class="close" ng-click="delMemo(memo.id)" ng-show="privileges.event_announcement_btns">
													<i class="ace-icon fa fa-times"></i>
												</button>												
												<button type="button" class="close" ng-click="editMemo(memo.id)" ng-show="privileges.event_announcement_btns" style="margin-right: 5px !important;">
													<i class="ace-icon fa fa-edit"></i>
												</button>					
												<strong>{{memo.title}}</strong><br><br>
												<img src="memos/{{memo.file}}"><br>
												<br><small>Posted on: {{memo.memo_date}}</small>												
											</p>											
										</div>
									</div>
								</div>
								
							</div>							
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
		<script src="modules/account.js"></script>
		<script src="modules/notifications.js"></script>
		<script src="modules/dashboard.js"></script>	
		<script src="modules/lock-screen.js"></script>
		
		<script src="controllers/dashboard.js"></script>		

	</body>
</html>
