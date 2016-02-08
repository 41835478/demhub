<div class="btn-action" onclick="sidebar('invite')" data-toggle="tooltip" data-placement="top" title="Invite Your Colleagues">
    <i class="fa fa-plus fa-md"></i>
    <i class="fa fa-users fa-2x"></i>
</div>

<div id="dashboard" class="animate text-center" style="padding: 120px 50px;">
    @include('forms.user.invite_people')
    <button class="btn btn-link" onclick="sidebar('close')">Close</button>
    <br>
</div>

<style>
    #dashboard.open{
        right: 0;
    }
</style>
