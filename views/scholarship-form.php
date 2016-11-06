<div class="breadcrumbs" id="breadcrumbs">							
<ul class="breadcrumb">
	<li class="active">Scholarship Application</li>
</ul><!-- /.breadcrumb -->
</div>
<div class="space-10"></div>
<form id="frmScholarship" name="views.frmScholarship" novalidate>
<div class="form-group">
	<div class="row" style="margin-left: 5px; margin-right: 5px;">
		<div class="space-10"></div>	
		<div class="col-md-4 col-lg-4">
			<label>Application</label>
			<select class="form-control">
				<option value="">-</option>
				<option value="New">New</option>
				<option value="Renewal">Renewal</option>
			</select>
		</div>
		<div class="col-md-4 col-lg-4">
			<label>Program</label>
			<select class="form-control" name="programs" ng-model="scholarship.programs" ng-options="x for (x,y) in views.scholarship_programs track by y" ng-change="selectProgram()">
				<option value="">-</option>
			</select>
		</div>
		<div class="col-md-4 col-lg-4">
			<label>{{scholarship.programs}}&nbsp;</label>
			<select class="form-control" name="program" ng-model="scholarship.program" ng-options="x for (x,y) in views.scholarship_program track by y">
				<option value="">-</option>
			</select>
		</div>		
	</div>
	<div class="row" style="margin-left: 5px; margin-right: 5px;">
		<div class="space-10"></div>	
		<div class="col-md-4 col-lg-4">
			<label>Course</label>
			<input type="text" class="form-control">
		</div>
		<div class="col-md-4 col-lg-4">
			<label>College</label>
			<input type="text" class="form-control">			
		</div>
		<div class="col-md-4 col-lg-4">
			<label>Year Level</label>
			<input type="text" class="form-control">			
		</div>
	</div>
	<div class="row" style="margin-left: 5px; margin-right: 5px;">
		<div class="space-10"></div>	
		<div class="col-md-4 col-lg-4">
			<label>Semester</label>
			<select class="form-control">
				<option value="">-</option>
			</select>
		</div>	
	</div>
	<div class="form-group">
		<div id="tButtons" class="row" style="margin-left: 15px; margin-right: 15px;">
			<div class="space-10"></div>	
			<div class="col-md-12">
				<button class="btn btn-success" ng-click="save()">Save</button>
				<button class="btn btn-default" ng-click="cancel()">Cancel</button>
			</div>
		</div>
	</div>	
</div>
</form>