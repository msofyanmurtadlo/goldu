@extends('layouts.master')
@section('nav')
    <div class="flex-wrap d-flex justify-content-between align-items-center">
        <div>
            <h1>Convertions</h1>
            <p>"Conversions" refer to when someone visiting a website or application takes a specific desired action, such
                as making a purchase, filling out a form, or subscribing to a service. It is a primary goal in digital
                marketing and online business to measure campaign effectiveness and improve outcomes.</p>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title mb-0 me-3">List</h4>
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
                        <table id="convertion-list-table" class="table table-striped" role="grid"
                            data-bs-toggle="data-table">
                            <thead>
                                <tr class="ligth">
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Network</th>
                                    <th>Country</th>
                                    <th>Ballance</th>
                                    @can('admin')
                                        <th>Pemilik</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($convertions as $u)
                                    <tr>
                                        <td>{{ $convertions->total() - (($convertions->currentPage() - 1) * $convertions->perPage() + $loop->iteration) + 1 }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($u->created_at)->format('d/m/Y') }}</td>
                                        <td>{{ $u->network->alias }}</td>
                                        <td> <img src="{{ asset('flags/' . strtolower($u->country) . '.png') }}"
                                                alt="{{ $u->country }}" /> {{ $u->country }}
                                        </td>
                                        <td>{{ $u->ballance < 0 ? '-$' . number_format(abs($u->ballance), 2) : '$' . number_format($u->ballance, 2) }}
                                        </td>
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
                                {!! $convertions->links() !!}
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
                    var content = $(response).find('#convertion-list-table').parent();
                    $('#convertion-list-table').parent().replaceWith(content);
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

                var url = '{{ route('convertions.index') }}?startDate=' + startDate + '&endDate=' +
                    endDate;
                refreshTableContent(url);
            });

            $('#dateRangePicker').on('cancel.daterangepicker', function(ev, picker) {
                $(this).find('span').html('');
                var url = '{{ route('convertions.index') }}';
                refreshTableContent(url);
            });

        });
    </script>
@endpush
