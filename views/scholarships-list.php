<div class="space-10"></div>												
<button class="btn btn-primary btn-sm no-radius" ng-click="scholarshipAdd()">Add</button>
<div class="space-10"></div>

<div class="table-header">
	Your Scholarships
</div>

<!-- div.table-responsive -->

<!-- div.dataTables_borderWrap -->
<div>
	<table id="dynamic-table-scholarships" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Scholarship No</th>
				<th>Application</th>
				<th>Program</th>
				<th>Course</th>
				<th>College</th>
				<th>Year Level</th>
				<th>Status</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			<tr ng-repeat="scholar in scholarships">
				<td>{{scholar.id}}</td>
				<td>{{scholar.application_type}}</td>
				<td>{{scholar.program}}</td>
				<td>{{scholar.course}}</td>
				<td>{{scholar.college}}</td>
				<td>{{scholar.year_level}}</td>
				<td>&nbsp;</td>
				<td>
					<div class="hidden-sm hidden-xs action-buttons">
						<a class="green" href="javascript:;" ng-click="scholarshipView(scholar.id)">
							<i class="ace-icon fa fa-search bigger-130"></i>
						</a>

						<a class="red" href="javascript:;" ng-click="scholarshipDel(scholar.id)">
							<i class="ace-icon fa fa-trash-o bigger-130"></i>
						</a>
					</div>														
				</td>
			</tr>													
		</tbody>
	</table>
</div>