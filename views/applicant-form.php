<div class="space-4"></div>

<form class="form-horizontal" id="frmApplicant" name="views.frmApplicant" novalidate>
	<div class="tabbable">
		<ul class="nav nav-tabs padding-16">
			<li>
				<a data-toggle="tab" href="#edit-scholarship">
					<i class="green ace-icon fa fa-certificate bigger-125"></i>
					Scholarship
				</a>
			</li>
		</ul>

		<div class="tab-content profile-edit-tab-content">
			<div id="edit-scholarship" class="tab-pane in active">				
				<div id="scholarship-content" ng-include="scholarshipContent"></div>
			</div>
		</div>
	</div>

	<div class="clearfix form-actions">
		<div class="col-md-9">
			<button class="btn" type="button" ng-click="close()">
				<i class="ace-icon glyphicon glyphicon-remove bigger-110"></i>
				Close
			</button>
		</div>	
	</div>
	
</form>