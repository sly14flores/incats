var app = angular.module('profile', ['block-ui','bootstrap-notify','bootstrap-modal','account-module','notifications-module']);

app.directive('fileread', [function () {
    return {
        scope: {
            fileread: "="
        },
        link: function (scope, element, attributes) {
            element.bind("change", function (changeEvent) {
                var reader = new FileReader();
                reader.onload = function (loadEvent) {
                    scope.$apply(function () {
                        scope.fileread = loadEvent.target.result;						
                    });
                }
                reader.readAsDataURL(changeEvent.target.files[0]);
            });
        }
    }
}]);

app.service('profileService',function($timeout) {
	
	this.list = function(scope) {
		
		scope.activeTemplate = 'views/scholarships-list.php';
		
		//initiate dataTables plugin
		$timeout(function() {

		var oTable1 = 
		$('#dynamic-table-scholarships')
		//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
		.dataTable( {
			bAutoWidth: false,
			"aoColumns": [
			  null, null, null, null, null, null, null,
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


		},1000);	
		
	}
	
});

app.controller('profileCtrl',function($scope,$http,$timeout,blockUI,bootstrapNotify,bootstrapModal,profileService) {

$scope.views = {};

$scope.perinfo = {};
$scope.accinfo = {};
$scope.validation = {};
$scope.validation.birthday = false;
$scope.validation.passwordMatches = false;

/*
** load profile
*/
$http({
  method: 'POST',
  data: {},
  url: 'controllers/profile.php?r=view'
}).then(function mySucces(response) {			
	
	$scope.perinfo = response.data['perinfo'];
	$('#birthday').val(response.data['perinfo']['birthdate']);
	$scope.accinfo = response.data['accinfo'];
	
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

/*
** load scholarship
*/

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

$scope.validatePassword = function() {
	
	if ( (($scope.views.frmApplicant.password.$invalid) || ($scope.views.frmApplicant.re_type_password.$invalid)) || ($scope.accinfo.password != $scope.accinfo.re_type_password) ) {
		bootstrapNotify.show('danger','Password does not match');
		return;
	} else {
		$scope.validation.passwordMatches = true;	
	}

}

$scope.validationBday = function() {
	$scope.validation.birthday = false;
	if ($('#birthday').val() == '') {
		$scope.validation.birthday = true;
	}
}

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
	
	if ((!$scope.views.frmApplicant.$valid) && ($scope.validation.birthday)) return;	

	$scope.perinfo.birthdate = $('#birthday').val();	
	
	blockUI.show();
	$http({
	  method: 'POST',
	  data: $scope.perinfo,
	  url: 'controllers/profile.php?r=update_perinfo'
	}).then(function mySucces(response) {			

		blockUI.hide();
		
	}, function myError(response) {
		 
	  // error
		
	});	
	
}

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
	if ((!$scope.views.frmApplicant.$valid) && (!$scope.validation.passwordMatches)) return;
	
	blockUI.show();
	$http({
	  method: 'POST',
	  data: $scope.accinfo,
	  url: 'controllers/profile.php?r=update_accinfo'
	}).then(function mySucces(response) {			

		blockUI.hide();
		
	}, function myError(response) {
		 
	  // error
		
	});	
	
}

$scope.scholarshipAdd = function() {
	
	$scope.activeTemplate = 'views/scholarship-form.php';
	
	$scope.scholarship = {};

	$scope.views.scholarship_programs = {
		"University Scholarships": "University",
		"Government": "Government"
	};

	$scope.views.scholarship_program_select = {
		"University": {
			"Academic":"Academic",
			"Dependent":"Dependent"
		},
		"Government": {
			"Local Code":"Local Code",
			"DA ACEF": "DA ACEF"
		}
	};

	$scope.views.levels = {
		"1st Year": 1,
		"2nd Year": 2,
		"3rd Year": 3,
		"4th Year": 4,
		"5th Year": 5
	};

	$scope.views.semesters = {
		"First Semester": 1,
		"Second Semester": 2,
	};
	
	$scope.requirements = [];
	$scope.views.doc_title = '';
	
}

$scope.selectProgram = function() {
	
	$scope.views.scholarship_program = $scope.views.scholarship_program_select[$scope.scholarship.programs];	
	
};

$scope.requirementAdd = function() {
	
	$scope.views.doc_title = $('#doc_file')[0].files[0]['name'];
	$scope.requirements.push({description: $scope.views.description, rating: $scope.views.rating, doc_file: $scope.views.doc_file, doc_title: $scope.views.doc_title});
	$scope.views.description = '';
	$scope.views.rating = '';
	$('#doc_file').val(null);
	
};

$scope.requirementDel = function(item) {
	
	var index = $scope.requirements.indexOf(item);
	$scope.requirements.splice(index, 1);
	
/* 	if (item.id > 0) {
		$scope.purposesDelete.push(item.id);
	}	 */
	
}

$scope.scholarshipCancel = function() {
	
	profileService.list($scope);
	
};

$scope.scholarshipSave = function() {
	
	blockUI.show();
	
	$http({
	  method: 'POST',
	  data: {scholarship: $scope.scholarship, requirements: $scope.requirements},
	  url: 'controllers/profile.php?r=save_scholarship'
	}).then(function mySucces(response) {			
		
		blockUI.hide();
		
	}, function myError(response) {
		 
	  // error
		
	});	
	
}

profileService.list($scope);

});
