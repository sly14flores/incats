angular.module('globals',[]).service('globalsService', function() {
	
	/*
	** all global objects are declared here
	*/
	this.globals = function(scope) {
		
		scope.views.scholarship_programs = {
			"University Scholarships":"University",
			"Government":"Government"
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
		
	}
	
});