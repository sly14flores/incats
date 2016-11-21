angular.module('account-module',['bootstrap-modal']).directive('logoutAccount', function($http,$window,bootstrapModal) {

	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {
			
			scope.account = {};
			scope.privileges = {};
			scope.privileges.scholarship_services = false;
			scope.privileges.profile = false;
			scope.privileges.settings = false;
			scope.privileges.account = false;			
			scope.privileges.event_announcement_btns = false;		
			scope.privileges.testing = false;	
			scope.privileges.reports = false;	
			
			$http({
			  method: 'POST',
			  url: 'modules/accounts.php?r=info'
			}).then(function mySucces(response) {
			
				scope.account.name = response.data['name'];
				privileges(response.data['account_type']);
				
			}, function myError(response) {
				 
			  // error
				
			});				
			
			element.bind('click', function(){
					
				bootstrapModal.confirm(scope,'Confirmation','Are you sure you want to logout?',function() { logout(); },function() {});

			});
			
			function logout() {
				
				$window.location.href = 'logout.php';
				
			}
			
			function privileges(account_type) {
				
				if (account_type == 'Administrator') {
					scope.privileges.scholarship_services = true;
					scope.privileges.settings = true;
					scope.privileges.account = true;
					scope.privileges.event_announcement_btns = true;
					scope.privileges.testing = true;
					scope.privileges.reports = true;
				}
				
				if (account_type == 'Applicant') {
					scope.privileges.profile = true;
				}
				
			}

	   }
	};

}).directive('settings',function($http,bootstrapModal,bootstrapNotify) {
	
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {
		   
			scope.views.settingsPw = false;
		   
			$http({
			  method: 'POST',
			  url: 'modules/accounts.php?r=settings'
			}).then(function mySucces(response) {			
				
				scope.setting_accinfo = response.data;
				
			}, function myError(response) {
				 
			  // error
				
			});			
		   
			element.bind('click', function() {						
				
				var frm = '<form class="form-horizontal" id="frmSettings" name="views.frmSettings" novalidate>';
					frm += '<div ng-class="{\'form-group\': true, \'has-error\': views.frmSettings.username.$touched && views.frmSettings.username.$invalid}">';
					frm += '<label class="col-sm-3 control-label no-padding-right">Username</label>';
					frm += '<div class="col-sm-9">';
					frm += '<input type="text" name="username" ng-model="setting_accinfo.username" required>';
					frm += '<div class="help-block inline" style="margin-left: 5px;" ng-show="views.frmSettings.username.$touched && views.frmSettings.username.$invalid"> Username is required </div>';
					frm += '</div>';
					frm += '</div>';
					frm += '<div ng-class="{\'form-group\': true, \'has-error\': views.frmSettings.password.$touched && views.frmSettings.password.$invalid}">';
					frm += '<label class="col-sm-3 control-label no-padding-right">Password</label>';
					frm += '<div class="col-sm-9">';
					frm += '<input type="password" name="password" ng-model="setting_accinfo.password" required>';
					frm += '<div class="help-block inline" style="margin-left: 5px;" ng-show="views.frmSettings.password.$touched && views.frmSettings.password.$invalid"> Password is required </div>';
					frm += '</div>';
					frm += '</div>';
					frm += '<div ng-class="{\'form-group\': true, \'has-error\': views.frmSettings.re_type_password.$touched && views.frmSettings.re_type_password.$invalid}">';
					frm += '<label class="col-sm-3 control-label no-padding-right">Re-type password</label>';
					frm += '<div class="col-sm-9">';
					frm += '<input type="password" name="re_type_password" ng-model="setting_accinfo.re_type_password" required>';
					frm += '<div class="help-block inline" style="margin-left: 5px;" ng-show="views.frmSettings.re_type_password.$touched && views.frmSettings.re_type_password.$invalid"> Please re-type password </div>';	
					frm += '</div>';
					frm += '</div>';					
					frm += '<div class="form-group>';
					frm += '<label class="col-sm-3 control-label no-padding-right">&nbsp;</label>';
					frm += '<div class="col-sm-9">';					
					frm += '<div class="help-block" style="margin-left: 5px; color: #ff3333;" ng-show="views.settingsPw"> Password does not match </div>';					
					frm += '</div>';
					frm += '</div>';					
					frm += '<div class="form-group">';
					frm += '<div class="col-sm-12 col-md-12 col-lg-12 col-md-offset-8 col-lg-offset-8">';
					frm += '<button class="btn btn-sm btn-info" type="button" ng-click="updateSettings()">';
					frm += '<i class="ace-icon fa fa-check bigger-110"></i>';
					frm += 'Update';
					frm += '</button>';
					frm += '</div>';
					frm += '</div>';
					frm += '</form>';
				
				bootstrapModal.confirm(scope,'Settings',frm,function() {},function() {});
				
			});
			
			scope.updateSettings = function() {
				
				scope.views.frmSettings.username.$touched = true;
				scope.views.frmSettings.password.$touched = true;
				scope.views.frmSettings.re_type_password.$touched = true;
				
				if ( ((scope.views.frmSettings.password.$invalid) || (scope.views.frmSettings.re_type_password.$invalid)) || (scope.setting_accinfo.password != scope.setting_accinfo.re_type_password) ) {
					scope.views.settingsPw = true;
					return;
				}
				
				scope.views.settingsPw = false;

				$http({
				  method: 'POST',
				  url: 'modules/accounts.php?r=update',
				  data: scope.setting_accinfo
				}).then(function mySucces(response) {			

					
				}, function myError(response) {
					 
				  // error
					
				});					
				
			}
		   
		}
	};
	
});