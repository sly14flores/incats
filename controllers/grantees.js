var app = angular.module('grantees', ['block-ui','bootstrap-notify','bootstrap-modal','account-module']);

app.controller('granteesCtrl',function($scope,blockUI,bootstrapNotify,bootstrapModal,accountInfo) {

$scope.view = {};
$scope.account = {};

accountInfo.get($scope);
	
});
