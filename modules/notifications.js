angular.module('notifications-module',[]).directive('notifyUser', function($http,$interval) {

	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {

			scope.notifications = {};
			scope.notifications.show = true;
			scope.notifications.showCount = false;
			scope.notifications.count = 0;
			scope.notifications.many = '';
			
			scope.notifications.results = [];
			
			scope.dismiss = function(id) {
				
				$http({
				  method: 'POST',
				  data: {id: id},
				  url: 'modules/notifications.php?r=dismiss'
				}).then(function mySucces(response) {
				
					fetchNotifications();				
				
				}, function myError(response) {					 
					
				});				
				
			};
			
			function fetchNotifications() {
			
				$http({
				  method: 'POST',
				  url: 'modules/notifications.php?r=notifications'
				}).then(function mySucces(response) {
				
					scope.notifications.count = response.data.length
					if (scope.notifications.count == 0) scope.notifications.showCount = false;
				
					if (scope.notifications.count > 0) {
						scope.notifications.showCount = true;
						if (scope.notifications.count) scope.notifications.many = 's';
						scope.notifications.results = response.data;					
					}
					
				}, function myError(response) {
					 

					
				});
			
			}
			
			fetchNotifications();
			$interval(function() { fetchNotifications(); }, 5000);

	   }
	};

});