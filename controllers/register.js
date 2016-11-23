var app = angular.module('registration', ['block-ui','bootstrap-notify','bootstrap-modal']);

app.controller('registrationCtrl',function($http,$window,$timeout,$scope,blockUI,bootstrapNotify,bootstrapModal) {

$scope.views = {};
$scope.applicant = {};
$scope.validation = {};
$scope.validation.passwordMatches = false;

$scope.validatePassword = function() {
	
	if ( (($scope.views.frmRegistration.password.$invalid) || ($scope.views.frmRegistration.re_type_password.$invalid)) || ($scope.applicant.password != $scope.applicant.re_type_password) ) {
		bootstrapNotify.show('danger','Password does not match');
		return;
	} else {
		$scope.validation.passwordMatches = true;	
	}
	
}

$scope.submit = function() {

	$scope.views.frmRegistration.first_name.$touched = true;
	$scope.views.frmRegistration.middle_name.$touched = true;
	$scope.views.frmRegistration.last_name.$touched = true;
	$scope.views.frmRegistration.username.$touched = true;
	$scope.views.frmRegistration.email.$touched = true;
	$scope.views.frmRegistration.password.$touched = true;
	$scope.views.frmRegistration.re_type_password.$touched = true;

	/*
	** password validation	
	*/
	$scope.validatePassword();
	
	if ((!$scope.views.frmRegistration.$valid) || (!$scope.validation.passwordMatches)) return;

	$scope.applicant.account_type = 'Applicant';	
	$scope.applicant.birthdate = '0000-00-00';	
	
	blockUI.show('Processing please wait...');
	
	$http({
	  method: 'POST',
	  url: 'controllers/applicants.php?r=Save',
	  data: $scope.applicant,
	  headers : {'Content-Type': 'application/x-www-form-urlencoded'}
	}).then(function mySucces(response) {
		
		blockUI.hide();
		bootstrapNotify.show('success','Account successfully created, <br>redirecting to login page');
		// $timeout(function() { $window.location.href = 'login.php'; },3000);
		
	}, function myError(response) {
		 
	  // error
		
	});	

}

$scope.login = function() {

	$window.location.href = 'login.php';

}
	
});