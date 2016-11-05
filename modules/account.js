angular.module('account-module',['bootstrap-modal']).directive('logoutAccount', function($http,$window,bootstrapModal) {

	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {
			
			scope.account = {};
			scope.privileges = {};
			scope.privileges.scholarship_services = false;
			scope.privileges.profile = false;
			
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
				
				if (account_type == 'Administrator') scope.privileges.scholarship_services = true;
				if (account_type == 'Applicant') scope.privileges.profile = true;
				
			}

	   }
	};

});