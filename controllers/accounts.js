var app = angular.module('userAccounts', ['block-ui','bootstrap-notify','bootstrap-modal','account-module','notifications-module','lock-screen-module']);

app.controller('userAccountsCtrl',function($http,$timeout,$scope,blockUI,bootstrapNotify,bootstrapModal) {

	$scope.views = {};
	
	$scope.list = function() {
		
		blockUI.show();
		$scope.activeTemplate = 'views/accounts-list.php';		
		
		$http({
		  method: 'POST',
		  url: 'controllers/accounts.php?r=list'
		}).then(function mySucces(response) {
		
			$scope.accounts = response.data;
			
		}, function myError(response) {

		  // error

		});		
		
		//initiate dataTables plugin
		$timeout(function() {
		var oTable1 = 
		$('#dynamic-table')
		//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
		.dataTable( {
			bAutoWidth: false,
			"aoColumns": [
			  null, null, null, null, null, null,
			  { "bSortable": false }, { "bSortable": false }
			],
			"aaSorting": [],
	
			//,
			//"sScrollY": "200px",
			//"bPaginate": false,
	
			//"sScrollX": "100%",
			//"sScrollXInner": "120%",
			//"bScrollCollapse": true,
			//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
			//you may want to wrap the table inside a "div.dataTables_borderWrap" element
	
			//"iDisplayLength": 50
		} );
		//oTable1.fnAdjustColumnSizing();
		
		}, 500);
		
		$timeout(function() { blockUI.hide(); },1000);		
		
	};
	
	$scope.view = function(id) {
		
		blockUI.show();
		$scope.activeTemplate = 'views/account-info.php';		
		
		$http({
		  method: 'POST',
		  data: {id: id},
		  url: 'controllers/accounts.php?r=view'
		}).then(function mySucces(response) {
		
			$scope.perinfo = response.data['perinfo'];
			$('#birthday').val(response.data['perinfo']['birthdate']);			
			$scope.accinfo = response.data['accinfo'];
			blockUI.hide();			
			
		}, function myError(response) {

		  // error

		});			
		
	};
	
	$scope.updatePerInfo = function() {
		
		$scope.views.frmApplicant.username.$valid = true;	
		$scope.views.frmApplicant.password.$valid = true;
		$scope.views.frmApplicant.re_type_password.$valid = true;

		$scope.views.frmApplicant.student_id.$touched = true;
		$scope.views.frmApplicant.first_name.$touched = true;
		$scope.views.frmApplicant.middle_name.$touched = true;
		$scope.views.frmApplicant.last_name.$touched = true;
		$scope.views.frmApplicant.gender.$touched = true;
		$scope.views.frmApplicant.age.$touched = true;
		$scope.views.frmApplicant.email.$touched = true;
		$scope.views.frmApplicant.address.$touched = true;
		$scope.views.frmApplicant.contact_no.$touched = true;
		
		$scope.views.frmApplicant.username.$touched = true;	
		$scope.views.frmApplicant.password.$touched = true;
		$scope.views.frmApplicant.re_type_password.$touched = true;

		/*
		** additional validations
		*/
		$scope.validationBday();
		
		$timeout(function() { if ((!$scope.views.frmApplicant.$valid) && ($scope.validation.birthday)) return; },500);	

		$scope.perinfo.birthdate = $('#birthday').val();
		
		blockUI.show();	
		$http({
		  method: 'POST',
		  data: $scope.perinfo,
		  url: 'controllers/profile.php?r=update_perinfo'
		}).then(function mySucces(response) {
			
			blockUI.hide();		
			bootstrapNotify.show('success','Application successfully update');		
			
		}, function myError(response) {
			 
		  // error
			
		});		
		
	};
	
	$scope.updateAccInfo = function() {
		
		//
		$scope.views.frmApplicant.student_id.$valid = true;
		$scope.views.frmApplicant.first_name.$valid = true;
		$scope.views.frmApplicant.middle_name.$valid = true;
		$scope.views.frmApplicant.last_name.$valid = true;
		$scope.views.frmApplicant.gender.$valid = true;
		$scope.views.frmApplicant.age.$valid = true;
		$scope.views.frmApplicant.email.$valid = true;
		$scope.views.frmApplicant.address.$valid = true;
		$scope.views.frmApplicant.contact_no.$valid = true;
		//
		
		$scope.views.frmApplicant.username.$touched = true;
		$scope.views.frmApplicant.password.$touched = true;
		$scope.views.frmApplicant.re_type_password.$touched = true;
		
		/*
		** additional validations
		*/

		$scope.validatePassword();
		console.log($scope.views.frmApplicant.$valid+':'+$scope.validation.passwordMatches);
		if ((!$scope.views.frmApplicant.$valid) || (!$scope.validation.passwordMatches)) return;
		
		blockUI.show();
		$http({
		  method: 'POST',
		  data: $scope.accinfo,
		  url: 'controllers/profile.php?r=update_accinfo'
		}).then(function mySucces(response) {			

			blockUI.hide();	
			bootstrapNotify.show('success','Application successfully update');	
			
		}, function myError(response) {
			 
		  // error
			
		});			
		
	};
	
	$scope.del = function(id) {
		
		bootstrapModal.confirm($scope,'Confirmation','Are you sure you want to delete this record?',function() { del(id); },function() {});
		
		function del(id) {
			
			$http({
			  method: 'POST',
			  data: {id: [id]},
			  url: 'controllers/accounts.php?r=delete'
			}).then(function mySucces(response) {
				
				$('#dynamic-table').dataTable().fnDestroy();
				$scope.list();
				
			}, function myError(response) {
				 
			  // error
				
			});

		};
		
	};
	
	$scope.close = function() {
		
		$scope.list();		
		
	};
	
	$scope.computeAge = function() {
		
		$scope.validationBday();
		$scope.perinfo.age = getAge($('#birthday').val());
		
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

	$scope.validationBday = function() {
		$scope.validation.birthday = false;
		if ($('#birthday').val() == '') {
			$scope.validation.birthday = true;
		}
	};	
	
	$scope.validatePassword = function() {
		
		if ( (($scope.views.frmApplicant.password.$invalid) || ($scope.views.frmApplicant.re_type_password.$invalid)) || ($scope.accinfo.password != $scope.accinfo.re_type_password) ) {
			bootstrapNotify.show('danger','Password does not match');
			return;
		} else {
			$scope.validation.passwordMatches = true;	
		}

	};	
	
	$scope.validation = {};
	
	$scope.validation.birthday = false;
	$scope.validation.passwordMatches = false;	
	
	$scope.list();
	
});