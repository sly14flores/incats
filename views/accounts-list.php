										<div class="table-header">
											User Accounts
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Student ID</th>
														<th>Fullname</th>
														<th>Gender</th>
														<th>Contact No</th>
														<th>Email</th>
														<th>Username</th>
														<th>&nbsp;</th>
													</tr>
												</thead>

												<tbody>
													<tr ng-repeat="applicant in applicants">
														<td>{{accinfo.student_id}}</td>
														<td>{{accinfo.full_name}}</td>
														<td>{{accinfo.gender}}</td>
														<td>{{accinfo.contact_no}}</td>
														<td>{{accinfo.email}}</td>													
														<td>{{accinfo.username}}</td>
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																<a class="green" href="javascript:;" ng-click="view(accinfo.id)">
																	<i class="ace-icon fa fa-search bigger-130"></i>
																</a>

																<a class="red" href="javascript:;" ng-click="del(accinfo.id)">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															</div>														
														</td>
													</tr>													
												</tbody>
											</table>
										</div>