<!-- TEAM
================================= -->
<section id="team" class="section">
	<div class="container text-center">

		<div class="row" style="padding:20px 0">
            <h3 style="text-transform:uppercase">Team</h3>
			@foreach($membersMedium as $member => $content)
				@include('frontend.about.__member_medium', [
					'imgName' 		=> $member,
					'name'				=> $content["name"],
					'position'		=> $content["position"],
					'description'	=> $content["description"]
				])
			@endforeach
		</div>
        <div class="row">
            <h3 style="text-transform:uppercase">Advisors</h3>
			@foreach($advisorsMedium as $member => $content)
				@include('frontend.about.__advisor_medium', [
					'imgName' 		=> $member,
					'name'				=> $content["name"],
					'position'		=> $content["position"],
					'description'	=> $content["description"]
				])
			@endforeach
		</div>

	</div>
</section>
