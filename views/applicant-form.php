								<div class="breadcrumbs" id="breadcrumbs">							
								<ul class="breadcrumb">
									<li class="active">Registration Form</li>
								</ul><!-- /.breadcrumb -->
								</div>
									<form id="frmApplicant" name="view.frmApplicant">
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Student ID</label>
													<input type="text" class="form-control" name="student_id" ng-model="applicant.student_id">
												</div>
												<div class="col-md-4">&nbsp;</div>											
												<div class="col-md-4">&nbsp;</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>First name</label>
													<input type="text" class="form-control" name="first_name" ng-model="applicant.first_name">
												</div>
												<div class="col-md-4">
													<label>Middle name</label>
													<input type="text" class="form-control" name="middle_name" ng-model="applicant.middle_name">
												</div>											
												<div class="col-md-4">
													<label>Last name</label>
													<input type="text" class="form-control" name="last_name" ng-model="applicant.last_name">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Gender</label>
													<select class="form-control" name="gender" ng-model="applicant.gender">
														<option value="-">-</option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>
													</select>
												</div>											
												<div class="col-md-4">
													<label>Birthdate</label>
														<div class="input-group">
															<input type="text" name="birthday" id="birthday" class="form-control date-picker" data-date-format="mm/dd/yyyy" value="01/01/2000" ng-mouseout="computeAge()" ng-blur="computeAge()">
															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
														</div>
												</div>
												<div class="col-md-4">
													<label>Age</label>
													<input type="number" class="form-control" name="age" ng-model="applicant.age" ng-focus="computeAge()" ng-blur="computeAge()">
												</div>
											</div>
										</div>										
										<div class="form-group">
											<div class="row">										
												<div class="col-md-6">
													<label>Address</label>
													<input type="text" class="form-control" name="address" ng-model="applicant.address">
												</div>
												<div class="col-md-6">
													<label>Contact</label>
													<input type="text" class="form-control" name="contact_no" ng-model="applicant.contact_no">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">										
												<div class="col-md-6">
													<label>Username</label>
													<input type="text" class="form-control" name="username" ng-model="applicant.username">
												</div>
												<div class="col-md-6">&nbsp;</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">										
												<div class="col-md-6">
													<label>Password</label>
													<input type="password" class="form-control" name="password" ng-model="applicant.password">
												</div>
												<div class="col-md-6">
													<label>Re-type password</label>
													<input type="password" class="form-control" name="re_type_password" ng-model="applicant.re_type_password">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div id="tButtons" class="row">
												<div class="col-md-12">
													<button class="btn btn-success" ng-click="save()">{{views.mode}}</button>
													<button class="btn btn-default" ng-click="cancel()">Cancel</button>
												</div>
											</div>
										</div>
									</form>	