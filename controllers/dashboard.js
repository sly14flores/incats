var app = angular.module('dashboard', ['block-ui','bootstrap-notify','bootstrap-modal','account-module','notifications-module','dashboard-module','lock-screen-module']);

app.directive('fileModel', ['$parse', function ($parse) {
	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {
		  var model = $parse(attrs.fileModel);
		  var modelSetter = model.assign;
		  
		  element.bind('change', function(){
			 scope.$apply(function(){
				modelSetter(scope, element[0].files[0]);
			 });
		  });

	   }
	};
}]);

app.service('fileUpload', ['$http', function ($http) {
	this.uploadFileToUrl = function(file, uploadUrl, scope){
	   var fd = new FormData();
	   fd.append('file', file);
	
        var xhr = new XMLHttpRequest();
        xhr.upload.addEventListener("progress", uploadProgress, false);
        xhr.addEventListener("load", uploadComplete, false);
        xhr.open("POST", uploadUrl)
        scope.progressVisible = true;
        xhr.send(fd);
	   
		// upload progress
		function uploadProgress(evt) {
			scope.$apply(function(){
				scope.progress = 0;				
				if (evt.lengthComputable) {
					scope.progress = Math.round(evt.loaded * 100 / evt.total);
				} else {
					scope.progress = 'unable to compute';
				}
			});
		}

		function uploadComplete(evt) {
			/* This event is raised when the server send back a response */	
			$('#memo').val(null);
		}

	}
}]);

app.directive('ptResults', function($http) {
	
	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {

			$http({
			  method: 'POST',
			  url: 'controllers/dashboard.php?r=ptResults'
			}).then(function mySucces(response) {
				
				scope.pts = response.data;
				
			}, function myError(response) {
				
			});			
			
	   }
	};	
	
});

app.directive('catResults', function($http) {
	
	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {
			
			$http({
			  method: 'POST',
			  url: 'controllers/dashboard.php?r=catResults'
			}).then(function mySucces(response) {
				
				scope.cats = response.data;				
				
			}, function myError(response) {

			});			

	   }
	};	
	
});

app.service('eventsAnnouncements',function($http,blockUI) {
	
	this.show = function(scope) {
		
		$http({
		  method: 'POST',
		  url: 'controllers/dashboard.php?r=events_announcements',
		  data: scope.event
		}).then(function mySucces(response) {
			
			scope.events = response.data['events'];
			scope.announcements = response.data['announcements'];
			scope.memos = response.data['memos'];
			
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

app.directive('addMemo',function($http,bootstrapModal,blockUI,fileUpload,eventsAnnouncements) {
	
	return {
	   restrict: 'A',
	   link: function(scope, element, attrs) {
	
			element.bind('click', function() {
				
				var frm = '';
					frm += '<form class="form-horizontal">';
					frm += '<div class="form-group">';
					frm += '<label class="col-md-3 control-label no-padding-right">Title</label>';
					frm += '<div class="col-md-9">';
					frm += '<input class="form-control" type="text" name="title" ng-model="memo.title">';
					frm += '</div>';
					frm += '</div>';
					frm += '<div class="form-group">';
					frm += '<label class="col-md-3 control-label no-padding-right">File</label>';
					frm += '<div class="col-md-9">';
					frm += '<input type="file" name="memo" id="memo" file-model="views.memo">';
					frm += '</div>';
					frm += '</div>';					
					frm += '</form>';
					
				bootstrapModal.confirm(scope,'Upload Memo',frm,function() { uploadMemo(); },function() {});
				
			});
			
			scope.memo.title = '';
			
			function uploadMemo() {
				
			   var file = scope.views.memo;
			   
			   if (file == undefined) return;
			   
			   var fn = file['name'];
			   
			   var uploadUrl = "controllers/dashboard.php?r=upload_memo&fn="+fn;
			   fileUpload.uploadFileToUrl(file, uploadUrl, scope);	
				
				blockUI.show();
				
				$http({
				  method: 'POST',
				  url: 'controllers/dashboard.php?r=add_memo',
				  data: {title: scope.memo.title, fn: fn}
				}).then(function mySucces(response) {
				
					eventsAnnouncements.show(scope);				
					blockUI.hide();
					
				}, function myError(response) {

				  error

				});
				
			};
	
	   }
	};
	
});

app.controller('dashboardCtrl',function($http,$scope,blockUI,bootstrapNotify,bootstrapModal,eventsAnnouncements) {

$scope.views = {};

$scope.event = {
	heading: '',
	content: ''
};

$scope.progress = '';

$scope.editEvent = function(id) {
	
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
		
	bootstrapModal.confirm($scope,'Edit Event',frm,function() { updateEvent(id); },function() {});

	$http({
	  method: 'POST',
	  url: 'controllers/dashboard.php?r=edit_event',
	  data: {id: id}
	}).then(function mySucces(response) {
	
		$scope.event = response.data;
		
	}, function myError(response) {
		 
	  // error
		
	});
	
	function updateEvent(id) {
		
		$http({
		  method: 'POST',
		  url: 'controllers/dashboard.php?r=update_event',
		  data: $scope.event
		}).then(function mySucces(response) {
		
			eventsAnnouncements.show($scope);
			
		}, function myError(response) {
			 
		  // error
			
		});		
		
	}
	
};

$scope.delEvent = function(id) {
	
	bootstrapModal.confirm($scope,'Confirmation','Are you sure you want to delete this event?',function() { del(id); },function() {});
	
	function del(id) {
		
		$http({
		  method: 'POST',
		  data: {id: [id]},
		  url: 'controllers/dashboard.php?r=delete_event'
		}).then(function mySucces(response) {
			
			eventsAnnouncements.show($scope);
			
		}, function myError(response) {
			 
		  // error
			
		});

	}	
	
};

$scope.editAnnouncement = function(id) {
	
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
		
	bootstrapModal.confirm($scope,'Edit Announcement',frm,function() { updateAnnouncement(id); },function() {});

	$http({
	  method: 'POST',
	  url: 'controllers/dashboard.php?r=edit_announcement',
	  data: {id: id}
	}).then(function mySucces(response) {
	
		$scope.announcement = response.data;
		
	}, function myError(response) {
		 
	  // error
		
	});
	
	function updateAnnouncement(id) {
		
		$http({
		  method: 'POST',
		  url: 'controllers/dashboard.php?r=update_announcement',
		  data: $scope.announcement
		}).then(function mySucces(response) {
		
			eventsAnnouncements.show($scope);
			
		}, function myError(response) {
			 
		  // error
			
		});		
		
	}

};

$scope.delAnnouncement = function(id) {

	bootstrapModal.confirm($scope,'Confirmation','Are you sure you want to delete this announcement?',function() { del(id); },function() {});
	
	function del(id) {
		
		$http({
		  method: 'POST',
		  data: {id: [id]},
		  url: 'controllers/dashboard.php?r=delete_announcement'
		}).then(function mySucces(response) {
			
			eventsAnnouncements.show($scope);
			
		}, function myError(response) {
			 
		  // error
			
		});

	}

};

$scope.editMemo = function(id) {
	
	var frm = '';
		frm += '<form class="form-horizontal">';
		frm += '<div class="form-group">';
		frm += '<label class="col-md-3 control-label no-padding-right">Title</label>';
		frm += '<div class="col-md-9">';
		frm += '<input class="form-control" type="text" name="title" ng-model="memo.title">';
		frm += '</div>';
		frm += '</div>';
		frm += '</div>';					
		frm += '</form>';
		
	bootstrapModal.confirm($scope,'Edit Memo',frm,function() { updateMemo(id); },function() {});

	$http({
	  method: 'POST',
	  url: 'controllers/dashboard.php?r=edit_memo',
	  data: {id: id}
	}).then(function mySucces(response) {
	
		$scope.memo = response.data;
		
	}, function myError(response) {
		 
	  // error
		
	});
	
	function updateMemo(id) {
		
		$http({
		  method: 'POST',
		  url: 'controllers/dashboard.php?r=update_memo',
		  data: {id: id, title: $scope.memo.title}
		}).then(function mySucces(response) {
		
			eventsAnnouncements.show($scope);
			
		}, function myError(response) {
			 
		  // error
			
		});		
		
	}

};

$scope.delMemo = function(id) {

	bootstrapModal.confirm($scope,'Confirmation','Are you sure you want to delete this memo?',function() { del(id); },function() {});
	
	function del(id) {
		
		$http({
		  method: 'POST',
		  data: {id: [id]},
		  url: 'controllers/dashboard.php?r=delete_memo'
		}).then(function mySucces(response) {
			
			eventsAnnouncements.show($scope);
			
		}, function myError(response) {
			 
		  // error
			
		});

	}

};

eventsAnnouncements.show($scope);
	
});
