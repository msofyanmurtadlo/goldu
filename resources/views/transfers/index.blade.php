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
                    <h4 class="mb-2 card-title">Transfers List</h4>
                </div>
            </div>
            <div class="p-0 card-body">
                <div class="mt-4 table-responsive">
                    <table id="basic-table" class="table mb-0 table-striped" role="grid">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Name</th>
                                @foreach ($network as $u)
                                    <th>
                                        Network
                                    </th>
                                    <th>
                                        Ballance
                                    </th>
                                @endforeach
                                <th>ballance amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        {{ $user->username }}
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    @foreach ($user->networkBallances as $s)
                                        <td>
                                            {{ $s->network->name }}
                                        </td>
                                        <td>
                                            {{ '$' . $s->balance }}
                                        </td>
                                    @endforeach
                                    <td>
                                        {{ '$' . $user->ballance }}
                                    </td>
                                    <td>
                                        <div class="flex align-items-center list-user-action">
                                            <a class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-original-title="Edit" aria-label="Edit"
                                                data-bs-original-title="Edit"
                                                href="{{ route('transfers.now', $user->id) }}">
                                                <i class="fa-solid fa-money-bill-transfer"></i> Transfer
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
