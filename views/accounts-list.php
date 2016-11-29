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
														<th>Status</th>
														<th>&nbsp;</th>
													</tr>
												</thead>

												<tbody>
													<tr ng-repeat="account in accounts">
														<td>{{account.student_id}}</td>
														<td>{{account.full_name}}</td>
														<td>{{account.gender}}</td>
														<td>{{account.contact_no}}</td>
														<td>{{account.email}}</td>													
														<td>{{account.username}}</td>
														<td>{{account.status}}</td>
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																<a class="green" href="javascript:;" ng-click="view(account.id)">
																	<i class="ace-icon fa fa-search bigger-130"></i>
																</a>

																<a class="red" href="javascript:;" ng-click="del(account.id)">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															</div>														
														</td>
													</tr>													
												</tbody>
											</table>
										</div>