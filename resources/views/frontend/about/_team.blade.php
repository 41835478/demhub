<!-- TEAM
================================= -->
<section id="team" class="section">
	<div class="container text-center">

		<div class="row">
			@foreach($membersLarge as $member => $content)
				@include('frontend.about.__member_large', [
					'imgName' 		=> $member,
					'name'				=> $content["name"],
					'position'		=> $content["position"],
					'description'	=> $content["description"]
				])
			@endforeach
		</div>

		<div class="row" style="padding:50px 0">
			@foreach($membersMedium as $member => $content)
				@include('frontend.about.__member_medium', [
					'imgName' 		=> $member,
					'name'				=> $content["name"],
					'position'		=> $content["position"],
					'description'	=> $content["description"]
				])
			@endforeach
		<div>

	</div>
</section>
