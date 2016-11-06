var app = angular.module('profile', ['block-ui','bootstrap-notify','bootstrap-modal','account-module','notifications-module']);

app.controller('profileCtrl',function($scope,$http,$timeout,blockUI,bootstrapNotify,bootstrapModal) {

$scope.views = {};

$scope.applicant = {};
$scope.validation = {};
$scope.validation.birthday = false;
$scope.validation.passwordMatches = false;

/*
** load profile
*/
blockUI.show();
$http({
  method: 'POST',
  data: {},
  url: 'controllers/profile.php?r=view'
}).then(function mySucces(response) {			
	
	$scope.applicant = response.data;
	blockUI.hide();
	
}, function myError(response) {
	 
  // error
	
});
		
$timeout(function() {

	$('#birthday').datepicker({
		autoclose: true,
		todayHighlight: true
	}).next().on(ace.click_event, function(){
			$(this).prev().focus();
	});
	
},1000);

$scope.computeAge = function() {
	
	$scope.validationBday();
	$scope.applicant.age = getAge($('#birthday').val());
	
	function getAge(dateString) {
		var today = new Date();
		var birthDate = new Date(dateString);
		var age = today.getFullYear() - birthDate.getFullYear();
		var m = today.getMonth() - birthDate.getMonth();
		if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
		{
			age--;
		}
		return age;
	}	
	
};

$scope.validatePassword = function() {
	
	if ( (($scope.views.frmApplicant.password.$invalid) || ($scope.views.frmApplicant.re_type_password.$invalid)) || ($scope.applicant.password != $scope.applicant.re_type_password) ) {
		bootstrapNotify.show('danger','Password does not match');
		return;
	} else {
		$scope.validation.passwordMatches = true;	
	}

}

$scope.validationBday = function() {
	$scope.validation.birthday = false;
	if ($('#birthday').val() == '') {
		$scope.validation.birthday = true;
	}
}

$scope.update = function() {

	$scope.views.frmApplicant.student_id.$touched = true;
	$scope.views.frmApplicant.first_name.$touched = true;
	$scope.views.frmApplicant.middle_name.$touched = true;
	$scope.views.frmApplicant.last_name.$touched = true;
	$scope.views.frmApplicant.gender.$touched = true;
	$scope.views.frmApplicant.age.$touched = true;
	$scope.views.frmApplicant.username.$touched = true;
	$scope.views.frmApplicant.email.$touched = true;
	$scope.views.frmApplicant.address.$touched = true;
	$scope.views.frmApplicant.contact_no.$touched = true;
	$scope.views.frmApplicant.password.$touched = true;
	$scope.views.frmApplicant.re_type_password.$touched = true;
	
	/*
	** additional validations
	*/
	$scope.validationBday();
	
	$scope.validatePassword();
	console.log($scope.views.frmApplicant.$valid+':'+$scope.validation.birthday+':'+$scope.validation.passwordMatches);
	if ((!$scope.views.frmApplicant.$valid) && ($scope.validation.birthday) && (!$scope.validation.passwordMatches)) return;	

	$scope.applicant.birthdate = $('#birthday').val();	
	
	blockUI.show();
	$http({
	  method: 'POST',
	  data: $scope.applicant,
	  url: 'controllers/profile.php?r=update'
	}).then(function mySucces(response) {			

		blockUI.hide();
		
	}, function myError(response) {
		 
	  // error
		
	});	
	
}	

});
