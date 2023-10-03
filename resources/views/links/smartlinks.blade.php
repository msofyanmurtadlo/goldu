@extends('layouts.master')
@section('nav')
    <meta name="smartlink-count" content="{{ $filteredCount }}">

    <div class="flex-wrap d-flex justify-content-between align-items-center">
        <div>
            <h1>Smartlinks</h1>
            <p>A "smartlink" is a dynamic URL that adjusts its destination based on criteria like device type or location,
                providing a tailored user experience.</p>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3 needs-validation" novalidate="">
                        <div class="col-12 col-md-8">
                            <select class="form-select" id="validationCustom04" required="">
                                <option selected="" disabled="" value="">Choose Network</option>
                                @foreach ($network as $u)
                                    <option value="{{ $u->alias }}">Network {{ '(' . $u->alias . ')' }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid state.
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-primary" type="submit">Generate</button>
                        </div>
                    </form>
                    <div class="row mt-4" id="resultRow" hidden>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="result1" rows="2" onclick="copyText(this)"></textarea>
                                    <textarea class="form-control mt-3" id="result2" rows="2" onclick="copyText(this)"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title mb-0 me-3">List <span id="total-smartlink-count">
                                ({{ $smartlinks->count() }})</span></h4>
                    </div>
                    <div>
                        <div class="input-group">
                            <div id="dateRangePicker"
                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table id="smartlink-list-table" class="table table-striped" role="grid"
                            data-bs-toggle="data-table">
                            <thead>
                                <tr class="ligth">
                                    <th>#</th>
                                    <th>Link Host</th>
                                    <th>Link Host + Alias</th>
                                    @can('admin')
                                        <th>Pemilik</th>
                                    @endcan
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($smartlinks as $u)
                                    <tr>
                                        <td>{{ $loop->remaining + 1 }}</td>
                                        <td>{{ 'https://' . $u->host }}</td>
                                        <td>{{ 'https://' . $u->host . '/' . $u->alias }}</td>
                                        @can('admin')
                                            <td>
                                                <span class="badge bg-warning">{{ '@' . $u->user->username }}</span>
                                            </td>
                                        @endcan
                                        <td>
                                            <div class="flex align-items-center list-network-action">
                                                <a class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" aria-label="Delete"
                                                    data-bs-original-title="Delete"
                                                    onclick="deleteData('{{ route('links.destroy', $u->id) }}')">
                                                    <span class="btn-inner">
                                                        <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            stroke="currentColor">
                                                            <path
                                                                d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                            </path>
                                                            <path d="M20.708 6.23975H3.75" stroke="currentColor"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                            <path
                                                                d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                            </path>
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
                                {!! $smartlinks->links() !!}
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
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            refreshTableContent(url);
        });

        function refreshTableContent(url = location.href) {
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    var content = $(response).find('#smartlink-list-table').parent();
                    $('#smartlink-list-table').parent().replaceWith(content);

                    // Assuming the backend sends the count in a meta tag, e.g., <meta name="smartlink-count" content="50">
                    var count = $(response).find('meta[name="smartlink-count"]').attr('content');
                    $('#total-smartlink-count').text('(' + count + ')');
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
            $('#dateRangePicker').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Clear'
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            });

            $('#dateRangePicker').on('apply.daterangepicker', function(ev, picker) {
                $(this).find('span').html(picker.startDate.format('MMMM D, YYYY') + ' - ' + picker.endDate
                    .format('MMMM D, YYYY'));

                var startDate = picker.startDate.format('YYYY-MM-DD');
                var endDate = picker.endDate.format('YYYY-MM-DD');

                var url = '{{ route('smartlinks') }}?startDate=' + startDate + '&endDate=' + endDate;
                refreshTableContent(url);
            });

            $('#dateRangePicker').on('cancel.daterangepicker', function(ev, picker) {
                $(this).find('span').html('');
                var url = '{{ route('smartlinks') }}';
                refreshTableContent(url);
            });
        });

        function deleteData(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will delete this user.',
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
                            Swal.fire('Success!', 'User deleted successfully.', 'success');
                        },
                        error: handleAjaxError
                    });
                }
            });
        }
    </script>
@endpush
