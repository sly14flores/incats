var app = angular.module('testing', ['globals','block-ui','bootstrap-notify','bootstrap-modal','account-module','notifications-module','ui.bootstrap','lock-screen-module']);

app.service('crud',function($http,$compile,$timeout,bootstrapModal,blockUI,globalsService) {
	
	this.list = function(scope) {
	
	blockUI.show();
	scope.activeTemplate = 'views/testing-list.php';		
		
	$http({
	  method: 'POST',
	  url: 'controllers/testing.php?r=list'
	}).then(function mySucces(response) {

		scope.testings = response.data;
		
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
		  null, null, null, null,
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
		
	};
	
	var self = this;
	this.save = function(scope,mode) {

		blockUI.show();

		if (mode == 'update_testing') delete scope.testing.full_name;
		
		$http({
		  method: 'POST',
		  url: 'controllers/testing.php?r='+mode,
		  data: scope.testing
		}).then(function mySucces(response) {

			$('#dynamic-table').dataTable().fnDestroy();
			self.list(scope);
			blockUI.hide();
			
		}, function myError(response) {

		  // error

		});
		
	};	
	
	this.del = function(scope,id) {
		
		bootstrapModal.confirm(scope,'Confirmation','Are you sure you want to delete this result?',function() { del(id); },function() {});
		
		function del(id) {
			
			$http({
			  method: 'POST',
			  data: {id: [id]},
			  url: 'controllers/testing.php?r=delete'
			}).then(function mySucces(response) {
				
				$('#dynamic-table').dataTable().fnDestroy();
				self.list(scope);
				
			}, function myError(response) {
				 
			  // error
				
			});

		}
		
	};
	
});

app.directive('addTesting',function($http,$timeout,bootstrapModal,blockUI,crud) {
	
	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {

			element.bind('click', function() {
				
				scope.testing = {};
				scope.testing.scholar_id = 0;
				scope.views.name = '';	
				
				var frm = '';
					frm += '<form class="form-horizontal">';
					frm += '<div class="form-group">';
					frm += '<label class="col-md-3 control-label no-padding-right">Student Name</label>';
					frm += '<div class="col-md-9">';
					frm += '<input type="text" class="form-control" name="name" ng-model="views.name" uib-typeahead="student as student.full_name for student in students | filter:{full_name:$viewValue}" typeahead-on-select="idSelected($item, $model, $label, $event)">';
					frm += '</div>';
					frm += '</div>';					
					frm += '<div class="form-group">';
					frm += '<label class="col-md-3 control-label no-padding-right">Testing Type</label>';
					frm += '<div class="col-md-9">';
					frm += '<select class="form-control" name="testing_type" ng-model="testing.testing_type" ng-options="x for (x,y) in views.testing_types track by y">';
					frm += '<option value="">-</option>';
					frm += '</select>';
					frm += '</div>';
					frm += '</div>';
					frm += '<div class="form-group">';
					frm += '<label class="col-md-3 control-label no-padding-right">Rating</label>';
					frm += '<div class="col-md-9">';
					frm += '<input type="text" class="form-control" name="rating" ng-model="testing.rating">';
					frm += '</div>';
					frm += '</div>';					
					frm += '</form>';
					
					bootstrapModal.confirm(scope,'Add Testing Result',frm,function() { crud.save(scope,'add_testing'); },function() {});	

			});

	    }
	};
	
});

app.controller('testingCtrl',function($http,$timeout,$scope,crud,blockUI,bootstrapNotify,bootstrapModal) {

$scope.views = {};
$scope.testing = {};

$scope.views.testing_types = {
	"Personality Test": "PT",
	"College Aptitude Test": "CAT"
};

$scope.views.tts = {
	"PT": "Personality Test",
	"CAT": "College Aptitude Test"
};

$http.get('controllers/testing.php?r=students').then(function(response){
	$scope.students = response.data;
});	

$scope.idSelected = function(item, model, label, event) {
	$scope.testing.scholar_id = item['id'];
};

$scope.edit = function(id) {

	var frm = '';
		frm += '<form class="form-horizontal">';
		frm += '<div class="form-group">';
		frm += '<label class="col-md-3 control-label no-padding-right">Student Name</label>';
		frm += '<div class="col-md-9">';
		frm += '<input type="text" class="form-control" name="name" ng-model="views.name" uib-typeahead="student as student.full_name for student in students | filter:{full_name:$viewValue}" typeahead-on-select="idSelected($item, $model, $label, $event)">';
		frm += '</div>';
		frm += '</div>';					
		frm += '<div class="form-group">';
		frm += '<label class="col-md-3 control-label no-padding-right">Testing Type</label>';
		frm += '<div class="col-md-9">';
		frm += '<select class="form-control" name="testing_type" ng-model="testing.testing_type" ng-options="x for (x,y) in views.testing_types track by y">';
		frm += '<option value="">-</option>';
		frm += '</select>';
		frm += '</div>';
		frm += '</div>';
		frm += '<div class="form-group">';
		frm += '<label class="col-md-3 control-label no-padding-right">Rating</label>';
		frm += '<div class="col-md-9">';
		frm += '<input type="text" class="form-control" name="rating" ng-model="testing.rating">';
		frm += '</div>';
		frm += '</div>';					
		frm += '</form>';
		
		bootstrapModal.confirm($scope,'Edit Testing Result',frm,function() { crud.save($scope,'update_testing'); },function() {});
	
		$http({
		  method: 'POST',
		  url: 'controllers/testing.php?r=view',
		  data: {id: id}
		}).then(function mySucces(response) {
			
			$scope.testing = response.data;
			$scope.views.name = response.data['full_name'];
			
		}, function myError(response) {

		  // error

		});	
	
};

$scope.del = function(id) {
	crud.del($scope,id);
};

crud.list($scope);
	
});