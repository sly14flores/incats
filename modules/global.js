angular.module('globals',[]).service('globalsService', function() {
	
	/*
	** all global objects are declared here
	*/
	this.globals = function(scope) {
		
		scope.views.scholarship_programs = {
			"University Scholarships":"University",
			"Government Scholarships":"Government"
		};

		scope.views.scholarship_program_select = {
			"University": {
				"Academic":"Academic",
				"Dependent":"Dependent",
				"Special Talent":"Special Talent"
			},
			"Government": {
				"Local Code":"Local Code",
				"DA ACEF":"DA ACEF",
				"DSWD":"DSWD",
				"CHED":"CHED",
				"DOST":"DOST",
				"UCBP":"UCBP",
				"NTA":"NTA",
				"ALP Scholar":"ALP Scholar",
				"HEED":"HEED",
				"DAR":"DAR",
				"BPS":"BPS"
			}
		};
		
		scope.views.scholarship_colleges = {
				"College of Agricultural Sciences": "College of Agricultural Sciences",
				"College of Education": "College of Education",
				"Institute of Agroforestry & Watershed Management": "Institute of Agroforestry & Watershed Management",
				"Institute of Environmental Studies": "Institute of Environmental Studies",
				"College of Computer Studies": "College of Computer Studies"
		};
		
		scope.views.scholarship_courses = {
				"BS Agriculture": "BS Agriculture",
				"BS Agricultural Engineering": "BS Agricultural Engineering",
				"BS Agribusiness Management": "BS Agribusiness Management",
				"Bachelor of Elementary Education": "Bachelor of Elementary Education",
				"Bachelor of Secondary Education": "Bachelor of Secondary Education",
				"BS Agroforestry": "BS Agroforestry",
				"BS Forestry": "BS Forestry",
				"BS Environmental Science": "BS Environmental Science",
				"BS Information Systems": "BS Information Systems"
		};
	
	}
	
});