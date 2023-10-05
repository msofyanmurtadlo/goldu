@extends('layouts.master')
@section('nav')
    <div class="flex-wrap d-flex justify-content-between align-items-center">
        <div>
            <h1>Transfers</h1>
            <p>Transfer balances to users</p>
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
                <div>
                    <div class="input-group">
                        <span class="input-group-text" id="search-input">
                            <svg class="icon-18" width="18" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <input id="search" class="form-control" placeholder="Search Username">
                    </div>
                </div>
            </div>
            <div class="p-0 card-body">
                <div class="mt-4 table-responsive">
                    <table id="transfer-list-table" class="table table-striped" role="grid" data-bs-toggle="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Name</th>
                                @foreach ($network as $u)
                                    <th>
                                        Network
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
                                    <td><span class="badge bg-secondary">{{ '@' . $user->username }}</span>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    @foreach ($user->networkBallances as $s)
                                        <td>
                                            {{ $s->network->name }}
                                            {{ '($' . $s->balance . ')' }}
                                        </td>
                                    @endforeach
                                    <td>
                                        {{ '$' . $user->ballance }}
                                    </td>
                                    <td>
                                        <div class="flex align-items-center list-user-action">
                                            <a class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-original-title="Transfer" aria-label="Transfer"
                                                data-bs-original-title="Transfer"
                                                href="{{ route('transfers.now', $user->id) }}">
                                                <i class="fa-solid fa-money-bill-transfer"></i> Transfer
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation">
                        <ul>
                            {!! $users->links() !!}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            refreshTableContent(url);
        });

        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var searchValue = $(this).val();
                var url = '{{ route('transfers') }}?search=' + searchValue;
                refreshTableContent(url);
            });
        });

        function refreshTableContent(url = location.href) {
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    var content = $(response).find('#transfer-list-table').parent();
                    $('#transfer-list-table').parent().replaceWith(content);
                },
                error: handleAjaxError
            });
        }

        function handleAjaxError(xhr) {
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                Swal.fire('Validation Error', Object.values(errors).join(', '), 'error');
            } else {
                Swal.fire('Error', xhr.statusText, 'error');
            }
        }
    </script>
@endpush
