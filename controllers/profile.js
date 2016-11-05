var app = angular.module('profile', ['block-ui','bootstrap-notify','bootstrap-modal','account-module','notifications-module']);

app.controller('profileCtrl',function($scope,$timeout,blockUI,bootstrapNotify,bootstrapModal) {

$scope.views = {};

$timeout(function() {

	$('#birthday').datepicker({
		autoclose: true,
		todayHighlight: true
	}).next().on(ace.click_event, function(){
			$(this).prev().focus();
	});
	
},1000);
	
});
