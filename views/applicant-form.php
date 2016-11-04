								<div class="breadcrumbs" id="breadcrumbs">							
								<ul class="breadcrumb">
									<li class="active">Registration Form</li>
								</ul><!-- /.breadcrumb -->
								</div>
									<form id="frmApplicant" name="views.frmApplicant" novalidate>
										<div class="form-group">
											<div class="row">
												<div ng-class="{'col-md-4':true, 'has-error': views.frmApplicant.student_id.$touched && views.frmApplicant.student_id.$invalid}">
													<label>Student ID</label>
													<input type="text" class="form-control" name="student_id" ng-model="applicant.student_id" required>
													<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmApplicant.student_id.$touched && views.frmApplicant.student_id.$invalid"> Student ID is required </div>
												</div>
												<div class="col-md-4">&nbsp;</div>											
												<div class="col-md-4">&nbsp;</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div ng-class="{'col-md-4':true, 'has-error': views.frmApplicant.first_name.$touched && views.frmApplicant.first_name.$invalid}">
													<label>First name</label>
													<input type="text" class="form-control" name="first_name" ng-model="applicant.first_name" required>
													<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmApplicant.first_name.$touched && views.frmApplicant.first_name.$invalid"> First name is required </div>
												</div>
												<div ng-class="{'col-md-4':true, 'has-error': views.frmApplicant.middle_name.$touched && views.frmApplicant.middle_name.$invalid}">
													<label>Middle name</label>
													<input type="text" class="form-control" name="middle_name" ng-model="applicant.middle_name" required>
													<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmApplicant.middle_name.$touched && views.frmApplicant.middle_name.$invalid"> Middle name is required </div>
												</div>											
												<div ng-class="{'col-md-4':true, 'has-error': views.frmApplicant.last_name.$touched && views.frmApplicant.last_name.$invalid}">
													<label>Last name</label>
													<input type="text" class="form-control" name="last_name" ng-model="applicant.last_name" required>
													<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmApplicant.last_name.$touched && views.frmApplicant.last_name.$invalid"> Last name is required </div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div ng-class="{'col-md-4':true, 'has-error': views.frmApplicant.gender.$touched && views.frmApplicant.gender.$invalid}">
													<label>Gender</label>
													<select class="form-control" name="gender" ng-model="applicant.gender" required>
														<option value="">-</option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>
													</select>
													<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmApplicant.gender.$touched && views.frmApplicant.gender.$invalid"> Gender is required </div>
												</div>											
												<div ng-class="{'col-md-4':true, 'has-error': validation.birthday}">
													<label>Birthdate</label>
														<div class="input-group">
															<input type="text" name="birthday" id="birthday" class="form-control date-picker" data-date-format="mm/dd/yyyy" value="01/01/2000" ng-mouseout="computeAge()">
															<span class="input-group-addon">
																<i class="fa fa-calendar bigger-110"></i>
															</span>
														</div>
														<div class="help-block col-xs-12 col-sm-reset inline" ng-show="validation.birthday"> Birthdate is required </div>
												</div>
												<div ng-class="{'col-md-4':true, 'has-error': validation.age}">
													<label>Age</label>
													<input type="number" class="form-control" name="age" id="age" ng-model="applicant.age" ng-focus="computeAge()" ng-blur="computeAge()" required>
													<div class="help-block col-xs-12 col-sm-reset inline" ng-show="validation.age"> Age is required </div>
												</div>
											</div>
										</div>										
										<div class="form-group">
											<div class="row">										
												<div ng-class="{'col-md-6':true, 'has-error': views.frmApplicant.address.$touched && views.frmApplicant.address.$invalid}">
													<label>Address</label>
													<input type="text" class="form-control" name="address" ng-model="applicant.address" required>
													<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmApplicant.address.$touched && views.frmApplicant.address.$invalid"> Address is required </div>
												</div>
												<div ng-class="{'col-md-6':true, 'has-error': views.frmApplicant.contact_no.$touched && views.frmApplicant.contact_no.$invalid}">
													<label>Contact No</label>
													<input type="text" class="form-control" name="contact_no" ng-model="applicant.contact_no" required>
													<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmApplicant.contact_no.$touched && views.frmApplicant.contact_no.$invalid"> Contact no is required </div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">										
												<div ng-class="{'col-md-6':true, 'has-error': views.frmApplicant.username.$touched && views.frmApplicant.username.$invalid}">
													<label>Username</label>
													<input type="text" class="form-control" name="username" ng-model="applicant.username" required>
													<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmApplicant.username.$touched && views.frmApplicant.username.$invalid"> Username is required </div>
												</div>
												<div class="col-md-6">&nbsp;</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">										
												<div ng-class="{'col-md-6':true, 'has-error': views.frmApplicant.password.$touched && views.frmApplicant.password.$invalid}">
													<label>Password</label>
													<input type="password" class="form-control" name="password" ng-model="applicant.password" ng-blur="validatePassword()" required>
													<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmApplicant.password.$touched && views.frmApplicant.password.$invalid"> Password is required </div>
												</div>
												<div ng-class="{'col-md-6':true, 'has-error': views.frmApplicant.re_type_password.$touched && views.frmApplicant.re_type_password.$invalid}">
													<label>Re-type password</label>
													<input type="password" class="form-control" name="re_type_password" ng-model="applicant.re_type_password" ng-blur="validatePassword()" required>
													<div class="help-block col-xs-12 col-sm-reset inline" ng-show="views.frmApplicant.re_type_password.$touched && views.frmApplicant.re_type_password.$invalid"> Please re-type password </div>
												</div>
											</div>
										</div>
										<div class="form-group" ng-show="validation.password">
											<div class="row">
												<div class="col-md-6"><div class="alert alert-danger">Password does not match</div></div>
												<div class="col-md-6">&nbsp;</div>												
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