@extends('layouts.master')
@section('nav')
    <div class="flex-wrap d-flex justify-content-between align-items-center">
        <div>
            <h1>Offers</h1>
            <p>Displays offers</p>
        </div>
        <div>
            <a class="btn btn-link btn-soft-light" onclick="createData('{{ route('offers.store') }}')">
                <i class="fa-solid fa-bullhorn"></i> Add Offer
            </a>
        </div>
    </div>
@endsection
@section('content')
    @include('offers.form')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title mb-0 me-3">List</h4>
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

                            <input id="search" class="form-control" placeholder="Search Network">
                        </div>
                    </div>
                </div>

                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table id="offer-list-table" class="table table-striped" role="grid" data-bs-toggle="data-table">
                            <thead>
                                <tr class="ligth">
                                    <th>#</th>
                                    <th>Network</th>
                                    <th>Country</th>
                                    <th>Url Mobile</th>
                                    <th>Url Desktop</th>
                                    <th>Author</th>
                                    <th style="min-width: 100px">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($offers as $u)
                                    <tr>
                                        <td>{{ $u->id }}</td>
                                        <td>{{ $u->network->name }}</td>
                                        <td> <img src="{{ asset('flags/' . strtolower($u->country) . '.png') }}"
                                                alt="{{ $u->country }}" /> {{ $u->country }}
                                        </td>
                                        <td>{{ $u->url_mobile }}</td>
                                        <td>{{ $u->url_desktop }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $u->user->username }}</span>
                                        </td>
                                        <td>
                                            <div class="flex align-items-center list-offer-action">
                                                <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-original-title="Edit" aria-label="Edit"
                                                    data-bs-original-title="Edit"
                                                    onclick="editData('{{ route('offers.edit', $u->id) }}')">
                                                    <span class="btn-inner">
                                                        <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <a class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" aria-label="Delete"
                                                    data-bs-original-title="Delete"
                                                    onclick="deleteData('{{ route('offers.destroy', $u->id) }}')">
                                                    <span class="btn-inner">
                                                        <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            stroke="currentColor">
                                                            <path
                                                                d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M20.708 6.23975H3.75" stroke="currentColor"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                            <path
                                                                d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation">
                            <ul>
                                {!! $offers->links() !!}
                            </ul>
                        </nav>
                    </div>
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

        function handleFormSubmit(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#formModal').modal('hide');
                    $('#formModal form')[0].reset();
                    refreshTableContent();
                    Swal.fire('Success!', 'Operation completed successfully.', 'success');
                },
                error: handleAjaxError
            });
        }

        function refreshTableContent(url = location.href) {
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    var content = $(response).find('#offer-list-table').parent();
                    $('#offer-list-table').parent().replaceWith(content);
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

        $(document).ready(function() {
            $('#formModal form').on('submit', handleFormSubmit);
            $("#Input_Id").change(function() {
                var searchValue = $(this).val();
                var url = '{{ route('offers.index') }}?search=' + searchValue;
                refreshTableContent(url);
            });
            $('#search').on('keyup', function() {
                var searchValue = $(this).val();
                var url = '{{ route('offers.index') }}?search=' + searchValue;
                refreshTableContent(url);
            });
        });

        function createData(url) {
            $('#formModal').modal('show');
            $('#formModal .modal-title').text('Add offer');
            $('#formModal form')[0].reset();
            $('#formModal form').attr('action', url);
            $('#formModal [name=_method]').val('post');
            $('#formModal [type=submit]').text('Save');
        }

        function editData(url) {
            // Mengambil data dari server
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    // Mengatur data ke dalam elemen form pada modal
                    $('#formModal [name=network_id]').val(response.network_id);
                    $('#formModal [name=country]').val(response.country);
                    $('#formModal [name=url_mobile]').val(response.url_mobile);
                    $('#formModal [name=url_desktop]').val(response.url_desktop);
                    // Menampilkan modal
                    $('#formModal').modal('show');
                    $('#formModal .modal-title').text('Edit offer');
                    // Mengatur action form modal ke route update
                    var updateUrl = '{{ route('offers.update', ':id') }}'; // Tentukan route update Anda
                    updateUrl = updateUrl.replace(':id', response
                        .id); // Gantikan ":id" dengan id offer yang akan diupdate
                    $('#formModal form').attr('action', updateUrl);
                    $('#formModal [name=_method]').val('put');
                    $('#formModal [type=submit]').text('Edit');
                },
                error: handleAjaxError
            });
        }


        function deleteData(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will delete this offer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user clicks "Yes, Delete!" in SweetAlert
                    $.ajax({
                        type: 'DELETE',
                        url: url, // Deletion URL
                        success: function(response) {
                            refreshTableContent();

                        },
                        error: handleAjaxError
                    });
                }
            });
        }
    </script>
@endpush
