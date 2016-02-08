<div id="dashboard-icon" onclick="sidebar('feedback')">
	<i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="left" title="feedback" style="font-size:250%"></i>
</div>

<div id="dashboard" class="animate text-center" style="padding: 120px 50px;">
	@include('forms.user.feedback')
    <button class="btn btn-link" onclick="sidebar('close')">Close</button>
	<br>
</div>

<style>
    #dashboard.open{
        right: 0;
    }
</style>
