@extends('layouts.master')
@section('nav')
    <div class="flex-wrap d-flex justify-content-between align-items-center">
        <div>
            <h1>Profile</h1>
            <p>{{ $settings['Site_Description'] }}</p>
        </div>
        <div>
            <a class="btn btn-link btn-soft-light" href="{{ route('smartlinks') }}">
                <i class="fa-solid fa-dollar"></i> Get Money
            </a>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="profile-img position-relative me-3 mb-3 mb-lg-0 profile-logo profile-logo1">
                                <img src="{{ asset('template/dashboard/assets') }}/images/avatars/01.png" alt="User-Profile"
                                    class="theme-color-default-img img-fluid rounded-pill avatar-100">
                                <img src="{{ asset('template/dashboard/assets') }}/images/avatars/avtar_1.png"
                                    alt="User-Profile" class="theme-color-purple-img img-fluid rounded-pill avatar-100">
                                <img src="{{ asset('template/dashboard/assets') }}/images/avatars/avtar_2.png"
                                    alt="User-Profile" class="theme-color-blue-img img-fluid rounded-pill avatar-100">
                                <img src="{{ asset('template/dashboard/assets') }}/images/avatars/avtar_4.png"
                                    alt="User-Profile" class="theme-color-green-img img-fluid rounded-pill avatar-100">
                                <img src="{{ asset('template/dashboard/assets') }}/images/avatars/avtar_5.png"
                                    alt="User-Profile" class="theme-color-yellow-img img-fluid rounded-pill avatar-100">
                                <img src="{{ asset('template/dashboard/assets') }}/images/avatars/avtar_3.png"
                                    alt="User-Profile" class="theme-color-pink-img img-fluid rounded-pill avatar-100">
                            </div>
                            <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                                <h4 class="me-2 h4">{{ Auth::user()->name }}</h4>

                            </div>
                        </div>
                        <ul class="d-flex nav nav-pills mb-0 text-center profile-tab" data-toggle="slider-tab"
                            id="profile-pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" data-bs-toggle="tab" href="#update-password" role="tab"
                                    aria-selected="false">Update Password</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#bank" role="tab"
                                    aria-selected="false">Edit Bank</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Informations</h4>
                    </div>
                </div>
                <div class="card-body">
                    <p>Information your acount.</p>
                    <div class="mb-1">Name: <a href="#" class="ms-3">{{ Auth::user()->name }}</a></div>
                    <div class="mb-1">Email: <a href="#" class="ms-3">{{ Auth::user()->email }}</a></div>
                    <div class="mb-1">Username: <a href="#" class="ms-3">{{ '@' . Auth::user()->username }}</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-9">
            <div class="profile-content tab-content">
                <div id="update-password" class="tab-pane fade active show">
                    @if (session('success'))
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <span>{{ session('success') }}</span>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title"> Update Password
                                </h4>
                            </div>
                        </div>
                        <div class="card-body mt-3">
                            <form class="form-horizontal" action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0"
                                        for="current_password">Current password</label>
                                    <div class="col-sm-9">
                                        <input type="password"
                                            class="form-control @error('current_password') is-invalid @enderror"
                                            name="current_password" required>
                                    </div>
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="password">New
                                        Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" required>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0"
                                        for="password_confirmation">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password_confirmation"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">Update Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="bank" class="tab-pane fade">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title"> Edit Bank
                                </h4>
                            </div>
                        </div>
                        <div class="card-body mt-3">
                            <form class="form-horizontal" action="{{ route('profile.bank') }}" method="POST">
                                @csrf
                                @foreach ($banks as $bank)
                                    <input type="hidden" name="id" value="{{ $bank->id }}">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="bank_name">Bank
                                            (BCA)</label>
                                        <div class="col-sm-9">
                                            <input value="{{ $bank->bank_name }}" type="text"
                                                class="form-control @error('bank_name') is-invalid @enderror"
                                                name="bank_name" required>
                                        </div>
                                        @error('bank_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0"
                                            for="bank_acount">Bank
                                            Acount Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ $bank->bank_acount }}"
                                                class="form-control @error('bank_acount') is-invalid @enderror"
                                                name="bank_acount" required>
                                        </div>
                                        @error('bank_acount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0"
                                            for="bank_number">Bank
                                            Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="{{ $bank->bank_number }}"
                                                class="form-control @error('bank_number') is-invalid @enderror"
                                                name="bank_number" required>
                                        </div>
                                        @error('bank_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                @endforeach
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">Update Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
