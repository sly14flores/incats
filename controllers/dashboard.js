var app = angular.module('dashboard', ['block-ui','bootstrap-notify','bootstrap-modal','account-module']);

app.controller('dashboardCtrl',function($scope,blockUI,bootstrapNotify,bootstrapModal,accountInfo) {

$scope.view = {};
$scope.account = {};

accountInfo.get($scope);
	
});
