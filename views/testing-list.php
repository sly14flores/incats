<div class="table-header">
	Results
</div>

<!-- div.table-responsive -->

<!-- div.dataTables_borderWrap -->
<div>
	<table id="dynamic-table" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Student ID</th>
				<th>Fullname</th>
				<th>Testing Description</th>
				<th>Rating</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			<tr ng-repeat="student_testing in testings">
				<td>{{student_testing.student_id}}</td>
				<td>{{student_testing.full_name}}</td>
				<td>{{views.tts[student_testing.testing_type]}}</td>
				<td>{{student_testing.rating}}</td>
				<td>
					<div class="hidden-sm hidden-xs action-buttons">
						<a class="green" href="javascript:;" ng-click="edit(student_testing.id)">
							<i class="ace-icon fa fa-search bigger-130"></i>
						</a>

						<a class="red" href="javascript:;" ng-click="del(student_testing.id)">
							<i class="ace-icon fa fa-trash-o bigger-130"></i>
						</a>
					</div>														
				</td>
			</tr>													
		</tbody>
	</table>
</div>