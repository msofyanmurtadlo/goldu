@extends('layouts.master')
@section('nav')
    <div class="flex-wrap d-flex justify-content-between align-items-center">
        <div>
            <h1>Payments</h1>
            <p>saves all information about payments</p>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title mb-0 me-3">List </h4>
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
                        <table id="bonus-list-table" class="table table-striped" role="grid" data-bs-toggle="data-table">
                            <thead>
                                <tr class="ligth">
                                    <th>#</th>
                                    <th>Period</th>
                                    <th>Network</th>
                                    <th>Method</th>
                                    <th>Ballance</th>
                                    <th>Rate Usd</th>
                                    <th>Amount</th>
                                    <th>Proof</th>
                                    @can('admin')
                                        <th>Pemilik</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $u)
                                    <tr>
                                        <td>{{ $payments->total() - (($payments->currentPage() - 1) * $payments->perPage() + $loop->iteration) + 1 }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($u->startDate)->format('d/m/Y') }} -
                                            {{ \Carbon\Carbon::parse($u->endDate)->format('d/m/Y') }}</td>
                                        <td>{{ $u->network->alias }}</td>
                                        <td>{{ $u->method }}</td>
                                        <td>{{ $u->ballance < 0 ? '(-$' . number_format(abs($u->ballance), 2) . ')' : '$' . number_format($u->ballance, 2) }}
                                        </td>
                                        <td>{{ 'Rp' . number_format(floatval($u->rate), 0) }}
                                        </td>
                                        <td>{{ 'Rp' . number_format(floatval($u->amount), 0) }}
                                        </td>
                                        <td><a href="{{ $u->imgurl }}" target="_blank">Detail Transfer</a></td>
                                        @can('admin')
                                            <td>
                                                <span class="badge bg-primary">{{ '@' . $u->user->username }}</span>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation">
                            <ul>
                                {!! $payments->links() !!}
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
                    var content = $(response).find('#bonus-list-table').parent();
                    $('#bonus-list-table').parent().replaceWith(content);
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

                var url = '{{ route('payments.index') }}?startDate=' + startDate + '&endDate=' +
                    endDate;
                refreshTableContent(url);
            });

            $('#dateRangePicker').on('cancel.daterangepicker', function(ev, picker) {
                $(this).find('span').html('');
                var url = '{{ route('payments.index') }}';
                refreshTableContent(url);
            });

        });
    </script>
@endpush
