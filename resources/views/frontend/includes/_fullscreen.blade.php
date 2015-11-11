<section class="main text-center" id="home">
	<div class="page">
		<div class="wrapper-in">
			<div class="container">
				@if(isset($form))
					@include('forms.'.$form)
				@else
					@include($partial)
				@endif
			</div>
		</div>
	</div>
</section>
