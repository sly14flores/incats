var app = angular.module('testing', ['globals','block-ui','bootstrap-notify','bootstrap-modal','account-module','notifications-module','ui.bootstrap']);

app.service('crud',function($http,$compile,$timeout,bootstrapModal,blockUI,globalsService) {
	
	this.list = function(scope) {
		
	blockUI.show();
	scope.activeTemplate = 'views/testing-list.php';	
		
	$http({
	  method: 'POST',
	  url: 'controllers/testing.php?r=list'
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
		  null, null, null, null, null, null, null, null, null,
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
	
	}, 500);
	
	$timeout(function() { blockUI.hide(); },1000);
		
	}
	
	this.view = function(scope,id) {
		
		blockUI.show();
		scope.activeTemplate = 'views/testing-form.php';
		
		$http({
		  method: 'POST',
		  data: {id: id},
		  url: 'controllers/testing.php?r=view'
		}).then(function mySucces(response) {		
			
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
		
	}
	
	this.save = function(scope) {	
		
		if (scope.views.mode == 'Save') delete scope.applicant.id;
		
		$http({
		  method: 'POST',
		  url: 'controllers/testing.php?r='+scope.views.mode,
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
			  data: {id: [id]},
			  url: 'controllers/testing.php?r=delete'
			}).then(function mySucces(response) {
				
				$('#dynamic-table').dataTable().fnDestroy();
				scope.list();
				
			}, function myError(response) {
				 
			  // error
				
			});

		}
		
	}
	
});

app.controller('testingCtrl',function($http,$timeout,$scope,crud,blockUI,bootstrapNotify,bootstrapModal) {

$scope.views = {};
	
});