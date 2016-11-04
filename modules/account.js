angular.module('account-module',['bootstrap-modal']).directive('logoutAccount', function($window,bootstrapModal) {

	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {

			element.bind('click', function(){
					
				bootstrapModal.confirm(scope,'Confirmation','Are you sure you want to logout?',function() { logout(); },function() {});

			});
			
			function logout() {
				
				$window.location.href = 'logout.php';
				
			}

	   }
	};

}).service('accountInfo',function($http) {
	
	this.get = function(scope) {
	
		$http({
		  method: 'POST',
		  url: 'modules/accounts.php?r=info'
		}).then(function mySucces(response) {
		
			scope.account.name = response.data['name'];
			
		}, function myError(response) {
			 
		  // error
			
		});	
	
	}
	
});