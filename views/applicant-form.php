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
			<li>
				<a data-toggle="tab" href="#edit-scholarship">
					<i class="green ace-icon fa fa-certificate bigger-125"></i>
					Scholarship
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
						<div ng-class="{'form-group': true, 'has-error': views.frmApplicant.student_id.$touched && views.frmApplicant.student_id.$invalid}">
							<label class="col-sm-4 control-label no-padding-right">Student ID</label>

							<div class="col-sm-8">
								<input class="col-xs-6 col-sm-6 col-md-8" type="text" name="student_id" ng-model="perinfo.student_id" required>
								<div class="help-block inline" style="margin-left: 5px;" ng-show="views.frmApplicant.student_id.$touched && views.frmApplicant.student_id.$invalid"> Student ID is required </div>
							</div>															
						</div>

						<div class="space-4"></div>

						<div ng-class="{'form-group': true, 'has-error': (views.frmApplicant.first_name.$touched && views.frmApplicant.first_name.$invalid) || (views.frmApplicant.middle_name.$touched && views.frmApplicant.middle_name.$invalid) || (views.frmApplicant.last_name.$touched && views.frmApplicant.last_name.$invalid)}">
							<label class="col-sm-4 control-label no-padding-right">Name</label>

							<div class="col-sm-8">
								<input class="input-small" type="text" placeholder="First" name="first_name" ng-model="perinfo.first_name" required>
								<input class="input-small" type="text" placeholder="Middle" name="middle_name" ng-model="perinfo.middle_name" required>
								<input class="input-small" type="text" placeholder="Last" name="last_name" ng-model="perinfo.last_name" required>
								<div class="help-block inline" style="margin-left: 5px;" ng-show="(views.frmApplicant.first_name.$touched && views.frmApplicant.first_name.$invalid) || (views.frmApplicant.middle_name.$touched && views.frmApplicant.middle_name.$invalid) || (views.frmApplicant.last_name.$touched && views.frmApplicant.last_name.$invalid)"> Full name is required </div>
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
						<input class="col-xs-6 col-sm-6 col-md-8" type="text" name="age" ng-model="perinfo.age" ng-click="computeAge()" required>
						<div class="help-block inline" style="margin-left: 5px;" ng-show="views.frmApplicant.age.$touched && views.frmApplicant.age.$invalid"> Age is required </div>
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
				<div class="space-8"></div>												
				<div class="form-group">
					<div class="col-sm-12 col-md-12 col-lg-12 col-md-offset-6 col-lg-offset-6">
						<button class="btn btn-sm btn-info" type="button" ng-click="updatePerInfo()">
							<i class="ace-icon fa fa-check bigger-110"></i>
							Update
						</button>
					</div>
				</div>
				<div class="space-4"></div>
			</div>

			<div id="edit-scholarship" class="tab-pane">				
				<div id="scholarship-content" ng-include="scholarshipContent"></div>
			</div>											
			
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

	<div class="clearfix form-actions">
		<div class="col-md-9">
			<button class="btn" type="button" ng-click="close()">
				<i class="ace-icon glyphicon glyphicon-remove bigger-110"></i>
				Close
			</button>
		</div>	
	</div>
	
</form>