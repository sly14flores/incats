										<div class="table-header">
											List of Applicants
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Student ID</th>
														<th>Fullname</th>
														<th>Program</th>
														<th>Course</th>
														<th>College</th>
														<th>Semester</th>
														<th>Year Level</th>
														<th>School Year</th>
														<th>Status</th>
														<th>&nbsp;</th>
													</tr>
												</thead>

												<tbody>
													<tr ng-repeat="applicant in applicants">
														<td>{{applicant.student_id}}</td>
														<td>{{applicant.full_name}}</td>
														<td>{{applicant.program}}</td>
														<td>{{applicant.course}}</td>
														<td>{{applicant.college}}</td>
														<td>{{views.semesters[applicant.semester]}}</td>
														<td>{{views.levels[applicant.year_level]}}</td>
														<td>{{applicant.school_year}}</td>
														<td>{{applicant.status}}</td>
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																<a class="green" href="javascript:;" ng-click="getScholar(applicant.id)">
																	<i class="ace-icon fa fa-search bigger-130"></i>
																</a>

																<!--<a class="red" href="javascript:;" ng-click="del(applicant.id)">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>-->
															</div>														
														</td>
													</tr>													
												</tbody>
											</table>
										</div>