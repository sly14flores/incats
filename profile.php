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

	<body class="no-skin" ng-app="profile" ng-controller="profileCtrl" lock-screen>
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
						<a href="dashboard.php">
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
								
								<form class="form-horizontal" id="frmApplicant" name="views.frmApplicant" novalidate>
									<div class="tabbable">
										<ul class="nav nav-tabs padding-16">
											<li class="active">
												<a data-toggle="tab" href="#edit-basic">
													<i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
													Basic Info
												</a>
											</li>
											<!--<li>
												<a data-toggle="tab" href="#edit-scholarship">
													<i class="green ace-icon fa fa-certificate bigger-125"></i>
													Scholarship
												</a>
											</li>-->
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
														<div ng-class="{'form-group': true, 'has-error': (views.frmApplicant.first_name.$touched && views.frmApplicant.first_name.$invalid) || (views.frmApplicant.middle_name.$touched && views.frmApplicant.middle_name.$invalid) || (views.frmApplicant.last_name.$touched && views.frmApplicant.last_name.$invalid)}">
															<label class="col-sm-4 control-label no-padding-right">Name</label>

															<div class="col-sm-8">
																<input class="input-small" type="text" placeholder="First" name="first_name" ng-model="perinfo.first_name" required>
																<input class="input-small" type="text" placeholder="Middle" name="middle_name" ng-model="perinfo.middle_name" required>
																<input class="input-small" type="text" placeholder="Last" name="last_name" ng-model="perinfo.last_name" required>
																<div class="help-block inline" style="margin-left: 5px;" ng-show="(views.frmApplicant.first_name.$touched && views.frmApplicant.first_name.$invalid) || (views.frmApplicant.middle_name.$touched && views.frmApplicant.middle_name.$invalid) || (views.frmApplicant.last_name.$touched && views.frmApplicant.last_name.$invalid)"> Full name is required </div>
															</div>
														</div>

														<div class="space-4"></div>

														<div ng-class="{'form-group': true, 'has-error': views.frmApplicant.student_id.$touched && views.frmApplicant.student_id.$invalid}">
															<label class="col-sm-4 control-label no-padding-right">Student ID</label>

															<div class="col-sm-8">
																<input class="col-xs-6 col-sm-6 col-md-8" type="text" name="student_id" ng-model="perinfo.student_id" required>
																<div class="help-block inline" style="margin-left: 5px;" ng-show="views.frmApplicant.student_id.$touched && views.frmApplicant.student_id.$invalid"> Student ID is required </div>
															</div>															
														</div>
														
														<div class="form-group">
															<label class="col-sm-4 control-label no-padding-right">Course/Year</label>
															<div class="col-sm-8">
																<input class="col-xs-6 col-sm-6 col-md-8" type="text" name="course_year" ng-model="scholarinfo.course_year">
															</div>															
														</div>
														
														<div class="form-group">
															<label class="col-sm-4 control-label no-padding-right">Name of last School attended</label>
															<div class="col-sm-8">
																<input class="col-xs-6 col-sm-6 col-md-8" type="text" name="last_school" ng-model="scholarinfo.last_school">
															</div>															
														</div>
														
														<div class="form-group">
															<label class="col-sm-4 control-label no-padding-right">Classification of School</label>
															<div class="col-sm-8">
																<input class="col-xs-6 col-sm-6 col-md-8" type="text" name="school_class" ng-model="scholarinfo.school_class">
															</div>															
														</div>														
														
														<div class="form-group">
															<label class="col-sm-4 control-label no-padding-right">General Weighted Average</label>
															<div class="col-sm-8">
																<input class="col-xs-6 col-sm-6 col-md-8" type="text" name="gwa" ng-model="scholarinfo.gwa">
															</div>															
														</div>														
														
														<div class="form-group">
															<label class="col-sm-4 control-label no-padding-right">Year of last School Attended</label>
															<div class="col-sm-8">
																<input class="col-xs-6 col-sm-6 col-md-8" type="text" name="last_school_year" ng-model="scholarinfo.last_school_year">
															</div>															
														</div>														

													</div>
												</div>

												<hr />
												
												<div ng-class="{'form-group': true, 'has-error': views.frmApplicant.gender.$invalid}">
													<label class="col-sm-3 control-label no-padding-right">Gender</label>

													<div class="col-sm-9">
														<label class="inline">
															<input type="radio" value="Male" class="ace" name="gender" ng-model="perinfo.gender" required>
															<span class="lbl middle"> Male</span>
														</label>

														&nbsp; &nbsp; &nbsp;
														<label class="inline">
															<input type="radio" value="Female" class="ace" name="gender" ng-model="perinfo.gender" required>
															<span class="lbl middle"> Female</span>
														</label>
														<div class="help-block inline" style="margin-left: 5px;" ng-show="views.frmApplicant.gender.$invalid"> Gender is required </div>
													</div>
												</div>												
												
												<div class="space-4"></div>
												
												<div ng-class="{'form-group': true, 'has-error': validation.birthday}">
													<label class="col-sm-3 control-label no-padding-right" for="form-field-date">Birth Date</label>

													<div class="col-sm-9">
														<div class="input-medium">
															<div class="input-group">
																<input class="input-medium date-picker" id="birthday" name="birthdate" type="text" data-date-format="mm/dd/yyyy">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-calendar"></i>
																</span>																
															</div>
															<div class="help-block inline" style="margin-left: 5px;" ng-show="validation.birthday"> Birthday is required </div>
														</div>
													</div>
												</div>

												<div class="space-4"></div>

												<div ng-class="{'form-group': true, 'has-error': views.frmApplicant.age.$touched && views.frmApplicant.age.$invalid}">
													<label class="col-sm-3 control-label no-padding-right">Age</label>
													<div class="col-sm-4">
														<input class="col-xs-6 col-sm-6 col-md-8" type="text" name="age" ng-model="perinfo.age" ng-click="computeAge('age')" required>
														<div class="help-block inline" style="margin-left: 5px;" ng-show="views.frmApplicant.age.$touched && views.frmApplicant.age.$invalid"> Age is required </div>
													</div>
												</div>

												<hr />												
												
												<div class="row">
													<div class="vspace-12-sm"></div>
													<div class="col-xs-12 col-sm-8">													
														<div class="form-group">
															<label class="col-sm-4 control-label no-padding-right">Religion</label>
															<div class="col-sm-8">
																<input class="col-xs-6 col-sm-6 col-md-8" type="text" name="religion" ng-model="scholarinfo.religion">
															</div>															
														</div>
														<div class="form-group">
															<label class="col-sm-4 control-label no-padding-right">Tribal Affiliation</label>
															<div class="col-sm-8">
																<input class="col-xs-6 col-sm-6 col-md-8" type="text" name="tribal" ng-model="scholarinfo.tribal">
															</div>															
														</div>
														<div class="form-group">
															<label class="col-sm-4 control-label no-padding-right">Civil Status</label>
															<div class="col-sm-8">
																<select class="col-xs-6 col-sm-6 col-md-8" name="civil_status" ng-model="scholarinfo.civil_status">
																	<option value="">-</option>																	
																	<option value="Single">Single</option>																	
																	<option value="Married">Married</option>																	
																</select>
															</div>															
														</div>
														<div class="form-group">
															<label class="col-sm-4 control-label no-padding-right">If married, Name of Spouse</label>
															<div class="col-sm-8">
																<input class="col-xs-6 col-sm-6 col-md-8" type="text" name="spouse" ng-model="scholarinfo.spouse">
															</div>															
														</div>														
													</div>
												</div>												
												
							
												<div class="space"></div>
												<h4 class="header blue bolder smaller">Contact</h4>

												<div ng-class="{'form-group': true, 'has-error': views.frmApplicant.address.$touched && views.frmApplicant.address.$invalid}">
													<label class="col-sm-3 control-label no-padding-right">Address</label>

													<div class="col-sm-9">
														<span class="input-icon input-icon-right">
															<textarea style="width: 190px; height: 100px;" name="address" ng-model="perinfo.address" required></textarea>
														</span>
														<div class="help-block inline" style="margin-left: 5px;" ng-show="views.frmApplicant.address.$touched && views.frmApplicant.address.$invalid"> Address is required </div>
													</div>
												</div>												
												
												<div class="space-4"></div>												
												
												<div ng-class="{'form-group': true, 'has-error': views.frmApplicant.email.$touched && views.frmApplicant.email.$invalid}">
													<label class="col-sm-3 control-label no-padding-right">Email</label>

													<div class="col-sm-9">
														<span class="input-icon input-icon-right">
															<input type="email" name="email" ng-model="perinfo.email" required>
															<div class="help-block inline" style="margin-left: 5px;" ng-show="views.frmApplicant.email.$touched && views.frmApplicant.email.$invalid"> Email is required </div>
														</span>
													</div>
												</div>
												
												<div class="space-4"></div>												
												
												<div ng-class="{'form-group': true, 'has-error': views.frmApplicant.contact_no.$touched && views.frmApplicant.contact_no.$invalid}">
													<label class="col-sm-3 control-label no-padding-right">Contact No</label>

													<div class="col-sm-9">
														<span class="input-icon input-icon-right">
															<input type="text" name="contact_no" ng-model="perinfo.contact_no" required>
															<div class="help-block inline" style="margin-left: 5px;" ng-show="views.frmApplicant.contact_no.$touched && views.frmApplicant.contact_no.$invalid"> Contact no is required </div>
														</span>
													</div>
												</div>
												
												<div class="space"></div>
												<div class="space"></div>
												<h4 class="header blue bolder smaller">Family Demographic Characteristics</h4>												
												
												<h5 class="bolder smaller">a. Parents Educational and Economic Background</h5>
												<div class="space"></div>												
												
												<div class="row">
													<div class="vspace-12-sm"></div>
													<div class="col-xs-12 col-sm-12">
													
														<div class="form-group">
															<label class="col-md-2 control-label no-padding-right">Mother</label>
															<div class="col-md-10">
																<input class="input-large" type="text" placeholder="Name" name="mother_name" ng-model="scholarinfo.mother_name">
																<input class="input-large date-picker" type="text" id="mother_bday" name="mother_bday" placeholder="Birthdate" data-date-format="mm/dd/yyyy" ng-model="scholarinfo.mother_bday">																
																<input class="input-large" type="text" placeholder="Age" name="mother_age" ng-model="scholarinfo.mother_age" ng-click="computeAge('mother')" ng-model="scholarinfo.mother_age">
															</div>															
														</div>
		
														<div class="form-group">
															<label class="col-md-2 control-label no-padding-right">&nbsp;</label>
															<div class="col-md-10">
																<input class="input-large" type="text" placeholder="Highest Educational Attainment" name="mother_education" ng-model="scholarinfo.mother_education">
																<input class="input-large" type="text" placeholder="Occupation" name="mother_occupation" ng-model="scholarinfo.mother_occupation">
															</div>															
														</div>
														
														<div class="form-group">
															<label class="col-md-2 control-label no-padding-right">&nbsp;</label>
															<div class="col-md-10">
																<input class="input-large" type="text" placeholder="Annual Income" name="mother_income" ng-model="scholarinfo.mother_income">
																<input class="input-large" type="text" placeholder="Contact No" name="mother_contact" ng-model="scholarinfo.mother_contact">
															</div>															
														</div>														
		
														<div class="space"></div>		
														<div class="space"></div>		
		
														<div class="form-group">
															<label class="col-md-2 control-label no-padding-right">Father</label>
															<div class="col-md-10">
																<input class="input-large" type="text" placeholder="Name" name="father_name" ng-model="scholarinfo.father_name">
																<input class="input-large date-picker" type="text" id="father_bday" name="father_bday" placeholder="Birthdate" data-date-format="mm/dd/yyyy" ng-model="scholarinfo.father_bday">
																<input class="input-large" type="text" placeholder="Age" name="father_age" ng-model="scholarinfo.father_age" ng-click="computeAge('father')" ng-model="scholarinfo.father_age">
															</div>															
														</div>		
														
														<div class="form-group">
															<label class="col-md-2 control-label no-padding-right">&nbsp;</label>
															<div class="col-md-10">
																<input class="input-large" type="text" placeholder="Highest Educational Attainment"name="father_education" ng-model="scholarinfo.father_education">
																<input class="input-large" type="text" placeholder="Occupation"name="father_occupation" ng-model="scholarinfo.father_occupation">
															</div>															
														</div>
														
														<div class="form-group">
															<label class="col-md-2 control-label no-padding-right">&nbsp;</label>
															<div class="col-md-10">
																<input class="input-large" type="text" placeholder="Annual Income" name="father_income" ng-model="scholarinfo.father_income">
																<input class="input-large" type="text" placeholder="Contact No" name="father_contact" ng-model="scholarinfo.father_contact">
															</div>															
														</div>														
														
													</div>
												</div>				
												
												<h5 class="bolder smaller">b. Siblings (Brothers &amp; Sisters) Educational and Economic Background</h5>
												<div class="space"></div>													

													<div class="col-lg-3">
													<label>Name</label>
													<input type="text" class="form-control" name="sibling_name" ng-model="views.sibling.sibling_name">
													</div>
													<div class="col-lg-1">
													<label>Age</label>
													<input type="text" class="form-control" name="sibling_age" ng-model="views.sibling.sibling_age">
													</div>													
													<div class="col-lg-3">
													<label>Grade/Year level Completed</label>
													<input type="text" class="form-control" name="sibling_grade" ng-model="views.sibling.sibling_grade">
													</div>
													<div class="col-lg-3">
													<label>Occupation</label>
													<input type="text" class="form-control" name="sibling_occupation" ng-model="views.sibling.sibling_occupation">
													</div>
													<div class="col-lg-2">			
													<button style="margin-top: 26px;" type="button" class="btn btn-sm btn-primary" ng-click="addSibling()">Add</button>
													</div>
													
													<div class="container">
													<div class="row">
													<div class="col-lg-9 col-md-9">
													<table style="margin-top: 25px!important;" id="simple-table" class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>Name</th>
																<th>Age</th>
																<th>Grade/Year level Completed</th>
																<th>Occupation</th>
																<th>&nbsp;</th>
															</tr>
														</thead>
														<tbody>
															<tr ng-repeat="sibling in siblings">
																<td>{{sibling.sibling_name}}</td>
																<td>{{sibling.sibling_age}}</td>
																<td>{{sibling.sibling_grade}}</td>
																<td>{{sibling.sibling_occupation}}</td>
																<td><a class="red" href="javascript:;" ng-click="delSibling(sibling)"><i class="ace-icon glyphicon glyphicon-remove"></i></a></td>
															</tr>												
														</tbody>
													</table>
													</div>
													</div>
													</div>
													
												<div class="form-group">
													<div class="col-sm-12 col-md-3 col-lg-3 col-md-offset-9 col-lg-offset-9">
														<button style="margin-top: 50px;" class="btn btn-sm btn-info" type="button" ng-click="updatePerInfo()">
															<i class="ace-icon fa fa-check bigger-110"></i>
															Update
														</button>
													</div>
												</div>
												<div class="space-4"></div>
											</div>

											<!--<div id="edit-scholarship" class="tab-pane">
												
												<div id="scholarship-content" ng-include="activeTemplate"></div>
												
											</div>-->
											
											<div id="edit-password" class="tab-pane">
												<div class="space-10"></div>

												<div ng-class="{'form-group': true, 'has-error': views.frmApplicant.username.$touched && views.frmApplicant.username.$invalid}">
													<label class="col-sm-3 control-label no-padding-right">Username</label>

													<div class="col-sm-9">
														<input type="text" name="username" ng-model="accinfo.username" required>
														<div class="help-block inline" style="margin-left: 5px;" ng-show="views.frmApplicant.username.$touched && views.frmApplicant.username.$invalid"> Username is required </div>
													</div>
												</div>												
												
												<div ng-class="{'form-group': true, 'has-error': views.frmApplicant.password.$touched && views.frmApplicant.password.$invalid}">
													<label class="col-sm-3 control-label no-padding-right">Password</label>

													<div class="col-sm-9">
														<input type="password" name="password" ng-model="accinfo.password" required>
														<div class="help-block inline" style="margin-left: 5px;" ng-show="views.frmApplicant.password.$touched && views.frmApplicant.password.$invalid"> Password is required </div>
													</div>
												</div>

												<div class="space-4"></div>

												<div ng-class="{'form-group': true, 'has-error': views.frmApplicant.re_type_password.$touched && views.frmApplicant.re_type_password.$invalid}">
													<label class="col-sm-3 control-label no-padding-right">Re-type Password</label>

													<div class="col-sm-9">
														<input type="password" name="re_type_password" ng-model="accinfo.re_type_password" required>
														<div class="help-block inline" style="margin-left: 5px;" ng-show="views.frmApplicant.re_type_password.$touched && views.frmApplicant.re_type_password.$invalid"> Please re-type password </div>
													</div>
												</div>
												<div class="space-8"></div>
												<div class="form-group">
													<div class="col-sm-12 col-md-12 col-lg-12 col-md-offset-8 col-lg-offset-8">
														<button class="btn btn-sm btn-info" type="button" ng-click="updateAccInfo()">
															<i class="ace-icon fa fa-check bigger-110"></i>
															Update
														</button>
													</div>
												</div>
												<div class="space-4"></div>												
											</div>
										</div>
									</div>

									<div class="clearfix form-actions"></div>
									
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
		<!-- page specific plugin scripts -->
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="assets/js/dataTables.tableTools.min.js"></script>
		<script src="assets/js/dataTables.colVis.min.js"></script>			

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
		
		<script src="modules/global.js"></script>		
		<script src="modules/block-ui.js"></script>
		<script src="modules/bootstrap-notify.js"></script>
		<script src="modules/bootstrap-modal.js"></script>
		<script src="modules/account.js"></script>
		<script src="modules/notifications.js"></script>
		<script src="modules/lock-screen.js"></script>		
		
		<script src="controllers/profile.js"></script>		

	</body>
</html>
