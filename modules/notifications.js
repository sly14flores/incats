angular.module('notifications-module',[]).directive('notifyUser', function() {

	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {

			scope.notifications = {};
			scope.notifications.show = true;
			scope.notifications.count = 2;
			scope.notifications.many = 's';
			
			scope.notifications.results = [
				{ content: 'Bob just signed up as an editor ...'},
				{ content: 'Marley just signed up as an editor ...'}			
			];

	   }
	};

}).service('accountNotifications',function($http,$interval) {
	
	this.get = function(scope) {
		
		scope.notifications = {};
		scope.notifications.show = true;		
		
/* 		$http({
		  method: 'POST',
		  url: 'modules/notifications.php'
		}).then(function mySucces(response) {
		
			scope.account.name = response.data['name'];
			
		}, function myError(response) {
			 
		  // error
			
		}); */
	
	}
	
});