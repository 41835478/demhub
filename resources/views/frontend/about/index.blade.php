@extends('frontend.layouts.master')

@section('content')
    <!-- HERO
    ================================= -->
    <section id="about-hero" class="js-about-hero section" style="height: 35%;">
        <div class="row">
            <div class="ph-name col-md-8 col-md-offset-4 division_all">
                <h1 class="hero-title">About Us</h1>
            </div>
        </div>
    </section>

    <!-- DESCRIPTION
    ================================= -->
    <section id="about-description" class="section" style="min-height: 200px; background-color: #536b77; color: white; font-size: 20px; padding: 40px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">

                    <div class="hero-heading text-center">
                        <p>
                            DEMHUB is designed to connect all areas in the field of disaster and emergency management so that we may find, use, and share information that will help to make our communities safer to live.
                        </p>
                        <p>
                            Because DEMHUB is used by emergency management practitioners and academics, we hold ourselves to very high standards. Our values not only define our company culture; they characterize the tools and information trusted by industry professionals around the world.
                        </p>
                        <p>
                            We are committed to everything we do as it impacts more than just our team, it impacts our communities. So we make sure we're reliable, collaborative, and inclusive, providing the best platform for networking and knowledge sharing.
                        </p>
                        <a href="mailto:info@demhub.net?Subject=DEMHUB%20Inquiry" target="_top" style="color:#38a7de">info@demhub.net</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- TEAM
    ================================= -->
    <section id="team" class="section">
        <div class="container text-center">

            <div class="row" style="padding:20px 0">
                <h3 style="text-transform:uppercase">Team</h3>
                @foreach($membersMedium as $member => $content)
                    @include('frontend.about._teammate', [
                        'imgName' 		=> $member,
                        'name'			=> $content["name"],
                        'user_name'			=> $content["user_name"],
                        'position'		=> $content["position"],
                        'description'   => $content["description"]
                    ])
                @endforeach
            </div>

            <div class="row">
                <h3 style="text-transform:uppercase">Advisors</h3>
                @foreach($advisorsMedium as $member => $content)
                    @include('frontend.about._advisor', [
                        'imgName' 		=> $member,
                        'name'			=> $content["name"],
                        'user_name'			=> $content["user_name"],
                        'position'		=> $content["position"],
                        'description'	=> $content["description"]
                    ])
                @endforeach
            </div>

        </div>
    </section>
@stop
