@if(Auth::user()->is_following($user))
    {!! Form::model(
        $user, ['route' => ['unfollow_user', $user->id],
        'id' => "form-{$user->id}", 'class' => 'js-follow',
        'style' => '', 'role' => 'form', 'method' => 'POST']
    ) !!}
        {!! Form::token() !!}
        <button type="submit" class="btn btn-greytone btn-sm"  style="width:95px; height:42px;">
            <span class="js-follow-tag glyphicon glyphicon-ok" style="font-size:85%" aria-hidden="true"></span> UNFOLLOW
            <div class="js-loader loader" style="display:none;">Loading...</div>
        </button>
    {!! Form::close() !!}
@else
    {!! Form::model(
        $user, ['route' => ['follow_user', $user->id],
        'id' => "form-{$user->id}", 'class' => 'js-follow',
        'style' => '', 'role' => 'form', 'method' => 'POST']
    ) !!}
        {!! Form::token() !!}
        <button type="submit" class="btn btn-style-alt btn-sm"  style="width:95px; height:42px;">
            <span class="js-follow-tag glyphicon glyphicon-plus" aria-hidden="true"></span> FOLLOW
            <div class="js-loader loader" style="display:none;">Loading...</div>
        </button>
    {!! Form::close() !!}
@endif
