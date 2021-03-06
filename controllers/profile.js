var app = angular.module('profile', ['globals','block-ui','bootstrap-notify','bootstrap-modal','account-module','notifications-module','lock-screen-module']);

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

app.service('profileService',function($http,$timeout,blockUI) {
	
	this.list = function(scope) {
		
		blockUI.show();
		
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
			  null, null, null, null, null, null, null, null, null, null, null,
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
		
		$timeout(function() {blockUI.hide();},2000);
		
	}
	
});

app.controller('profileCtrl',function($scope,$http,$timeout,blockUI,bootstrapNotify,bootstrapModal,profileService,globalsService) {

$scope.views = {};

$scope.views.cancelShow = true;

$scope.perinfo = {};
$scope.scholarinfo = {};
$scope.accinfo = {};
$scope.validation = {};
$scope.validation.birthday = false;
$scope.validation.passwordMatches = false;

$scope.scholarship = {};
$scope.requirements = [];
$scope.requirements_files = [];
$scope.requirementsDelete = [];
$scope.requirementsFilenames = [];

globalsService.globals($scope);

$scope.views.levels = {
	"1st Year": 1,
	"2nd Year": 2,
	"3rd Year": 3,
	"4th Year": 4,
	"5th Year": 5
};

$scope.views.level = {
	1: "1st Year",
	2: "2nd Year",
	3: "3rd Year",
	4: "4th Year",
	5: "5th Year"
};

$scope.views.semesters = {
	"First Semester": 1,
	"Second Semester": 2,
};

var semYear = (new Date()).getFullYear();
$scope.views.school_years = {};
for (i=1; i<=4; ++i) {
	if (i > 1) $scope.views.school_years[(semYear+(i-1))+'-'+(semYear+i)] = (semYear+(i-1))+'-'+(semYear+i);
	else $scope.views.school_years[semYear+'-'+(semYear+i)] = semYear+'-'+(semYear+i);
}

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
	
	$scope.scholarinfo = response.data['scholarinfo'];
	$('#mother_bday').val(response.data['scholarinfo']['mother_bday']);
	$('#father_bday').val(response.data['scholarinfo']['father_bday']);
	
	$scope.siblings = response.data['siblings'];
	
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
	
	$('#mother_bday').datepicker({
		autoclose: true,
		todayHighlight: true
	});
	
	$('#father_bday').datepicker({
		autoclose: true,
		todayHighlight: true
	});		
	
},1000);

/*
** load scholarship
*/

$scope.computeAge = function(s) {
	
	if (s == 'age') {
		$scope.validationBday();
		$scope.perinfo.age = getAge($('#birthday').val());
	}
	
	if (s == 'father') {
		$scope.scholarinfo.father_age = getAge($('#father_bday').val());
	}
	
	if (s == 'mother') {
		$scope.scholarinfo.mother_age = getAge($('#mother_bday').val());		
	}
	
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

};

$scope.validationBday = function() {
	$scope.validation.birthday = false;
	if ($('#birthday').val() == '') {
		$scope.validation.birthday = true;
	}
};

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
	
	$timeout(function() { if ((!$scope.views.frmApplicant.$valid) && ($scope.validation.birthday)) return; },500);

	$scope.perinfo.birthdate = $('#birthday').val();
	
	$scope.scholarinfo.father_bday = $('#father_bday').val();	
	$scope.scholarinfo.mother_bday = $('#mother_bday').val();	
	
	blockUI.show();
	$http({
	  method: 'POST',
	  data: {perinfo: $scope.perinfo, siblings: $scope.siblings, siblingsDelete: $scope.siblingsDelete, scholarinfo: $scope.scholarinfo},
	  url: 'controllers/profile.php?r=update_perinfo'
	}).then(function mySucces(response) {			

		blockUI.hide();
		
	}, function myError(response) {
		 
	  // error
		
	});	
	
};

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
	if ((!$scope.views.frmApplicant.$valid) || (!$scope.validation.passwordMatches)) return;
	
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
	
};

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
	$scope.requirements_files = [];	
	
	$scope.activeTemplate = 'views/scholarship-form.php';
	
	$http({
	  method: 'POST',
	  data: {id: id},
	  url: 'controllers/profile.php?r=view_scholarship'
	}).then(function mySucces(response) {			

		$scope.scholarship = response.data['scholarship'];
		$scope.views.scholarship_program = $scope.views.scholarship_program_select[response.data['scholarship']['programs']];
		$scope.requirements = response.data['requirements'];
		
		blockUI.hide();
		
	}, function myError(response) {
		 
	  // error
		
	});	
	
}

$scope.scholarshipDel = function(id) {
	
	bootstrapModal.confirm($scope,'Confirmation','Are you sure you want to delete this scholarship?',function() { delScholarship(id); },function() {});
	
	function delScholarship(id) {
		
		$http({
		  method: 'POST',
		  data: {id: [id]},
		  url: 'controllers/profile.php?r=delete_scholarship'
		}).then(function mySucces(response) {			
			
			$('#dynamic-table-scholarships').dataTable().fnDestroy();			
			profileService.list($scope);
			
		}, function myError(response) {
			 
		  // error
			
		});			
		
	}
	
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
	
};

$scope.scholarshipCancel = function() {
	
	profileService.list($scope);
	
};

$scope.scholarshipSave = function() {
	
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
		
	}, function myError(response) {
		 
	  // error
		
	});	
	
};

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
};

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

$scope.viewFile = function(img) {
	
	window.open('requirements/'+img);
	
}

$scope.addSibling = function() {
	$scope.siblings.push({id: 0, sibling_name: $scope.views.sibling.sibling_name, sibling_age: $scope.views.sibling.sibling_age, sibling_grade: $scope.views.sibling.sibling_grade, sibling_occupation: $scope.views.sibling.sibling_occupation});
	$scope.views.sibling = {};
}

$scope.delSibling = function(item) {
	
	var index = $scope.siblings.indexOf(item);
	$scope.siblings.splice(index, 1);
	
	if (item.id > 0) {
		$scope.siblingsDelete.push(item.id);
	}
	
}

$scope.siblings = [];
$scope.siblingsDelete = [];

// profileService.list($scope);

});
