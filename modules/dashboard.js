angular.module('dashboard-module',[]).directive('newScholars',function($http) {
	
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {
			
			scope.newScholars = [];
			
			$http({
			  method: 'POST',
			  url: 'modules/dashboard.php?r=new_scholars'
			}).then(function mySucces(response) {
			
				scope.newScholars = response.data;
				
			}, function myError(response) {
				 

				
			});
			
		}
	};
	
}).directive('scholars',function($http) {
	
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {
			
			scope.newScholars = [];
			
			$http({
			  method: 'POST',
			  url: 'modules/dashboard.php?r=scholars'
			}).then(function mySucces(response) {
			
				scope.scholars = response.data;
				
			}, function myError(response) {
				 

				
			});
			
		}
	};
	
});