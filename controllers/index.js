var app = angular.module('index', ['block-ui','bootstrap-notify','bootstrap-modal','account-module','notifications-module','dashboard-module']);

app.controller('indexCtrl',function($window,$scope,blockUI,bootstrapNotify,bootstrapModal) {

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
	
});
