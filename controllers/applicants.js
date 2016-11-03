var app = angular.module('applicants', ['block-ui','bootstrap-notify','bootstrap-modal','account-module']);

app.service('crud',function($http,$compile,$timeout,bootstrapModal,blockUI) {
	
	this.list = function(scope) {
		
		blockUI.show();
		scope.activeTemplate = 'views/applicants-list.php';
		
		$http({
		  method: 'POST',
		  url: 'controllers/applicants.php?r=list'
		}).then(function mySucces(response) {
		
			scope.applicants = response.data;
			
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
			  null, null, null, null, null,
			  { "bSortable": false }
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
		
		blockUI.hide();
		
		}, 500);
		
	}
	
	this.add = function(scope) {
		
		scope.applicant = {};
		scope.applicant.id = 0;
		
		blockUI.show();
		scope.activeTemplate = 'views/applicant-form.php';
		scope.views.mode = 'Save';
		
		$timeout(function() {
			scope.applicant.gender = "-";
			$('#birthday').datepicker({
				autoclose: true,
				todayHighlight: true
			}).next().on(ace.click_event, function(){
					$(this).prev().focus();
			});			
		},1000);
		
		blockUI.hide();
		
	}
	
	this.view = function(scope,id) {
		
		blockUI.show();
		scope.activeTemplate = 'views/applicant-form.php';	
		scope.views.mode = 'Update';
		
		$http({
		  method: 'POST',
		  data: {id: id},
		  url: 'controllers/applicants.php?r=view'
		}).then(function mySucces(response) {
		
			scope.applicant = response.data;
			$('#birthday').val(response.data['birthdate']);
			
			$timeout(function() {
				$('#birthday').datepicker({
					autoclose: true,
					todayHighlight: true
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
			});
			},1000);			
			
			blockUI.hide();
			
		}, function myError(response) {
			 
		  // error
			
		});			
		
	}
	
	this.save = function(scope) {	
		
		if (scope.views.mode == 'Save') delete scope.applicant.id;
		
		$http({
		  method: 'POST',
		  url: 'controllers/applicants.php?r='+scope.views.mode,
		  data: scope.applicant,
		  headers : {'Content-Type': 'application/x-www-form-urlencoded'}
		}).then(function mySucces(response) {
		
			scope.list();
			
		}, function myError(response) {
			 
		  // error
			
		});
		
	}
	
	this.del = function(scope,id) {
		
		bootstrapModal.confirm(scope,'Confirmation','Are you sure you want to delete this record?',function() { del(id); },function() {});
		
		function del(id) {
			
			$http({
			  method: 'POST',
			  data: {id: id},
			  url: 'controllers/applicants.php?r=delete'
			}).then(function mySucces(response) {
				
				$('#dynamic-table').dataTable().fnDestroy();
				scope.list();
				
			}, function myError(response) {
				 
			  // error
				
			});

		}
		
	}
	
});

app.controller('applicantsCtrl',function($scope,crud,blockUI,bootstrapNotify,bootstrapModal) {

$scope.views = {};
	
$scope.applicant = {};
$scope.applicant.id = 0;

$scope.list = function() {

	crud.list($scope);
	
};

$scope.add = function() {
	
	crud.add($scope);
	
};

$scope.view = function(id) {
	
	crud.view($scope,id);
	
}

$scope.cancel = function() {
	
	crud.list($scope);	
	
};

$scope.save = function() {
	
	delete $scope.applicant.re_type_password;
	$scope.applicant.account_type = 'Applicant';
	$scope.applicant.birthdate = $('#birthday').val();
	
	crud.save($scope);
	
};

$scope.del = function(id) {
	
	crud.del($scope,id);
	
};

$scope.computeAge = function() {
	
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

crud.list($scope);
	
});