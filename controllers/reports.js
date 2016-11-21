var app = angular.module('reports', ['globals','block-ui','bootstrap-notify','bootstrap-modal','account-module','notifications-module','ui.bootstrap','lock-screen-module']);

app.directive('moduleSelect',function() {
	
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {	
			
			element.bind('change', function() {
				
				scope.mod.description = element[0].value;
				
				scope.$apply(function() {
					scope.views.module_select = false;
					scope.views.module_selects = {};
				});
				scope.mod.school_year = "";
				
				if (element[0].value == "Scholarship") {
					
					scope.$apply(function() {
						scope.views.module_select = true;
						scope.views.module_selects = {
							"Grantees": "Grantees",
							"New": "New Applicants",
							"Renewal": "Renewal"
						};						
					});
					
				}
				if (element[0].value == "Testing") {
					
					scope.mod.description = "Type";
					scope.$apply(function() {
						scope.views.module_select = true;
						scope.views.module_selects = {
							"PT": "PT",
							"CAT": "CAT"
						};
					});
					
				}
				
			});

		}
	};
	
});

app.controller('reportsCtrl',function($scope) {

	$scope.views = {};
	
	$scope.mod = {};
	
	$scope.views.module_select = false;
	$scope.views.module_selects = {};
	
	var semYear = (new Date()).getFullYear();
	$scope.views.school_years = {};
	for (i=1; i<=4; ++i) {
		if (i > 1) $scope.views.school_years[(semYear+(i-1))+'-'+(semYear+i)] = (semYear+(i-1))+'-'+(semYear+i);
		else $scope.views.school_years[semYear+'-'+(semYear+i)] = semYear+'-'+(semYear+i);
	}
	
	$scope.generateReport = function() {
		var opt = "";
		var i = 0;
		angular.forEach($scope.mod, function(item,k) {
			if (i == 0) opt += "?"+k+'='+item;
			else opt += "&"+k+'='+item;
			i++;
		});
		window.open("reports/report.php"+opt);
	}
	
});