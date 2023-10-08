@extends('layouts.welcome')
@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
        <div class="page-header-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10 text-center">
                        <h1 class="page-header-title">Private Network</h1>
                        <p class="page-header-text mb-5">Welcome to
                            {{ $settings['Site_Name'] ?? 'Goldu' }},
                            {{ $settings['Site_Description'] }}</p>
                        <a class="btn btn-marketing rounded-pill btn-teal" href="{{ route('login') }}">Login</a><a
                            class="btn btn-link btn-marketing rounded-pill" href="{{ route('register') }}">Register</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="svg-border-angled text-white">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" fill="currentColor">
                <polygon points="0,100 100,0 100,100"></polygon>
            </svg>
        </div>
    </header>
    <section class="bg-white py-10">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4">
                        <i data-feather="share-2"></i>
                    </div>
                    <h3>Share</h3>
                    <p class="mb-0">Sharing refers to the act of distributing content, information, or links to products
                        or services across digital platforms such as social media, blogs, emails, or other platforms. For
                        example, when you tweet a link to an article or share a product post on Facebook, you are
                        disseminating that content to your audience.</p>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4">
                        <i data-feather="trending-up"></i>
                    </div>
                    <h3>Earn Conversion</h3>
                    <p class="mb-0">a conversion pertains to a desired action taken by a visitor or
                        user, such as purchasing a product, signing up for a newsletter, or filling out a contact form.
                        "Earning a conversion" means successfully persuading a visitor to undertake that action.</p>
                </div>
                <div class="col-lg-4">
                    <div class="icon-stack icon-stack-xl bg-gradient-primary-to-secondary text-white mb-4">
                        <i data-feather="dollar-sign"></i>
                    </div>
                    <h3>Earn Money</h3>
                    <p class="mb-0">This entails the process of gaining income or revenue from certain activities in the
                        digital realm. In this context, earning money is typically linked to the outcomes of sharing and
                        successful conversions.</p>
                </div>
            </div>
        </div>
        <div class="svg-border-angled text-dark">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" fill="currentColor">
                <polygon points="0,100 100,0 100,100"></polygon>
            </svg>
        </div>
    </section>
@endsection
