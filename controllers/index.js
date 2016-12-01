var app = angular.module('index', ['block-ui','bootstrap-notify','bootstrap-modal','account-module','notifications-module','dashboard-module','globals','dashboard']);

app.directive('ptResults', function($http) {
	
	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {

			$http({
			  method: 'POST',
			  url: 'controllers/dashboard.php?r=ptResults'
			}).then(function mySucces(response) {
				
				scope.pts = response.data;
				
			}, function myError(response) {
				
			});			
			
	   }
	};	
	
});

app.directive('catResults', function($http) {
	
	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {
			
			$http({
			  method: 'POST',
			  url: 'controllers/dashboard.php?r=catResults'
			}).then(function mySucces(response) {
				
				scope.cats = response.data;				
				
			}, function myError(response) {

			});			

	   }
	};	
	
});

app.controller('indexCtrl',function($window,$scope,blockUI,bootstrapNotify,bootstrapModal,globalsService,eventsAnnouncements) {

$scope.views = {};

$scope.views.levels = {
	1: "1st Year",
	2: "2nd Year",
	3: "3rd Year",
	4: "4th Year",
	5: "5th Year"
};

$scope.views.semesters = {
	1: "First Semester",
	2: "Second Semester"
};

$scope.signup = function() {
	$window.location.href = 'register.php';
}

$scope.login = function() {
	$window.location.href = 'login.php';	
}

globalsService.globals($scope);

$scope.views.program1_key = Object.keys($scope.views.scholarship_programs)[0];
$scope.views.program1_value = $scope.views.scholarship_programs[$scope.views.program1_key];

$scope.views.program2_key = Object.keys($scope.views.scholarship_programs)[1];
$scope.views.program2_value = $scope.views.scholarship_programs[$scope.views.program2_key];

/*
**	requirements	
**
*/
$scope.req = function(program) {
	
	bootstrapModal.confirm($scope,'Requirements',"",function() {},function() {});
	
}

eventsAnnouncements.show($scope);
	
});
