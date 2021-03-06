<div class="space-10"></div>
<div class="breadcrumbs" id="breadcrumbs">							
<ul class="breadcrumb">
	<li class="active">Scholarship Application</li>
</ul><!-- /.breadcrumb -->
</div>
<div class="space-10"></div>
<h3>Status: {{scholarship.status}}</h3>
<div class="space-5"></div>
<form id="frmScholarship" name="views.frmScholarship" novalidate>
	<div class="row">
		<div class="space-10"></div>	
		<div class="col-md-4 col-lg-4">
			<label>Application</label>
			<select class="form-control" name="application_type" ng-model="scholarship.application_type">
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
	<div class="row">
		<div class="space-10"></div>	
		<div class="col-md-4 col-lg-4">
			<label>College</label>
			<!--<input type="text" class="form-control" name="college" ng-model="scholarship.college">-->
			<select class="form-control" name="college" ng-model="scholarship.college" ng-options="x for (x,y) in views.scholarship_colleges track by y">
				<option value="">-</option>
			</select>
		</div>
		<div class="col-md-4 col-lg-4">
			<label>Course</label>
			<!--<input type="text" class="form-control" name="course" ng-model="scholarship.course">-->
			<select class="form-control" name="course" ng-model="scholarship.course" ng-options="x for (x,y) in views.scholarship_courses track by y">
				<option value="">-</option>			
			</select>
		</div>		
		<div class="col-md-4 col-lg-4">
			<label>Year Level</label>
			<select class="form-control" name="year_level" ng-model="scholarship.year_level" ng-options="x for (x,y) in views.levels track by y">
				<option value="">-</option>				
			</select>
		</div>
	</div>
	<div class="row">
		<div class="space-10"></div>	
		<div class="col-md-4 col-lg-4">
			<label>Semester</label>
			<select class="form-control" name="semester" ng-model="scholarship.semester" ng-options="x for (x,y) in views.semesters track by y">
				<option value="">-</option>
			</select>
		</div>
		<div class="col-md-4 col-lg-4">
			<label>School Year</label>
			<select class="form-control" name="school_year" ng-model="scholarship.school_year" ng-options="x for (x,y) in views.school_years track by y">
				<option value="">-</option>
			</select>
		</div>		
	</div>
</form>
<div class="space-10"></div>
<div class="space-10"></div>
<div class="space-10"></div>
<div class="breadcrumbs" id="breadcrumbs">							
<ul class="breadcrumb">
	<li class="active">Requirements</li>
</ul><!-- /.breadcrumb -->
</div>
<form id="frmRequirements" name="views.frmRequirements" novalidate>
	<div class="row">
		<div class="space-10"></div>
		<div class="col-md-3 col-lg-3">
			<label>File</label>
			<input type="file" name="doc_file" id="doc_file" fileread="views.doc_file">
		</div>
		<div class="col-md-3 col-lg-3">
			<label>Description</label>
			<input type="text" class="form-control" name="description" ng-model="views.description">
		</div>
		<div class="col-md-3 col-lg-3">
			<label>Rating</label>
			<input type="text" class="form-control" name="doc_rating" ng-model="views.doc_rating">
		</div>
		<div class="col-md-3 col-lg-3" style="padding-top: 27px;">
			<button class="btn btn-primary btn-xs inline" ng-click="requirementAdd()">Add</button>		
		</div>
	</div>
</form>
<div class="space-10"></div>
<div class="table-header">
	Your Requirements
</div>

<!-- div.table-responsive -->

<!-- div.dataTables_borderWrap -->
<div>
	<table id="dynamic-table-requirements" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Description</th>
				<th>Rating</th>
				<th>File</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			<tr ng-repeat="requirement in requirements">
				<td>
					<input type="text" class="form-control" value="{{requirement.description}}" ng-disabled="true">
				</td>
				<td>
					<input type="text" class="form-control" value="{{requirement.doc_rating}}" ng-disabled="true">
				</td>
				<td><a href="javascript:;" ng-click="viewFile(requirement.doc_title)">{{requirement.doc_title}}</a></td>
				<td>
					<div class="hidden-sm hidden-xs action-buttons">
						<!--<a class="green" href="javascript:;">
							<i class="ace-icon fa fa-edit bigger-130"></i>
						</a>-->

						<a class="red" href="javascript:;" ng-click="requirementDel(requirement)">
							<i class="ace-icon fa fa-trash-o bigger-130"></i>
						</a>
					</div>														
				</td>
			</tr>													
		</tbody>
	</table>
</div>
<div class="space-10"></div>
<div class="row">
	<div class="form-group">
		<div id="tButtons" class="row" style="margin-left: 15px; margin-right: 15px;">
			<div class="space-10"></div>	
			<div class="col-md-12">
				<button class="btn btn-success" ng-click="scholarshipSave()">{{views.ok}}</button>
				<button class="btn btn-default" ng-click="scholarshipCancel()" ng-show="views.cancelShow">{{views.cancel}}</button>
			</div>
		</div>
	</div>		
</div>