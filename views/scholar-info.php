<div class="space-10"></div>
<div class="widget-box">
	<div class="widget-header widget-header-flat">
		<h4 class="widget-title">{{views.application_type}}</h4>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<div class="row" ng-show="views.scholarship_status">
			<div class="col-md-4 col-md-offset-8 col-lg-4 col-lg-offset-8">
				<div class="form-group">
					<label class="col-sm-12 col-md-2 col-lg-2 control-label"><strong>Status:</strong></label>
					<div class="col-sm-12 col-md-10 col-lg-10">
						<select class="form-control" ng-model="scholarship.status" ng-change="scholarshipStatus(scholarship.id)">
							<option value="On-Process">On-Process</option>
							<option value="Pending">Pending</option>
							<option value="Approved">Approved</option>
							<option value="Disapproved">Disapproved</option>
						</select>
					</div>		
				</div>
			</div>
			</div>
			<div class="space-10"></div>
			<div class="space-10"></div>
				<div class="row">
					<div class="col-md-6 col-lg-6">
						<table class="table table-bordered">
							<tbody>
							<tr><td><strong>Program</strong></td><td><strong>College</strong></td></tr>
							<tr><td style="padding-left: 25px;">{{scholarship.programs}}<br><strong>{{scholarship.program}}</strong></td><td style="padding-left: 25px;">{{scholarship.college}}</td></tr>
							<tr><td><strong>Course</strong></td><td><strong>Year Level</strong></td></tr>
							<tr><td style="padding-left: 25px;">{{scholarship.course}}</td><td style="padding-left: 25px;">{{views.level[scholarship.year_level]}}</td></tr>
							<tr><td><strong>Semester</strong></td><td><strong>School Year</strong></td></tr>
							<tr><td style="padding-left: 25px;">{{views.semester[scholarship.semester]}}</td><td style="padding-left: 25px;">{{scholarship.school_year}}</td></tr>							
							</tbody>
						</table>
					</div>
					<div class="col-md-6 col-lg-6">
						<div class="widget-box">
							<div class="widget-header widget-header-flat">
								<h4 class="widget-title">Requirements</h4>
							</div>
							<div class="widget-body">
								<div class="widget-main">
									<table class="table">
										<thead><tr><th>Description</th><th>Rating</th><th>File</th></tr></thead>
										<tbody>
											<tr ng-repeat="requirement in requirements">
												<td>{{requirement.description}}</td>
												<td>{{requirement.doc_rating}}</td>
												<td><a href="javascript:;" ng-click="viewFile(requirement.doc_title)">{{requirement.doc_title}}</a></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

		</div>
	</div>
</div>

<div class="space-10"></div>
<div class="row">
	<div class="form-group">
		<div id="tButtons" class="row" style="margin-left: 15px; margin-right: 15px;">
			<div class="space-10"></div>	
			<div class="col-md-12">
				<button class="btn btn-success" ng-click="close()">Close</button>
			</div>
		</div>
	</div>		
</div>