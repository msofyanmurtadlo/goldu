@extends('layouts.master')
@section('nav')
    <div class="flex-wrap d-flex justify-content-between align-items-center">
        <div>
            <h1>Dashboard</h1>
            <p>{{ $settings['Site_Description'] }}</p>
        </div>
        <div>
            <a class="btn btn-link btn-soft-light" href="">
                <i class="fa-solid fa-link"></i> Smartlinks
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="overflow-hidden card aos-init aos-animate" data-aos="fade-up" data-aos-delay="600">
            <div class="flex-wrap card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="mb-2 card-title">Transfers Now</h4>
                </div>
            </div>
            <div class="p-0 card-body">
                <div class="mt-4 table-responsive">
                    @foreach ($user->networkBallances as $u)
                        <p>{{ $u->network->name }}</p>
                        <p>{{ $u->balance }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
