var app = angular.module('dashboard', ['block-ui','bootstrap-notify','bootstrap-modal','account-module','notifications-module','dashboard-module']);

app.service('eventsAnnouncements',function($http,blockUI) {
	
	this.show = function(scope) {
		
		$http({
		  method: 'POST',
		  url: 'controllers/dashboard.php?r=events_announcements',
		  data: scope.event
		}).then(function mySucces(response) {
			
			scope.events = response.data['events'];
			scope.announcements = response.data['announcements'];
			
		}, function myError(response) {

		  // error

		});		
		
	};
	
});

app.directive('addEvent',function($http,bootstrapModal,blockUI,eventsAnnouncements) {
	
	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {
	
			element.bind('click', function(){
				
				var frm = '';
					frm += '<form class="form-horizontal">';
					frm += '<div class="form-group">';
					frm += '<label class="col-md-3 control-label no-padding-right">Heading</label>';
					frm += '<div class="col-md-9">';
					frm += '<input class="form-control" type="text" name="heading" ng-model="event.heading">';
					frm += '</div>';
					frm += '</div>';
					frm += '<div class="form-group">';
					frm += '<label class="col-md-3 control-label no-padding-right">Content</label>';
					frm += '<div class="col-md-9">';
					frm += '<textarea class="form-control" name="content" ng-model="event.content"></textarea>';
					frm += '</div>';
					frm += '</div>';					
					frm += '</form>';
					
				bootstrapModal.confirm(scope,'Add Event',frm,function() { addEvent(); },function() {});
				
			});
			
			function addEvent() {
				
				blockUI.show();
				
				$http({
				  method: 'POST',
				  url: 'controllers/dashboard.php?r=add_event',
				  data: scope.event
				}).then(function mySucces(response) {
					
					eventsAnnouncements.show(scope);
					blockUI.hide();
					
				}, function myError(response) {

				  // error

				});
				
			}
	
	   }
	};
	
});

app.directive('addAnnouncement',function($http,bootstrapModal,blockUI,eventsAnnouncements) {
	
	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {
	
			element.bind('click', function(){
				
				var frm = '';
					frm += '<form class="form-horizontal">';
					frm += '<div class="form-group">';
					frm += '<label class="col-md-3 control-label no-padding-right">Heading</label>';
					frm += '<div class="col-md-9">';
					frm += '<input class="form-control" type="text" name="heading" ng-model="announcement.heading">';
					frm += '</div>';
					frm += '</div>';
					frm += '<div class="form-group">';
					frm += '<label class="col-md-3 control-label no-padding-right">Content</label>';
					frm += '<div class="col-md-9">';
					frm += '<textarea class="form-control" name="content" ng-model="announcement.content"></textarea>';
					frm += '</div>';
					frm += '</div>';					
					frm += '</form>';
					
				bootstrapModal.confirm(scope,'Add Announcement',frm,function() { addAnnouncement(); },function() {});
				
			});
			
			function addAnnouncement() {
				
				blockUI.show();
				
				$http({
				  method: 'POST',
				  url: 'controllers/dashboard.php?r=add_announcement',
				  data: scope.announcement
				}).then(function mySucces(response) {
				
					eventsAnnouncements.show(scope);				
					blockUI.hide();
					
				}, function myError(response) {

				  // error

				});
				
			}
	
	   }
	};
	
});

app.controller('dashboardCtrl',function($scope,blockUI,bootstrapNotify,bootstrapModal,eventsAnnouncements) {

$scope.views = {};

$scope.event = {
	heading: '',
	content: ''
};

eventsAnnouncements.show($scope);
	
});
