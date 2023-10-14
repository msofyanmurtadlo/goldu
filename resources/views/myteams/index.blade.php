@extends('layouts.master')
@section('nav')
    <div class="flex-wrap d-flex justify-content-between align-items-center">
        <div>
            <h1>My Teams</h1>
            <p>"My teams" refers to a list of team members. If labeled as "referral", it suggests members joined through a
                recommendation. The data captures their usernames and full names.</p>
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
                        <table id="myteam-list-table" class="table table-striped" role="grid"
                            data-bs-toggle="data-table">
                            <thead>
                                <tr class="ligth">
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($myteams as $u)
                                    <tr>
                                        <td>{{ $myteams->total() - (($myteams->currentPage() - 1) * $myteams->perPage() + $loop->iteration) + 1 }}
                                        </td>
                                        <td>
                                            <span class="badge bg-warning">{{ '@' . $u->username }}</span>
                                        </td>
                                        <td>{{ $u->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation">
                            <ul>
                                {!! $myteams->links() !!}
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
            var picker = $('#dateRangePicker').data('daterangepicker');
            if (picker.startDate && picker.endDate) {
                url += (url.indexOf('?') !== -1 ? '&' : '?') + 'startDate=' + picker.startDate.format(
                    'YYYY-MM-DD') + '&endDate=' + picker.endDate.format('YYYY-MM-DD');
            }

            refreshTableContent(url);
        });


        function refreshTableContent(url = location.href) {
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    var content = $(response).find('#myteam-list-table').parent();
                    $('#myteam-list-table').parent().replaceWith(content);
                    var count = $(response).find('meta[name="myteam-count"]').attr('content');
                    $('#total-myteam-count').text('(' + count + ')');
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

                var url = '{{ route('myteams.index') }}?startDate=' + startDate + '&endDate=' + endDate;
                refreshTableContent(url);
            });

            $('#dateRangePicker').on('cancel.daterangepicker', function(ev, picker) {
                $(this).find('span').html('');
                var url = '{{ route('myteams.index') }}';
                refreshTableContent(url);
            });
        });
    </script>
@endpush
