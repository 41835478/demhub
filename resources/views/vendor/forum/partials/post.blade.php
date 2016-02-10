<tr id="post-{{ $post->id }}">
	<td>
		<img class="img-responsive img-circle" style="width:25px;display:inline;" src="{{$post->author->avatar->url('thumb')}}"><span style="visibility:hidden">*</span> <strong>{!! $post->author->first_name !!} {!! $post->author->last_name !!}</strong>
	</td>
	<td>
		<?php
		echo preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', nl2br(e($post->content)));
		?>
	</td>
</tr>
<tr>
	<td>
		@if ($post->canEdit)
			<a href="{{ $post->editRoute }}">{{ trans('forum::base.edit')}}</a>
		@endif
		@if ($post->canDelete)
			<a href="{{ $post->deleteRoute }}" data-confirm data-method="delete">{{ trans('forum::base.delete') }}</a>
		@endif
	</td>
	<td class="text-muted">
		{{ trans('forum::base.posted_at') }} {{ $post->posted }}
		@if ($post->updated_at != null && $post->created_at != $post->updated_at)
			{{ trans('forum::base.last_update') }} {{ $post->updated }}
		@endif
	</td>
</tr>
