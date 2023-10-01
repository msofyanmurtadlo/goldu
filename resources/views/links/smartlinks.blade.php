@extends('layouts.master')
@section('nav')
    <meta name="smartlink-count" content="{{ $filteredCount }}">

    <div class="flex-wrap d-flex justify-content-between align-items-center">
        <div>
            <h1>Smartlinks</h1>
            <p>Displays smartlinks</p>
        </div>

    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
                <div class="card">
                    <div class="card-body">
                        <form class="row g-3 needs-validation" novalidate="">
                            <div class="col-6 col-md-3">
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
                            <div class="col-6 col-md-3">
                                <button class="btn btn-primary" type="submit">Generate</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($smartlinks as $u)
                                        <tr>
                                            <td>{{ $u->id }}</td>
                                            <td>{{ $u->network->alias }}</td>
                                            <td>{{ $u->ip }}</td>
                                            <td><span
                                                    class="badge bg-{{ $u->status == 1 ? 'primary' : 'secondary' }}">{{ $u->status == 1 ? 'New' : 'Old' }}</span>
                                            </td>
                                            <td> <img src="{{ asset('flags/' . strtolower($u->country) . '.png') }}"
                                                    alt="{{ $u->country }}" /> {{ $u->country }}
                                            </td>
                                            <td>{{ $u->browser }}</td>
                                            <td>{{ $u->device }}</td>
                                            <td>{{ $u->platform }}</td>
                                            <td><span
                                                    class="badge bg-{{ $u->bot == 1 ? 'danger' : 'success' }}">{{ $u->bot == 1 ? 'Yes' : 'No' }}</span>
                                            </td>
                                            <td>{{ $u->isp }}</td>
                                            <td>{{ $u->useragent }}</td>
                                            @can('admin')
                                                <td>
                                                    <span class="badge bg-warning">{{ '@' . $u->user->username }}</span>
                                                </td>
                                            @endcan
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
    </script>
@endpush
