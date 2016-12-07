var app = angular.module('index', ['block-ui','bootstrap-notify','bootstrap-modal','account-module','notifications-module','dashboard-module','globals','dashboard']);

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

app.controller('indexCtrl',function($window,$scope,blockUI,bootstrapNotify,bootstrapModal,globalsService,eventsAnnouncements) {

$scope.views = {};

$scope.views.levels = {
	1: "1st Year",
	2: "2nd Year",
	3: "3rd Year",
	4: "4th Year",
	5: "5th Year"
};

$scope.views.semesters = {
	1: "First Semester",
	2: "Second Semester"
};

$scope.signup = function() {
	$window.location.href = 'register.php';
}

$scope.login = function() {
	$window.location.href = 'login.php';	
}

globalsService.globals($scope);

$scope.views.program1_key = Object.keys($scope.views.scholarship_programs)[0];
$scope.views.program1_value = $scope.views.scholarship_programs[$scope.views.program1_key];

$scope.views.program2_key = Object.keys($scope.views.scholarship_programs)[1];
$scope.views.program2_value = $scope.views.scholarship_programs[$scope.views.program2_key];

/*
**	requirements	
**
*/
$scope.req = function(program) {
	
	var content = "";
	
	switch (program) {
		
		case "Academic":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
		break;
		
		case "Dependent":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
		break;
		
		case "Special Talent":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
		break;
		
		case "Private":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
		break;
		
		case "Local Code":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
			content += "<p class='req'> 5. Must carry a full semestral load </p>";
			content += "<p class='req'> 6.	Applicant must be a resident of La Union </p>";
		break;
		
		case "DA ACEF":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
			content += "<p class='req'> 5. Must carry a full semestral load </p>";
			content += "<p class='req'> 6.	Applicant must be a resident of La Union </p>";
		break;
		
		case "DSWD":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
			content += "<p class='req'> 5. Must carry a full semestral load </p>";
			content += "<p class='req'> 6.	Applicant must be a resident of La Union </p>";
		break;
		
		case "CHED":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
			content += "<p class='req'> 5. Must carry a full semestral load </p>";
			content += "<p class='req'> 6.	Applicant must be a resident of La Union </p>";
		break;
		
		case "DOST":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
			content += "<p class='req'> 5. Must carry a full semestral load </p>";
			content += "<p class='req'> 6.	Applicant must be a resident of La Union </p>";
		break;
		
		case "UCBP":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
			content += "<p class='req'> 5. Must carry a full semestral load </p>";
			content += "<p class='req'> 6.	Applicant must be a resident of La Union </p>";
		break;
		
		case "NTA":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
			content += "<p class='req'> 5. Must carry a full semestral load </p>";
			content += "<p class='req'> 6.	Applicant must be a resident of La Union </p>";
		break;
		
		case "ALP Scholar":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
			content += "<p class='req'> 5. Must carry a full semestral load </p>";
			content += "<p class='req'> 6.	Applicant must be a resident of La Union </p>";
		break;
		
		case "HEED":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
			content += "<p class='req'> 5. Must carry a full semestral load </p>";
			content += "<p class='req'> 6.	Applicant must be a resident of La Union </p>";
		break;
		
		case "DAR":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
			content += "<p class='req'> 5. Must carry a full semestral load </p>";
			content += "<p class='req'> 6.	Applicant must be a resident of La Union </p>";
		break;
		
		case "BPS":
			content += "<p class='req'> 1. Certificate of Grades </p>";
			content += "<p class='req'> 2. Certificate of Good Moral Character </p>";
			content += "<p class='req'> 3. Minimum of 18 units in the preceding semester except for applicants whose &nbsp &nbsp regular academic load is below 18 units provided it is certified by the &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Department Chairman as prescribed in the curriculum. </p>";
			content += "<p class='req'> 4. No failure, dropped nor incomplete marks </p>";
			content += "<p class='req'> 5. Must carry a full semestral load </p>";
			content += "<p class='req'> 6.	Applicant must be a resident of La Union </p>";
		break;
		
	}
	
	bootstrapModal.box($scope,'General Requirements',content,function() { });
	
}

eventsAnnouncements.show($scope);
	
});
