angular.module('notifications-module',[]).directive('notifyUser', function($http) {

	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {

			scope.notifications = {};
			scope.notifications.show = true;
			scope.notifications.showCount = false;
			scope.notifications.count = 0;
			scope.notifications.many = '';
			
			scope.notifications.results = [];

			$http({
			  method: 'POST',
			  url: 'modules/notifications.php'
			}).then(function mySucces(response) {
			
				scope.notifications.count = response.data.length
			
				if (scope.notifications.count > 0) {
					scope.notifications.showCount = true;
					if (scope.notifications.count) scope.notifications.many = 's';
					scope.notifications.results = response.data;					
				}
				
			}, function myError(response) {
				 

				
			});

	   }
	};

});