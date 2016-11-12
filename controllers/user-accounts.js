var app = angular.module('userAccounts', ['block-ui','bootstrap-notify','bootstrap-modal','account-module','notifications-module']);

app.controller('userAccountsCtrl',function($http,$timeout,$scope,blockUI,bootstrapNotify,bootstrapModal) {

	$scope.views = {};
	
	$scope.list = function() {
		
		blockUI.show();
		$scope.activeTemplate = 'views/accounts-list.php';		
		
		//initiate dataTables plugin
		$timeout(function() {
		var oTable1 = 
		$('#dynamic-table')
		//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
		.dataTable( {
			bAutoWidth: false,
			"aoColumns": [
			  null, null, null, null, null, null,
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
	
	$scope.list();
	
});