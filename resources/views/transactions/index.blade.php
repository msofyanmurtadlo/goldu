@extends('layouts.master')
@section('nav')
    <div class="flex-wrap d-flex justify-content-between align-items-center">
        <div>
            <h1>Transactions</h1>
            <p>View all existing transactions, namely bonuses, conversions and payouts.</p>
        </div>
    </div>
@endsection
@section('content')
    @include('transactions.detail')
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
                        <table id="transaction-list-table" class="table table-striped" role="grid"
                            data-bs-toggle="data-table">
                            <thead>
                                <tr class="ligth">
                                    <th>#</th>
                                    <th>Date</th>

                                    <th>Trx</th>
                                    <th>Network</th>
                                    <th>Type</th>
                                    <th>Ballance</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $u)
                                    <tr>
                                        <td>{{ $transactions->total() - (($transactions->currentPage() - 1) * $transactions->perPage() + $loop->iteration) + 1 }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($u->created_at)->format('d/m/Y') }}</td>

                                        <td>
                                            @if ($u->is_read == false)
                                                <a href="javascript:void(0)"
                                                    onclick="showTransactionDetail({{ $u->id }})">
                                                    {{ '#' . $settings['Site_Name'] . '-' . $u->id }}
                                                </a>
                                            @else
                                                {{ '#' . $settings['Site_Name'] . '-' . $u->id }}
                                            @endif
                                        </td>
                                        <td>{{ $u->network->alias }}</td>
                                        <td><span
                                                class="badge bg-{{ $u->type == 'Payout' ? 'warning' : 'success' }}">{{ $u->type }}</span>
                                        </td>

                                        <td>{{ $u->ballance < 0 ? '(-$' . number_format(abs($u->ballance), 2) . ')' : '$' . number_format($u->ballance, 2) }}
                                        </td>
                                        <td>{{ $u->amount < 0 ? '-$' . number_format(abs($u->amount), 2) : '$' . number_format($u->amount, 2) }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation">
                            <ul>
                                {!! $transactions->links() !!}
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
        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0'); // January is 0!
            const year = date.getFullYear();

            return `${day}/${month}/${year}`;
        }

        function showTransactionDetail(id) {
            $.get('/transaction/' + id, function(transaction) {
                document.getElementById('transactionModalId').textContent = transaction.id;
                document.getElementById('transactionModalNetwork').textContent = transaction.network.alias;
                document.getElementById('transactionModalType').textContent = transaction.type;
                let balanceValue = parseFloat(transaction.ballance);
                if (balanceValue < 0) {
                    document.getElementById('transactionModalBalance').textContent = '-$' + Math.abs(balanceValue)
                        .toFixed(2);
                } else {
                    document.getElementById('transactionModalBalance').textContent = '$' + balanceValue.toFixed(2);
                }
                document.getElementById('transactionModalAmount').textContent = transaction.amount;
                document.getElementById('transactionModalUsername').textContent = transaction.user.username;
                document.getElementById('transactionModalDate').textContent = formatDate(transaction.created_at);
                $('#transactionDetailModal').modal('show');
                refreshTableContent(location.href);
            });
        }


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
                    var content = $(response).find('#transaction-list-table').parent();
                    $('#transaction-list-table').parent().replaceWith(content);
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

                var url = '{{ route('transactions.index') }}?startDate=' + startDate + '&endDate=' +
                    endDate;
                refreshTableContent(url);
            });
            $('#dateRangePicker').on('cancel.daterangepicker', function(ev, picker) {
                $(this).find('span').html('');
                var url = '{{ route('transactions.index') }}';
                refreshTableContent(url);
            });

        });
    </script>
@endpush
