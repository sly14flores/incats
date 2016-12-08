<div class="space-10"></div>
<div class="breadcrumbs" id="breadcrumbs">							
<ul class="breadcrumb">
	<li class="active">Scholarship Application</li>
</ul><!-- /.breadcrumb -->
</div>
<div class="space-10"></div>
<div class="row" ng-show="views.scholarship_status">
<div class="col-md-4 col-md-offset-8 col-lg-4 col-lg-offset-8">
	<div class="form-group">
		<label class="col-sm-12 col-md-2 col-lg-2 control-label"><strong>Status:</strong></label>
		<div class="col-sm-12 col-md-10 col-lg-10">
			<select class="form-control" ng-model="scholarship.status">
				<option value="On-Process">On-Process</option>
				<option value="Pending">Pending</option>
				<option value="Approved">Approved</option>
				<option value="Disapproved">Disapproved</option>
			</select>
		</div>		
	</div>
</div>
</div>