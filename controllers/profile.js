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

app.service('profileService',function($http,$timeout) {
	
	this.list = function(scope) {
		
		scope.activeTemplate = 'views/scholarships-list.php';
		
		$http({
		  method: 'POST',
		  url: 'controllers/profile.php?r=list'
		}).then(function mySucces(response) {	

			scope.scholarships = response.data;
			
		}, function myError(response) {
			 
		  // error
			
		});		
		
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

$scope.scholarship = {};
$scope.requirements = [];
$scope.requirements_files = [];
$scope.requirementsDelete = [];
$scope.requirementsFilenames = [];

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
	
	blockUI.show();
	
	$scope.views.ok = 'Save';
	$scope.views.cancel = 'Cancel';
	
	$scope.scholarship = {};
	$scope.requirements = [];
	$scope.requirements_files = [];	
	
	$scope.activeTemplate = 'views/scholarship-form.php';
	
	blockUI.hide();	
	
};

$scope.scholarshipView = function(id) {
	
	blockUI.show();	
	
	$scope.views.ok = 'Update';
	$scope.views.cancel = 'Close';
	
	$scope.requirementsDelete = [];
	$scope.requirementsFilenames = [];	
	
	$scope.activeTemplate = 'views/scholarship-form.php';
	
	$http({
	  method: 'POST',
	  data: {id: id},
	  url: 'controllers/profile.php?r=view_scholarship'
	}).then(function mySucces(response) {			

		$scope.scholarship = response.data['scholarship'];
		$scope.requirements = response.data['requirements'];
		
		blockUI.hide();
		
	}, function myError(response) {
		 
	  // error
		
	});	
	
}

$scope.selectProgram = function() {
	
	$scope.views.scholarship_program = $scope.views.scholarship_program_select[$scope.scholarship.programs];	
	
};

$scope.requirementAdd = function() {

	$scope.requirements.push({id: 0, description: $scope.views.description, doc_rating: $scope.views.doc_rating, doc_title: $('#doc_file')[0].files[0]['name']});
	$scope.requirements_files.push({title: $('#doc_file')[0].files[0]['name'], doc: $scope.views.doc_file});
	$scope.views.description = '';
	$scope.views.doc_rating = '';
	$timeout(function() { $('#doc_file').val(null); },1000);
	
};

$scope.requirementDel = function(item) {
	
	var index = $scope.requirements.indexOf(item);
	
	if (item.id > 0) {
		$scope.requirementsDelete.push(item.id);
		$scope.requirementsFilenames.push(item['doc_title']);
	}
	
	$timeout(function() { $scope.requirements.splice(index, 1); },500);
	
}

$scope.scholarshipCancel = function() {
	
	profileService.list($scope);
	
};

$scope.scholarshipSave = function() {
	
	blockUI.show();
	
	var to = $scope.requirements_files.length;	
	if ($scope.views.ok == 'Save') var r = 'save_scholarship';
	else var r = 'update_scholarship';
	
	$http({
	  method: 'POST',
	  data: {scholarship: $scope.scholarship, requirements: $scope.requirements, requirementsDelete: $scope.requirementsDelete, requirementsFilenames: $scope.requirementsFilenames},
	  url: 'controllers/profile.php?r='+r
	}).then(function mySucces(response) {
		
		for (i=0; i<to; ++i) {
		
			$scope.uploadImage($scope.requirements_files[i]['doc'],$scope.requirements_files[i]['title']);
		
		}
		
		profileService.list($scope);
		
		blockUI.hide();	
		
	}, function myError(response) {
		 
	  // error
		
	});	
	
}

function dataURItoBlob(dataURI) {
	var binary = atob(dataURI.split(',')[1]);
	var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
	var array = [];
	for (var i = 0; i < binary.length; i++) {
		array.push(binary.charCodeAt(i));
	}
	return new Blob([new Uint8Array(array)], {
		type: mimeString
	});
}

$scope.uploadImage = function(img,fn) {
  var fd = new FormData();
  var imgBlob = dataURItoBlob(img);
  fd.append('file', imgBlob);
  $http.post(
	  'controllers/upload.php?fn='+fn,
	  fd, {
		transformRequest: angular.identity,
		headers: {
		  'Content-Type': undefined
		}
	  }
	)
	.success(function(response) {
	  console.log('success', response);
	})
	.error(function(response) {
	  console.log('error', response);
	});
};

profileService.list($scope);

});
